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
              <h1 class="title">
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
                        <input type="input" autocomplete="on" name="usernameField"
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
                    <select class="dropdown-content field" name="rolesField" id="rolesField">
                      <?php foreach ($rolesList as $roles):
                        if($roles == $userData->role): ?>
                        <option selected="selected" class="dropdown-item"> <?php echo $roles; ?></option>
                          <?php else: ?>
                            <option <?php if($isMe) echo "disabled" ?> class="dropdown-item" ?> <?php echo $roles; ?></option>
                          <?php endif; ?>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
                <hr>
                <span class="invalid-feedback"><?php echo "ErrorPlaceHolder"; ?></span>
                <div class="field is-horizontal">
                  <div class="field-label is-normal"></div>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <button type="submit" name="submitR" id="submitR" class="button is-primary">
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
                  <input type="text" readonly
                    value="<?php echo $userData->Name; ?>"
                    class="input is-static">
                </div>
              </div>
              <hr>
              <div class="field">
                <label class="label">Role</label>
                <div class="control is-clearfix">
                  <input type="text" readonly
                    value="<?php echo $userData->role; ?>"
                    class="input is-static">
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
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <input type="hidden" name="username" value="<?php echo $Ausername ?>" />
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
                    <input type="password" autocomplete="new-password" name="password_confirmation" class="input"
                      required>
                  </div>
                </div>
              </div>
            </div>
            <span class="invalid-feedback"><?php echo "ErrorPlaceHolder"; ?></span>
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
    </section>
    <?php } ?>

    <?php loadPartial('footer'); ?>
  </div>

  <script src="https://malsup.github.io/jquery.form.js"></script>
<script>
  //if user pressed the button delete user delete the user
  $(document).ready(function(){
    $('#deleteUser').click(function (e) {
      
      //Add confirmation...

      $.ajax({
        url: "/API/deleteUser/" + <?php echo $userData->id; ?>,
        type: "DELETE",
        success: function (data) {
          window.location.href = "/users";
        },
        error: function(jqXHR, textStatus, errorThrown) {
          alert(textStatus, errorThrown);
        }
      });

    });
  });

</script>

</body>

</html>