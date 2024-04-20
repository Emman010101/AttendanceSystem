<?php
    include "dbconnect.php";
    session_start();
    if($_SERVER["REQUEST_METHOD"] == "POST") {
   
        // username and password sent from form 
        $myusername = mysqli_real_escape_string($conn,$_POST['username']);
        $mypassword = mysqli_real_escape_string($conn,$_POST['password']); 
  
        $sql = "SELECT * FROM `teachertbl` WHERE `username` = '$myusername' and `password` = MD5('$mypassword')";
  
        $result = mysqli_query($conn,$sql);      
        $row = mysqli_num_rows($result);      
        $count = mysqli_num_rows($result);
  
        if($count == 1) {
        
           // session_register("myusername");
           $_SESSION['login_user'] = $myusername;
           header("location: student_list_page.php");
        } else {
           $error = "Your Login Name or Password is invalid";
           header("location: index.php");
        }
     }
?>
