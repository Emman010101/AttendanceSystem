<?php
    try{
    include "dbconnect.php";
    include "session.php";
    $id = $_POST['teacher_id'];
    $fname = $_POST['firstname'];
    $mname = $_POST['middlename'];
    $lname = $_POST['lastname'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $username = $_POST['username'];
    $password = "";
    $sectionid = $_POST['sectionid'];
    $lrn = $fname.$mname.$lname;
    include "file_upload.php";

    $birthdate = str_replace('/', '-', $birthdate);
    $time = strtotime($birthdate);
    $newformat = date('Y-m-d',$time);
    $birthdate = $newformat;

    $sql = "";
    if(!empty($_POST['password'])){
        $sql = "UPDATE userstbl SET `firstname`='$fname', `middlename`='$mname', `lastname`='$lname', `birthdate`='$birthdate', `gender`='$gender', `section_id`='$sectionid', `username`='$username', `password`='$password', `img_name`='$new_filename'
        WHERE id='$id'";
    }else{
        $sql = "UPDATE userstbl SET `firstname`='$fname', `middlename`='$mname', `lastname`='$lname', `birthdate`='$birthdate', `gender`='$gender', `section_id`='$sectionid', `username`='$username', `img_name`='$new_filename'
        WHERE id='$id'";
    }

    if(mysqli_query($conn, $sql)){
        $sql = "UPDATE sectiontbl SET `adviser_name`='$lrn' WHERE `id`='$sectionid'";
        if(mysqli_query($conn, $sql)){
            $_SESSION['teacher_edited'] = true;
            header("Location: teacher_list_page.php");
        }
    }
    }catch(Exception $ex){
        echo $ex;
    }
?>