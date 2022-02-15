<?php 
    $timeTodeletecaseN = $_POST['fetchNewcasesN'];
    //set cookie with experation date of never
    setcookie('fetchNewcases', $timeTodeletecaseN, time() + (86400 * 365 * 10), "/");
    exit;
?>