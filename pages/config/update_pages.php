<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    $primary_key = $_GET["primary_key"];
    $pages_id = $_GET["pages_id"];
    $page_name = $_GET["page_name"];
    $page_link = $_GET["page_link"];
    $page_icon = $_GET["page_icon"];
    $nav_group_id = $_GET["nav_group_id"];
    
    
    $length = count($pages_id);
    for ($i = 0; $i < $length; $i++) {
        $table = "system_pages";
        $col_to_update = "page_name='$page_name[$i]', page_link='$page_link[$i]', page_icon='$page_icon[$i]', nav_group_id='$nav_group_id[$i]'";
        $indicator = "pages_id = '$pages_id[$i]'";
        $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator); 
    }
    ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> The Pages Has Been Updated.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <?php
?>

