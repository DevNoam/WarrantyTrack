<?php
session_start();
require_once('API/sqlog.php');
if (!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true) {
  header("Location: index.php");
  exit;
}
  $username = $_SESSION['username'];

  $sqlData = "SELECT *, NULL as `password` FROM `users` WHERE `username` = '$username'";
  $result = mysqli_query($mysqli, $sqlData);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $userRole = $row['role'];
  if($userRole != 'Admin')
    {

    }else
    {
        $result->free();
        $sqlData = "SELECT *, NULL as `password` FROM `users`";
        $result = mysqli_query($mysqli, $sqlData);
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
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


  <?php include ("header.php"); ?>



  <section class="section is-title-bar">
    <div class="level">
      <div class="level-left">
        <div class="level-item">
          <ul>
            <li>Admin</li>
            <li>Settings</li>
            <li>Users</li>
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
            Users management
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
          Existed users
        </p>
        <a href="#" class="card-header-icon" id="usersTableButton">
          <span class="icon mdi mdi-minus"></span>
        </a>
      </header>
      <div class="card-content">
        <div class="b-table has-pagination">
          <div class="table-wrapper has-mobile-cards">

            <?php 
              if($userRole != 'Admin') { ?>
  <section class="section">
    <div class="content has-text-grey has-text-centered">
      <p>
        <span class="icon is-large"><i class="mdi mdi-lock mdi-48px"></i></span>
      </p>
      <p>No privileges..</p></div>
    </section>
  </tr>
  <?php } else { ?>
    <table class="table is-fullwidth is-striped is-hoverable is-fullwidth" id="usersTable">
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
                    <th>ID</th>
                    <th>Username</th>
                    <th>Personal name</th>
                    <th>Role</th>
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

              <?php foreach($users as $user) { ?>
                  <tr>
                    <td class="is-image-cell">
                      <div class="image">
                        <img
                          src="https://ui-avatars.com/api/?background=random&size=256&name=<?php echo $user['username'] ?>&format=svg"
                          class="is-rounded">

                      </div>
                      <td data-label="user ID"><?php echo htmlspecialchars($user['id']); ?>
                    </td>
                    </td>
                    <td data-label="Username"><?php echo htmlspecialchars($user['username']); ?>
                    </td>
                    <td data-label="Personal Name"><?php echo htmlspecialchars($user['Name']); ?>
                    </td>
                    <td data-label="Role"><?php echo $user['role']; ?>
                    </td>
                    <td class="is-actions-cell">
                  <div class="buttons is-right">
                      <?php
                        if ($user['username'] == $username) {
                            ?>
                        <a class="button is-rounded is-small is-primary"
                          href="profile.php">
                          <span class="icon"><i class="mdi mdi-eye"></i></span> &nbsp; OPEN USER >>
                        </a>
                        <?php
                        } else{?>
                        <a class="button is-rounded is-small is-primary"
                          href="otherProfile.php?username=<?php echo htmlspecialchars($user['username']); ?>">
                          <span class="icon"><i class="mdi mdi-eye"></i></span> &nbsp; OPEN USER >>
                        </a>
                    <?php } ?>
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
  <?php include ('footer.php'); ?>


<!-- Scripts below are for demo only -->
<script type="text/javascript" src="js/main.min.js"></script>

<!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

<script>
  //minify table if user pressed the button
  var usersTable = document.getElementById("usersTable");
//add listener to openCasesButton
  var usersTableButton = document.getElementById("usersTableButton");
  usersTableButton.addEventListener("click", function() {
    //check if table is hidden
    if (usersTable.classList.contains("is-hidden")) {
      //if hidden, show it
      //change button child to close icon
      //change icon for the child
      usersTableButton.firstElementChild.classList.remove("mdi-plus");
      usersTableButton.firstElementChild.classList.add("mdi-minus");
      usersTable.classList.remove("is-hidden");
    } else {
      //if visible, hide it
      usersTableButton.firstElementChild.classList.add("mdi-plus");
      usersTableButton.firstElementChild.classList.remove("mdi-minus");
      usersTable.classList.add("is-hidden");
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
