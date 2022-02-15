<?php
require_once("sqlog.php");

$id = $_POST['CaseID'];
$Status = $_POST['Status'];
$FixStatus = $_POST['FixStatus'];
$FixDescription = $_POST['FixDescription'];
$clientName = $_POST['clientName'];
$phoneNumber = $_POST['phoneNumber'];
$Supplier = $_POST['Supplier'];
$deleteCase = $_POST['deleteCase'];


if ($FixStatus == null || $FixStatus == '') {
    $FixStatus = null;
    $FixDescription = null;
}

$isCaseClosed = false;
$result = $mysqli->query("SELECT `Status`, `CaseClosedAt` FROM `cases` WHERE Casenumber = $id");
$row = $result->fetch_assoc();
if ($row['Status'] == "CLOSED") {
    $isCaseClosed = true;
}


if ($deleteCase == "YES" && $isCaseClosed == true) {
    $sql = "DELETE FROM cases WHERE Casenumber=$id";
    if ($mysqli->query($sql) === true) {
        echo "Case has been deleted.";
        header("Location: $domain");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
} else {
    $sql = "UPDATE `cases` SET `clientName` = '$clientName', `Status` = '$Status', `Fixed` = '$FixStatus', `Fixed Description` = '$FixDescription', `phoneNumber` = '$phoneNumber', `Supplier` = '$Supplier' WHERE `cases`.`Casenumber` = $id";

    if ($mysqli->query($sql) === true) {
        echo "Case has been updated.";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

if ($Status == 'CLOSED' && $isCaseClosed == false) {
    $sql = "UPDATE cases SET CaseClosedAt = CURRENT_DATE WHERE Casenumber = $id";
    if ($mysqli->query($sql) === true) {
        echo "Case has been closed.";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

//Send sms if case has been resolved.

header("Location: ../panel.php");
$mysqli->close();
  exit();
?>

