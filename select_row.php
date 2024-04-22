<?php
    include "dbconnect.php";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "UPDATE studenttbl SET fingerprint_select=0, add_fingerid=0 WHERE fingerprint_select=1";
        mysqli_query($conn, $sql);
        $sql = "UPDATE studenttbl SET fingerprint_select=1, add_fingerid=1 WHERE id=$id";
        mysqli_query($conn, $sql);
        $search = "";
        if(isset($_GET['search'])){
            $search = "?search=".$_GET['search']; 
        }
        header("Location: register_biometric_page.php".$search);
    }
?>