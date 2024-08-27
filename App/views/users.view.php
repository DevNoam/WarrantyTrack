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


<?php loadPartial('header'); ?>

  <section class="section is-title-bar">
    <div class="level">
      <div class="level-left">
        <div class="level-item">
          <ul>
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
            Users list
          </h1></div>
        </div>
        <div class="level-right" style="display: block;">
          <div class="level-item">
            <?php if($userRole == 'Admin') { ?>
          <div class="buttons is-right">
            <!-- Will open new window inside the frame to create new user -->
              <a id="createUserModalButton" href="#" class="button is-primary"> 
                <span class="icon"><i class="mdi mdi-plus"></i></span>
                <span>New user</span>
              </a>
            </div>
            <?php } ?>
          </div>
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
        }
        </script>

              <?php foreach($users as $user) { ?>
                  <tr>
                    <td class="is-image-cell">
                      <div class="image">
                        <img
                          src="https://ui-avatars.com/api/?background=random&size=256&name=<?php echo $user->username ?>&format=svg"
                          class="is-rounded">

                      </div>
                      <td data-label="user ID"><?php echo htmlspecialchars($user->id); ?>
                    </td>
                    </td>
                    <td data-label="Username"><?php echo htmlspecialchars($user->username); ?>
                    </td>
                    <td data-label="Personal Name"><?php echo htmlspecialchars($user->Name); ?>
                    </td>
                    <td data-label="Role"><?php echo $user->role; ?>
                    </td>
                    <td class="is-actions-cell">
                  <div class="buttons is-right">
                        <a class="button is-rounded is-small is-primary"
                          href="profile?id=<?php echo htmlspecialchars($user->id); ?>">
                          <span class="icon"><i class="mdi mdi-eye"></i></span> &nbsp; OPEN USER >>
                        </a>
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
  <div id="modalContainer"></div>
  <?php loadPartial('createUserModal'); ?>
  
  
  <?php loadPartial('footer'); ?>
  
<script>
  //Open create user Modal
  $(document).ready(function () {
    // Open the modal when the button is clicked
    $('#createUserModalButton').on('click', function () {
      $('#accountModal').addClass('is-active');
    });
  });
</script>


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
