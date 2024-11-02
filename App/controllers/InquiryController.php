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
    public function initCasePage($param)
    {
        $isAdmin = Session::get('role') == 'Admin' ? true : false;
        $queryStatus = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'cases' AND COLUMN_NAME = 'Status'";
        $caseStatusFields = $this->db->query($queryStatus)->fetch();
        preg_match_all("/'([^']+)'/", $caseStatusFields->COLUMN_TYPE, $caseStatusFields);

        //
        while(isset($param[0]) && true)
        {
            //validate the case id
            if(!is_numeric($param[0]))
            {
                break;
            }
            
            $query = "SELECT * FROM cases WHERE Casenumber = :caseId";
            $result = $this->db->query($query, ['caseId' => $param[0]])->fetch();
            $queryFixStatus = "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'cases' AND COLUMN_NAME = 'Fixed';";
            $fixStatusFields = $this->db->query($queryFixStatus)->fetch();  
            preg_match_all("/'([^']+)'/", $fixStatusFields->COLUMN_TYPE, $fixStatusFields);

            //if case not found        
            if(!$result)
            {
                break;
            }
            loadView('caseView', ['database' => $this->db, 'case' => $result, 'isAdmin' => $isAdmin, 'caseStatusFields' => $caseStatusFields[1], 'fixStatusFields' => $fixStatusFields[1]]);
            exit();
        }

        loadView('CaseNew', ['database' => $this->db, 'caseStatusFields' => $caseStatusFields[1]]);
    }
    public function createCase()
    {
        $Createdby = $_POST['Createdby'];
        $clientName = $_POST['clientName'];
        $phoneNumber = $_POST['phoneNumber'];
        $Address = $_POST['Address'];
        $ReciptNumber = $_POST['ReciptNumber'];
        $OrderDate = $_POST['OrderDate'];
        $ProductSKU = $_POST['ProductSKU'];
        $ProductName = $_POST['ProductName'];
        $ProductSerial = $_POST['ProductSerial'];
        $Supplier = $_POST['Supplier'];
        $CaseDescription = $_POST['CaseDescription'];
        $Status = $_POST['Status'];
        $CreatedAt = date("d-m-Y H:i:s");
        
        if ($Supplier == null || $Supplier == "") {
            $Supplier = "UNKOWN";
        }
        
        $sql = "INSERT INTO `cases` (`clientName`, `phoneNumber`, `Address`, `ReciptNumber`, `ProductSKU`, `ProductSerial`, `ProductName`, `CaseDescription`, `CreatedAt`, `OrderDate`, `CaseClosedAt`, `Status`, `Fixed`, `FixedDescription`, `Createdby`, `Supplier`) VALUES ('$clientName', '$phoneNumber', '$Address', '$ReciptNumber', '$ProductSKU', '$ProductSerial', '$ProductName', '$CaseDescription', current_timestamp(), '$OrderDate', NULL, '$Status', NULL, NULL, '$Createdby', '$Supplier');";
        $this->db->query($sql);
        $id = $this->db->lastInsertId();
        redirect("/case/$id", 200);
        exit();
    }


    public function updateCase()
    {
        $caseId = $_POST['CaseID'];
        $Status = $_POST['Status'];
        $FixStatus = $_POST['FixStatus'];
        $FixDescription = $_POST['FixDescription'];
        $clientName = $_POST['clientName'];
        $phoneNumber = $_POST['phoneNumber'];
        $Supplier = $_POST['Supplier'];
        $deleteCase = $_POST['deleteCase'];

        $isCaseClosed = false;
        $fetchInitDataQuery = "SELECT `Status`, `CaseClosedAt` FROM `cases` WHERE Casenumber = $caseId";
        $stmt = $this->db->query($fetchInitDataQuery);
        $oldData = $stmt->fetch();

        if ($oldData->Status == "CLOSED") {
            $isCaseClosed = true;
        }
        
        if ($deleteCase == "YES" && $isCaseClosed == true) {
            $deleteQuery = "DELETE FROM `cases` WHERE `Casenumber` = $caseId";
            $deleteResult = $this->db->query($deleteQuery);

            if ($deleteResult === true) {
                echo "Case has been deleted.";
                redirect("/", 200);
                exit();
            } else {
                echo "Error:" . "<br>" . $deleteResult->error;
            }
        } else {
            $updateCaseQuery = "UPDATE `cases` SET `clientName` = '$clientName', `Status` = '$Status', `Fixed` = '$FixStatus', `FixedDescription` = '$FixDescription', `phoneNumber` = '$phoneNumber', `Supplier` = '$Supplier' WHERE `cases`.`Casenumber` = $caseId";
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
    public function printInquiry($param)
    {

        if(!is_numeric($param[0]))
        {
            errorHandler(404);
            exit();
        }

        //get the case information from sql
        $caseQuery = "SELECT * FROM cases WHERE Casenumber = :caseId";
        $storeQuery = "SELECT * FROM settings WHERE 1";
        
        $case = $this->db->query($caseQuery, ['caseId' => $param[0]])->fetch();
        $store = $this->db->query($storeQuery)->fetch();

        //check if case exists
        if ($case == null || $store == null) {
            errorHandler(404);
            exit();
        }

        loadView('print', ['database' => $this->db, 'case' => $case, 'store' => $store]);
    }
}