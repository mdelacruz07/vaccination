<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $id = $_GET['primary_id'];

    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_receive WHERE id = '$id' AND is_archive = 0");
    $result = $systemcore->SelectCustomize("SELECT p.*, v1.name AS first_vaccine_name,
        IF(p.second_vaccine_id = 0 OR v2.name IS NULL, 'None', v2.name) AS second_vaccine_name
        FROM patient p
        LEFT JOIN vaccines v1 ON p.first_vaccine_id = v1.id
        LEFT JOIN vaccines v2 ON p.second_vaccine_id = v2.id
        WHERE p.is_archive = 0
        AND p.id = {$id}
        ORDER BY p.id DESC
    ");

    foreach($result as $data){
        $fullname = trim(($data['firstname'] ?? '') . ' ' . ($data['middlename'] ?? '') . ' ' . ($data['lastname'] ?? ''));

        $category = $data['category'] ?? '—';
        $province = $data['province'] ?? '—';
        $city = $data['city'] ?? '—';
        $barangay = $data['barangay'] ?? '—';
        $indigenous = !empty($data['indigenous']) ? 'Yes' : 'No';
        $pwd = !empty($data['pwd']) ? 'Yes' : 'No';
        $guardian = $data['guardian_name'] ?? '—';
        $comorbidity = $data['pedia_comorbidity'] ?? '—';

        $first_vaccine_name = $data['first_vaccine_name'] ?? 'None';
        $first_date = $data['first_dose_date'] != null ? $data['first_dose_date'] : 'None';
        $first_batch = $data['first_batch_no'] != '' ? $data['first_batch_no'] : 'None';
        $first_lot = $data['first_lot_no'] != '' ? $data['first_lot_no'] : 'None';

        $second_vaccine_name = $data['second_vaccine_name'] ?? 'None';
        $second_date = $data['second_dose_date'] != null ? $data['second_dose_date'] : 'None';
        $second_batch = $data['second_batch_no'] != '' ? $data['second_batch_no'] : 'None';
        $second_lot = $data['second_lot_no'] != '' ? $data['second_lot_no'] : 'None';

        $vaccinator = $data['vaccinator_name'] ?? '—';

        $first_dose_status = !empty($data['first_dose']) ? 'Yes' : 'No';
        $second_dose_status = !empty($data['second_dose']) ? 'Yes' : 'No';
        $booster_status = !empty($data['booster']) ? 'Yes' : 'No';
        
        // Select2 data
        $select2vaccine = $systemcore->SelectCustomize("SELECT v.id, v.name,
        (IFNULL(SUM(DISTINCT vr.total_in), 0) - IFNULL(SUM(DISTINCT vi.total_out), 0)) AS balance
        FROM vaccines v
        LEFT JOIN (SELECT vaccine_id, SUM(quantity) AS total_in FROM vaccine_receive WHERE is_archive = 0 GROUP BY vaccine_id) vr ON vr.vaccine_id = v.id
        LEFT JOIN (SELECT vaccine_id, SUM(quantity) AS total_out FROM vaccine_issuance WHERE is_archive = 0 GROUP BY vaccine_id) vi ON vi.vaccine_id = v.id
        WHERE v.is_archive = 0
        GROUP BY v.id
        HAVING balance > 0
        ORDER BY v.name ASC");

        $select2supplier = $systemcore->SelectCustomize("SELECT id, name FROM vaccine_supplier WHERE is_archive = 0 ORDER BY name ASC");
        $select2facility = $systemcore->SelectCustomize("SELECT id, facility_name as name FROM system_facilities WHERE status = 'ACTIVE' ORDER BY facility_name ASC");
    }

?>
<div class="modal-header">
    <h5 class="modal-title">
        Edit Patient
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
    <div class="modal-body p-5">
        <div class="d-block w-100 mb-4">
            <h3 class="text-center mb-0">Profiling</h3>
        </div>
    
        <div class="jumbotron py-3 mb-3">
            <h5 class="mb-0">Personal Information</h5>
        </div>

        <div class="mb-5">
            <div class="d-flex align-items-center justify-content-between w-100 mb-3 px-3">
                <!-- Category -->
                    <div class="col-12 input-group">
                    <label>Category <span style="color:red;">*</span></label>
                    <div class="input-group">
                        <div class="form-control p-0 border-0">
                            <select class="form-control select2" name="category" id="category" alt="required" style="width: 100%;" required>
                                <option value="N/A">Select Category</option>
                                <option value="Health Care Workers" <?= $category=='Health Care Workers'?'selected':'' ?>>Health Care Workers</option>
                                <option value="Outbound OFWs" <?= $category=='Outbound OFWs'?'selected':'' ?>>Outbound OFWs</option>
                                <option value="Family Members of Healthcare Workers" <?= $category=='Family Members of Healthcare Workers'?'selected':'' ?>>Family Members of Healthcare Workers</option>
                                <option value="Senior Citizens" <?= $category=='Senior Citizens'?'selected':'' ?>>Senior Citizens</option>
                                <option value="Adult with Comorbidity" <?= $category=='Adult with Comorbidity'?'selected':'' ?>>Adult with Comorbidity</option>
                                <option value="Pregnant women" <?= $category=='Pregnant women'?'selected':'' ?>>Pregnant women</option>
                                <option value="Frontline Personnel in Essential Sector" <?= $category=='Frontline Personnel in Essential Sector'?'selected':'' ?>>Frontline Personnel in Essential Sector</option>
                                <option value="Poor Population" <?= $category=='Poor Population'?'selected':'' ?>>Poor Population</option>
                                <option value="Teachers and Social Workers" <?= $category=='Teachers and Social Workers'?'selected':'' ?>>Teachers and Social Workers</option>
                                <option value="Other Government Workers" <?= $category=='Other Government Workers'?'selected':'' ?>>Other Government Workers</option>
                                <option value="Other Essential Workers" <?= $category=='Other Essential Workers'?'selected':'' ?>>Other Essential Workers</option>
                                <option value="Socio-demographic Groups" <?= $category=='Socio-demographic Groups'?'selected':'' ?>>Socio-demographic Groups</option>
                                <option value="Overseas Filipino Workers" <?= $category=='Overseas Filipino Workers'?'selected':'' ?>>Overseas Filipino Workers</option>
                                <option value="Other Remaing Workforce" <?= $category=='Other Remaing Workforce'?'selected':'' ?>>Other Remaing Workforce</option>
                                <option value="Rest of the Population" <?= $category=='Rest of the Population'?'selected':'' ?>>Rest of the Population</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between w-100 mb-3 px-3">
                <div class="col-4">
                    <!-- Firstname -->
                    <label>Firstname <span style="color:red;">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="firstname" value="<?= htmlspecialchars($data['firstname']) ?>" required>
                    </div>
                </div>

                <div class="col-4">
                    <!-- Middlename -->
                    <label>Middlename</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="middlename" value="<?= htmlspecialchars($data['middlename']) ?>" alt="required">
                    </div>
                </div>

                <div class="col-4">
                    <!-- Lastname -->
                    <label>Lastname <span style="color:red;">*</span></label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="lastname" value="<?= htmlspecialchars($data['lastname']) ?>" alt="required" required>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between w-100 mb-3 px-3 address-form">
                <div class="col-4">
                    <!-- Province -->
                    <label>Province <span style="color:red;">*</span></label>
                    <select class="form-control province" name="province" style="width: 100%;" alt="required" data-selected="<?= $province; ?>" required>
                        <option value="">Select Province</option>
                    </select>
                </div>

                <div class="col-4">
                    <!-- City/Municipality -->
                    <label>City/Municipality <span style="color:red;">*</span></label>
                    <select class="form-control city" name="city" style="width: 100%;" alt="required" data-selected="<?= $city; ?>" required disabled>
                        <option value="">Select City/Municipality</option>
                    </select>
                </div>

                <div class="col-4">
                    <!-- Barangay -->
                    <label>Barangay <span style="color:red;">*</span></label>
                    <select class="form-control barangay" name="barangay" style="width: 100%;" alt="required" data-selected="<?= $barangay; ?>" required disabled>
                        <option value="">Select Barangay</option>
                    </select>
                </div>
            </div>

            <div class="d-flex align-items-center px-3">
                <div class="col-4">
                    <!-- Indigenous Member -->
                    <label>Indigenous Member</label>
                    <select class="form-control" id="indigenous" name="indigenous" style="width: 100%;">
                        <option value="Yes" <?= $data['indigenous']=='Yes'?'selected':'' ?>>Yes</option>
                        <option value="No" <?= $data['indigenous']=='No'?'selected':'' ?>>No</option>
                    </select>
                </div>

                <div class="col-4">
                    <!-- Person With Disability-->
                    <label>PWD</label>
                    <select class="form-control" id="pwd" name="pwd" style="width: 100%;">
                        <option value="Yes" <?= $data['pwd']=='Yes'?'selected':'' ?>>Yes</option>
                        <option value="No" <?= $data['pwd']=='No'?'selected':'' ?>>No</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="jumbotron py-3 mb-3">
            <h5 class="mb-0">12 - 17 Year Old Additional Information</h5>
        </div>

        <div class="mb-5">
            <div class="d-flex align-items-center px-3">
                <div class="col-4">
                    <!-- Guardian Name -->
                    <label>Guardian Name</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="guardian_name" value="<?= htmlspecialchars($guardian) ?>">
                    </div>
                </div>

                <div class="col-4">
                    <!-- Pedia Comorbidity -->
                    <label>Pedia Comorbidity</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="pedia_comorbidity" value="<?= htmlspecialchars($comorbidity) ?>">
                    </div>
                </div>
            </div>
        </div>


        <div class="jumbotron py-3 mb-3">
            <h5 class="mb-0">Vaccination Details</h5>
        </div>


        <div class="d-flex align-items-center justify-content-between px-3 dose-info">
            <!-- 1st dose information -->
            <div class="col-6">
                <!-- 1st dose -->
                <div class="form-group">
                    <label>Date of Vaccination 1st Dose <span style="color:red;">*</span></label>
                    <input type="date" class="form-control" name="first_dose_date" value="<?= $first_date ?>" required disabled>
                </div>

                <!-- Vaccine name -->
                <div class="form-group">
                    <label>Vaccine name <span style="color:red;">*</span></label>
                    <div class="input-group">
                        <div class="form-control p-0 border-0">
                            <select class="form-control select2 vaccine_id" name="first_vaccine_id" alt="required" style="width: 100%;" required disabled>
                                <option value="0">Select Vaccine</option>
                                <?php
                                    if ($select2vaccine != "none") {
                                        foreach ($select2vaccine as $vaccine) {
                                            $selected = $vaccine['id'] == $data['first_vaccine_id'] ? 'selected' : '';
                                            echo "<option value='{$vaccine['id']}' $selected>{$vaccine['name']}</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-6">
                        <!-- Batch Number -->
                        <div class="form-group">
                            <label>Batch Number</label>
                            <input type="text" class="form-control" name="first_batch_no" value="<?= $first_batch ?>">
                        </div>
                    </div>

                    <div class="col-6">
                        <!-- Lot Number -->
                        <div class="form-group">
                            <label>Lot Number</label>
                            <input type="text" class="form-control" name="first_lot_no" value="<?= $first_lot ?>">
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2nd dose information -->
            <div class="col-6">
                <!-- 2nd dose -->
                <div class="form-group">
                    <label>Date of Vaccination 2nd Dose</label>
                    <div class="input-group">
                        <input type="date" class="form-control" name="second_dose_date" value="<?= $data['second_dose_date'] ?>">
                    </div>
                </div>

                <!-- Vaccine name -->
                <div class="form-group">
                    <label>Vaccine name</label>
                    <div class="input-group">
                        <div class="form-control p-0 border-0">
                            <select class="form-control select2 vaccine_id" name="second_vaccine_id" style="width: 100%;">
                                <option value="0">Select Vaccine</option>
                                <?php
                                    if ($select2vaccine != "none") {
                                        foreach ($select2vaccine as $vaccine) {
                                            $selected = $vaccine['id'] == $data['second_vaccine_id'] ? 'selected' : '';
                                            echo "<option value='{$vaccine['id']}' $selected>{$vaccine['name']}</option>";
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row align-items-center">
                    <div class="col-6">
                        <!-- Batch Number -->
                        <div class="form-group">
                            <label>Batch Number</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="second_batch_no" value="<?= $second_batch ?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                        <!-- Lot Number -->
                        <div class="form-group">
                            <label>Lot Number</label>
                            <div class="input-group">
                                <input type="text" class="form-control" name="second_lot_no" value="<?= $second_lot ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-between px-3">
            <!-- Vaccinator Name -->
            <div class="col-3">
                <label>Vaccinator Name <span style="color:red;">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control" name="vaccinator_name" required value="<?= htmlspecialchars($vaccinator) ?>">

                </div>
            </div>

            <!-- First Dose -->
            <div class="col-3">
                <label>1st Dose?</label>
                <div class="input-group">
                    <select class="form-control" name="first_dose" style="width: 100%;" disabled>
                        <option value="Yes" <?= $data['first_dose']=='Yes'?'selected':'' ?>>Yes</option>
                        <option value="No" <?= $data['first_dose']=='No'?'selected':'' ?>>No</option>
                    </select>
                </div>
            </div>

            <!-- Second Dose -->
            <div class="col-3">
                <label>2nd Dose?</label>
                <div class="input-group">
                    <select class="form-control" name="second_dose" style="width: 100%;">
                        <option value="Yes" <?= $data['second_dose']=='Yes'?'selected':'' ?>>Yes</option>
                        <option value="No" <?= $data['second_dose']=='No'?'selected':'' ?>>No</option>
                    </select>
                </div>
            </div>

            <!-- Booster Dose -->
            <div class="col-3">
                <label>Booster Dose?</label>
                <div class="input-group">
                    <select class="form-control" name="booster" style="width: 100%;">
                        <option value="Yes" <?= $data['booster']=='Yes'?'selected':'' ?>>Yes</option>
                        <option value="No" <?= $data['booster']=='No'?'selected':'' ?>>No</option>
                    </select>
                </div>
            </div>
        </div>                        
    </div>
</form> 
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" onclick="set_system_cardinal_operation('You want to Update this Patient??', 'update', 'update_form', 'update_patient.php', 'patient_table', 'vaccine_patient', '#tbl_vaccines_patient', 'required_div', 'confirmation_update_success', 'none')" class="btn btn-primary">Update</button>
</div>

