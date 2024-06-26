<?php
    include "dbconnect.php";
    $sql = "SELECT studenttbl.id, studenttbl.student_fname, studenttbl.student_mname, studenttbl.student_lname, studenttbl.fingerprint_id, timeinouttbl.date, timeinouttbl.time_in, timeinouttbl.time_out
    FROM timeinouttbl INNER JOIN studenttbl ON timeinouttbl.fingerprint_id=studenttbl.fingerprint_id";

    $student_array = array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            array_push($student_array, $row);
        }
        //print_r($student_array);
        $month = date_format(date_create($student_array[0]['date']), "m");
        if($month[0] == 0){
           $month = substr($month, 1,2);
        }
        //echo $month;
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
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
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
                        <span>Admin</span>
                    </a>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="login.html">Logout</a>
					</div>
                </li>
            </ul>
            <div class="dropdown mobile-user-menu float-right">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="login.html">Logout</a>
                </div>
            </div>
        </div>
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                        <li class="menu-title">Main</li>
						<li class="submenu">
							<a href="#"><i class="fa fa-user"></i> <span> Attendance </span> <span class="menu-arrow"></span></a>
							<ul style="display: none;">
								<li><a class="active" href="attendance.html">Attendance Sheet</a></li>
							</ul>
						</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="page-wrapper">
            <div class="content">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Attendance Sheet</h4>
                    </div>
                </div>
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <label class="focus-label">Employee Name</label>
                            <input type="text" class="form-control floating">
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <label class="focus-label">Select Month</label>
                            <select class="select floating">
                                <option>-</option>
                                <option>Jan</option>
                                <option>Feb</option>
                                <option>Mar</option>
                                <option>Apr</option>
                                <option>May</option>
                                <option>Jun</option>
                                <option>Jul</option>
                                <option>Aug</option>
                                <option>Sep</option>
                                <option>Oct</option>
                                <option>Nov</option>
                                <option>Dec</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <label class="focus-label">Select Year</label>
                            <select class="select floating">
                                <option>-</option>
                                <option>2017</option>
                                <option>2016</option>
                                <option>2015</option>
                                <option>2014</option>
                                <option>2013</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <a href="#" class="btn btn-success btn-block"> Search </a>
                    </div>
                </div>
                <div class="col-sm-12">
                        <h4 class="page-title">2024</h4>
                    </div>
                <div class="row">
                    <div class="col-lg-12">
						<div class="table-responsive">
                            <table class="table table-striped custom-table mb-0">
                                <thead>
                                    <tr>
                                        <th>January</th>
                                        <th>1</th>
                                        <th>2</th>
                                        <th>3</th>
                                        <th>4</th>
                                        <th>5</th>
                                        <th>6</th>
                                        <th>7</th>
                                        <th>8</th>
                                        <th>9</th>
                                        <th>10</th>
                                        <th>11</th>
                                        <th>12</th>
                                        <th>13</th>
                                        <th>14</th>
                                        <th>15</th>
                                        <th>16</th>
                                        <th>17</th>
                                        <th>18</th>
                                        <th>19</th>
                                        <th>20</th>
                                        <th>22</th>
                                        <th>23</th>
                                        <th>24</th>
                                        <th>25</th>
                                        <th>26</th>
                                        <th>27</th>
                                        <th>28</th>
                                        <th>29</th>
                                        <th>30</th>
                                        <th>31</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Albina Simonis</td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td>
                                            <div class="half-day"><span class="first-off"><i class="fa fa-check text-success"></i></span> <span class="first-off"><i class="fa fa-close text-danger"></i></span></div>
                                        </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td><i class="fa fa-close text-danger"></i> </td>
                                        <td><i class="fa fa-close text-danger"></i> </td>
                                        <td><i class="fa fa-close text-danger"></i> </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td><i class="fa fa-close text-danger"></i> </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td>
                                            <div class="half-day"><span class="first-off"><i class="fa fa-close text-danger"></i></span> <span class="first-off"><i class="fa fa-check text-success"></i></span></div>
                                        </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td><i class="fa fa-close text-danger"></i> </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td><i class="fa fa-close text-danger"></i> </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                        <td><i class="fa fa-check text-success"></i> </td>
                                    </tr>
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
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>