<?php
    session_start();
    if (!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true) {
        header("Location: $domain");
        exit;
    }
    include("../sqlog.php");
    // Get the domain ID
    $storeName = htmlspecialchars($_POST['storeName']);
    $storeAddress = htmlspecialchars($_POST['storeAddress']);
    $storePhone = htmlspecialchars($_POST['storePhone']);
    $storeEmail = htmlspecialchars($_POST['storeEmail']);
    $storeLogo = htmlspecialchars($_POST['storeLogo']);

    // Update the domain
    $sql = "UPDATE settings SET `StoreName`='$storeName',`Address`='$storeAddress',`Phone`='$storePhone',`Email`='$storeEmail',`Logo`='$storeLogo' WHERE 1";
    //push the query to the database
    $result = mysqli_query($mysqli, $sql);
    if (!$result) {
        echo 'Error changing Url';
    }
?>