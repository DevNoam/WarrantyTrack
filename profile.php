<?php 

  require_once('API/sqlog.php');
  session_start();
  if(!isset($_SESSION["loggedin"]) && !$_SESSION["loggedin"] === true){
    header("Location: $domain");
      exit;
  }
  $username = $_SESSION['username'];

    $sqlData = "SELECT *, NULL as `password` FROM `users` WHERE `username` = '$username'";
    $result = mysqli_query($mysqli, $sqlData);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $userRole = $row['role'];

  $password_err = $form_err = null;

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $password_confirmation = null;
    $newusername = $personalName = $role = null;

    if(!empty($_POST['password']) && !empty($_POST['password_confirmation'])){
        if($_POST['password'] == $_POST['password_confirmation'])
        {
        $password = $_POST["password"];
        if(empty($password_err) && $password != null) {
          $sql = "UPDATE users SET password = '$password' WHERE username = '$username'";
          //check if query was successful
          if ($mysqli->query($sql) === TRUE) {
          //logout user
          session_destroy();
          //move to login page
          header("Location: $domain/?message=Password has been updated, please login again.");
          } else {
              echo "Error: " . $sql . "<br>" . $mysqli->error;
              $password_err = "SQL ERROR..";
          }

        }
      }
      else {
        $password_err = "Passwords fields not match.";
      }
    } 
    else {
      if($userRole == "Admin")
      {
        $personalName = $_POST['personalNameField'];
        $roles = $_POST['rolesField'];
        $newUsername = $_POST['usernameField'];
        $sql = "UPDATE users SET Name = '$personalName', role = '$roles' WHERE username = '$username'";
        if ($mysqli->query($sql) === TRUE) {
            $form_err = "Updated.";
            if($username != $newUsername)
            {
              $sql = "UPDATE users SET username = '$newUsername' WHERE username = '$username'";
              if ($mysqli->query($sql) === TRUE) {
                  if($username == $_SESSION['username'])
                  {
                    $_SESSION['username'] = $newUsername;
                    header("Refresh:0");
                  }
                $form_err = "Updated.";
              } else {
              $form_err =  "There is already a user with this username!.";
              } 
            }else
            {
              header("Refresh:0"); 
            }
        } else {
            $form_err =  "Error: " . $sql . "<br>" . $mysqli->error;
        }
      }
      else
      {
        $personalName = $_POST['personalNameField'];
        $sql = "UPDATE users SET Name = '$personalName' WHERE username = '$username'";
        if ($mysqli->query($sql) === TRUE) {
            //$form_err = "personal name has been updated.";
        } else {
            $form_err =  "Error: " . $sql . "<br>" . $mysqli->error;
        }
        //reload
        header("Refresh:0");
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
                Edit profile</i>
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
                <div class="field is-horizontal">
                  <div class="field-label is-normal">
                    <label class="label">Personal Name</label>
                  </div>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <input type="input" autocomplete="on" id="personalNameField" name="personalNameField"
                          value="<?php echo $row['Name']; ?>" placeholder="example" class="input" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="field is-horizontal" <?php if($userRole != "Admin") { ?>
                  title="Can be changed by adminstrator only." <?php } ?>>
                  <div class="field-label is-normal">
                    <label class="label">Username</label>
                  </div>
                  <?php if($userRole != "Admin") { ?>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <input type="input" readonly value="<?php echo $username ?>" name="usernameField"
                          class="input">
                      </div>
                    </div>
                  </div>
                  <?php } else { ?>
                  <div class="field-body">
                    <div class="field">
                      <div class="control">
                        <input type="input" autocomplete="on" name="usernameField" value="<?php echo $username ?>"
                          class="input" required>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                </div>

                <div class="field is-horizontal" <?php if($userRole != "Admin") { ?>
                  title="Can be changed by adminstrator only." <?php } ?>>
                  <div class="field-label is-normal">
                    <label class="label">Role</label>
                  </div>
                  <?php if($userRole != "Admin") { ?>
                  <div class="dropdown field-body" id="dropdown-menu">
                    <select class="dropdown-content field" name="rolesField" id="rolesField">
                      <option selected="selected" class="dropdown-item" value="<?php echo $userRole; ?>">
                        <?php echo $userRole; ?></option>
                    </select>
                  </div>
                  <?php } else { 
                  $sql = "SHOW COLUMNS FROM `users` WHERE Field = 'role'";
                  $result = mysqli_query($mysqli, $sql);  
                  $row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
                  $enumList = explode(",", str_replace("'", "", substr($row2['Type'], 5, (strlen($row2['Type'])-6))));
                  ?>
                  <div class="dropdown field-body" id="dropdown-menu" role="menu">
                    <select class="dropdown-content field" name="rolesField" id="rolesField">
                      <?php foreach ($enumList as $roles) {
                    if($userRole == $roles) {
                    ?>
                      <option selected="selected" class="dropdown-item" value="<?php echo $roles; ?>">
                        <?php echo $roles; ?></option>
                      <?php } else{ ?>
                      <option class="dropdown-item" value="<?php echo $roles; ?>"><?php echo $roles; ?></option>
                      <?php }} ?>
                    </select>
                  </div>
                  <?php } ?>
                </div>
                <hr>
                <span class="invalid-feedback"><?php echo $form_err; ?></span>
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
                  <input type="text" readonly value="<?php echo $row['Name']; ?>" class="input is-static">
                </div>
              </div>
              <hr>
              <div class="field">
                <label class="label">Role</label>
                <div class="control is-clearfix">
                  <input type="text" readonly value="<?php echo $row['role']; ?>" class="input is-static">
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

    <?php include('footer.php'); ?>
  </div>

  <!-- Scripts below are for demo only -->
  <script type="text/javascript" src="js/main.min.js"></script>

  <!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">

</body>

</html>