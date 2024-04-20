<?php
    include "dbconnect.php";
    session_start();
    $id = $_GET["id"];
    $sql = "DELETE FROM studenttbl WHERE id=$id;";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['student_deleted'] = true; 
        header("Location: student_list_page.php");
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }
?>