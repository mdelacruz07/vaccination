<!DOCTYPE html>
<html>
<?php
    $system_page_name = $_GET["page_name"];
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $System_Sessioning = $systemcore->System_Sessioning("session");

    include '../registrants/vims_settings.php'; 
    $VIMS_settings = new VIMS_settings();

    $Global_category_array = $VIMS_settings->Global_category_array();
    $Global_sub_category_array = $VIMS_settings->Global_sub_category_array();
    $Global_allergy = $VIMS_settings->Global_allergy();
    $Global_refusal = $VIMS_settings->Global_refusal();
    $Global_reasons_for_not_FIT = $VIMS_settings->Global_reasons_for_not_FIT();
    $Global_vaccine_name = $VIMS_settings->Global_vaccine_name();
    $Global_comorbidity = $VIMS_settings->Global_comorbidity();

    $Global_regions = $VIMS_settings->Global_regions();
    $Global_province = $VIMS_settings->Global_province();
    $Global_city = $VIMS_settings->Global_city();
    $Global_barangay = $VIMS_settings->Global_barangay();

    include '../inc/header.php';
    // include '../inc/navbar.php';




?>
<datalist id="region">
    <?php foreach($Global_regions as $data){ ?>
        <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
    <?php } ?>
</datalist>
<datalist id="province">
    <?php foreach($Global_province as $data){ ?>
        <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
    <?php } ?>
</datalist>
<datalist id="city">
    <?php foreach($Global_city as $data){ ?>
        <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
    <?php } ?>
</datalist>
<datalist id="brgy">
    <?php foreach($Global_barangay as $data){ ?>
        <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
    <?php } ?>
