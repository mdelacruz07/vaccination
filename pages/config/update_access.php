<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    $primary_key = $_GET["primary_key"];
    $access_name = $_GET["access_name"];
    $selected_id = $_GET["selected_id"];

    $pages_id = explode(",",$selected_id);

    $nav_group_id = "";
    foreach($pages_id as $pages){  
        $SelectGroups = $systemcore->SelectTable("system_pages WHERE pages_id = '$pages'");
        if($SelectGroups != "none"){
            foreach($SelectGroups as $value){  
                $nav_group_id = $nav_group_id.", ".$value["nav_group_id"];
            }
        }
    }
    $nav_group_id = array_unique(explode(",",$nav_group_id));
    $nav_group_id = implode(",",$nav_group_id);

    $table = "system_page_access";
    $col_to_update = "page_id='$selected_id', name='$access_name', nav_group_id='$nav_group_id'";
    $indicator = "page_access  = '$primary_key'";
    $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator); ?>

    <div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> The Accessibility Level Has Been Updated.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>
    <?php
?>


<input type="text" class="form-control float-right" value="<?php echo $id;?>" id="primary_key" name="primary_key" hidden >
<div class="card-body" >
    <label>Access Name:</label>
    <div class="input-group">
        <div class="input-group-prepend">
        <span class="input-group-text">
        <i class="far fa-address-card"></i>
        </span>
        </div>
        <input type="text" class="form-control float-right" id="access_name" value="<?php echo $access_name;?>" name="access_name" alt="required"> 
    </div>
    <br>
    <?php 
        include '../../controller/systemtable.php'; 
        $systemtable = new systemtable();
        $SelectTable = $systemtable->SelectingTable("sys_confi_page_access_edit", $pages_id);
    ?>
</div>
<input type="text" name="selected_id" id="selected_id" hidden value="<?php echo $selected_id; ?>">
