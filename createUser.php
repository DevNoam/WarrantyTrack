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

//clear results
$result->free();


$password_err = $form_err = null;
$Cusername = $password = $personalName = $role = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Cusername = $_POST['usernameField'];
    $password = $_POST['passwordField'];
    $personalName = $_POST['personalNameField'];
    $role = $_POST['rolesField'];
    //if properties are empty
    if(empty($Cusername) || empty($password) || empty($personalName) || empty($role))
        $form_err = "Fill all fields to continue";
    else {
        //upload data to database
        $sql = "INSERT INTO `users` (`id`, `username`, `password`, `role`, `Name`) VALUES (NULL, '$Cusername', '$password', '$role', '$personalName');";
        if ($mysqli->query($sql) === true) {
            $form_err = "New record created successfully";
            header("Location: otherProfile.php?username=$Cusername");
            exit;
        } else {
            //if the error is because the username is already taken
            if ($mysqli->errno == 1062) {
                $form_err = "Username already taken";
            } else {
                $form_err = "Error: " . $sql . "<br>" . $mysqli->error;
            }
            //$form_err = "Error: " . $sql . "<br>" . $mysqli->error;
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
            <li>New user</li>
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
                New user
            </h1>
          </div>
        </div>
        <div class="level-right">
          <div class="level-item">
            <div class="buttons is-right" id="deleteUser">
              <a class="button is-primary" id="submitButton">
                <span class="icon"><i class="mdi mdi-plus"></i></span>
                <span>Create user</span>
              </a>
            </div>
          </div>
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
  <?php } else { ?>
  <section class="section is-main-section">
    <form method="POST" id="form" name="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <div class="tile is-ancestor">
      <div class="tile is-parent">
        <div class="card tile is-child">
          <header class="card-header">
            <p class="card-header-title">
              <span class="icon"><i class="mdi mdi-account-circle default"></i></span>
              Basic info
            </p>
          </header>
          <div class="card-content">
            <div class="field is-horizontal">
                <div class="field-label is-normal">
                  <label class="label">Personal Name</label>
                </div>
                <div class="field-body">
                  <div class="field">
                    <div class="control">
                      <input type="input" autocomplete="on" id="personalNameField" name="personalNameField"
                      value="<?php echo $personalName ?>"
                        placeholder="example name" class="input" required>
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
                      <input type="input" autocomplete="on" id="usernameField" name="usernameField"
                        value="<?php echo $Cusername ?>" class="input" placeholder="Admin" required>
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
                    <?php foreach (array_reverse($enumList) as $roles) { 
                        if(isset($role) && $role == $roles) { ?>
                            <option selected><?php echo $roles ?></option>
                        <?php } else {?>
                        <option class="dropdown-item" ?> <?php echo $roles; ?> </option>
                    <?php }} ?>
                  </select>
                </div>
              </div>
              <hr>
              <span class="invalid-feedback"><?php echo $form_err; ?></span>

            </div>
        </div>
    </div>
    <div class="tile is-parent">
        <div class="card tile is-child">
            <header class="card-header">
            <p class="card-header-title">
                <span class="icon"><i class="mdi mdi-account default"></i></span>
                Password
            </p>
        </header>
        <div class="card-content">

            <div class="field is-horizontal">
                <div class="field-label is-normal">
                    <label class="label">Password</label>
                </div>
                <div class="field-body">
                    <div class="field">
                        <div class="control">
                            <input type="password" autocomplete="new-password" id="passwordField" name="passwordField" class="input"
                            value="<?php echo $password ?>" required>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </div>
</div>
</div>

</div>
</form>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


<script>

//send form
$('#submitButton').click(function(e){
            e.preventDefault();
            let form = document.getElementById("form");
            form.submit();

    });
</script>
</body>

</html>