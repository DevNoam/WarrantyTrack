<!DOCTYPE html>
<html lang="en" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WarrantyTrack</title>

</head>

<body>
  <div id="app">
    <?php loadPartial('header'); ?>


    <section class="section is-title-bar">
      <div class="level">
        <div class="level-left">
          <div class="level-item">
            <ul>
              <li>Account</li>
              <li>Profile</li>
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
              <h1 class="title" id="profileTitle">
                <?php 
                  if(!empty($userData->username)) 
                  {
                    echo "Edit profile: $userData->username";
                  }
                ?>
              </h1>
            </div>
          </div>
          <div class="level-right">
            <?php if (!$isMe && !empty($userData->username)) { ?>
            <div class="leve  l-item">
              <div class="buttons is-right" id="deleteUser">
                <a class="button is-danger" >
                  <span class="icon"><i class="mdi mdi-trash-can"></i></span>
                  <span>Delete user</span>
                </a>
              </div>
            </div>
            <?php } ?>
          </div>
        </div>
        </div>
    </section>
    <?php if(empty($userData->username)){ ?>
      <section class="section">
    <div class="content has-text-grey has-text-centered">
      <p>
        <span class="icon is-large"><i class="mdi mdi-emoticon-sad mdi-48px"></i></span>
      </p>
      <p>Inexistent user..</p></div>
    </section>
<?php } else{ ?>
    <section class="section is-main-section">
      <div class="tile is-ancestor">
        <div class="tile is-parent">
          <div class="card tile is-child">
            <header class="card-header">
              <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-account-circle default"></i></span>
                Edit Profile
              </p>
            </header>
            <div class="card-content">
              <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <input type="hidden" name="username" value="<?php echo $userData->username ?>" />
              <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Personal Name</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <input type="input" autocomplete="on" id="personalNameField" name="personalNameField"
                          value="<?php echo $userData->Name; ?>"
                          placeholder="example" class="input" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="field is-horizontal" <?php if ($userRole != "Admin") { ?>
                  title="Can be changed by adminstrator only." <?php } ?>>
                  <div class="field-label is-normal">
                    <label class="label">Username</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <input type="input" autocomplete="on" name="usernameField" id="usernameField"
                          value="<?php echo $userData->username ?>"
                          class="input" required>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Role</label>
                  </div>
                  <div class="dropdown field-body" id="dropdown-menu" role="menu">
                    <select class="dropdown-content field" name="roleField" id="roleField">
                      <?php foreach ($rolesList as $roles):
                        if($roles == $userData->role): ?>
                        <option selected="selected" value="<?php echo $roles; ?>" class="dropdown-item"> <?php echo $roles; ?></option>
                          <?php else: ?>
                            <option <?php if($isMe) echo "disabled" ?> value="<?php echo $roles; ?>" class="dropdown-item" ?> <?php echo $roles; ?></option>
                          <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <hr>
                <p class="invalid-feedback" id="userEditError"></p>
                <div class="field is-horizontal">
                  <div class="field-label is-normal"></div>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <button type="submit" name="submitUserEdit" id="submitUserEdit" class="button is-primary">
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
        <div class="tile is-parent">
          <div class="card tile is-child">
            <header class="card-header">
              <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-account default"></i></span>
                Profile
              </p>
            </header>
            <div class="card-content">
              <!--<div class="is-user-avatar image has-max-width is-aligned-center">
              <img src="https://avatars.dicebear.com/v2/initials/john-doe.svg" alt="John Doe">
            </div>
            <hr>-->
              <div class="field">
                <label class="label">Personal Name</label>
                <div class="control is-clearfix">
                  <input type="text" id="personalNameRead" readonly value="<?php echo $userData->Name; ?>" class="input is-static">
                </div>
              </div>
              <hr>
              <div class="field">
                <label class="label">Role</label>
                <div class="control is-clearfix">
                  <input type="text" readonly id="roleRead" value="<?php echo $userData->role; ?>" class="input is-static">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <header class="card-header">
          <p class="card-header-title">
            <span class="icon"><i class="mdi mdi-lock default"></i></span>
            Change Password
          </p>
        </header>
        <div class="card-content">
          <form method="post">
          <input type="hidden" name="userId" value="<?php echo $userData->id ?>" />
          <div class="field is-horizontal">
              <div class="field-label is-normal">
                <label class="label">New password</label>
              </div>
              <div class="field-body">
                <div class="field">
                  <div class="control">
                    <input type="password" autocomplete="new-password" id="password" name="password" class="input"
                      required>
                  </div>
                </div>
              </div>
            </div>
            <div class="field is-horizontal">
              <div class="field-label is-normal">
                <label class="label">Confirm password</label>
              </div>
              <div class="field-body">
                <div class="field">
                  <div class="control">
                    <input type="password" autocomplete="new-password" id="confirmPassword" name="password_confirmation" class="input"
                      required>
                  </div>
                </div>
              </div>
            </div>
            <p class="invalid-feedback" id="passwordError"></p>
            <hr>
            <div class="field is-horizontal">
              <div class="field-label is-normal"></div>
              <div class="field-body">
                <div class="field">
                  <div class="control">
                    <button type="submit" id="changePasswordSubmit" class="button is-primary">
                      Submit
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
    <?php } ?>

    <?php loadPartial('footer'); ?>
  </div>

