<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['uid'])){
  header('location:../../login.php?redirected');
  exit();
}


?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CV Builder | Resume Editor</title>
    <link rel="shortcut icon" href="../../assets/images/logo.png" type="image/x-icon">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      body {
        font-family: "Poppins", serif;
        font-style: normal;
        width: 100%;
        height: 100vh;
        margin: 0;
        display: flex;
      }
      .left-column, .right-column {
        height: 100%;
        overflow-y: auto;
      }
      .left-column {
        font-family: "Poppins", serif;
        font-style: normal;
        width: 50%;
        background-color: #fff;
        padding: 20px;
    }
    .right-column {
        font-family: "Poppins", serif !important;
        font-style: normal;
          width: 50%;

        background-color: #f8f9fa;
        padding: 20px;
        border-left: 1px solid #dee2e6;
      }
      .title{
        font-weight: 700;
        letter-spacing: 0.5px;
      }
      .space{
        /* font-size: 18px; */
        /* font-weight: bold; */
        margin-left:10px;
        margin-top:10px;
        margin-bottom: -5px;
      }
      .alltitle{
        font-size: 20px;
        font-weight: 600;
        letter-spacing: 0.5px;
      }
      .subtitle{
        font-size: 13px !important;
        font-weight: 500;
      }
      /* responsive view */
      @media (max-width: 768px) {
        .left-column, .right-column {
          width: 100%;
          padding: 10px;
          height: auto;
        }
        .right-column {
            padding-top:10px ;
          border-left: none;
          margin-top: 20px;
        }
        .accordion-button {
          font-size: 14px;
        }
        .form-control {
          font-size: 14px;
        }
        .btn {
          font-size: 12px;
        }
      }
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row h-100">
        <!-- Left Column: CV Form -->
        <div class="col-md-6 left-column">
       
            <a href="index.php"  style="font-size:14px;"><i class="bi bi-arrow-left-circle me-2"></i>Go Back</a>
        <h1 class="h2 mt-3" style="font-size: 16px; display: flex; align-items: center;"> 
              <img src="../../assets/images/logo.png" width="50"> Builder | Dashboard | Resume Editor 
            </h1>
          <hr>

          <div class="container mt-5">
  <!-- Tabs Navigation -->
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Add New Content</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Update Content</button>
    </li>
    
  </ul>

  <!-- Tabs Content -->
  <div class="tab-content" id="myTabContent">
        <!-- tap one -->
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    <div class="accordion" id="accordionExample">
              <!-- one start here -->
              <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Personal Information
                    </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p class="p-2 text-white fw-bold d-none" id="msg" style="font-size:14px !important;"></p>
                        <p style="text-transform: capitalize; font-size:15px; font-weight:600;">fill the form below and click save</p>
                        <form id="personalinfoform" method="POST">
                        <div class="form-group mb-3">
                            <label class="form-label">Fullname</label>
                            <input type="text" class="form-control" placeholder="Enter Fullname..." id="fname">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" placeholder="Enter Email..." id="email">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" placeholder="Enter Phone..." id="phone">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" placeholder="Enter Address..." id="address">
                        </div>
                        <button class="btn btn-primary btn-sm text-white fw-bold mt-2">Save</button>
                        </form>
                    </div>
                    </div>
                </div>
               <!-- one end -->


               <!-- two starts here -->
               <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Education
                    </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <p style="text-transform: capitalize; font-size:15px; font-weight:600;">fill the form below and click save</p>
                    <p class="p-2 text-white fw-bold d-none" id="msg2" style="font-size:14px !important;"></p>

                    <form id="educationform" method="POST">
                        <div class="form-group mb-3">
                            <label class="form-label">Education Title (e.g faculty name etc.)</label>
                            <input type="text" class="form-control" placeholder="Enter Education Title..." id="etitle">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Univeristy Name</label>
                            <input type="text" class="form-control" placeholder="Enter University Name..." id="uniname">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Started Date</label>
                            <input type="date" class="form-control"  id="started_date">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control"  id="end_date">
                        </div>
                        <button class="btn btn-primary btn-sm text-white fw-bold mt-2">Save</button>
                        </form>
                    </div>
                    </div>
                </div>
               <!-- two end -->
                <!-- three starts here-->
                <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Exprience
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                <p style="text-transform: capitalize; font-size:15px; font-weight:600;">fill the form below and click save</p>
                <p class="d-none p-2 text-white fw-bold" id='msg3' style="font-size: 14px;"></p>
                <form id="expreinceform" method="POST">
                        <div class="form-group mb-3">
                            <label class="form-label">Jobname</label>
                            <input type="text" class="form-control" placeholder="Enter Jobname..." id="jobname">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Companyname</label>
                            <input type="text" class="form-control" placeholder="Enter Email..." id="companyname">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Description</label>
                            <textarea id="desc" cols='70' rows='6' class="form-control" placeholder="Explain your role and your impact in that specific company"></textarea>
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Started Date</label>
                            <input type="date" class="form-control"  id="date1">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">End Date</label>
                            <input type="date" class="form-control"  id="date2">
                        </div>
                        <button class="btn btn-primary btn-sm text-white fw-bold mt-2">Save</button>
                        </form>
            </div>
                </div>
            </div>
                 <!-- end here -->

                 <!-- four start here -->
                 <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Qualities
                </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                <p style="text-transform: capitalize; font-size:15px; font-weight:600;">fill the form below and click save</p>
                <p class="d-none p-2 text-white fw-bold" id='msg4' style="font-size: 14px;"></p>
                <form id="qualityform">
                <div class="form-group mb-3">
                            <label class="form-label">Quality Name</label>
                            <input type="text" class="form-control"  id="qualityname" placeholder="Enter Quality Name...">
                        </div>
                        <button class="btn btn-primary btn-sm text-white fw-bold mt-2">Save</button>
                </form>
                </div>
                </div>
            </div>
                  <!-- four end here -->

            <!-- five start here -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                   Languages
                </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                <p style="text-transform: capitalize; font-size:15px; font-weight:600;">fill the form below and click save</p>
                <p class="d-none p-2 text-white fw-bold" id='msg5' style="font-size: 14px;"></p>

                <form id="languageform">
                        <div class="form-group mb-3">
                            <label class="form-label">Language</label>
                            <input type="text" class="form-control"  id="language" placeholder="Enter Language ...">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Select Your Language Proficiency Level</label>
                            <select class="form-control" id="languagelevel">
                                <option value="" disabled selected>Select your level</option>
                                <option value="beginner">Beginner</option>
                                <option value="intermediate">Intermediate</option>
                                <option value="advanced">Advanced</option>
                                <option value="native">Fluent</option>
                            </select>
                        </div>
                        <button class="btn btn-primary btn-sm text-white fw-bold mt-2">Save</button>
                </form>
                </div>
                </div>
            </div>
             <!-- end here  -->
              <!-- six starts here -->
              <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    Refrences
                </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                <p style="text-transform: capitalize; font-size:15px; font-weight:600;">fill the form below and click save</p>
                <p class="d-none p-2 text-white fw-bold" id='msg6' style="font-size: 14px;"></p>

                <form id="refrencesform">
                        <div class="form-group mb-3">
                            <label class="form-label">Person Name</label>
                            <input type="text" class="form-control"  id="person_name" placeholder="Enter Person Name...">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Person Title</label>
                            <input type="text" class="form-control"  id="person_title" placeholder="Enter Person Title...">
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Person Phone Number</label>
                            <input type="text" class="form-control"  id="person_phone" placeholder="Enter Person Phone Number...">
                        </div>
                        <button class="btn btn-primary btn-sm text-white fw-bold mt-2">Save</button>
                </form>
                </div>
                </div>
            </div>
               <!-- end here -->
        </div>
    </div>
    <!-- end here -->
     <!-- tap 2 -->
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
    <div class="accordion" id="accordionExample">
              <!-- one start here -->
              <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Personal Information
                    </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <p class="p-2 text-white fw-bold d-none" id="updatemsg1" style="font-size:14px !important;"></p>

                        <p style="text-transform: capitalize; font-size:15px; font-weight:600;">fill the form below to update your personal information</p>
                        <form id="updatepersonalinfoform" method="POST" >
                            <div id="personalcontent">

                            </div>
                        </form>
                    </div>
                    </div>
                </div>
               <!-- one end -->


               <!-- two starts here -->
               <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Education
                    </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                    <p style="text-transform: capitalize; font-size:15px; font-weight:600;">fill the form below to update your Education Information</p>
                    <p class="d-none p-2 text-white fw-bold" style='font-size:14px' id='update2'></p>
                    <form id="updateeducationform" method="POST">
                        <div id="educationinformation">
                            </div>
                            <button class='btn btn-success btn-sm text-white fw-bold mt-2'>Update</button>
                        </form>
                    </div>
                    </div>
                </div>
               <!-- two end -->
                <!-- three starts here-->
                <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                    Exprience
                </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                
                    <p style="text-transform: capitalize; font-size:15px; font-weight:600;">fill the form below to update your Experience information</p>
                    <p class="d-none p-2 text-white fw-bold" id="update3"></p>
                <form id="updateexpreinceform" method="POST">
                       <div id="experienceinformation">

                       </div>
                        <button class="btn btn-success btn-sm text-white fw-bold mt-2">Update</button>
                        </form>
            </div>
                </div>
            </div>
                 <!-- end here -->

                 <!-- four start here -->
                 <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    Qualities
                </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                <p style="text-transform: capitalize; font-size:15px; font-weight:600;">fill the form below to update your Quality information</p>
                <p class="d-none p-2 text-white fw-bold" style='font-size:14px' id="update4"></p>
                <form id="updatequalityform">
                        <div id="qaulityinfo">

                        </div>
                        <button class="btn btn-success btn-sm text-white fw-bold mt-2">Update</button>
                </form>
                </div>
                </div>
            </div>
                  <!-- four end here -->

            <!-- five start here -->
            <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                   Languages
                </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                <p style="text-transform: capitalize; font-size:15px; font-weight:600;">fill the form below to update your Language information</p>
                <p class="d-none p-2 text-white fw-bold" style='font-size:14px' id="update5"></p>
                <form id="updatelanguageform">
                        <div id="displaylanguageform">

                        </div>
                        <button class="btn btn-success btn-sm text-white fw-bold mt-2">Update</button>
                </form>
                </div>
                </div>
            </div>
             <!-- end here  -->
              <!-- six starts here -->
              <div class="accordion-item">
                <h2 class="accordion-header">
                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                    Refrences
                </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                <p style="text-transform: capitalize; font-size:15px; font-weight:600;">fill the form below and click save</p>
                <p class="d-none p-2 text-white" style="font-size: 14px;" id="update6"></p>
                <form id="updatesrefrencesform">
                        <div id="displayrefrences"></div>
                        <button class="btn btn-success btn-sm text-white fw-bold mt-2">Update</button>
                </form>
                </div>
                </div>
            </div>
               <!-- end here -->
        </div>
    </div>
    <!-- end here -->

  </div>
