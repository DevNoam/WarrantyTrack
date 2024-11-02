<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WarrantyTrack - Case inspect: <?php echo $case->Casenumber ?>
    </title>
    <link rel="stylesheet" href="/css/bulma.css">
    <script src="/js/bulma.js"></script>
</head>

<body>

    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand ">
            <a class="navbar-item" href="/">
                <h1 class="title">WarrantyTrack -</h1>
                <h2 class="subtitle">&nbsp;Case inspect: <?php echo $case->Casenumber ?>
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
                        <a class="button is-medium is-rounded is-danger" href="/cases" data-tooltip="my link tooltip content">
                            <strong>X</strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

   &nbsp; <button class="button has-background-info is-info" onclick="printPage('/printCase/<?php echo $case->Casenumber ?>')" id="printButton" type="button">Print</button>
    <form action="/API/updateCase" method="POST" name="newform">
        <div class="section has-text-centered hero has-background-grey is-fullheight" id="print-content">
            <div class="columns is-desktop">
                <div class="column is-flex-grow-0">
                    <div class="container" style="width: 500px;">

                        <p class="has-text-left has-text-white"> Case ID:</p>
                        <input class="input" id="CaseID" name="CaseID" readonly type="text"
                            value="<?php echo $case->Casenumber ?>">
                        <div class="block"></div>
                        <p class="has-text-left has-text-white"> Date creation:</p>
                        <input class="input" id="CreatedAt"
                            value="<?php echo $case->CreatedAt ?>"
                            name="CreatedAt" disabled type="text">

                        <div class="block"></div>
                        <?php
                            if ($case->CaseClosedAt != null):
                        ?>
                                <p class='has-text-left has-text-white'>Case closed at:</p>
                                <input class='input' id='CreatedAt' value="<?php echo $case->CaseClosedAt ?>" name='CreatedAt' disabled type='text'>
                                <div class='block'></div>
                        <?php
                            endif;
                        ?>

                        <p class="has-text-left has-text-white"> Created by:</p>
                        <span class="select is-pulled-left">
                            <select id="Createdby" disabled name="Createdby">
                                <option selected><?php echo $case->Createdby ?>
                                </option>
                            </select>
                        </span>

                        <div class="block">&nbsp;</div>
                        <div class="container">
                        <p class="has-text-left has-text-white"> Case status:</p>
                            <span class="select is-pulled-left">
                            <select id="Status" name="Status">
                                <?php foreach ($caseStatusFields as $status): ?>
                                    <option value="<?php echo htmlspecialchars($status); ?>"
                                        <?php echo ($status === $case->Status) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($status); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>                            
                            </span>

                            <div class="block">&nbsp;</div>

                            <p class="has-text-left has-text-white"> Fix status:</p>
                            <span class="select is-pulled-left">
                            <select id="FixStatus" name="FixStatus">
                                <?php foreach ($fixStatusFields as $status): ?>
                                    <option value="<?php echo htmlspecialchars($status); ?>"
                                        <?php echo ($status === $case->Fixed) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($status); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select> 
                            </span>
                            <div class="block">&nbsp;</div>


                            <p class="has-text-left has-text-white">Fix description:</p>
                            <textarea class="textarea" id="FixDescription" name="FixDescription"
                                placeholder=""><?php echo $case->FixedDescription ?></textarea>
                            <div class="block">&nbsp;</div>
                            <?php if ($isAdmin == true) { ?>
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
                            value="<?php echo $case->clientName ?>"
                            name="clientName" type="text" placeholder="John john">
                        <div class="block"></div>
                        <p class="has-text-left has-text-white">* Customer phone:</p>
                        <input class="input" id="phoneNumber"
                            value="<?php echo $case->phoneNumber ?>"
                            name="phoneNumber" type="tel" pattern="[0-9]{10}" placeholder="0500000000">
                        <div class="block"></div>
                        <p class="has-text-left has-text-white">* Customer Address:</p>
                        <input class="input" id="Address" disabled
                            value="<?php echo $case->Address ?>"
                            name="Address" type="text" placeholder="Menachem Begin 1 Tel Aviv Israel">
                        <div class="block"></div>
                        <p class="has-text-left has-text-white">* Receipt number:</p>
                        <input class="input" id="ReciptNumber" disabled
                            value="<?php echo $case->ReciptNumber ?>"
                            name="ReciptNumber" type="text">
                        <div class="block"></div>
                        <p class="has-text-left has-text-white">* Order date:</p>
                        <input class="input" id="OrderDate" disabled
                            value="<?php echo $case->OrderDate ?>"
                            name="OrderDate" type="date">
                        <div class="block"></div>
                    </div>
                </div>

                <div class="column" id="OrderInfo">
                    <div class="container">
                        <p class="has-text-left has-text-white">* Product SKU:</p>
                        <input class="input" id="ProductSKU" disabled
                            value="<?php echo $case->ProductSKU ?>"
                            name="ProductSKU" type="text" placeholder="1005470">
                        <div class="block"></div>
                        <p class="has-text-left has-text-white">* Product Name:</p>
                        <input class="input" id="ProductName" disabled
                            value="<?php echo $case->ProductName ?>"
                            name="ProductName" type="text" placeholder="Xbox one">
                        <div class="block"></div>
                        <p class="has-text-left has-text-white"> Serial:</p>
                        <input class="input" id="ProductSerial" disabled
                            value="<?php echo $case->ProductSerial ?>"
                            name="ProductSerial" type="text" placeholder="Serial number, if any">
                        <div class="block"></div>
                        <p class="has-text-left has-text-white"> Supplier:</p>
                        <input class="input" id="Supplier"
                            value="<?php echo $case->Supplier ?>"
                            name="Supplier" type="text" placeholder="Product Supplier">
                        <div class="block"></div>

                        <p class="has-text-left has-text-white">* Case description:</p>
                        <textarea class="textarea" id="CaseDescription" disabled name="CaseDescription"
                            placeholder="Defected product...."><?php echo $case->CaseDescription ?></textarea>
                    </div>
                </div>


            </div>

        </div>
        <input class="sumbit button is-success is-rounded" type="submit" value="Update">
        </div>
        </div>
    </form>
        <?php
        loadPartial('footer');
        ?>

<script src="https://printjs-4de6.kxcdn.com/print.min.css"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <!--JAVASCRIP-->
    <script type="text/javascript">

    const StatusField = document.getElementById("Status");
    const FixStatusField = document.getElementById("FixStatus");
    const FixDescriptionField = document.getElementById("FixDescription");

    window.onload = (event) => {
        if (StatusField.value != "CLOSED") {
            document.getElementById("deleteCase").style.pointerEvents = "none";
            FixStatusField.style.pointerEvents = "none";
            FixDescriptionField.readOnly = false;

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
            FixDescriptionField.readOnly = false;
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
            FixDescriptionField.readOnly = false;
    }
        });
    </script>
    <script type="text/javascript">
function closePrint () {
  document.body.removeChild(this.__container__);
}

function setPrint () {
  this.contentWindow.__container__ = this;
  this.contentWindow.onbeforeunload = closePrint;
  this.contentWindow.onafterprint = closePrint;
  this.contentWindow.focus(); // Required for IE
  this.contentWindow.print();
}

function printPage (sURL) {
  var oHiddFrame = document.createElement("iframe");
  oHiddFrame.onload = setPrint;
  oHiddFrame.style.visibility = "hidden";
  oHiddFrame.style.position = "fixed";
  oHiddFrame.style.right = "0";
  oHiddFrame.style.bottom = "0";
  oHiddFrame.src = sURL;
  document.body.appendChild(oHiddFrame);
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
        width: 100px;
        box-shadow: 2px 2px 10px 1px rgba(0, 0, 0, 0.58);
        font-size: 15px;
        text-align: center;
    }
</style>
<style type="text/css" media="print">
    @media print {
   body {
   display:table;
   table-layout:fixed;
   padding-top:2.5cm;
   padding-bottom:2.5cm;
   height:auto;
    }
}
    </style>
</html>