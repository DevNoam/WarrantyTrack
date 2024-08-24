<!-- 
  Noam Sapir© 2023
-->
<!DOCTYPE html>
<html lang="he" dir="rtl">

<head>
 <?php loadPartial('head') ?>
  <title>Noam'sLab - תודה</title>


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

        <h1 class="title has-text-black-bis has-text-centered">פנייתך נשלחה ותענה בהקדם.</h1>
      </div>

    </div>
  </section>

  <?php loadPartial('navbar', ['database' => $database]); ?>
  <?php loadPartial('footer') ?>
</body>


<style>
  html {
    scroll-behavior: smooth;
    scroll-padding: 50px;
  }

</style>


</html>