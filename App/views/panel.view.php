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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>

<body>
  <div id="app">

    <?php loadPartial("header"); ?>

    <br>
      <section class="hero is-hero-bar">
        <div class="hero-body">
          <div class="level">
          <div class="level-left">
            <div class="level-item">
              <h1 class="title">
                Dashboard
              </h1>
            </div>
          </div>
          <div class="level-right">
            <div class="level-item">
              <div class="buttons is-right">
                <a href="case"class="button is-primary">
                  <span class="icon"><i class="mdi mdi-plus"></i></span>
                  <span>New case</span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section is-main-section">
      <div class="tile is-ancestor">
        <div class="tile is-parent">
          <div class="card tile is-child" title="The number of unresolved/ open cases">
            <div class="card-content">
              <div class="level is-mobile">
                <div class="level-item">
                  <div class="is-widget-label">
                    <h3 class="subtitle is-spaced">
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
          <div class="card tile is-child" title="The number of closed cases">
            <div class="card-content">
              <div class="level is-mobile">
                <div class="level-item">
                  <div class="is-widget-label">
                    <h3 class="subtitle is-spaced">
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
          <div class="card tile is-child" title="The average time it takes to close a case">
            <div class="card-content">
              <div class="level is-mobile">
                <div class="level-item">
                  <div class="is-widget-label">
                    <h3 class="subtitle is-spaced">
                      Average time per case
                    </h3>
                    <h1 id="AvgCasesnum" class="title">
                      0
                    </h1>
                  </div>
                </div>
                <div class="level-item has-widget-icon">
                  <div class="is-widget-icon"><span class="icon has-text-warning-dark is-large"><i
                        class="mdi mdi-clock-outline mdi-48px"></i></span>
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
            <span class="icon"><i class="mdi mdi-finance"></i></span>New cases created in the last &nbsp; <select class="dropdown-content field" name="fetchNewcasesSelector" id="fetchNewcasesSelector">
                  <?php $enum = [7, 10, 15, 30, 60, 80, 120, 365]; ?>
                  <?php foreach ($enum as $value) { ?>
                  <?php if (isset($_COOKIE['fetchNewcases']) && $value == $_COOKIE['fetchNewcases']) { ?>
                  <option value=<?php echo $value; ?> selected="selected" class="dropdown-item"><?php echo $value; ?></option>
                  <?php } else if(empty($_COOKIE['fetchNewcases']) && $value == 7) { ?>
                  <option value=<?php echo $value; ?> selected="selected" class="dropdown-item"><?php echo $value; ?></option>
                  <?php } else { ?>
                  <option value=<?php echo $value; ?> class="dropdown-item"><?php echo $value; ?></option>
                  <?php }} ?>
                </select>
          </p>
          <!-- <a href="#" class="card-header-icon"> 
            <span class="icon"><i class="mdi mdi-reload"></i></span>
          </a> -->
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
              <canvas id="big-line-chart" width="2992" height="1000" class="chartjs-render-monitor"
                style="display: block; height: 400px; width: 1197px;"></canvas>
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
              <?php
              if ($openCases == 0 || $openCases == null) { ?>
              <section class="section">
                <div class="content has-text-grey has-text-centered">
                  <p>
                    <span class="icon is-large"><i class="mdi mdi-emoticon-sad mdi-48px"></i></span>
                  </p>
                  <p>Nothing's here…</p>
                </div>
              </section>
              </tr>
              <?php } else { ?>
        <script>
        //if the screen is mobile
        if (window.matchMedia("(max-width: 768px)").matches) {
            document.write("<thead>");
        }else
        {
            document.write("<tbody>");
        }
        </script>      
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
                  <script>
        //if the screen is mobile
        if (window.matchMedia("(max-width: 768px)").matches) {
            document.write("</thead>");
            document.write("<tbody>");
        }else
        {
            //document.write("</tbody>");
        }
        </script>
            <?php foreach ($cases as $case) {
    if ($case->Status == 'CLOSED') {
        continue;
    } ?>
                  <tr>
                    <td class="is-image-cell">
                      <div class="image">
                        <img
                          src="https://ui-avatars.com/api/?background=random&size=256&name=<?php echo $case->clientName ?>&format=svg"
                          class="is-rounded">

                      </div>
                    </td>
                    <td data-label="Name"><?php echo htmlspecialchars($case->clientName); ?>
                    </td>
                    <td data-label="ProductName"><?php echo htmlspecialchars($case->ProductName); ?>
                    </td>
                    <td data-label="ReceiptNumber"><?php echo htmlspecialchars($case->ReciptNumber); ?>
                    </td>
                    <td data-label="Status"><?php echo htmlspecialchars($case->Status); ?>
                    </td>
                    <td data-label="Supplier"><?php echo htmlspecialchars($case->Supplier); ?>
                    </td>
                    <td data-label="Created">
                      <?php $date = $case->CreatedAt;
                        $date = date('d/m/Y', strtotime($date)); //format date to dd/mm/yyyy ?>
                      <small class="has-text-grey is-abbr-like" title="Oct 25, 2020"><?php echo htmlspecialchars($date); ?></small>
                    </td>
                    <td class="is-actions-cell">
                      <div class="buttons is-right">
                        <a class="button is-rounded is-small is-primary"
                          href="case/<?php echo $case->Casenumber; ?>">
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
                <?php } ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>


    <?php loadPartial('footer'); ?>
  </div>  

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
  <script type="text/javascript" src="js/newchart.js"></script>

  <script>
    //Shrink chart if screen is mobile.
    if (window.innerWidth < 768) {
      document.getElementById("big-line-chart").style.height = "250px";
    }
    
    //get open cases into and print into the graph
    
    //Animate the numbers field on top
    getData( <?php echo $graphValue ?> );
    closedCasesAnim( <?php echo $closedCases ?? 0 ?> );
    openCasesAnim( <?php echo $openCases ?? 0 ?> );
    // avgCasesAnim(<?php echo ceil($avgTime ?? 0) ?>);

    // if fetchNewcasesSelector selector value has changed
    $('#fetchNewcasesSelector').change(function() {
      var fetchNewcasesSelector = document.getElementById("fetchNewcasesSelector");
      document.cookie = "fetchNewcases=" + fetchNewcasesSelector.value;

      window.location.reload();
    });

 

    function openCasesAnim(casesVar) {
      document.getElementById("openCasesnum").classList.add("is-active");
      var openCasesnum = document.getElementById("openCasesnum");
      var cases = casesVar;
      //increment speed by cases
      var openCasesnumInterval = setInterval(function() {
        var currentNum = parseInt(openCasesnum.innerHTML);
        var addvalue = 2;
        if (cases >= 50 && cases <= 99) {
          addvalue = 5;
        } else if (cases >= 100 && cases <= 999) {
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
      }, 0.100);
    }
    function closedCasesAnim(casesVar) {
      document.getElementById("closedCasesnum").classList.add("is-active");
      var Casesnum = document.getElementById("closedCasesnum");
      var cases = casesVar;
      //increment speed by cases
      var CasesnumInterval = setInterval(function() {
        var currentNum = parseInt(Casesnum.innerHTML);
        var addvalue = 2;
        if (cases >= 50 && cases <= 99) {
          addvalue = 5;
        } else if (cases >= 100 && cases <= 999) {
          addvalue = 13;
        } else if (cases >= 1000 && cases <= 9999) {
          addvalue = 133;
        } else if (cases >= 10000 && cases <= 99999) {
          addvalue = 937;
        } else if (cases > 100000) {
          addvalue = 100000;
        }
        if (currentNum < cases) {
          Casesnum.innerHTML = currentNum + addvalue;
        } else if (currentNum > cases) {
          Casesnum.innerHTML = cases;
          clearInterval(CasesnumInterval);
        }
      }, 0.100);
    }
    function avgCasesAnim(casesVar) {
      document.getElementById("AvgCasesnum").classList.add("is-active");
      var Casesnum = document.getElementById("AvgCasesnum");
      var cases = casesVar;
      //increment speed by cases
      var CasesnumInterval = setInterval(function() {
        var currentNum = parseInt(Casesnum.innerHTML);
        var addvalue = 2;
        if (cases >= 50 && cases <= 99) {
          addvalue = 5;
        } else if (cases >= 100 && cases <= 999) {
          addvalue = 13;
        } else if (cases >= 1000 && cases <= 9999) {
          addvalue = 133;
        } else if (cases >= 10000 && cases <= 99999) {
          addvalue = 937;
        } else if (cases > 100000) {
          addvalue = 100000;
        }
        if (currentNum < cases) {
          Casesnum.innerHTML = currentNum + addvalue;
        } else if (currentNum > cases) {
          Casesnum.innerHTML = cases;
          clearInterval(CasesnumInterval);
        }
      }, 0.100);
    }


const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

const comparer = (idx, asc) => (a, b) => ((v1, v2) => 
    v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
    )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

// do the work...
document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
    const table = th.closest('tbody');
    Array.from(table.querySelectorAll('tr:nth-child(n+2)'))
        .sort(comparer(Array.from(th.parentNode.children).indexOf(th), this.asc = !this.asc))
        .forEach(tr => table.appendChild(tr) );
})));

  </script>
  <style>
    table, th, td {
    border: 1px solid black;
}
th {
    cursor:pointer;
    user-select: none;

}
  </style>
</body>

</html>