</div>

         

        </div>

        <!-- Right Column: Resume Preview -->
        <div class="col-md-6 right-column">
          <div class="d-flex  align-items-center justify-content-between mb-4">
          <h3 style='font-size:18px;'>Resume Preview</h3>
          <button class='btn btn-primary btn-sm fw-bold btn-download'>Download As PDF</button>
          </div>
        <!-- resume preview -->
        <div class="a4-paper" id="cv_content">

            <!-- personal info start here-->
                <div id="paper-personalinfo" style="width: 100% !important; display:flex; align-items:start;flex-direction:column">
               
        
                </div>
             <!-- personal info ends here -->
              <!-- education starts here -->
               <div class="eduaction" style="width: 100% !important;margin-top:20px;">
                   <h4 class="space alltitle">Education</h4>
                   <hr>
                <div id="display-educationinfo">

                </div>
                
               </div>
               <!-- education ends here -->

               <!-- experience starts here -->
               <div class="eduaction" style="width: 100% !important;margin-top:20px;">
                   <h4 class="space alltitle">Expirence</h4>
                   <hr>
                <div class="content" id="display-expo-info">
                    
                </div>
                
               </div>
                <!-- experience ends here -->

                <!-- Qualities starts here -->
                <div class="eduaction" style="width: 100% !important;margin-top:20px;">
                   <h4 class="space alltitle">Qualities</h4>
                   <hr>
                <div class="content" id="display-quality" style='display:flex !important;'>
                    <!-- <h6  style="margin-top:20px !important; font-size:18px; margin-left:10px;">Computer Science</h6> -->
                    
                   
                </div>
                
               </div>
                 <!-- Qualities end here -->

                 <!-- language starts here -->
                 <div class="eduaction" style="width: 100% !important;margin-top:20px;">
                   <h4 class="space alltitle">Language</h4>
                   <hr>
                <div class="content" id='display-language'style='display:flex !important'>
                    <!-- <h6  style="margin-top:20px !important; font-size:18px; margin-left:10px;">Computer Science</h6> -->
                    
                   
                </div>
                
               </div>
                  <!-- language ends here -->

                  <!-- refrence starts here -->
                  <div class="eduaction" style="width: 100% !important;margin-top:20px;">
                   <h4 class="space alltitle">Refrences</h4>
                   <hr>
                <div class="content"id='display-refrence'>
                   
                </div>
                
               </div>
                   <!-- refrence ends here -->
        
        </div>

        <style>
        .a4-paper {
            font-family: "Poppins", serif !important;
            font-style: normal;
            width: 100%; /* Adjust to fit 50% of the parent container */
            aspect-ratio: 210 / 297; /* Maintain A4 aspect ratio */
            background: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 10px; /* Smaller padding to fit the scaled-down size */
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            font-family: Arial, sans-serif;
            font-size: 10pt;
            color: #333;
        }

        .a4-paper h1 {
            font-size: 14pt;
        }

        .a4-paper p {
            font-size: 10pt;
        }
        </style>

         <!-- end resume preview -->
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="js/personalinformation.js"></script>
    <script src="js/edu.js"></script>
    <script src="js/exp.js"></script>
    <script src="js/quality.js"></script>
    <script src="js/language.js"></script>
    <script src="js/ref.js"></script>
    <script src="js/pdf_download.js"></script>

    
  </body>
</html>

