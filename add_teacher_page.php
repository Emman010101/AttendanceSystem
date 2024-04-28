<?php 
    include "dbconnect.php";
    include "session.php";
    $sql = "SELECT * FROM sectiontbl WHERE adviser_name=''";
    $result = mysqli_query($conn, $sql);

    $sections = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            array_push($sections, $row);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    
    <title>Attendance System</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/001450aeb1.js" crossorigin="anonymous"></script>
    <style>
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
         -webkit-appearance: none; 
         margin: 0; 
        }
    </style>
</head>
<body>
    <div class="main-wrapper">
        <div class="header">
			<div class="header-left">
				<a href="index.html" class="logo">
                <ul class="notifications"></ul>
					<img src="assets/img/logo.png" width="35" height="35" alt=""> <span>Attendance System</span>
				</a>
			</div>
			<a id="toggle_btn" href="javascript:void(0);"><i class="fa fa-bars"></i></a>
            <a id="mobile_btn" class="mobile_btn float-left" href="#sidebar"><i class="fa fa-bars"></i></a>
            <ul class="nav user-menu float-right">
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link user-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle" src="assets/img/user.jpg" width="40" alt="Admin">
							<span class="status online"></span></span>
                        <span><?php echo $_SESSION['login_user']?></span>
                    </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="logout.php">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
        <!-- start of sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li>
                            <a href="student_list_page.php"><i class="fa fa-user"></i> <span>Students List</span></a>
                        </li>
                        <?php if($_SESSION['login_user'] == 'admin'){
                            echo '
                            <li class="active">
                            <a href="teacher_list_page.php"><i class="fa fa-user"></i> <span>Teachers List</span></a>
                            </li>
                            <li>
                                <a href="section_list_page.php"><i class="fa-solid fa-section"></i> <span>Sections List</span></a>
                            </li>
                            <li>
                                <a href="schedule_page.php"><i class="fa fa-calendar-check-o"></i> <span>Schedule</span></a>
                            </li>
                            ';
                        }
                        ?>
                        <li>
                            <a href="attendance_reports_page.php"><i class="fa fa-flag-o"></i> <span>Attendance Reports</span></a>
                        </li>
                        <li>
                            <a href="register_biometric_page.php"><i class="fa-solid fa-fingerprint"></i> <span>Biometric Registration</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end of sidebar -->
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Add Teacher</h4>
                    </div>
                </div>
                <form method="POST" action="add_teacher.php">
                    <div class="card-box">
                        <h3 class="card-title">Basic Informations</h3>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="profile-img-wrap">
                                    <img class="inline-block" src="assets/img/user.jpg" alt="user" id="userimage">
                                    <div class="fileupload btn">
                                        <span class="btn-text"><i class="fa-solid fa-folder"></i></span>
                                        <input class="upload" type="file" name="fileToUpload" id="imagetoupload" accept="image/png, image/jpeg"><br>
                                    </div>
                                    <div class="webcamera btn" style="left: 0;">
                                        <span class="btn-text" data-toggle="modal" data-target="#webcam_modal" onclick="Webcam.attach( '#my_camera' );"><i class="fa-solid fa-camera"></i></span>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">First Name</label>
                                                <input type="text" class="form-control floating" name="fname" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Middle Name</label>
                                                <input type="text" class="form-control floating" name="mname" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Last Name</label>
                                                <input type="text" class="form-control floating" name="lname" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Birth Date</label>
                                                <div class="cal-icon">
                                                    <input class="form-control floating datetimepicker" type="text" name="birthdate" onclick="console.log(this.value)" id="datepicker" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-focus select-focus">
                                                <label class="focus-label">Gender</label>
                                                <select class="select form-control floating" name="gender">
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-focus select-focus">
                                                <label class="focus-label">Advisory</label>
                                                <select class="select form-control floating" name="sectionid">
                                                    <?php 
                                                         foreach($sections as $value){
                                                            echo '<option value="'.$value["id"].'">'.$value["grade"]." - ".$value["section_name"].'</option>';
                                                         }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box">
                        <h3 class="card-title">Account Informations</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Username</label>
                                    <input type="text" class="form-control floating" name="username" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Password</label>
                                    <input type="password" class="form-control floating" name="password" id="pass" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Confirm Password</label>
                                    <input type="password" class="form-control floating" id="confirm_pass" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center m-t-20">
                        <button class="btn btn-primary submit-btn" type="submit" id="saveBtn" onmouseover="checkIfDisabled(this)">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <?php
            include "webcam_modal.php";
        ?>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
    <link href="assets/plugins/toastr-master/build/toastr.css" rel="stylesheet"/>
    <script src="assets/plugins/toastr-master/toastr.js"></script>
    <script type="text/javascript" src="assets/plugins/webcamjs-master/webcam.js"></script>
    <script type="text/javascript" src="assets/js/webcam_controller.js"></script>
    <script>
        var confirmPassField = document.getElementById('confirm_pass');
        var passField = document.getElementById('pass');
        var saveBtn = document.getElementById('saveBtn');
        confirmPassField.onkeyup = function(){
            if(confirmPassField.value == passField.value){
                saveBtn.disabled = false;
            }else{
                saveBtn.disabled = true;
            }
        }

        function checkIfDisabled(tag){
            if(tag.disabled){
                toastr.error("Passwords didn't match");
            }
        }
    </script>
</body>
</html>
<?php
    include "toaster.php";
?>