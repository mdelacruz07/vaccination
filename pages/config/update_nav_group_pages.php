<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    $primary_key = $_GET["primary_key"];
    $nav_id = $_GET["nav_id"];
    $nav_group_name = $_GET["nav_group_name"];

    $length = count($nav_id);
    for ($i = 0; $i < $length; $i++) {
        $table = "system_nav_group";
        $col_to_update = "nav_group_name='$nav_group_name[$i]'";
        $indicator = "id = '$nav_id[$i]'";
        $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator); 
    }
    ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> The Navigation Group Has Been Updated.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <?php
?>

