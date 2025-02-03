<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['uid'])){
  header('location:views/users/index.php');
  exit();
}

?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cv-Builder | Forget Pwd</title>
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
  <body>
   
    <?php include('includes/header.php');?>
    
    <div class="container">
        <div class="row">
            <?php if(!isset($_SESSION['emails'])){?>
            <div class="col-lg-6 col-md-12 col-sm-12 fw-bold mt-4 mx-auto forget-pwd" style="font-size: 14px;">
                <div class="card">
                    <h4 class="card-header" style="font-size: 15px; font-weight:600">
                        Forget Password
                    </h4>
                    <div class="card-body">
                        <form id='lookupform'>
                            <p class=" p-2 text-white fw-bold d-none" id="msg01"></p>
                            <div class="form-group mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" id='email' class="form-control" placeholder="e.g john@example.com" style='font-size:14px;'>
                            </div>
                              <!-- hide the actual button when the request is made in ajax -->
                              <div id="actualbutton">
                                        <button class='btn btn-secondary btn-sm text-white fw-bold' id='createaccountbtn'>Submit</button>
                                        </div>
                            
                            <button class='btn btn-secondary disabled d-none' id='waitingbtn'>
                            <div id="spinner" class="spinner-border spinner-border-sm text-white " role="status">
                                </div>
                                <span class="visually fw-bold" style="font-size:14px;">Submitting...</span>
                           <!-- Submiting -->
                            </button>
                        </form>
                    </div>
                </div>

            </div>
            <?php }else{?>
            <!-- recover password form -->
             <div class=" col-lg-6 col-md-2 col-sm-12 fw-bold mx-auto recover-account">
                <div class="card">
                <h4 class="card-header" style="font-size: 15px; font-weight:600">
                        Recover Account
                    </h4>

                    <div class="card-body">
                        <form id="updatepwd">
                        <p class=" p-2 text-white fw-bold d-none" id="msg02"></p>
                            <div class="form-group mb-3">
                            <label class="form-label">Verification Code</label>
                            <input type="text" id='v-code' class="form-control" placeholder="Enter Verfication Code" style='font-size:14px;'>
                            </div>

                            <p class="bg-danger p-2 text-white fw-bold" id="messagedisplayer" style="display:none;"></p>
                            <div class="form-group mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" id='pwd' class="form-control"  placeholder="Enter New Password "style='font-size:14px;'>
                            </div>

                            <!-- hide the actual button when the request is made in ajax -->
                            <div id="actualbutton">
                                        <button class='btn btn-secondary btn-sm text-white fw-bold' id='createaccountbtn'>Submit</button>
                                        </div>
                            
                            <button class='btn btn-secondary disabled d-none' id='waitingbtn'>
                            <div id="spinner" class="spinner-border spinner-border-sm text-white " role="status">
                                </div>
                                <span class="visually fw-bold" style="font-size:14px;">Submitting...</span>
                           <!-- Submiting -->
                            </button>
                        </form>
                    </div>
                </div>
             </div>
             <?php }?>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="assets/js/auth.js"></script>
    <script src="assets/js/forgetpwd.js"></script>
</body>
</html>