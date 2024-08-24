<?php
namespace App\controllers;
use Framework\Database;
use Framework\Session;


/*
 * User controller
 * Related to user management
*/ 
class UserController
{
  protected $db;
    
  public function __construct()
  {
      $this->db = Database::$db;
  }


  public function showAuthentication()
  {
    //if user is already authenticated
    if(Session::has('user'))
      redirect('/management');
    loadView('management/authenticate', ['database' => $this->db]);
  }

  /**
   * Make authentication
   * 
   * @return void
   */
  public function authMaker()
  {
    $user = $_POST['username'];
    $password = $_POST['password'];

    $errors = [];
    // Check for email
    $params = [
      'user' => $user
    ];

    $user = $this->db->query('SELECT * FROM `users` WHERE `user` = :user', $params)->fetch();
    //echo password_hash($password, PASSWORD_DEFAULT);
    if (!$user) {
      $errors['authError'] = 'Incorrect credentials';
      self::failedAuthentication(-1, $errors);
      exit;
    }
      if($user->logTries > 3)
      {
        $errors['authError'] = 'User blocked.';
        self::failedAuthentication($user->id, $errors);
        exit;
      }
      // Check if password is correct
      if (!password_verify($password, $user->password)) {
        $errors['authError'] = 'Incorrect credentials';
        self::failedAuthentication($user->id, $errors);
        exit;
      }
      
      //Set logTries to 0 and lastLogin to now
      $this->db->query('UPDATE users SET logTries = 0, lastLogin = NOW(), ip = :ip WHERE id = :id', ['id' => $user->id,'ip' => self::getUserIP()]);
      
      // Set user session
      Session::set('user', [
        'id' => $user->id,
        'name' => $user->user,
        'displayName' => $user->displayName,
        'profilePic' => $user->authorimage,
      ]);

      redirect('/management');
  }

  /**
   * Failed authentication handler
   *  
   * @param int $userId
   * @param string $ip
   * 
   * @return void
   */
  function failedAuthentication($userId, $errors = [])
  {
    if($userId > 0)    
      $this->db->query('UPDATE users SET logTries = logTries + 1, lastLogin = NOW(), ip = :ip WHERE id = :id', ['id' => $userId, 'ip' => self::getUserIP()]);
    loadView('management/authenticate', [
      'errors' => $errors
    ]);
    exit;
  }
  /**
   * Get user IP addrerss
   * 
   * @return string
   */
  function getUserIP() 
  {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }


  /**
   * Logout a user and kill session
   * 
   * @return void
   */
  public function logout()
  {
    session_unset();
    session_destroy();

    redirect('/authenticate');
  }
}