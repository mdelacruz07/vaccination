<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    
    $registration_id = $_GET["registration_id"];
    $update_status = $_GET["update_status"];
    $sched_status = $_GET["sched_status"];
    $schedule_id = $_GET["schedule_id"];

    if($update_status == "CREATE"){
      $table = "vaccine_schedule";
      $table_col = "`reg_id`, `schedule_id`";
      $table_val = "'$registration_id', '$schedule_id'"; 
      $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
    }else{
      $table = "vaccine_schedule";
      $col_to_update = "schedule_id='$schedule_id'";
      $indicator = "reg_id = '$registration_id'";
      $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    }

    $table = "vaccine_registration";
    $col_to_update = "sched_status ='$sched_status'";
    $indicator = "id = '$registration_id'";
    $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);


?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> The Regestrant Schedule Has Been Updated.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>