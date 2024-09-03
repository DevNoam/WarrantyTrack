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
    public function updateTimetoDeleteCases()
    {
        $timeTodeletecase = $_POST['timeToDelete'];
        $query = "UPDATE `settings` SET `deleteCases` = :timeTodeletecase WHERE 1";
        $result = $this->db->query($query, ['timeTodeletecase' => $timeTodeletecase])->fetch();
        print_r($result);
        if (empty($result)) 
        {
            echo 200;
        }else
        {
            echo 500;
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
        $storeName = $_POST['storeName'];
        $storeAddress = $_POST['storeAddress'];
        $storePhone = $_POST['storePhone'];
        $storeEmail = $_POST['storeEmail'];
        $storeLogo = $_POST['storeLogo'];
    
        // Update
        $query = "UPDATE `settings` 
        SET `StoreName` = :storeName, 
            `Address` = :storeAddress, 
            `Phone` = :storePhone, 
            `Email` = :storeEmail, 
            `Logo` = :storeLogo 
        WHERE 1";
        $result = $this->db->query($query, ['storeName' => $storeName, 'storeAddress' => $storeAddress, 'storePhone' => $storePhone, 'storeEmail' => $storeEmail, 'storeLogo' => $storeLogo])->fetch();
        
        if (empty($result)) 
        {
            echo 200;
        }else
        {
            echo 500;
        }
    }
}