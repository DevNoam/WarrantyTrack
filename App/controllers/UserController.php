<?php
namespace App\controllers;
use Framework\Database;
use Framework\Session;


/**
 * Home controller
 * Related to home page
*/
class UserController
{
    protected $db;
    
    public function __construct()
    {
        $this->db = Database::$db;
    }
    


    /**
     * Show authentication page
     * 
     * @return void
     */
    public function showAuthentication()
    {
        loadView('authenticate');
        exit;
    }
    public function authMaker()
    {
        $username = $password = "";
        $username_err = $password_err = $login_err = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (empty(trim($_POST["username"]))) {
                Session::setFlashMessage('error', 'Username field is required.');
                $username_err = "Username is required.";
            } else {
                $username = trim($_POST["username"]);
            }

            if (empty(trim($_POST["password"]))) {
                Session::setFlashMessage('error', 'Password field is required.');
                $password_err = "Password is required.";
            } else {
                $password = trim($_POST["password"]);
            }

            if (empty($username_err) && empty($password_err)) {
                $sql = "SELECT * FROM users WHERE username = :username";
                $params = ['username' => $username];

                $stmt = $this->db->query($sql, $params);
                // Log the user
                if ($stmt->rowCount() == 1) {
                    $user = $stmt->fetch();
                    
                    print_r(password_hash($password, PASSWORD_DEFAULT));
                    if (password_verify($password, $user->password)) {
                        Session::start();
                        Session::set('username', $user->username);
                        Session::set('name', $user->Name);
                        Session::set('id', $user->id);
                        Session::set('role', $user->role);
                        redirect('/');
                    } else {
                        Session::setFlashMessage('error', 'Invalid username or password.');
                    }
                } else {
                    Session::setFlashMessage('error', 'Invalid username or password.');
                }
            }

            loadView('/authenticate', [
                'errorMsg' => Session::getFlashMessage('error'),
                'username' => $username,
                'password' => $password,
                'username_err' => $username_err,
                'password_err' => $password_err,
                'login_err' => $login_err
            ]);
        }
    }

    /**
     * Log out
     * 
     * @return void
     */

    public function logOut()
    {
        session_start();
        session_destroy();
        Session::clearAll();
        redirect('/');
        exit;
    }

    public function showMakeUser()
    {

    }
    public function editUser($userId)
    {

    }
    public function profile()
    {
        // Try to get the profile ID from the query parameters
        $profileId = $_GET['id'] ?? null;
        
        $userData = null;
        $isMe = true;
        $roles = null;
    
        $sql = "SHOW COLUMNS FROM `users` WHERE Field = 'role'";
        $stmt = $this->db->query($sql);
        $row2 = $stmt->fetch(\PDO::FETCH_ASSOC);

        $roles = explode(",", str_replace("'", "", substr($row2['Type'], 5, (strlen($row2['Type'])-6))));
        // If user is Admin and profileId is set
        if (Session::get('role') === 'Admin' && $profileId !== null) {
            // Prepare SQL query for admin to view any user's profile
            $sql = "SELECT *, NULL AS `password` FROM users WHERE id = :id";
            // Execute the query with the provided profile ID
            $userData = $this->db->query($sql, ['id' => $profileId])->fetch();
            $isMe = false;



            //Fetch available roles from Database


        } else {
            // Prepare SQL query for non-admin or self-profile view
            $sql = "SELECT *, NULL AS `password` FROM users WHERE id = :id";
            // Execute the query with the session user's ID
            $userData = $this->db->query($sql, ['id' => Session::get('id')])->fetch();
        }
        // Load the profile view with the retrieved data
        loadView("profile", [
            'userData' => $userData,
            'rolesList' => $roles,
            'userRole' => Session::get('role'),
            'isMe' => $isMe,
            'db' => $this->db
        ]);
    }
    


    /**
     * Fetch new cases
     * 
     * @param int $fetchNewcases
     * @return bool
     */
    public function fetchNewCases($fetchNewcases = 7)
    {
        //set cookie with experation date of never
        setcookie('fetchNewcases', $fetchNewcases, time() + (86400 * 365 * 10), "/");

        //Update on the database for the user table

        return true;
    }
}