<?php

    include '../../controller/systemcore.php'; 
    include '../../database/connector.php';
    $systemcore = new systemcore();
    $systemcore->System_Sessioning("session");

    $selected_id = $_GET["selected_id"];
    $selected_id = explode(",", $selected_id);
    
    $length = count($selected_id);
    for ($i = 1; $i < $length; $i++) {
        $table = "patient";
        $arr = [
          'is_archive' => '1',
          'is_archive_at' => date('Y-m-d H:i:s'),
          'is_archive_by' => $_SESSION['user_id']
        ];
        $indicator = "id = '$selected_id[$i]'";

        // Just make an update to hide the data instead of deleting it.
        $col_to_update = "";

        foreach ($arr as $key => $value) {
            $col_to_update .= "$key = '$value', ";
        }

        $col_to_update = rtrim($col_to_update, ", ");
        $sql = "UPDATE $table SET $col_to_update WHERE $indicator";
        $result = $conn->query($sql);
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
    $table_name = "vaccine_patient";

    $SelectTable = $systemtable->SelectingTable($table_name, 'none');
?>