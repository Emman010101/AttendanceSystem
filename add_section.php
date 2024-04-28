<?php
    include "dbconnect.php";
    include "session.php";
    $grade = $_POST['grade'];
    $section = $_POST['section'];
    $sql = "INSERT INTO sectiontbl (`grade`, `section_name`) VALUES ('$grade', '$section')";
    mysqli_query($conn, $sql);
    $_SESSION['section_added'] = true;
    header("Location: add_section_page.php");
?>