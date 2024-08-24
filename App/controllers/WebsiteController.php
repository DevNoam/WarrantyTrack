<?php
namespace App\controllers;
use Framework\Database;
use Framework\middleware\Authorize;
use Framework\Session;


/**
 * Home controller
 * Related to home page
*/
class WebsiteController
{
    protected $db;
    
    public function __construct()
    {
        $this->db = Database::$db;
    }



    public function showSettings()
    {
        //get settings data
        $sqlData = "SELECT * FROM `settings`";
        $data = $this->db->query($sqlData)->fetchAll();
        loadView("settings", ['settingsData' => $data, 'db' => $this->db]);
    }
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





    public function updateDomain()
    {
          // Get the domain ID
    $newDomain = htmlspecialchars($_POST['domainField']);

    // Update the domain
    $sql = "UPDATE settings SET Domain = '$newDomain' WHERE 1";
    //push the query to the database
    $result = mysqli_query($mysqli, $sql);
    if (!$result) {
        echo 'Error changing Url';
    }
    setcookie('domain', $newDomain, time() + (86400 * 7), "/");
    }

    /**
     * Update time to delete cases
     * 
     * @param int $timeTodeletecase
     * @return bool
     */
    public function updateTimetodeletecases($timeTodeletecase)
    {
        // Update the domain
        $sql = "UPDATE settings SET `deleteCases` = '$timeTodeletecase' WHERE 1";
        //push the query to the database
        $result = mysqli_query($mysqli, $sql);
        if (!$result) {
            echo 'Error';
        }
    }

    /**
     * Update store details
     * 
     * @param array $storeProps [storeName, storeAddress, storePhone, storeEmail, storeLogo]
     * @return void
     */
    public function updateStore($storeProps)
    {
        $storeName = $storeProps['storeName'];
        $storeAddress = $storeProps['storeAddress'];
        $storePhone = $storeProps['storePhone'];
        $storeEmail = $storeProps['storeEmail'];
        $storeLogo = $storeProps['storeLogo'];
    
        // Update the domain
        $sql = "UPDATE settings SET `StoreName`='$storeName',`Address`='$storeAddress',`Phone`='$storePhone',`Email`='$storeEmail',`Logo`='$storeLogo' WHERE 1";
        //push the query to the database
        $result = mysqli_query($mysqli, $sql);
        if (!$result) {
            echo 'Error changing Url';
        }
    }

    /**
     * Get time in days to delete cases
     * 
     * @return int
     */
    public function getTimeToDeleteCases()
    {
        $sql = "SELECT `deleteCases` FROM `settings` WHERE 1";
        $result = $mysqli->query($sql);
        $row = $result->fetch_assoc();
        return $row['deleteCases'];
    }


    /**
     * @deprecated
     * Get store Domain URL
     * 
     * @return string
     */
    function getURL($mysqli)
    {
        $domain = null;
        //check if there coockie named domain
        if (!isset($_COOKIE['domain']) || $_COOKIE['domain'] == null) {
            $sql = "SELECT `Domain` FROM `settings` WHERE 1";
            $result = $mysqli->query($sql);
            $row = $result->fetch_assoc();
            $domain = $row['Domain'];
            //set coockie with experation time of 7 days
            setcookie('domain', $domain, time() + (86400 * 7), "/");
        } else {
            $domain = $_COOKIE['domain'];
        }
        return $domain;
    }
}