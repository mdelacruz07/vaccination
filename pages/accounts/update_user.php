<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    $operation = $_GET["operation"];
    $primary_key = $_GET["primary_key"];

    $first_name = $_GET["first_name"];
    $last_name = $_GET["last_name"];
    $middle_name = $_GET["middle_name"];
    $suffix = $_GET["suffix"];
    $birthday = $_GET["birthday"];
    $gender = $_GET["gender"];
    $address = $_GET["address"];
    $contact = $_GET["contact"];
    $username = $_GET["username"];
    $access = $_GET["access"];
    $profile_picture = $_GET["profile"];
    $facility_id = $_GET["facility_id"];

    if($profile_picture == "none"){
        $profile_picture = $_GET["old_profile"];
    }else{
        // $profile_picture = explode(".",$profile_picture);
        // $profile_picture_1 = str_replace('C:\fakepath', '', $profile_picture[0]);
        // $profile_picture_1 = preg_replace('/[^\p{L}\p{N}\s]/u', '', $profile_picture_1);
        // $profile_picture = $profile_picture_1.".".$profile_picture[1];

        $profile_picture = $first_name."".$last_name.".jpg";
    }

    if($_GET["password"] != $_GET["old_password"]){
      $password = md5($_GET["password"]);
    }else{
      $password = $_GET["password"];
    }

    $table = "system_user";
    $col_to_update = "first_name='$first_name', middle_name='$middle_name', last_name='$last_name', birthday='$birthday', gender='$gender', address='$address', contact='$contact', suffix='$suffix', username='$username', password='$password', access='$access', profile_picture='$profile_picture', facility_id='$facility_id'";
    $indicator = "id = '$primary_key'";
    $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);


?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> The User Has Been Updated.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>