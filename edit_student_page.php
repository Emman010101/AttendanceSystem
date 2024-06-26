<?php 
    include "dbconnect.php";
    include "session.php";
    $student_id = "";
    if(isset($_GET['id'])){
        $student_id = $_GET['id'];
        $sql = "SELECT * FROM studenttbl WHERE id=".$_GET['id'];
        $result = mysqli_query($conn, $sql);

        $data_arr = array();
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                array_push($data_arr, $row);
            }
            //print_r($data_arr);
            
        } else {
            echo "0 results";
        }
        $_SESSION["idHasValue"] = $data_arr[0]['fingerprint_id'];
    }

    $sql = "SELECT * FROM sectiontbl";
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
                        <li class="active">
                            <a href="student_list_page.php"><i class="fa fa-user"></i> <span>Students List</span></a>
                        </li>
                        <?php if($_SESSION['login_user'] == 'admin'){
                            echo '
                            <li>
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
                        <h4 class="page-title">Edit Student</h4>
                    </div>
                </div>
                <form method="POST" action="edit_student.php">
                    <input type="hidden" name="student_id" value="<?php echo $_GET['id']?>">
                    <div class="card-box">
                        <h3 class="card-title">Basic Informations</h3>
                        <div class="row">
                            <div class="col-md-12">
                            <div class="profile-img-wrap">
                                <?php
                                    $imgfilename = "assets/img/user.jpg";
                                    if(!empty($data_arr[0]['img_name'])){
                                        $imgfilename = "uploads/".$data_arr[0]['img_name'];
                                    }
                                ?>
                                    <img class="inline-block" src="<?php echo $imgfilename?>" alt="user" id="userimage">
                                    <div class="fileupload btn">
                                        <span class="btn-text">edit</span>
                                        <input class="upload" type="file" name="fileToUpload" id="imagetoupload" accept="image/png, image/jpeg" value="<?php echo $imgfilename?>">
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
                                                <input type="text" class="form-control floating" name="fname" value="<?php echo $data_arr[0]['student_fname'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Middle Name</label>
                                                <input type="text" class="form-control floating" name="mname" value="<?php echo $data_arr[0]['student_mname'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Last Name</label>
                                                <input type="text" class="form-control floating" name="lname" value="<?php echo $data_arr[0]['student_lname'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">LRN</label>
                                                <input type="number" class="form-control floating" name="lrn" value="<?php echo $data_arr[0]['student_lrn'];?>">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-focus">
                                                <label class="focus-label">Birth Date</label>
                                                <div class="cal-icon">
                                                    <?php
                                                        $birthdate = $data_arr[0]['student_birthdate'];
                                                        $birthdate = str_replace('-', '/', $birthdate);
                                                        $time = strtotime($birthdate);
                                                        $newformat = date('d-m-Y',$time);
                                                        $birthdate = $newformat;
                                                    ?>
                                                    <input class="form-control floating datetimepicker" type="text" name="birthdate" onclick="console.log(this.value)" id="datepicker" value="<?php echo $birthdate;?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-focus select-focus">
                                                <label class="focus-label">Gender</label>
                                                <select class="select form-control floating" name="gender">
                                                    <option <?php if($data_arr[0]['student_gender'] == "Male") echo "selected";?>>Male</option>
                                                    <option <?php if($data_arr[0]['student_gender'] == "Female") echo "selected";?>>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group form-focus select-focus">
                                                <label class="focus-label">Grade and Section</label>
                                                <select class="select form-control floating" name="sectionid">
                                                    <?php 
                                                         foreach($sections as $value){
                                                            if($data_arr[0]['section_id'] == $value['id']){
                                                                echo '<option value="'.$value["id"].'" selected>'.$value["grade"]." - ".$value["section_name"].'</option>';
                                                            }else{
                                                                echo '<option value="'.$value["id"].'">'.$value["grade"]." - ".$value["section_name"].'</option>';
                                                            }
                                                            
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
                        <h3 class="card-title">Contact Informations</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Address</label>
                                    <input type="text" class="form-control floating" value="<?php echo $data_arr[0]['student_address'];?>" name="address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="focus-label">Phone Number</label>
                                    <input type="text" class="form-control floating" value="<?php echo $data_arr[0]['student_phoneno'];?>" name="phoneno">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center m-t-20">
                        <button class="btn btn-primary submit-btn" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
        <div id="webcam_modal" class="modal fade" role="dialog">
            <input type="hidden" id="hidden_id" name="id"></input>
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
                        <div id="my_camera"></div>
						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal" onclick="Webcam.reset()">Close</a>
							<button type="submit" class="btn btn-primary" onclick="take_snapshot()">Take a picture</button>
						</div>
					</div>
				</div>
			</div>
		</div>
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
    <style>
        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
         -webkit-appearance: none; 
         margin: 0; 
        }
    </style>
    <script>
        $(document).ready(function(){
  	        $.ajax({
              url: "fingerprint_add.php" + "<?php echo $student_id?>"
                }).done(function(data) {
                $('#check').html(data);
            });
            setInterval(function(){
            $.ajax({
                url: "fingerprint_add.php?id=" + "<?php echo $student_id?>"
                }).done(function(data) {
                $('#check').html(data);
            });
            },5000);
        });
    </script>
    <script src="assets/js/imageset.js"></script>
    <script type="text/javascript" src="assets/plugins/webcamjs-master/webcam.js"></script>
    <script type="text/javascript" src="assets/js/webcam_controller.js"></script>
</body>
</html>
<?php
    include "toaster.php";
?>