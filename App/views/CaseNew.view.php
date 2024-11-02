<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WarrantyTrack - New case</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <script src="js/bulma.js"></script>
</head>

<body>


    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand ">
            <a class="navbar-item" href="/">
                <h1 class="title">WarrantyTrack -</h1>
                <h2 class="subtitle">&nbsp;New case</h2>
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
                        <a class="button is-medium is-rounded is-danger" onclick="javascript:history.back()">
                            <strong>X</strong>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <form action="/API/createCase" method="POST" name="newform">
        <div class="section has-text-centered hero has-background-grey is-fullheight" id="print-content">
            <div class="columns is-desktop">
                <div class="column is-flex-grow-0">
                    <div class="container" style="width: 500px;">

                        <p class="has-text-left has-text-white"> Date creation:</p>
                        <input class="input" id="CreatedAt" name="CreatedAt" disabled value="<?php echo DATE("d/m/Y") ?>">

                        <p class="has-text-left has-text-white"> Agent name:</p>
                        <span class="select is-pulled-left">
                            <select id="Createdby" name="Createdby">
                                <option selected><?php echo Framework\Session::get('username'); ?> </option>
                                <option>GENERAL</option>
                            </select>
                        </span>
                    </div>
                    <br>
                    <div class="block"></div>
                    <p class="has-text-left has-text-white">* Customer full Name:</p>
                    <input class="input" id="clientName" name="clientName" type="text" required placeholder="John john">
                    <div class="block"></div>
                    <p class="has-text-left has-text-white">* Customer phone:</p>
                    <input class="input" id="phoneNumber" name="phoneNumber" type="tel" pattern="[0-9]{10}" required placeholder="0500000000">
                    <div class="block"></div>
                    <p class="has-text-left has-text-white">* Customer Address:</p>
                    <input class="input" id="Address" name="Address" type="text"placeholder="Menachem Begin 1 Tel Aviv Israel" required>
                    <div class="block"></div>
                    <p class="has-text-left has-text-white"> Case status:</p>
                        <span class="select is-pulled-left">
                        <select id="Status" name="Status">
                                <?php foreach ($caseStatusFields as $status): ?>
                                    <option value="<?php echo $status?>">
                                        <?php echo $status; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select> 
                        </span>
                </div>

                <div class="column" id="customerInfo">
                <div class="container">
                                <p class="has-text-left has-text-white">* Receipt number:</p>
                                <input class="input" id="ReciptNumber" name="ReciptNumber" type="text" required>
                                <div class="block"></div>
                                <p class="has-text-left has-text-white">* Order date:</p>
                                <input class="input" id="OrderDate" name="OrderDate" type="date" required>
                                <div class="block"></div>
                                <p class="has-text-left has-text-white">* Product SKU:</p>
                                <input class="input" id="ProductSKU" name="ProductSKU" type="text" placeholder="1005470"
                                    required>
                                <div class="block"></div>
                                <p class="has-text-left has-text-white">* Product Name:</p>
                                <input class="input" id="ProductName" name="ProductName" type="text"
                                    placeholder="Xbox one" required>
                                <div class="block"></div>
                                <p class="has-text-left has-text-white"> Serial:</p>
                                <input class="input" id="ProductSerial" name="ProductSerial" type="text"
                                    placeholder="Serial number, if any">
                                <div class="block"></div>
                                <p class="has-text-left has-text-white"> Supplier:</p>
                                <input class="input" id="Supplier" name="Supplier" type="text"
                                    placeholder="Product Supplier">
                            </div>
                </div>
                <div class="column" id="CaseDescriptionF">
                            <div class="container">
                                <p class="has-text-left has-text-white">* Case description:</p>
                                <textarea class="textarea" id="CaseDescription" name="CaseDescription"
                                    placeholder="Defected product...." required></textarea>
                            </div>
                        </div>


            </div>

        </div>
        <input class="sumbit button is-success is-rounded" type="submit" value="+">
        </div>
        </div>
    </form>

    <!--JAVASCRIP-->
    <script type="text/javascript">
        function clearForm() {
            document.getElementById('phoneNumber').value = '';
            document.getElementById('clientName').value = '';
            document.getElementById('Address').value = '';
            document.getElementById('ReciptNumber').value = '';
            document.getElementById('OrderDate').value = '';
            document.getElementById('ProductSKU').value = '';
            document.getElementById('ProductName').value = '';
            document.getElementById('ProductSerial').value = '';
            document.getElementById('Supplier').value = '';
            document.getElementById('ProductSerial').value = '';
            document.getElementById('CaseDescription').value = '';
            document.getElementById('ProductSerial').value = '';
            document.getElementById('Status').value = 'OPEN';
            document.getElementById('CaseDescription').value = '';
        }

        //
        "use strict";
        (() => {
            const modified_inputs = new Set;
            const defaultValue = "defaultValue";
            // store default values
            addEventListener("beforeinput", (evt) => {
                const target = evt.target;
                if (!(defaultValue in target || defaultValue in target.dataset)) {
                    target.dataset[defaultValue] = ("" + (target.value || target.textContent)).trim();
                }
            });
            // detect input modifications
            addEventListener("input", (evt) => {
                const target = evt.target;
                let original;
                if (defaultValue in target) {
                    original = target[defaultValue];
                } else {
                    original = target.dataset[defaultValue];
                }
                if (original !== ("" + (target.value || target.textContent)).trim()) {
                    if (!modified_inputs.has(target)) {
                        modified_inputs.add(target);
                    }
                } else if (modified_inputs.has(target)) {
                    modified_inputs.delete(target);
                }
            });
            // clear modified inputs upon form submission
            addEventListener("submit", (evt) => {
                modified_inputs.clear();
                // to prevent the warning from happening, it is advisable
                // that you clear your form controls back to their default
                // state with evt.target.reset() or form.reset() after submission
            });
            // warn before closing if any inputs are modified
            addEventListener("beforeunload", (evt) => {
                if (modified_inputs.size) {
                    const unsaved_changes_warning = "Changes you made may not be saved.";
                    evt.returnValue = unsaved_changes_warning;
                    return unsaved_changes_warning;
                }
            });
        })();
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