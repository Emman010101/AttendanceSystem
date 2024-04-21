<?php
    include "dbconnect.php";
    session_start();
    $id = $_GET["id"];
    $sql = "UPDATE studenttbl SET del_fingerid='1' WHERE id=$id;";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['student_deleted'] = true;
        $fpid = $_GET['fpid'];
        $sql = "DELETE FROM timeinouttbl WHERE fingerprint_id=$fpid;";
        mysqli_query($conn, $sql);
        header("Location: student_list_page.php");
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
?>