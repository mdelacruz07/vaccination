<?php
//   $profile_picture = $_POST['profile_v'];

echo $_POST["name"];
$ImageName = $_FILES["profile"]["name"];

$target_dir = "../../dist/img/";
$target_file = $target_dir . basename($ImageName);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    
echo $ImageName."<br>";
echo $target_dir."<br>";
echo $target_file."<br>";
echo $imageFileType."<br>";

  $check = getimagesize($_FILES["profile"]["tmp_name"]);
  if($check !== false) {
      $uploadOk = 1;
  } else {
      $uploadOk = 0;
  }
  
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
      $uploadOk = 0;
  }
  if ($uploadOk == 0) {
     
  }
  if($uploadOk == 1){
      if (move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)) {
          echo "The file ". basename( $_FILES["profile"]["name"]). " has been uploaded.";
      }
  }