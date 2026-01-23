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
    $Global_adverse_event_condition = $VIMS_settings->Global_adverse_event_condition();

    $id = $_GET['primary_id'];
    // echo $qr_id;
    $SelectGroups = $systemcore->SelectTable("vaccine_registration WHERE id = '$id'");
    if($SelectGroups != "none"){
        foreach($SelectGroups as $value){
            $qr_id = $value["qr_id"];
            $vaccine_name = $value["vaccine_name"];                 if(strlen($vaccine_name) <= 1){ $vaccine_name="N/A"; };
            $employmentcategory = $value["employmentcategory"];     if(strlen($employmentcategory) <= 1){ $employmentcategory="N/A"; };
            $current_residence = $value["current_residence"];       if(strlen($current_residence) <= 1){ $current_residence="N/A"; };
            $civil_status = $value["civil_status"];                 if(strlen($civil_status) <= 1){ $civil_status="N/A"; };
            $employment_status = $value["employment_status"];       if(strlen($employment_status) <= 1){ $employment_status="N/A"; };
            $sub_category = $value["sub_category"];                 if(strlen($sub_category) <= 1){ $sub_category="N/A"; };

            $province = $value["province"];                         if(strlen($province) <= 1){ $province="N/A"; };
            $city = $value["city"];                                 if(strlen($city) <= 1){ $city="N/A"; };
            $region = $value["region"];                             if(strlen($region) <= 1){ $region="N/A"; };

            $idcategory = $value["idcategory"];                     if(strlen($idcategory) <= 1){ $idcategory="N/A"; };
            $idnumber = $value["idnumber"];                         if(strlen($idnumber) <= 1){ $idnumber="N/A"; };
            $phid = $value["phid"];                                 if(strlen($phid) <= 1){ $phid="N/A"; };
            $pwdid = $value["pwdid"];                               if(strlen($pwdid) <= 1){ $pwdid="N/A"; };
            $lastname = $value["lastname"];                         if(strlen($lastname) <= 1){ $lastname="N/A"; };
            $firstname = $value["firstname"];                       if(strlen($firstname) <= 1){ $firstname="N/A"; };
            $middlename = $value["middlename"];                     if(strlen($middlename) <= 1){ $middlename="N/A"; };
            $suffix = $value["suffix"];                             if(strlen($suffix) <= 1){ $suffix="N/A"; };
            $contact = $value["contact"];                           if(strlen($contact) <= 1){ $contact="N/A"; };
            $gender = $value["gender"];                             if(strlen($gender) <= 1){ $gender="N/A"; };
            $bday = $value["bday"];                                 if(strlen($bday) <= 1){ $bday="N/A"; };
            $brgy = $value["brgy"];                                 if(strlen($brgy) <= 1){ $brgy="N/A"; };
            $pregnant = $value["pregnant"];                         if(strlen($pregnant) <= 1){ $pregnant="N/A"; };
            $covid_status = $value["covid_status"];                 if(strlen($covid_status) <= 1){ $covid_status="N/A"; };
            $covid_exposure = $value["covid_exposure"];             if(strlen($covid_exposure) <= 1){ $covid_exposure="N/A"; };
          
            $medical_clearance = $value["medical_clearance"];       if(strlen($medical_clearance) <= 1){ $medical_clearance="N/A"; };
            $occupation = $value["ocupation"];                      if(strlen($occupation) <= 1){ $occupation="N/A"; };
            $agency = $value["agency"];                             if(strlen($agency) <= 1){ $agency="N/A"; };
            $if_allergy = $value["if_allergy"];                     if(strlen($if_allergy) <= 1){ $if_allergy="N/A"; };
            $if_severe_allergic = $value["if_severe_allergic"];     if(strlen($if_severe_allergic) <= 1){ $if_severe_allergic="N/A"; };
            $bleeding_disorders = $value["bleeding_disorders"];     if(strlen($bleeding_disorders) <= 1){ $bleeding_disorders="N/A"; };
            $allergies_to_PEG = $value["allergies_to_PEG"];         if(strlen($allergies_to_PEG) <= 1){ $allergies_to_PEG="N/A"; };
            $allergy = $value["allergy"];                           if(strlen($allergy) <= 1){ $allergy="N/A"; };
            $if_bleeding = $value["if_bleeding"];                   if(strlen($if_bleeding) <= 1){ $if_bleeding="N/A"; };
            $symtoms = $value["symtoms"];                           if(strlen($symtoms) <= 1){ $symtoms="N/A"; };
            $if_receive_vaccine = $value["if_receive_vaccine"];     if(strlen($if_receive_vaccine) <= 1){ $if_receive_vaccine="N/A"; };
            $convalescent = $value["convalescent"];                 if(strlen($convalescent) <= 1){ $convalescent="N/A"; };
            $if_pregnant = $value["if_pregnant"];                   if(strlen($if_pregnant) <= 1){ $if_pregnant="N/A"; };
            $comorbidity = $value["comorbidity"];                   if(strlen($comorbidity) <= 1){ $comorbidity="N/A"; };
            $consent = $value["consent"];                           if(strlen($consent) <= 1){ $consent="N/A"; };
            $reason_refusal = $value["reason_refusal"];                           if(strlen($reason_refusal) <= 1){ $reason_refusal="N/A"; };
            
            $guardian = $value["guardian"];                         if(strlen($guardian) <= 1){ $guardian="N/A"; };
            $ped_comorbid = $value["ped_comorbid"];                 if(strlen($ped_comorbid) <= 1){ $ped_comorbid="N/A"; };
            
            $date_added = $value["time_stamp"]; 

            $batch_number = $value["batch_number"];                 if(strlen($batch_number) <= 1){ $batch_number="N/A"; };
            $lot_number = $value["lot_number"];                     if(strlen($lot_number) <= 1){ $lot_number="N/A"; };
            $vaccinator_name = $value["vaccinator_name"];           if(strlen($vaccinator_name) <= 1){ $vaccinator_name="N/A"; };
            $prof_vaccinator = $value["prof_vaccinator"];           if(strlen($prof_vaccinator) <= 1){ $prof_vaccinator="N/A"; };
            $dose_1 = $value["dose_1"];                             if(strlen($dose_1) <= 1){ $dose_1="N/A"; };
            $dose_2 = $value["dose_2"];                             if(strlen($dose_2) <= 1){ $dose_2="N/A"; };
            $booster = $value["booster"];                           if(strlen($booster) <= 1){ $booster="N/A"; };
            $defferal = $value["defferal"];                         if(strlen($defferal) <= 1){ $defferal="N/A"; };

            $allergy_to_vaccine = $value["allergy_to_vaccine"];     if(strlen($allergy_to_vaccine) <= 1){ $allergy_to_vaccine="N/A"; };
            $profile_comorbidity = $value["profile_comorbidity"];   if(strlen($profile_comorbidity) <= 1){ $profile_comorbidity="N/A"; };

            
            $indigenous = $value["indigenous"];                     if(strlen($indigenous) <= 1){ $indigenous="02_No"; };
            $pwd = $value["pwd"];                                   if(strlen($pwd) <= 1){ $pwd="02_No"; };
            $adverse_event = $value["adverse_event"];               if(strlen($adverse_event) <= 1){ $adverse_event="02_No"; };
            $adverse_event_cons = $value["adverse_event_cons"];     if(strlen($adverse_event_cons) <= 1){ $adverse_event_cons="02_No"; };
            if($adverse_event_cons == "N/A"){ $adverse_event_cons="02_No"; };
        }
    }

    ?>
