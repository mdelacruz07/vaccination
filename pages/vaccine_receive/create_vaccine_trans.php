<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $systemcore->System_Sessioning("session");

    $vaccine_id = trim($_GET["vaccine_id"]);
    $supplier_id = trim($_GET["supplier_id"]);
    $facility_id = trim($_GET["facility_id"]);
    // $type = trim($_GET["transaction_type"]);
    $qty = trim($_GET["quantity"]);
    // $trans_date = trim($_GET["transaction_date"]);
    // $performed_by = trim($_GET["performed_by"]);
    $remarks = trim($_GET["remarks"]);
    $created_by = $_SESSION["user_id"];
    
    $table = "vaccine_receive";
    $table_col = "`vaccine_id`, `supplier_id`, `facility_id`, `quantity`, `remarks`, `created_by`";
    $table_val = "'$vaccine_id', '$supplier_id', '$facility_id', '$qty', '$remarks', '$created_by'"; 
    $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);

?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> A New transaction log Has Been Added.
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