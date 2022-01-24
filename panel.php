<?php
session_start();
if(!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true){
    header("location: https://localhost/");
    exit;
}

$username = $_SESSION['username'];

//SQL Data pulling.
require_once('API/sqlog.php');
$sqlData = 'SELECT `Status`,`CreatedAt`,`CaseNumber`,`ProductName`,`clientName`,`ReciptNumber`,`Createdby`,`Supplier` FROM cases ORDER BY FIELD (status, 1, 2, 3),  CreatedAt asc, Supplier';
$result = mysqli_query($mysqli, $sqlData);
$cases = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
$openCases = 0;

foreach($cases as $case)
{
    if($case['Status'] != "CLOSED")
    {$openCases++;}
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
</head>

<body>

    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="#">
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
                        <a class="button is-medium is-rounded is-info" href="createcase.php">
                            <strong>+</strong>
                        </a>
                        <a href="API/logout.php" class="button is-rounded ml-2 is-small is-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>



    <h1 class="subtitle pl-4"><?php echo "Hello  $username, there are $openCases open cases." ?></h1>
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
                    <?php foreach($cases as $case)
                    {
                        if($case['Status'] == "CLOSED")
                        {
                            echo "<tr class='has-background-light'>";
                        }
                        else{
                            echo "<tr class='has-background-white'>";
                        }
                        ?>
                    <td>
                        <?php 
                                    if($case['Status'] != "CLOSED")
                                    {
                                        echo "<strong>";
                                        echo htmlspecialchars($case['Status']); 
                                        echo "</strong>";
                                    }
                                    else{
                                        echo htmlspecialchars($case['Status']); 
                                    }
                                    
                                    ?>

                    </td>
                    <td><?php echo htmlspecialchars($case['CreatedAt']); ?></td>
                    <td><?php echo htmlspecialchars($case['CaseNumber']); ?></td>
                    <td><?php echo htmlspecialchars($case['ProductName']); ?></td>
                    <td><?php echo htmlspecialchars($case['clientName']); ?></td>
                    <td><?php echo htmlspecialchars($case['ReciptNumber']); ?></td>
                    <td><?php echo htmlspecialchars($case['Createdby']); ?></td>
                    <td><?php echo htmlspecialchars($case['Supplier']); ?></td>

                    <td><a class="button is-info is-rounded is-small"
                            href="caseinspect.php?caseID=<?php echo htmlspecialchars($case['CaseNumber']); ?>">
                            Open case >>
                        </a></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
    </section>



<footer class="footer has-text-centered py-1 has-background-dark">
  <div class="content has-text-link-light">
      WarrantyTrack. For Admin control <a href="#">Click here</a>.
  </div>
</footer>

</body>

</html>