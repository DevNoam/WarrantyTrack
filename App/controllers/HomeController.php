<?php
namespace App\controllers;
use Framework\Database;
use Framework\Session;


/**
 * Home controller
 * Related to home page
*/
class HomeController
{
    protected $db;
    
    public function __construct()
    {
        $this->db = Database::$db;
    }

    public function panel()
    {
        $query = 'SELECT `Status`,`CreatedAt`,`CaseNumber`,`ProductName`,`clientName`,`ReciptNumber`,`CaseClosedAt`,`Createdby`,`Supplier` FROM cases ORDER BY FIELD(Status, "OPEN", "Waiting for customer", "Waiting for supplier", "Returning from supplier", "Picked by supplier", "Shipped to supplier", "Being checked", "CLOSED"), CreatedAt asc, Supplier, clientName';
        $stmt = $this->db->query($query);
        $cases = $stmt->fetchAll();

        $openCases = 0;
        $closedCases = 0;
      
        foreach ($cases as $case) {
            if ($case->Status != "CLOSED") {
                $openCases++;
            }
            //This whole delete method should be converted into PHP cron job.
            // else if ($case['Status'] == "CLOSED" && $timeTodeletecase != "NEVER" && $case['CaseClosedAt'] < date('Y-m-d', strtotime("-$timeTodeletecase days"))) {
            //     $sql = "DELETE FROM `cases` WHERE `CaseNumber` = '$case[CaseNumber]'";
            //     if ($mysqli->query($sql) === true) {
            //         //echo "Case has been deleted.";
            //     } else {
            //         echo "Error: " . $sql . "<br>" . $mysqli->error;
            //     }
            //   }
             else {
                $closedCases++;
            }
        }
        //get avreage days it takes to close a case
        // $sql = "SELECT `AverageTimePerCase` FROM `settings`"; ???
        // $avgTime = $avgTime['AverageTimePerCase'];
        $fetchNewcases = 10; //Fetch the new cases created in the last X days.
        if(isset($_COOKIE['fetchNewcases'])) {
          $fetchNewcases = $_COOKIE['fetchNewcases'];
        }


        loadView('panel', ['database' => $this->db, 'cases' => $cases, 'openCases' => $openCases, 'closedCases' => $closedCases, 'fetchNewcases' => $fetchNewcases]);
    }

    public function cases()
    {
        $users = array("All");
        if(isset($_GET['agentFilter']))
        {
          $userSelected = $_GET['agentFilter'];
          if(!in_array($userSelected, $users))
            array_push($users, $userSelected);
        }else 
          $userSelected = "All";
        $query = 'SELECT `Status`,`CreatedAt`,`CaseNumber`,`ProductName`,`clientName`,`ReciptNumber`,`CaseClosedAt`,`Createdby`,`Supplier` FROM cases ORDER BY FIELD(Status, "OPEN", "Waiting for customer", "Waiting for supplier", "Returning from supplier", "Picked by supplier", "Shipped to supplier", "Being checked", "CLOSED"), CreatedAt asc, Supplier, clientName';
        $stmt = $this->db->query($query);
        $cases = $stmt->fetchAll();

        $openCases = $closedCases = null;
        foreach ($cases as $case) {
            if ($case->Status != "CLOSED") {
              $openCases++;
              if(!in_array($case->Createdby, $users))
              {
                array_push($users, $case->Createdby);
              }

            } else {
                $closedCases++;
                if(!in_array($case->Createdby, $users))
                {
                  array_push($users, $case->Createdby);
                }
            }
        }

        loadView('cases', ['database' => $this->db, 'cases' => $cases, 'openCases' => $openCases, 'closedCases' => $closedCases, 'users' => $users, 'userSelected' => $userSelected]);
    }


    public function searchCase()
    {
        $searchData = htmlspecialchars($_GET['data']);
        $cases = [];
        $resultCheck = 0;
    
        // Prepare the search data for the query
        $searchData = trim($searchData);
        $searchData = ($searchData === "" || $searchData === null) ? '?' : $searchData;
    
        // SQL query with placeholders
        $sql = "SELECT * FROM `cases` 
                WHERE `Casenumber` LIKE :searchData 
                OR `clientName` LIKE :searchData 
                OR `phoneNumber` LIKE :searchData 
                OR `Address` LIKE :searchData 
                OR `ReciptNumber` LIKE :searchData 
                OR `ProductSKU` LIKE :searchData 
                OR `ProductSerial` LIKE :searchData 
                OR `ProductName` LIKE :searchData 
                OR `CaseDescription` LIKE :searchData 
                OR `CreatedAt` LIKE :searchData 
                OR `Status` LIKE :searchData 
                OR `Createdby` LIKE :searchData 
                OR `Supplier` LIKE :searchData";
    
        // Bind parameters
        $params = ['searchData' => '%' . $searchData . '%'];
    
        try {
            // Execute the query
            $stmt = $this->db->query($sql, $params);
            
            // Fetch all results
            $cases = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            
            // Count the number of results
            $resultCheck = count($cases);
        } catch (\Exception $e) {
            // Handle query execution errors if necessary
            $cases = [];
            $resultCheck = 0;
        }
    
        // Load the view with the results
        loadView('search', ['database' => $this->db, 'searchData' => $searchData, 'cases' => $cases, 'resultCheck' => $resultCheck]);
    }
    

    public function logOut()
    {
        Session::clearAll();
        redirect('/authenticate');
    }

    public function reports()
    {
        loadView('reports', ['database' => $this->db]);
    }

}