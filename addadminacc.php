<?php
    include "dbconnect.php";
    $sql="INSERT INTO userstbl ( `username`, `password`)
VALUES('admin', MD5('admin'))";
    
    if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
      header("Location: index.php");
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);
?>