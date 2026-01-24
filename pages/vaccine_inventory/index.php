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

        // Select2 data
        // $select2vaccine = $systemcore->SelectCustomize("SELECT id, name FROM vaccines WHERE is_archive = 0 ORDER BY name ASC");
        // $select2supplier = $systemcore->SelectCustomize("SELECT id, name FROM vaccine_supplier WHERE is_archive = 0 ORDER BY name ASC");
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
              <h2 class="card-title col-lg-10" style="padding-top:10px; "><b>List Of Vaccines</b></h2>

              <button type="button" class="btn btn-block btn-outline-secondary col-lg-2" data-toggle="modal" data-target="#create_vaccine_inv">Add New Vaccines</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="vaccine_inv_table">
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

    <div class="modal fade" id="create_vaccine_inv">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Vaccines</h5>
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

                <form id="create_vaccine_inventory_form" enctype="multipart/form-data">
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
                                                            echo "<option value='{$vaccine['id']}'>{$vaccine['name']}</option>";
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
                                        <input type="text" class="form-control" name="batch_no" alt="required">
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
                                        <input type="text" class="form-control" name="manufacturer" alt="required">
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
                                                <!-- <option value="">SELECT AN OPTION</option> -->
                                                <!-- Populate dynamically -->

                                                <option value="">SELECT SUPPLIER</option>
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

                                <!-- Quantity Received -->
                                <div class="form-group col-lg-6">
                                    <label>Quantity Received:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-boxes"></i>
                                            </span>
                                        </div>
                                        <input type="number" min="1" class="form-control" name="quantity_received" alt="required">
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
                                        <input id="quantity_available" type="number" min="0" class="form-control" name="quantity_available" alt="required">
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
                                        <input type="text" class="form-control" name="unit" placeholder="e.g., doses, ml, grams" alt="required">
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
                                        <input type="text" class="form-control" name="temperature_range" placeholder="e.g., 2°C–8°C" alt="required">
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
                                        <input type="date" class="form-control" name="expiry_date" alt="required">
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
                                        <input type="text" class="form-control" name="received_by" placeholder="John Doe" alt="required">
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
                                        <input type="date" class="form-control" name="date_received" alt="required">
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
                                            <option value="Available">Available</option>
                                            <option value="Used">Used</option>
                                            <option value="Expired">Expired</option>
                                            <option value="Damaged">Damaged</option>
                                            <option value="Quarantined">Quarantined</option>
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
                                        <textarea class="form-control" name="storage_location" rows="3" placeholder="e.g., Cold Room A" alt="required"></textarea>
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
                                        <textarea class="form-control" name="remarks" rows="3" placeholder="Additional notes..."></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>

                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" onclick="set_system_cardinal_operation('You want to Add this to inventory?', 'create', 'create_vaccine_inventory_form', 'create_vaccine_inv.php', 'vaccine_inv_table', 'vaccine_inventory', '#tbl_vaccines_inv', 'required_div', 'confirmation_create_success', 'create_vaccine_inv')" class="btn btn-primary">Submit</button>                           
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
        show_table("vaccine_inv_table", "vaccine_inventory", "#tbl_vaccines_inv");

        $(document).on('change', '.delete-checkbox-vaccines-inv', function() {
            // Check if at least one checkbox is ticked
            const anyChecked = $('.delete-checkbox-vaccines-inv:checked').length > 0;
            
            // Enable or disable the button
            $('#btn-delete-selected-vaccines-inv').prop('disabled', !anyChecked);
        });
        
        $('#vaccine_id').select2({
            placeholder: 'SELECT A VACCINE',
            width: '100%',
            dropdownParent: $('#create_vaccine_inv') // if inside modal
        }).on('change', function () {
            let vaccine_id = $(this).val();

            if (vaccine_id) {
                fetchVaccineQuantity(vaccine_id);
            } else {
                $('#quantity_available').val('');
            }
        });;

        function fetchVaccineQuantity(vaccine_id) {
            $.ajax({
                url: 'get_vaccine_avail_quantity.php',
                type: 'POST',
                data: { vaccine_id: vaccine_id },
                dataType: 'json',
                success: function (response) {
                    if (response.status === 'success') {
                        $('#quantity_available').val(response.quantity_available);
                    } else {
                        $('#quantity_available').val(0);
                    }
                },
                error: function () {
                    alert('Failed to fetch vaccine quantity');
                }
            });
        }

        // Optional: re-trigger Select2 to display selected text properly (useful if you dynamically load form)
        $('#vaccine_id').trigger('change.select2');

        $('#supplier_id').select2({
            placeholder: 'SELECT A VACCINE',
            width: '100%',
            dropdownParent: $('#create_vaccine_inv') // if inside modal
        });

        $('.form-control[type="number"]').on('input', function () {
            this.value = this.value.replace(/\D/g, '');
        });

        $('#create_vaccine_inv').on('hidden.bs.modal', function () {
            $(this).find('.select2').val(null).trigger('change');
        });
    </script>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>

