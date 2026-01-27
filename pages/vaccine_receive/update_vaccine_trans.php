<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $systemcore->System_Sessioning("session");

    $operation = $_GET["operation"];
    $primary_key = $_GET["primary_key"];

    $vaccine_id = trim($_GET["vaccine_id"]);
    $batch_no = trim($_GET["batch_no"]);
    $manufacturer = trim($_GET["manufacturer"]);
    $supplier_id = trim($_GET["supplier_id"]);
    $quantity_received = trim($_GET["quantity_received"]);
    $quantity_available = trim($_GET["quantity_available"]);
    $unit = trim($_GET["unit"]);
    $temperature_range = trim($_GET["temperature_range"]);
    $expiry_date = trim($_GET["expiry_date"]);
    $received_by = trim($_GET["received_by"]);
    $date_received = trim($_GET["date_received"]);
    $status = trim($_GET["status"]);
    $storage_location = trim($_GET["storage_location"]);
    $remarks = trim($_GET["remarks"]);
    $updated_by = $_SESSION["user_id"];


    $table = "vaccine_inventory";
    $col_to_update = "vaccine_id='$vaccine_id',
                      batch_no='$batch_no',
                      manufacturer='$manufacturer',
                      supplier_id='$supplier_id',
                      quantity_received='$quantity_received',
                      quantity_available='$quantity_available',
                      unit='$unit',
                      storage_location='$storage_location',
                      temperature_range='$temperature_range',
                      expiry_date='$expiry_date',
                      date_received='$date_received',
                      received_by='$received_by',
                      status='$status',
                      remarks='$remarks',
                      updated_by='$updated_by',
                      updated_at=CURRENT_TIMESTAMP
                     ";
    $indicator = "id = '$primary_key'";
    $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> The Facility Has Been Updated.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>