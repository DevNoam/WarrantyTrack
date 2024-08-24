<!-- 
  Noam Sapir© 2023
-->
<!DOCTYPE html>
<html lang="he" dir="rtl">

<?php loadPartial('head')?>
<head>
  <title>Noam'sLab - <?php echo $errCode ?> error</title>
  <!-- SEO -->
  <meta name=”robots” content=”noindex”>
  <meta name=”robots” content=”nofollow”>
</head>

<body style="background-color: rgb(24, 24, 24);">

  <section id="" class="hero is-success is-fullheight has-text-centered"
    style="background: linear-gradient(rgba(255, 255, 255, 0.2), hsla(0, 0%, 96%, 0.2)), url(''); background-size:cover; background-position:center;">
    <div class="hero-body">
      <div class="box container"
        style="background: linear-gradient(rgba(255, 255, 255, 0.95), rgba(245, 245, 245, 0.95));">

        <h1 class="title has-text-black-bis has-text-centered">אין כאן כלום (<?php echo $errCode ?>) </h1>
        <a target="_blank" href="https://www.youtube.com/watch?v=RSvCUOF03k8"><img
            src="https://i.kym-cdn.com/entries/icons/original/000/027/475/Screen_Shot_2018-10-25_at_11.02.15_AM.png"
            style="max-width:50%;" alt=""></a>
        <div class="container has-text-left pt-5 px-0">
        </div>

      </div>
  </section>

  <?php loadPartial('navbar', ['database' => $database]); ?>
    <?php loadPartial('footer') ?>
</body>

</html>