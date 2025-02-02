<?php
include('../../../model/db.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = trim($_POST['username']);
    $userid = $_SESSION['uid'];

    if(empty($username)){
        echo json_encode('emptyusername');
    }else{
        $sql = "update users set username = '$username' where userid = '$userid'";
        $result = mysqli_query($connection,$sql);
        if($result){
            $_SESSION['uname'] = $username;
            echo json_encode('updatesuccess');
        }else{
            echo json_encode('updatefailed');
        }
    }

}
else if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $userids = $_SESSION['uid'];
    $sql = "select * from users where userid = '$userids'";
    $result = mysqli_query($connection,$sql);
    if($result){
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    }



}