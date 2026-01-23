    <?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    include '../registrants/vims_settings.php'; 
    $VIMS_settings = new VIMS_settings();

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
    
    $id = $_GET['primary_id'];
    // echo $qr_id;
    $SelectGroups = $systemcore->SelectTable("vaccine_registration WHERE id = '$id'");
    if($SelectGroups != "none"){
        foreach($SelectGroups as $value){

            $vaccine_name = $value["vaccine_name"];
            $employmentcategory = $value["employmentcategory"];
            $current_residence = $value["current_residence"];
            $civil_status = $value["civil_status"];
            $employment_status = $value["employment_status"];
            $sub_category = $value["sub_category"];

            $province = $value["province"];
            $city = $value["city"];
            $region = $value["region"];

            $idcategory = $value["idcategory"];
            $idnumber = $value["idnumber"];
            $phid = $value["phid"];
            $pwdid = $value["pwdid"];
            $lastname = $value["lastname"];
            $firstname = $value["firstname"];
            $middlename = $value["middlename"];
            $suffix = $value["suffix"];
            $contact = $value["contact"];
            $gender = $value["gender"];
            $bday = $value["bday"];
            $brgy = $value["brgy"];
            $pregnant = $value["pregnant"];
            $covid_status = $value["covid_status"];
            $covid_exposure = $value["covid_exposure"];
          
            $medical_clearance = $value["medical_clearance"];
            $occupation = $value["ocupation"];
            $agency = $value["agency"];
            $if_allergy = $value["if_allergy"];
            $if_severe_allergic = $value["if_severe_allergic"];
            $bleeding_disorders = $value["bleeding_disorders"];
            $allergies_to_PEG = $value["allergies_to_PEG"];
            $allergy = $value["allergy"];
            $if_bleeding = $value["if_bleeding"];
            $symtoms = $value["symtoms"];
            $if_receive_vaccine = $value["if_receive_vaccine"];
            $convalescent = $value["convalescent"];
            $if_pregnant = $value["if_pregnant"];
            $comorbidity = $value["comorbidity"];
            $consent = $value["consent"];
            $date_added = $value["time_stamp"];
            $batch_number = $value["batch_number"];
            $lot_number = $value["lot_number"];
            $vaccinator_name = $value["vaccinator_name"];
            $prof_vaccinator = $value["prof_vaccinator"];
            $dose_1 = $value["dose_1"];
            $dose_2 = $value["dose_2"];
            $defferal = $value["defferal"];

            $allergy_to_vaccine = $value["allergy_to_vaccine"];
            $profile_comorbidity = $value["profile_comorbidity"];
        }
    }

    ?>
<div class="modal-header">
    <h5 class="modal-title">Edit Pre Registration</h5>
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

