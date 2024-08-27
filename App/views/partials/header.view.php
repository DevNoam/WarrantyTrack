<!-- Load Jquery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

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
          <div class="is-user-name"><span><?php echo Framework\Session::get('name'); ?></span></div>
          <span class="icon"><i class="mdi mdi-chevron-down"></i></span>
        </a>
        <div class="navbar-dropdown">
          <a href="profile" class="navbar-item">
            <span class="icon"><i class="mdi mdi-account"></i></span>
            <span>My Profile</span>
          </a>
          <!-- <a href="settings" class="navbar-item">
            <span class="icon"><i class="mdi mdi-settings"></i></span>
            <span>Settings</span>
          </a> -->
          <hr class="navbar-divider">
          <form action="/logout" method="POST" class="navbar-item">
            <button class="button" type="submit">
              <span class="icon"><i class="mdi mdi-logout"></i></span>
              <span>Log Out</span>
            </button>
          </form>
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
        <a href="/">
          <span class="has-text-white"><b>WarrantyTrack</b></span>
        </a>
      </div>
    </div>
    <div class="menu is-menu-main">
      <p class="menu-label">General</p>
      <ul class="menu-list">
        <li>
          <a href="/" class="<?php if (basename($_SERVER['PHP_SELF']) == "panel") {
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
          <a href="cases" class="<?php if (basename($_SERVER['PHP_SELF']) == "cases") {
      echo "is-active router-link-active";
  } ?> has-icon">
            <span class="icon has-update-mark"><i class="mdi mdi-table"></i></span>
            <span class="menu-item-label">Cases</span>
          </a>
        </li>
        <li>
          <a href="reports" class="<?php if (basename($_SERVER['PHP_SELF']) == "reports") {
      echo "is-active router-link-active";
  } ?> has-icon">
            <span class="icon"><i class="mdi mdi-chart-arc"></i></span>
            <span class="menu-item-label">Reports</span>
          </a>
        </li>
  
        <!-- <p class="menu-label">SETTINGS</p> -->
        <!-- <li>
          <a href="profile" class="<?php if (basename($_SERVER['PHP_SELF']) == "profile") {
            echo "is-active router-link-active";
  } ?> has-icon">
            <span class="icon"><i class="mdi mdi-account-circle"></i></span>
            <span class="menu-item-label">Profile</span>
          </a>
        </li> -->
      </ul>


      <?php if (Framework\Session::get('role') == "Admin"): ?>
      <p class="menu-label">Settings</p>
      <ul class="menu-list">
        <ul>
          <li>
            <a href="users" class="<?php if (basename($_SERVER['PHP_SELF']) == "users") {
              echo "is-active";
            } ?> has-icon">
              <span class="icon"><i class="mdi mdi-account-multiple"></i></span>
              <span class="menu-item-label">Users</span>
            </a>
          </li>
          <li>
            
            <a href="settings" class="<?php if (basename($_SERVER['PHP_SELF']) == "settings") {
              echo "is-active";
            } ?> has-icon">
              <span class="icon "><i class="mdi mdi-code-greater-than"></i></span>
              <span class="menu-item-label">System</span>
            </a>
          </li>
          
        </ul>
      
    <?php endif; ?> 
    
    <p class="menu-label"></p>
      <ul class="menu-list">
        <li>
          <a href="https://github.com/noamsapir/WarrantyTrack" class="has-icon">
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
          window.location.href = 'search?data=' + inputValue;
        }
      }
    });
</script>
