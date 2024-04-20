<?php
    include "dbconnect.php";
    session_start();
    $lrn = $_POST['lrn'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phoneno = $_POST['phoneno'];

    $birthdate = str_replace('/', '-', $birthdate);
    $time = strtotime($birthdate);
    $newformat = date('Y-m-d',$time);
    $birthdate = $newformat;

    $sql="INSERT INTO studenttbl ( `student_lrn`, `student_fname`, `student_mname`, `student_lname`, `student_birthdate`, `student_gender`, `student_address`, `student_phoneno`)
VALUES('$lrn', '$fname', '$mname', '$lname', '$birthdate', '$gender', '$address', '$phoneno')";
    
    if (mysqli_query($conn, $sql)) {
      $_SESSION['student_added'] = true; 
      header("Location: add_student_page.php");
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);
?>