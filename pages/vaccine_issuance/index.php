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
    $query_vaccine = "SELECT id, name FROM vaccines WHERE is_archive = 0 ORDER BY name ASC";
    $select2vaccine = $systemcore->SelectCustomize($query_vaccine);

    // Supplier Dropdown
    $query_supplier = "SELECT id, name FROM vaccine_supplier WHERE is_archive = 0 ORDER BY name ASC";
    $select2supplier = $systemcore->SelectCustomize($query_supplier);

    // Facility Dropdown
    $query_facility = "SELECT id, facility_name FROM system_facilities WHERE status = 'ACTIVE' ORDER BY facility_name ASC";
    $select2facility = $systemcore->SelectCustomize($query_facility);

    // Vaccinee Dropdown
    $query_vaccinee = "SELECT id, CONCAT(firstname, ' ', lastname) AS full_name FROM vaccine_registration";
    $select2vaccinee = $systemcore->SelectCustomize($query_vaccinee);

    $id = $_GET['primary_id'] ?? null;

    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_issuance WHERE id = '$id'");
    foreach($SelectTable as $value){
        $vaccine_id = $value["vaccine_id"];
        $issued_to = $value["issued_to"];
        $issued_type = $value["issued_type"];
        $issued_date = $value["issued_date"];
        $vaccinee = $value["vaccinee"];
        $quantity = $value["quantity"];
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
              <h2 class="card-title col-lg-10" style="padding-top:10px; "><b>Vaccine Issuance</b></h2>

              <button type="button" class="btn btn-block btn-outline-secondary col-lg-2" data-toggle="modal" data-target="#create_vaccine_issuance">Issued Vaccine</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="vaccine_issuance_table">
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
        <div class="modal-dialog modal-md">
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

    <div class="modal fade" id="create_vaccine_issuance">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Issued New Vaccines</h5>
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

               <form id="create_issued_form" enctype="multipart/form-data">
                    <div class="modal-body">
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
                                        <select class="form-control select2" name="vaccine_id" id="vaccine_id" alt="required" style="width: 100%;" require>
                                            <!-- Dynamically populate via PHP or AJAX -->
                                            <option value="">SELECT VACCINE</option>
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

                            <!-- Issued Type -->
                            <div class="form-group col-lg-12">
                                <label>Issued Type:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-exchange-alt"></i></span>
                                    </div>
                                    <select id="issued_type" class="form-control" name="issued_type" alt="required">
                                        <option value="">Select Type</option>
                                        <option value="Used">Used</option>
                                        <option value="Expire">Expire</option>
                                        <option value="Damage">Damage</option>
                                        <option value="Transfer">Transfer</option>
                                        <option value="Return">Return</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Facility -->
                            <div class="form-group col-lg-12" id="issued_to_group">
                                <label>Issued to:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-hospital"></i>
                                        </span>
                                    </div>
                                    <div class="form-control p-0 border-0">
                                        <select class="form-control select2" name="issued_to" id="issued_to" style="width: 100%;" alt="required" require>
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
                            <div class="form-group col-lg-12" id="vaccinee_group">
                                <label>Vaccinee:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <div class="form-control p-0 border-0">
                                        <select class="form-control select2" name="vaccinee_id" id="vaccinee_id" style="width: 100%;" alt="required" require>
                                            <!-- <option value="">SELECT AN OPTION</option> -->
                                            <!-- Populate dynamically -->
                                            <option value="0">SELECT VACCINEE</option>
                                            <?php
                                                if ($select2vaccinee != "none") {
                                                    foreach ($select2vaccinee as $vaccinee) {
                                                        echo "<option value='{$vaccinee['id']}'>{$vaccinee['full_name']}</option>";
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
                                    <input type="number" min="1" class="form-control" name="quantity" placeholder="Enter Quantity" alt="required" require>
                                </div>
                            </div>

                            <!-- Issued Date -->
                            <div class="form-group col-lg-12">
                                <label>Issued Date:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="date" class="form-control" name="issued_date" alt="required" require>
                                </div>
                            </div>

                            <!-- Remarks -->
                            <div class="form-group col-lg-12">
                                <label>Remarks:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-comment-dots"></i></span>
                                    </div>
                                    <textarea class="form-control" name="remarks" rows="3" placeholder="Enter remarks (optional)"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" onclick="set_system_cardinal_operation('You want to issued vaccine?', 'create', 'create_issued_form', 'create_vaccine_issue.php', 'vaccine_issuance_table', 'vaccine_issuance', '#tbl_vaccines_issuance', 'required_div', 'confirmation_create_success', 'create_vaccine_issuance')" class="btn btn-primary">Submit</button>                           
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
        $(document).ready(function() {
            // Hide both by default
            $('#issued_to_group').hide();
            $('#vaccinee_group').hide();

            $('#issued_type').on('change', function () {
                const type = $(this).val();

                // Hide both first
                $('#issued_to_group').hide();
                $('#vaccinee_group').hide();

                if (type === 'Transfer') {
                    $('#issued_to_group').slideDown();
                }

                if (type === 'Used') {
                    $('#vaccinee_group').slideDown();
                }
            });
        });

        // setting up the tables
        show_table("vaccine_issuance_table", "vaccine_issuance", "#tbl_vaccines_issuance");

        $(document).on('change', '.delete-checkbox-vaccine-issuance', function() {
            // Check if at least one checkbox is ticked
            const anyChecked = $('.delete-checkbox-vaccine-issuance:checked').length > 0;
            
            // Enable or disable the button
            $('#btn-delete-selected-vaccines-issuance').prop('disabled', !anyChecked);
        });
        
        $('#vaccine_id').select2({
            placeholder: 'SELECT A VACCINE',
            width: '100%',
            dropdownParent: $('#create_vaccine_issuance') // if inside modal
        });

        // Optional: re-trigger Select2 to display selected text properly (useful if you dynamically load form)
        $('#vaccine_id').trigger('change.select2');

        $('.form-control[type="number"]').on('input', function () {
            this.value = this.value.replace(/\D/g, '');
        });

    </script>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>

