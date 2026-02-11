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
    $city = "_64517_LA_CASTELLANA";

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
              <button type="button" class="btn btn-block btn-outline-secondary col-lg-2" data-toggle="modal" data-target="#create_user">Add New Registrant</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <input type="file" id="profile" hidden>
                <div class="form-group col-lg-6 offset-3">
                    <br>
                    <Br>
                    <Br><br>
                    <form class="input-group mb-3">
                        <input type="text" class="form-control col-10" name="search_keyword" placeholder="Search By Last Name, First Name or Middle Name">
                        <!-- <input type="text" class="form-control col-10" name="search_keyword" placeholder="Search By Last Name, First Name or Middle Name" oninput="show_table('registrants_table', 'show_registered', '#example1', this.value)"> -->
                        <div class="input-group-prepend col-2">
                            <button type="button" class="btn btn-warning col-12" onclick="show_table('registrants_table', 'show_registered', '#example1', search_keyword.value)"><i class="fas fa-search"></i>Search</button>
                        </div>
                    </form>
                    <?php if($_SESSION["user_id"] == "49" || $_SESSION["user_access_level"] == "14"){ ?>
                        <form class="input-group mb-3">
                            <label class="col-12">Deep Search</label>
                            <input type="text" class="form-control col-4" name="search_firstname" placeholder="First Name">
                            <input type="text" class="form-control col-4" name="search_lastname" placeholder="Last Name">
                            <!-- <input type="text" class="form-control col-10" name="search_keyword" placeholder="Search By Last Name, First Name or Middle Name" oninput="show_table('registrants_table', 'show_registered', '#example1', this.value)"> -->
                            <div class="input-group-prepend col-4">
                                <button type="button" class="btn btn-danger col-12" onclick="show_table('registrants_table', 'show_deep_search', '#example1', search_firstname.value+'code404'+search_lastname.value)"><i class="fas fa-search"></i>Deep Search</button>
                            </div>
                        </form><?php 
                    } ?>
                    <!-- <center class="mt-3 mb-3">
                        <i class="fas fa-qrcode fa-5x"></i>
                        <i class="fas fa-users fa-5x"></i>
                    </center>
                    <p class="p-0 m-0"><Center>Search the registrants by there lastname or firstname or middlename or QR code!</center></p> -->
                </div>
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

    
    <div class="modal fade" id="delete_edit">
        <div class="modal-dialog modal-sm" style="overflow-y: initial !important">
            <div class="modal-content" id="veiw_result_edit_delete">
                
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="create_user">
        <div class="modal-dialog modal-xl" style="overflow-y: initial !important">
            <div class="modal-content">
                <div class="modal-header p-1">
                    <h5 class="modal-title">Add New Registrant</h5>
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
                    <div class="modal-body p-2 m-0" style=" height: 70vh;  overflow-y: auto;" >

                        <div class="card" style="background-color:rgb(237, 240, 238)">
                            <div class="col-12 row pr-3 pl-3">
                                <center class="col-12"><h4><u>Profiling</u></h4></center>
                                <h6 class="col-12"><center><b>Personal Information</b></center></h6>
                                <div class="form-group col-12">
                                    <label for="exampleInputEmail1">Category</label>
                                    <select name="employmentcategory" class="form-control regis_form bg-info" alt="required" required onchange="select_conditionalV2('sub_category1', this.value, 'array', 'array', 'array', 'select_sub_category_by_category', 'array')">
                               
                                        <?php foreach($Global_category_array as $data){ 
                                            
                                            $data_array = explode(":",$data);?>
                                            <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                                        <?php 
                                        } ?>
                                    </select>
                                </div>

                                <div class="form-group col-sm-6" hidden>
                                    <label for="exampleInputEmail1">Sub-Category</label>
                                    <select name="sub_category" id="sub_category1" class="form-control regis_form" >
                                    <option value="N/A" >N/A</option>
                                    <?php foreach($Global_sub_category_array as $data){  ?>
                                        <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>



                                <div class="form-group col-sm-4">
                                    <label for="exampleInputEmail1">Last Name</label>
                                    <input type="text" class="form-control regis_form" name="lastname" id="lastname">
                                </div>

                                <div class="form-group col-sm-3">
                                    <label for="exampleInputEmail1">First Name</label>
                                    <input type="text" class="form-control regis_form" name="firstname" id="lastname">
                                </div>

                                <div class="form-group col-sm-3">
                                    <label for="exampleInputEmail1">Middle Name</label>
                                    <input type="text" class="form-control regis_form" name="middlename" id="lastname"  value="N/A">
                                </div>

                                <div class="form-group col-sm-2">
                                    <label for="exampleInputEmail1">Suffix</label>
                                    <select name="suffix" class="form-control regis_form">
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
                                    <input type="text" class="form-control regis_form" name="current_residence"  value="N/A"> 
                                </div>

                                <div class="form-group col-sm-3">
                                    <label for="exampleInputEmail1">Region</label>
                                    <select name="region" class="form-control regis_form" alt="required" required onchange="select_conditionalV2('province12', this.value, 'array', 'array', 'array', 'select_province', 'array')">
                                        <option value="<?php echo $region; ?>" hidden><?php echo $region; ?></option>
                                        <option value="N/A">N/A</option>
                                        <?php foreach($Global_regions as $data){   ?>
                                        <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group col-sm-3">
                                    <label for="exampleInputEmail1">Province</label>
                                    <select name="province" id="province12" class="form-control regis_form" alt="required" required onchange="select_conditionalV2('city12', this.value, 'array', 'array', 'array', 'select_city', 'array')">
                                        <option value="<?php echo $province; ?>" hidden><?php echo $province; ?></option><?php 

                                        $selection_value = $region;                     
                                        $selection_value = str_replace("_","c*t",$selection_value);
                                        $selection_value = explode('c*t', $selection_value);
                                        $k = 0;
                                        echo "<option value='Empty' hidden> </option>";
                                        foreach($Global_province as $data){  
                                            $data_o = str_replace("_","c*t",$data);
                                            $data_o = explode('c*t', $data_o);
                                            
                                            if(substr($data_o[1], 0, 2) == $selection_value[0]){ $k++;?>
                                            <option value="<?php echo $data; ?>"><?php echo $data; ?></option> <?php 
                                            }
                                        } ?>
                                    </select>
                                </div>

                                <div class="form-group col-sm-3">
                                    <label for="exampleInputEmail1">City/Municipality</label>
                                    <select name="city" id="city12" class="form-control regis_form" alt="required" required onchange="select_conditionalV2('brgy12', this.value, 'array', 'array', 'array', 'select_brgy', 'array')">
                                        <option value="<?php echo $city; ?>" hidden><?php echo $city; ?></option><?php
                                        
                                        $selection_value = $province;
                                        $selection_value = str_replace("_","c*t",$selection_value);
                                        $selection_value = explode('c*t', $selection_value);
                                        if($selection_value[1][0] == 0){
                                            $selection_value = substr($selection_value[1], 1);
                                        }else{
                                            $selection_value = $selection_value[1];
                                        }
                                        $k = 0;
                                        echo "<option value='Empty' hidden> </option>";
                                        foreach($Global_city as $data){  
                                            $data_o = str_replace("_","c*t",$data);
                                            $data_o = explode('c*t', $data_o);
                                
                                            if(substr($data_o[1], 0, 3) == $selection_value){ $k++;?>
                                            <option value="<?php echo $data; ?>"><?php echo $data; ?></option> <?php 
                                            }
                                        }?>
                                    </select>
                                </div>

                                <div class="form-group col-sm-3">
                                    <label for="exampleInputEmail1">Barangay</label>
                                    <select name="brgy" id="brgy12" class="form-control regis_form bg-info" alt="required" required>
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

                                <div class="form-group col-sm-3" hidden>
                                    <label for="exampleInputEmail1">Occupation</label>
                                    <input type="text" class="form-control regis_form" name="occupation" value="N/A">
                                </div>

                                <div class="form-group col-sm-4">
                                    <label  for="exampleInputEmail1">Mobile Number</label>
                                    <input type="text" class="form-control regis_form" name="contact"  value="N/A">
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="exampleInputEmail1">Gender</label>
                                    <select name="gender" class="form-control regis_form" >
                                    <option value="N/A">N/A</option>
                                    <option value="02_Male">Male</option>
                                    <option value="01_Female">Female</option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-4">
                                    <label for="exampleInputEmail1">Birthday</label>
                                    <input type="date" class="form-control regis_form  bg-info" name="bday" alt="required">
                                </div>

                                <div class="form-group col-sm-6" hidden>
                                    <label for="exampleInputEmail1">Allergy to vaccines or Components of vaccines?</label>
                                    <select name="allergy_to_vaccine" class="form-control regis_form">
                                        <option value="N/A">N/A</option>
                                        <option value="01_Yes">Yes</option>
                                        <option value="02_No">No</option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-6" hidden>
                                    <label for="exampleInputEmail1">With Comorbidity?</label>
                                    <select name="profile_comorbidity" class="form-control regis_form">
                                        <option value="N/A">N/A</option>
                                        <option value="01_Yes">Yes</option>
                                        <option value="02_None">None</option>
                                    </select>
                                </div>

                                
                                <h6 class="col-12" hidden><center><b>Consent</b></center></h6>

                                <div class="form-group col-sm-6" hidden>
                                    <label for="exampleInputEmail1">Consent</label>
                                    <select name="consent" class="form-control regis_form" >
                                        <option value="01_Yes">Yes</option>
                                        <option value="02_No">No</option>
                                    </select>
                                    
                                </div>

                                <div class="form-group col-sm-6" hidden>
                                    <label for="exampleInputEmail1">Reason for Refusal</label>
                                    <select name="reason_refusal" class="form-control regis_form" >
                                        <option value="N/A" >N/A</option>
                                        <?php foreach($Global_refusal as $data){ ?>
                                            <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">Indigenous Member</label>
                                    <input type="text" class="form-control regis_form" name="indigenous" value="02_No">
                                </div>

                                <div class="form-group col-sm-6">
                                    <label for="exampleInputEmail1">PWD</label>
                                    <select name="pwd" class="form-control regis_form" >
                                    <option value="02_No" hidden>02_No</option>
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
                                        <input type="text" class="form-control regis_form" name="guardian" value="N/A">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="exampleInputEmail1">Pedia Comorbidity</label>
                                        <input type="text" class="form-control regis_form" name="ped_comorbid" value="N/A">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card" style="background-color:rgb(239, 240, 206)">
                            <div class="col-12 row  pr-3 pl-3">
                                <center class="col-12"><h5><u>Vaccination Details</u></h5></center>
                                <div class="col-12 row"> <!-- Personal Information: -->
                                    <h6 class="col-12" hidden><center><b>Personal Information</b></center></h6>

                                    <div class="form-group col-sm-6" hidden>
                                        <label for="exampleInputEmail1">ID Category</label>
                                        <select name="idcategory" class="form-control regis_form" >
                                        <option value="N/A" >N/A</option>
                                        <option value="01_PRC_number">PRC Number</option>
                                        <option value="02_OSCA_number">OSCA Number</option>
                                        <option value="03_Facility_ID_number">Facility ID Number</option>
                                        <option value="04_Other_ID">Other ID</option>
                                        <option value="00_UNKNOWN">UNKNOWN</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-sm-6" hidden>
                                        <label for="exampleInputEmail1">ID Number</label>
                                        <input type="text" class="form-control regis_form" name="idnumber" value="N/A">
                                    </div>

                                    <div class="form-group col-sm-6" hidden>
                                        <label for="exampleInputEmail1">PhilHealth ID</label>
                                        <input type="text" class="form-control regis_form" name="phid" value="N/A">
                                    </div>

                                    <div class="form-group col-sm-6" hidden>
                                        <label for="exampleInputEmail1">PWD ID</label>
                                        <input type="text" class="form-control regis_form" name="pwdid" value="N/A">
                                    </div>

                                    <div class="form-group col-sm-6" hidden>
                                        <label for="exampleInputEmail1">Civil Status</label>
                                        <select name="civil_status" class="form-control regis_form" >
                                        <option value="N/A" >N/A</option>
                                        <option value="01_Single">Single</option>
                                        <option value="02_Married">Married</option>
                                        <option value="03_Widow/Widower">Widow/Widower</option>
                                        <option value="04_Separated/Annulled">Separated/Annulled</option>
                                        <option value="05_Living_with_Partner">Living with Partner</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-sm-6" hidden>
                                        <label for="exampleInputEmail1">Employment Status</label>
                                        <select name="employment_status" class="form-control regis_form" >
                                        <option value="N/A" >N/A</option>
                                        <option value="01_Government_Employed">Government Employed</option>
                                        <option value="02_Private_Employed">Private Employed</option>
                                        <option value="03_Self_employed">Self Employed</option>
                                        <option value="04_Private_practitioner">Private Practitioner</option>
                                        <option value="05_Others">Other</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-sm-6" hidden>
                                        <label for="exampleInputEmail1">Agency</label>
                                        <input type="text" class="form-control regis_form" name="agency" value="N/A">
                                    </div>
                                </div>

                                <div class="col-12 row"  hidden><!-- Allergy: -->
                                    <h6 class="col-12"><center><b>Allergy and Bleeding</b></center></h6>
                                    <div class="form-group col-sm-3">
                                        <label for="exampleInputEmail1">Has no allergies to PEG or polysorbate?</label>
                                        <select name="allergies_to_PEG" class="form-control regis_form" >
                                            <option value="N/A">N/A</option>
                                            <option value="01_Yes">Yes</option>
                                            <option value="02_No">No</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-sm-3">
                                        <label for="exampleInputEmail1">Allergy</label>
                                        <input type="text" class="form-control regis_form" name="allergy" list="no_selection" value="N/A">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label for="exampleInputEmail1">Has no history of bleeding disorders or currently taking anti-coagulants?</label>
                                        <select name="bleeding_disorders" class="form-control regis_form" >
                                            <option value="N/A" >N/A</option>
                                            <option value="01_Yes">Yes</option>
                                            <option value="02_No">No</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-12 row" hidden><!-- Covid Exposure ann Recent Vaccine Information: -->
                                    <div class="col-6 row">
                                        <h6 class="col-12"><center><b>Covid Exposure</b></center></h6>
                                        <div class="form-group col-sm-6">
                                            <select name="covid_exposure" class="form-control regis_form" >
                                                <option value="N/A">N/A</option>
                                                <option value="01_Yes">Yes</option>
                                                <option value="02_No">No</option>
                                            </select>
                                            <label for="exampleInputEmail1">Has no history of exposure to a confirmed or suspected COVID-19 case in the past 2 weeks?</label>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <select name="covid_status" class="form-control regis_form" >
                                                <option value="N/A">N/A</option>
                                                <option value="01_Yes">Yes</option>
                                                <option value="02_No">No</option>
                                            </select>
                                            <label for="exampleInputEmail1">Has not been previously treated for COVID-19 in the past 90 days?</label>
                                        </div>
                                    </div>
                                    <div class="col-6 row">
                                        <h6 class="col-12"><center><b>Recent Vaccine Information</b></center></h6>
                                        <div class="form-group col-sm-6">
                                            <select name="if_receive_vaccine" class="form-control regis_form" >
                                                <option value="N/A">N/A</option>
                                                <option value="01_Yes">Yes</option>
                                                <option value="02_No">No</option>
                                            </select>
                                            <label for="exampleInputEmail1">Has not received any vaccine in the past 2 weeks?</label>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <select name="convalescent" class="form-control regis_form" >
                                                <option value="N/A">N/A</option>
                                                <option value="01_Yes">Yes</option>
                                                <option value="02_No">No</option>
                                            </select>
                                            <label for="exampleInputEmail1">Has not received convalescent plasma or monoclonal antibodies for COVID-19 in the past 90 days?</label>
                                        </div>
                                    </div>

                                </div>

                                <div class="row col-12">
                                    <div class="col-6 row" hidden><!-- Pregnant: -->
                                        <h6 class="col-12"><center><b>Pregnant</b></center></h6>
                                        <div class="form-group col-sm-6">
                                            <select name="pregnant" class="form-control regis_form" >
                                                <option value="N/A">N/A</option>
                                                <option value="01_Yes">Yes</option>
                                                <option value="02_No">No</option>
                                            </select>
                                            <label for="exampleInputEmail1">Not Pregnant?</label>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <select name="if_pregnant" class="form-control regis_form" >
                                                <option value="N/A" >N/A</option>
                                                <option value="01_Yes">Yes</option>
                                                <option value="02_No">No</option>
                                            </select>
                                            <label for="exampleInputEmail1">If pregnant, 2nd or 3rd Trimester?<br><Br><Br><br><br></label>
                                        </div>
                                    </div>

                                    <div class="col-6 row" hidden><!-- Comorbidity: -->
                                        <h6 class="col-12"><center><b>Comorbidity</b></center></h6>
                                        <div class="form-group col-sm-6">
                                            <input type="text" class="form-control regis_form" name="comorbidity" list="no_selection" value="N/A">
                                            <label for="exampleInputEmail1">Does not have any of the following: HIV, Cancer/ Malignancy, Underwent Transplant, Under Steroid Medication/ Treatment, Bed Ridden, terminal illness, less than 6 months prognosis?</label>
                                        </div>

                                        <div class="form-group col-sm-6">
                                            <select name="medical_clearance" class="form-control regis_form" >
                                                <option value="N/A" >N/A</option>
                                                <option value="01_Yes">Yes</option>
                                                <option value="02_No">No</option>
                                            </select>
                                            <label for="exampleInputEmail1">If with mentioned condition, has presented medical clearance prior to vaccination day?</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-sm-6" hidden>
                                    <label for="exampleInputEmail1">Adverse Event</label>
                                    <select name="adverse_event" class="form-control regis_form" >
                                    <option value="02_No" hidden>02_No</option>
                                    <option value="01_Yes">01_Yes</option>
                                    <option value="02_No">02_No</option>
                                    </select>
                                </div>

                                <div class="form-group col-sm-6" hidden>
                                    <label for="exampleInputEmail1">Adverse Event Condition</label>
                                    <select name="adverse_event_cons" class="form-control regis_form" >
                                    <option value="02_No">02_No</option>
                                    <?php foreach($Global_adverse_event_condition as $data){ ?>
                                        <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                                    <?php } ?>
                                    </select>
                                </div>

                                <div class="col-12 row" hidden><!-- Deferral: -->
                                    <h6 class="col-12"><center><b>Deferral</b></center></h6>
                                    <div class="form-group col-sm-12">
                                        <select name="defferal" class="form-control regis_form" >
                                        <option value="02_No">02_No</option>
                                            <?php foreach($Global_reasons_for_not_FIT as $data){ ?>
                                                <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12 row"><!-- Vaccination: -->
                                    <h6 class="col-12" hidden><center><b>Vaccination Details</b></center></h6>

                                    <!-- 1st vaccine start -->
                                    <div class="form-group col-sm-3">
                                        <input type="date" class="form-control regis_form  bg-info" name="date_of_vaccination" alt="required">
                                        <label for="exampleInputEmail1">Date of Vaccination 1st Dose?<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Petsa ng Pagbabakuna 1st dosis?)</span></label>
                                    </div>

                                    <div class="form-group col-sm-3">
                                        <select id="select_vaccine" name="vaccine_name" class="form-control bg-info"  >  
                                        <option value="N/A" >N/A</option>
                                            <?php foreach($Global_vaccine_name as $data){?>
                                                <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                                            <?php 
                                            }?>
                                        </select>
                                        <label for="exampleInputEmail1">Vaccine Manufacturer Name<span style="color:red;">*</span></label>
                                    </div>

                                    <div class="form-group col-sm-3">
                                        <input type="text" class="form-control regis_form" name="batch_number" value="N/A" >
                                        <label for="exampleInputEmail1">Batch Number?<span style="color:red;">*</span></label>
                                    </div>

                                    <div class="form-group col-sm-3">
                                        <input type="text" class="form-control regis_form" name="lot_number" value="N/A" >
                                        <label for="exampleInputEmail1">Lot Number?<span style="color:red;">*</span></label>
                                    </div>
                                    <!-- 1st vaccine end -->

                                     <!-- 2nd vaccine start -->
                                    <div class="form-group col-sm-3">
                                        <input type="date" class="form-control regis_form  bg-info" name="sec_date_of_vaccination" alt="required">
                                        <label for="exampleInputEmail1">Date of Vaccination 2nd Dose?<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Petsa ng Pagbabakuna 2nd dosis?)</span></label>
                                    </div>

                                    <div class="form-group col-sm-3">
                                        <select id="select_vaccine" name="sec_vaccine_name" class="form-control bg-info"  >  
                                        <option value="N/A" >N/A</option>
                                            <?php foreach($Global_vaccine_name as $data){?>
                                                <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                                            <?php 
                                            }?>
                                        </select>
                                        <label for="exampleInputEmail1">Vaccine Manufacturer Name<span style="color:red;">*</span></label>
                                    </div>

                                    <div class="form-group col-sm-3">
                                        <input type="text" class="form-control regis_form" name="sec_batch_number" value="N/A" >
                                        <label for="exampleInputEmail1">Batch Number?<span style="color:red;">*</span></label>
                                    </div>

                                    <div class="form-group col-sm-3">
                                        <input type="text" class="form-control regis_form" name="sec_lot_number" value="N/A" >
                                        <label for="exampleInputEmail1">Lot Number?<span style="color:red;">*</span></label>
                                    </div>
                                    <!-- 2nd vaccine end -->

                                    <div class="form-group col-sm-3">
                                        <input type="text" class="form-control regis_form" name="vaccinator_name" value="N/A" >
                                        <label for="exampleInputEmail1">Vaccinator Name?<span style="color:red;">*</span></label>
                                    </div>
                                    

                                    <div class="form-group col-sm-3" hidden>
                                        <input type="text" class="form-control regis_form" name="prof_vaccinator" value="N/A">
                                        <label for="exampleInputEmail1">Profession of Vaccinator?<span style="color:red;">*</span></label>
                                    </div>

                                    <div class="form-group col-sm-3">
                                        <select name="dose_1" class="form-control regis_form bg-info" >
                                        <option value="N/A" >N/A</option>
                                            <option value="01_Yes">Yes</option>
                                            <option value="02_No">No</option>
                                        </select>
                                        <label for="exampleInputEmail1">1st Dose?<span style="color:red;">*</span></label>
                                    </div>

                                    <div class="form-group col-sm-3">
                                        <select name="dose_2" class="form-control regis_form bg-info" >
                                        <option value="N/A" >N/A</option>
                                            <option value="01_Yes">Yes</option>
                                            <option value="02_No">No</option>
                                        </select>
                                        <label for="exampleInputEmail1">2nd Dose?<span style="color:red;">*</span></label>
                                    </div>

                                    <div class="form-group col-sm-3">
                                        <select name="booster" class="form-control regis_form bg-info" >
                                        <option value="N/A" >N/A</option>
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
                                    <option value="N/A" >N/A</option>
                                        <option value="01_Yes">Yes</option>
                                        <option value="02_No">No</option>
                                    </select>
                                    <label for="exampleInputEmail1">Has no severe allergic reaction after the 1st dose of the vaccine?</label>
                                </div>

                                <div class="form-group col-sm-4">
                                    <select name="if_allergy" class="form-control regis_form" >
                                        <option value="N/A" >N/A</option>
                                        <option value="01_Yes">Yes</option>
                                        <option value="02_No">No</option>
                                    </select>
                                    <label for="exampleInputEmail1">If with allergy or asthma, will the vaccinator able to monitor the patient for 30 minutes?</label>
                                </div>

                                <div class="form-group col-sm-4">
                                    <select name="if_bleeding" class="form-control regis_form" >
                                        <option value="N/A" >N/A</option>
                                        <option value="01_Yes">Yes</option>
                                        <option value="02_No">No</option>
                                    </select>
                                    <label for="exampleInputEmail1">If with bleeding history, is a gauge 23 - 25 syringe available for injection?</label>
                                </div>

                                <div class="form-group col-sm-12">
                                    <input type="text" class="form-control regis_form" name="symtoms" list="no_selection" value="N/A">
                                    <label for="exampleInputEmail1">Does not manifest any of the following symptoms: Fever/chills, Headache, Cough, Colds, Sore throat,  Myalgia, Fatigue, Weakness, Loss of smell/taste, Diarrhea, Shortness of breath/ difficulty in breathing</label>
                                </div>
                            </div>
                        </div>

                    </div>
                </form> 
                <div class="modal-footer p-1 justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" onclick="set_system_cardinal_operation('You want to Create this new Registrant?', 'create', 'create_form', 'create.php', 'registrants_table', 'show_registered', '#example1', 'required_div', 'confirmation_create_success', 'create_user')" class="btn btn-primary">Submit</button>                           
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
        // show_table("registrants_table", "show_search", "#example1");

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


