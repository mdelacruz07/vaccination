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
    // $query_vaccine = "SELECT vi.id AS id, v.name AS name, vi.batch_no FROM vaccine_inventory AS vi INNER JOIN vaccines AS v ON vi.vaccine_id = v.id WHERE v.is_archive = 0 ORDER BY v.name ASC";
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
              <h2 class="card-title col-lg-10" style="padding-top:10px; "><b>Vaccine Received</b></h2>

              <button type="button" class="btn btn-block btn-outline-secondary col-lg-2" data-toggle="modal" data-target="#create_vaccine_receive">Receive New Vaccine</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="vaccine_receive_table">
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
            <div class="modal-content" id="veiw_result_update">
                
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="view_vaccine_inv">
        <div class="modal-dialog modal-md">
            <div class="modal-content" id="veiw_result_view"></div>
        </div>
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="create_vaccine_receive">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Receive New Vaccines</h5>
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

               <form id="create_transaction_form" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row col-sm-12">

                            <!-- Transaction Type -->
                            <!-- <div class="form-group col-lg-12">
                                <label>Transaction Type:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-exchange-alt"></i></span>
                                    </div>
                                    <select class="form-control" name="transaction_type" alt="required">
                                        <option value="">Select Type</option>
                                        <option value="Received">Received</option>
                                        <option value="Issued">Issued</option>
                                        <option value="Returned">Returned</option>
                                        <option value="Spoiled">Spoiled</option>
                                        <option value="Expired">Expired</option>
                                    </select>
                                </div>
                            </div> -->

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
                                        <select class="form-control select2" name="supplier_id" id="supplier_id" style="width: 100%;" alt="required" require>
                                            <!-- <option value="">SELECT AN OPTION</option> -->
                                            <!-- Populate dynamically -->

                                            <option value="0">SELECT SUPPLIER</option>
                                            <?php
                                                if ($select2supplier != "none") {
                                                    foreach ($select2supplier as $supplier) {
                                                        echo "<option value='{$supplier['id']}'>{$supplier['name']}</option>";
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

                            <!-- Transaction Date -->
                            <!-- <div class="form-group col-lg-6">
                                <label>Transaction Date:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div>
                                    <input type="date" class="form-control" name="transaction_date" alt="required">
                                </div>
                            </div> -->

                            <!-- Performed By -->
                            <!-- <div class="form-group col-lg-12">
                                <label>Performed By:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="performed_by" placeholder="Who performed the transaction?" alt="required">
                                </div>
                            </div> -->

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
                    <button type="submit" onclick="set_system_cardinal_operation('You want to Add this Transaction?', 'create', 'create_transaction_form', 'create_vaccine_trans.php', 'vaccine_receive_table', 'vaccine_receive', '#tbl_vaccines_trans', 'required_div', 'confirmation_create_success', 'create_vaccine_receive')" class="btn btn-primary">Submit</button>                           
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
        // setting up the tables
        show_table("vaccine_receive_table", "vaccine_receive", "#tbl_vaccines_receive");

        $(document).on('change', '.delete-checkbox-vaccines-inv', function() {
            // Check if at least one checkbox is ticked
            const anyChecked = $('.delete-checkbox-vaccines-inv:checked').length > 0;
            
            // Enable or disable the button
            $('#btn-delete-selected-vaccines-inv').prop('disabled', !anyChecked);
        });
        
        $('#vaccine_id').select2({
            placeholder: 'SELECT A VACCINE',
            width: '100%',
            dropdownParent: $('#create_vaccine_receive') // if inside modal
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

