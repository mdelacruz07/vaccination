<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    $facility_name = $_GET["add_facility_name"];
    $location = $_GET["add_location"];
    $iframe_location = $_GET["add_iframe_location"];
    $status = $_GET["add_status"];


    
    $table = "system_facilities";
    $table_col = "`facility_name`, `location`, `iframe_location`, `status`";
    $table_val = "'$facility_name', '$location', '$iframe_location', '$status'"; 
    $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> The New Facility Has Been Added.
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

