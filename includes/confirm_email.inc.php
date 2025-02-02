<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include_once('../model/db.php');
include_once('send_email.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $verification_code = mysqli_real_escape_string($connection,$_POST['verificationcode']);
    $userid = $_SESSION['userid'];
if(empty($verification_code)){
    echo json_encode('emptyverificationcode');
}else{
    
    $sql = "select * from email_confirm where userid = '$userid'and  verification_code = '$verification_code'";
    $result = mysqli_query($connection,$sql);
    if(mysqli_num_rows($result) == 0){
        echo json_encode('codeerror');
    }else{
       while($row = mysqli_fetch_assoc($result)){

         if($row['verification_code'] == $verification_code){
            $id = $row['id'];
            $sql2 = "update  email_confirm set verified = '1' where id = '$id'";
            $result2 = mysqli_query($connection,$sql2);
            if($result2){
                $emailarray = ["email"=>$_SESSION['useremail'],"username"=>$_SESSION['username'],"subject"=>" Congratulations! Your Account is Activated 🎉","body"=>"
             
                 <style>
                                    body {
                                        font-family: Arial, sans-serif;
                                        background-color: #f4f4f4;
                                        margin: 0;
                                        padding: 0;
                                    }
                                    .email-container {
                                        max-width: 600px;
                                        margin: 20px auto;
                                        background-color: #ffffff;
                                        border-radius: 8px;
                                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                                        overflow: hidden;
                                    }
                                    .email-header {
                                        background-color: #565e64;
                                        color: #ffffff;
                                        padding: 20px;
                                        text-align: center;
                                    }
                                    .email-body {
                                        padding: 20px;
                                        color: #333333;
                                        line-height: 1.6;
                                    }
                                    .email-body h1 {
                                        margin-top: 0;
                                    }
                                    .email-footer {
                                        background-color: #f4f4f4;
                                        padding: 10px;
                                        text-align: center;
                                        font-size: 12px;
                                        color: #666666;
                                    }
                                    .confirm-button {
                                        display: inline-block;
                                        background-color: #007bff;
                                        color: #ffffff;
                                        text-decoration: none;
                                        padding: 10px 20px;
                                        border-radius: 4px;
                                        margin-top: 20px;
                                        font-weight: bold;
                                    }
                                    .confirm-button:hover {
                                        background-color: #0056b3;
                                    }
                                </style>

                                <div class='email-container'>
                                    <div class='email-header'>
                                        <h1 style='font-size: 20px;position:relative; top:5px;'>Congratulations! Your Account is Activated 🎉</h1>
                                    </div>
                                    <div class='email-body'>
                                        <p>Hi , {$_SESSION['username']} ,                                         
                                            Great news! Your account on Cv-Builder has been successfully activated.

                                            You can now:

                                            <ul>
                                            <li>Create professional resumes effortlessly.</li>
                                            <li>Access and edit your saved resumes anytime.</li>
                                            <li> Download and share your resumes with ease.</li>
                                            </ul>
                                            
                                           
                                            We’re thrilled to have you with us and can’t wait to see the amazing resumes you’ll build!</p>
                                       
                                        
                                        <p>
                                        If you have any questions or need assistance, our support team is here to help.

                                            Thank you for choosing Cv-Builder Platform.

                                            Best regards,
                                            The Cv-Builder Team.
                                        </p>
                                    </div>
                                    <div class='email-footer'>
                                        <p>&copy; 2025 Cv-Builder. All rights reserved.</p>
                                    </div>
                                </div> 
                

                               
                "];


                $sended_message = sendemail($emailarray['email'],$emailarray['username'],$emailarray['subject'],$emailarray['body']);
                if($sended_message){
                    session_destroy();
                    echo json_encode('success');

                }

            }else{
                echo json_encode('internal server error');

            }

         }
       }

    }
   
}
}else{
    echo json_encode('request not supported');
}