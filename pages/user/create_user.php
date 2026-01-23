<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    
    $date_added = date("Y-m-d");

    $first_name = $_GET["first_name"];
    $last_name = $_GET["last_name"];
    $middle_name = $_GET["middle_name"];
    $suffix = $_GET["suffix"];
    $birthday = $_GET["birthday"];
    $gender = $_GET["gender"];
    $address = $_GET["address"];
    $contact = $_GET["contact"];
    $username = $_GET["username"];
    $password = $_GET["password"];
    $access = $_GET["access"];
    $profile_picture = $_GET["profile"];

    $password = md5($_GET["password"]);
    

    if(!empty($profile_picture)){
      // $profile_picture = explode(".",$profile_picture);
        // $profile_picture_1 = str_replace('C:\fakepath', '', $profile_picture[0]);
        // $profile_picture_1 = preg_replace('/[^\p{L}\p{N}\s]/u', '', $profile_picture_1);
        // $profile_picture = $profile_picture_1.".".$profile_picture[1];

        $profile_picture = $first_name."".$last_name.".jpg";
    }else{
        $profile_picture = "default_avatar.png";
    }
    
    $table = "system_user";
    $table_col = "first_name, middle_name, last_name, suffix, birthday, gender, username, password, address, contact, access, date_added, profile_picture";
    $table_val = "'$first_name', '$middle_name', '$last_name', '$suffix', '$birthday', '$gender', '$username', '$password', '$address', '$contact', '$access', '$date_added', '$profile_picture'"; 
    $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> The New User Has Been Added.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php
    include '../../controller/systemtable.php'; 
    $systemtable = new systemtable();
    $table_name = $_GET["table_name"];

    $SelectTable = $systemtable->SelectingTable($table_name,'none');
?>

