<?php
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];

    $ImageName = $first_name."".$last_name.".jpg";

    $target_dir = "../../dist/img/";
    $target_file = $target_dir . basename($ImageName);

    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    
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
?>