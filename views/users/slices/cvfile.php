<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include('../../../model/db.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
 
    $userid = $_SESSION['uid'];
    $sql = "select * from cv where userid = '$userid'";
    $result = mysqli_query($connection,$sql);
    if(mysqli_num_rows($result) == 0){
        echo 'There is no data to be shown';
    }else{

      function turnbase64($data){
        return  base64_encode($data);
      }
        while($row = mysqli_fetch_assoc($result)){
            $date = date("F j, Y", strtotime($row['created_date']));
            
            
            echo "<div class='col-lg-3 col-md-6 col-sm-12 mt-4'>
              <div class='card' style='position: relative !important;'>
                <!-- Image Holder -->
                <div class='image-holder rounded-top' style='height: 120px; background-color: #6c757d !important; position: relative !important; overflow: hidden !important;''>
                  <div id='cv-preview'>
                    <p>
                      <img src='../../assets/images/logo.png'> Preview
                    </p>
                  </div>
                </div>
                <div class='card-body'>
                  <h4 style='font-size: 19px !important; text-transform: capitalize' class='text-truncate'>{$row['title']}</h4>
                  <p style='font-size: 14px !important; text-transform: capitalize; margin-bottom: 0px !important;'>{$date}</p>
                  <div style='margin-bottom: 2px !important; margin-top: -10px;'>
                    <a href='cv_editor.php?resume_id=".turnbase64($row['id'])."' class='mt-4 btn btn-primary btn-sm fw-bold'>View</a>
                    <button  class='mt-4 btn btn-warning btn-sm fw-bold  btn-edit' data-id='{$row['id']}' data-bs-toggle='modal' data-bs-target='#updatemodel'>Edit</button>
                    <button  class='mt-4 btn btn-danger btn-sm fw-bold btn-delete' data-id='{$row['id']}'>Delete</button>
                  </div>
                </div>
              </div>
            </div>
            </div>
            ";
        }
    }
}

// update single cv file name
else if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $cvid2 = $_POST['cvid2'];
    $title = $_POST['title'];

    $sql = "update cv set title = '$title' where id = '$cvid2'";
    $result = mysqli_query($connection,$sql);
    if($result){
        echo json_encode('updatesuccess');
    }else{
        echo json_encode('update_failed');
    }
}