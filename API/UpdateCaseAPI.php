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



if($deleteCase == "YES")
{
  $sql = "DELETE FROM cases WHERE Casenumber=$id";
if ($mysqli->query($sql) === TRUE) {
    echo "Case has been deleted.";
  } else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
  }
}
else
{
$sql = "UPDATE `cases` SET `clientName` = '$clientName', `Status` = '$Status', `Fixed` = '$FixStatus', `Fixed Description` = '$FixDescription', `phoneNumber` = '$phoneNumber', `Supplier` = '$Supplier'  WHERE `cases`.`Casenumber` = $id";
if ($mysqli->query($sql) === TRUE) {
    echo "Case has been updated.";
    header("Location: http://api.noamsapir.me/Experiments/WarrantyTrack/");
  } else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
  }

  //Send sms if case has been resolved.
}

  $mysqli->close();
  exit();
?>

