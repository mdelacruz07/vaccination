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
              <h2 class="card-title col-lg-10" style="padding-top:10px; "><b>List Of Vaccination Facility</b></h2>
              <button type="button" class="btn btn-block btn-outline-secondary col-lg-2" data-toggle="modal" data-target="#create_facility">Add New Facility</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="facilities_table">
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
        <div class="modal-dialog modal-sm">
            <div class="modal-content" id="veiw_result">
                
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="create_facility">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Facility</h5>
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

                <form id ="create_form" enctype="multipart/form-data">
                    <div class="modal-body" >
                        <div class="row">
                            
                            <div class="row col-sm-12">
                                <div class="form-group col-lg-12">
                                    <label>Facility Name:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="far fa-address-card"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="add_facility_name" alt="required"> 
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label>Location:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="far fa-address-card"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="add_location" alt="required">
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label>Google Map Location:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="far fa-address-card"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="add_iframe_location">
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label>Status:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="fas fa-venus-mars"></i>
                                        </span>
                                        </div>
                                        <select name="add_status" class="form-control"  alt="required">
                                            <option value="ACTIVE">ACTIVE</option>
                                            <option value="IN-ACTIVE">IN-ACTIVE</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                </form> 
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" onclick="set_system_cardinal_operation('You want to Create this new Facility?', 'create', 'create_form', 'create_facility.php', 'facilities_table', 'show_facilities', '#example1', 'required_div', 'confirmation_create_success', 'create_facility')" class="btn btn-primary">Submit</button>                           
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <?php 
        include '../inc/confirmation_alerts.php';
        include '../inc/footer.php';
    ?>
    <script>
        // setting up the tables
        show_table("facilities_table", "show_facilities", "#example1");
        
    </script>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>


