<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $systemcore->System_Sessioning("session");

    $vaccine_id = trim($_GET["vaccine_id"]);
    $issued_to = trim($_GET["issued_to"]); // Facility id
    $issued_type = trim($_GET["issued_type"]);
    $vaccinee_id = trim($_GET["vaccinee_id"]);
    $quantity = trim($_GET["quantity"]);
    $issued_date = trim($_GET["issued_date"]);
    $remarks = trim($_GET["remarks"]);
    $created_by = $_SESSION["user_id"];
    
    $table = "vaccine_issuance";
    $table_col = "`vaccine_id`, `issued_to`, `issued_type`, `vaccinee_id`, `quantity`, `issued_date`, `remarks`, `created_by`";
    $table_val = "'$vaccine_id', '$issued_to', '$issued_type', '$vaccinee_id', '$quantity', '$issued_date', '$remarks', '$created_by'"; 
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