<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    $operation = $_GET["operation"];
    $primary_key = $_GET["primary_key"];

    $pcm_id = $_GET["pcm_id"];
    $qr_id = $_GET["qr_id"];
    $firstname = $_GET["firstname"];
    $middlename = $_GET["middlename"];
    $lastname = $_GET["lastname"];
    $discharge_time_hour = $_GET["discharge_time_hour"];
    $discharge_time_minute = $_GET["discharge_time_minute"];
    $initial_VS = $_GET["initial_VS"];
    $BP_1 = $_GET["BP_1"];
    $BP_2 = $_GET["BP_2"];
    $BP_3 = $_GET["BP_3"];
    $remarks = $_GET["remarks"];
    $addmission_time_hour = $_GET["addmission_time_hour"];
    $addmission_time_minute = $_GET["addmission_time_minute"];

    $discharge_time_hour_1 = $_GET["discharge_time_hour_1"];
    $discharge_time_minute_1 = $_GET["discharge_time_minute_1"];
    $BP_1_1 = $_GET["BP_1_1"];
    $BP_2_1 = $_GET["BP_2_1"];
    $BP_3_1 = $_GET["BP_3_1"];
    $remarks = $_GET["remarks"];
    $addmission_time_hour_1 = $_GET["addmission_time_hour_1"];
    $addmission_time_minute_1 = $_GET["addmission_time_minute_1"];


    $table = "post_vaccination";
    $col_to_update = "firstname='$firstname', middlename='$middlename', lastname='$lastname', discharge_time_hour='$discharge_time_hour', discharge_time_minute='$discharge_time_minute', initial_VS='$initial_VS', BP_1='$BP_1', BP_2='$BP_2', BP_3='$BP_3', remarks='$remarks', addmission_time_hour='$addmission_time_hour', addmission_time_minute='$addmission_time_minute', discharge_time_hour_1='$discharge_time_hour_1', discharge_time_minute_1='$discharge_time_minute_1', BP_1_1='$BP_1_1', BP_2_1='$BP_2_1', BP_3_1='$BP_3_1', addmission_time_hour_1='$addmission_time_hour_1', addmission_time_minute_1='$addmission_time_minute_1'";
    $indicator = "id = '$pcm_id'";
    $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);

    $table = "local_pv";
    $col_to_update = "firstname='$firstname', middlename='$middlename', lastname='$lastname', discharge_time_hour='$discharge_time_hour', discharge_time_minute='$discharge_time_minute', initial_VS='$initial_VS', BP_1='$BP_1', BP_2='$BP_2', BP_3='$BP_3', remarks='$remarks', addmission_time_hour='$addmission_time_hour', addmission_time_minute='$addmission_time_minute', discharge_time_hour_1='$discharge_time_hour_1', discharge_time_minute_1='$discharge_time_minute_1', BP_1_1='$BP_1_1', BP_2_1='$BP_2_1', BP_3_1='$BP_3_1', addmission_time_hour_1='$addmission_time_hour_1', addmission_time_minute_1='$addmission_time_minute_1'";
    $indicator = "qr_id = '$qr_id'";
    $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    

?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> The Field Has Been Updated.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>