<script>
  //if user pressed the button delete user delete the user
  $(document).ready(function(){

    $('#submitUserEdit').click(function (e) {
      e.preventDefault();
      $('#submitUserEdit').addClass('is-loading').attr('disabled', 'disabled');

      var personalNameVar = $('#personalNameField').val();
      var usernameVar = $('#usernameField').val();
      var roleVar = $('#roleField').find(":selected").val();

      //Ajax
      $.ajax({
        url: "/API/updateUser",
        type: "POST",
        data: { personalName: personalNameVar, username: usernameVar, role: roleVar, id: <?php echo $userData->id; ?> },
        success: function(data) {
          // On success, show success message
          $('#personalNameRead').val(personalNameVar);
          $('#roleRead').val(roleVar);
          $('#profileTitle').text("Edit profile: " + usernameVar);
          $('#userEditError').text('Profile updated successfully');
        },
        error: function(jqXHR, textStatus, errorThrown) {
          if(jqXHR.status == 409){
            $('#userEditError').text('User already exists');
          }
          $('#userEditError').text('Error: ' + textStatus + ' ' + errorThrown);
        }
    }).always(function() {
      // Re-enable the button after the AJAX call is complete
      $('#submitUserEdit').removeClass('is-loading').removeAttr('disabled');
    });
    });



    $('#deleteUser').click(function (e) {
      e.preventDefault();

      //Add confirmation...
      $.ajax({
        url: "/API/deleteUser",
        type: "POST",
        data: { id: <?php echo $userData->id; ?> },
        success: function (data) {
          window.location.href = "/users";
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert(textStatus, errorThrown);
        }
      });

    });


      //On form submit
    $('#changePasswordSubmit').click(function(e){
      e.preventDefault();
      //Get form
      var password = $('#password');
      var confirmPassword = $('#confirmPassword');
      $('#changePasswordSubmit').addClass('is-loading').attr('disabled', 'disabled');
      if(password.val() != confirmPassword.val()){
        password.addClass('is-danger');
        confirmPassword.addClass('is-danger');
        $('#passwordError').text('Passwords do not match');
        $('#changePasswordSubmit').removeClass('is-loading').removeAttr('disabled');
        return;
      }
      
      //Ajax
      $.ajax({
        type: "POST",
        url: "/API/changePassword",
        data: { password: password.val(), userId: <?php echo $userData->id; ?> },
        success: function(data) {
          // On success, show success message
          $('#passwordError').text('Password changed successfully');
          password.removeClass('is-danger');
          confirmPassword.removeClass('is-danger');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            // On error, show error message
            $('#passwordError').text('Error: ' + textStatus + ' ' + errorThrown);
        }
    }).always(function() {
      // Re-enable the button after the AJAX call is complete
      $('#changePasswordSubmit').removeClass('is-loading').removeAttr('disabled');
        password.val('');
        confirmPassword.val('');
    });
    });
  });

</script>

</body>

</html>