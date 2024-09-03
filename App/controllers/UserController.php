<?php
namespace App\controllers;
use Framework\Database;
use Framework\Router;
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
                        //Destroy other sessions if any
                        destroyOtherSessions($user->id);
                        Session::start();
                        Session::set('username', $user->username);
                        Session::set('name', $user->Name);
                        Session::set('id', $user->id);
                        Session::set('role', $user->role);

                        //save the session to the user
                        $sql = "UPDATE `users` SET session = :session_id WHERE id = :id";                  
                        $params = [
                            'id' => $user->id,
                            'session_id' => session_id()
                        ];
                        $stmt = $this->db->query($sql, $params);
                        
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
     * Log out the user
     * 
     * @return void
     */

    public function logOut()
    {
        session_start();
        session_destroy();
        Session::clearAll();
        redirect('/authenticate');
        exit;
    }
    
    /**
     * Show your profile or others profile
     * 
     * @return void
     */
    public function profile($params = null)
    {
        // Try to get the profile ID from the query parameters
        $profileId = $params[0] ?? session::get('id');
        
        $userData = null;
        $isMe = true;
        $roles = null;
        $sql = "SHOW COLUMNS FROM `users` WHERE Field = 'role'";
        $stmt = $this->db->query($sql);
        $row2 = $stmt->fetch(\PDO::FETCH_ASSOC);

        $roles = explode(",", str_replace("'", "", substr($row2['Type'], 5, (strlen($row2['Type'])-6))));
        $sql = "SELECT *, NULL AS `password` FROM users WHERE id = :id";
        $userData = $this->db->query($sql, ['id' => $profileId])->fetch();

        // Check if the profileId is ours to mark it as 'isMe'
        if ($profileId != session::get('id')) {
            $isMe = false;
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
     * Show users page
     * 
     * @return void
     */
    public function showUsers()
    {
        // $userRole = Authorize::getRole();
        $userRole = "Admin";
        $users = [];
        if ($userRole == "Admin") {
            $sqlData = "SELECT `id`, `username`, `role`, `Name` FROM `users` WHERE 1;";
            $users = $this->db->query($sqlData)->fetchAll();
        }

        loadView("users", ['users' => $users,'userRole' => $userRole, 'db' => $this->db]);
    }


    /**
     * Function to run user creation process
     */
    public function makeUser()
    {
        $response = [];
        
        //get from POST
        $personalName = $_POST['personalName'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $role = $_POST['role'];
        
        $sql = "SELECT 'id' FROM users WHERE username = :username";
        $result = $this->db->query($sql, ['username' => $username])->fetch();
        
        if (!empty($result)) {
            errorHandler('409');
        }
        
        $sql = "INSERT INTO users (username, password, Name, role) 
        VALUES (:username, :password, :Name, :role) ";
        $result = $this->db->query($sql, [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'Name' => $personalName,
            'role' => $role
            ])->fetch();
            
        if ($result == null) {
            errorHandler('200');
        }
        else
        {
            errorHandler('500');
        }
    }

    /**
     * Change user password
     * 
     * @return int
     */
    public function changePassword()
    {
        $userId = $_POST['userId'];
        $newPassword = $_POST['password'];

        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $result = $this->db->query($sql, ['password' => password_hash($newPassword, PASSWORD_DEFAULT), 'id' => $userId])->fetch();
        
        //Disconnect the user if not me
        if($userId != session::get('id'))
            destroyOtherSessions($userId);
        
        if ($result == null) {
            errorHandler(200);
        }
        else
        {
            errorHandler(500);
        }
    }

    /**
     * Delete user
     * 
     * @param int $userId
     * 
     * @return void
     */
    public function deleteUser($id)
    {
        $userId = $id[0];
        $sql = "DELETE FROM users WHERE id = :id";
        $result = $this->db->query($sql, ['id' => $userId])->fetch();
        if ($result == null) {
            errorHandler('200');
        }
        else
        {
            errorHandler('500');
        }
    }
        
    /**
     * Edit user function
     * 
    */
    public function editUser($params)
    {

    }
}