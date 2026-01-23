<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    $nav_bar = $_GET["nav_bar"];
    $nav_bar_text_color = $_GET["nav_bar_text_color"];
    $nav_bar_title = $_GET["nav_bar_title"];
    $side_bar = $_GET["side_bar"];
    $side_bar_text = $_GET["side_bar_text"];
    $hover_side_bar_text = $_GET["hover_side_bar_text"];
    $hover_side_bar_text_bg = $_GET["hover_side_bar_text_bg"];
    $header_color = $_GET["header_color"];
    $header_font_color = $_GET["header_font_color"];
    $modal_header_color = $_GET["modal_header_color"];
    $modal_header_font_color = $_GET["modal_header_font_color"];
    $title = $_GET["title"];
    $head_title = $_GET["head_title"];
    $system_main_redirect = $_GET["system_main_redirect"];
    $system_logo = $_GET["system_logo"];
    $login_background_image = $_GET["login_background_image"];
    $background_image = $_GET["background_image"];


    $system_add_bg_btn_color = $_GET['system_add_bg_btn_color'];
    $system_add_btn_border = $_GET['system_add_btn_border'];
    $system_add_btn_color = $_GET['system_add_btn_color'];
    $system_add_btn_size = $_GET['system_add_btn_size'];

    $system_delete_bg_btn_color = $_GET['system_delete_bg_btn_color'];
    $system_delete_btn_border = $_GET['system_delete_btn_border'];
    $system_delete_btn_color = $_GET['system_delete_btn_color'];
    $system_delete_btn_size = $_GET['system_delete_btn_size'];

    $system_edit_bg_btn_color = $_GET['system_edit_bg_btn_color'];
    $system_edit_btn_border = $_GET['system_edit_btn_border'];
    $system_edit_btn_color = $_GET['system_edit_btn_color'];
    $system_edit_btn_size = $_GET['system_edit_btn_size'];
   
    $table = "system_config";
    $col_to_update = "title='$title', head_title='$head_title', nav_bar_title='$nav_bar_title', nav_bar='$nav_bar', nav_bar_text_color='$nav_bar_text_color', side_bar='$side_bar', side_bar_text='$side_bar_text', hover_side_bar_text='$hover_side_bar_text', hover_side_bar_text_bg='$hover_side_bar_text_bg', header_color='$header_color', header_font_color='$header_font_color', modal_header_color='$modal_header_color', modal_header_font_color='$modal_header_font_color', system_main_redirect='$system_main_redirect', system_logo='$system_logo', login_background_image='$login_background_image', background_image='$background_image',system_add_bg_btn_color='$system_add_bg_btn_color', system_add_btn_border='$system_add_btn_border', system_add_btn_color ='$system_add_btn_color', system_add_btn_size ='$system_add_btn_size', system_delete_bg_btn_color ='$system_delete_bg_btn_color', system_delete_btn_border ='$system_delete_btn_border', system_delete_btn_color ='$system_delete_btn_color', system_delete_btn_size ='$system_delete_btn_size', system_edit_bg_btn_color ='$system_edit_bg_btn_color', system_edit_btn_border ='$system_edit_btn_border', system_edit_btn_color ='$system_edit_btn_color', system_edit_btn_size ='$system_edit_btn_size'";
    $indicator = "id  = '1'";
    $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator); 
    

    ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> The System Designe and Configuration Has Been Updated.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <?php
?>

