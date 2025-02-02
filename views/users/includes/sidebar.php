<?php 

$url  = $_SERVER['REQUEST_URI'];


?>
<nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar" id="sidebar">
          <div class="position-sticky pt-3">
            <span class="material-icons d-lg-none sidebar-close-btn" id="closeSidebar">close</span>
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link d-flex  <?=  $url == '/views/users/index.php'?'active':'' ?>" href="index.php">
                  <span class="material-icons">home</span>
                  Dashboard
                </a>
              </li>
             
              <li class="nav-item">
                <a class="nav-link d-flex <?=  $url == '/views/users/profile_setting.php'?'active':'' ?>" href="profile_setting.php">
                  <span class="material-icons">person</span>
                  Profile Settings
                </a>
              </li>
             
              <li class="nav-item text-center">
                <a class="nav-link d-flex" href="slices/logout.php">
                <span class="material-icons">logout</span>
                  Logout
                </a>              </li>
            </ul>
          </div>
        </nav>