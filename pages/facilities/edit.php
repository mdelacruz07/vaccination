    <?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $id = $_GET['primary_id'];

    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM system_facilities WHERE id = '$id'");
    foreach($SelectTable as $value){
        $id = $value['id'];
        $facility_name = $value['facility_name'];
        $location = $value['location'];
        $iframe_location = $value['iframe_location'];
        $status = $value['status'];
    }

    ?>
<div class="modal-header">
    <h5 class="modal-title">Edit Facility</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>

<!-- This Alert is needed -->
<div class="alert alert-danger custom_required alert-dismissible fade show" id="required_div" role="alert">
    <strong>ERROR!</strong> Please Fill in the required Inputs below!
    <button type="button" class="close" onclick="turn_off_required('required_div')" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div> 

<div id="update_result">

</div>

<form id ="update_form" enctype="multipart/form-data">
    <input type="text" class="form-control float-right" value="<?php echo $id;?>" id="primary_key" name="primary_key" hidden >
    <div class="modal-body" >
        <div class="row">
            
            <div class="row col-sm-12">

                <div class="form-group col-lg-12">
                    <label>Facility Name:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="far fa-address-card"></i>
                        </span>
                        </div>
                        <input id="facility_name" type="text" class="form-control float-right" name="facility_name" value="<?php echo $facility_name;?>" alt="required"> 
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label>Location:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="far fa-address-card"></i>
                        </span>
                        </div>
                        <input id="location" type="text" class="form-control float-right" name="location" value="<?php echo $location;?>" alt="required">
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label>Google Map Location:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="far fa-address-card"></i>
                        </span>
                        </div>
                        <input id="iframe_location" type="text" class="form-control float-right" name="iframe_location" value="<?php echo $iframe_location;?>">
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label>Status:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fas fa-venus-mars"></i>
                        </span>
                        </div>
                        <select id="status" name="status" class="form-control"  alt="required">
                            <option hidden value="<?php echo $status;?>"><?php echo $status;?></option>
                            <option value="ACTIVE">ACTIVE</option>
                            <option value="IN-ACTIVE">IN-ACTIVE</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>

    </div>
    
</form> 
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" onclick="set_system_cardinal_operation('You want to Update this Facility?', 'update', 'update_form', 'update_facility.php', 'update_result', 'none', 'none', 'required_div', 'confirmation_update_success', 'none')" class="btn btn-primary">Update</button>                           
</div>