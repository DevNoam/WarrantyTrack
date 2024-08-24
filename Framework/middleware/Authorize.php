<?php
namespace Framework\middleware;

use Framework\Session;

class Authorize
{
    /**
    * Check if user is authenticated
    * 
    * @return bool
    */
    private function isAuthenticated()
    {
        return Session::has('id');
    }

    /**
    * Handle the user's request
    * 
    * @param string $role
    * @return bool
    */
    public function handle($role)
    {
        if ($role === 'guest' && !$this->isAuthenticated()) {
            // Guest access is allowed to unauthenticated users
            return true;
        }
        elseif($role === 'everyone')
        {
            // Guest access is allowed to everyone
            return true;
        }
        elseif ($role === 'Admin' && $this->isAuthenticated()) {
            // Admins must be authenticated
            if (Session::get('role') == 'Admin') {
                return true;
            } else {
                errorHandler(403); // Redirect to NoPermissions page if user does not have admin role 
                exit;
            }
        }
        elseif ($role === 'user' && $this->isAuthenticated()) {
            // Users must be authenticated
                return true;
        }   
        else {
            // Role not recognized
            redirect('/authenticate', 403); // Redirect to an error page if the role is invalid
            exit;
        }
    }
}
