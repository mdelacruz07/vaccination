<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    $operation = $_GET["operation"];
    $primary_key = $_GET["primary_key"];
    $username = $_GET["username"];

    if($_GET["password"] != $_GET["old_password"]){
      $password = md5($_GET["password"]);
    }else{
      $password = $_GET["password"];
    }

    $table = "system_user";
    $col_to_update = "username='$username', password='$password'";
    $indicator = "id = '$primary_key'";
    $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);

?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your Account Has Been Updated Successfully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>