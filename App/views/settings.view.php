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
                      <input type="text" autocomplete="on" name="storeName" value="<?php echo $settingsData[0]->StoreName ?>" class="input" required>
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
                      <input type="text" autocomplete="on" name="storeAddress" value="<?php echo $settingsData[0]->Address ?>" class="input" required>
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
                      <input type="phone" autocomplete="on" name="storePhone" value="<?php echo $settingsData[0]->Phone ?>" class="input" required>
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
                      <input type="Email" autocomplete="on" name="storeEmail" value="<?php echo $settingsData[0]->Email ?>" class="input" required>
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
                      <input type="url" autocomplete="on" name="storeLogo" value="<?php echo $settingsData[0]->Logo ?>" class="input" required>
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
                <div class="field is-horizontal"
                  <div class="field-label is-normal">
                    <label title="0 = To never delete" class="label">Delete every days:</label>
                  </div>
                  <div  class="dropdown field-body" id="dropdown-menu" role="menu">
                    <input title="0 = Never delete" type="number" name="timeToDeleteCasesField" value="<?php echo $settingsData[0]->deleteCases ?>" min="0" max="99999" class="input" required>
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