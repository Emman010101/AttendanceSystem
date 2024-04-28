<?php
    try{
    include "dbconnect.php";
    include "session.php";
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sectionid = $_POST['sectionid'];
    $lrn = $fname.$mname.$lname;
    include "file_upload.php";

    $birthdate = str_replace('/', '-', $birthdate);
    $time = strtotime($birthdate);
    $newformat = date('Y-m-d',$time);
    $birthdate = $newformat;
    
    $sql = "INSERT INTO userstbl (`firstname`, `middlename`, `lastname`, `birthdate`, `gender`, `section_id`, `username`, `password`, `img_name`) 
    VALUES ('$fname', '$mname', '$lname', '$birthdate', '$gender', '$sectionid', '$username', MD5('$password'), '$new_filename')";

    if(mysqli_query($conn, $sql)){
        $sql = "UPDATE sectiontbl SET `adviser_name`='$lrn' WHERE `id`='$sectionid'";
        if(mysqli_query($conn, $sql)){
            $_SESSION['teacher_added'] = true;
            header("Location: add_teacher_page.php");
        }
    }
    }catch(Exception $ex){
        echo $ex;
    }
?>