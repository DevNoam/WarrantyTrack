<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
<link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.9.95/css/materialdesignicons.min.css">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warranty Track</title>
</head>

<body>
<section class="hero has-background-grey-darker is-fullheight">
  <div class="hero-body">
    <div class="container">
        <div class="columns is-mobile is-centered">
            <div class="column is-5-tablet is-5-desktop is-4-widescreen">
                <form action="/authenticate" method="post" class="box">
                <h2 class="title is-size-3 has-text-black has-text-centered">WarrantyTrack</h2>
                <hr>
                <div class="field">
              <label for="" class="label">Username</label>
              <div class="control has-icons-left">
                  <input type="text" name="username" placeholder="e.g. admin" class="input <?php echo (!empty($username_err)) ? 'is-danger' : ''; ?>" value="<?php echo (!empty($username)) ? $username : ''; ?>">
                  <span class="icon is-small is-left">
                      <i class="mdi mdi-account"></i>
                    </span>
                </div>
            </div>
            <div class="field">
              <label for="" class="label">Password</label>
              <div class="control has-icons-left">
                <input type="password" name="password" placeholder="*******" class="input <?php echo (!empty($password_err)) ? 'is-danger' : ''; ?>">
                <span class="icon is-small is-left">
                    <i class="mdi mdi-lock"></i>
                </span>
              </div>
            </div>

            <?php
            if (!empty($errorMsg)) {
                echo '<div class="notification is-danger">' . $errorMsg . '</div>';
            }
            ?>
            <div class="field">
              <button type="submit" class="button is-success">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

</div>
</div>
<?php if (isset($_GET['message'])) { ?>
    &nbsp;&nbsp;&nbsp;<span class="alert alert-success"><?php echo htmlspecialchars($_GET['message']); ?></span>
    <?php } ?>
</body>

</html>