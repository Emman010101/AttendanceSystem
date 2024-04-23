<?php
    // include "dbconnect.php";
    // $sql = "SELECT time_in FROM timeinouttbl WHERE fingerprint_id=3";
    // $result = mysqli_query($conn, $sql);
    // if($row = mysqli_fetch_assoc($result)){
    //     date_default_timezone_set('Asia/Singapore');
    //     $timein = strtotime($row['time_in']);
    //     $currtime = strtotime(date('H:i:s'));
    //     $diff = $currtime - $timein;
    //     //echo $currtime - $timein;
    //     echo "timein: $timein currtime: $currtime diff: $diff";
    // }
    include "dbconnect.php";
    $sql = "SELECT studenttbl.student_fname, studenttbl.student_mname, studenttbl.student_lname, timeinouttbl.date, timeinouttbl.time_in, timeinouttbl.time_out
    FROM timeinouttbl INNER JOIN studenttbl ON timeinouttbl.fingerprint_id=studenttbl.fingerprint_id";

    $student_array = array();
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            array_push($student_array, $row);
        }
        //print_r($student_array);
        foreach ($student_array as $value => $key){
            echo $value[$key];
        }
    }
?>