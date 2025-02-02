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
    <title>CV-Builder | Dashboard</title>
    <link rel="shortcut icon" href="../../assets/images/logo.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
      /* Sidebar Styles */
      #sidebar {
        position: fixed;
        top: 0px;
        left: 0px;
        width: 230px;
        height: 100%;
        background-color: #f8f9fa;
        transition: transform 0.3s ease-in-out;
        z-index: 1;
        padding-top: 5px;
      }

      /* Sidebar hidden on small screens */
      #sidebar.hide {
        transform: translateX(-100%);
      }

      /* Make sidebar visible on large screens */
      @media (min-width: 768px) {
        #sidebar {
          transform: translateX(0);
        }
      }

      /* Main content adjustment when sidebar is hidden */
      .main-content {
        transition: margin-left 0.3s ease-in-out;
      }

      .main-content.sidebar-hidden {
        margin-left: 0;
        width: 100%;
      }

      /* Sidebar active menu link */
      ul li a {
        color: black !important;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        font-weight: 600 !important;
      }

      ul li a span {
        margin-right: 10px;
      }

      .active {
        background-color: #ec5f4d;
        color: white !important;
        border-radius: 5px;
      }

      ul li a:hover {
        background-color: #ec5f4d;
        color: white !important;
        border-radius: 5px;
      }

      /* Sidebar close button */
      .sidebar-close-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        font-size: 30px;
        cursor: pointer;
      }

      /* Hamburger menu button */
      .hamburger-menu-btn {
        font-size: 30px;
        cursor: pointer;
      }

      /* Other styles */
      #cv-preview {
        width: 94% !important;
        background-color: wheat !important;
        height: 100px;
        position: absolute !important;
        top: 10px;
        left: 8px;
        border-radius: 10px;
      }

      #cv-preview p img {
        width: 50px;
      }

      #cv-preview p {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 26px auto;
        font-weight: bold;
        text-transform: uppercase;
      }
    </style>
  </head>
  <body>
    <div class="container-fluid">
      <div class="row">
        <!-- Sidebar -->
       <?php include('includes/sidebar.php');?>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content" id="mainContent">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2" style="font-size: 16px; display: flex; align-items: center;">
              <img src="../../assets/images/logo.png" width="50"> Builder | Dashboard
            </h1>
            <!-- Toggle Button for Small Screens -->
            <div style="display:flex; align-items:end;">
              <button class="btn btn-primary d-lg-none hamburger-menu-btn" type="button" id="toggleSidebar">
                <span class="material-icons">menu</span>
              </button>
            </div>
          </div>

          <h4>Welcome To Your Dashboard <?php echo $_SESSION['uname']; ?>.</h4>
          <p>Use the navigation menu to access different sections of the application.</p>
         <div style="display:flex; align-items:center; justify-content:space-between">
         <h4 style="font-size: 17px; margin-top: 20px !important;">My Resume</h4>
         <button class="btn btn-secondary btn-sm" style="font-size:14px;"  data-bs-toggle="modal" data-bs-target="#exampleModal"> + Create New Resume</button>
         </div>

          
            <!-- Card 1 -->
            <div  class='row' id="resumes">

            </div>
            <!-- End Card 1 -->
    
        </main>
      </div>
    </div>

    
          <!-- add new model cv file creates -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Create Resume File</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class=' p-2 text-white fw-bold d-none' id="msg"></p>
                    
                    <form id="cvfileform" method='POST'>
                        <div class="from-group">
                            <label class="form-label">Resume File Name</label>
                            <input type="text" id='cvfilename' placeholder="Enter Resume File Name" class="form-control">
                        </div>
                        <button  class="btn btn-primary btn-sm mt-2" id="actualbutton">Save</button>
                        <button id='waiting' class="d-none btn btn-primary btn-sm">
                        <div id="spinner" class="spinner-border spinner-border-sm text-white " role="status">
                                </div>
                                <span class="visually fw-bold" style="font-size:14px;">Submitting...</span>
                           <!-- Submiting -->
                            </button>
                    </form>
                    </div>
                    <!--  -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>
           <!-- end model -->


           <!-- update existing cv name -->
           <div class="modal fade" id="updatemodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Model</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class=' p-2 text-white fw-bold d-none' id="updmsg"></p>
                    
                    <form id="updatecvfile" method='POST'>
                        <div class="from-group">
                            <label class="form-label">Resume File Name</label>
                            <input type="text" id='updatetitle' placeholder="Enter Resume File Name" class="form-control" required>
                        </div>
                        <button  class="btn btn-primary btn-sm mt-2" id="actualbutton">Update</button>
                        <button id='waiting' class="d-none btn btn-primary btn-sm">
                        <div id="spinner" class="spinner-border spinner-border-sm text-white " role="status">
                                </div>
                                <span class="visually fw-bold" style="font-size:14px;">Submitting...</span>
                           <!-- Submiting -->
                            </button>
                    </form>
                    </div>
                    <!--  -->
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
            </div>
            <!-- end of update -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
      <!-- <script src="js/createresumefilename.js"></script> -->
      <script src="js/cvfile.js"></script>
    <script>
       
      // Toggle Sidebar
      const sidebar = document.getElementById('sidebar');
      const toggleSidebarBtn = document.getElementById('toggleSidebar');
      const closeSidebarBtn = document.getElementById('closeSidebar');
      const mainContent = document.getElementById('mainContent');

      // Toggle the sidebar on small devices
      toggleSidebarBtn.addEventListener('click', () => {
        sidebar.classList.toggle('hide');
        mainContent.classList.toggle('sidebar-hidden');
      });

      // Close the sidebar
      closeSidebarBtn.addEventListener('click', () => {
        sidebar.classList.add('hide');
        mainContent.classList.add('sidebar-hidden');
      });
    </script>
  </body>
</html>
