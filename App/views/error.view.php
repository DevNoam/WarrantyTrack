<!DOCTYPE html>
<html lang="en" class="has-aside-left has-aside-mobile-transition has-navbar-fixed-top has-aside-expanded">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>WarrantyTrack - <?php echo $errCode; ?></title>

  <!-- Bulma is included -->
  <link rel="stylesheet" href="css/main.min.css">

  <!-- Fonts -->
  <link rel="dns-prefetch" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
</head>
<body>
<div id="app">


  <?php loadPartial("header"); ?>



  <section class="section is-title-bar">
    <div class="level">
      <div class="level-left">
        <div class="level-item">
          <ul>
            <li>Error</li>
            <li><?php echo $errCode; ?></li>
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
            Error <?php echo $errCode; ?>
          </h1></div>
        </div>
      </div>
    </div>
  </section>

    <div class="card has-table">
      <div class="card-content">
        <div class="b-table has-pagination">
          <div class="table-wrapper has-mobile-cards">

    <?php if($errCode != 403): ?>
  <section class="section">
    <div class="content has-text-grey has-text-centered">
      <p>
        <span class="icon is-large"><i class="mdi mdi-alert-outline mdi-48px"></i></span>
      </p>
      <p>Error <?php echo $errCode; ?> </br>
      <?php if($errCode == 404): ?>
        The requested content have not found</p>
      <?php endif; ?>
    </div>
    </section>

    <?php elseif($errCode == 403): ?>
    <section class="section">
    <div class="content has-text-grey has-text-centered">
      <p>
        <span class="icon is-large"><i class="mdi mdi-lock mdi-48px"></i></span>
      </p>
      <p>Error <?php echo $errCode; ?> </br>
      <?php if($errCode == 403): ?>No privileges..</p>
      <?php endif; ?>
    </div>
    </section>

    <?php endif; ?>

  </tr>
  </section>
  <?php loadPartial("footer"); ?>


<!-- Scripts below are for demo only -->
<script type="text/javascript" src="js/main.min.js"></script>

<!-- Icons below are for demo only. Feel free to use any icon pack. Docs: https://bulma.io/documentation/elements/icon/ -->
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">


</body>
</html>
