<!DOCTYPE html>
<html>
<?php
    $system_page_name = $_GET["page_name"];
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $System_Sessioning = $systemcore->System_Sessioning("session");

    include '../inc/header.php';
    // include '../inc/navbar.php';

    // Vaccine Dropdown
    $query_vaccine = "SELECT v.id, v.name,
        (IFNULL(SUM(DISTINCT vr.total_in), 0) - IFNULL(SUM(DISTINCT vi.total_out), 0)) AS balance
        FROM vaccines v
        LEFT JOIN (SELECT vaccine_id, SUM(quantity) AS total_in FROM vaccine_receive WHERE is_archive = 0 GROUP BY vaccine_id) vr ON vr.vaccine_id = v.id
        LEFT JOIN (SELECT vaccine_id, SUM(quantity) AS total_out FROM vaccine_issuance WHERE is_archive = 0 GROUP BY vaccine_id) vi ON vi.vaccine_id = v.id
        WHERE v.is_archive = 0
        GROUP BY v.id
        HAVING balance > 0
        ORDER BY v.name ASC
    ";
    $select2vaccine = $systemcore->SelectCustomize($query_vaccine);

    // Supplier Dropdown
    $query_supplier = "SELECT id, name FROM vaccine_supplier WHERE is_archive = 0 ORDER BY name ASC";
    $select2supplier = $systemcore->SelectCustomize($query_supplier);

    // Facility Dropdown
    $query_facility = "SELECT id, facility_name FROM system_facilities WHERE status = 'ACTIVE' ORDER BY facility_name ASC";
    $select2facility = $systemcore->SelectCustomize($query_facility);

    $id = $_GET['primary_id'] ?? null;

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
    }
