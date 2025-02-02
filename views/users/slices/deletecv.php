<?php
include('../../../model/db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $cvid = $_POST['cvid'];
    $mainsql = "delete from cv where id = '$cvid'";
    $mainresult = mysqli_query($connection,$mainsql);

if($mainresult){
    echo json_encode('success');
}else{
    echo json_encode('failed');
}
                
          
        
   
    
}