<div class="modal-body"  style=" height: 70vh;  overflow-y: auto;" >
    <form id ="update_form" enctype="multipart/form-data">
        <input type="text" class="form-control float-right" value="<?php echo $id;?>" id="primary_key" name="primary_key" hidden >
        <input type="text" class="form-control float-right" value="<?php echo $id;?>" id="registration_id" name="registration_id" hidden >
        
        <div class="col-12 row">
            <center class="col-12"><h4>Profiling</h4></center>
            <h6 class="col-12"><b>Personal Information:</b></h6>
            <div class="form-group col-6">
                <label for="exampleInputEmail1">Category<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Kategorya)</span></label>
                <select name="employmentcategory" id="employmentcategory" class="form-control regis_form" onchange="select_conditionalV2('sub_category', this.value, 'array', 'array', 'array', 'select_sub_category_by_category', 'array')">
                <option value="<?php echo $employmentcategory; ?>" hidden><?php echo $employmentcategory; ?></option>
                <option value=" " > </option>
                <?php foreach($Global_category_array as $data){ 
                    $data_array = explode(":",$data);?>
                    <option value="<?php echo $data; ?>"><?php echo $data_array[1]; ?></option>
                <?php } ?>
                </select>
            </div>

            <div class="form-group col-sm-6">
                <label for="exampleInputEmail1">Sub-Category<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Kategorya)</span></label>
                <select name="sub_category" class="form-control regis_form" id="sub_category">
                <option value="<?php echo $sub_category; ?>" hidden><?php echo $sub_category; ?></option>
                <option value=" " > </option>
                <?php foreach($Global_sub_category_array as $data){  ?>
                    <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                <?php } ?>
                </select>
            </div>



            <div class="form-group col-sm-4">
                <label for="exampleInputEmail1">Last Name<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Apelyido)</span></label>
                <input type="text" class="form-control regis_form" name="lastname" id="lastname" value="<?php echo $lastname; ?>">
            </div>

            <div class="form-group col-sm-3">
                <label for="exampleInputEmail1">First Name<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Pangalan)</span></label>
                <input type="text" class="form-control regis_form" name="firstname" id="firstname" value="<?php echo $firstname; ?>">
            </div>

            <div class="form-group col-sm-3">
                <label for="exampleInputEmail1">Middle Name<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Gitnang Pangalan)</span></label>
                <input type="text" class="form-control regis_form" name="middlename"  id="middlename"  value="<?php echo $middlename; ?>">
            </div>

            <div class="form-group col-sm-2">
                <label for="exampleInputEmail1">Suffix</label>
                <select name="suffix" id="suffix" class="form-control regis_form">
                <option value="<?php echo $suffix; ?>" hidden><?php echo $suffix; ?></option>
                <option value=" " > </option>
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
                <input type="text" class="form-control regis_form"   value="<?php echo $current_residence; ?>" name="current_residence"  id="current_residence">
            </div>

            <div class="form-group col-sm-3">
                <label for="exampleInputEmail1">Region<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Rehiyon)</span></label>
                <select name="region" class="form-control regis_form" alt="required" required onchange="select_conditionalV2('province1', this.value, 'array', 'array', 'array', 'select_province', 'array')">
                    <option value="<?php echo $region; ?>" hidden><?php echo $region; ?></option>
                    <?php foreach($Global_regions as $data){   ?>
                    <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group col-sm-3">
                <label for="exampleInputEmail1">Province<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Lalawigan)</span></label>
                <select name="province" id="province1" class="form-control regis_form" alt="required" required onchange="select_conditionalV2('city1', this.value, 'array', 'array', 'array', 'select_city', 'array')">
                    <option value="<?php echo $province; ?>" hidden><?php echo $province; ?></option>
                </select>
            </div>

            <div class="form-group col-sm-3">
                <label for="exampleInputEmail1">City/Municipality<span style="color:red;">*</span><span style="color:gray; font-size:12px">(Lungsod / munisipalidad)</span></label>
                <select name="city" id="city1" class="form-control regis_form" alt="required" required onchange="select_conditionalV2('brgy1', this.value, 'array', 'array', 'array', 'select_brgy', 'array')">
                    <option value="<?php echo $city; ?>" hidden><?php echo $city; ?></option>
                </select>
            </div>

            <div class="form-group col-sm-3">
                <label for="exampleInputEmail1">Barangay<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Barangay)</span></label>
                <select name="brgy" id="brgy1" class="form-control regis_form" alt="required" required>
                    <option value="<?php echo $brgy; ?>" hidden><?php echo $brgy; ?></option>
                </select>
            </div>

            <div class="form-group col-sm-3">
                <label for="exampleInputEmail1">Occupation<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Trabaho)</span></label>
                <input type="text" class="form-control regis_form" name="occupation" id="occupation"  value="<?php echo $occupation; ?>">
            </div>

            <div class="form-group col-sm-3">
                <label  for="exampleInputEmail1">Mobile Number<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Numero)</span></span><span style="color:gray; font-size:10px">(09XXXXXXXXX)</span></label>
                <input type="text" class="form-control regis_form"   value="<?php echo $contact; ?>" name="contact" id="contact" >
            </div>

            <div class="form-group col-sm-3">
                <label for="exampleInputEmail1">Gender<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Kasarian)</span></label>
                <select name="gender" id="gender" class="form-control regis_form" >
                <option value="<?php echo $gender; ?>" hidden><?php echo $gender; ?></option>
                <option value=" " > </option>
                <option value="02_Male">Male</option>
                <option value="01_Female">Female</option>
                </select>
            </div>

            <div class="form-group col-sm-3">
                <label for="exampleInputEmail1">Birthday<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Kapanganakan)</span><span style="color:gray; font-size:14px">(mm/dd/yyyy)</span></label>
                <input type="date" class="form-control regis_form" name="bday"  id="bday"  value="<?php echo $bday; ?>">
            </div>

            <div class="form-group col-sm-6">
                <label for="exampleInputEmail1">Allergy to vaccines or Components of vaccines?</label>
                <select name="allergy_to_vaccine" id="allergy_to_vaccine" class="form-control regis_form">
                <option value="<?php echo $allergy_to_vaccine; ?>" hidden><?php echo $allergy_to_vaccine; ?></option>
                    <option value=" " > </option>
                    <option value="01_Yes">Yes</option>
                    <option value="02_No">No</option>
                </select>
            </div>

            <div class="form-group col-sm-6">
                <label for="exampleInputEmail1">With Comorbidity?</label>
                <select name="profile_comorbidity" id="profile_comorbidity" class="form-control regis_form">
                <option value="<?php echo $profile_comorbidity; ?>" hidden><?php echo $profile_comorbidity; ?></option>
                    <option value=" " > </option>
                    <option value="01_Yes">Yes</option>
                    <option value="02_None">None</option>
                </select>
            </div>

            <div class="col-12 row">
        <h6 class="col-12"><b>Consent:</b></h6>

            <div class="form-group col-sm-6">
                <select name="consent" id="consent" class="form-control regis_form" >
                    <option value="<?php echo $consent; ?>" hidden><?php echo $consent; ?></option>
                    <option value=" " > </option>
                    <option value="01_Yes">Yes</option>
                    <option value="02_No">No</option>
                </select>
                <label for="exampleInputEmail1">Consent<span style="color:red;">*</span></label>
            </div>

            <div class="form-group col-sm-6">
                <select name="reason_refusal" id="reason_refusal" class="form-control regis_form" >
                    <option value="<?php echo $allergy; ?>" hidden><?php echo $allergy; ?></option>
                    <option value=" " > </option>
                    <?php foreach($Global_refusal as $data){ ?>
                        <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                    <?php } ?>
                </select>
                <label for="exampleInputEmail1">Reason for Refusal<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Dahilan para sa Pagtanggi)</span></label>
            </div>
        </div>
    </form> 
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-info text-white col-3 offset-6 text-center" onclick="set_system_cardinal_operation('You want to update this registrant information?', 'update', 'update_form', 'update.php', 'update_result', 'none', 'none', '_div_add_survey', 'confirmation_create_success', 'none')"><h5><b>Update Info<br></b></h5></button>
</div>