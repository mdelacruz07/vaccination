<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $id = $_GET['primary_id'];

    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccines WHERE id = '$id'");
    foreach($SelectTable as $value){
        $vaccine_name = $value["name"];
        $type = $value["type"];
        $manufacturer = $value["manufacturer"];
        $dose_per_vial = $value["dose_per_vial"];
        $description = $value["description"];
    }
?>
<div class="modal-header">
    <h5 class="modal-title">Edit Vaccine</h5>
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
                    <label>Vaccine Name:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-address-card"></i>
                            </span>
                        </div>

                        <input type="text" class="form-control float-right" id="vaccine_name" value="<?php echo $vaccine_name;?>" name="vaccine_name" alt="required"> 
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label>Type:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-address-card"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right" id="type" value="<?php echo $type;?>" name="type" alt="required">
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label>Manufacturer:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-address-card"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right" id="manufacturer" value="<?php echo $manufacturer;?>" name="manufacturer">
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label>Dose per Vial:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-address-card"></i>
                            </span>
                        </div>
                        <input type="number" class="form-control float-right" id="dose_per_vial" value="<?php echo $dose_per_vial;?>" name="dose_per_vial">
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label>Description:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-address-card"></i>
                            </span>
                        </div>
                        <textarea class="form-control float-right" name="description" id="description" rows="3"><?php echo $description;?></textarea>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</form> 
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" onclick="set_system_cardinal_operation('You want to Update this Vaccine?', 'update', 'update_form', 'update_vaccine.php', 'update_result', 'vaccines', '#tbl_vaccines', 'required_div', 'confirmation_update_success', 'none')" class="btn btn-primary">Update</button>                           
</div>

