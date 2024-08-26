<?php
namespace App\controllers;
use Framework\Database;
use Framework\middleware\Authorize;
use Framework\Session;


/**
 * Home controller
 * Related to home page
*/
class SettingsController
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

    /**
     * Update time to delete cases
     * 
     * @param int $timeTodeletecase
     * @return bool
     */
    public function updateTimetodeletecases()
    {
        $timeTodeletecase = htmlspecialchars($_POST['timeTodeletecase']);
        $query = "UPDATE settings SET `deleteCases` = '$timeTodeletecase' WHERE 1";
        $result = $this->db->query($query);
        if ($result) {
            return '200';
        }else
        {
            return '500';
        }
    }

    /**
     * Update store details
     * 
     * @param array $storeProps [storeName, storeAddress, storePhone, storeEmail, storeLogo]
     * @return void
     */
    public function updateStore()
    {
        $storeProps = $_POST;
        $storeName = $storeProps['storeName'];
        $storeAddress = $storeProps['storeAddress'];
        $storePhone = $storeProps['storePhone'];
        $storeEmail = $storeProps['storeEmail'];
        $storeLogo = $storeProps['storeLogo'];
    
        // Update
        $query = "UPDATE settings SET `StoreName`='$storeName',`Address`='$storeAddress',`Phone`='$storePhone',`Email`='$storeEmail',`Logo`='$storeLogo' WHERE 1";
        
        $result = $this->db->query($query);
        if ($result) {
            return '200';
        }else
        {
            return '500';
        }
    }
}