<?php
    include "dbconnect.php";
    //$fingerprint_id = $_POST['FingerID'];
    $fingerprint_id = '1';
    $sql = "SELECT * FROM studenttbl WHERE fingerprint_id=$fingerprint_id";
    
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if($count > 0 ){
    $sql = "SELECT * FROM timeinouttbl WHERE `date`=CURDATE() AND `fingerprint_id`=$fingerprint_id";

    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if($count < 1){
        //sql for timein
        $sql = "INSERT INTO timeinouttbl (`time_in`, `date`, `fingerprint_id`) VALUES (CURTIME(), CURDATE(), $fingerprint_id)";

        if (mysqli_query($conn, $sql)) {
            //$_SESSION['student_added'] = true; 
            //header("Location: add_student_page.php");
            echo "Time-in success";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }else{
        $sql = "UPDATE timeinouttbl SET `time_out`=CURTIME() WHERE `fingerprint_id`=$fingerprint_id";

        if(mysqli_query($conn, $sql)){
            echo "Time-out success";
        }
        //echo "There's already a time-in record for this user";
    }
    }else{
        echo "There's no user registered with this fingerprint id";
    }
   
    mysqli_close($conn);
?>