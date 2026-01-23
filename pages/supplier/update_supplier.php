<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    $operation = $_GET["operation"];
    $primary_key = $_GET["primary_key"];

    $supplier_name = trim($_GET["name"]);
    $contact_person = trim($_GET["contact_person"]);
    $phone = trim($_GET["phone"]);
    $email = trim($_GET["email"]);
    $address = trim($_GET["address"]);

    $table = "vaccine_supplier";
    $col_to_update = "name='$supplier_name', contact_person='$contact_person', phone='$phone', email='$email', address='$address', updated_at = CURRENT_TIMESTAMP";
    $indicator = "id = '$primary_key'";
    $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);


?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> The Facility Has Been Updated.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>