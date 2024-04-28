<?php
    include "dbconnect.php";
    include "session.php";
    $timein = $_POST['timein'];
    $timeout = $_POST['timeout'];

    $sql = "UPDATE timeinoutsettingstbl SET `timein`='$timein', `timeout`='$timeout'";
    mysqli_query($conn, $sql);
    $_SESSION["schedule_edited"] = true;
    $_SESSION['timein'] = $timein;
    $_SESSION['timeout'] = $timeout;
    header("Location: schedule_page.php");
?>