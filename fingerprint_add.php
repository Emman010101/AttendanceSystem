<?php
    include "dbconnect.php";
    $id = $_GET['id'];
    $sql = "SELECT * FROM studenttbl WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        if($row['fingerprint_select'] == 1){
            echo "<img src='assets/img/ok_check.png' title='The selected UID' height='40px' width='40px'>";
            //echo "<script>toastr.success('Fingerprint Registered Successfully')</script>";
        }
    }
?>