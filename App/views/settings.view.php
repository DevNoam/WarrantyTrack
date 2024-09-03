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
    <?php

use Framework\Session;

 loadPartial('header'); ?>

<section class="section is-title-bar">
    <div class="level">
      <div class="level-left">
        <div class="level-item">
          <ul>
            <li>Settings</li>
            <li>System</li>
          </ul>
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

      <div class="tile is-ancestor">
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
                      <input type="text" id="storeName" autocomplete="on" name="storeName" value="<?php echo $settingsData[0]->StoreName ?>" class="input" required>
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
                      <input type="text" id="storeAddress" autocomplete="on" name="storeAddress" value="<?php echo $settingsData[0]->Address ?>" class="input" required>
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
                      <input type="phone" id="storePhone" autocomplete="on" name="storePhone" value="<?php echo $settingsData[0]->Phone ?>" class="input" required>
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
                      <input type="Email" id="storeEmail" autocomplete="on" name="storeEmail" value="<?php echo $settingsData[0]->Email ?>" class="input" required>
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
                      <input type="url" id="storeLogo" autocomplete="on" name="storeLogo" value="<?php echo $settingsData[0]->Logo ?>" class="input" required>
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
                      <button type="submit" id="storeSettingsSubmit" class="button is-primary">
                        Submit
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
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
            <form method="POST" id="timeToDelete">
                <div class="field is-horizontal"
                  <div class="field-label is-normal">
                    <label title="0 = To never delete" class="label">Delete every days:</label>
                  </div>
                  <div  class="dropdown field-body" id="dropdown-menu" role="menu">
                    <input title="0 = Never delete" id="timeToDeleteCasesField" type="number" name="timeToDeleteCasesField" value="<?php echo $settingsData[0]->deleteCases ?>" min="0" max="99999" class="input" required>
                    </select>
                  </div>
                </div>
                <hr>
                <div class="field is-horizontal">
                  <div class="field-label is-normal"></div>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <button type="submit" id="publishTimeToDelete" class="button is-primary">
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

    </section>



    <?php loadPartial('footer'); ?>
  </div>

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> -->
  <!-- <script src="https://malsup.github.io/jquery.form.js"></script> -->
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
  <script>
    // wait for the DOM to be loaded 
    $(document).ready(function () {
      
    });


    // //if user pressed the submit button
    $('#storeSettingsSubmit').click(function (e) {
      e.preventDefault();

      $.ajax({
        type: "POST",
        url: "/API/updateStore",
        data: {
          storeName: $('#storeName').val(),
          storeAddress: $('#storeAddress').val(),
          storePhone: $('#storePhone').val(),
          storeEmail: $('#storeEmail').val(),
          storeLogo: $('#storeLogo').val(),
        },
        success: function (data) {
          alert("Updated");
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert("Error: " + textStatus + " " + errorThrown);
        }
      });
    });

    $('#publishTimeToDelete').click(function (e) {
      e.preventDefault();

      $.ajax({
        type: "POST",
        url: "/API/timeToDeleteOldCases",
        data: {
          timeToDelete: $('#timeToDeleteCasesField').val()
        },
        success: function (data) {
          alert("Updated");
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert("Error: " + textStatus + " " + errorThrown);
        }
      });
    });
        

  </script>
</body>

</html>