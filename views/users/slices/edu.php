<?php
include('../../../model/db.php');


if($_SERVER['REQUEST_METHOD'] == 'POST'){
  
    $chosemethod = $_POST['chosemethod'];
    if($chosemethod == 'save'){
        $cvid = base64_decode($_POST['cvid']);
        $etitle = $_POST['etitle'];
        $uniname = $_POST['uniname'];
        $started_date = $_POST['started_date'];
        $end_date = $_POST['end_date'];
    
    
    
        if(empty($etitle)){
            echo json_encode('emptytitle');
        }else if(empty($uniname)){
            echo json_encode('emptyuniname');
            
        }else if(empty($started_date)){
            echo json_encode('emptystarted_date');
            
        }else if(empty($end_date)){
            echo json_encode('emptyend_date');
        }else{
    
                
            $sql = "insert into education(cv_id,edutitle,uniname,startdate,end_date)values('$cvid','$etitle','$uniname','$started_date','$end_date')";
            $result = mysqli_query($connection,$sql);
    
            if($result){
                echo json_encode('success');
            }else{
                echo json_encode('failed');
                
            }
        }
    }else if($chosemethod == 'update'){
        $id = $_POST['id'];
        $uniname = $_POST['uniname'];
        $started_date = $_POST['started_date'];
        $end_date = $_POST['end_date'];

        foreach($_POST['etitle'] as $key=> $value){
            // echo json_encode($id[$key]);
            $sql2 = "update education set edutitle='$value',uniname='$uniname[$key]',startdate='$started_date[$key]',end_date='$end_date[$key]' where id='$id[$key]'";
            $result2 = mysqli_query($connection,$sql2);
            if($result2){
                $status = true;

            }
        }

        if(isset($status)){
            echo json_encode('updatesuccess');
        }else{
            echo json_encode('updatefailed');

        }
    }

}else if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $cvids =base64_decode($_GET['cvid']);
    $sql = "select * from education where cv_id = '$cvids'";
    $result = mysqli_query($connection,$sql);
    if(mysqli_num_rows($result) == 0){
        echo json_encode('Sorry There is no data to be shown');
    }else{
        $rowid = 1;
        while($row = mysqli_fetch_assoc($result)){
            echo "
            <p> <strong>Education Section {$rowid}</strong></p>
            <hr>
            <div class='form-group mb-3'>
            <label class='form-label'>Education Title (e.g faculty name etc.)</label>
            <input type='text' class='form-control' placeholder='Enter Education Title...' name='etitle[]' value='{$row['edutitle']}'>
            <input type='hidden' class='form-control' placeholder='Enter Education Title...' name='id[]' value='{$row['id']}'>
        </div>
        <div class='form-group mb-3'>
            <label class='form-label'>Univeristy Name</label>
            <input type='text' class='form-control' placeholder='Enter University Name...' name='uniname[]' value='{$row['uniname']}'>
        </div>
        <div class='form-group mb-3'>
            <label class='form-label'>Started Date</label>
            <input type='date' class='form-control'  name='started_date[]' value='{$row['startdate']}'>
        </div>
        <div class='form-group mb-3'>
            <label class='form-label'>End Date</label>
            <input type='date' class='form-control'  name='end_date[]' value='{$row['end_date']}'>
        </div>";
        $rowid++;}
    }

}