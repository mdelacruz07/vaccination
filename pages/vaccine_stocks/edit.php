<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $id = $_GET['primary_id'];

    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_receive WHERE id = '$id' AND is_archive = 0");
    foreach($SelectTable as $value){
        $vaccine_id = $value["vaccine_id"];
        $supplier_id = $value["supplier_id"];
        $facility_id = $value["facility_id"];
        $quantity = $value["quantity"];
        $remarks = $value["remarks"];
        
        // Select2 data
        $select2vaccine = $systemcore->SelectCustomize("SELECT id, name FROM vaccines WHERE is_archive = 0 ORDER BY name ASC");
        $select2supplier = $systemcore->SelectCustomize("SELECT id, name FROM vaccine_supplier WHERE is_archive = 0 ORDER BY name ASC");
        $select2facility = $systemcore->SelectCustomize("SELECT id, facility_name as name FROM system_facilities WHERE status = 'ACTIVE' ORDER BY facility_name ASC");
    }
?>
<div class="modal-header">
    <h5 class="modal-title">
        Edit Vaccine
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
    <input type="text" class="form-control float-right" value="<?php echo $id;?>" id="primary_key" name="primary_key" hidden >
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

                <!-- Supplier -->
                <div class="form-group col-lg-12">
                    <label>Supplier:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-truck"></i>
                            </span>
                        </div>
                        <div class="form-control p-0 border-0">
                            <select class="form-control select2" name="supplier_id" id="supplier_id" style="width: 100%;" alt="required">
                                <!-- Populate dynamically -->

                                <option value="0">SELECT SUPPLIER</option>
                                <?php
                                    if ($select2supplier != "none") {
                                        foreach ($select2supplier as $supplier) {
                                            $selected = ($supplier['id'] == $supplier_id) ? "selected" : "";
                                            echo "<option value='{$supplier['id']}' {$selected}>{$supplier['name']}</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>


                <!-- Facility -->
                <div class="form-group col-lg-12">
                    <label>Facility:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-truck"></i>
                            </span>
                        </div>
                        <div class="form-control p-0 border-0">
                            <select class="form-control select2" name="facility_id" id="facility_id" style="width: 100%;" alt="required" require>
                                <!-- Populate dynamically -->

                                <option value="0">SELECT FACILITY</option>
                                <?php
                                    if ($select2facility != "none") {
                                        foreach ($select2facility as $facility) {
                                            $selected = ($facility['id'] == $facility_id) ? "selected" : "";
                                            echo "<option value='{$facility['id']}' {$selected}>{$facility['name']}</option>";
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

                <!-- Remarks -->
                <div class="form-group col-lg-12">
                    <label>Remarks:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-comment-alt"></i>
                            </span>
                        </div>
                        <textarea class="form-control" name="remarks" rows="3" placeholder="Additional notes..."><?php echo $remarks;?></textarea>
                    </div>
                </div>
            </div>
        </div>

    </div>
</form> 
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" onclick="set_system_cardinal_operation('You want to Update this Inventory??', 'update', 'update_form', 'update_vaccine_trans_rec.php', 'vaccine_receive_table', 'vaccine_receive', '#tbl_vaccines_receive', 'required_div', 'confirmation_update_success', 'none')" class="btn btn-primary">Update</button>
</div>

