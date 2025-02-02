<?php
include('../model/db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = mysqli_escape_string($connection,$_POST['email']);
    $password = mysqli_escape_string($connection,$_POST['password']);
    
    if(empty($email)){
        echo json_encode('emptyemail');
    }else if(empty($password)){
        echo json_encode('emptypassword');
    }else{

        // check if user exist
        $sql = "select * from users where email= '$email'";
        $result = mysqli_query($connection,$sql);
        if(mysqli_num_rows($result) == 0){
            echo json_encode('usernotfound');
        }else{
            while($row = mysqli_fetch_assoc($result)){
                if($row['email'] == $email && password_verify($password,$row['password'])){
                    // create sessions
                    session_start();
                    session_regenerate_id();
                    $_SESSION['uname'] = $row['username'];
                    $_SESSION['uemail'] = $row['email'];
                    $_SESSION['uid'] = $row['userid'];
                    echo json_encode('success');
                }else{
                    echo json_encode('failed');
                }
            }
        }
    }
}else{
    echo json_encode("server doesn't support this request");
}