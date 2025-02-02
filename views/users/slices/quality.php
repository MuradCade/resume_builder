<?php

include('../../../model/db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $chosemethod = $_POST['chosemethod'];

    if($chosemethod == 'save'){
        $cvid = base64_decode($_POST['cvid']);
        $qualityname = $_POST['qualityname'];
        if(empty($qualityname)){
            echo json_encode('emptyqualityname');
        }else{
            $sql = "insert into qualities(cv_id,qualityname)values('$cvid','$qualityname')";
            $result = mysqli_query($connection,$sql);
            if($result){
                echo json_encode('success');
            }else{
                echo json_encode('failed');
            }
        }
    }else if($chosemethod == 'update'){
        $id = $_POST['id'];
        $qualitynames = $_POST['qualityname'];

       foreach($_POST['id'] as $key => $value){
        $sql = "update qualities set qualityname = '$qualitynames[$key]' where id='$value'";
        $result = mysqli_query($connection,$sql);
        $status = true;
       }
        if($status){
            echo json_encode('updatesuccess');
        }else{
            echo json_encode('updatefailed');
        }

    }

}else if($_SERVER['REQUEST_METHOD'] == 'GET'){

    $cvids = base64_decode($_GET['cvid']);
    $sql = "select * from qualities where cv_id = '$cvids'";
    $result = mysqli_query($connection,$sql);
    if(mysqli_num_rows($result) == 0){
        echo json_encode('There is no data to be shown');
    }else{
        $rowid = 1;
        while($row = mysqli_fetch_assoc($result)){
           echo "
           <p><strong>Section {$rowid}</strong></p>
           <hr>
            <div class='form-group mb-3'>
            <label class='form-label'>Quality Name</label>
            <input type='text' class='form-control'  name='qualityname[]' placeholder='Enter Quality Name...' value='{$row['qualityname']}' required>
            <input type='hidden' class='form-control'  name='id[]' placeholder='Enter Quality Name...' value='{$row['id']}'>
        </div>
           ";
        $rowid++;}
    }
}