<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    $nav_group_name = $_GET["nav_group_name"];

    $table = "system_nav_group";
    $table_col = "nav_group_name";
    $table_val = "'$nav_group_name'"; 
    $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> The New Navigation Group Has Been Added.
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