<?php
    include 'dbconnect.php';
    include 'session.php';
    $extension = "";

    $student_name = "";
    $selected_month = "-";
    $selected_year = "-";

    if(isset($_GET['sn'])){
        $student_name = $_GET['sn'];
        $selected_month = $_GET['sm'];
        $selected_year = $_GET['sy'];

        if($student_name != ""){
            $extension = " WHERE studenttbl.student_fname LIKE '%".$student_name."%'";
        }

        
    }
    $scid = 0;
    if($_SESSION['section_id'] != 0){
        $scid = $_SESSION['section_id'];
    }
    $sql = "SELECT studenttbl.id, studenttbl.student_lrn, studenttbl.student_fname, studenttbl.student_mname, studenttbl.student_lname, timeinouttbl.time_in, timeinouttbl.time_out, timeinouttbl.date, studenttbl.section_id
                                            FROM timeinouttbl
                                            INNER JOIN studenttbl ON timeinouttbl.fingerprint_id=studenttbl.fingerprint_id".$extension;
    $result = mysqli_query($conn, $sql);
    
    $data_arr = array();
    $data_arr_date = array();
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            if($scid != 0){
                if($row['section_id'] == $scid){
                    array_push($data_arr_date, $row);
                    if($selected_month != "-" && $selected_month == substr(substr($row['date'],5,7),0,2) && $selected_year == "-"){
                        array_push($data_arr, $row);
                    }else if($selected_year != "-" && $selected_year == substr($row['date'],0,4) && $selected_month == "-"){
                        array_push($data_arr, $row);
                    }else if($selected_month != "" && $selected_month == substr(substr($row['date'],5,7),0,2) && $selected_year != "" && $selected_year == substr($row['date'],0,4)){
                        array_push($data_arr, $row);
                    }else if($selected_month == "-" && $selected_year == "-" && $student_name == ""){
                        array_push($data_arr, $row);
                    }else if($selected_month == "-" && $selected_year == "-" && $student_name != ""){
                        array_push($data_arr, $row);
                    }
                }
            }else{
                array_push($data_arr_date, $row);
                if($selected_month != "-" && $selected_month == substr(substr($row['date'],5,7),0,2) && $selected_year == "-"){
                    array_push($data_arr, $row);
                }else if($selected_year != "-" && $selected_year == substr($row['date'],0,4) && $selected_month == "-"){
                    array_push($data_arr, $row);
                }else if($selected_month != "" && $selected_month == substr(substr($row['date'],5,7),0,2) && $selected_year != "" && $selected_year == substr($row['date'],0,4)){
                    array_push($data_arr, $row);
                }else if($selected_month == "-" && $selected_year == "-" && $student_name == ""){
                    array_push($data_arr, $row);
                }else if($selected_month == "-" && $selected_year == "-" && $student_name != ""){
                    array_push($data_arr, $row);
                }
            }
        }
        //print_r($data_arr);
        
    } else {
        echo "0 results";
    }
    $_SESSION['sql'] = $sql;
    
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    
    <title>Attendance System</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="https://kit.fontawesome.com/001450aeb1.js" crossorigin="anonymous"></script>
</head>

<body onload="setValOnLoad()">
    <div class="main-wrapper">
        <div class="header">
			<div class="header-left">
				<a href="index.php" class="logo">
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
                        <li class="active">
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
                        <h4 class="page-title">Attendance Report</h4>
                    </div>
                </div>
                <div class="row filter-row">
                    <div class="col-sm-3 col-md-2">
                        <div class="form-group form-focus">
                            <label class="focus-label">Student Name</label>
                            <input type="text" class="form-control floating" id="student_name">
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-2">
                        <div class="form-group form-focus select-focus">
                            <label class="focus-label">Select Month</label>
                            <select class="select floating" id="month_select">
                                <option>-</option>
                                <option value="01">Jan</option>
                                <option value="02">Feb</option>
                                <option value="03">Mar</option>
                                <option value="04">Apr</option>
                                <option value="05">May</option>
                                <option value="06">Jun</option>
                                <option value="07">Jul</option>
                                <option value="08">Aug</option>
                                <option value="09">Sep</option>
                                <option value="10">Oct</option>
                                <option value="11">Nov</option>
                                <option value="12">Dec</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-2">
                        <div class="form-group form-focus select-focus">
                            <label class="focus-label">Select Year</label>
                            <select class="select floating" id="year_select">
                                <option>-</option>
                                <?php
                                    $date_arr = array();
                                    foreach($data_arr_date as $value){
                                        array_push($date_arr, substr($value['date'],0,4));
                                    }
                                    sort($date_arr);
                                    $date_arr = array_unique($date_arr, SORT_STRING);
                                    foreach($date_arr as $value){
                                        echo '<option>'.$value.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-3 col-md-2">
                        <a onclick="nextPage()" class="btn btn-success btn-block"> Search </a>
                    </div>
                    <div class="col-sm-3 col-md-2">
                        <a onclick="exportToExcel()" class="btn btn-success btn-block"> Export </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table mb-0 datatable">
                                <thead>
                                    <tr>
                                        <th>LRN</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Time-in</th>
                                        <th>Time-out</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php
                                            foreach($data_arr as $value){
                                                echo '<tr><td>'.$value["student_lrn"].'</td>';
                                                echo '<td>'.$value["student_fname"].'</td>';
                                                echo '<td>'.$value["student_mname"].'</td>';
                                                echo '<td>'.$value["student_lname"].'</td>';
                                                echo '<td>'.$value["time_in"].'</td>';
                                                echo '<td>'.$value["time_out"].'</td>';
                                                echo '<td>'.$value["date"].'</td></tr>';
                                            }
                                        ?>
                                    </tbody>
                            </table>
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
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/bootstrap-datetimepicker.min.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/app.js"></script>
    <script>
        function setValOnLoad(){
            document.getElementById("student_name").value = "<?php echo $student_name?>";
            document.getElementById("month_select").value = "<?php echo $selected_month?>";
            document.getElementById("year_select").value = "<?php echo $selected_year?>";
        }
        
        function nextPage() {
            var student_name = document.getElementById("student_name").value;
            var selected_month = document.getElementById("month_select").value;
            var selected_year = document.getElementById("year_select").value;

            window.location.href = "attendance_reports_page.php?sn=" + student_name + "&sm=" + selected_month + "&sy=" + selected_year;
            //console.log(student_name);
            //window.location.href = "attendance_reports.php";
        }

        function exportToExcel(){
            window.location.href = "export_to_excel.php?export=yes";
        }
    </script>
</body>

</html>