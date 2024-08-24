<!DOCTYPE html>
<html lang="en" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WarrantyTrack</title>

  <link rel="stylesheet" href="css/main.min.css">

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
</head>
<body>
<div id="app">


<?php loadPartial("header"); ?>



  <section class="section is-title-bar">
    <div class="level">
      <div class="level-left">
        <div class="level-item">
          <ul>
            <li>Search</li>
            <li><?php echo "'$searchData'" ?></li>
          </ul>
        </div>
      </div>
      <div class="level-right">
        <div class="level-item">
          <div class="buttons is-right">
            <a href="createcase.php"class="button is-primary">
              <span class="icon"><i class="mdi mdi-plus"></i></span>
              <span>New case</span>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="hero is-hero-bar">
    <div class="hero-body">
      <div class="level">
        <div class="level-left">
          <div class="level-item"><h1 class="title">
            Found <?php echo $resultCheck ?> cases
          </h1></div>
        </div>
        <div class="level-right" style="display: none;">
          <div class="level-item"></div>
        </div>
      </div>
    </div>
  </section>




  <div class="card has-table">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
          Cases found
        </p>
        <a href="#" id="openCasesButton" class="card-header-icon">
          <span class="icon mdi mdi-minus"></span>
        </a>
      </header>
      <div class="card-content1">
        <div class="b-table has-pagination">
          <div class="table-wrapper has-mobile-cards">
            <?php 
              if($resultCheck <= 0  || $resultCheck == null) { ?>
  <section class="section">
    <div class="content has-text-grey has-text-centered">
      <p>
        <span class="icon is-large"><i class="mdi mdi-emoticon-sad mdi-48px"></i></span>
      </p>
      <p>Nothing's here…</p></div>
    </section>
  </tr>
  <?php } else { ?>
    <table id="openCasesTable" class="table is-fullwidth is-striped is-hoverable is-fullwidth">
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
                    <th>Case ID</th>
                    <th>Agent</th>
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
              <?php 
    foreach ($cases as $case) { 
            if ($case['Casenumber'] == "$searchData") {
                echo "<script>window.location.href = 'caseinspect.php?caseID=$searchData'; </script>";
            }
                ?>
                  <tr>
                    <td class="is-image-cell">
                      <div class="image">
                        <img
                          src="https://ui-avatars.com/api/?background=random&size=256&name=<?php echo $case['clientName'] ?>&format=svg"
                          class="is-rounded">

                      </div>
                    </td>
                    <td data-label="Name"><?php echo htmlspecialchars($case['clientName']); ?>
                    </td>
                    <td data-label="ProductName"><?php echo htmlspecialchars($case['ProductName']); ?>
                    </td>
                    <td data-label="ReceiptNumber"><?php echo htmlspecialchars($case['ReciptNumber']); ?>
                    </td>
                    <td data-label="Status"><?php echo htmlspecialchars($case['Status']); ?>
                    </td>
                    <td data-label="Supplier"><?php echo htmlspecialchars($case['Supplier']); ?>
                    </td>
                    <td data-label="Created">
                      <?php $date = $case['CreatedAt'];
                    //format date to dd/mm/yyyy
                    $date = date('d/m/Y', strtotime($date)); ?>
                      <small class="has-text-grey is-abbr-like" title="Oct 25, 2020"><?php echo htmlspecialchars($date); ?></small>
                    </td>
                    <td data-label="Case ID"><?php echo htmlspecialchars($case['Casenumber']); ?>
                    </td>
                    <td data-label="Case ID"><?php echo htmlspecialchars($case['Createdby']); ?>
                    </td>
                    <td class="is-actions-cell">
                      <div class="buttons is-right">
                        <a class="button is-rounded is-small is-primary"
                          href="caseinspect.php?caseID=<?php echo htmlspecialchars($case['Casenumber']); ?>">
                          <span class="icon"><i class="mdi mdi-eye"></i></span> &nbsp; Cases found >>
                        </a>
 
                      </div>
                    </td>
                  </tr>
                  <?php
                }
            } ?>
 
              </tbody>

            </table>
          </div>
        </div>
      </div>
    </div>



  
    <?php loadPartial("footer"); ?>


</div>

<!-- Scripts below are for demo only -->
<script type="text/javascript" src="js/main.min.js"></script>

<!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

<script>



  //minify table if user pressed the button
  var openTable = document.getElementById("openCasesTable");
//add listener to openCasesButton
  var openCasesButton = document.getElementById("openCasesButton");
  openCasesButton.addEventListener("click", function() {
    //check if table is hidden
    if (openTable.classList.contains("is-hidden")) {
      //if hidden, show it
      //change button child to close icon
      //change icon for the child
      openCasesButton.firstElementChild.classList.remove("mdi-plus");
      openCasesButton.firstElementChild.classList.add("mdi-minus");
      openTable.classList.remove("is-hidden");
    } else {
      //if visible, hide it
      openCasesButton.firstElementChild.classList.add("mdi-plus");
      openCasesButton.firstElementChild.classList.remove("mdi-minus");
      openTable.classList.add("is-hidden");
    }
  });

  //table.style.display = "none";

  const getCellValue = (tr, idx) => tr.children[idx].innerText || tr.children[idx].textContent;

const comparer = (idx, asc) => (a, b) => ((v1, v2) => 
    v1 !== '' && v2 !== '' && !isNaN(v1) && !isNaN(v2) ? v1 - v2 : v1.toString().localeCompare(v2)
    )(getCellValue(asc ? a : b, idx), getCellValue(asc ? b : a, idx));

// do the work...
document.querySelectorAll('th').forEach(th => th.addEventListener('click', (() => {
    var table = th.closest('tbody');
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
    cursor: pointer;
    user-select: none;
}
  </style>

</body>
</html>