<div class="modal-header p-1">
    <h5 class="modal-title">Edit Registration</h5>
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

<div class="modal-body p-2 m-0"  style=" height: 65vh;  overflow-y: auto;" >
    <form id ="update_form" enctype="multipart/form-data" class="p-0 m-0">
        <input type="text" class="form-control float-right" value="<?php echo $id;?>" id="primary_key" name="primary_key" hidden >
        <input type="text" class="form-control float-right" value="<?php echo $id;?>" id="registration_id" name="registration_id" hidden >
        <input type="text" class="form-control float-right" value="<?php echo $qr_id;?>" name="qr_id" hidden >
        
        <div class="card" style="background-color:rgb(237, 240, 238)">
            <div class="col-12 row  pr-3 pl-3">
                <center class="col-12"><h4><u>Profiling</u></h4></center>
                <h6 class="col-12"><center><b>Personal Information</b></center></h6>
                <div class="form-group col-12">
                    <label for="exampleInputEmail1">Category</label>
                    <select name="employmentcategory" class="form-control regis_form bg-info" onchange="select_conditionalV2('sub_category', this.value, 'array', 'array', 'array', 'select_sub_category_by_category', 'array')">
                        <option value="<?php echo $employmentcategory; ?>" hidden><?php echo $employmentcategory; ?></option>
                        <option value="N/A">N/A</option>
                        <?php foreach($Global_category_array as $data){ 
                            $data_array = explode(":",$data);?>
                            <option value="<?php echo $data; ?>"><?php echo $data_array[1]; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group col-sm-6" hidden>
                    <label for="exampleInputEmail1">Sub-Category</label>
                    <select name="sub_category" id="sub_category" class="form-control regis_form" >
                    <option value="<?php echo $sub_category; ?>" hidden><?php echo $sub_category; ?></option>
                    <option value="N/A">N/A</option>
                    <?php foreach($Global_sub_category_array as $data){  ?>
                        <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                    <?php } ?>
                    </select>
                </div>



                <div class="form-group col-sm-4">
                    <label for="exampleInputEmail1">Last Name</label>
                    <input type="text" class="form-control regis_form" name="lastname" id="lastname" value="<?php echo $lastname; ?>">
                </div>

                <div class="form-group col-sm-3">
                    <label for="exampleInputEmail1">First Name</label>
                    <input type="text" class="form-control regis_form" name="firstname" id="firstname" value="<?php echo $firstname; ?>">
                </div>

                <div class="form-group col-sm-3">
                    <label for="exampleInputEmail1">Middle Name</label>
                    <input type="text" class="form-control regis_form" name="middlename" id="middlename" value="<?php echo $middlename; ?>">
                </div>

                <div class="form-group col-sm-2">
                    <label for="exampleInputEmail1">Suffix</label>
                    <select name="suffix" class="form-control regis_form">
                    <option value="<?php echo $suffix; ?>" hidden><?php echo $suffix; ?></option>
                    <option value="N/A">N/A</option>
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

                <div class="form-group col-sm-12" hidden>
                    <label  for="exampleInputEmail1">Current Residence:</label>
                    <input type="text" class="form-control regis_form" value="<?php echo $current_residence; ?>" name="current_residence" >
                </div>

                <div class="form-group col-sm-3">
                    <label for="exampleInputEmail1">Region</label>
                    <select name="region" class="form-control regis_form" alt="required" required onchange="select_conditionalV2('province1', this.value, 'array', 'array', 'array', 'select_province', 'array')">
                        <option value="<?php echo $region; ?>" hidden><?php echo $region; ?></option>
                        <option value="N/A">N/A</option>
                        <?php foreach($Global_regions as $data){   ?>
                        <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group col-sm-3">
                    <label for="exampleInputEmail1">Province</label>
                    <select name="province" id="province1" class="form-control regis_form" alt="required" required onchange="select_conditionalV2('city1', this.value, 'array', 'array', 'array', 'select_city', 'array')">
                        <option value="<?php echo $province; ?>" hidden><?php echo $province; ?></option>
                    </select>
                </div>

                <div class="form-group col-sm-3">
                    <label for="exampleInputEmail1">City/Municipality</label>
                    <select name="city" id="city1" class="form-control regis_form" alt="required" required onchange="select_conditionalV2('brgy1', this.value, 'array', 'array', 'array', 'select_brgy', 'array')">
                        <option value="<?php echo $city; ?>" hidden><?php echo $city; ?></option>
                    </select>
                </div>

                <div class="form-group col-sm-3">
                    <label for="exampleInputEmail1">Barangay</label>
                    <select name="brgy" id="brgy1" class="form-control regis_form bg-info" alt="required" required>
                        <option value="<?php echo $brgy; ?>" hidden><?php echo $brgy; ?></option>
                    </select>
                </div>

                <div class="form-group col-sm-3">
                    <label for="exampleInputEmail1">Occupation</label>
                    <input type="text" class="form-control regis_form" name="occupation" value="<?php echo $occupation; ?>">
                </div>

                <div class="form-group col-sm-3">
                    <label  for="exampleInputEmail1">Mobile Number</label>
                    <input type="text" class="form-control regis_form" value="<?php echo $contact; ?>" name="contact" >
                </div>

                <div class="form-group col-sm-3">
                    <label for="exampleInputEmail1">Gender</label>
                    <select name="gender" class="form-control regis_form" >
                    <option value="<?php echo $gender; ?>" hidden><?php echo $gender; ?></option>
                    <option value="N/A">N/A</option>
                    <option value="02_Male">Male</option>
                    <option value="01_Female">Female</option>
                    </select>
                </div>

                <div class="form-group col-sm-3">
                    <label for="exampleInputEmail1">Birthday</label>
                    <input type="date" class="form-control regis_form bg-info" name="bday" value="<?php echo $bday; ?>">
                </div>

                <div class="form-group col-sm-6" hidden>
                    <label for="exampleInputEmail1">Allergy to vaccines or Components of vaccines?</label>
                    <select name="allergy_to_vaccine" class="form-control regis_form">
                    <option value="<?php echo $allergy_to_vaccine; ?>" hidden><?php echo $allergy_to_vaccine; ?></option>
                        <option value="N/A">N/A</option>
                        <option value="01_Yes">Yes</option>
                        <option value="02_No">No</option>
                    </select>
                </div>

                <div class="form-group col-sm-6" hidden>
                    <label for="exampleInputEmail1">With Comorbidity?</label>
                    <select name="profile_comorbidity" class="form-control regis_form">
                    <option value="<?php echo $profile_comorbidity; ?>" hidden><?php echo $profile_comorbidity; ?></option>
                        <option value="N/A">N/A</option>
                        <option value="01_Yes">Yes</option>
                        <option value="02_None">None</option>
                    </select>
                </div>

                
                <h6 class="col-12" hidden><center><b>Consent</b></center></h6>

                <div class="form-group col-sm-6" hidden>
                    <label for="exampleInputEmail1">Consent</label>
                    <select name="consent" class="form-control regis_form" >
                        <option value="<?php echo $consent; ?>" hidden><?php echo $consent; ?></option>
                        <option value="N/A">N/A</option>
                        <option value="01_Yes">Yes</option>
                        <option value="02_No">No</option>
                    </select>
                    
                </div>

                <div class="form-group col-sm-6" hidden>
                    <label for="exampleInputEmail1">Reason for Refusal</label>
                    <select name="reason_refusal" class="form-control regis_form" >
                        <option value="<?php echo $reason_refusal; ?>" hidden><?php echo $reason_refusal; ?></option>
                        <option value="N/A" >N/A</option>
                        <?php foreach($Global_refusal as $data){ ?>
                            <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Indigenous Member</label>
                        <input type="text" class="form-control regis_form" name="indigenous" value="<?php echo $indigenous; ?>">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">PWD</label>
                        <select name="pwd" class="form-control regis_form" >
                            <option value="<?php echo $pwd; ?>" hidden><?php echo $pwd; ?></option>
                            <option value="01_Yes">01_Yes</option>
                            <option value="02_No">02_No</option>
                        </select>
                    </div>

            </div>
        </div>
        <div class="card" style="background-color:rgb(193, 219, 189)">
            <div class="col-12 row  pr-3 pl-3">
            <center class="col-12"><h5><u>12 - 17 Year Old Additional Information</u></h5></center>
                <div class="col-12 row"> <!-- Personal Information: 12 -17 yrs old-->
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Guardian Name</label>
                        <input type="text" class="form-control regis_form" name="guardian"  value="<?php echo $guardian; ?>">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Pedia Comorbidity</label>
                        <input type="text" class="form-control regis_form" name="ped_comorbid"  value="<?php echo $ped_comorbid; ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="background-color:rgb(239, 240, 206)">
            <div class="col-12 row  pr-3 pl-3">
                <center class="col-12"><h5><u>Vaccination Details</u></h5></center>
                <div class="col-12 row" hidden> <!-- Personal Information: -->
                    <h6 class="col-12"><center><b>Personal Information</b></center></h6>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">ID Category</label>
                        <select name="idcategory" class="form-control regis_form" >
                        <option value="<?php echo $idcategory; ?>" hidden><?php echo $idcategory; ?></option>
                        <option value="N/A">N/A</option>
                        <option value="01_PRC_number">PRC Number</option>
                        <option value="02_OSCA_number">OSCA Number</option>
                        <option value="03_Facility_ID_number">Facility ID Number</option>
                        <option value="04_Other_ID">Other ID</option>
                        <option value="00_UNKNOWN">UNKNOWN</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">ID Number</label>
                        <input type="text" class="form-control regis_form" name="idnumber"  value="<?php echo $idnumber; ?>">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">PhilHealth ID</label>
                        <input type="text" class="form-control regis_form" name="phid" value="<?php echo $phid; ?>">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">PWD ID</label>
                        <input type="text" class="form-control regis_form" name="pwdid" value="<?php echo $pwdid; ?>">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Civil Status</label>
                        <select name="civil_status" class="form-control regis_form" >
                        <option value="<?php echo $civil_status; ?>" hidden><?php echo $civil_status; ?></option>
                        <option value="N/A">N/A</option>
                        <option value="01_Single">Single</option>
                        <option value="02_Married">Married</option>
                        <option value="03_Widow/Widower">Widow/Widower</option>
                        <option value="04_Separated/Annulled">Separated/Annulled</option>
                        <option value="05_Living_with_Partner">Living with Partner</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Employment Status</label>
                        <select name="employment_status" class="form-control regis_form" >
                        <option value="<?php echo $employment_status; ?>" hidden><?php echo $employment_status; ?></option>
                        <option value="N/A">N/A</option>
                        <option value="01_Government_Employed">Government Employed</option>
                        <option value="02_Private_Employed">Private Employed</option>
                        <option value="03_Self_employed">Self Employed</option>
                        <option value="04_Private_practitioner">Private Practitioner</option>
                        <option value="05_Others">Other</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Agency</label>
                        <input type="text" class="form-control regis_form" name="agency"   value="<?php echo $agency; ?>">
                    </div>
                </div>

                <div class="col-12 row" hidden><!-- Allergy: -->
                    <h6 class="col-12"><center><b>Allergy and Bleeding</b></center></h6>
                    <div class="form-group col-sm-3">
                        <label for="exampleInputEmail1">Has no allergies to PEG or polysorbate?</label>
                        <select name="allergies_to_PEG" class="form-control regis_form" >
                            <option value="<?php echo $allergies_to_PEG; ?>" hidden><?php echo $allergies_to_PEG; ?></option>
                            <option value="N/A">N/A</option>
                            <option value="01_Yes">Yes</option>
                            <option value="02_No">No</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-3">
                        <label for="exampleInputEmail1">Allergy</label>
                        <input type="text" class="form-control regis_form" name="allergy" value="<?php echo $allergy; ?>" list="no_selection">
                    </div>

                    <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Has no history of bleeding disorders or currently taking anti-coagulants?</label>
                        <select name="bleeding_disorders" class="form-control regis_form" >
                            <option value="<?php echo $bleeding_disorders; ?>" hidden><?php echo $bleeding_disorders; ?></option>
                            <option value="N/A" >N/A</option>
                            <option value="01_Yes">Yes</option>
                            <option value="02_No">No</option>
                        </select>
                    </div>

                    
                </div>
                
                <div class="col-12 row"><!-- Covid Exposure ann Recent Vaccine Information: -->
                    <div class="col-6 row" hidden>
                        <h6 class="col-12"><center><b>Covid Exposure</b></center></h6>
                        <div class="form-group col-sm-6">
                            <select name="covid_exposure" class="form-control regis_form" >
                                <option value="<?php echo $covid_exposure; ?>" hidden><?php echo $covid_exposure; ?></option>
                                <option value="N/A">N/A</option>
                                <option value="01_Yes">Yes</option>
                                <option value="02_No">No</option>
                            </select>
                            <label for="exampleInputEmail1">Has no history of exposure to a confirmed or suspected COVID-19 case in the past 2 weeks?</label>
                        </div>

                        <div class="form-group col-sm-6">
                            <select name="covid_status" class="form-control regis_form" >
                                <option value="<?php echo $covid_status; ?>" hidden><?php echo $covid_status; ?></option>
                                <option value="N/A">N/A</option>
                                <option value="01_Yes">Yes</option>
                                <option value="02_No">No</option>
                            </select>
                            <label for="exampleInputEmail1">Has not been previously treated for COVID-19 in the past 90 days?</label>
                        </div>
                    </div>
                    <div class="col-6 row" hidden>
                        <h6 class="col-12"><center><b>Recent Vaccine Information</b></center></h6>
                        <div class="form-group col-sm-6">
                            <select name="if_receive_vaccine" class="form-control regis_form" >
                                <option value="<?php echo $if_receive_vaccine; ?>" hidden><?php echo $if_receive_vaccine; ?></option>
                                <option value="N/A">N/A</option>
                                <option value="01_Yes">Yes</option>
                                <option value="02_No">No</option>
                            </select>
                            <label for="exampleInputEmail1">Has not received any vaccine in the past 2 weeks?</label>
                        </div>

                        <div class="form-group col-sm-6">
                            <select name="convalescent" class="form-control regis_form" >
                                <option value="<?php echo $convalescent; ?>" hidden><?php echo $convalescent; ?></option>
                                <option value="N/A">N/A</option>
                                <option value="01_Yes">Yes</option>
                                <option value="02_No">No</option>
                            </select>
                            <label for="exampleInputEmail1">Has not received convalescent plasma or monoclonal antibodies for COVID-19 in the past 90 days?</label>
                        </div>
                    </div>
                </div>
                <div class="row col-12" hidden>

                    <div class="col-6 row"><!-- Pregnant: -->
                        <h6 class="col-12"><center><b>Pregnant</b></center></h6>
                        <div class="form-group col-sm-6">
                            <select name="pregnant" class="form-control regis_form" >
                                <option value="<?php echo $pregnant; ?>" hidden><?php echo $pregnant; ?></option>
                                <option value="N/A">N/A</option>
                                <option value="01_Yes">Yes</option>
                                <option value="02_No">No</option>
                            </select>
                            <label for="exampleInputEmail1">Not Pregnant?</label>
                        </div>

                        <div class="form-group col-sm-6">
                            <select name="if_pregnant" class="form-control regis_form" >
                                <option value="<?php echo $if_pregnant; ?>" hidden><?php echo $if_pregnant; ?></option>
                                <option value="N/A" >N/A</option>
                                <option value="01_Yes">Yes</option>
                                <option value="02_No">No</option>
                            </select>
                            <label for="exampleInputEmail1">If pregnant, 2nd or 3rd Trimester?<br><Br><Br><br><br></label>
                        </div>
                    </div>

                    <div class="col-6 row"><!-- Comorbidity: -->
                        <h6 class="col-12"><center><b>Comorbidity</b></center></h6>
                        <div class="form-group col-sm-6">
                            <input type="text" class="form-control regis_form" name="comorbidity" value="<?php echo $comorbidity; ?>" list="no_selection">
                            <label for="exampleInputEmail1">Does not have any of the following: HIV, Cancer/ Malignancy, Underwent Transplant, Under Steroid Medication/ Treatment, Bed Ridden, terminal illness, less than 6 months prognosis?</label>
                        </div>

                        <div class="form-group col-sm-6">
                            <select name="medical_clearance" class="form-control regis_form" >
                                <option value="<?php echo $medical_clearance; ?>" hidden><?php echo $medical_clearance; ?></option>
                                <option value="N/A" >N/A</option>
                                <option value="01_Yes">Yes</option>
                                <option value="02_No">No</option>
                            </select>
                            <label for="exampleInputEmail1">If with mentioned condition, has presented medical clearance prior to vaccination day?</label>
                        </div>
                    </div>
                </div>

                <div class="col-12 row"><!-- Deferral: -->
    

                    <div class="form-group col-sm-6" hidden>
                        <label for="exampleInputEmail1">Adverse Event</label>
                        <select name="adverse_event" class="form-control regis_form" >
                            <option value="<?php echo $adverse_event; ?>" hidden><?php echo $adverse_event; ?></option>
                            <option value="01_Yes">01_Yes</option>
                            <option value="02_No">02_No</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-6" hidden>
                        <label for="exampleInputEmail1">Adverse Event Condition</label>
                        <select name="adverse_event_cons" class="form-control regis_form" >
                            <option value="<?php echo $adverse_event_cons; ?>" hidden><?php echo $adverse_event_cons; ?></option>
                            <option value="02_No">02_No</option>
                            <?php foreach($Global_adverse_event_condition as $data){ ?>
                                <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                            <?php } ?>
                        </select>
                    </div>

                    <h6 class="col-12" hidden><center><b>Deferral</b></center></h6>
                    <div class="form-group col-sm-12" hidden>
                        <select name="defferal" class="form-control regis_form" >
                        <option value="<?php echo $defferal; ?>" hidden><?php echo $defferal; ?></option>
                            <option value="N/A">N/A</option>
                            
                            <?php foreach($Global_reasons_for_not_FIT as $data){ ?>
                                <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-12 row"><!-- Vaccination: -->
                    <h6 class="col-12"><center><b>Vaccination</b></center></h6>
                    <div class="form-group col-sm-3">
                        <input type="date" class="form-control regis_form bg-info" name="date_of_vaccination" value="<?php echo $date_added; ?>">
                        <label for="exampleInputEmail1">Date of Vaccination?<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Petsa ng Pagbabakuna?)</span></label>
                    </div>

                    <div class="form-group col-sm-3">
                        <select id="select_vaccine" name="vaccine_name" class="form-control bg-info"  >  
                        <option value="<?php echo $vaccine_name; ?>" hidden><?php echo $vaccine_name; ?></option>
                            <option value="N/A">N/A</option>
                            <?php foreach($Global_vaccine_name as $data){ ?>
                                <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                            <?php } ?>
                        </select>
                        <label for="exampleInputEmail1">Vaccine Manufacturer Name<span style="color:red;">*</span></label>
                    </div>

                    <div class="form-group col-sm-3">
                        <input type="text" class="form-control regis_form" name="batch_number"   value="<?php echo $batch_number; ?>">
                        <label for="exampleInputEmail1">Batch Number?<span style="color:red;">*</span></label>
                    </div>

                    <div class="form-group col-sm-3">
                        <input type="text" class="form-control regis_form" name="lot_number"   value="<?php echo $lot_number; ?>">
                        <label for="exampleInputEmail1">Lot Number?<span style="color:red;">*</span></label>
                    </div>

                    <div class="form-group col-sm-3">
			<input type="text" class="form-control regis_form" name="vaccinator_name"  value="<?php echo $vaccinator_name; ?>">
                        <label for="exampleInputEmail1">Vaccinator Name?<span style="color:red;">*</span></label>
                    </div>

      

                    <div class="form-group col-sm-3" hidden>
                        <input type="text" class="form-control regis_form" name="prof_vaccinator"   value="<?php echo $prof_vaccinator; ?>">
                        <label for="exampleInputEmail1">Profession of Vaccinator?<span style="color:red;">*</span></label>
                    </div>

                    <div class="form-group col-sm-3">
                        <select name="dose_1" class="form-control regis_form bg-info" >
                            <option value="<?php echo $dose_1; ?>" hidden><?php echo $dose_1; ?></option>
                            <option value="N/A">N/A</option>
                            <option value="01_Yes">Yes</option>
                            <option value="02_No">No</option>
                        </select>
                        <label for="exampleInputEmail1">1st Dose?<span style="color:red;">*</span></label>
                    </div>

                    <div class="form-group col-sm-3">
                        <select name="dose_2" class="form-control regis_form bg-info" >
                            <option value="<?php echo $dose_2; ?>" hidden><?php echo $dose_2; ?></option>
                            <option value="N/A">N/A</option>
                            <option value="01_Yes">Yes</option>
                            <option value="02_No">No</option>
                        </select>
                        <label for="exampleInputEmail1">2nd Dose?<span style="color:red;">*</span></label>
                    </div>

                    <div class="form-group col-sm-3">
                        <select name="booster" class="form-control regis_form bg-info" >
                            <option value="<?php echo $booster; ?>" hidden><?php echo $booster; ?></option>
                            <option value="N/A">N/A</option>
                            <option value="01_Yes">Yes</option>
                            <option value="02_No">No</option>
                        </select>
                        <label for="exampleInputEmail1">Booster Dose?<span style="color:red;">*</span></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card" style="background-color:rgb(193, 219, 189)" hidden>
            <div class="col-12 row  pr-3 pl-3">
                <center class="col-12"><h4><u>Post Monitoring</u></h4></center>
                <div class="form-group col-sm-4">
                    <select name="if_severe_allergic" class="form-control regis_form" >
                        <option value="<?php echo $if_severe_allergic; ?>" hidden><?php echo $if_severe_allergic; ?></option>
                        <option value="N/A">N/A</option>
                        <option value="01_Yes">Yes</option>
                        <option value="02_No">No</option>
                    </select>
                    <label for="exampleInputEmail1">Has no severe allergic reaction after the 1st dose of the vaccine?</label>
                </div>

                <div class="form-group col-sm-4">
                    <select name="if_allergy" class="form-control regis_form" >
                        <option value="<?php echo $if_allergy; ?>" hidden><?php echo $if_allergy; ?></option>
                        <option value="N/A">N/A</option>
                        <option value="01_Yes">Yes</option>
                        <option value="02_No">No</option>
                    </select>
                    <label for="exampleInputEmail1">If with allergy or asthma, will the vaccinator able to monitor the patient for 30 minutes?</label>
                </div>

                <div class="form-group col-sm-4">
                    <select name="if_bleeding" class="form-control regis_form" >
                        <option value="<?php echo $if_bleeding; ?>" hidden><?php echo $if_bleeding; ?></option>
                        <option value="N/A">N/A</option>
                        <option value="01_Yes">Yes</option>
                        <option value="02_No">No</option>
                    </select>
                    <label for="exampleInputEmail1">If with bleeding history, is a gauge 23 - 25 syringe available for injection?</label>
                </div>

                <div class="form-group col-sm-12">
                    <input type="text" class="form-control regis_form" name="symtoms" value="<?php echo $symtoms; ?>" list="no_selection">
                    <label for="exampleInputEmail1">Does not manifest any of the following symptoms: Fever/chills, Headache, Cough, Colds, Sore throat,  Myalgia, Fatigue, Weakness, Loss of smell/taste, Diarrhea, Shortness of breath/ difficulty in breathing</label>
                </div>
            </div>
        </div>
    </form> 
</div>
<div class="modal-footer justify-content-between p-1">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="button" class="btn btn-info text-white col-3 offset-6 text-center" onclick="set_system_cardinal_operation('You want to update this registrant information?', 'update', 'update_form', 'update.php', 'update_result', 'none', 'none', '_div_add_survey', 'confirmation_update_success', 'none')">Update</button>
</div>

<datalist id="no_selection">
    <option value="02_No">02_No</option>
</datalist>