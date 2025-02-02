<?php

include('../../../model/db.php');


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    // this variable determines what action to be taken , if we need to save or update data
    $choosemethod = $_POST['chosemthod'];
    
 

    // save personal information
    if($choosemethod == 'save'){
           // personal information
    $cv = base64_decode($_POST['cvid']); 
    $fname = $_POST['fname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

        if(empty($fname)){
            echo json_encode('emptyfullname');
        }else if(empty($email)){
            echo json_encode('emptyemail');
        }else if(empty($phone)){
            echo json_encode('emptyphone');
        }else if(empty($address)){
            echo json_encode('emptyaddress');
        }else{
            $sql2 = "select * from personal_info where cv_id = '$cv'";
            $result2 = mysqli_query($connection,$sql2);
            if(mysqli_num_rows($result2) == 0){
                $sql = "insert into personal_info(cv_id,fullname,email,phone_number,address)values('$cv','$fname','$email','$phone','$address')";
            $result = mysqli_query($connection,$sql);
            if($result){
                echo json_encode('success');
            }else{
                echo json_encode('failed');
            }
            }
            else{
                echo json_encode('exists');
            }
        }

    }else if($choosemethod == 'update'){
              $id = $_POST['id'];
             // personal information
            $fname1 = $_POST['fname'];
            $email2 = $_POST['email'];
            $phone3 = $_POST['phone'];


            $address4 = $_POST['address'];
        //    echo json_encode($fname1);
        $sql = "update personal_info set fullname = '$fname1',email = '$email2',phone_number = '$phone3',address='$address4' where id  = '$id'";
        $result = mysqli_query($connection,$sql);
        if($result){
            echo json_encode('updatesuccess');
        }else{
            echo json_encode('updatefailed');
        }
        
    }
}else if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // display allinformation related to personal information in order to update it
    $cvids = base64_decode($_GET['cvid']);
    $sql = "select * from personal_info where cv_id  = '$cvids'";
    $result = mysqli_query($connection,$sql);
    if(mysqli_num_rows($result) == 0){
        echo 'in order to update first fill the personal information form';
    }else{
        while($row = mysqli_fetch_assoc($result)){
        echo "
         <div class='form-group mb-3'>
                            <label class='form-label'>Fullname</label>
                            <input type='text' class='form-control' placeholder='Enter Fullname...' name='fname' value='{$row['fullname']}' required>
                            <input type='hidden' class='form-control' placeholder='Enter Fullname...' name='id' value='{$row['id']}' required>
                        </div>
                        <div class='form-group mb-3'>
                            <label class='form-label'>Email</label>
                            <input type='text' class='form-control' placeholder='Enter Email...' name='email' value='{$row['email']}' required>
                        </div>
                        <div class='form-group mb-3'>
                            <label class='form-label'>Phone</label>
                            <input type='text' class='form-control' placeholder='Enter Phone...' name='phone' value='{$row['phone_number']}' required>
                        </div>
                        <div class='form-group mb-3'>
                            <label class='form-label'>Address</label>
                            <input type='text' class='form-control' placeholder='Enter Address...' name='address' value='{$row['address']}' required>
                        </div>
                        <button class='btn btn-success btn-sm edit-btn ' data-id={$row['id']}>Update</button>
        ";
        }
    }
}
