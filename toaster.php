<?php
    if(isset($_SESSION['student_added'])){
        echo "<script>toastr.success('Added Successfully!');</script>";
        unset($_SESSION['student_added']);
    }
    if(isset($_SESSION['student_deleted'])){
        echo "<script>toastr.success('Deleted Successfully!');</script>";
        unset($_SESSION['student_deleted']);
    }
    if(isset($_SESSION['student_edited'])){
        echo "<script>toastr.success('Saved');</script>";
        unset($_SESSION['student_edited']);
    }
    if(isset($_SESSION['fingerprint_registered'])){
        echo "<script>toastr.success('Fingerprint Registered Successfully');</script>";
        unset($_SESSION['fingerprint_registered']);
    }
    if(isset($_GET['export'])){
        echo "<script>toastr.success('Success');</script>";
    }
    if(isset($_SESSION['idalreadyexist'])){
        echo "<script>toastr.error('This id already exist');</script>";
        unset($_SESSION['idalreadyexist']);
    }
    if(isset($_SESSION['teacher_added'])){
        echo "<script>toastr.success('Added Successfully!');</script>";
        unset($_SESSION['teacher_added']);
    }
    if(isset($_SESSION['teacher_edited'])){
        echo "<script>toastr.success('Saved');</script>";
        unset($_SESSION['teacher_edited']);
    }
    if(isset($_SESSION['teacher_deleted'])){
        echo "<script>toastr.success('Deleted Successfully!');</script>";
        unset($_SESSION['teacher_deleted']);
    }
    if(isset($_SESSION['section_added'])){
        echo "<script>toastr.success('Added Successfully!');</script>";
        unset($_SESSION['section_added']);
    }
    if(isset($_SESSION['section_edited'])){
        echo "<script>toastr.success('Saved');</script>";
        unset($_SESSION['section_edited']);
    }
    if(isset($_SESSION['section_deleted'])){
        echo "<script>toastr.success('Deleted Successfully!');</script>";
        unset($_SESSION['section_deleted']);
    }
    if(isset($_SESSION['schedule_edited'])){
        echo "<script>toastr.success('Saved');</script>";
        unset($_SESSION['schedule_edited']);
    }
?>