?>
<body class="pages_body">
  <!-- Content Wrapper. Contains page content -->
  <!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $system_page_name; ?></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h2 class="card-title col-lg-10" style="padding-top:10px; "><b>Vaccinees</b></h2>

              <button type="button" class="btn btn-block btn-outline-secondary col-lg-2" data-toggle="modal" data-target="#create_vaccine_patient">New Patient</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="patient_table">
                    <!-- table will be showed here after the script executed!! -->
                </div>
                <form id="select_to_delete" hidden>
                    <h1>Deleted ID's</h1>
                    <input type="text" name="selected_id" id="select_to_delete_input" value="none">
                </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  <!-- </div> -->
  <!-- /.content-wrapper -->

    <div class="modal fade" id="update">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" id="view_result_update">
                
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="view_vaccine_inv">
        <div class="modal-dialog modal-md">
            <div class="modal-content" id="view_result_view"></div>
        </div>
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="create_vaccine_patient">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Register New Patient</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="alert alert-danger custom_required alert-dismissible fade show" id="required_div" role="alert">
                    <strong>ERROR!</strong> Please Fill in the required Inputs below!
                    <button type="button" class="close" onclick="turn_off_required('required_div')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> 

               <form id="create_patient" enctype="multipart/form-data">
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
                                                    <option value="Health Care Workers">Health Care Workers</option>
                                                    <option value="Outbound OFWs">Outbound OFWs</option>
                                                    <option value="Family Members of Healthcare Workers">Family Members of Healthcare Workers</option>
                                                    <option value="Senior Citizens">Senior Citizens</option>
                                                    <option value="Adult with Comorbidity">Adult with Comorbidity</option>
                                                    <option value="Pregnant women">Pregnant women</option>
                                                    <option value="Frontline Personnel in Essential Sector">Frontline Personnel in Essential Sector</option>
                                                    <option value="Poor Population">Poor Population</option>
                                                    <option value="Teachers and Social Workers">Teachers and Social Workers</option>
                                                    <option value="Other Government Workers">Other Government Workers</option>
                                                    <option value="Other Essential Workers">Other Essential Workers</option>
                                                    <option value="Socio-demographic Groups">Socio-demographic Groups</option>
                                                    <option value="Overseas Filipino Workers">Overseas Filipino Workers</option>
                                                    <option value="Other Remaing Workforce">Other Remaing Workforce</option>
                                                    <option value="Rest of the Population">Rest of the Population</option>
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
                                            <input type="text" class="form-control" name="firstname" placeholder="John" alt="required" required>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <!-- Middlename -->
                                        <label>Middlename</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="middlename" placeholder="Doe" alt="required">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <!-- Lastname -->
                                        <label>Lastname <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="lastname" placeholder="Dalton" alt="required" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between w-100 mb-3 px-3 address-form">
                                    <div class="col-4">
                                        <!-- Province -->
                                        <label>Province <span style="color:red;">*</span></label>
                                        <select class="form-control province" name="province" style="width: 100%;" alt="required" required>
                                            <option value="">Select Province</option>
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <!-- City/Municipality -->
                                        <label>City/Municipality <span style="color:red;">*</span></label>
                                        <select class="form-control city" name="city" style="width: 100%;" alt="required" required disabled>
                                            <option value="">Select City/Municipality</option>
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <!-- Barangay -->
                                        <label>Barangay <span style="color:red;">*</span></label>
                                        <select class="form-control barangay" name="barangay" style="width: 100%;" alt="required" required disabled>
                                            <option value="">Select Barangay</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center px-3">
                                    <div class="col-4">
                                        <!-- Indigenous Member -->
                                        <label>Indigenous Member</label>
                                        <select class="form-control" id="indigenous" name="indigenous" style="width: 100%;">
                                            <option value="Yes">Yes</option>
                                            <option value="No" selected>No</option>
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <!-- Person With Disability-->
                                        <label>PWD</label>
                                        <select class="form-control" id="pwd" name="pwd" style="width: 100%;">
                                            <option value="Yes">Yes</option>
                                            <option value="No" selected>No</option>
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
                                            <input type="text" class="form-control" name="guardian_name">
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <!-- Pedia Comorbidity -->
                                        <label>Pedia Comorbidity</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="pedia_comorbidity">
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
                                        <input type="date" class="form-control" name="first_dose_date" alt="required" required>
                                    </div>

                                    <!-- Vaccine name -->
                                    <div class="form-group">
                                        <label>Vaccine name <span style="color:red;">*</span></label>
                                        <div class="input-group">
                                            <div class="form-control p-0 border-0">
                                                <select class="form-control select2 vaccine_id" name="first_vaccine_id" alt="required" style="width: 100%;" required>
                                                    <option value="0">Select Vaccine</option>
                                                    <?php
                                                        if ($select2vaccine != "none") {
                                                            foreach ($select2vaccine as $vaccine) {
                                                                echo "<option value='{$vaccine['id']}'>{$vaccine['name']}</option>";
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
                                                <input type="text" class="form-control" name="first_batch_no">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <!-- Lot Number -->
                                            <div class="form-group">
                                                <label>Lot Number</label>
                                                <input type="text" class="form-control" name="first_lot_no">
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
                                            <input type="date" class="form-control" name="second_dose_date">
                                        </div>
                                    </div>

                                    <!-- Vaccine name -->
                                    <div class="form-group">
                                        <label>Vaccine name</label>
                                        <div class="input-group">
                                            <div class="form-control p-0 border-0">
                                                <select class="form-control select2 vaccine_id" name="second_vaccine_id" style="width: 100%;" disabled>
                                                    <option value="0">Select Vaccine</option>
                                                    <?php
                                                        if ($select2vaccine != "none") {
                                                            foreach ($select2vaccine as $vaccine) {
                                                                echo "<option value='{$vaccine['id']}'>{$vaccine['name']}</option>";
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
                                                    <input type="text" class="form-control" name="second_batch_no" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <!-- Lot Number -->
                                            <div class="form-group">
                                                <label>Lot Number</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="second_lot_no" disabled>
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
                                        <input type="text" class="form-control" name="vaccinator_name" alt="required" required>
                                    </div>
                                </div>

                                <!-- First Dose -->
                                <div class="col-3">
                                    <label>1st Dose?</label>
                                    <div class="input-group">
                                        <select class="form-control" name="first_dose" style="width: 100%;">
                                            <option value="Yes" selected>Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Second Dose -->
                                <div class="col-3">
                                    <label>2nd Dose?</label>
                                    <div class="input-group">
                                        <select class="form-control" name="second_dose" style="width: 100%;" disabled>
                                            <option value="Yes">Yes</option>
                                            <option value="No" selected>No</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Booster Dose -->
                                <div class="col-3">
                                    <label>Booster Dose?</label>
                                    <div class="input-group">
                                        <select class="form-control" name="booster" style="width: 100%;" disabled>
                                            <option value="Yes">Yes</option>
                                            <option value="No" selected>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>                        
                    </div>
                </form>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" onclick="set_system_cardinal_operation('You want to Add this Transaction?', 'create', 'create_patient', 'create_patient.php', 'patient_table', 'patient', '#tbl_patient', 'required_div', 'confirmation_create_success', 'create_vaccine_patient')" class="btn btn-primary">Submit</button>                           
                    <!-- (des, operation, form_id, form_file_name, table_div_id, table_file_name, table_id, required_notice, modal_open, modal_close) -->
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal -->
    <?php 
        include '../inc/confirmation_alerts.php';
        include '../inc/footer.php';
    ?>
    <script>
        // =================================================================

        let data;

        fetch("../../provinces.json")
        .then(res => res.json())
        .then(json => {
            data = json;
            initAddressForms();
        });

        function initAddressForms() {
            document.querySelectorAll(".address-form").forEach(form => {

                const provinceSelect = form.querySelector(".province");
                const citySelect = form.querySelector(".city");
                const brgySelect = form.querySelector(".barangay");

                const selectedProvince = provinceSelect.dataset.selected;
                const selectedCity = citySelect.dataset.selected;
                const selectedBrgy = brgySelect.dataset.selected;

                loadProvinces(provinceSelect, selectedProvince);

                if (selectedProvince) {
                    loadCities(provinceSelect, citySelect, selectedProvince, selectedCity);
                }

                if (selectedProvince && selectedCity) {
                    loadBarangays(provinceSelect, citySelect, brgySelect, selectedBrgy);
                }

                provinceSelect.addEventListener("change", function () {
                    loadCities(provinceSelect, citySelect, this.value);
                    brgySelect.innerHTML = `<option value="">Select Barangay</option>`;
                    brgySelect.disabled = true;
                });

                citySelect.addEventListener("change", function () {
                    loadBarangays(provinceSelect, citySelect, brgySelect);
                });
            });
        }

        function loadProvinces(selectEl, selected=null){
            selectEl.innerHTML = `<option value="">Select Province</option>`;

            Object.keys(data)
            .sort((a,b)=>a.localeCompare(b))
            .forEach(province=>{
                selectEl.innerHTML += `
                    <option value="${province}" ${province===selected?'selected':''}>
                        ${province}
                    </option>`;
            });
        }

        function loadCities(provinceSelect, citySelect, province, selected=null){
            citySelect.innerHTML = `<option value="">Select City/Municipality</option>`;

            if(!province){
                citySelect.disabled=true;
                return;
            }

            let cities = data[province].municipalities;

            Object.keys(cities)
            .sort((a,b)=>a.localeCompare(b))
            .forEach(city=>{
                citySelect.innerHTML += `
                    <option value="${city}" ${city===selected?'selected':''}>
                        ${city}
                    </option>`;
            });

            citySelect.disabled=false;
        }

        function loadBarangays(provinceSelect, citySelect, brgySelect, selected=null){
            let province = provinceSelect.value;
            let city = citySelect.value;

            brgySelect.innerHTML = `<option value="">Select Barangay</option>`;

            if(!city){
                brgySelect.disabled=true;
                return;
            }

            let barangays = data[province].municipalities[city].barangays;

            barangays
            .sort((a,b)=>a.localeCompare(b))
            .forEach(brgy=>{
                brgySelect.innerHTML += `
                    <option value="${brgy}" ${brgy===selected?'selected':''}>
                        ${brgy}
                    </option>`;
            });

            brgySelect.disabled=false;
        }

        // =================================================================

        // setting up the tables
        show_table("patient_table", "vaccine_patient", "#tbl_vaccines_patient");

        $(document).on('change', '.delete-checkbox-vaccine-receive', function() {
            // Check if at least one checkbox is ticked
            const anyChecked = $('.delete-checkbox-vaccine-receive:checked').length > 0;
            
            // Enable or disable the button
            $('#btn-delete-selected-vaccines-receive').prop('disabled', !anyChecked);
        });
        
        $('.vaccine_id').select2({
            placeholder: 'SELECT A VACCINE',
            width: '100%',
            dropdownParent: $('#create_vaccine_patient') // if inside modal
        });

        // Optional: re-trigger Select2 to display selected text properly (useful if you dynamically load form)
        $('.vaccine_id').trigger('change.select2');

        $('.form-control[type="number"]').on('input', function () {
            this.value = this.value.replace(/\D/g, '');
        });
    </script>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>

