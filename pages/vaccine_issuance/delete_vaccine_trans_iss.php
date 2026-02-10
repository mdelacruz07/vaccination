<?php

    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    $selected_id = $_GET["selected_id"];
    $selected_id = explode(",", $selected_id);
    
    $length = count($selected_id);
    for ($i = 1; $i < $length; $i++) {
        $table = "vaccine_issuance";
        $col_to_update = "is_archive = '1'";
        $indicator = "id = '$selected_id[$i]'";
        // $DeleteTable = $systemcore->DeleteTable($table, $indicator);

        // Just make an update to hide the data instead of deleting it.
        $DeleteTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    }
    
?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> The Selected Users has been Deleted.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<?php
    include '../../controller/systemtable.php'; 
    $systemtable = new systemtable();
    $table_name = $_GET["table_name"];

    $SelectTable = $systemtable->SelectingTable($table_name, 'none');
?>