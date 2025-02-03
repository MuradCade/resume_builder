<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('../model/db.php');
include_once('send_email.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $action = $_POST['action'];
     // random generated code for the user to verify its email 
     $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=';
     $charactersLength = strlen($characters);
     $randomString = '';
      // Generate a 5-character random string
      for ($i = 0; $i < 5; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }


    // lookup if the email exit in db
    if($action == 'lookup'){
        $email = mysqli_escape_string($connection,$_POST['email']);

        if(empty($email)){
            echo json_encode('emptyemail');
        }else{
            $sql = "select * from users where email = '$email'";
            $result = mysqli_query($connection,$sql);
            $row = mysqli_fetch_assoc($result);
            if(mysqli_num_rows($result) == 0){
                echo json_encode('notexist');
            }else{
                // store the code generated with users email in db
                $sql = "insert into forget_pwd(email,code)values('$email','$randomString')";
                $result = mysqli_query($connection,$sql);
                
                // send email
                $emailarray = ["email"=>$email,"username"=>$row['username'],"subject"=>"⚠️Important: Reset Your Password","body"=>"
                <div class='email-container'>
                    <div class='email-header'>
                        <h1 style='font-size: 20px;position:relative; top:5px;'>Reset Password Requested</h1>
                    </div>
                    <div class='email-body'>
                        <p>Hi, {$row['username']},</p>
                        <p>We received a request to reset your password. Use the code below to reset your password and regain access to your account.</p>
                        <p>Your Code: <strong>{$randomString}</strong></p>
                        
                        <p>If you didn’t request this, you can ignore this email. Your password will remain unchanged.</p>
                    </div>
                    <div class='email-footer'>
                        <p>&copy; 2025 Cv-Builder. All rights reserved.</p>
                        <p>This email was sent because a password reset was requested for your account.</p>
                    </div>
                </div>

"];
        $sended_message = sendemail($emailarray['email'],$emailarray['username'],$emailarray['subject'],$emailarray['body']);
        if($sended_message){
            // session_start();
            $_SESSION['emails'] = $email;
            echo json_encode('success');
        }else{
            echo json_encode('failed');
        }
            }
        }
    }else if($action = 'changepwd'){
        $password = mysqli_escape_string($connection, $_POST['pwd']);
        $vcode = mysqli_escape_string($connection,$_POST['vcode']);
        $mainemail = $_SESSION['emails'];
        $hashedpwd = password_hash($password,PASSWORD_DEFAULT);
        // echo json_encode($mainemail)

        if(empty($vcode)){
            echo json_encode('emptyvcode');
        }else if(empty($password)){
            echo json_encode('emptypwd');
        }else{
            if(isset($_SESSION['emails'])){
                $sql1 = "select * from forget_pwd where email= '$mainemail' and code = '$vcode'";
            $result1 = mysqli_query($connection,$sql1);
            if(mysqli_num_rows($result1) == 0){
                echo json_encode('notfound');
            }else{
                $row = mysqli_fetch_assoc($result1);
                if($row['code'] == $vcode && $row['verified'] == 'true'){
                    $sql2 = "update users set password = '$hashedpwd' where email = '$mainemail'";
                    $result2 = mysqli_query($connection,$sql2);
                    if($result2){
                        $sql3 = "update forget_pwd set verified = 'false' where email = '$mainemail'";
                        $result3 = mysqli_query($connection,$sql3);
                        if($result3){
                            echo json_encode('success');
                            session_destroy();
                        }else{
                            echo json_encode('failed');
                            
                        }

                    }
                }else{
                    echo json_encode('incorrectcode');
                }
            }
            }else{
                echo json_encode('notauthorized');
            }
        }
    }
}