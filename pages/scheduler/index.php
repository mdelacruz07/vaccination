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
    $Global_adverse_event_condition = $VIMS_settings->Global_adverse_event_condition();
    $region = "06_Western_Visayas";
    $province = "_0645_NEGROS_OCCIDENTAL";
    $city = "_64502_BAGO_CITY";

    include '../inc/header.php';
?>
<datalist id="no_selection">
    <option value="02_No">02_No</option>
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
              <h2 class="card-title col-lg-10" style="padding-top:10px; "><b>List</b></h2>
              <!-- <button type="button" class="btn btn-block btn-outline-secondary col-lg-2" data-toggle="modal" data-target="#create_user">Add New Registrant</button> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form id ="sched_sort" class="card p-2" enctype="multipart/form-data"> 
                    <div class="row">
                        <div class="form-group col-sm-3">
                            <label for="exampleInputEmail1">Sort by Barangay</label>
                            <select name="sched_brgy" id="brgy12" class="form-control regis_form" alt="required" required>
                                <option value="<?php echo $brgy; ?>" hidden><?php echo $brgy; ?></option><?php                                    
                                $selection_value = $city;
                                $selection_value = str_replace("_","c*t",$selection_value);
                                $selection_value = explode('c*t', $selection_value);
                                $k = 0;
                                echo "<option value='Empty' hidden> </option>";
                                foreach($Global_barangay as $data){  
                                    $data_o = str_replace("_","c*t",$data);
                                    $data_o = explode('c*t', $data_o);
                        
                                    if(substr($data_o[1], 0, 5) == $selection_value[1]){ $k++;?>
                                    <option value="<?php echo $data; ?>"><?php echo $data; ?></option> <?php 
                                    }
                                } ?>
                            </select>
                        </div>

                        <div class="form-group col-3">
                            <label for="exampleInputEmail1">Sort by Category</label>
                            <select name="sched_cat" class="form-control regis_form" onchange="select_conditionalV2('sub_category1', this.value, 'array', 'array', 'array', 'select_sub_category_by_category', 'array')">
                            <option value="N/A" >N/A</option>
                                <?php foreach($Global_category_array as $data){ 
                                    $data_array = explode(":",$data);?>
                                    <option value="<?php echo $data; ?>"><?php echo $data_array[1]; ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group col-1">
                            <label for="exampleInputEmail1"><br></label>
                            <button type="button" class="btn btn-outline-success col-12" onclick="show_table('registrants_table', 'show_sched_sort', '#example1', sched_brgy.value+'c*u*t'+sched_cat.value);">Sort</button>
                        </div>

                        <div class="form-group col-4">
                            <label for="exampleInputEmail1">Search</label>
                            <input type="text" class="form-control float-right" value="<?php echo $values; ?>" style="background-color:rgb(240, 255, 248);" name="search" placeholder="Search by Last Name or Scan QR Code" alt="required">
                        </div>

                        <div class="form-group col-1">
                            <label for="exampleInputEmail1"><br></label>
                            <button type="button" class="btn btn-outline-success col-12" onclick="show_table('registrants_table', 'shed_show_registrants', '#example1', search.value);">Search</button>
                        </div>
                        
                    </div>

                </form>
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
        <div class="modal-dialog modal-sm" style="overflow-y: initial !important">
            <div class="modal-content" id="veiw_result">
                
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    
    <div class="modal fade" id="delete_edit">
        <div class="modal-dialog modal-sm" style="overflow-y: initial !important">
            <div class="modal-content" id="veiw_result_edit_delete">
                
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
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>


