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
        echo "<script>toastr.success('Updated Successfully!');</script>";
        unset($_SESSION['student_edited']);
    }
?>