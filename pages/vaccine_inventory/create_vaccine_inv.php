<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $systemcore->System_Sessioning("session");

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
    $created_by = $_SESSION["user_id"];

    $table = "vaccine_inventory";
    $table_col = "`vaccine_id`, `batch_no`, `manufacturer`, `supplier_id`, `quantity_received`, `quantity_available`, `unit`, `storage_location`, `temperature_range`, `expiry_date`, `date_received`, `received_by`, `status`, `remarks`, `created_by`";
    $table_val = "'$vaccine_id', '$batch_no', '$manufacturer', '$supplier_id', '$quantity_received', '$quantity_available', '$unit', '$storage_location', '$temperature_range', '$expiry_date', '$date_received', '$received_by', '$status', '$remarks', '$created_by'"; 
    $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);

?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> A New Vaccine Has Been Added.
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