<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $systemcore->System_Sessioning("session");

    $vaccine_name = trim($_GET["name"]);
    $type = trim($_GET["type"]);
    $manufacturer = trim($_GET["manufacturer"]);
    $dose_per_dial = trim($_GET["dose_per_vial"]);
    $description = trim($_GET["description"]);
    $created_by = $_SESSION["user_id"];

    $table = "vaccines";
    $table_col = "`name`, `type`, `manufacturer`, `dose_per_vial`, `description`, `created_by`";
    $table_val = "'$vaccine_name', '$type', '$manufacturer', '$dose_per_dial', '$description', '$created_by'"; 
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