<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    $access_level_name = $_GET["access_level_name"];

    $table = "system_page_access";
    $table_col = "name";
    $table_val = "'$access_level_name'"; 
    $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> The New Access Level Has Been Added.
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