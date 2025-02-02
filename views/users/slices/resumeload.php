<?php

include('../../../model/db.php');
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $action = $_GET['action'];

    if($action == 'personaldata'){
        $cvid = base64_decode($_GET['cvid']);
        $sql ="select * from personal_info where cv_id = '$cvid'";
        $result = mysqli_query($connection,$sql);
        if(mysqli_num_rows($result) == 0){
            echo json_encode('There is no data to be shown');
        }else{
            while($row = mysqli_fetch_assoc($result)){
               echo "
                <div id='personalinformations'style='display:flex;  justify-content:center; gap:10px;'>
                <p style='font-size:19px; text-transform:uppercase;' class='space title'>{$row['fullname']}</p>
<button class='btn  text-danger btn-sm btn-delete-1'data-id='{$row['id']}'><i class='bi bi-trash'></i></button>                </div>
                
                <div style='margin-left:10px;display: flex; align-items:start; justify-content:start; gap:14px; position:relative;top:10px;'>
                <p style='margin-top:10px;' class='subtitle'><strong>Phone</strong>: {$row['phone_number']}</p>
                <p style=' margin-top:10px;'class='subtitle'><strong>Email</strong>: {$row['email']}</p>
                <p style='margin-right:10px; margin-top:10px;' class='subtitle text-wrap'><strong>Address</strong>: {$row['address']}</p>
            </div>
            
               ";
            }
        }
    }else  if($action == 'education'){
        $cvid2 = base64_decode($_GET['cvid']);
        $sql = "select * from education where cv_id = '$cvid2'";
        $result = mysqli_query($connection,$sql);
        if(mysqli_num_rows($result) == 0){
            echo json_encode('There is no data to be shown');
        }else{
            while($row = mysqli_fetch_assoc($result)){
               echo "
                <div class='content'>
                
               <div style='display:flex;'   >
                <h6  style='margin-top:20px !important; font-size:18px; margin-left:10px;'>{$row['edutitle']}</h6>
<button class='btn  text-danger btn-sm btn-delete-2'data-id='{$row['id']}'><i class='bi bi-trash'></i></button>               </div>
                <p style='margin-left:10px; font-weight:500; text-transform:capitalize; font-size:13px' id='p'>{$row['uniname']}</p>
                <div style='display:flex !important;  justify-content:space-evently; gap:10px; margin-top:-10px;' id='dates'>
                <span style='margin-left:10px; font-weight:500; text-transform:capitalize; font-size:13px'>Started: {$row['startdate']}</span>
                <span style='margin-left:10px; font-weight:500; text-transform:capitalize; font-size:13px'>Ended: {$row['end_date']} </span>
                </div>
            </div>
               ";
            }
        }
    }else if($action == 'expo'){
        $cvid3 = base64_decode($_GET['cvid']);
        $sql = "select * from experience where cv_id = '$cvid3'";
        $result = mysqli_query($connection,$sql);
        if(mysqli_num_rows($result) == 0){
            echo json_encode('There is no data to be shown');
        }else{
            while($row = mysqli_fetch_assoc($result)){
                echo "
               <div style='display:flex;'>
                <h6  style='margin-top:20px !important; font-size:18px; margin-left:10px;'>{$row['jobname']}</h6>
<button class='btn  text-danger btn-sm btn-delete-3'data-id='{$row['id']}'><i class='bi bi-trash'></i></button>   
</div>             <p style='margin-left:10px; font-weight:500; text-transform:capitalize; font-size:12px'>{$row['company_name']}</p>
                <p style='margin-left:10px; font-weight:500; text-transform:capitalize; font-size:13px;line-height:1.8em; margin-top:-10px;' class='w-70 w-md-75 text-wrap' id='p'>{$row['descriptions']}</p>
                <div style='display:flex !important;  justify-content:space-evently; gap:10px; margin-top:-10px;' id='date'>
                <span style='margin-left:10px; font-weight:500; text-transform:capitalize; font-size:13px'>Started: {$row['startdate']}</span>
                
                <span style='margin-left:10px; font-weight:500; text-transform:capitalize; font-size:13px'>Ended: {$row['end_date']} </span>
                </div>
                
                ";
            }
        }
    }else if($action == 'quality'){
        $cvid4 = base64_decode($_GET['cvid']);
        $sql = "select * from qualities where cv_id = '$cvid4'";
        $result = mysqli_query($connection,$sql);
        if(mysqli_num_rows($result) == 0){
            echo json_encode('There is no data to be shown');
        }else{
            while($row = mysqli_fetch_assoc($result)){
                echo "
                    <div style='display:flex;'>

                    <li style='margin-left:10px; font-weight:500; text-transform:capitalize; font-size:13px'>{$row['qualityname']}</li>
<button class='btn  text-danger btn-sm btn-delete-4'data-id='{$row['id']}'><i class='bi bi-trash'></i></button>                       </div>
                ";
            }
        }
    }
    else if($action == 'langauage'){
        $cvid5 = base64_decode($_GET['cvid']);
        $sql = "select * from languages where cv_id = '$cvid5'";
        $result = mysqli_query($connection,$sql);
        if(mysqli_num_rows($result) == 0){
            echo json_encode('There is no data to be shown');
        }else{
            while($row = mysqli_fetch_assoc($result)){
            echo "
            <div style='display:flex;'>
            <li style='margin-left:10px; font-weight:500; text-transform:capitalize; font-size:13px'> {$row['language']}({$row['experience_level']})</li>
            
            <button class='btn  text-danger btn-sm btn-delete-5'data-id='{$row['id']}'><i class='bi bi-trash'></i></button>
            </div>";
            }
        }
    }else if($action == 'refrence'){
        $cvid6 = base64_decode($_GET['cvid']);
        $sql = "select * from reference where cv_id = '$cvid6'";
        $result = mysqli_query($connection,$sql);
        if(mysqli_num_rows($result) == 0){
            echo json_encode('There is no data to be shown');
        }else{
            while($row = mysqli_fetch_assoc($result)){
            echo "
                     <div style='display:flex !important;'>
                     <h6 style='margin-top:20px !important; font-size:18px; margin-left:10px;text-transform:capitalize !important;'>{$row['refname']}</h6>
                     <button class='btn  text-danger btn-sm btn-delete-6'data-id='{$row['id']}'><i class='bi bi-trash'></i></button></div>
                    <p style='margin-left:10px; font-weight:500; text-transform:capitalize; font-size:14px' id='p1'>{$row['refrole']}</p>
                    <p style='margin-left:10px; font-weight:500; text-transform:capitalize; font-size:12px;margin-bottom:10px; margin-top:-12px;' id='p2'>Phone: {$row['refphone']}</p>";
            }
        }
    }else if($action == 'delete'){
        $id = $_GET['id'];
        $tablename = $_GET['tablename'];
        // echo json_encode($_GET);
        $sql = "delete from $tablename where id = '$id'";
        $result = mysqli_query($connection,$sql);
        if($result){
            echo json_encode('Deleted Successfully');
        }else{
            echo json_encode('Failed To Delete');
        }
    }
}