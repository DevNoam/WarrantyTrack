<?php
    session_start();
    if (!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true) {
        header("Location: $domain");
        exit;
    }
    include("../sqlog.php");
    $timeTodeletecaseN = htmlspecialchars($_POST['timeToDeleteCasesField']);
    if($timeTodeletecaseN == $_SESSION['deleteCases']){
        return;    
    }else{
        //update sql query
        $sql = "UPDATE settings SET `deleteCases` = '$timeTodeletecaseN' WHERE 1";
        //run query
        $result = mysqli_query($mysqli, $sql);
        if ($result) {
            //update session 
            $_SESSION['deleteCases'] = $timeTodeletecaseN;
            //echo "success";
        }
        else {
            echo "<script>alert('Error updating time to delete cases.');</script>";
        }
    }
    exit;
?>