<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $systemcore->System_Sessioning("session");

    $inventory_id = trim($_GET["inventory_id"]);
    $type = trim($_GET["transaction_type"]);
    $qty = trim($_GET["quantity"]);
    $trans_date = trim($_GET["transaction_date"]);
    $performed_by = trim($_GET["performed_by"]);
    $remarks = trim($_GET["remarks"]);
    $created_by = $_SESSION["user_id"];

    $table = "vaccine_transactions";
    $table_col = "`inventory_id`, `transaction_type`, `quantity`, `transaction_date`, `performed_by`, `remarks`, `created_by`";
    $table_val = "'$inventory_id', '$type', '$qty', '$trans_date', '$performed_by', '$remarks', '$created_by'"; 
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