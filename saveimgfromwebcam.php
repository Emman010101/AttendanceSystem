<?php

$filename =  'temp.jpg';
$filepath = 'uploads/';

move_uploaded_file($_FILES['webcam']['tmp_name'], $filepath.$filename);

echo $filepath.$filename;
?>