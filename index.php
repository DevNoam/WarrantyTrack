<?php
// Initialize the session
require_once "API/sqlog.php";

session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $username = $_SESSION['username'];
    echo "Welcome $username";
    header("Location: panel.php");
    exit;
}

// Include config file
 
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $login_err = "Please enter username.";
        $password_err = "</br>";
    } else {
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $login_err = "Please enter your password.";
        $password_err = "</br>";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if ($stmt->num_rows == 1) {
                    // Bind result variables
                    $stmt->bind_result($id, $username, $hashed_password);
                    if ($stmt->fetch()) {
                        if ($password == $hashed_password) {
                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            
                            // Redirect user to welcome page
                            header("Location: panel.php");
                        } else {
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid password.";
                            $password_err = "</br>";
                        }
                    }
                } else {
                    // Username doesn't exist, display a generic error message
                    $login_err = "Username does not exist.";
                    $password_err = "</br>";
                }
            } else {
                $login_err = "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();
}
?>

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
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                method="post" class="box">
                <h2 class="title is-size-3 has-text-black has-text-centered">WarrantyTrack</h2>
                <hr>
                <div class="field">
              <label for="" class="label">Username</label>
              <div class="control has-icons-left">
                  <input type="text" name="username" placeholder="e.g. admin" class="input <?php echo (!empty($username_err)) ? 'is-danger' : ''; ?>" value="<?php echo $username; ?>">
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
            if (!empty($login_err)) {
                echo '<div class="notification is-danger">' . $login_err . '</div>';
            }
            ?>
            <div class="field">
              <input type="submit" class="button is-success" value="Login">
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