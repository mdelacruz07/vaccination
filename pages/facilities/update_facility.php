<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    $operation = $_GET["operation"];
    $primary_key = $_GET["primary_key"];

    $facility_name = $_GET["facility_name"];
    $location = $_GET["location"];
    $iframe_location = $_GET["iframe_location"];
    $status = $_GET["status"];

    $table = "system_facilities";
    $col_to_update = "facility_name='$facility_name', location='$location', iframe_location='$iframe_location', status='$status'";
    $indicator = "id = '$primary_key'";
    $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);


?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> The Facility Has Been Updated.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>