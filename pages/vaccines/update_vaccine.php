<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    $operation = $_GET["operation"];
    $primary_key = $_GET["primary_key"];

    $vaccine_name = $_GET["vaccine_name"];
    $type = $_GET["type"];
    $manufacturer = $_GET["manufacturer"];
    $dose_per_vial = $_GET["dose_per_vial"];
    $description = $_GET["description"];

    $table = "vaccines";
    $col_to_update = "name='$vaccine_name', type='$type', manufacturer='$manufacturer', dose_per_vial='$dose_per_vial', description='$description', updated_at=CURRENT_TIMESTAMP";
    $indicator = "id = '$primary_key'";
    $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);


?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> The Facility Has Been Updated.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>