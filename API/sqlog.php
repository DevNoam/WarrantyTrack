<?php
 $mysqli = new mysqli("localhost", "user", "pass", "warrantytrack");
 
 // Check connection
 if($mysqli === false){
     die("ERROR: Could not connect. " . $mysqli->connect_error);
 }
?>