<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $systemcore->System_Sessioning("session");

    $supplier_name = trim($_GET["name"]);
    $contact_person = trim($_GET["contact_person"]);
    $phone = trim($_GET["phone"]);
    $email = trim($_GET["email"]);
    $address = trim($_GET["address"]);
    $created_by = $_SESSION["user_id"];

    $table = "vaccine_supplier";
    $table_col = "`name`, `contact_person`, `phone`, `email`, `address`, `created_by`";
    $table_val = "'$supplier_name', '$contact_person', '$phone', '$email', '$address', '$created_by'"; 
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