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
    public function isAuthenticated()
    {
        return Session::has('user');
    }

    /**
    * Handle the user's request
    * 
    * @param string $role
    * @return bool
    */
    public function handle($role)
    {
        if ($role === 'guest' && $this->isAuthenticated()) 
        {
            redirect('/');
            return true;
            //Authenticated
        } 
        elseif ($role === 'admin' && !$this->isAuthenticated()) {
            redirect('/authenticate', 403);
            return false;
            //Not Authenticated
        }
    }
}
?>