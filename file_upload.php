<?php
if(!empty($_FILES["fileToUpload"]["name"])){
    $target_dir = "uploads/";
$file_name = basename($_FILES["fileToUpload"]["name"]);
$target_file = $target_dir . $lrn . substr($file_name, stripos($file_name, "."), strlen($file_name));
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$new_filename = $lrn . substr($file_name, stripos($file_name, "."), strlen($file_name));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  echo "<script>console.log('Sorry, there was an error uploading your file.')</script>";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    echo "<script>console.log('"."The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded."."')</script>";
  } else {
    echo "Sorry, there was an error uploading your file.";
    echo "<script>console.log('Sorry, there was an error uploading your file.')</script>";
  }
}
}else{
    $new_filename = "";
    if(file_exists("uploads/temp.jpg")){
        $new_filename = $lrn.".jpg";
        rename("uploads/temp.jpg", "uploads/".$lrn.".jpg");
    }
}

?>