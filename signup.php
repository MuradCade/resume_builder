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
    <title>Cv-Builder | Create Account</title>
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
  <body>
    <?php include('includes/header.php');?>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 fw-bold mt-4 mx-auto" style="font-size: 14px;">
                <div class="card">
                    <h4 class="card-header" style="font-size: 15px; font-weight:600">
                        Create Account
                    </h4>
                    <div class="card-body">
                        <p class="bg-danger p-2 text-white" id="msgdisplay" style="display: none;"></p>
                        <form id='signupform' method="POST">
                            <div class="form-group mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" id='username' class="form-control" placeholder="e.g john doe" style='font-size:14px;'>
                            </div>
                            <div class="form-group mb-3">
                            <label class="form-label">Email</label>
                            <input type="text" id='email' class="form-control" placeholder="e.g john@example.com" style='font-size:14px;'>
                            </div>
                            <div class="form-group mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" id='password' class="form-control" placeholder="e.g ****" style='font-size:14px;'>
                            </div>
            <!-- hide the actual button when the request is made in ajax -->
                            <div id="actualbutton">
                                <button class='btn btn-secondary btn-sm text-white fw-bold' id='createaccountbtn'>Create Account</button>
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
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>