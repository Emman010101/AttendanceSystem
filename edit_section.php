<?php
    include "dbconnect.php";
    include "session.php";
    $grade = $_POST['grade'];
    $section = $_POST['section'];
    $id = $_POST['id'];
    $sql = "UPDATE sectiontbl SET grade='$grade', section_name='$section' WHERE id='$id'";
    mysqli_query($conn, $sql);
    $_SESSION["section_edited"] = true;
    header("Location: section_list_page.php");
?>