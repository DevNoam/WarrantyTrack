<?php
    include("../sqlog.php");
    // Get the domain ID
    $newDomain = $_POST['domainField'];

    // Update the domain
    $sql = "UPDATE settings SET Domain = '$newDomain' WHERE 1";
    //push the query to the database
    $result = mysqli_query($mysqli, $sql);
    if (!$result) {
        echo 'Error changing Url';
    }
    setcookie('domain', $newDomain, time() + (86400 * 7), "/");
?>