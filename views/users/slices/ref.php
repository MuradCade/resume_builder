<?php
include('../../../model/db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $chosemethod = $_POST['chosemethod'];

    if($chosemethod == 'save'){
        $cvid = base64_decode($_POST['cvid']);
        $pname = trim($_POST['pname']);
        $pphone = trim($_POST['pphone']);
        $ptitle = trim($_POST['ptitle']);

        if(empty($pname)){
            echo json_encode('emptyperson_name');
        }else if(empty($pphone)){
            echo json_encode('emptyperson_phone');
        }else  if(empty($ptitle)){
            echo json_encode('emptyperson_title');
        }else{
            $sql = "insert into reference(cv_id,refname,refrole,refphone)values('$cvid','$pname','$ptitle','$pphone')";
            $result = mysqli_query($connection,$sql);
            if($result){
                echo json_encode('savesuccess');
            }else {
                echo json_encode('failed');
            }
        }
    }else if($chosemethod == 'update'){
        $id = $_POST['id'];
        $pname = trim($_POST['person_name']);
        $pphone = trim($_POST['person_phone']);
        $ptitle = trim($_POST['person_title']);


        $sql = "update reference set refname='$pname',refrole='$ptitle',refphone='$pphone' where id = '$id'";
        $result = mysqli_query($connection,$sql);
        if($result){
            echo json_encode('updatesuccess');
        }else{
            echo json_encode('updatefailed');
        }
    }
}else if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $cvids = base64_decode($_GET['cvid']);

    $sql =  "select * from reference where cv_id = '$cvids'";
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
                            <label class='form-label'>Person Name</label>
                            <input type='text' class='form-control'  name='person_name' placeholder='Enter Person Name...'  value='{$row['refname']}' required>
                            <input type='hidden' class='form-control'  name='id' placeholder='Enter Person Name...' value='{$row['id']}'>
                        </div>
                        <div class='form-group mb-3'>
                            <label class='form-label'>Person Phone Number</label>
                            <input type='text' class='form-control'  name='person_phone' placeholder='Enter Person Phone Number...' value='{$row['refphone']}' required>
                        </div>
                        <div class='form-group mb-3'>
                            <label class='form-label'>Person Title</label>
                            <input type='text' class='form-control'  name='person_title' placeholder='Enter Person Title...' value='{$row['refrole']}' required>
                        </div>";
        $rowid++;}
    }

}