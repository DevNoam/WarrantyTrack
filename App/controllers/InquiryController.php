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
        $result = $mysqli->query("SELECT `Status`, `CaseClosedAt` FROM `cases` WHERE Casenumber = $caseId");
        $row = $result->fetch_assoc();
        if ($row['Status'] == "CLOSED") {
            $isCaseClosed = true;
        }
        
        
        if ($deleteCase == "YES" && $isCaseClosed == true) {
            $sql = "DELETE FROM cases WHERE Casenumber=$id";
            if ($mysqli->query($sql) === true) {
                echo "Case has been deleted.";
                redirect("/", 200);
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        } else {
            $sql = "UPDATE `cases` SET `clientName` = '$clientName', `Status` = '$Status', `Fixed` = '$FixStatus', `Fixed Description` = '$FixDescription', `phoneNumber` = '$phoneNumber', `Supplier` = '$Supplier' WHERE `cases`.`Casenumber` = $caseId";
        
            if ($mysqli->query($sql) === true) {
                echo "Case has been updated.";
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
            }
        }
        
        if ($Status == 'CLOSED' && $isCaseClosed == false) {
            $sql = "UPDATE cases SET CaseClosedAt = CURRENT_DATE WHERE Casenumber = $caseId";
            if ($mysqli->query($sql) === true) {
                echo "Case has been closed.";
            } else {
                echo "Error: " . $sql . "<br>" . $mysqli->error;
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