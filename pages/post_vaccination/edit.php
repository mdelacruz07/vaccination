    <?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $id = $_GET['primary_id'];
    $info_id = explode("cut", $id);
    $id=$info_id[0];
    $dose=$info_id[1];

    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM post_vaccination WHERE qr_id = '$id'");
    foreach($SelectTable as $value){
        $id = $value['id'];
        $qr_id = $value['qr_id'];
        $firstname = $value['firstname'];
        $middlename = $value['middlename'];
        $lastname = $value['lastname'];
        $initial_VS = $value['initial_VS'];
        $addmission_time_hour = $value['addmission_time_hour'];
        $addmission_time_minute = $value['addmission_time_minute'];
        $discharge_time_hour = $value['discharge_time_hour'];
        $discharge_time_minute = $value['discharge_time_minute'];
        $BP_1 = $value['BP_1'];
        $BP_2 = $value['BP_2'];
        $BP_3 = $value['BP_3'];
        $remarks = $value['remarks'];

        $addmission_time_hour_1 = $value['addmission_time_hour_1'];
        $addmission_time_minute_1 = $value['addmission_time_minute_1'];
        $discharge_time_hour_1 = $value['discharge_time_hour_1'];
        $discharge_time_minute_1 = $value['discharge_time_minute_1'];
        $BP_1_1 = $value['BP_1_1'];
        $BP_2_1 = $value['BP_2_1'];
        $BP_3_1 = $value['BP_3_1'];
        $remarks_1 = $value['remarks_1'];

        $brgy = $value['brgy'];
        $bday = $value['bday'];

        $age = date_diff(date_create(), date_create($bday));
        $age = $age->format("%Y");
    }

    ?>
<div class="modal-header">
    <h5 class="modal-title">Post Monitoring</h5>
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

<div id="update_result">

</div>

