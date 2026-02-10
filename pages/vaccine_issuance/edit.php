<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $id = $_GET['primary_id'];

    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_issuance WHERE id = '$id' AND is_archive = 0");
    foreach($SelectTable as $value){
        $vaccine_id = $value["vaccine_id"];
        $vaccinee_id = $value["vaccinee_id"];
        $issued_type = $value["issued_type"] ?? '';
        $issued_date = $value["issued_date"];
        $quantity = $value["quantity"];
        $remarks = $value["remarks"];
        
        // Select2 data
        $select2vaccine = $systemcore->SelectCustomize("SELECT id, name FROM vaccines WHERE is_archive = 0 ORDER BY name ASC");
        $select2vaccinee = $systemcore->SelectCustomize("SELECT id, CONCAT(firstname, ' ', lastname) AS fullname FROM vaccine_registration");
        $select2facility = $systemcore->SelectCustomize("SELECT id, facility_name FROM system_facilities WHERE status = 'ACTIVE' ORDER BY facility_name ASC");
    }

    $types = ["Used", "Expire", "Damage", "Transfer", "Return"]; 
?>
<div class="modal-header">
    <h5 class="modal-title">
        Edit Issuance
    </h5>
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

<form id="update_form" enctype="multipart/form-data">
    <input type="text" class="form-control float-right" value="<?php echo $id;?>" id="primary_key" name="primary_key" hidden>
    <input type="text" class="form-control float-right" value="<?php echo $issued_type;?>" id="issued_type_hidden" name="issued_type_hidden" hidden>
    <div class="modal-body">
        <div class="row">
            
            <div class="row col-sm-12">
                <!-- Vaccine -->
                <div class="form-group col-lg-12">
                    <label>Vaccine:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-syringe"></i>
                            </span>
                        </div>
                        <div class="form-control p-0 border-0">
                            <select class="form-control select2" name="vaccine_id" id="vaccine_id" alt="required" style="width: 100%;">
                                <!-- Dynamically populate via PHP or AJAX -->
                                <option value="">SELECT VACCINE</option>
                                <?php
                                    if ($select2vaccine != "none") {
                                        foreach ($select2vaccine as $vaccine) {
                                            $selected = ($vaccine['id'] == $vaccine_id) ? "selected" : "";
                                            echo "<option value='{$vaccine['id']}' {$selected}>{$vaccine['name']}</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        
                    </div>
                </div>

                <!-- Issued Type -->
                <div class="form-group col-lg-12">
                    <label>Issued Type:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-exchange-alt"></i></span>
                        </div>

                        <select id="issued_type_edit" class="form-control" name="issued_type" alt="required">
                            <option value="">Select Type</option>
                            <?php foreach ($types as $type) : ?>
                                <option value="<?= $type ?>" <?= ($type === $issued_type) ? "selected" : "" ?>><?= $type ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- Facility -->
                <div class="form-group col-lg-12" id="issued_to_group_edit" style="display: none;">
                    <label>Issued to:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-hospital"></i>
                            </span>
                        </div>
                        <div class="form-control p-0 border-0">
                            <select class="form-control select2" name="issued_to" id="issued_to_edit" style="width: 100%;" alt="required" require>
                                <!-- <option value="">SELECT AN OPTION</option> -->
                                <!-- Populate dynamically -->

                                <option value="0">SELECT FACILITY</option>
                                <?php
                                    if ($select2facility != "none") {
                                        foreach ($select2facility as $facility) {
                                            echo "<option value='{$facility['id']}'>{$facility['facility_name']}</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Vaccinee -->
                <div class="form-group col-lg-12" id="vaccinee_group_edit" style="display: none;">
                    <label>Vaccinee:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                        </div>
                        <div class="form-control p-0 border-0">
                            <select class="form-control select2" name="vaccinee_id" id="vaccinee_id_edit" style="width: 100%;" alt="required" require>
                                <!-- <option value="">SELECT AN OPTION</option> -->
                                <!-- Populate dynamically -->
                                <option value="0">SELECT VACCINEE</option>
                                <?php
                                    if ($select2vaccinee != "none") {
                                        foreach ($select2vaccinee as $vaccinee) {
                                            $selected = ($vaccinee['id'] == $vaccinee_id) ? "selected" : "";
                                            echo "<option value='{$vaccinee['id']}' {$selected}>{$vaccinee['fullname']}</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Quantity -->
                <div class="form-group col-lg-12">
                    <label>Quantity:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-cubes"></i></span>
                        </div>
                        <input type="number" min="1" class="form-control" value="<?php echo $quantity;?>" name="quantity" placeholder="Enter Quantity" alt="required" require>
                    </div>
                </div>

                <!-- Issued Date -->
                <div class="form-group col-lg-12">
                    <label>Issued Date:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="date" class="form-control" value="<?php echo $issued_date;?>" name="issued_date" alt="required" require>
                    </div>
                </div>


                <!-- Remarks -->
                <div class="form-group col-lg-12">
                    <label>Remarks:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-comment-dots"></i></span>
                        </div>
                        <textarea class="form-control" name="remarks" rows="3" placeholder="Enter remarks (optional)"><?php echo $remarks; ?></textarea>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form> 
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" onclick="set_system_cardinal_operation('You want to Update this Inventory??', 'update', 'update_form', 'update_vaccine_trans_iss.php', 'vaccine_issuance_table', 'vaccine_issuance', '#tbl_vaccines_issuance', 'required_div', 'confirmation_update_success', 'none')" class="btn btn-primary">Update</button>
</div>