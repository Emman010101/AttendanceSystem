<?php
    include "dbconnect.php";
    include "session.php";
    $sql = "SELECT time_in FROM timeinouttbl WHERE id=19";
    $result = mysqli_query($conn, $sql);
    //time diff calculator
    if($row = mysqli_fetch_assoc($result)){
        date_default_timezone_set('Asia/Singapore');
        $timein = strtotime($row['time_in']);
        $currtime = strtotime(date('H:i:s'));
        $diff = $currtime - $timein;
        //echo $currtime - $timein;
        //echo "timein: $timein currtime: $currtime diff: $diff";
        if($diff >= 3600){

        }
        //echo date('H:i:s');
    }

    //test if the day is weekend
    $date = '2024-04-23';
    $weekend = false;
    $day = date("D", strtotime($date));
    //echo $day;
    if($day == 'Sat' || $day == 'Sun'){
        $weekend = true;
    }
    if($weekend){
        //echo $date . ' It is a weekend';
    } else{
       // echo $date . ' It is not a weekend';
    }


    // include "dbconnect.php";
    // $sql = "SELECT studenttbl.id, studenttbl.student_fname, studenttbl.student_mname, studenttbl.student_lname, studenttbl.fingerprint_id, timeinouttbl.date, timeinouttbl.time_in, timeinouttbl.time_out
    // FROM timeinouttbl INNER JOIN studenttbl ON timeinouttbl.fingerprint_id=studenttbl.fingerprint_id ORDER BY timeinouttbl.date, studenttbl.id DESC";

    // $student_array = array();
    // $result = mysqli_query($conn, $sql);

    // if (mysqli_num_rows($result) > 0) {
    //     while($row = mysqli_fetch_assoc($result)) {
    //         array_push($student_array, $row);
    //     }
    //     //print_r($student_array);
    //     // $month = date_format(date_create($student_array[0]['date']), "m");
    //     // if($month[0] == 0){
    //     //     $month = substr($month, 1,2);
    //     // }
    //     // echo $month;

    //     //print_r($student_array);

    //     $curr_year = "";
    //     $curr_month = "";
    //     $curr_id = "";
    //     $isFirstRun = true;
    //     $new_stud_arr = array();
    //     //get all years
    //     $years_array = array();
    //     $months_array = array();
        
    //     foreach($student_array as $value){
    //         // $year = date_format(date_create($value['date']), "y");
    //         // $month = date_format(date_create($value['date']), "m");
    //         // if($month[0] == 0){
    //         //     $month = substr($month, 1,2);
    //         // }
    //         // if($isFirstRun){
    //         //     $isFirstRun = false;
    //         //     $curr_id = $value['id'];
    //         //     $curr_year = $year;
    //         //     $curr_month = $month;
    //         // }
    //         // if($value['id'] == $curr_id && $year == $curr_year){
                
    //         // }
    //         //add all years in the years array
    //         //array_push($years_array, date_format(date_create($value['date']), "y"));
    //         //add all years in the month array
    //         //array_push($months_array, date_format(date_create($value['date']), "m"));
    //         //print_r($value);
    //         //echo "<br></br>";
    //         // foreach($value as $key => $value2){
    //         //     echo $key."\n";
    //         // }
    //         // array_push($new_stud_arr, $values);
    //         // //print_r($new_stud_arr);
    //         // foreach($value as $key => $value2){
    //         //     echo $key."\n";
    //         // }
    //         array_push($new_stud_arr, $value);
    //     }
    //     //print_r($new_stud_arr);
    //     $arr_id = array();
    //     for($i = 0;$i < count($new_stud_arr);$i++){
            
    //     }
    // }

    // $sql = "SELECT studenttbl.id, studenttbl.student_fname, studenttbl.student_mname, studenttbl.student_lname, studenttbl.fingerprint_id, timeinouttbl.date, timeinouttbl.time_in, timeinouttbl.time_out
    // FROM timeinouttbl INNER JOIN studenttbl ON timeinouttbl.fingerprint_id=studenttbl.fingerprint_id ORDER BY timeinouttbl.date, studenttbl.id DESC";

    // $student_array = array();
    // $result = mysqli_query($conn, $sql);

    // //get all existing years
    // $years_container = array();
    // $months_container = array();
    // $data = array();
    // if (mysqli_num_rows($result) > 0) {
    //     while($row = mysqli_fetch_assoc($result)) {
    //         array_push($years_container, date_format(date_create($row['date']), "y"));
    //         array_push($months_container, date_format(date_create($row['date']), "m"));
    //         array_push($data, $row);
    //     }
    //     $years_container = array_unique($years_container, SORT_STRING);
    //     $months_container = array_unique($months_container, SORT_STRING);
    //     print_r($months_container);
    // }
    echo $_SESSION['section_id'];
?>