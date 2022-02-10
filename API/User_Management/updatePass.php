<?php 
require_once("../sqlog.php");

$newPD = $_POST['password'];
$username = $_SESSION['username'];

//update password for username in database
$sql = "UPDATE users SET password = '$newPD' WHERE username = '$username'";
//check if query was successful
if ($mysqli->query($sql) === TRUE) {
    echo "Password has been updated.";
} else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
}
//logout user
session_destroy();

//move to login page
header("Location: $domain");
?>