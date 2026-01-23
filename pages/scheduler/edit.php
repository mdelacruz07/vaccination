    <?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    include '../registrants/vims_settings.php'; 
    $VIMS_settings = new VIMS_settings();
    $SelectSched = $systemcore->SelectTable("system_schedule");

    $Global_regions = $VIMS_settings->Global_regions();
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

    $id = $_GET['primary_id'];
    // echo $qr_id;
    $SelectGroups = $systemcore->SelectTable("vaccine_schedule WHERE reg_id = '$id'");
    if($SelectGroups != "none"){
        foreach($SelectGroups as $value){
            $schedule_id = $value["schedule_id"];
            $SelectSched_1 = $systemcore->SelectTable("system_schedule WHERE id = '$schedule_id'");
            foreach($SelectSched_1 as $value1){
                $schedule_name = $value1["schedule_name"];
                $update_status = "UPDATE";
            }
        }
    }else{
        $schedule_name = "None";
        $update_status = "CREATE";
    }

    $SelectRes = $systemcore->SelectTable("vaccine_registration WHERE id = '$id'");
    foreach($SelectRes as $value){
        $status = $value["sched_status"];
    }

    ?>
<div class="modal-header p-1">
    <h5 class="modal-title">Schedule Registrant</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>

<!-- This Alert is needed -->
<div class="alert alert-danger custom_required alert-dismissible fade show" id="required_div" role="alert">
    <strong>ERROR!</strong> Please Fill in the  Inputs below!
    <button type="button" class="close" onclick="turn_off_required('required_div')" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div> 

<div id="update_result">

</div>

<div class="modal-body p-2 m-0"  style=" height: 30vh;  overflow-y: auto;" >
    <form id ="update_form" enctype="multipart/form-data" class="p-0 m-0">
        <input type="text" class="form-control float-right" value="<?php echo $id;?>" id="primary_key" name="primary_key" hidden >
        <input type="text" class="form-control float-right" value="<?php echo $id;?>" id="registration_id" name="registration_id" hidden >
        <input type="text" class="form-control float-right" value="<?php echo $update_status;?>" id="update_status" name="update_status" hidden >
        
            <div class="col-12 row ">
                <div class="form-group col-12">
                    <label for="exampleInputEmail1">Schedule</label>
                    <select name="schedule_id" class="form-control regis_form">
                        <option value="<?php echo $schedule_id; ?>" hidden><?php echo $schedule_name; ?></option>
                        <option value="None">None</option>
                        <?php foreach($SelectSched as $data){  ?>
                            <option value="<?php echo $data["id"]; ?>"><?php echo $data["schedule_name"]; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="col-12 row ">
                <div class="form-group col-12">
                    <label for="exampleInputEmail1">Status</label>
                    <select name="sched_status" class="form-control regis_form" >
                        <option value="<?php echo $status; ?>" hidden><?php echo $status; ?></option>
                        <option value="approved">Approved</option>
                        <option value="refuse">Refuse</option>
                    </select>
                </div>
            </div>
    </form> 
</div>
<div class="modal-footer justify-content-between p-1">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-info text-white col-3 offset-6 text-center" onclick="set_system_cardinal_operation('You want to update this registrant information?', 'update', 'update_form', 'update.php', 'update_result', 'none', 'none', '_div_add_survey', 'confirmation_create_success', 'none')">Update</button>
</div>

<datalist id="no_selection">
    <option value="02_No">02_No</option>
</datalist>