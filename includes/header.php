<?php 

$url= $_SERVER['REQUEST_URI'];

?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid px-5">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
        <img src="../assets/images/logo.png" alt="cv builder logo" width="60">
        <p  style="position:relative; top:10px;font-size:14px;" class='fw-bold'>Cv-Builder</p>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 mx-auto" style="font-size: 14px !important;">
        <li class="nav-item">
          <a class="nav-link <?= $url == '/index.php'?'active':($url=='/'?'active':'');?>" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $url == '/login.php'?'active':'';?>" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?= $url == '/signup.php'?'active':'';?>" href="signup.php" >Create Account</a>
        </li>
       
        
      </ul>
     
    </div>
  </div>
</nav>