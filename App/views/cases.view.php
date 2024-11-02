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


    <?php loadPartial("header"); ?>



    <section class="section is-title-bar">
      <div class="level">
        <div class="level-left">
          <div class="level-item">
            <ul>
              <li>Management</li>
              <li>Cases</li>
            </ul>
          </div>
        </div>
        <div class="level-right">
          <div class="level-item">
            <div class="buttons is-right">
              <a href="case" class="button is-primary">
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
            <div class="level-item">
              <h1 class="title">
                All cases - <?php echo $openCases + $closedCases ?> 
              </h1>
            </div>
          </div>
          <div class="level-right" style="display:flex;">
            <div class="level-item">
              <!-- Cases filter by role -->
              <div class="dropdown field-body" id="dropdown-menu" role="menu" title="Filter cases by agents">
              <select class="dropdown-content field" name="filterByUser" id="filterByUser">
              <?php foreach ($users as $user) { ?>
                <?php if ($user == $userSelected) { ?>
                <option selected class="dropdown-item"><?php echo $user ?></option>
                
              } <?php continue; } else ?>
              <option class="dropdown-item"><?php echo $user ?></option>
               <?php } ?>
              </select>  
              </div>



            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="section is-main-section">

      <!--<div class="notification is-info">
      <div class="level">
        <div class="level-left">
          <div class="level-item">
            <div>
              <span class="icon"><i class="mdi mdi-buffer default"></i></span>
              <b>Notification</b>
            </div>
          </div>
        </div>
        <div class="level-right">
          <button type="button" class="button is-small is-white jb-notification-dismiss">Dismiss</button>
        </div>
      </div>
    </div>-->

      <div class="card has-table">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
            Open cases - <?php echo $openCases ?> 
          </p>
          <a id="openCasesButton" class="card-header-icon">
            <span class="icon mdi mdi-minus"></span>
          </a>
        </header>
        <div class="card-content1">
          <div class="b-table has-pagination">
            <div class="table-wrapper has-mobile-cards">
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
              <table id="openCasesTable" class="table is-fullwidth is-striped is-hoverable is-fullwidth">
                <script>
                  //if the screen is mobile
                  if (window.matchMedia("(max-width: 768px)").matches) {
                    document.write("<thead>");
                  } else {
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
                  <th>Agent</th>
                  <th></th>
                </tr>
                <script>
                  //if the screen is mobile
                  if (window.matchMedia("(max-width: 768px)").matches) {
                    document.write("</thead>");
                    document.write("<tbody>");
                  } else {
                    //document.write("</tbody>");
                  }
                </script>
                <?php
    foreach ($cases as $case) {
        if($userSelected == "All")
          {null;}  
        else if($case->Createdby != $userSelected)
          continue;
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
                  <td data-label="Name"><div style='width: 150px;'><?php echo mb_strimwidth(htmlspecialchars($case->clientName), 0, 15, "...") ?> </div>
                  </td>
                  <td data-label="ProductName"><div style='width: 150px;'> <?php echo mb_strimwidth(htmlspecialchars($case->ProductName), 0, 18, "...") ?> </div>
                  </td>
                  <td data-label="ReceiptNumber"><div style='width: 150px;'> <?php echo mb_strimwidth(htmlspecialchars($case->ReciptNumber), 0, 20, "...") ?> </div>
                  </td>
                  <td data-label="Status"><div style='width: 150px;'> <?php echo htmlspecialchars($case->Status); ?> </div>
                  </td>
                  <td data-label="Supplier"><div style='width: 150px;'> <?php echo mb_strimwidth(htmlspecialchars($case->Supplier), 0, 18, "...") ?> </div>
                  </td>
                  <td data-label="Created"> <div style='width: 150px;'>
                    <?php $date = $case->CreatedAt;
        //format date to dd/mm/yyyy
        $date = date('d/m/Y', strtotime($date)); ?>
                    <small class="has-text-grey is-abbr-like" title="Oct 25, 2020"><?php echo htmlspecialchars($date); ?></small>
                  </div>
                  </td>
                  <td data-label="Agent"><div style='width: 150px;'> <?php echo mb_strimwidth(htmlspecialchars($case->Createdby), 0, 18, "...") ?> </div>
                  </td>
                  <td class="is-actions-cell"> <div style='width: 150px;'>
                    <div class="buttons is-right">
                      <a class="button is-rounded is-small is-primary"
                        href="case/<?php echo htmlspecialchars($case->Casenumber); ?>">
                        <span class="icon"><i class="mdi mdi-eye"></i></span> &nbsp; Open case >>
                      </a>
                    </div>
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
      <div class="card has-table">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
            Closed cases - <?php echo $closedCases ?> 
          </p>
          <a class="card-header-icon" id="closedCasesButton">
            <span class="icon mdi mdi-minus"></span>
          </a>
        </header>
        <div class="card-content">
          <div class="b-table has-pagination">
            <div class="table-wrapper has-mobile-cards">
              <?php
              if ($closedCases == 0 || $closedCases == null) { ?>
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
                <table id="closedCasesTable" class="table is-fullwidth is-striped is-hoverable is-fullwidth" >
                <script>
                  //if the screen is mobile
                  if (window.matchMedia("(max-width: 768px)").matches) {
                    document.write("<thead>");
                  } else {
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
                  <th>Agent</th>
                  <th></th>
                </tr>
                <script>
                  //if the screen is mobile
                  if (window.matchMedia("(max-width: 768px)").matches) {
                    document.write("</thead>");
                    document.write("<tbody>");
                  } else {
                    // document.write("</tbody>");
                  }
                </script>

                <?php
                
                  foreach ($cases as $case) {
                    if($userSelected == "All")
                      {null;}  
                    else if($case->Createdby != $userSelected)
                      continue;
                    if ($case->Status != 'CLOSED') {
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
                  <td data-label="Name"><div style='width: 150px;'> <?php echo mb_strimwidth(htmlspecialchars($case->clientName), 0, 15, "...") ?> </div>
                  </td>
                  <td data-label="ProductName"><div style='width: 150px;'> <?php echo mb_strimwidth(htmlspecialchars($case->ProductName), 0, 18, "...") ?> </div>
                  </td>
                  <td data-label="ReceiptNumber"><div style='width: 150px;'> <?php echo mb_strimwidth(htmlspecialchars($case->ReciptNumber), 0, 20, "...") ?> </div>
                  </td>
                  <td data-label="Status"><div style='width: 150px;'> <?php echo htmlspecialchars($case->Status) ?> </div>
                  </td>
                  <td data-label="Supplier"><div style='width: 150px;'> <?php echo mb_strimwidth(htmlspecialchars($case->Supplier), 0, 18, "...") ?> </div>
                  </td>
                  <td data-label="Created"> <div style='width: 150px;'>
                    <?php $date = $case->CreatedAt;
                      //format date to dd/mm/yyyy
                      $date = date('d/m/Y', strtotime($date)); ?>
                    <small class="has-text-grey is-abbr-like" title="Oct 25, 2020"><?php echo htmlspecialchars($date); ?></small>
                    </div>
                  </td>
                  <td data-label="Agent"><div style='width: 150px;'> <?php echo mb_strimwidth(htmlspecialchars($case->Createdby), 0, 18, "...") ?>
                  </div>  
                  </td>
                  <td class="is-actions-cell"> <div style='width: 150px;'>
                    <div class="buttons is-right">
                    <a class="button is-rounded is-small is-primary"
                        href="case/<?php echo htmlspecialchars($case->Casenumber); ?>">
                        <span class="icon"><i class="mdi mdi-eye"></i></span> &nbsp; Open case >>
                      </a>
                    </div>
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
    </section>

    <?php loadPartial('footer'); ?>
  </div>

  <!-- Table scripts -->
  <script>
    //minify table if user pressed the button
    var openTable = document.getElementById("openCasesTable");
    var closedTable = document.getElementById("closedCasesTable");
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
    var closedCasesButton = document.getElementById("closedCasesButton");
    closedCasesButton.addEventListener("click", function() {
      //check if table is hidden
      if (closedTable.classList.contains("is-hidden")) {
        //if hidden, show it
        //change button child to close icon
        //change icon for the child
        closedCasesButton.firstElementChild.classList.remove("mdi-plus");
        closedCasesButton.firstElementChild.classList.add("mdi-minus");
        closedTable.classList.remove("is-hidden");
      } else {
        //if visible, hide it
        closedCasesButton.firstElementChild.classList.add("mdi-plus");
        closedCasesButton.firstElementChild.classList.remove("mdi-minus");
        closedTable.classList.add("is-hidden");
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
        .forEach(tr => table.appendChild(tr));


    })));
  </script>
  
  <!-- Filter users script -->
  <script>
  document.getElementById('filterByUser').addEventListener('change', function() {
    const urlParams = new URLSearchParams(window.location.search);
    urlParams.set('agentFilter', this.value);
    window.location.search = urlParams;
  });
  </script>


  <style>
    table,
    th,
    td {
      border: 1px solid black;
    }

    th {
      cursor: pointer;
      user-select: none;
    }
  </style>
</body>
</html>