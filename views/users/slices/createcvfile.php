<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include_once('../../../model/db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $cvfilename = mysqli_escape_string($connection,$_POST['cvfilename']);
    $userid = $_SESSION['uid'];

    if(empty($cvfilename)){
        echo json_encode('emptycvname');
    }else{
        $sql2 = "select * from cv where userid = '$userid' and title='$cvfilename'";
        $result2 = mysqli_query($connection,$sql2);
        if(mysqli_num_rows($result2) == 0){
            $sql = "insert into cv(userid,title)values('$userid','$cvfilename')";
            $result = mysqli_query($connection,$sql);
            if($result){
                echo json_encode('success');
            }else{
                echo json_encode('failed');
            }
        }else{
            echo json_encode('alreadyexist');
        }
       
    }
}else{
    echo json_encode('Server doesnt support this request');
}