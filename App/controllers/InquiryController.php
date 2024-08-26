<?php
namespace App\controllers;
use Framework\Database;
use Framework\Session;


/**
 * Home controller
 * Related to home page
*/
class InquiryController
{
    protected $db;
    
    public function __construct()
    {
        $this->db = Database::$db;
    }
    /**
     * Show case page
     * 
     * @return void
     */
    public function initCasePage()
    {

    }
    public function createCase($caseId, $Createdby, $clientName, $phoneNumber, $Address, $ReciptNumber, $OrderDate, $ProductSKU, $ProductName, $ProductSerial, $Supplier, $CaseDescription, $Status)
    {
        $CreatedAt = date("d-m-Y H:i:s");
        
        if ($Supplier == null || $Supplier == "") {
            $Supplier = "UNKOWN";
        }
        
        
        $sql = "INSERT INTO `cases` (`Casenumber`, `clientName`, `phoneNumber`, `Address`, `ReciptNumber`, `ProductSKU`, `ProductSerial`, `ProductName`, `CaseDescription`, `CreatedAt`, `OrderDate`, `CaseClosedAt`, `Status`, `Fixed`, `Fixed Description`, `Createdby`, `Supplier`) VALUES ('$caseId', '$clientName', '$phoneNumber', '$Address', '$ReciptNumber', '$ProductSKU', '$ProductSerial', '$ProductName', '$CaseDescription', current_timestamp(), '$OrderDate', NULL,'$Status', NULL, NULL, '$Createdby', '$Supplier')";


        redirect("/case/!CODE!", 200);
        exit();
    }


    public function updateCase($caseId, $Status, $FixStatus, $FixDescription, $clientName, $phoneNumber, $Supplier, $deleteCase)
    {
        $isCaseClosed = false;
        $fetchInitDataQuery = "SELECT `Status`, `CaseClosedAt` FROM `cases` WHERE Casenumber = $caseId";
        $stmt = $this->db->query($fetchInitDataQuery);
        $oldData = $stmt->fetchAll();

        if ($oldData->Status == "CLOSED") {
            $isCaseClosed = true;
        }
        
        if ($deleteCase == "YES" && $isCaseClosed == true) {
            $deleteQuery = "DELETE FROM cases WHERE Casenumber = $caseId";
            $deleteResult = $this->db->query($deleteQuery);

            if ($deleteResult === true) {
                echo "Case has been deleted.";
                redirect("/", 200);
                exit();
            } else {
                echo "Error:" . "<br>" . $deleteResult->error;
            }
        } else {
            $updateCaseQuery = "UPDATE `cases` SET `clientName` = '$clientName', `Status` = '$Status', `Fixed` = '$FixStatus', `Fixed Description` = '$FixDescription', `phoneNumber` = '$phoneNumber', `Supplier` = '$Supplier' WHERE `cases`.`Casenumber` = $caseId";
            $updateResult = $this->db->query($updateCaseQuery);

            if ($updateResult === true) {
                echo "Case has been updated.";
            } else {
                echo "Error: " . "<br>" . $updateResult->error;
            }
        }
        
        if ($Status == 'CLOSED' && $isCaseClosed == false) {
            $closeCaseQuery = "UPDATE cases SET CaseClosedAt = CURRENT_DATE WHERE Casenumber = $caseId";
            $closeCaseResult = $this->db->query($closeCaseQuery);
            
            if ($closeCaseResult === true) {
                echo "Case has been closed.";
            } else {
                echo "Error: " . "<br>" . $closeCaseResult->error;
            }
        }
        
        //Code placeholder to send sms if case has been resolved
        
        redirect("/cases", 200);
        exit();
    }




    /**
     * Print inquiry
     * @param int $id
     * @return void
     */
    public function printInquiry($id)
    {
        $id = $_GET['id'];
        //get the case information from sql
        $sql = "SELECT cases.*, settings.* FROM cases, settings WHERE cases.Casenumber = $id AND settings.id = 1";

        $case = [];
        $store = [];

        loadView('print/print', ['database' => $this->db, 'case' => $case, 'store' => $store]);
    }
}