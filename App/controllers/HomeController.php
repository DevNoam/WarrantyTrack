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
        // Fetch case data
        $query = 'SELECT `Status`, `CreatedAt`, `Casenumber`, `ProductName`, `clientName`, `ReciptNumber`, `CaseClosedAt`, `Createdby`, `Supplier` 
                  FROM cases 
                  ORDER BY FIELD(Status, "OPEN", "Waiting for customer", "Waiting for supplier", "Returning from supplier", "Picked by supplier", "Shipped to supplier", "Being checked", "CLOSED"), CreatedAt ASC, Supplier, clientName';
        $stmt = $this->db->query($query);
        $cases = $stmt->fetchAll();
    
        // Count open and closed cases
        $openCases = 0;
        $closedCases = 0;
        foreach ($cases as $case) {
            if ($case->Status == "CLOSED") {
                $closedCases++;
            } else {
                $openCases++;
            }
        }
    
        // Fetch the number of new cases based on a cookie or default value
        $fetchNewcases = isset($_COOKIE['fetchNewcases']) ? (int)$_COOKIE['fetchNewcases'] : 10;
    
        // Get data for graph
        $sql = "SELECT DATE(`CreatedAt`) AS createdDate 
                FROM cases 
                WHERE `CreatedAt` > NOW() - INTERVAL :fetchNewcases DAY 
                ORDER BY `CreatedAt` ASC";
        $stmt = $this->db->query($sql, ['fetchNewcases' => $fetchNewcases]);
        $valuesForGraph = $stmt->fetchAll(\PDO::FETCH_COLUMN, 0);
    
        // Initialize arrays for date range and final values
        $datesNum = [];
        $finalValues = array_fill(0, $fetchNewcases, 0);
    
        // Populate datesNum array with the last X days
        for ($i = 0; $i < $fetchNewcases; $i++) {
            $datesNum[$i] = date('Y-m-d', strtotime("-$i days"));
        }
    
        // Count occurrences of each date in the data array
        foreach ($valuesForGraph as $date) {
            if (($key = array_search($date, $datesNum)) !== false) {
                $finalValues[$key]++;
            }
        }
    
        // Convert the finalValues array to JSON format
        $graphValue = json_encode($finalValues);
    
        // Load the view with the data
        loadView('panel', ['database' => $this->db, 'cases' => $cases, 'openCases' => $openCases, 'closedCases' => $closedCases, 'graphValue' => $graphValue]);
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
        $query = 'SELECT `Status`,`CreatedAt`,`Casenumber`,`ProductName`,`clientName`,`ReciptNumber`,`CaseClosedAt`,`Createdby`,`Supplier` FROM cases ORDER BY FIELD(Status, "OPEN", "Waiting for customer", "Waiting for supplier", "Returning from supplier", "Picked by supplier", "Shipped to supplier", "Being checked", "CLOSED"), CreatedAt asc, Supplier, clientName';
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

    public function reports()
    {
        loadView('reports', ['database' => $this->db]);
    }

}