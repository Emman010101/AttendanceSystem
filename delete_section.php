<?php
    include "dbconnect.php";
    include "session.php";
    $id = $_GET['id'];
    $sql = "UPDATE userstbl SET section_id='0' WHERE section_id='$id'";
    if(mysqli_query($conn, $sql)){
        $sql = "UPDATE studenttbl SET section_id='0' WHERE section_id='$id'";
        mysqli_query($conn, $sql);
        $sql = "DELETE FROM sectiontbl WHERE id='$id'";
        mysqli_query($conn, $sql);
        $_SESSION['section_deleted'] = true;
        header("Location: section_list_page.php");
    }
?>