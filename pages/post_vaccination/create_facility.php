<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    $firstname = $_GET["add_firstname"];
    $middlename = $_GET["add_middlename"];
    $lastname = $_GET["add_lastname"];
    $initial_VS = $_GET["add_initial_VS"];
    $BP_1 = $_GET["add_BP_1"];
    $BP_2 = $_GET["add_BP_2"];
    $BP_2 = $_GET["add_BP_2"];
    $BP_3 = $_GET["add_BP_3"];
    $addmission_time_hour = $_GET["add_addmission_time_hour"];
    $addmission_time_minute = $_GET["add_addmission_time_minute"];
    $discharge_time_hour = $_GET["add_discharge_time_hour"];
    $discharge_time_minute = $_GET["add_discharge_time_minute"];
    $remarks = $_GET["add_remarks"];
    
    $table = "post_vaccination";
    $table_col = "firstname, middlename, lastname, discharge_time_hour, discharge_time_minute, initial_VS, BP_1, BP_2, BP_3, remarks, addmission_time_hour, addmission_time_minute";
    $table_val = "'$firstname', '$middlename', '$lastname', '$discharge_time_hour', '$discharge_time_minute', '$initial_VS', '$BP_1', '$BP_2', '$BP_3', '$remarks', '$addmission_time_hour', '$addmission_time_minute'"; 
    $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> The New Field Has Been Added.
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

