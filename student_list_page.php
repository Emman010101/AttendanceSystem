<?php
    include 'dbconnect.php';
    include 'session.php';
    $extension = "";
    $search_name = "";

    if(isset($_GET['search'])){
        $search_name = $_GET['search'];
        $extension = " AND student_fname LIKE '%".$_GET['search']."%'";
    }

    $section_id = "";

    if($_SESSION['section_id'] != 0){
        $scid = $_SESSION['section_id'];
        $sql = "SELECT * FROM studenttbl WHERE del_fingerid='0' AND section_id='$scid'".$extension;
    }else{
        $sql = "SELECT * FROM studenttbl WHERE del_fingerid='0'".$extension;
    }
    
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
    $sql = "SELECT * FROM sectiontbl";
    $result = mysqli_query($conn, $sql);

    $sections_ids = array();
    $grades_and_sections = array();
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            array_push($sections_ids, $row['id']);
            array_push($grades_and_sections, $row['grade']." - ".$row['section_name']);
        }
    }

    $sql = "SELECT * FROM timeinoutsettingstbl";
    $result = mysqli_query($conn, $sql);

    $arr = array();
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $_SESSION['timein'] = $row['timein'];
            $_SESSION['timeout'] = $row['timeout'];
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
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/001450aeb1.js" crossorigin="anonymous"></script>
</head>

<body onload="fillSearchField()">
    <div class="main-wrapper">
        <div class="header">
			<div class="header-left">
				<a href="index.html" class="logo">
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
						<a class="dropdown-item" href="index.php">Logout</a>
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
                    <div class="col-sm-4 col-3">
                        <h4 class="page-title">Student</h4>
                    </div>
                    <div class="col-sm-8 col-9 text-right m-b-20">
                        <a href="add_student_page.php" class="btn btn-primary float-right btn-rounded"><i class="fa fa-plus"></i> Add Student</a>
                    </div>
                </div>
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <label class="focus-label">Student Name</label>
                            <input type="text" class="form-control floating" id="student_name">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <a class="btn btn-success btn-block" onclick="searchName()"> Search </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
						<div class="table-responsive">
                            <table class="table table-striped custom-table">
                                <thead>
                                    <tr>
                                        <th>LRN</th>
                                        <th>Grade and Section</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Birthdate</th>
                                        <th>Gender</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                            foreach($data_arr as $key => $value){
                                                $imgpath = "assets/img/user.jpg";
                                                if(!empty($value['img_name'])){
                                                    $imgpath = "uploads/".$value['img_name'];
                                                }
                                                echo '<tr><td><img width="40" height="40" src="'.$imgpath.'" class="rounded-circle m-r-5" alt="" data-toggle="modal" data-target="#view_student" onclick="getImageName(this)">'.$value["student_lrn"].'</td><td>';
                                                if($value['section_id'] == 0){
                                                    echo "None";
                                                }else{
                                                    echo $grades_and_sections[array_search($value['section_id'], $sections_ids)];
                                                }
                                                echo '</td><td>'.$value["student_fname"].'</td>';
                                                echo '<td>'.$value["student_mname"].'</td>';
                                                echo '<td>'.$value["student_lname"].'</td>';
                                                echo '<td>'.$value["student_birthdate"].'</td>';
                                                echo '<td>'.$value["student_gender"].'</td>';
                                                echo '<td class="text-right">
                                                <div class="dropdown dropdown-action">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#" id="edit_button" onclick="setId('.$value["id"].', this, '.$value["fingerprint_id"].');"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                                        <a class="dropdown-item" href="#" id="delete_button" data-toggle="modal" data-target="#delete_employee" onclick="setId('.$value["id"].', this, '.$value["fingerprint_id"].');"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                                    </div>
                                                </div>
                                            </td></tr>';
                                            }
                                        ?>
                                </tbody>
                            </table>
						</div>
                    </div>
                </div>
            </div>
        </div>
		<div id="delete_employee" class="modal fade delete-modal" role="dialog">
            <input type="hidden" id="hidden_id" name="id"></input>
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-body text-center">
						<img src="assets/img/sent.png" alt="" width="50" height="46">
						<h3>Are you sure want to delete this Student?</h3>
						<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
							<button type="submit" class="btn btn-danger" onclick="deleteStudent()">Delete</button>
						</div>
					</div>
				</div>
			</div>
		</div>
        <div id="view_student" class="modal fade" role="dialog">
			<div class="modal-dialog modal-dialog-centered">
				<img src="assets/img/sent.png" id="view_student_image" alt="" width="400" height="300">
			</div>
		</div>
    </div>
    <div class="sidebar-overlay" data-reff=""></div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/app.js"></script>
    <link href="assets/plugins/toastr-master/build/toastr.css" rel="stylesheet"/>
    <script src="assets/plugins/toastr-master/toastr.js"></script>
    <script>
        var delete_id = "";
        var fingerprint_id = ""

        function fillSearchField(){ 
            document.getElementById("student_name").value = "<?php echo $search_name?>";
        }
        function setId(id, operation, fpid){
            console.log(operation.id);
            operation = operation.id;
            if(operation == "edit_button"){
                window.location.href = "edit_student_page.php?id=" + id;
            }else{
                delete_id = id;
                fingerprint_id = fpid;
                console.log(fpid);
            }
        }

        function deleteStudent(){
            window.location.href = "delete_student.php?id=" + delete_id + "&fpid=" + fingerprint_id;
        }

        function searchName(){
            var search_name = document.getElementById("student_name").value;

            window.location.href = "student_list_page.php?search=" + search_name;
        }

        function getImageName(imageName){
            //console.log(imageName);
            console.log(imageName.src);
            document.getElementById("view_student_image").src = imageName.src;
        }
    </script>
</body>
</html>
<?php
    include "toaster.php";
?>