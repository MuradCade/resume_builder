<?php

include('../../../model/db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){


    $chosemethod = $_POST['chosemethod'];

    if($chosemethod == 'save'){
        $cvid = base64_decode($_POST['cvid']);
        $jobname = $_POST['jobname'];
        $companyname = $_POST['companyname'];
        $desc = $_POST['desc'];
        $started_date = $_POST['date'];
        $end_date = $_POST['end_date'];
    
    
        if(empty($jobname)){
            echo json_encode('emptyjobname');
        }else if(empty($companyname)){
            echo json_encode('emptycompanyname');
    
        }else if(empty($desc)){
            echo json_encode('emptydesc');
    
        }else if(empty($started_date)){
            echo json_encode('emptystarted_date');
            
        }else if(empty($end_date)){
            echo json_encode('emptyend_date');
        }else{
            $sql = "insert into experience(cv_id,jobname,company_name,descriptions,startdate,end_date)values('$cvid','$jobname','$companyname','$desc','$started_date','$end_date')";
            $result = mysqli_query($connection,$sql);
            if($result){
                echo json_encode('success');
            }else {
                echo json_encode('failed');
    
            }
        }
    }else if($chosemethod == 'update'){
        $id = $_POST['id'];
        $companyname2 = $_POST['companyname'];
        $desc2 = $_POST['desc'];
        $started_date3 = $_POST['started_date'];
        $end_date4 = $_POST['end_date'];

        foreach($_POST['jobname']  as $key => $value){
            $sql = "update experience set jobname = '$value',company_name = '$companyname2[$key]',descriptions='$desc2[$key]',startdate='$started_date3[$key]',end_date='$end_date4[$key]' where id = '$id[$key]'";
            $result = mysqli_query($connection,$sql);
            $status = true;
        }

        if(isset($status)){
            echo json_encode('updatesuccess');
        }else{
            echo json_encode('updatefailed');

        }

    }
   

}else if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $id = base64_decode($_GET['cvid']);
        $sql= "select * from experience where cv_id = '$id'";
        $result = mysqli_query($connection,$sql);
        if(mysqli_num_rows($result) == 0){
            echo json_encode('there is no data to be shown');
        }else{
            $rowid = 1;
            while($row = mysqli_fetch_assoc($result)){
             echo "
                         <p> <strong>Education Section {$rowid}</strong></p>
                        <hr>
                <div class='form-group mb-3'>
                <label class='form-label'>Jobname</label>
                <input type='text' class='form-control' placeholder='Enter Jobname...' name='jobname[]' value='{$row['jobname']}' required>
                <input type='hidden' class='form-control' placeholder='Enter Jobname...' name='id[]' value='{$row['id']}'>
            </div>
            <div class='form-group mb-3'>
                <label class='form-label'>Companyname</label>
                <input type='text' class='form-control' placeholder='Enter Email...' name='companyname[]' value='{$row['company_name']}'required>
            </div>
            <div class='form-group mb-3'>
                <label class='form-label'>Description</label>
                <textarea name='desc[]' cols='70' rows='6' class='form-control' placeholder='Explain your role and your impact in that specific company'required>{$row['descriptions']}</textarea>
            </div>
            <div class='form-group mb-3'>
                <label class='form-label'>Started Date</label>
                <input type='date' class='form-control'  name='started_date[]' value='{$row['startdate']}'required>
            </div>
            <div class='form-group mb-3'>
                <label class='form-label'>End Date</label>
                <input type='date' class='form-control' name='end_date[]'  value='{$row['end_date']}'required>
            </div>
             ";
            $rowid++;}
        }
}