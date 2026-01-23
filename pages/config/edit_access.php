<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $id = $_GET['primary_id'];

    $SelectTable = $systemcore->SelectTable(" system_page_access WHERE page_access = '$id'");
    foreach($SelectTable as $value){
        $access_name = $value['name'];
        $page_id = $value['page_id'];
        
        $pages_id = explode(",",$page_id);
    }
?>
<label>Access Level Details:</label>  
<!-- This Alert is needed -->
<div class="alert alert-danger custom_required alert-dismissible fade show" id="required_div" role="alert">
    <strong>ERROR!</strong> Please Fill in the required Inputs below!
    <button type="button" class="close" onclick="turn_off_required('required_div')" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div> 

<div id="update_result">

</div>
<form id ="edit_access" enctype="multipart/form-data">                 
    <input type="text" class="form-control float-right" value="<?php echo $id;?>" id="primary_key" name="primary_key" hidden >
    <div class="card-body" >
        <div class="input-group">
            <div class="input-group-prepend">
            <span class="input-group-text">
                <b> Name:</b>
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
    <input type="text" name="selected_id" id="selected_id" hidden value="<?php echo $page_id; ?>">
</form> 
<div class="modal-footer justify-content-between">
    <button class="btn btn-default" data-dismiss="modal"></button>
    <button type="submit" onclick="set_system_cardinal_operation('You want to Update this Settings?', 'update', 'edit_access', 'update_access.php', 'edit_access', 'none', 'none', 'required_div', 'confirmation_update_success', 'none')" class="btn btn-primary">Update</button>                           
</div>