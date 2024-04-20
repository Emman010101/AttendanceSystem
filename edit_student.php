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
    $studentid = $_POST['student_id'];

    $birthdate = str_replace('/', '-', $birthdate);
    $time = strtotime($birthdate);
    $newformat = date('Y-m-d',$time);
    $birthdate = $newformat;

    $sql = "UPDATE studenttbl SET student_lrn='$lrn', student_fname='$fname', student_mname='$mname', 
    student_lname='$lname', student_birthdate='$birthdate', student_gender='$gender', student_address='$address', student_phoneno='$phoneno' WHERE id='$studentid'";
    
    if (mysqli_query($conn, $sql)) {
      $_SESSION['student_edited'] = true; 
      header("Location: edit_student_page.php?id=".$studentid);
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);
?>