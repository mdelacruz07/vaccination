<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $id = $_GET['primary_id'];

    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_inventory WHERE id = '$id'");
    foreach($SelectTable as $value){
        $vaccine_id = $value["vaccine_id"];
        $batch_no = $value["batch_no"];
        $manufacturer = $value["manufacturer"];
        $supplier_id = $value["supplier_id"];
        $quantity_received = $value["quantity_received"];
        $quantity_available = $value["quantity_available"];
        $unit = $value["unit"];
        $storage_location = $value["storage_location"];
        $temperature_range = $value["temperature_range"];
        $expiry_date = $value["expiry_date"];
        $date_received = $value["date_received"];
        $received_by = $value["received_by"];
        $status = $value["status"];
        $remarks = $value["remarks"];
        $created_by = $value["created_by"];

        // Select2 data
        $select2vaccine = $systemcore->SelectCustomize("SELECT id, name FROM vaccines WHERE is_archive = 0 ORDER BY name ASC");
        $select2supplier = $systemcore->SelectCustomize("SELECT id, name FROM vaccine_supplier WHERE is_archive = 0 ORDER BY name ASC");
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

                <!-- Batch Number -->
                <div class="form-group col-lg-6">
                    <label>Batch Number:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-barcode"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $batch_no;?>" name="batch_no" alt="required">
                    </div>
                </div>

                <!-- Manufacturer -->
                <div class="form-group col-lg-6">
                    <label>Manufacturer:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-industry"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $manufacturer;?>" name="manufacturer" alt="required">
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

                                <option value="">SELECT SUPPLIER</option>
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

                <!-- Quantity Received -->
                <div class="form-group col-lg-6">
                    <label>Quantity Received:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-boxes"></i>
                            </span>
                        </div>
                        <input type="number" min="1" class="form-control" value="<?php echo $quantity_received;?>" name="quantity_received" alt="required">
                    </div>
                </div>

                <!-- Quantity Available -->
                <div class="form-group col-lg-6">
                    <label>Quantity Available:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-pills"></i>
                            </span>
                        </div>
                        <input type="number" min="0" class="form-control" value="<?php echo $quantity_available;?>" name="quantity_available" alt="required">
                    </div>
                </div>

                <!-- Unit -->
                <div class="form-group col-lg-6">
                    <label>Unit:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-weight-hanging"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $unit;?>" name="unit" placeholder="e.g., doses, ml, grams" alt="required">
                    </div>
                </div>

                <!-- Temperature Range -->
                <div class="form-group col-lg-6">
                    <label>Temperature Range:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-thermometer-half"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $temperature_range;?>" name="temperature_range" placeholder="e.g., 2°C–8°C" alt="required">
                    </div>
                </div>

                <!-- Expiry Date -->
                <div class="form-group col-lg-6">
                    <label>Expiry Date:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-calendar-alt"></i>
                            </span>
                        </div>
                        <input type="date" class="form-control" value="<?php echo $expiry_date;?>" name="expiry_date" alt="required">
                    </div>
                </div>

                <!-- Temperature Range -->
                <div class="form-group col-lg-6">
                    <label>Received By:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-thermometer-half"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" value="<?php echo $received_by;?>" name="received_by" placeholder="John Doe" alt="required">
                    </div>
                </div>

                <!-- Date Received -->
                <div class="form-group col-lg-6">
                    <label>Date Received:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-calendar-day"></i>
                            </span>
                        </div>
                        <input type="date" class="form-control" value="<?php echo $date_received;?>" name="date_received" alt="required">
                    </div>
                </div>

                <!-- Status -->
                <div class="form-group col-lg-6">
                    <label>Status:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-clipboard-check"></i>
                            </span>
                        </div>
                        <select class="form-control" name="status" alt="required">
                            <option value="Available"   <?= ($status == 'Available')   ? 'selected' : '' ?>>Available</option>
                            <option value="Used"        <?= ($status == 'Used')        ? 'selected' : '' ?>>Used</option>
                            <option value="Expired"     <?= ($status == 'Expired')     ? 'selected' : '' ?>>Expired</option>
                            <option value="Damaged"     <?= ($status == 'Damaged')     ? 'selected' : '' ?>>Damaged</option>
                            <option value="Quarantined" <?= ($status == 'Quarantined') ? 'selected' : '' ?>>Quarantined</option>
                        </select>
                    </div>
                </div>

                <!-- Storage Location -->
                <div class="form-group col-lg-12">
                    <label>Storage Location:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-warehouse"></i>
                            </span>
                        </div>
                        <textarea class="form-control" name="storage_location" rows="3" placeholder="e.g., Cold Room A" alt="required"><?php echo $storage_location;?></textarea>
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
    <button type="submit" onclick="set_system_cardinal_operation('You want to Update this Inventory??', 'update', 'update_form', 'update_vaccine_inv.php', 'update_result', 'vaccine_inventory', '#tbl_vaccines_inv', 'required_div', 'confirmation_update_success', 'none')" class="btn btn-primary">Update</button>                           
</div>

