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
    $code_gen = $_GET["code_gen"];
    $profile_picture = "default_avatar.png";
    $password = md5($_GET["password"]);
    
    $table = "system_user";
    $table_col = "first_name, middle_name, last_name, suffix, birthday, gender, username, password, address, contact, access, date_added, code";
    $table_val = "'$first_name', '$middle_name', '$last_name', '$suffix', '$birthday', '$gender', '$username', '$password', '$address', '$contact', '$access', '$date_added', '$code_gen'"; 
    $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> The New Account Has Been Added.
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

