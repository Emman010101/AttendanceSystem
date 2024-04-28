<?php  
//Connect to database
require 'dbconnect.php';

if (isset($_POST['FingerID'])) { 
	
	$fingerID = $_POST['FingerID'];

	$sql = "SELECT * FROM studenttbl WHERE fingerprint_id=?";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select_card";
        exit();
    }
    else{//1st result
    	mysqli_stmt_bind_param($result, "s", $fingerID);
        mysqli_stmt_execute($result);
        $resultl = mysqli_stmt_get_result($result);
        if ($row = mysqli_fetch_assoc($resultl)){//1st
        	//*****************************************************
            //An existed fingerprint has been detected for Login or Logout
            if (!empty($row['student_fname'])){//2nd result
                $fname = $row['student_fname'];
                $sql = "SELECT * FROM timeinouttbl WHERE fingerprint_id=? AND date=CURDATE()";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select_logs";
                    exit();
                }
                else{//3rd result
                	mysqli_stmt_bind_param($result, "i", $fingerID);
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    //*****************************************************
                    //Login
                    if (!$row = mysqli_fetch_assoc($resultl)){
                        $sql = "SELECT * FROM timeinouttbl WHERE `date`=CURDATE() AND `fingerprint_id`=$fingerID";

                        $result = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($result);
                    
                        if($count < 1){
                            //sql for timein
                            $sql = "INSERT INTO timeinouttbl (`time_in`, `date`, `fingerprint_id`) VALUES (CURTIME(), CURDATE(), $fingerID)";
                    
                            if (mysqli_query($conn, $sql)) {
                                //$_SESSION['student_added'] = true; 
                                //header("Location: add_student_page.php");
                                echo "login".$fname;
                            } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            }
                        }
                    }
                    //*****************************************************
                    //Logout
                    else{
                        $sql = "SELECT time_in FROM timeinouttbl WHERE fingerprint_id=$fingerID";
                        $result = mysqli_query($conn, $sql);
                        if($row = mysqli_fetch_assoc($result)){
                            date_default_timezone_set('Asia/Singapore');
                            $timein = strtotime($row['time_in']);
                            $currtime = strtotime(date('H:i:s'));
                            $diff = $currtime - $timein;
                            $sched_diff = strtotime($_SESSION['timeout']) - strtotime($_SESSION['timein']);
                            //echo $currtime - $timein;
                            //echo "timein: $timein currtime: $currtime diff: $diff";
                            //if the time difference between time in and current time is 3600 seconds
                            if($diff >= $sched_diff){
                                $sql="UPDATE timeinouttbl SET `time_out`=CURTIME() WHERE fingerprint_id=? AND date=CURDATE()";
                                $result = mysqli_stmt_init($conn);
                                if (!mysqli_stmt_prepare($result, $sql)) {
                                    echo "SQL_Error_insert_logout1";
                                    exit();
                                }
                                else{
                                    mysqli_stmt_bind_param($result, "i", $fingerID);
                                    mysqli_stmt_execute($result);
        
                                    echo "logout".$fname;
                                    exit();
                                }
                            }
                        }

                    }
                }
            }
            //*****************************************************
            //An available Fingerprint has been detected
            else{
            	$sql = "SELECT fingerprint_select FROM studenttbl WHERE fingerprint_select=1";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_Select";
                    exit();
                }
                else{
                    mysqli_stmt_execute($result);
                    $resultl = mysqli_stmt_get_result($result);
                    
                    if ($row = mysqli_fetch_assoc($resultl)) {
                    	$sql="UPDATE studenttbl SET fingerprint_select=0";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_insert";
                            exit();
                        }
                        else{
                            mysqli_stmt_execute($result);

                            $sql="UPDATE studenttbl SET fingerprint_select=1 WHERE fingerprint_id=?";
                            $result = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($result, $sql)) {
                                echo "SQL_Error_insert_An_available_card";
                                exit();
                            }
                            else{
                                mysqli_stmt_bind_param($result, "i", $fingerID);
                                mysqli_stmt_execute($result);

                                echo "available";
                                exit();
                            }
                        }
                    }
                    else{
                    	$sql="UPDATE studenttbl SET fingerprint_select=1 WHERE fingerprint_id=?";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_insert_An_available_card";
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($result, "i", $fingerID);
                            mysqli_stmt_execute($result);

                            echo "available";
                            exit();
                        }
                    }
                }
            }
        }
        //*****************************************************
        //New Fingerprint has been added
        else{

            $sql = "SELECT fingerprint_select FROM studenttbl WHERE fingerprint_select=1";
            $result = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($result, $sql)) {
                echo "SQL_Error_Select";
                exit();
            }
            else{
                mysqli_stmt_execute($result);
                $resultl = mysqli_stmt_get_result($result);
                if ($row = mysqli_fetch_assoc($resultl)) {
                	$sql="UPDATE studenttbl SET fingerprint_select =0";
                    $result = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($result, $sql)) {
                        echo "SQL_Error_insert";
                        exit();
                    }
                    else{
                        mysqli_stmt_execute($result);

                        $sql = "INSERT INTO studenttbl (fingerprint_id) VALUES (?)";
                        $result = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($result, $sql)) {
                            echo "SQL_Error_Select_add";
                            exit();
                        }
                        else{
                            mysqli_stmt_bind_param($result, "i", $fingerID);
                            mysqli_stmt_execute($result);

                            echo "succesful1";
                            exit();
                        }
                    }
                }
                else{
                	$sql = "INSERT INTO studenttbl (fingerprint_id) VALUES (?)";
                    $result = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($result, $sql)) {
                        echo "SQL_Error_Select_add";
                        exit();
                    }
                    else{
                        mysqli_stmt_bind_param($result, "i", $fingerID);
                        mysqli_stmt_execute($result);

                        echo "succesful2";
                        exit();
                    }
                }
            }
        }
    }
}
if (isset($_POST['Get_Fingerid'])) {
    
    if ($_POST['Get_Fingerid'] == "get_id") {
        $sql= "SELECT fingerprint_id FROM studenttbl WHERE add_fingerid=1";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error_Select";
            exit();
        }
        else{
            mysqli_stmt_execute($result);
            $resultl = mysqli_stmt_get_result($result);
            if ($row = mysqli_fetch_assoc($resultl)) {
                echo "add-id".$row['fingerprint_id'];
                exit();
            }
            else{
                echo "Nothing";
                exit();
            }
        }
    }
    else{
        exit();
    }
}
if (!empty($_POST['confirm_id'])) {

    $fingerid = $_POST['confirm_id'];

    $sql="UPDATE studenttbl SET fingerprint_select=0 WHERE fingerprint_select=1";
    $result = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($result, $sql)) {
        echo "SQL_Error_Select";
        exit();
    }
    else{
        mysqli_stmt_execute($result);
        
        $sql="UPDATE studenttbl SET add_fingerid=0, fingerprint_select=1 WHERE fingerprint_id=?";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error_Select";
            exit();
        }
        else{
            mysqli_stmt_bind_param($result, "s", $fingerid);
            mysqli_stmt_execute($result);
            $sql = "UPDATE studenttbl SET registered=1, fingerprint_select=0 WHERE fingerprint_id=$fingerid";
            mysqli_query($conn, $sql);
            echo "Fingerprint has been added!";
            exit();
        }
    }  
}
if (isset($_POST['DeleteID'])) {

	if ($_POST['DeleteID'] == "check") {
        $sql = "SELECT fingerprint_id FROM studenttbl WHERE del_fingerid=1";
        $result = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($result, $sql)) {
            echo "SQL_Error_Select";
            exit();
        }
        else{
            mysqli_stmt_execute($result);
            $resultl = mysqli_stmt_get_result($result);
            if ($row = mysqli_fetch_assoc($resultl)) {
                
                echo "del-id".$row['fingerprint_id'];

                $sql = "DELETE FROM studenttbl WHERE del_fingerid=1";
                $result = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($result, $sql)) {
                    echo "SQL_Error_delete";
                    exit();
                }
                else{
                    mysqli_stmt_execute($result);
                    exit();
                }
            }
            else{
                echo "nothing";
                exit();
            }
        }
	}
	else{
		exit();
	}
}
?>