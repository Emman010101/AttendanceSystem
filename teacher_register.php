<?php
    include "dbconnect.php";
    $sql="INSERT INTO teachertbl ( `username`, `password`)
VALUES('teacher', MD5('teacher'))";
    
    if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
      header("Location: index.php");
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
    mysqli_close($conn);
?>