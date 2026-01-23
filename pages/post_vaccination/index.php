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
              <h2 class="card-title col-10"><b>List</b></h2>
              <a href="index.php" class="btn btn-warning col-2">Refresh</a>
              <!-- <button type="button" class="btn btn-block btn-outline-secondary col-lg-2" data-toggle="modal" data-target="#create_facility">Add New</button> -->
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
        <div class="modal-dialog modal-md" style="overflow-y: initial !important">
            <div class="modal-content" id="veiw_result">
                
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="create_facility">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New</h5>
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
                                    <label>Full Name:</label>
                                    <div class="row">
                                        <input type="text" class="form-control col-4" name="add_firstname" alt="required" placeholder="First Name"> 
                                        <input type="text" class="form-control col-4" name="add_middlename" placeholder="Middle Name"> 
                                        <input type="text" class="form-control col-4" name="add_lastname" placeholder="Last Name"> 
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label>Initial Vital Sign:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="far fa-address-card"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="add_initial_VS">
                                    </div>
                                </div>

                                <div class="form-group col-12">
                                    <label>Blood Pressure:</label>
                                    <div class="input-group">
                                        <div class="row">
                                            <input type="text" class="form-control col-4" name="add_BP_1">
                                            <input type="text" class="form-control col-4" name="add_BP_2">
                                            <input type="text" class="form-control col-4" name="add_BP_3">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label>Addmission Time:</label>
                                        <div class="row">
                                            <input type="text" class="form-control col-6 text-right" name="add_addmission_time_hour" id="add_addmission_time_hour">
                                            <input type="text" class="form-control col-6" name="add_addmission_time_minute" id="add_addmission_time_minute">
                                        </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label>Time Skip:</label>
                                    <div class="row">
                                        <button type="button" class="btn btn-success col-6" onclick="minute_function('15')">15</button>
                                        <button type="button" class="btn btn-success col-6" onclick="minute_function('30')">30</button>
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label>Discharge Time:</label>
                                    <div class="row">
                                        <input type="text" class="form-control col-6 text-right" name="add_discharge_time_hour" readonly id="add_discharge_time_hour">
                                        <input type="text" class="form-control col-6" name="add_discharge_time_minute" readonly id="add_discharge_time_minute">
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label>Remarks:</label>
                                    <div class="input-group">
                                        <textarea class="form-control float-right" name="add_remarks"> </textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    
                </form> 
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" onclick="set_system_cardinal_operation('You want to Create this new Field?', 'create', 'create_form', 'create_facility.php', 'facilities_table', 'show_PCM_O', '#example1', 'required_div', 'confirmation_create_success', 'create_facility')" class="btn btn-primary">Submit</button>                           
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
        show_table("facilities_table", "show_search_PCM", "#example1");

        function minute_function(minute_to_add){

          var hour = document.getElementById("add_addmission_time_hour").value;
          var minute = document.getElementById("add_addmission_time_minute").value;
 
          var total_minutes = parseInt(minute) + parseInt(minute_to_add);
          if(total_minutes >= 60){
            hour = parseInt(hour) + 1;
            total_minutes = total_minutes - 60;
          }
          if(hour > 12){
            hour = parseInt(hour) - 12;
          }
          document.getElementById("add_discharge_time_hour").value = ('0' + hour).slice(-2);
          document.getElementById("add_discharge_time_minute").value = ('0' + total_minutes).slice(-2);

        }

        function minute_function1(minute_to_add, output_id, output_id1, input_id, input_id1){

            var hour = document.getElementById(input_id1).value;
            var minute = document.getElementById(input_id).value;

            var total_minutes = parseInt(minute) + parseInt(minute_to_add);
            if(total_minutes >= 60){
            hour = parseInt(hour) + 1;
            total_minutes = total_minutes - 60;
            }
            if(hour > 12){
            hour = parseInt(hour) - 12;
            }
            document.getElementById(output_id1).value = ('0' + hour).slice(-2);
            document.getElementById(output_id).value = ('0' + total_minutes).slice(-2);

        }

        function PrintElem(elem)
        {
            var mywindow = window.open('', 'PRINT', 'height=400,width=600');

            mywindow.document.write('<html><head><title>' + document.title  + '</title>');
            mywindow.document.write('</head><body >');
            mywindow.document.write('<h1>' + document.title  + '</h1>');
            mywindow.document.write(document.getElementById(elem).innerHTML);
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            // mywindow.print();
            // mywindow.close();

            return true;
        }
        
    </script>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>


