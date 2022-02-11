///////////

Deprecating panel, migrating to a new one

////////////

<?php
session_start();
if (!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true) {
    if ($_SESSION['domain'] == null) {
        header("Location: index.php");
        exit;
    } else {
        header("Location: $domain");
    }
    exit;
}

$username = $_SESSION['username'];

//SQL Data pulling.
require_once('API/sqlog.php');
$sqlData = 'SELECT `Status`,`CreatedAt`,`CaseNumber`,`ProductName`,`clientName`,`ReciptNumber`,`CaseClosedAt`,`Createdby`,`Supplier` FROM cases ORDER BY FIELD(Status, "OPEN", "Waiting for customer", "Waiting for supplier", "Returning from supplier", "Picked by supplier", "Shipped to supplier", "Being checked", "CLOSED"), CreatedAt asc, Supplier, clientName';
$result = mysqli_query($mysqli, $sqlData);
$cases = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
$openCases = 0;

foreach ($cases as $case) {
    if ($case['Status'] != "CLOSED") {
        $openCases++;
    } elseif ($case['Status'] == "CLOSED" && $timeTodeletecase != "NEVER" && $case['CaseClosedAt'] < date('Y-m-d', strtotime("-$timeTodeletecase days"))) {
        $sql = "DELETE FROM cases WHERE Casenumber = $case[CaseNumber]";
        if ($mysqli->query($sql) === true) {
            //echo "Case has been deleted.";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WarrantyTrack - Management panel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <script src="js/bulma.js"></script>
</head>

<body>

    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="panel.php">
                <h1 class="title">WarrantyTrack</h1>
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
                        <!--<a class="button is-medium is-rounded is-info" href="createcase.php">
                            <strong>+</strong>
                        </a>-->
                        <a href="API/logout.php" class="button is-rounded ml-2 is-small is-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>



    <h1 class="subtitle pl-4"><?php echo "Hello  $username, there are $openCases open cases." ?>
    </h1>
    <!--<h2 class="subtitle has-text-danger	has-text-weight-bold pl-4">DO NOT ENTER SENSITIVE DATA!</h2>-->
    <section class="section">
        <div class="table-container">
            <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Created at</th>
                        <th>Case number</th>
                        <th>Product Name</th>
                        <th>Client Name</th>
                        <th>Receipt Number</th>
                        <th>Created by</th>
                        <th>Supplier</th>
                        <th>Access:</th>
                    </tr>
                </thead>
                <!--PHP PULLING-->
                <tbody>
                    <?php foreach ($cases as $case) {
    if ($case['Status'] == "CLOSED") {
        echo "<tr class='has-background-light'>";
    } else {
        echo "<tr class='has-background-white'>";
    } ?>
                    <td>
                        <?php
                                    if ($case['Status'] != "CLOSED") {
                                        echo "<strong>";
                                        echo htmlspecialchars($case['Status']);
                                        echo "</strong>";
                                    } else {
                                        echo htmlspecialchars($case['Status']);
                                    } ?>

                    </td>
                    <td><?php echo htmlspecialchars($case['CreatedAt']); ?>
                    </td>
                    <td><?php echo htmlspecialchars($case['CaseNumber']); ?>
                    </td>
                    <td><?php echo htmlspecialchars($case['ProductName']); ?>
                    </td>
                    <td><?php echo htmlspecialchars($case['clientName']); ?>
                    </td>
                    <td><?php echo htmlspecialchars($case['ReciptNumber']); ?>
                    </td>
                    <td><?php echo htmlspecialchars($case['Createdby']); ?>
                    </td>
                    <td><?php echo htmlspecialchars($case['Supplier']); ?>
                    </td>

                    <td><a class="button is-info is-rounded is-small"
                            href="caseinspect.php?caseID=<?php echo htmlspecialchars($case['CaseNumber']); ?>">
                            Open case >>
                        </a></td>
                    </tr>
                    <?php
} ?>
                </tbody>
            </table>

        </div>
    </section>



    <?php include("footer.php"); ?>

    <a href="createcase.php">
        <button class="sumbit button is-success is-rounded" type="button" value="+">+</button>
    </a>

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