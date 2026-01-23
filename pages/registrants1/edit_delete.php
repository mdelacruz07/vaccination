<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $id = $_GET['primary_id'];
?>
<div class="modal-header p-1">
    <h5 class="modal-title">Delete Registration</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>

<!-- This Alert is needed -->
<div class="alert alert-danger custom_required alert-dismissible fade show" id="required_div" role="alert">
    <strong>ERROR!</strong> Please Fill in the  Inputs below!
    <button type="button" class="close" onclick="turn_off_required('required_div')" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div> 


<div class="modal-body p-2 m-0" id="delete_result">
    <form id ="delete_form" enctype="multipart/form-data" class="p-0 m-0">
        <input type="text" class="form-control float-right" value="<?php echo $id;?>" id="primary_key" name="primary_key"  hidden>
        <input type="text" class="form-control float-right" value="<?php echo $id;?>" id="registration_id" name="registration_id"  hidden>
        <center><h6>Are You Sure to Remove This Data?</h6></center>
        <center><h6><b>Please Enter Admin Username And Password</b></h6></center>
        <div class="form-group col-sm-12">
            <label for="exampleInputEmail1">Username</label>
            <input type="text" class="form-control float-right" name="delete_username">
        </div>
        <div class="form-group col-sm-12">
            <label for="exampleInputEmail1">Password</label>
            <input type="password" class="form-control float-right" name="delete_password">
        </div>
    </form> 
</div>
<div class="modal-footer justify-content-between p-1">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-danger text-white col-3 offset-6 text-center" onclick="set_system_cardinal_operation('You want to delete this data?', 'update', 'delete_form', 'update_delete.php', 'delete_result', 'none', 'none', '_div_add_survey', 'confirmation_create_success', 'none')">Delete</button>
</div>

<datalist id="no_selection">
    <option value="02_No">02_No</option>
</datalist>