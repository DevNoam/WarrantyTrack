<?php
    $mysqli = new mysqli("localhost", "root", "", "warrantytrack");
    if ($mysqli === false) {
        echo "DB ERROR";
        die("ERROR: Could not connect. " . $mysqli->connect_error);
        exit();
    }
    $domain = $_SERVER['PHP_SELF']; //Main website domain. Can be inclouded sub folders if program hosted inside. localhost/subfolder
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        $timeTodeletecase = getDeleteCases($mysqli);
    }

    //fetch data from sql database into $domain
    function getURL($mysqli)
    {
        $domain = null;
        //check if there coockie named domain
        if (!isset($_COOKIE['domain']) || $_COOKIE['domain'] == null) {
            $sql = "SELECT `Domain` FROM `settings` WHERE 1";
            $result = $mysqli->query($sql);
            $row = $result->fetch_assoc();
            $domain = $row['Domain'];
            //set coockie with experation time of 7 days
            setcookie('domain', $domain, time() + (86400 * 7), "/");
        } else {
            $domain = $_COOKIE['domain'];
        }
        echo "good";
        return $domain;
    }

    function getDeleteCases($mysqli)
    {
        //start session
        $days = null;
        //check if there coockie named domain
        //if there is session named days

        if (!isset($_SESSION['deleteCases'])) {
            $sql = "SELECT `deleteCases` FROM `settings` WHERE 1";
            $result = $mysqli->query($sql);
            $row = $result->fetch_assoc();
            $days = $row['deleteCases'];
            //set coockie with experation time of 7 days
            //set session deleteCases
            $_SESSION["deleteCases"] = $days;
        } else {
            $days = $_SESSION['deleteCases'];
        }
        return $days;
    }
?>




