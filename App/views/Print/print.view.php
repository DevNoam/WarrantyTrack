<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Print case - <?php echo $case['Casenumber'] ?></title>
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
                    <b><p><?php echo $store['StoreName'] ?></p></b>
                    <p><?php echo $store['Address'] ?></p>
                    <p>Tel: <?php echo $store['Phone'] ?></p>
                    <p>Email: <?php echo $store['Email'] ?></p>

                </div>
                <div class="image is-128x128">
                    <img src="<?php echo $store['Logo'] ?>" alt="logo">
                </div>
            </div>
            <hr>
            <div class="container is-flex" id="header-Info" style="justify-content: space-between">
                <div class="subtitle">
                    <b><p>Customer Name: </br> <?php echo $case['clientName'] ?></p></b>
                    <b><p>Tel: <?php echo $case['phoneNumber'] ?></p></b>
                    <p>Address: </br> <?php echo $case['Address'] ?></p>
                </div>
                <div class="subtitle">
                    <b><p>Order number: <?php echo $case['ReciptNumber'] ?></p></b>
                    <p>Agent: <?php echo $case['Createdby'] ?></p>
                </div>
                <div class="subtitle">
                    <b><p>Open date: <?php echo date("d/m/Y", strtotime($case['CreatedAt'])); ?></p></b>
                    <p>Order date: <?php echo date("d/m/Y", strtotime($case['OrderDate'])); ?></p>
                </div>
            </div>
            <hr>
            <div class="container is-flex" id="header-Info" style="justify-content: center">
                <div class="subtitle">
                   <u><b><p>Customer inquiry: <?php echo $case['Casenumber'] ?></p></b></u>
                </div>
            </div>
            <br>
            <div class="container is-flex" id="header-Info" style="justify-content: center">
                <div class="subtitle">
                    <b><p>Product Name: <?php echo $case['ProductName'] ?></p></b>
                    <b><p>Product SKU: <?php echo $case['ProductSKU']; ?></p></b>
                    <?php if ($case['ProductSerial'] != null) { ?>
                        <b><p>Product Serial: <?php echo $case['ProductSerial']; ?></p></b>
                    <?php } ?>
                    <b><p>Status: <?php echo $case['Status'] ?></p></b>
                    <p>Supplier: <?php echo $case['Supplier']; ?></p>
                </div>
                <div class="subtitle">
                </div>
            </div>
            <br>
            <div class="container is-flex" id="header-Info" style="justify-content: center">
                <div class="subtitle has-text-centered">
                    <b><p>Case description</p></b>
                    <p><?php echo $case['CaseDescription']; ?></p>
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