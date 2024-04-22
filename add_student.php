<?php
    include "dbconnect.php";
    session_start();
    $lrn = $_POST['lrn'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $birthdate = $_POST['birthdate'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $phoneno = $_POST['phoneno'];

    $birthdate = str_replace('/', '-', $birthdate);
    $time = strtotime($birthdate);
    $newformat = date('Y-m-d',$time);
    $birthdate = $newformat;
    $fingerprint_id = "";

    $sql = "SELECT * FROM studenttbl WHERE fingerprint_id <> 0";
    $result = mysqli_query($conn, $sql);

    $fingerprint_ids = array();
    if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)) {
        array_push($fingerprint_ids, $row['fingerprint_id']);
      }

      sort($fingerprint_ids);
      $last_fingerprint_id = 0;

      if(count($fingerprint_ids) > 1){
        $diff = $fingerprint_ids[0] - 0;
        if($diff > 1){
          $last_fingerprint_id = 1;
        }else{
          for($i = 0;$i < count($fingerprint_ids);$i++){
            if($i < count($fingerprint_ids)-1){
              if(($fingerprint_ids[$i+1] - $fingerprint_ids[$i]) > 1){
                $last_fingerprint_id = $fingerprint_ids[$i] + 1;
                break;
              }
            }
          }
        }
      }else{
        if($fingerprint_ids[0] > 1){
          $diff = $fingerprint_ids[0] - 1;
          $last_fingerprint_id = $fingerprint_ids[0] - $diff;
        }else{
          $last_fingerprint_id = $fingerprint_ids[0] + 1;
        }
      }
    }


    $sql="INSERT INTO studenttbl ( `student_lrn`, `student_fname`, `student_mname`, `student_lname`, `student_birthdate`, `student_gender`, `student_address`, `student_phoneno`, `fingerprint_id`)
VALUES('$lrn', '$fname', '$mname', '$lname', '$birthdate', '$gender', '$address', '$phoneno', '$last_fingerprint_id')";
    
    if (mysqli_query($conn, $sql)) {
      $_SESSION['student_added'] = true; 
      header("Location: add_student_page.php");
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);
?>