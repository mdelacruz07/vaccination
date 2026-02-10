<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $systemcore->System_Sessioning("session");

    $operation = $_GET["operation"];
    $primary_key = $_GET["primary_key"];

    $vaccine_id = trim($_GET["vaccine_id"]);
    $issued_type = trim($_GET["issued_type"]);
    $issued_to = trim($_GET["issued_to"]);
    $vaccinee_id = trim($_GET["vaccinee_id"]);
    $qty = trim($_GET["quantity"]);
    $issued_date = trim($_GET["issued_date"]);
    $remarks = trim($_GET["remarks"]);
    $updated_by = $_SESSION["user_id"];


    $table = "vaccine_issuance";
    $col_to_update = "vaccine_id = '$vaccine_id',
                      issued_type = '$issued_type',
                      issued_to = '$issued_to',
                      vaccinee_id = '$vaccinee_id',
                      quantity='$qty',
                      issued_date='$issued_date',
                      remarks='$remarks',
                      update_by='$updated_by',
                      update_date=CURRENT_TIMESTAMP
                     ";
    $indicator = "id = '$primary_key'";
    $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> The Issuance Has Been Updated.
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