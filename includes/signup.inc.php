<?php
include_once('../model/db.php');
include_once('send_email.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $random_generated_userid = rand(1,99999999);
    $username = $_POST['username'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];
    $hashedpwd = password_hash($pwd,PASSWORD_DEFAULT);

    // random generated code for the user to verify its email 
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=';
        $charactersLength = strlen($characters);
        $randomString = '';

        // Generate a 5-character random string
        for ($i = 0; $i < 10; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        

    if(empty($username)){
        echo json_encode('emptyusername');
    }else if(empty($email)){
        echo json_encode('emptyemail');
    }else if(empty($pwd)){
        echo json_encode('emptypwd');
    }else{
        $sql3 = "select * from users where email = '$email'";
        $result3 = mysqli_query($connection,$sql3);
        if(mysqli_num_rows($result3) >0){
            echo json_encode('exists');
        }else{
            $sql = "insert into users(userid,username,email,password)values('$random_generated_userid','$username','$email','$hashedpwd')";
            $result = mysqli_query($connection,$sql);
    
            if($result){
                $sql2= "insert into email_confirm(userid,verification_code,verified)values('$random_generated_userid','$randomString','0')";
                $result2 = mysqli_query($connection,$sql2);
                if($result2){
                    $emailarray = ["email"=>$email,"username"=>$username,"subject"=>"Confirm Your Email","body"=>"
                                    <div class='email-container'>
                                        <div class='email-header'>
                                            <h1 style='font-size: 20px;position:relative; top:5px;'>Confirm Your Email Address</h1>
                                        </div>
                                        <div class='email-body'>
                                            <p>Hi , {$username} , Thank you for signing up! in order to activate your account you will need to copy the cod below and paste in proper place.</p>
                                            <p>Your Code: <strong>{$randomString}</strong></p>
                                            
                                            <p>If you did not create an account, you can safely ignore this email.</p>
                                        </div>
                                        <div class='email-footer'>
                                            <p>&copy; 2025 Cv-Builder. All rights reserved.</p>
                                            <p>This email was sent to you because you signed up on our platform.</p>
                                        </div>
                                    </div> 
                    "];
    
    
                    $sended_message = sendemail($emailarray['email'],$emailarray['username'],$emailarray['subject'],$emailarray['body']);
                    if($sended_message){
                        echo json_encode('success');
                        session_start();
                        $_SESSION['useremail'] = $email;
                        $_SESSION['userid'] = $random_generated_userid;
                        $_SESSION['username'] = $username;
                        // header('location:../email_verification.php');
                        // exit();
                    }else{
                        echo $sended_message;
                    }
                }
            }
        }
       

    }
}