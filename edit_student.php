<?php
    include "dbconnect.php";
    session_start();
    if(isset($_POST['student_id'])){
      $lrn = $_POST['lrn'];
      $fname = $_POST['fname'];
      $mname = $_POST['mname'];
      $lname = $_POST['lname'];
      $birthdate = $_POST['birthdate'];
      $gender = $_POST['gender'];
      $address = $_POST['address'];
      $phoneno = $_POST['phoneno'];
      $studentid = $_POST['student_id'];
      $sectionid = $_POST['sectionid'];
      include "file_upload.php";
      $birthdate = str_replace('/', '-', $birthdate);
        $time = strtotime($birthdate);
        $newformat = date('Y-m-d',$time);
        $birthdate = $newformat;
  
        if($new_filename == ""){
          $sql = "UPDATE studenttbl SET section_id='$sectionid', student_lrn='$lrn', student_fname='$fname', student_mname='$mname', 
      student_lname='$lname', student_birthdate='$birthdate', student_gender='$gender', student_address='$address', student_phoneno='$phoneno', add_fingerid='0' $ext WHERE id='$studentid'";
        }else{
          $sql = "UPDATE studenttbl SET section_id='$sectionid', student_lrn='$lrn', student_fname='$fname', student_mname='$mname', 
      student_lname='$lname', student_birthdate='$birthdate', student_gender='$gender', student_address='$address', student_phoneno='$phoneno', add_fingerid='0', img_name='$new_filename' $ext WHERE id='$studentid'";
        }
      
      if (mysqli_query($conn, $sql)) {
        $_SESSION['student_edited'] = true; 
        header("Location: student_list_page.php");
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
    }
    
    
    mysqli_close($conn);
?>