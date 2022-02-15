<?php

session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if (!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true) {
    header("Location: $domain");
    exit;
}
require_once('API/sqlog.php');

$case = htmlspecialchars($_GET['caseID']);
// Notice the subtraction from $current_id
$query = "SELECT * FROM cases WHERE Casenumber = $case; ";
$queryRole = "SELECT `role` FROM `users` WHERE `username` = '$_SESSION[username]';";

$result = $mysqli->query($query);
$resultRole = $mysqli->query($queryRole);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $Role = $resultRole->fetch_assoc();
} else {
    header("Location: $domain");
}
?>



<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WarrantyTrack - Case inspect: <?php echo $case ?>
    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <script src="js/bulma.js"></script>
</head>

<body>

    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand ">
            <a class="navbar-item" href="index.php">
                <h1 class="title">WarrantyTrack -</h1>
                <h2 class="subtitle">&nbsp;Case inspect: <?php echo $case ?>
                </h2>
            </a>


            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false"
                data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <a class="button is-medium is-rounded is-danger" href="panel.php">
                            <strong>X</strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <button class="button has-background-info is-info" onclick="printDiv('print-content')" type="button">Print</button>

    <form action="API/UpdateCaseAPI.php" method="POST" name="newform">
        <div class="section has-text-centered hero has-background-grey is-fullheight" id="print-content">
            <div class="columns is-desktop">
                <div class="column is-flex-grow-0">
                    <div class="container" style="width: 500px;">

                        <p class="has-text-left has-text-white"> Case ID:</p>
                        <input class="input" id="CaseID" name="CaseID" readonly type="text"
                            value="<?php echo $case ?>">
                        <div class="block"></div>
                        <p class="has-text-left has-text-white"> Date creation:</p>
                        <input class="input" id="CreatedAt"
                            value="<?php echo $row['CreatedAt'] ?>"
                            name="CreatedAt" disabled type="text">

                        <div class="block"></div>

                        <?php
                            if ($row['CaseClosedAt'] != null) {
                                echo("<p class='has-text-left has-text-white'>Case closed at:</p>");
                                echo("<input class='input' id='CreatedAt' value='$row[CaseClosedAt]' name='CreatedAt'
                                disabled type='text'>");
                                echo("<div class='block'></div>");
                            }
                        ?>

                        <p class="has-text-left has-text-white"> Created by:</p>
                        <span class="select is-pulled-left">
                            <select id="Createdby" disabled name="Createdby">
                                <option selected><?php echo $row['Createdby'] ?>
                                </option>
                            </select>
                        </span>

                        <div class="block">&nbsp;</div>
                        <div class="container">
                            <p class="has-text-left has-text-white"> Case status:</p>
                            <span class="select is-pulled-left">
                                <select id="Status" name="Status">
                                    <option>OPEN</option>
                                    <option>CLOSED</option>
                                    <option>Waiting for supplier</option>
                                    <option>Picked by supplier</option>
                                    <option>Returning from supplier</option>
                                    <option>Waiting for customer</option>
                                    <option>Shipped to supplier</option>
                                    <option>Being checked</option>
                                </select>
                            </span>

                            <div class="block">&nbsp;</div>

                            <p class="has-text-left has-text-white"> Fix status:</p>
                            <span class="select is-pulled-left">
                                <select id="FixStatus" name="FixStatus">
                                    <option>Fixed</option>
                                    <option>Supplied new product</option>
                                    <option>Closed by customer</option>
                                    <option>Product is working</option>
                                    <option>Unfixable</option>
                                </select>
                            </span>
                            <div class="block">&nbsp;</div>


                            <p class="has-text-left has-text-white">Fix description:</p>
                            <textarea class="textarea" id="FixDescription" name="FixDescription"
                                placeholder=""></textarea>
                            <div class="block">&nbsp;</div>
                            <?php if ($Role['role'] == "Admin") { ?>
                            <div id="deleteCasediv">
                                <p class="has-text-left has-text-white" title="Available for pre-closed cases only">
                                    Delete case?</p>
                                <span class="select is-pulled-left" title="Available for pre-closed cases only">
                                    <select id="deleteCase" name="deleteCase">
                                        <option selected> </option>
                                        <option>NO</option>
                                        <option>YES</option>
                                    </select>
                                </span>
                            </div>
                            <?php } else {
                        } ?>
                        </div>

                    </div>
                </div>

                <div class="column" id="customerInfo">
                    <div class="container">
                        <p class="has-text-left has-text-white">* Customer full Name:</p>
                        <input class="input" id="clientName"
                            value="<?php echo $row['clientName'] ?>"
                            name="clientName" type="text" placeholder="John john">
                        <div class="block"></div>
                        <p class="has-text-left has-text-white">* Customer phone:</p>
                        <input class="input" id="phoneNumber"
                            value="<?php echo $row['phoneNumber'] ?>"
                            name="phoneNumber" type="tel" pattern="[0-9]{10}" placeholder="0500000000">
                        <div class="block"></div>
                        <p class="has-text-left has-text-white">* Customer Address:</p>
                        <input class="input" id="Address" disabled
                            value="<?php echo $row['Address'] ?>"
                            name="Address" type="text" placeholder="Menachem Begin 1 Tel Aviv Israel">
                        <div class="block"></div>
                        <p class="has-text-left has-text-white">* Receipt number:</p>
                        <input class="input" id="ReciptNumber" disabled
                            value="<?php echo $row['ReciptNumber'] ?>"
                            name="ReciptNumber" type="text">
                        <div class="block"></div>
                        <p class="has-text-left has-text-white">* Order date:</p>
                        <input class="input" id="OrderDate" disabled
                            value="<?php echo $row['OrderDate'] ?>"
                            name="OrderDate" type="date">
                        <div class="block"></div>
                    </div>
                </div>

                <div class="column" id="OrderInfo">
                    <div class="container">
                        <p class="has-text-left has-text-white">* Product SKU:</p>
                        <input class="input" id="ProductSKU" disabled
                            value="<?php echo $row['ProductSKU'] ?>"
                            name="ProductSKU" type="text" placeholder="1005470">
                        <div class="block"></div>
                        <p class="has-text-left has-text-white">* Product Name:</p>
                        <input class="input" id="ProductName" disabled
                            value="<?php echo $row['ProductName'] ?>"
                            name="ProductName" type="text" placeholder="Xbox one">
                        <div class="block"></div>
                        <p class="has-text-left has-text-white"> Serial:</p>
                        <input class="input" id="ProductSerial" disabled
                            value="<?php echo $row['ProductSerial'] ?>"
                            name="ProductSerial" type="text" placeholder="Serial number, if any">
                        <div class="block"></div>
                        <p class="has-text-left has-text-white"> Supplier:</p>
                        <input class="input" id="Supplier"
                            value="<?php echo $row['Supplier'] ?>"
                            name="Supplier" type="text" placeholder="Product Supplier">
                        <div class="block"></div>

                        <p class="has-text-left has-text-white">* Case description:</p>
                        <textarea class="textarea" id="CaseDescription" disabled name="CaseDescription"
                            placeholder="Defected product...."><?php echo $row['CaseDescription'] ?></textarea>
                    </div>
                </div>


            </div>

        </div>
        <input class="sumbit button is-success is-rounded" type="submit" value="Update">
        </div>
        </div>
    </form>
    <footer class="footer has-text-centered py-1 has-background-dark">
        <div class="content has-text-link-light">
            WarrantyTrack - Made by <a href="https://noamsapir.me">Noam Sapir</a>.
        </div>
    </footer>



    <!--JAVASCRIP-->
    <script type="text/javascript">
        var username =
            "<?php echo $_SESSION['username']; ?>";

        const StatusField = document.getElementById("Status");
        const FixStatusField = document.getElementById("FixStatus");
        const FixDescriptionField = document.getElementById("FixDescription");

        const statusInfo = "<?php echo $row['Status'] ?>";
        StatusField.value = statusInfo;
        FixStatusField.value =
        "<?php echo $row['Fixed'] ?>";
        FixDescriptionField.value =
            "<?php echo $row['Fixed Description'] ?>";

        window.onload = (event) => {
            if (StatusField.value != "CLOSED") {
                document.getElementById("deleteCase").style.pointerEvents = "none";
                FixStatusField.style.pointerEvents = "none";
                FixDescriptionField.readOnly = true;

            } else if (StatusField.value == "CLOSED") {
                StatusField.style.pointerEvents = 'none';
                FixStatusField.style.pointerEvents = 'none';
                var f = document.forms['newform'];
                for (var i = 0, fLen = f.length; i < fLen; i++) {
                    f.elements[i].readOnly = true; //As @oldergod noted, the "O" must be upper case
                }
                document.getElementById("deleteCase").style.pointerEvents = "all";
            }
            if (StatusField.value == "Waiting for customer" || StatusField.value == "Returning from supplier")
                FixStatusField.style.pointerEvents = "all";

        }

        document.getElementById("deleteCase").addEventListener('change', (event) => {
            if (event.target.value == "YES") {

            } else if (event.target.value == "NO") {
                var f = document.forms['newform'];
                for (var i = 0, fLen = f.length; i < fLen; i++) {
                    f.elements[i].readOnly = false; //As @oldergod noted, the "O" must be upper case
                }
                FixDescriptionField.readOnly = true;
                StatusField.style.pointerEvents = 'all';
                FixStatusField.style.pointerEvents = 'all';
                document.getElementById("CaseID").readOnly = true;
            }
        });
        StatusField.addEventListener('change', (event) => {
            if (event.target.value == "CLOSED" || event.target.value == "Waiting for customer" || event.target
                .value == "Returning from supplier") {
                FixStatusField.style.pointerEvents = "all";
                FixStatusField.required = true;
                FixDescriptionField.readOnly = false;
            } else {
                FixStatusField.style.pointerEvents = "none";
                FixStatusField.required = false;
                FixDescriptionField.readOnly = true;
            }
        });



        //PRINT PAGE:
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            w = window.open();
            w.document.write(printContents);
            w.print();
            w.close();
        }
    </script>
</body>

<style>
    .sumbit {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 100;
        height: 75px;
        width: 75px;
        box-shadow: 2px 2px 10px 1px rgba(0, 0, 0, 0.58);
        font-size: 20px;
    }
</style>

</html>