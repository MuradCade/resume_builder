<?php
include('../../../model/db.php');



if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // variable below specifies which function should be run when saving resume information
    $method = $_POST['method'];


    // cvid= cv is the file id
    $cv = $_POST['cv'];
    // personal information variables
  


    // education variables
    $etitle = $_POST['etitle'];
    $uniname = $_POST['uniname'];
    $started_date = $_POST['started_date'];
    $end_date = $_POST['end_date'];


    // experience variables
    $jobname = $_POST['jobname'];
    $companyname = $_POST['companyname'];
    $desc = $_POST['desc'];
    $starteddate = $_POST['started_date'];
    $enddate = $_POST['end_date'];


    // quality variables
    $qualityname = $_POST['qualityname'];


    // language variables
    $language = $_POST['language'];
    $languagelevel = $_POST['languagelevel'];




    // refrence variables
    $person_name = $_POST['person_name'];
    $person_phone = $_POST['person_phone'];
    $person_title = $_POST['person_title'];

    

    // this function saves personal informations
    function savepersonalinformation($connection,$cv,$fname,$email,$phone,$address){

        if(empty($name)){
            echo json_encode('emptyfullname');
        }else if(empty($email)){
            echo json_encode('emptyemail');
        }else if(empty($phone)){
            echo json_encode('emptyphone');
        }else if(empty($address)){
            echo json_encode('emptyaddress');
        }else{
            $sql = "insert into personal_info(cv_id,fullname,email,phone_number,address)values('$cv','$fname','$email','$phone','$address')";
            $result = mysqli_query($connection,$sql);
            if($result){
                echo json_encode('success');
            }else{
                echo json_encode('failed');
            }
        }

    }

    // save education information functions
    function saveeducation($connection,$cv,$etitle,$uniname,$started_date,$end_date){
        if(empty($etitle)){
            echo json_encode('emptytitle');
        }else if(empty($uniname)){
                echo json_encode('emptyuniname');
        }else if(empty($started_date)){
            echo json_encode('emptystarteddate');
        }else if(empty($end_date)){
            echo json_encode('emptyenddate');
        }else{
            $sql = "insert into education(cv_id,edutitle,uniname,startdate,end_date)values('$cv','$etitle','$uniname','$started_date','$end_date')";
            $result = mysqli_query($connection,$sql);
            if($result){
                echo json_encode('success');
            }else{
                echo json_encode('failed');
            }
        }
    }

    // save expreince
    function save_exprience($connection,$cv,$jobname,$companyname,$desc,$starteddate,$enddate){
        if(empty($jobname)){
            echo json_encode('emptyjobname');
        }else if(empty($companyname)){
                echo json_encode('emptycompanyname');
        }else if(empty($desc)){
            echo json_encode('emptydesc');
        }else if(empty($starteddate)){
            echo json_encode('emptystarteddate');
        }else if(empty($enddate)){
            echo json_encode('emptyenddate');
        }else{
            $sql = "insert into experience(cv_id,jobname,company_name,descriptions,startdate,end_date)values('$cv','$jobname','$companyname','$desc','$starteddate','$enddate')";
            $result = mysqli_query($connection,$sql);
            if($result){
                echo json_encode('success');
            }else{
                echo json_encode('failed');
            }
        }
    }


    // save quality information
    function savequality($connection,$cv,$qualityname){
        if(empty($qualityname)){
            echo json_encode('emptyqualityname');
        }else{
            $sql = "insert into qualities(cv_id,qualityname)values('$cv','$qualityname')";
            $result = mysqli_query($connection,$sql);
            if($result){
                echo json_encode('success');
            }else{
                echo json_encode('failed');
            }
        }
    }

    // save language function
    function savelanguage($connection,$cv,$language,$languagelevel){
        if(empty($language)){
            echo json_encode('emptylanguage');
        }else if(empty($languagelevel)){
            echo json_encode('emptylanguagelevel');
        }else{
            $sql = "insert into languages(cv_id,language,experience_level)values('$cv''$language','$languagelevel')";
            $result = mysqli_query($connection,$sql);
            if($result){
                echo json_encode('success');
            }else{
                echo json_encode('failed');
            }
        }
    }


    // save refrence function
    function saverefrences($connection,$cv,$person_name,$person_phone,$person_title){
        if(empty($person_name)){
            echo json_encode('emptypersonname');
        }else if(empty($$person_phone)){
            echo json_encode('emptypersonphone');
        }else if(empty($person_title)){
            echo json_encode('emptypersontitle');
        }else{
            $sql = "insert into reference(cv_id,refname,refrole,refphone	)values('$cv''$person_name','$person_title','$person_phone')";
            $result = mysqli_query($connection,$sql);
            if($result){
                echo json_encode('success');
            }else{
                echo json_encode('failed');
            }
        }
    }
}