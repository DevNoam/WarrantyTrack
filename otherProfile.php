<!--  
  THIS PAGE EDITS EXTERNAL USERS PROFILE, ONLY ADMINS CAN EDIT EXTERNAL PROFILES.
 -->


<?php

  require_once('API/sqlog.php');
  session_start();
  if (!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true) {
      header("Location: index.php");
      exit;
  }
  $username = $_SESSION['username'];
  $sqlData = "SELECT *, NULL as `password` FROM `users` WHERE `username` = '$username'";
  $result = mysqli_query($mysqli, $sqlData);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $userRole = $row['role'];
  
  if ($userRole != 'Admin') {
      $canEdit = false;
  } else {
      $canEdit = true;
  }
  
  //clear results
  $result->free();
  if (isset($_GET['username'])) {
      $Ausername = $_GET['username'];
  }else if (isset($_POST['username'])) {
      $Ausername = $_POST['username'];
    } 

  if($canEdit == true && isset($Ausername))
  {
    if(isset($_POST['deleteUser']) && $_POST['deleteUser'] == true)
    {
      $sqlData = "DELETE FROM `users` WHERE `users`.`username` = '$_POST[username]'";
      //push the query to the database
      $result = mysqli_query($mysqli, $sqlData);
      if (!$result) {
          echo 'Error deleting user';
      }
      echo "1";
      exit;
    }
    
  $sqlData = "SELECT *, NULL as `password` FROM `users` WHERE `username` = '$Ausername'";
  $result = mysqli_query($mysqli, $sqlData);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  }

  if(strtolower($Ausername) == strtolower($username))
  {
      header("Location: profile.php");
  }

  $password_err = $form_err = null;
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $password = null;
      $newusername = $personalName = $role = null;


      if (!empty($_POST['password'])) {
          $password = htmlspecialchars($_POST["password"]);
          if (empty($password_err) && $password != null) {
              $sql = "UPDATE users SET password = '$password' WHERE username = '$Ausername'";
              //check if query was successful
              if ($mysqli->query($sql) === true) {
                  //logout user
                  //move to login page
                  header("Location: otherProfile.php?username=$Ausername&successAlert=1");
                } else {
                  echo "Error: " . $sql . "<br>" . $mysqli->error;
                  $password_err = "SQL ERROR..";
              }
          }
      }
       else {
              $personalName = $_POST['personalNameField'];
              $roles = $_POST['rolesField'];
              $newUsername = $_POST['usernameField'];
              $sql = "UPDATE users SET Name = '$personalName', role = '$roles' WHERE username = '$Ausername'";
              if ($mysqli->query($sql) === true) {
                  $form_err = "Updated.";
                  if ($Ausername != $newUsername) {
                      $sql = "UPDATE users SET username = '$newUsername' WHERE username = '$Ausername'";
                      if ($mysqli->query($sql) === true) {
                          header("Location: otherProfile.php?username=$newUsername&successAlert=1");
                      } else {
                          $form_err =  "There is already a user with this username!.";
                      }
                  } else {
                      header("Location: otherProfile.php?username=$newUsername&successAlert=1");
                  }
              } else {
                  $form_err =  "Error: " . $sql . "<br>" . $mysqli->error;
              }
      }
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
    <?php include 'header.php'; ?>


    <section class="section is-title-bar">
      <div class="level">
        <div class="level-left">
          <div class="level-item">
            <ul>
              <li>Admin</li>
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
                  if ($userRole == 'Admin' && isset($Ausername)) {
                      echo "Edit profile: $Ausername";
                  }
                  else {
                      echo "Edit profile: ?";
                  }
                ?>
              </h1>
            </div>
          </div>
          <div class="level-right">
            <?php if ($userRole == 'Admin' && isset($row['username']) && strtolower($Ausername) == strtolower($row['username'])) { ?>
            <div class="level-item">
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
    <?php if($userRole != 'Admin')
    { ?>
      <section class="section">
    <div class="content has-text-grey has-text-centered">
      <p>
        <span class="icon is-large"><i class="mdi mdi-lock mdi-48px"></i></span>
      </p>
      <p>No privileges..</p></div>
    </section>
    <?php } else if(empty($Ausername) || $row == null){ ?>
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
              <input type="hidden" name="username" value="<?php echo $Ausername ?>" />
              <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Personal Name</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <input type="input" autocomplete="on" id="personalNameField" name="personalNameField"
                          value="<?php echo $row['Name']; ?>"
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
                          value="<?php echo $Ausername ?>"
                          class="input" required>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Role</label>
                  </div>
<?php 
        $sql = "SHOW COLUMNS FROM `users` WHERE Field = 'role'";
        $result = mysqli_query($mysqli, $sql);
        $row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $enumList = explode(",", str_replace("'", "", substr($row2['Type'], 5, (strlen($row2['Type'])-6)))); ?>
                  <div class="dropdown field-body" id="dropdown-menu" role="menu">
                    <select class="dropdown-content field" name="rolesField" id="rolesField">
                      <?php foreach ($enumList as $roles) {
            if ($row['role'] == $roles) {
                ?>
                      <option selected="selected" class="dropdown-item"> <?php echo $roles; ?>
                      </option>
                      <?php
            } else { ?>
                      <option class="dropdown-item" ?> <?php echo $roles; ?>
                      </option>
                      <?php }
        } ?>
                    </select>
                  </div>
                </div>
                <hr>
                <span class="invalid-feedback"><?php echo $form_err; ?></span>
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
                    value="<?php echo $row['Name']; ?>"
                    class="input is-static">
                </div>
              </div>
              <hr>
              <div class="field">
                <label class="label">Role</label>
                <div class="control is-clearfix">
                  <input type="text" readonly
                    value="<?php echo $row['role']; ?>"
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
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
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

    <?php include('footer.php'); ?>
  </div>

  <!-- Scripts below are for demo only -->
  <script type="text/javascript" src="js/main.min.js"></script>

  <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
  <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
  <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
  <script src="https://malsup.github.io/jquery.form.js"></script>
  <?php if (isset($_GET['successAlert'])) {
        echo "<script> alertify.success('Profile updated.'); </script>";
    }
    ?>
  <script>
    //if user pressed the button delete user delete the user
    $(document).ready(function(){
   $('#deleteUser').click(function (e) {
     e.preventDefault();
     //if domainField value is empty
     alertify.confirm('User deletetion', "Are you sure you want to delete the user: <?php echo $Ausername; ?>",
     function(){ 
      //make ajax call to this page
      $.ajax({
        url: 'otherProfile.php',
        type: 'POST',
        data: {
          username: '<?php echo $Ausername; ?>',
          deleteUser: true
        },
        success: function(response){
            //redirect to this page
            window.location.href = "users.php";
          }
        }
      );
      },
      function(){ alertify.error('Canceled')});
    });
  });


</script>

</body>

</html>