<?php 

session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true){
    header("location: https://localhost/");
    exit;
}
require_once('API/sqlog.php');

$case = $_GET['caseID'];
//Check if $case is vaild on the DB.
//Pull data.
echo $case;
?>