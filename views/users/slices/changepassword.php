<?php
include('../../../model/db.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $pwd = $_POST['pwd'];
    $userid = $_SESSION['uid'];
    $hashedpwd = password_hash($pwd,PASSWORD_DEFAULT);
    if(empty($pwd)){
        echo json_encode('emptypassword');
    }else{
        $sql = "update users set password = '$hashedpwd'";
        $result = mysqli_query($connection,$sql);
        if($result){
            echo json_encode('updatesuccess');
        }else{
            echo json_encode('updatefailed');
        }
    }
}