</datalist>
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
              <h2 class="card-title col-lg-10" style="padding-top:10px; "><b>List Of Profiles</b></h2>
              <button type="button" class="btn btn-block btn-outline-secondary col-lg-2" data-toggle="modal" data-target="#create_user">Add New Profile</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <input type="file" id="profile" hidden>
                <div id="registrants_table" class="p-5">
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
        <div class="modal-dialog modal-xl" style="overflow-y: initial !important">
            <div class="modal-content" id="veiw_result">
                
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="create_user">
        <div class="modal-dialog modal-xl" style="overflow-y: initial !important">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Profile</h5>
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
                    <div class="modal-body"   style=" height: 70vh;  overflow-y: auto;" >
                        


                    <div class="col-12 row">
                      <center class="col-12"><h4>Profiling</h4></center>
                      <h6 class="col-12"><b>Personal Information:</b></h6>

                        <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Category<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Kategorya)</span></label>
                        <select name="employmentcategory" class="form-control regis_form" alt="required" required onchange="select_conditionalV2('sub_category1', this.value, 'array', 'array', 'array', 'select_sub_category_by_category', 'array')">
                            <option value="Empty" hidden></option>
                            <?php foreach($Global_category_array as $data){   ?>
                            <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                            <?php } ?>
                        </select>
                        </div>

                        <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Sub-Category<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Kategorya)</span></label>
                        <select name="sub_category" class="form-control regis_form" alt="required" required id="sub_category1">
                            <option value="Empty" hidden></option>
                            <?php foreach($Global_sub_category_array as $data){  ?>
                            <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                            <?php } ?>
                        </select>
                        </div>

                      <div class="form-group col-sm-4">
                          <label for="exampleInputEmail1">Last Name<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Apelyido)</span></label>
                          <input type="text" class="form-control regis_form" alt="required" name="lastname"  >
                      </div>

                      <div class="form-group col-sm-3">
                          <label for="exampleInputEmail1">First Name<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Pangalan)</span></label>
                          <input type="text" class="form-control regis_form" alt="required" name="firstname">
                      </div>

                      <div class="form-group col-sm-3">
                          <label for="exampleInputEmail1">Middle Name<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Gitnang Pangalan)</span></label>
                          <input type="text" class="form-control regis_form" name="middlename">
                      </div>

                      <div class="form-group col-sm-2">
                          <label for="exampleInputEmail1">Suffix</label>
                          <select name="suffix" class="form-control regis_form" value="TESTER">
                           <option value="N/A" >N/A</option>
                          <option value="Jr">Jr</option>
                          <option value="Sr">Sr</option>
                          <option value="II">II</option>
                          <option value="III">III</option>
                          <option value="IV">IV</option>
                          <option value="V">V</option>
                          <option value="VI">VI</option>
                          <option value="VII">VII</option>
                          </select>
                      </div>

                      <div class="form-group col-sm-12">
                          <label  for="exampleInputEmail1">Current Residence:<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Kasalukuyang Tirahan)</span></span><span style="color:gray; font-size:12px">(Unit/Building/House_Number,_Street_Name)</span></label>
                          <input type="text" class="form-control regis_form" value="N/A" name="current_residence" >
                      </div>

                      <div class="form-group col-sm-3">
                        <label for="exampleInputEmail1">Region<span style="color:red;">*</span></label>
                        <select name="region" class="form-control regis_form" alt="required" required onchange="select_conditionalV2('province1', this.value, 'array', 'array', 'array', 'select_province', 'array')">
                            <option value="Empty" hidden></option>
                            <?php foreach($Global_regions as $data){   ?>
                            <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                            <?php } ?>
                        </select>
                      </div>

                    <div class="form-group col-sm-3">
                        <label for="exampleInputEmail1">Province<span style="color:red;">*</span></label>
                        <select name="province" id="province1" class="form-control regis_form" alt="required" required onchange="select_conditionalV2('city1', this.value, 'array', 'array', 'array', 'select_city', 'array')">
                            <option value="Empty" hidden>Select Region First</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-3">
                        <label for="exampleInputEmail1">City/Municipality<span style="color:red;">*</span></label>
                        <select name="city" id="city1" class="form-control regis_form" alt="required" required onchange="select_conditionalV2('brgy1', this.value, 'array', 'array', 'array', 'select_brgy', 'array')">
                            <option value="Empty" hidden>Select Province First</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-sm-3">
                        <label for="exampleInputEmail1">Barangay<span style="color:red;">*</span></label>
                        <select name="brgy" id="brgy1" class="form-control regis_form" alt="required" required>
                            <option value="Empty" hidden>Select City / Municipality First</option>
                        </select>
                    </div>

                      <div class="form-group col-sm-3">
                          <label for="exampleInputEmail1">Occupation<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Trabaho)</span></label>
                          <input type="text" class="form-control regis_form" value="N/A" name="occupation">
                      </div>

                      <div class="form-group col-sm-3">
                          <label  for="exampleInputEmail1">Mobile Number<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Numero)</span></span><span style="color:gray; font-size:10px">(09XXXXXXXXX)</span></label>
                          <input type="text" name="contact" class="form-control regis_form" value="N/A">
                      </div>

                      <div class="form-group col-sm-3">
                          <label for="exampleInputEmail1">Gender<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Kasarian)</span></label>
                          <select name="gender" class="form-control regis_form" >
                           <option value="N/A" >N/A</option>
                          <option value="02_Male">Male</option>
                          <option value="01_Female">Female</option>
                          </select>
                      </div>

                      <div class="form-group col-sm-3">
                          <label for="exampleInputEmail1">Birthday<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Kapanganakan)</span><span style="color:gray; font-size:14px">(mm/dd/yyyy)</span></label>
                          <input type="date" class="form-control regis_form" name="bday">
                      </div>

                      <div class="form-group col-sm-6">
                          <label for="exampleInputEmail1">Allergy to vaccines or Components of vaccines?</label>
                            <select name="allergy_to_vaccine" class="form-control regis_form">
                                <option value="N/A" >N/A</option>
                                <option value="01_Yes">Yes</option>
                                <option value="02_No">No</option>
                            </select>
                      </div>

                      <div class="form-group col-sm-6">
                          <label for="exampleInputEmail1">With Comorbidity?</label>
                            <select name="profile_comorbidity" class="form-control regis_form">
                                <option value="N/A" >N/A</option>
                                <option value="01_Yes">Yes</option>
                                <option value="02_None">No</option>
                            </select>
                      </div>

                      <div class="col-12 row">
                    <h6 class="col-12"><b>Consent:</b></h6>
                    <div class="form-group col-sm-6">
                        <select name="consent" class="form-control regis_form" >
                        <option value="UNKNOWN">UNKNOWN</option>
                            <option value="01_Yes">Yes</option>
                            <option value="02_No">No</option>
                        </select>
                        <label for="exampleInputEmail1">Consent<span style="color:red;">*</span></label>
                    </div>

                    <div class="form-group col-sm-6">
                        <select name="reason_refusal" class="form-control regis_form" >
                        <option value="N/A" >N/A</option>
                            <?php foreach($Global_refusal as $data){ ?>
                                <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                            <?php } ?>
                        </select>
                        <label for="exampleInputEmail1">Reason for Refusal<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Dahilan para sa Pagtanggi)</span></label>
                    </div>
                  </div>

                  </div>

                    </div>
                    
                </form> 
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" onclick="set_system_cardinal_operation('You want to Create this new Registrant?', 'create', 'create_form', 'create.php', 'registrants_table', 'show_search', '#example1', 'required_div', 'confirmation_create_success', 'create_user')" class="btn btn-primary">Submit</button>                           
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
        show_table("registrants_table", "show_search", "#example1");


        function select_conditionalV2(target_div, selection_value, table_name, table_col, selection_col_name, condition, other_conditions){
            var xhttp;
        
            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                document.getElementById(target_div).innerHTML = this.responseText;
            };
            xhttp.open("GET","select_conditional.php?selection_value="+selection_value+"&table_name="+table_name+"&table_col="+table_col+"&selection_col_name="+selection_col_name+"&condition="+condition+"&other_conditions="+other_conditions, true);
            xhttp.send();  
        }
  </script>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>


