<?php
    include "dbconnect.php";
    session_start();
    if(isset($_GET['add'])){
      $sql = "UPDATE studenttbl SET add_fingerid=1 WHERE id=".$_GET['id'];
      mysqli_query($conn, $sql);
      header("Location: edit_student_page.php?id=".$_GET['id']);
    }else if(isset($_POST['student_id'])){
      $lrn = $_POST['lrn'];
      $fname = $_POST['fname'];
      $mname = $_POST['mname'];
      $lname = $_POST['lname'];
      $birthdate = $_POST['birthdate'];
      $gender = $_POST['gender'];
      $address = $_POST['address'];
      $phoneno = $_POST['phoneno'];
      $studentid = $_POST['student_id'];
      $fingerprint_id = $_POST['fingerprint_id'];
      $ext = "";
      if($fingerprint_id < 1){
        $ext = ", fingerprint_id='$fingerprint_id'";
      }

      $birthdate = str_replace('/', '-', $birthdate);
      $time = strtotime($birthdate);
      $newformat = date('Y-m-d',$time);
      $birthdate = $newformat;

      $sql = "UPDATE studenttbl SET student_lrn='$lrn', student_fname='$fname', student_mname='$mname', 
    student_lname='$lname', student_birthdate='$birthdate', student_gender='$gender', student_address='$address', student_phoneno='$phoneno', add_fingerid='0' $ext WHERE id='$studentid'";
    
    if (mysqli_query($conn, $sql)) {
      $_SESSION['student_edited'] = true; 
      header("Location: student_list_page.php");
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    }
    
    
    mysqli_close($conn);
?>