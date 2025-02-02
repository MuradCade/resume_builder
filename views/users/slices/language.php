<?php

include('../../../model/db.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){


    $chosemethod = $_POST['chosemethod'];

    if($chosemethod == 'save'){
        $cvid = base64_decode($_POST['cvid']);
        $language = $_POST['language'];
        $languagelevel = $_POST['languagelevel'];

        if(empty($language)){
            echo json_encode('emptylanguage');
        }else if(empty($languagelevel)){
            echo json_encode('emptylanguagelevel');
        }else{
            $sql = "insert into languages(cv_id,language,experience_level)values('$cvid','$language','$languagelevel')";
            $result = mysqli_query($connection,$sql);
            if($result){
                echo json_encode('savedsuccess');
            }else{
                echo json_encode('failed');
            }
        }
    }else if($chosemethod == 'update'){
        $language = $_POST['language'];
        $languagelevel = $_POST['languagelevel'];

            foreach($_POST['id'] as $key => $value){
                $sql = "update languages set language='$language[$key]' ,  experience_level = '$languagelevel[$key]' where id = '$value'";
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
    $sql = "select * from languages where cv_id = '$cvids'";
    $result = mysqli_query($connection,$sql);
    if(mysqli_num_rows($result) == 0){
        echo json_encode('There is no data to be shown');
    }else{
        $rowid = 1;
        while($row = mysqli_fetch_assoc($result)){


          
            echo"
            <p><strong>Section {$rowid}</strong></p>
            <hr>
             <div class='form-group mb-3'>
                <label class='form-label'>Language</label>
                <input type='text' class='form-control'  name='language[]' placeholder='Enter Language ...' value='{$row['language']}' required>
                <input type='hidden' class='form-control'  name='id[]' placeholder='Enter Language ...' value='{$row['id']}'>
            </div>";
            echo "<div class='form-group mb-3'>
                <label class='form-label'>Select Your Language Proficiency Level</label>";
                if($row['experience_level'] == 'beginner'){

                    echo "<select class='form-control' name='languagelevel[]'>
                    <option value='{$row['experience_level']}'>{$row['experience_level']}</option>
                    <option value='intermediate'>intermediate</option>
                    <option value='advanced'>advanced</option>
                    <option value='native'>native</option></select>";
                }else if($row['experience_level'] == 'intermediate'){
                    echo "<select class='form-control' name='languagelevel[]'>
                    <option value='{$row['experience_level']}'>{$row['experience_level']}</option>
                   <option value='beginner'>beginner</option>
                    <option value='advanced'>advanced</option>
                   <option value='native'>native</option></select>";
                }else if($row['experience_level'] == 'advanced'){
                   echo "<select class='form-control' name='languagelevel[]'>
                    <option value='{$row['experience_level']}'>{$row['experience_level']}</option>
                 <option value='beginner'>beginner</option>
                <option value='intermediate'>intermediate</option>
                   <option value='native'>native</option></select>";
                }else if($row['experience_level'] == 'native'){
                 echo "<select class='form-control' name='languagelevel[]'><option value='{$row['experience_level']}'>{$row['experience_level']}</option>
                <option value='beginner'>beginner</option>
              <option value='intermediate'>intermediate</option>
                    <option value='advanced'>advanced</option></select>";

                }
                echo "</div>";
        $rowid++;}
    }
}