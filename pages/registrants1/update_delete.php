<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    
    $primary_key = $_GET["primary_key"];
    $registration_id = $_GET["registration_id"];
    $delete_username = $_GET["delete_username"];
    $delete_password = $_GET["delete_password"];
    if($delete_username == "admin" && $delete_password="delete123"){ 
        
        $table = "vaccine_registration";
        $indicator = "id = '$registration_id'";
        $DeleteTable = $systemcore->DeleteTable($table, $indicator); ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> The Regestrant Has Been Deleted.
        </div> <?php
    }else{   ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error!</strong> Username and Password Doesnt Match! kindly contact system administrator for the new password! .
        </div> <?php
    }    
?>

