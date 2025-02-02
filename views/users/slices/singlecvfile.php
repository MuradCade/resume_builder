<?php
include('../../../model/db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $cvid = $_POST['cvid'];
    $sql = "select * from cv where id = '$cvid'";
    $result = mysqli_query($connection,$sql);
    if(mysqli_num_rows($result) == 0){
        echo json_encode('emptydbfile');
    }else{
        while($row = mysqli_fetch_assoc($result)){
            echo json_encode($row);
        }
    }
}