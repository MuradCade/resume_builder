<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['uname']) && isset($_SESSION['uemail'])){
    header('location:../views/users/index.php');
    exit();
}else{
    header('location:../login.php');
}