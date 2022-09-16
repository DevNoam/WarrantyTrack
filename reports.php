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
  if($userRole != 'Admin')
    {

    }else
    {
        $result->free();
        $sqlData = "SELECT *, NULL as `password` FROM `users`";
        $result = mysqli_query($mysqli, $sqlData);
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
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


  <?php include ("include/header.php"); ?>



  <section class="section is-title-bar">
    <div class="level">
      <div class="level-left">
        <div class="level-item">
          <ul>
            <li>Admin</li>
            <li>Settings</li>
            <li>Reports</li>
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
            Reports
          </h1></div>
        </div>
      </div>
    </div>
  </section>

    <div class="card has-table">
      <header class="card-header">
        <p class="card-header-title">
          <span class="icon"><i class="mdi mdi-chart-arc"></i></span>
          Statistics reports
        </p>
        <a href="#" class="card-header-icon" id="usersTableButton">
          <span class="icon mdi mdi-minus"></span>
        </a>
      </header>
      <div class="card-content">
        <div class="b-table has-pagination">
          <div class="table-wrapper has-mobile-cards">

  <section class="section">
    <div class="content has-text-grey has-text-centered">
      <p>
        <span class="icon is-large"><i class="mdi mdi-alert-outline mdi-48px"></i></span>
      </p>
      <p>TBD..</p></div>
    </section>
  </tr>
  </section>
  <?php include ('include/footer.php'); ?>


<!-- Scripts below are for demo only -->
<script type="text/javascript" src="js/main.min.js"></script>

<!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">


</body>
</html>
