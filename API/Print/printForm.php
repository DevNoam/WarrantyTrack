<?php
    //check if user is logged in
    session_start();
    if (!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true) {
        header("Location: ../../index.php");
        exit;
    }
    require_once("../sqlog.php");
    $CaseID = $_GET['CaseID'];
    //get the case information from sql
    $sql = "SELECT * FROM cases WHERE Casenumber = $CaseID";
    //reqiest Query 
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    //get data from settings
    $sql = "SELECT `StoreName`,`Address`,`Phone`,`Email`,`Logo` FROM `settings` WHERE 1";
    $result = $mysqli->query($sql);
    $rowS = $result->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Print case - <?php echo $row['Casenumber'] ?></title>
    <link rel="stylesheet" href="../../css/main.min.css">
</head>
<body>

<section class="hero has-background-grey-darker is-fullheight">
<div class="hero-body">
    <div class="container ">
        <p id="printDate"></p>
        <div class="box" id="printForm">
            <div class="container is-flex" id="header-Info" style="justify-content: space-between">
                <div class="subtitle">
                    <b><p><?php echo $rowS['StoreName'] ?></p></b>
                    <p><?php echo $rowS['Address'] ?></p>
                    <p>Tel: <?php echo $rowS['Phone'] ?></p>
                    <p>Email: <?php echo $rowS['Email'] ?></p>

                </div>
                <div class="image is-128x128">
                    <img src="<?php echo $rowS['Logo'] ?>" alt="logo">
                </div>
            </div>
            <hr>
            <div class="container is-flex" id="header-Info" style="justify-content: space-between">
                <div class="subtitle">
                    <b><p>Customer Name: </br> <?php echo $row['clientName'] ?></p></b>
                    <b><p>Tel: <?php echo $row['phoneNumber'] ?></p></b>
                    <p>Address: </br> <?php echo $row['Address'] ?></p>
                </div>
                <div class="subtitle">
                    <b><p>Order number: <?php echo $row['ReciptNumber'] ?></p></b>
                    <p>Agent: <?php echo $row['Createdby'] ?></p>
                </div>
                <div class="subtitle">
                    <b><p>Open date: <?php echo date("d/m/Y", strtotime($row['CreatedAt'])); ?></p></b>
                    <p>Order date: <?php echo date("d/m/Y", strtotime($row['OrderDate'])); ?></p>
                </div>
            </div>
            <hr>
            <div class="container is-flex" id="header-Info" style="justify-content: center">
                <div class="subtitle">
                   <u><b><p>Customer inquiry: <?php echo $row['Casenumber'] ?></p></b></u>
                </div>
            </div>
            <br>
            <div class="container is-flex" id="header-Info" style="justify-content: center">
                <div class="subtitle">
                    <b><p>Product Name: <?php echo $row['ProductName'] ?></p></b>
                    <b><p>Product SKU: <?php echo $row['ProductSKU']; ?></p></b>
                    <?php if ($row['ProductSerial'] != null) { ?>
                        <b><p>Product Serial: <?php echo $row['ProductSerial']; ?></p></b>
                    <?php } ?>
                    <b><p>Status: <?php echo $row['Status'] ?></p></b>
                    <p>Supplier: <?php echo $row['Supplier']; ?></p>
                </div>
                <div class="subtitle">
                </div>
            </div>
            <br>
            <div class="container is-flex" id="header-Info" style="justify-content: center">
                <div class="subtitle has-text-centered">
                    <b><p>Case description</p></b>
                    <p><?php echo $row['CaseDescription']; ?></p>
                </div>
                <div class="subtitle">
                </div>
            </div>
            <br><br>
            <div class="container is-flex" id="header-Info" style="justify-content: space-evenly">
                <div class="subtitle has-text-centered">
                    <b><p>Customer signature:</p></b>
                    <br><br><br>
                    <p>_____________</p>
                </div>
                <div class="subtitle has-text-centered">
                    <b><p>Agent signature:</p></b>
                    <br><br><br>
                    <p>_____________</p>
                </div>
            </div>
        </div>
    </div>
</div>
</section>
<script>
    //add date to datePrint id
    //create date of the date and hour
    var date = new Date();
    var dateVar = date.getDate() + "/" + (date.getMonth() + 1) + "/" + date.getFullYear() + " " + date.getHours() + ":" + date.getMinutes();
    document.getElementById("printDate").innerHTML = "Printed on: " + dateVar;
</script>
</body>
    <style type="text/css" media="print">
@media print 
{
    @page {
    size: auto;   /* auto is the initial value */
    margin: 0;  /* this affects the margin in the printer settings */
}
}
    </style>
    
</html>