<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $systemcore->System_Sessioning("session");

    $operation = $_GET["operation"];
    $primary_key = $_GET["primary_key"];

    $vaccine_id = trim($_GET["vaccine_id"]);
    $supplier_id = trim($_GET["supplier_id"]);
    $facility_id = trim($_GET["facility_id"]);
    $qty = trim($_GET["quantity"]);
    $remarks = trim($_GET["remarks"]);
    $updated_by = $_SESSION["user_id"];


    $table = "vaccine_receive";
    $col_to_update = "vaccine_id = '$vaccine_id',
                      supplier_id = '$supplier_id',
                      facility_id='$facility_id',
                      quantity='$qty',
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

<?php
    include '../../controller/systemtable.php'; 
    $systemtable = new systemtable();
    // $table_name = $_GET["table_name"];

    $SelectTable = $systemtable->SelectingTable($table, 'none');
?>