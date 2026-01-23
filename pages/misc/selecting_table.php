<?php
    include '../../controller/systemtable.php'; 
    $systemtable = new systemtable();
    $table_name = $_GET["table_name"];
    if(!empty($_GET["values"])){
        $values = $_GET["values"];
    }else{
        $values = "none";
    }

    $SelectTable = $systemtable->SelectingTable($table_name, $values);
    // the table will be viewed in her!!.
?>

