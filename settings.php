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
    //get settings data
    $sqlData = "SELECT * FROM `settings`";
    $result = mysqli_query($mysqli, $sqlData);
    $settings = mysqli_fetch_array($result, MYSQLI_ASSOC);
?>


<!DOCTYPE html>
<html lang="en" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WarrantyTrack- Settings</title>

  <!-- Bulma is included -->
  <link rel="stylesheet" href="css/main.min.css">

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
</head>

<body>
  <div id="app">
    <?php include 'header.php'; ?>

    <section class="section is-title-bar">
      <div class="level">
        <div class="level-left">
          <div class="level-item">
            <ul>
              <li>Admin</li>
              <li>Settings</li>
            </ul>
          </div>
        </div>
        <div class="level-right">

        </div>
      </div>
    </section>
    <section class="hero is-hero-bar">
      <div class="hero-body">
        <div class="level">
          <div class="level-left">
            <div class="level-item">
              <h1 class="title">
                Edit system settings</i>
              </h1>
            </div>
          </div>
          <div class="level-right" style="display: none;">
            <div class="level-item"></div>
          </div>
        </div>
      </div>
    </section>
    <section class="section is-main-section">
      <div class="card">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-lock default"></i></span>
            Edit dashboard settings
          </p>
        </header>
        <div class="card-content">
          <form method="POST" id="panelFetch" action="API/settings/updateFetchNewCases.php">
            <div class="field is-horizontal" title="This property is saved locally.">
              <div class="field-label is-normal">
                <label class="label">Days to show on dashboard graph</label>
              </div>
              <div class="dropdown field-body" id="dropdown-menu" role="menu">
                <select class="dropdown-content field" name="fetchNewcasesN" id="fetchNewcasesN">
                  <?php $enum = [7, 10, 15, 30, 60, 80, 120, 365]; ?>
                  <?php foreach ($enum as $value) { ?>
                  <?php if (isset($_COOKIE['fetchNewcases']) && $value == $_COOKIE['fetchNewcases']) { ?>
                  <option selected="selected" class="dropdown-item"><?php echo $_COOKIE['fetchNewcases']; ?></option>
                  <?php } else if(empty($_COOKIE['fetchNewcases']) && $value == 10) { ?>
                  <option selected="selected" class="dropdown-item">10</option>
                  <?php } else { ?>
                  <option class="dropdown-item"><?php echo $value; ?></option>
                  <?php }} ?>
                </select>
              </div>
            </div>
            <hr>
            <div class="field is-horizontal">
              <div class="field-label is-normal"></div>
              <div class="field-body">
                <div class="field">
                  <div class="control">
                    <button type="submit" id="submit2" class="button is-primary">
                      Submit
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      <?php if ($userRole == "Admin"){?>
      <div class="tile is-ancestor">
        <!-- WEBSITE DOMAIN -->
        <div class="tile is-parent">
          <div class="card tile is-child">
            <header class="card-header">
              <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-link default"></i></span>
                Edit website Domain
              </p>
            </header>
            <div class="card-content">
              <form method="post" action="">

                <div class="field is-horizontal" <?php if ($userRole != "Admin") { ?>
                  title="Can be changed by adminstrator only." <?php } ?>>
                  <div class="field-label is-normal">
                    <label class="label">Domain</label>
                  </div>
                  <?php if ($userRole != "Admin") { ?>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <input type="input" readonly value="<?php echo $domain ?>" name="domainField" class="input">
                      </div>
                    </div>
                  </div>
                  <?php } else { ?>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <input type="url" autocomplete="on" name="domainField" value="<?php echo $domain ?>" class="input">
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                </div>
                <hr>
                <div class="field is-horizontal">
                  <div class="field-label is-normal"></div>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <button type="submit" id="submitDomain" class="button is-primary">
                          Submit
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Time to delete cases -->

        <div class="tile is-parent">
          <div class="card tile is-child">
            <header class="card-header">
              <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-delete default"></i></span>
                Time to delete old cases
              </p>
            </header>
            <div class="card-content">
            <form method="POST" id="timeToDelete" action="API/settings/updateTimetodeletecases.php">
                <div class="field is-horizontal" <?php if ($userRole != "Admin") { ?>
                  title="Can be changed by adminstrator only." <?php } ?>>
                  <div class="field-label is-normal">
                    <label class="label">Delete every:</label>
                  </div>
                  <div class="dropdown field-body" id="dropdown-menu" role="menu">
                    <select class="dropdown-content " name="timeToDeleteCasesField" id="timeToDeleteCasesField">
                      <?php $enum = ['NEVER', 90, 120, 180, 365]; ?>
                      <?php foreach ($enum as $value) { ?>
                      <?php if ($value == $timeTodeletecase) { ?>
                      <option selected="selected" class="dropdown-item"><?php echo $timeTodeletecase; ?></option>
                      <?php } else { ?>
                      <option class="dropdown-item"><?php echo $value; ?></option>
                      <?php }} ?>
                    </select>
                  </div>
                </div>
                <hr>
                <div class="field is-horizontal">
                  <div class="field-label is-normal"></div>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <button type="submit" id="submit" class="button is-primary">
                          Submit
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>

        
      </div>
      <div class="tile is-parent">
          <div class="card tile is-child">
            <header class="card-header">
              <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-store default"></i></span>
                Store info
              </p>
            </header>
            <div class="card-content">
            <form method="POST" id="storeSettings" action="API/settings/updateStore.php">
                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Store Name:</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <input type="text" autocomplete="on" name="storeName" value="<?php echo $settings['StoreName'] ?>" class="input" required>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Store Address:</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <input type="text" autocomplete="on" name="storeAddress" value="<?php echo $settings['Address'] ?>" class="input" required>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Store Phone:</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <input type="phone" autocomplete="on" name="storePhone" value="<?php echo $settings['Phone'] ?>" class="input" required>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Store Email:</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <input type="Email" autocomplete="on" name="storeEmail" value="<?php echo $settings['Email'] ?>" class="input" required>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Store logo:</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <input type="url" autocomplete="on" name="storeLogo" value="<?php echo $settings['Logo'] ?>" class="input" required>
                      </div>
                    </div>
                  </div>
                </div>

                <hr>
                <div class="field is-horizontal">
                  <div class="field-label is-normal"></div>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <button type="submit" id="submit" class="button is-primary">
                          Submit
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      <?php } ?>
    </section>



    <?php include('footer.php'); ?>
  </div>

  <!-- Scripts below are for demo only -->
  <script type="text/javascript" src="js/main.min.js"></script>

  <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
  <script src="https://malsup.github.io/jquery.form.js"></script>
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
  <script>
    // wait for the DOM to be loaded 
    $(document).ready(function () {
      // bind 'myForm' and provide a simple callback function 
      $('#timeToDelete').ajaxForm(function () {
        //refresh the select element with new options
        var notification = alertify.notify('<i class="mdi mdi-progress-check"></i> Success', 'success', 3,
          function () {});
      });
      $('#storeSettings').ajaxForm(function () {
        //refresh the select element with new options
        var notification = alertify.notify('<i class="mdi mdi-progress-check"></i> Success', 'success', 3,
          function () {});
      });
      $('#panelFetch').ajaxForm(function () {
        //refresh the select element with new options
        var notification = alertify.notify('<i class="mdi mdi-progress-check"></i> Success', 'success', 3,
          function () {});
      });
    });


    //if user pressed the submit button
    $('#submitDomain').click(function (e) {
      e.preventDefault();
      //if domainField value is empty
      alertify.confirm('Domain update', "Are you sure you want to update the domain to: <b>" + $('input[name=domainField]').val() +  "</b></br> This might break the system if entered incorrectly!",
       function(){ 
         updateDomain();
         alertify.success('Updated') 
         }, function(){ 
           alertify.error('Cancelled')
           });
      });

    function updateDomain() {
      //get the form data
      var formData = {
        'domainField': $('input[name=domainField]').val(),
      };
      //process the form
      $.ajax({
        type: 'POST',
        url: 'API/settings/updateDomain.php',
        data: formData,
        dataType: 'json',
        encode: true
      }).done(function (data) {
        //if process.php returned 1/true (send mail success)
        if (data.response == 'success') {
          //show success message
          var notification = alertify.notify('<i class="mdi mdi-check"></i> Success', 'success', 3,
            function () {});
        } else {
          //show error message
          var notification = alertify.notify('<i class="mdi mdi-close"></i> Error', 'error', 3,
            function () {});
        }
      });
    }

  </script>
</body>

</html>