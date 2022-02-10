<?php
  require_once('API/sqlog.php');
  require_once("API/getStats.php");
  session_start();
  if(!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true){
    header("Location: $domain");
      exit;   
  }
  
  
  $username = $_SESSION['username'];
  
  //SQL Data pulling.
  $sqlData = 'SELECT `Status`,`CreatedAt`,`CaseNumber`,`ProductName`,`clientName`,`ReciptNumber`,`Createdby`,`Supplier` FROM cases ORDER BY FIELD(Status, "OPEN", "Waiting for customer", "Waiting for supplier", "Returning from supplier", "Picked by supplier", "Shipped to supplier", "Being checked", "CLOSED"), CreatedAt asc, Supplier, clientName';
  $result = mysqli_query($mysqli, $sqlData);
  $cases = mysqli_fetch_all($result, MYSQLI_ASSOC);


  $openCases = 0;
  $closedCases = 0;


  foreach($cases as $case) {
    if($case['Status'] != "CLOSED")
    {$openCases++;}
    else if($case['Status'] == 'CLOSED')
    {$closedCases++;}
    else if($case['Status'] == "CLOSED" && $timeTodeletecase != "NEVER" && $case['CaseClosedAt'] < date('Y-m-d', strtotime("-$timeTodeletecase days")))
    {
        $sql = "DELETE FROM cases WHERE Casenumber = $case[CaseNumber]";
        if ($mysqli->query($sql) === TRUE) {
            //echo "Case has been deleted.";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    }
}
  $fetchNewcases = 10; //Fetch the new cases created in the last X days.
?>



<!DOCTYPE html>
<html lang="en" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WarrantyTrack</title>

  <!-- Bulma is included -->
  <link rel="stylesheet" href="css/main.min.css">

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
</head>
<body>
<div id="app">

<?php include("header.php"); ?>

  

  <section class="section is-title-bar">
    <div class="level">
      <div class="level-left">
        <div class="level-item">
          <ul>
            <li>Admin</li>
            <li>Dashboard</li>
          </ul>
        </div>
      </div>

    </div>
  </section>
  <section class="hero is-hero-bar">
    <div class="hero-body">
      <div class="level">
        <div class="level-left">
          <div class="level-item"><h1 class="title">
            Dashboard
          </h1></div>
        </div>
        <div class="level-right" style="display: none;">
          <div class="level-item"></div>
        </div>
      </div>
    </div>
  </section>
  <section class="section is-main-section">
    <div class="tile is-ancestor">
      <div class="tile is-parent">
        <div class="card tile is-child">
          <div class="card-content">
            <div class="level is-mobile">
              <div class="level-item">
                <div class="is-widget-label"><h3 class="subtitle is-spaced">
                  Open cases
                </h3>
                  <h1 id="openCasesnum" class="title">
                    0
                  </h1>
                </div>
              </div>
              <div class="level-item has-widget-icon">
                <div class="is-widget-icon"><span class="icon has-text-danger is-large"><i
                    class="mdi mdi-progress-alert mdi-48px"></i></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tile is-parent">
        <div class="card tile is-child">
          <div class="card-content">
            <div class="level is-mobile">
              <div class="level-item">
                <div class="is-widget-label"><h3 class="subtitle is-spaced">
                  Closed
                </h3>
                  <h1 id="closedCasesnum" class="title">
                    0
                  </h1>
                </div>
              </div>
              <div class="level-item has-widget-icon">
                <div class="is-widget-icon"><span class="icon has-text-primary is-large"><i
                    class="mdi mdi-progress-check mdi-48px"></i></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="tile is-parent">
        <div class="card tile is-child">
          <div class="card-content">
            <div class="level is-mobile">
              <div class="level-item">
                <div class="is-widget-label"><h3 class="subtitle is-spaced">
                  Performance
                </h3>
                  <h1 class="title">
                    256%
                  </h1>
                </div>
              </div>
              <div class="level-item has-widget-icon">
                <div class="is-widget-icon"><span class="icon has-text-success is-large"><i
                    class="mdi mdi-finance mdi-48px"></i></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="card">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-finance"></i></span>
          New cases created in the last <?php echo $fetchNewcases ?>
        </p>
        <a href="#" class="card-header-icon">
          <span class="icon"><i class="mdi mdi-reload"></i></span>
        </a>
      </header>
      <div class="card-content">
        <div class="chart-area">
          <div style="height: 100%;">
            <div class="chartjs-size-monitor">
              <div class="chartjs-size-monitor-expand">
                <div></div>
              </div>
              <div class="chartjs-size-monitor-shrink">
                <div></div>
              </div>
            </div>
            <canvas id="big-line-chart" width="2992" height="1000" class="chartjs-render-monitor" style="display: block; height: 400px; width: 1197px;"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="card has-table has-mobile-sort-spaced">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
          Open cases:
        </p>
        <a href="#" class="card-header-icon">
          <span class="icon"><i class="mdi mdi-reload"></i></span>
        </a>
      </header>
      <div class="card-content">
        <div class="b-table has-pagination">
          <div class="table-wrapper has-mobile-cards">
            <table class="table is-fullwidth is-striped is-hoverable is-sortable is-fullwidth">
              <thead>
              <tr>
                <th></th>
                <th>Name</th>
                <th>Product name</th>
                <th>Receipt number</th>
                <th>Status</th>
                <th>Supplier</th>
                <th>Created</th>
                <th></th>
              </tr>
              </thead>
              <tbody>
                    <?php foreach($cases as $case)
                    {
                      if($case['Status'] == 'CLOSED')
                      {
                        continue;
                      }
                    ?>
              <tr>
              <td class="is-image-cell">
                  <div class="image">
                    <img src="https://ui-avatars.com/api/?background=random&size=256&name=<?php echo $case['clientName'] ?>&format=svg" class="is-rounded">
                  
                  </div>
                </td>
                <td data-label="Name"><?php echo htmlspecialchars($case['clientName']); ?></td>
                <td data-label="ProductName"><?php echo htmlspecialchars($case['ProductName']); ?></td>
                <td data-label="ReceiptNumber"><?php echo htmlspecialchars($case['ReciptNumber']); ?></td>
                <td data-label="Status"><?php echo htmlspecialchars($case['Status']); ?></td>
                <td data-label="Supplier"><?php echo htmlspecialchars($case['Supplier']); ?></td>
                <td data-label="Created">
                  <?php $date = $case['CreatedAt'];
                    //format date to dd/mm/yyyy
                    $date = date('d/m/Y', strtotime($date));
                  ?>
                  <small class="has-text-grey is-abbr-like" title="Oct 25, 2020"><?php echo htmlspecialchars($date); ?></small>
                </td>
                <td class="is-actions-cell">
                  <div class="buttons is-right">
                  <a class="button is-rounded is-small is-primary"
                            href="caseinspect.php?caseID=<?php echo htmlspecialchars($case['CaseNumber']); ?>">
                            <span class="icon"><i class="mdi mdi-eye"></i></span> &nbsp; Open case >>
                      </a>
                    <!--<button class="button is-small is-danger jb-modal" data-target="sample-modal" type="button">
                      <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                    </button> -->
                  </div>
                </td>
              </tr>
              <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>


<?php include('footer.php'); ?>
</div>




<div id="sample-modal" class="modal">
  <div class="modal-background jb-modal-close"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Confirm action</p>
      <button class="delete jb-modal-close" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
      <p>This will permanently delete <b>Some Object</b></p>
      <p>This is sample modal</p>
    </section>
    <footer class="modal-card-foot">
      <button class="button jb-modal-close">Cancel</button>
      <button class="button is-danger jb-modal-close">Delete</button>
    </footer>
  </div>
  <button class="modal-close is-large jb-modal-close" aria-label="close"></button>
</div>

<!-- Scripts below are for demo only -->
<script type="text/javascript" src="js/main.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<script type="text/javascript" src="js/chart.min.js"></script>

<!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

<script>
  console.log("1");
  //put open cases into graph
    getData(<?php echo getGraph($fetchNewcases, $mysqli); ?>);

  //make a listener for the id inputSearch
  document.getElementById("inputSearch").addEventListener("keyup", function(event) {
   //detect if user pressed enter key
   //get the value of the input field inputSearch
   if (event.keyCode === 13) {
     var inputValue = document.getElementById("inputSearch").value;
     //if user pressed enter key, prevent default behaviour
     event.preventDefault();
      //make a request to the server
      //change url to the input value
      window.location.href = '<?php echo $domain ?>caseinspect.php?caseID=' + inputValue;
    }
  });

  //Animate the numbers
  closedCasesAnim(<?php echo $closedCases ?>);
  openCasesAnim(<?php echo $openCases ?>);
  function openCasesAnim(casesVar) {
    console.log('1');
    document.getElementById("openCasesnum").classList.add("is-active");
    var openCasesnum = document.getElementById("openCasesnum");
    var cases = casesVar;
    //increment speed by cases
    var openCasesnumInterval = setInterval(function() {
      var currentNum = parseInt(openCasesnum.innerHTML);
      var addvalue = 2;
      if (cases >= 50 && cases <= 99) {
          addvalue = 5;
      }
      else if (cases >= 100 && cases <= 999) {
          addvalue = 13;
      } else if (cases >= 1000 && cases <= 9999) {
          addvalue = 133;
      } else if (cases >= 10000 && cases <= 99999) {
          addvalue = 937;
      } else if (cases > 100000) {
          addvalue = 100000;
      }
      if (currentNum < cases) {
          openCasesnum.innerHTML = currentNum + addvalue;
      } else if (currentNum > cases) {
          openCasesnum.innerHTML = cases;
          clearInterval(openCasesnumInterval);
      }
    }, 0100);
  }
  function closedCasesAnim(casesVar) {
    document.getElementById("closedCasesnum").classList.add("is-active");
    var openCasesnum = document.getElementById("closedCasesnum");
    var speed = 0040;
    var cases = casesVar;
    //increment speed by cases
    var openCasesnumInterval = setInterval(function() {
      var currentNum = parseInt(openCasesnum.innerHTML);
      var addvalue = 1;
      if (cases >= 100 && cases <= 999) {
          addvalue = 13;
      } else if (cases >= 1000 && cases <= 9999) {
          addvalue = 133;
      } else if (cases >= 10000 && cases <= 99999) {
          addvalue = 937;
      } else if (cases > 100000) {
          addvalue = 100000;
      }
      if (currentNum < cases) {
          openCasesnum.innerHTML = currentNum + addvalue;
      } else if (currentNum > cases) {
          openCasesnum.innerHTML = cases;
          clearInterval(openCasesnumInterval);
      }
    }, 0100);
  }
</script>


</body>
</html>
