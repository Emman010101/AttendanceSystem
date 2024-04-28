<?php
    include "dbconnect.php";
    include "session.php";
    $id = $_GET['id'];
    $sql = "SELECT * FROM userstbl WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    $adviser_name = "";
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)) {
            $adviser_name = $row['firstname'].$row['middlename'].$row['lastname'];
        }
    }
    $sql = "UPDATE sectiontbl SET adviser_name='' WHERE adviser_name='$adviser_name'";
    mysqli_query($conn, $sql);
    $sql = "DELETE FROM userstbl WHERE id='$id'";
    mysqli_query($conn, $sql);
    $_SESSION["teacher_deleted"] = true;
    header("Location: teacher_list_page.php");
?>