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
  $password_err = null;



if($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = null;
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
      $password_err = "Password error.";
    } 
    else {
      if($_POST['password'] == $_POST['password_confirmation'])
      {
      $password = $_POST["password"];
      }
      else
      {
        $password_err = "Passwords fields not match.";
      }
    }
    if(empty($password_err) && $password != null) {
      $sql = "UPDATE users SET password = '$password' WHERE username = '$username'";
      //check if query was successful
      if ($mysqli->query($sql) === TRUE) {
          echo "Password has been updated.";
      } else {
          echo "Error: " . $sql . "<br>" . $mysqli->error;
      }
      //logout user
      session_destroy();
      //move to login page
      header("Location: $domain/?message=Success!, please login again.");
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
          <div class="level-item"><h1 class="title">
            Profile
          </h1></div>
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
            <form>
              
            <!--<div class="field is-horizontal">
                <div class="field-label is-normal"><label class="label">Avatar</label></div>
                <div class="field-body">
                  <div class="field">
                    <div class="field file">
                      <label class="upload control">
                        <a class="button is-primary">
                          <span class="icon"><i class="mdi mdi-upload default"></i></span>
                          <span>Pick a file</span>
                        </a>
                        <input type="file">
                      </label>
                    </div>
                  </div>
                </div>
              </div>

              <hr>-->
              <div class="field is-horizontal">
                <div class="field-label is-normal">
                  <label class="label">Personal Name</label>
                </div>
                <div class="field-body">
                  <div class="field">
                    <div class="control">
                      <input type="text" autocomplete="on" name="name" value="<?php echo $row['Name']; ?>" placeholder="example" class="input" required>
                    </div>
                  </div>
                </div>
              </div>
              <div class="field is-horizontal">
                <div class="field-label is-normal">
                  <label class="label">Username</label>
                </div>
                <div class="field-body">
                  <div class="field">
                    <div class="control">
                      <input type="input" autocomplete="on" name="email" value="<?php echo $username ?>" class="input" required>
                    </div>
                  </div>
                </div>
              </div>

              <div class="field is-horizontal">
                <div class="field-label is-normal">
                  <label class="label">Role</label>
                </div>
                <?php if($userRole != "Admin") { ?>
                  <div class="dropdown field-body" id="dropdown-menu" role="menu">
                  <select class="dropdown-content field" name="cars" id="cars">
                    <option selected="selected" class="dropdown-item" value="<?php echo $userRole; ?>"><?php echo $userRole; ?></option>
                  </select>
                </div>
                <?php } else { 
                  $sql = "SHOW COLUMNS FROM `users` WHERE Field = 'role'";
                  $result = mysqli_query($mysqli, $sql);  
                  $row2 = mysqli_fetch_array($result, MYSQLI_ASSOC);
                  $enumList = explode(",", str_replace("'", "", substr($row2['Type'], 5, (strlen($row2['Type'])-6))));
                  ?>
              <div class="dropdown field-body" id="dropdown-menu" role="menu">
                <select class="dropdown-content field" name="cars" id="cars">
                  <?php foreach ($enumList as $roles) {
                    if($userRole == $roles) {
                    ?>
                    <option selected="selected" class="dropdown-item" value="<?php echo $roles; ?>"><?php echo $roles; ?></option>
                    <?php } else{ ?>
                    <option class="dropdown-item" value="<?php echo $roles; ?>"><?php echo $roles; ?></option>
                    <?php }} ?>
                  </select>
              </div>
              <?php } ?>
              </div>
              <hr>
              
              <div class="field is-horizontal">
                <div class="field-label is-normal"></div>
                <div class="field-body">
                  <div class="field">
                    <div class="control">
                      <button type="submit" class="button is-primary">
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
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
          <div class="field is-horizontal">
            <div class="field-label is-normal">
              <label class="label">New password</label>
            </div>
            <div class="field-body">
              <div class="field">
                <div class="control">
                  <input type="password" autocomplete="new-password" id="password" name="password" class="input" required>
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
                  <input type="password" autocomplete="new-password" name="password_confirmation" class="input" required>
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
                  <button type="submit" class="button is-primary">
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

  <!-- <div id="sample-modal" class="modal">
    <div class="modal-background jb-modal-close"></div>
    <div class="modal-card">
      <header class="modal-card-head">
        <p class="modal-card-title">Confirm action</p>
        <button class="delete jb-modal-close" aria-label="close"></button>
      </header>
      <section class="modal-card-body">
        <p>This will permanently delete <b>Some Object</b></p>
        <p>This is sample modal</p>
      </section>
      <footer class="modal-card-foot">
        <button class="button jb-modal-close">Cancel</button>
        <button class="button is-danger jb-modal-close">Delete</button>
      </footer>
    </div>
    <button class="modal-close is-large jb-modal-close" aria-label="close"></button>
  </div>
  -->
</div>

<!-- Scripts below are for demo only -->
<script type="text/javascript" src="js/main.min.js"></script>

<!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
</body>
</html>