<form id ="update_form" enctype="multipart/form-data">
    <input type="text" class="form-control float-right" value="<?php echo $id;?>" id="primary_key" name="primary_key" hidden >
    <input type="text" class="form-control float-right" value="<?php echo $id;?>" name="pcm_id" hidden >
    <input type="text" class="form-control float-right" value="<?php echo $qr_id;?>" name="qr_id" hidden >
    <div class="modal-body"   style=" height: 50vh;  overflow-y: auto; background-color: rgb(184, 210, 214)" >
        <div class="row">
            
            <div class="row col-sm-12">
                <div class="form-group col-lg-12">
                    <label>Full Name:</label>
                    <div class="row">
                        <input type="text" class="form-control col-4" id="firstname" readonly name="firstname" alt="required" placeholder="First Name"  value="<?php echo $firstname; ?>"> 
                        <input type="text" class="form-control col-4" id="middlename" readonly  name="middlename" placeholder="Middle Name"  value="<?php echo $middlename; ?>"> 
                        <input type="text" class="form-control col-4" id="lastname" readonly  name="lastname" placeholder="Last Name"  value="<?php echo $lastname; ?>"> 
                    </div>
                    <label>Details:</label>
                    <div class="row">
                        <input type="text" class="form-control col-4" readonly value="<?php echo $brgy; ?>"> 
                        <input type="text" class="form-control col-4" readonly value="<?php echo $bday; ?>"> 
                        <input type="text" class="form-control col-4" readonly value="<?php echo $age; ?>"> 
                    </div>
                </div>

                <div class="form-group col-lg-12" hidden>
                    <label>Initial Vital Sign:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="far fa-address-card"></i>
                        </span>
                        </div>
                        <input type="text" class="form-control float-right" name="initial_VS" id="initial_VS" value="<?php echo $initial_VS; ?>">
                    </div>
                </div>
                <?php if($dose == "01_Yes"){ ?>
                    <div class="col-12"><center><h3>2nd Dose:</h3></center></div>

                    <div class="form-group col-12">
                        <label>Blood Pressure:</label>
                        <div class="input-group">
                            <div class="row">
                                <input type="text" class="form-control col-4" name="BP_1_1" id="BP_1_1" value="<?php echo $BP_1_1; ?>">
                                <input type="text" class="form-control col-4" name="BP_2_1" id="BP_2_1" value="<?php echo $BP_2_1; ?>">
                                <input type="text" class="form-control col-4" name="BP_3_1" id="BP_3_1" value="<?php echo $BP_3_1; ?>">
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-lg-12">
                        <label>Addmission Time:</label>
                        <div class="row">
                            <input type="text" class="form-control col-6 text-right" name="addmission_time_hour_1" id="addmission_time_hour_1" value="<?php echo $addmission_time_hour_1; ?>">
                            <input type="text" class="form-control col-6" name="addmission_time_minute_1" id="addmission_time_minute_1" value="<?php echo $addmission_time_minute_1; ?>">
                        </div>
                    </div>

                    <div class="form-group col-lg-12">
                        <label>Time Skip:</label>
                            <div class="row">
                                <button type="button" class="btn btn-success col-6" onclick="minute_function1('15','discharge_time_minute_1','discharge_time_hour_1','addmission_time_minute_1','addmission_time_hour_1')">15</button>
                                <button type="button" class="btn btn-danger col-6" onclick="minute_function1('30','discharge_time_minute_1','discharge_time_hour_1','addmission_time_minute_1','addmission_time_hour_1')">30</button>
                            </div>
                    </div>

                    <div class="form-group col-lg-12">
                        <label>Discharge Time:</label>
                        <div class="row">
                            <input type="text" class="form-control col-6 text-right" name="discharge_time_hour_1" id="discharge_time_hour_1" value="<?php echo $discharge_time_hour_1; ?>">
                            <input type="text" class="form-control col-6" name="discharge_time_minute_1" id="discharge_time_minute_1" value="<?php echo $discharge_time_minute_1; ?>">
                        </div>
                    </div>

                    <div class="form-group col-lg-12">
                        <label>Remarks:</label>
                        <div class="input-group">
                            <textarea class="form-control float-right" name="remarks_1" id="remarks_1"> <?php echo $remarks_1; ?> </textarea>
                        </div>
                    </div>
                <?php } ?>

                <div class="col-12"><center><h3>1st Dose:</h3></center></div>

                <div class="form-group col-12">
                    <label>Blood Pressure:</label>
                    <div class="input-group">
                        <div class="row">
                            <input type="text" class="form-control col-4" name="BP_1" id="BP_1" value="<?php echo $BP_1; ?>">
                            <input type="text" class="form-control col-4" name="BP_2" id="BP_2" value="<?php echo $BP_2; ?>">
                            <input type="text" class="form-control col-4" name="BP_3" id="BP_3" value="<?php echo $BP_3; ?>">
                        </div>
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label>Addmission Time:</label>
                    <div class="row">
                        <input type="text" class="form-control col-6 text-right" name="addmission_time_hour" id="addmission_time_hour" value="<?php echo $addmission_time_hour; ?>">
                        <input type="text" class="form-control col-6" name="addmission_time_minute" id="addmission_time_minute" value="<?php echo $addmission_time_minute; ?>">
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label>Time Skip:</label>
                        <div class="row">
                            <button type="button" class="btn btn-success col-6" onclick="minute_function1('15','discharge_time_minute','discharge_time_hour','addmission_time_minute','addmission_time_hour')">15</button>
                            <button type="button" class="btn btn-danger col-6" onclick="minute_function1('30','discharge_time_minute','discharge_time_hour','addmission_time_minute','addmission_time_hour')">30</button>
                        </div>
                </div>

                <div class="form-group col-lg-12">
                    <label>Discharge Time:</label>
                    <div class="row">
                        <input type="text" class="form-control col-6 text-right" name="discharge_time_hour" id="discharge_time_hour" value="<?php echo $discharge_time_hour; ?>">
                        <input type="text" class="form-control col-6" name="discharge_time_minute" id="discharge_time_minute" value="<?php echo $discharge_time_minute; ?>">
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label>Remarks:</label>
                    <div class="input-group">
                        <textarea class="form-control float-right" name="remarks" id="remarks"> <?php echo $remarks; ?> </textarea>
                    </div>
                </div>

            </div>
        </div>

    </div>
    
</form> 
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <div>
    <a class="btn btn-warning" href="#" onClick="window.open('print_info.php?id=<?php echo $id;?>cut<?php echo $dose;?>','pagename','resizable,height=700,width=700'); return false;">Print</a>
    <button type="submit" onclick="set_system_cardinal_operation('You want to Update this Facility?', 'update', 'update_form', 'update_facility.php', 'update_result', 'none', 'none', 'required_div', 'confirmation_update_success', 'none')" class="btn btn-primary">Update</button>                           
    </div>
    
</div>