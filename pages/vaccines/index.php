<!DOCTYPE html>
<html>
<?php
    $system_page_name = $_GET["page_name"];
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $System_Sessioning = $systemcore->System_Sessioning("session");

    include '../inc/header.php';
    // include '../inc/navbar.php';
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

              <button type="button" class="btn btn-block btn-outline-secondary col-lg-2" data-toggle="modal" data-target="#create_vaccine">Add New Vaccines</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="vaccine_table">
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
            <div class="modal-content" id="veiw_result">
                
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="create_vaccine">
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

                <form id="create_form" enctype="multipart/form-data">
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
                                         <input type="text" class="form-control float-right" name="name" alt="required">
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
                                        <input type="text" class="form-control float-right" name="type" alt="required">
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
                                        <input type="text" class="form-control float-right" name="manufacturer" alt="required">
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
                                        <input type="number" class="form-control float-right" name="dose_per_vial" alt="required">
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
                                        <textarea class="form-control float-right" name="description" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                </form> 
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" onclick="set_system_cardinal_operation('You want to Add this new Vaccine?', 'create', 'create_form', 'create_vaccine.php', 'vaccine_table', 'vaccines', '#tbl_vaccines', 'required_div', 'confirmation_create_success', 'create_vaccine')" class="btn btn-primary">Submit</button>                           
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
        show_table("vaccine_table", "vaccines", "#tbl_vaccines");

        $(document).on('change', '.delete-checkbox-vaccines', function() {
            // Check if at least one checkbox is ticked
            const anyChecked = $('.delete-checkbox-vaccines:checked').length > 0;
            
            // Enable or disable the button
            $('#btn-delete-selected-vaccines').prop('disabled', !anyChecked);
        });
    </script>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>

