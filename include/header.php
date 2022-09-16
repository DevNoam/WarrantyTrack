<nav id="navbar-main" class="navbar is-fixed-top">
  <div class="navbar-brand">
    <a class="navbar-item is-hidden-desktop jb-aside-mobile-toggle">
      <span class="icon"><i class="mdi mdi-forwardburger mdi-24px"></i></span>
    </a>
    <div class="navbar-item has-control">
      <div class="control"><input placeholder="Search case..." id="inputSearch" name="inputSearch" class="input"></div>
    </div>
  </div>
  <div class="navbar-brand is-right">
    <a class="navbar-item is-hidden-desktop jb-navbar-menu-toggle" data-target="navbar-menu">
      <span class="icon"><i class="mdi mdi-dots-vertical"></i></span>
    </a>
  </div>
  <div class="navbar-menu fadeIn animated faster" id="navbar-menu">
    <div class="navbar-end">
      <div class="navbar-item has-dropdown has-dropdown-with-icons has-divider has-user-avatar is-hoverable">
        <a class="navbar-link is-arrowless">
          <span class="icon"><i class="mdi mdi-account"></i></span>
          <div class="is-user-name"><span><?php echo $username ?></span></div>
          <span class="icon"><i class="mdi mdi-chevron-down"></i></span>
        </a>
        <div class="navbar-dropdown">
          <a href="profile.php" class="navbar-item">
            <span class="icon"><i class="mdi mdi-account"></i></span>
            <span>My Profile</span>
          </a>
          <a href="settings.php" class="navbar-item">
            <span class="icon"><i class="mdi mdi-settings"></i></span>
            <span>Settings</span>
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item" href="API/logout.php">
            <span class="icon"><i class="mdi mdi-logout"></i></span>
            <span>Log Out</span>
          </a>
        </div>
      </div>
          <p title="Log out" class="navbar-item is-desktop-icon-only is-hidden-touch">
            <span class="IcOn"><i class="mdi"></i></span>
            <span>;)</span>
          </p>
    </div>
  </div>
</nav>





<aside class="aside is-placed-left is-expanded">
    <div class="aside-tools">
      <div class="aside-tools-label">
        <a href="panel.php">
          <span class="has-text-white"><b>WarrantyTrack</b></span>
        </a>
      </div>
    </div>
    <div class="menu is-menu-main">
      <p class="menu-label">General</p>
      <ul class="menu-list">
        <li>
          <a href="panel.php" class="<?php if (basename($_SERVER['PHP_SELF'], '.php') == "panel") {
      echo "is-active router-link-active";
  } ?> has-icon">
            <span class="icon"><i class="mdi mdi-desktop-mac"></i></span>
            <span class="menu-item-label">Dashboard</span>
          </a>
        </li>
      </ul>
      <p class="menu-label">Management</p>
      <ul class="menu-list">
        <li>
          <a href="cases.php" class="<?php if (basename($_SERVER['PHP_SELF'], '.php') == "cases") {
      echo "is-active router-link-active";
  } ?> has-icon">
            <span class="icon has-update-mark"><i class="mdi mdi-table"></i></span>
            <span class="menu-item-label">Cases</span>
          </a>
        </li>
        <li>
          <a href="reports.php" class="<?php if (basename($_SERVER['PHP_SELF'], '.php') == "reports") {
      echo "is-active router-link-active";
  } ?> has-icon">
            <span class="icon"><i class="mdi mdi-chart-arc"></i></span>
            <span class="menu-item-label">Reports</span>
          </a>
        </li>
  
      </ul>
      <p class="menu-label">SETTINGS</p>
      <ul class="menu-list">
        <li>
          <a href="profile.php" class="<?php if (basename($_SERVER['PHP_SELF'], '.php') == "profile") {
      echo "is-active router-link-active";
  } ?> has-icon">
            <span class="icon"><i class="mdi mdi-account-circle"></i></span>
            <span class="menu-item-label">Profile</span>
          </a>
        </li>
  
        <?php
          //check if user is under a dropdown page
          if (basename($_SERVER['PHP_SELF'], '.php') == "settings" || basename($_SERVER['PHP_SELF'], '.php') == "users") {
              {
              echo '<li class="is-active router-link-active">';
              echo '<a class="has-icon is-active has-dropdown-icon">';
            }
          } else {
              echo '<li>';
              echo '<a class="has-icon has-dropdown-icon">';
          }
        ?>
        <span class="icon"><i class="mdi mdi-settings"></i></span>
        <span class="menu-item-label">Settings</span>
        <div class="dropdown-icon">
          <?php
          //check if user is under a dropdown page
          if (basename($_SERVER['PHP_SELF'], '.php') == "settings" || basename($_SERVER['PHP_SELF'], '.php') == "users") {
              {
              echo '<span class="icon"><i class="mdi mdi-minus"></i></span>';
            }
          } else {
              echo '<span class="icon"><i class="mdi mdi-plus"></i></span>';
          }
        ?>
        </div>
        </a>
        <ul>
          <li>
            <a href="users.php" class="<?php if (basename($_SERVER['PHP_SELF'], '.php') == "users") {
            echo "is-active";
        } ?> has-icon">
              <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
              <span class="menu-item-label">Users</span>
            </a>
          </li>
          <li>
      
            <a href="settings.php" class="<?php if (basename($_SERVER['PHP_SELF'], '.php') == "settings") {
            echo "is-active";
        } ?> has-icon">
              <span class="icon "><i class="mdi mdi-code-greater-than"></i></span>
              <span class="menu-item-label">Settings</span>
            </a>
          </li>
      
        </ul>
        </li>
      
        <li>
          <a href="https://github.com/sapirnoam/WarrantyTrack" class="has-icon">
            <span class="icon"><i class="mdi mdi-help-circle"></i></span>
            <span class="menu-item-label">About</span>
          </a>
        </li>
      </ul>
    </div>
</aside>


<script>
      //make a listener for the id inputSearch so users will able to seach cases.
      document.getElementById("inputSearch").addEventListener("keyup", function(event) {
      //detect if user pressed enter key
      //get the value of the input field inputSearch
      if (event.keyCode === 13) {
        var inputValue = document.getElementById("inputSearch").value;
        //if user pressed enter key, prevent default behaviour
        event.preventDefault();
        //make a request to the server
        //change url to the input value
        //proceed only if the input value is not empty
        if (inputValue !== "") {
          window.location.href = 'search.php?data=' + inputValue;
        }
      }
    });
</script>