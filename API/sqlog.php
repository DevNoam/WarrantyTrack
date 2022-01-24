<?php
 $host = "localhost";

 $mysqli = new mysqli("localhost", "root", "", "warrantytrack");
 
 // Check connection
 if($mysqli === false){
     die("ERROR: Could not connect. " . $mysqli->connect_error);
 }
?>