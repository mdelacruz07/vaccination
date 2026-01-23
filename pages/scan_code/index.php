<?php 
  include '../../controller/systemcore.php'; 
  $systemcore = new systemcore();
  // $qr_id = $_GET["id"];
  // $qr_id = preg_replace('/[^A-Za-z0-9\-]/', '', $qr_id);


// $cookie_name = "OVRM_QR_ID";
// $cookie_name_1 = "OVRM_QR_NAME";
// if(isset($_COOKIE[$cookie_name])) {
//   if($_COOKIE[$cookie_name] == $qr_id){
//     header("Location: schedule.php?qr_id='".$qr_id."'");  ///if cookies is equal to qr
//   }else{
//     // if cookies is not equal to qr
//   }
// } else {
//   if(count($_COOKIE) > 0) {
//     if(isset($qr_id)){
//       header("Location: schedule.php?qr_id='".$qr_id."'");
//       // echo "no cookies but has QR";
//     }else{
//       // echo "QR cant find disabled. redirect";
//       header("Location: http://bagocho.pagenet.info/");
//     }
//   } else {
//     // echo "Cookies are disabled. redirect";
//     header("Location: http://bagocho.pagenet.info/");
//   }
// }



  // echo $qr_id;
  $SelectGroups = $systemcore->SelectCustomize("SELECT vaccine_schedule.*, 
  system_facilities.facility_name as facility_name,
  system_facilities.location as facility_location, 
  system_facilities.iframe_location as facility_iframe,

  system_vaccines.vaccine_name as vaccine_name,
  system_vaccines.doses as vaccine_doses,

  system_schedule.year as schedule_year,
  system_schedule.schedule_name as schedule_name,
  system_schedule.time as schedule_time,

  vaccine_registration.employmentcategory as employmentcategory,
  vaccine_registration.idcategory as idcategory,
  vaccine_registration.idnumber as idnumber,
  vaccine_registration.phid as phid,
  vaccine_registration.pwdid as pwdid,
  vaccine_registration.lastname as lastname,
  vaccine_registration.firstname as firstname,
  vaccine_registration.middlename as middlename,
  vaccine_registration.suffix as suffix,
  vaccine_registration.contact as contact,
  vaccine_registration.gender as gender,
  vaccine_registration.bday as bday,
  vaccine_registration.brgy as brgy,
  vaccine_registration.pregnant as pregnant,
  vaccine_registration.covid_status as covid_status,
  vaccine_registration.covid_exposure as covid_exposure,

  vaccine_allergy.PEG_alergy as PEG_alergy,
  vaccine_allergy.food_alergy as food_alergy,
  vaccine_allergy.drug_alergy as drug_alergy,
  vaccine_allergy.pollen_alergy as pollen_alergy,
  vaccine_allergy.nurse_response as allergy_nurse_response,

  vaccine_medical.lung_disease as lung_disease,
  vaccine_medical.kidney_disease as kidney_disease,
  vaccine_medical.diabetes as diabetes,
  vaccine_medical.transplant as transplant,
  vaccine_medical.leukemia as leukemia,
  vaccine_medical.blood_disease as blood_disease,
  vaccine_medical.heart_disease as heart_disease,
  vaccine_medical.asthma as asthma,
  vaccine_medical.hypertension as hypertension,
  vaccine_medical.cancer_med as cancer_med,
  vaccine_medical.seizure as seizure,
  vaccine_medical.hiv_med as hiv_med,
  vaccine_medical.nurse_response as med_nurse_response

  FROM vaccine_schedule 
  LEFT JOIN system_facilities ON vaccine_schedule.vaccination_facility = system_facilities.id
  LEFT JOIN system_vaccines ON vaccine_schedule.selected_vaccine = system_vaccines.id
  LEFT JOIN system_schedule ON vaccine_schedule.schedule_id = system_schedule.id
  LEFT JOIN vaccine_registration ON vaccine_schedule.qr_id = vaccine_registration.qr_id
  LEFT JOIN vaccine_allergy ON vaccine_schedule.qr_id = vaccine_allergy.qr_id
  LEFT JOIN vaccine_medical ON vaccine_schedule.qr_id = vaccine_medical.qr_id
  WHERE vaccine_schedule.qr_id = '$qr_id'");
  if($SelectGroups != "none"){
      foreach($SelectGroups as $value){
          $facility_name = $value["facility_name"];
          $facility_location = $value["facility_location"];
          $facility_iframe = $value["facility_iframe"];
          $vaccine_name = $value["vaccine_name"];
          $vaccine_doses = $value["vaccine_doses"];
          $schedule_year = $value["schedule_year"];
          $schedule_name = $value["schedule_name"];
          $schedule_time = $value["schedule_time"];

          $employmentcategory = $value["employmentcategory"];
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
        
          $PEG_alergy = $value["PEG_alergy"];
          $food_alergy = $value["food_alergy"];
          $drug_alergy = $value["drug_alergy"];
          $pollen_alergy = $value["pollen_alergy"];
          $nurse_response = $value["allergy_nurse_response"];
        
          $lung_disease = $value["lung_disease"];
          $kidney_disease = $value["kidney_disease"];
          $diabetes = $value["diabetes"];
          $transplant = $value["transplant"];
          $leukemia = $value["leukemia"];
          $blood_disease = $value["blood_disease"];
          $heart_disease = $value["heart_disease"];
          $asthma = $value["asthma"];
          $hypertension = $value["hypertension"];
          $cancer_med = $value["cancer_med"];
          $seizure = $value["seizure"];
          $hiv_med = $value["hiv_med"];
          $nurse_response = $value["med_nurse_response"];


      }
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bago City COVID-19 Contact Tracing & Surveillance: Management, Assesment, Monitoring, Bulletin Application</title> 
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    #overlay {
      position: fixed; /* Sit on top of the page content */
      display: none; /* Hidden by default */
      width: 100%; /* Full width (cover the whole page) */
      height: 100%; /* Full height (cover the whole page) */
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0,0,0,0.5); /* Black background with opacity */
      z-index: 99999; /* Specify a stack order in case you're using a different order for other elements */
      cursor: pointer; /* Add a pointer on hover */
    }
    #confirmation_box {
      z-index: 999999; /* Specify a stack order in case you're using a different order for other elements */
    }
    .btn-custom{
      background-color:white;
      color:rgb(34, 161, 125);
      border:1px solid rgb(34, 161, 125);
    }
    .btn-custom:hover{
      color:white;
      background-color:rgb(34, 161, 125);
    }
    .btn-no{
      background-color:rgb(34, 161, 125);
      color:white;
    }
    .btn-custom2{
      background-color:white;
      color:rgb(34, 161, 125);
      border:1px solid rgb(34, 161, 125);
    }

    #submit-btn{
      display:"none" !important;
    }
  </style>
</head>
<body class="hold-transition login-page"  onload="system_hidden('required_div_add_survey')" style="background-color:rgb(95, 172, 176)!important;">

<div id="overlay"></div>
<br>

<div style="margin:10px; max-width: 700px;">
  <div class="login-logo row text-center">
    <img src="../../dist/img/bago_Logo.png" alt="User Image"  width="120px" height="120px" class="mx-auto d-block">
    <b style="color:white; font-weight: 900;" class="col-sm-12">Bago City COVID-19 Registrant <br> Vaccine Registration Form</b>
    <!-- <span style="color:white; font-weight: 900; margin:0px !important; font-size:20px !important;" class="col-sm-12">( for 18 years old and Above )</span> -->
    <!-- <b style="color:white; font-weight: 900;" class="col-sm-12">Bago City Residents</b> -->
  </div>
  <br>
  <!-- /.login-logo -->
  <div class="card" style="background-color:rgb(217, 255, 255); " >
    <div class="card-body login-card-body" id="survey_result">
      <!-- <p class="login-box-msg">Sign in to start your session</p> -->
                  <!-- This Alert is needed -->
        <div class="alert alert-danger alert-dismissible fade show" id="required_div_add_survey" role="alert">
          <strong>ERROR!</strong> Please Fill in the required Inputs below! <br> <Span style="font-size:14px"> (Mangyaring Punan ang mga kinakailangang Input sa ibaba!)</span>
          <button type="button" class="close" onclick="turn_off_required('required_div_add_survey')" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div> 

        <div id="result_div">

        </div>
        <form id="survey_form" method="post">
        <input type="text" value="<?php echo $qr_id?>" name="qr_id" hidden>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              <center><h4><u>Registrant Vaccination Schedule</u></h4></center>
              <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Vaccination Date</td>
                        <td><b><?php echo $schedule_name; ?></b></td>
                    </tr>
                    <tr>
                        <td>Vaccination Time</td>
                        <td><b><?php echo $schedule_time; ?></b></td>
                    </tr>
                    <tr>
                        <td>Vaccine</td>
                        <td><b><?php echo $vaccine_name; ?></b></td>
                    </tr>
                    <tr>
                        <td>Number of Doses</td>
                        <td><b><?php echo $vaccine_doses; ?></b></td>
                    </tr>
                    <tr>
                        <td>Vaccine Facility and Location</td>
                        <td><b><?php echo $facility_name; ?></b></td>
                    </tr>
                </tbody>
            </table>
            <center><h4><u>Registrant Personal Information</u></h4></center>
            <table class="table table-bordered">
              <tbody>
                  <tr>
                      <td>Last Name</td>
                      <td><b><?php echo $lastname; ?></b></td>
                  </tr>
                  <tr>
                      <td>First Name</td>
                      <td><b><?php echo $firstname; ?></b></td>
                  </tr>
                  <tr>
                      <td>Middle Name</td>
                      <td><b><?php echo $middlename; ?></b></td>
                  </tr>
                  <tr>
                      <td>Suffix</td>
                      <td><b><?php echo $suffix; ?></b></td>
                  </tr>
                  <tr>
                      <td>Mobile Number</td>
                      <td><b><?php echo $contact; ?></b></td>
                  </tr>
                  <tr>
                      <td>Barangay</td>
                      <td><b><?php echo $brgy; ?></b></td>
                  </tr>
                  <tr>
                      <td>Gender</td>
                      <td><b><?php echo $gender; ?></b></td>
                  </tr>
                  <tr>
                      <td>Birthday and Age</td>
                      <td><b><?php echo $bday; ?></b></td>
                  </tr>
                  <tr>
                      <td>Pregnant</td>
                      <td><b><?php echo $pregnant; ?></b></td>
                  </tr>
                  <tr>
                      <td>History of Covid-19 Infection</td>
                      <td><b><?php echo $covid_status; ?></b></td>
                  </tr>
                  <tr>
                      <td >Exposure to confirmed or <br> suspected COVID-19 case</td>
                      <td><b><?php echo $covid_exposure; ?></b></td>
                  </tr>
              </tbody>
            </table> <?php
            if($pregnant == "YES"){ ?>
              <div class="form-group col-sm-12">
                <div class="row pt-2 pb-2">
                  <div class="col-12">
                    <label for="exampleInputEmail1">If pregnant, 2nd or 3rd Trimester<span style="color:red;">*</span><br></label>
                    <input name="if_pregnant" value="3rd Trimester" id="if_pregnant" hidden>
                  </div>
                  <div class="col-12 row">
                    <button type="button" id="if_pregnant_ON" onclick="pick_button('ON','2nd Trimester','if_pregnant',this)" class="btn btn-custom col-6"><b>2nd Trimester</b></button>
                    <button type="button" id="if_pregnant_OFF" onclick="pick_button('OFF','3rd Trimester','if_pregnant',this)" class="btn btn-custom col-6 btn-no"><b>3rd Trimester</b></button>
                  </div>
                </div>
              </div><?php
            }else{ ?>
            <input name="if_pregnant" value="none" hidden><?php
            } ?>


            <div class="form-group col-sm-12">
              <div class="row pt-2 pb-2">
                <div class="col-12">
                  <label for="exampleInputEmail1">Has not received convalescent plasma or monoclonal antibodies for COVID-19 in the past 90 days?<span style="color:red;">*</span></label>
                  <input name="convalescent" value="NO" id="convalescent" hidden>
                </div>
                <div class="col-12 row">
                  <button type="button" id="convalescent_ON" onclick="pick_button('ON','YES','convalescent',this)" class="btn btn-custom col-6"><b>YES</b></button>
                  <button type="button" id="convalescent_OFF" onclick="pick_button('OFF','NO','convalescent',this)" class="btn btn-custom col-6 btn-no"><b>NO</b></button>
                </div>
              </div>
            </div>

            <center><h4><u>Does the Registrant manifest any of the following symptoms</u></h4></center>
            <div class="form-group col-sm-12">
              <div class="row pt-2 pb-2">
                <div class="col-6">
                  <label for="exampleInputEmail1">Fever/chills<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Lagnat/panginginig)</span></label>
                  <input type="text" class="form-control" name="chills" value="NO" id="chills" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="chills_ON" onclick="pick_button('ON','YES','chills',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="chills_OFF"  onclick="pick_button('OFF','NO','chills',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>
            </div>
            <div class="form-group col-sm-12">
              <div class="row pt-2 pb-2">
                <div class="col-6">
                  <label for="exampleInputEmail1">Headache<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Sakit ng ulo)</span></label>
                  <input type="text" class="form-control" name="headache" value="NO" id="headache" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="headache_ON" onclick="pick_button('ON','YES','headache',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="headache_OFF"  onclick="pick_button('OFF','NO','headache',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>
            </div>
            <div class="form-group col-sm-12">
              <div class="row pt-2 pb-2">
                <div class="col-6">
                  <label for="exampleInputEmail1">Cough<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Ubo)</span></label>
                  <input type="text" class="form-control" name="cough" value="NO" id="cough" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="cough_ON" onclick="pick_button('ON','YES','cough',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="cough_OFF"  onclick="pick_button('OFF','NO','cough',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>
            </div>
            <div class="form-group col-sm-12">
              <div class="row pt-2 pb-2">
                <div class="col-6">
                  <label for="exampleInputEmail1">Colds<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Sipon)</span></label>
                  <input type="text" class="form-control" name="colds" value="NO" id="colds" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="colds_ON" onclick="pick_button('ON','YES','colds',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="colds_OFF"  onclick="pick_button('OFF','NO','colds',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>
            </div>
            <div class="form-group col-sm-12">
              <div class="row pt-2 pb-2">
                <div class="col-6">
                  <label for="exampleInputEmail1">Sore throat<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Masakit ang lalamunan)</span></label>
                  <input type="text" class="form-control" name="sore_throat" value="NO" id="sore_throat" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="sore_throat_ON" onclick="pick_button('ON','YES','sore_throat',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="sore_throat_OFF"  onclick="pick_button('OFF','NO','sore_throat',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>
            </div>
            <div class="form-group col-sm-12">
              <div class="row pt-2 pb-2">
                <div class="col-6">
                  <label for="exampleInputEmail1">Myalgia, Fatigue and Weakness<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Myalgia, Pagkapagod at Kahinaan)</span></label>
                  <input type="text" class="form-control" name="myalgia_fatigue_Weakness" value="NO" id="myalgia_fatigue_Weakness" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="myalgia_fatigue_Weakness_ON" onclick="pick_button('ON','YES','myalgia_fatigue_Weakness',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="myalgia_fatigue_Weakness_OFF"  onclick="pick_button('OFF','NO','myalgia_fatigue_Weakness',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>
            </div>
            <div class="form-group col-sm-12">
              <div class="row pt-2 pb-2">
                <div class="col-6">
                  <label for="exampleInputEmail1">Loss of smell/taste<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Nawalan ng amoy / lasa)</span></label>
                  <input type="text" class="form-control" name="smell" value="NO" id="smell" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="smell_ON" onclick="pick_button('ON','YES','smell',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="smell_OFF"  onclick="pick_button('OFF','NO','smell',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>
            </div>
            <div class="form-group col-sm-12">
              <div class="row pt-2 pb-2">
                <div class="col-6">
                  <label for="exampleInputEmail1">Diarrhea<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Pagtatae)</span></label>
                  <input type="text" class="form-control" name="diarrhea" value="NO" id="diarrhea" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="diarrhea_ON" onclick="pick_button('ON','YES','diarrhea',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="diarrhea_OFF"  onclick="pick_button('OFF','NO','diarrhea',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>
            </div>
            <div class="form-group col-sm-12">
              <div class="row pt-2 pb-2">
                <div class="col-6">
                  <label for="exampleInputEmail1">Shortness of breath/ difficulty in breathing<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Kakulangan ng paghinga / hirap sa paghinga)</span></label>
                  <input type="text" class="form-control" name="difficulty_breathing" value="NO" id="difficulty_breathing" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="difficulty_breathing_ON" onclick="pick_button('ON','YES','difficulty_breathing',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="difficulty_breathing_OFF"  onclick="pick_button('OFF','NO','difficulty_breathing',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>
            </div>

            <center><h4><u>Registrant Allergy History</u></h4></center>
            
            <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>Allergy sa PEG or sa Polysorbate</td>
                    <td><b><?php echo $PEG_alergy; ?></b></td>
                </tr>
                <tr>
                    <td>Allergy sa Pagkain</td>
                    <td><b><?php echo $food_alergy; ?></b></td>
                </tr>
                <tr>
                    <td>Allergy sa Gamot</td>
                    <td><b><?php echo $drug_alergy; ?></b></td>
                </tr>
                <tr>
                    <td>Allergy sa Polen</td>
                    <td><b><?php echo $pollen_alergy; ?></b></td>
                </tr>
              </tbody>
            </table>
            <div class="form-group col-sm-12">
              <div class="row pt-2 pb-2">
                <div class="col-12">
                  <label for="exampleInputEmail1"> If with allergy or asthma, will the vaccinator able to monitor the patient for 30 minutes?</label>
                  <input type="text" class="form-control" name="if_allergy" value="NO" id="if_allergy" hidden>
                </div>
                <div class="col-12 row">
                  <button type="button" id="if_allergy_ON" onclick="pick_button('ON','YES','if_allergy',this)" class="btn btn-custom col-6"><b>OO (YES)</b></button>
                  <button type="button" id="if_allergy_OFF"  onclick="pick_button('OFF','NO','if_allergy',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>
            </div>
            <center><h4><u>Registrant Medical History</u></h4></center>
            <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>Lung disease</td>
                    <td><b><?php echo $lung_disease; ?></b></td>
                </tr>
                <tr>
                    <td>Kidney disease</td>
                    <td><b><?php echo $kidney_disease; ?></b></td>
                </tr>
                <tr>
                    <td>Diyabetes</td>
                    <td><b><?php echo $diabetes; ?></b></td>
                </tr>
                <tr>
                    <td>Organ Transplant</td>
                    <td><b><?php echo $transplant; ?></b></td>
                </tr>
                <tr>
                    <td>Leukemia</td>
                    <td><b><?php echo $leukemia; ?></b></td>
                </tr>

                <tr>
                    <td>Blood disease</td>
                    <td><b><?php echo $blood_disease; ?></b></td>
                </tr>
                <tr>
                    <td>Heart disease</td>
                    <td><b><?php echo $heart_disease; ?></b></td>
                </tr>
                <tr>
                    <td>Asthma</td>
                    <td><b><?php echo $asthma; ?></b></td>
                </tr>

                <tr>
                    <td>Hypertension</td>
                    <td><b><?php echo $hypertension; ?></b></td>
                </tr>
                <tr>
                    <td>Cancer</td>
                    <td><b><?php echo $cancer_med; ?></b></td>
                </tr>
                <tr>
                    <td>Sakit sa pag-iisip / Seizure disorder</td>
                    <td><b><?php echo $seizure; ?></b></td>
                </tr>
                <tr>
                    <td>HIV</td>
                    <td><b><?php echo $hiv_med; ?></b></td>
                </tr>
              </tbody>
            </table>
            <div class="form-group col-sm-12">
              <div class="row pt-2 pb-2">
                <div class="col-12">
                  <label for="exampleInputEmail1">if with bleeding history, is a gauge 23 - 25 syringe available for injection?</label>
                  <input type="text" class="form-control" name="if_bleeding" value="NO" id="if_bleeding" hidden>
                </div>
                <div class="col-12 row">
                  <button type="button" id="if_bleeding_ON" onclick="pick_button('ON','YES','if_bleeding',this)" class="btn btn-custom col-6"><b>OO (YES)</b></button>
                  <button type="button" id="if_bleeding_OFF"  onclick="pick_button('OFF','NO','if_bleeding',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>
            </div>
            <div class="form-group col-sm-12">
              <div class="row pt-2 pb-2">
                <div class="col-12">
                  <label for="exampleInputEmail1">If with mentioned condition, has presented medical clearance prior to vaccination day?</label>
                  <input type="text" class="form-control" name="medical_clearance" value="NO" id="medical_clearance" hidden>
                </div>
                <div class="col-12 row">
                  <button type="button" id="medical_clearance_ON" onclick="pick_button('ON','YES','medical_clearance',this)" class="btn btn-custom col-6"><b>OO (YES)</b></button>
                  <button type="button" id="medical_clearance_OFF"  onclick="pick_button('OFF','NO','medical_clearance',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>
            </div>
            <center><h4><u>Vaccination Information</u></h4></center>
            <div class="form-group col-sm-12">
              <div class="row pt-2 pb-2">
                <div class="col-6">
                  <label for="exampleInputEmail1">Vaccinator Name<span style="color:red;">*</label>
                </div>
                <div class="col-6 row">
                  <input type="text" class="form-control" value="<?php echo $_COOKIE[$cookie_name_1]; ?>" name="vaccinator_name">
                </div>
              </div>
            </div>
            <div class="form-group col-sm-12">
              <div class="row pt-2 pb-2">
                <div class="col-6">
                  <label for="exampleInputEmail1">Date of Vaccination<span style="color:red;">*</label>
                </div>
                <div class="col-6 row">
                  <?php echo date("Y-m-d"); ?>
                </div>
              </div>
            </div>
            <div class="form-group col-sm-12">
              <div class="row pt-2 pb-2">
                <div class="col-6">
                  <label for="exampleInputEmail1">Batch Number<span style="color:red;">*</label>
                </div>
                <div class="col-6 row">
                  <input type="text" class="form-control" name="batch_number">
                </div>
              </div>
            </div>
            <div class="form-group col-sm-12">
              <div class="row pt-2 pb-2">
                <div class="col-6">
                  <label for="exampleInputEmail1">Lot Number<span style="color:red;">*</label>
                </div>
                <div class="col-6 row">
                  <input type="text" class="form-control" name="lot_number">
                </div>
              </div>
            </div>
            <div class="form-group col-sm-12">
              <div class="row pt-2 pb-2">
                <div class="col-6">
                  <label for="exampleInputEmail1">Dose<span style="color:red;">*</label>
                  <input type="text" class="form-control" name="dose" value="1st Dose" id="dose" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="dose_ON" onclick="pick_button('ON','1st Dose','dose',this)" class="btn btn-custom mr-2 col-5 btn-no"><b>1st Dose</b></button>
                  <button type="button" id="dose_OFF"  onclick="pick_button('OFF','2nd Dose','dose',this)" class="btn btn-custom col-6"><b>2nd Dose</b></button>
                </div>
              </div>
            </div>
            <hr>
        </form>
        <button type="button" class="btn btn-info text-white col-6 offset-3 text-center" onclick="set_system_cardinal_operation('You want to update this registrant information?', 'create', 'survey_form', 'update.php', 'survey_result', 'none', 'none', 'required_div_add_survey', 'confirmation_create_success', 'none')"><h5><b>Update Info<br></b></h5></button>
    </div>
  </div>
</div>
<!-- /.login-box -->

<div style="width:100% !important;">
  <?php // include '../inc/copyfooter.php'; ?>
</div>
<div class="modal fade" id="confirmation_box" style="margin-top: 15%;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-body">
            <center>
                <div class="confirmation_box_icon">
                    <i class="fas fa-exclamation fa-5x"></i>
                </div>
            </center>
            <br>
            <center><h6 id="confirmation_des">Do You want to Submit the Registration Form?</h6><br>
            <Span style="font-size:14px">(Nais mong isumite ang iyong pagpaparehistro?)</span></center>
            <div hidden>
                <input type="text" id="confirmation_operation" > <p>operation => the operation to do</p>
                <input type="text" id="confirmation_form_id" > <p>form_id => the form id where the inputs located</p>
                <input type="text" id="confirmation_form_file_name" > <p>file_name => form file name where the data will be passed</p>

                <input type="text" id="confirmation_table_div_id" > <p>get_div_id => div Id where the Table will Appear</p>
                <input type="text" id="confirmation_table_file_name" > <p>file_name => table file name</p>
                <input type="text" id="confirmation_table_id" > <p>table_id => table Id for Bootstrap data table</p>

                <input type="text" id="confirmation_modal_open" > <p>modal_open => the modal that will open when press OK!</p>
                <input type="text" id="confirmation_modal_close" > <p>modal_close => the modal that will close when press OK!</p>
            </div>

        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="turn_off_overlay()">Cancel</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="confirmation()">Ok</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<script>
function pick_button(indicator,data,id,element){
  document.getElementById(id).value = data;
  if(indicator == "ON"){
    document.getElementById(id+"_OFF").style.backgroundColor = "white";
    document.getElementById(id+"_OFF").style.color = "rgb(34, 161, 125)";
  }else{
    document.getElementById(id+"_ON").style.backgroundColor = "white";
    document.getElementById(id+"_ON").style.color = "rgb(34, 161, 125)";
  }
  element.style.backgroundColor = "rgb(34, 161, 125)";
  element.style.color = "white";
}

//Div to Hide!!
function system_hidden(id){
    var set_id = id.split(',');
    for ( var i = 0; i < set_id.length; i++ ) {
        document.getElementById(set_id[i]).style.display = "none";
    }
}

function turn_off_overlay(){
    document.getElementById("overlay").style.display = "none";//this will turn off the overlay effect/ the dark background
}
function turn_off_required(id){
    document.getElementById(id).style.display = "none";//this will turn off the alert at the conformation wich is the required the dark background
}

//Conforming for required inputs and setting up Confirm Box
function set_system_cardinal_operation(des,operation,form_id,form_file_name,table_div_id,table_file_name,table_id,required_notice,modal_open,modal_close){
    
    //setting conformation and required in fields!!
    var form = document.getElementById(form_id);//form ID
    var form_inputs_error = 0;
    if(operation == "create" || operation == "update" || operation == "delete"){
        for ( var i = 0; i < form.elements.length; i++ ) {
            
            var e = form.elements[i];
            var element_value = e.value;
            var element_alt = e.alt;
            var element_name = e.name;
            // alert(element_name+"---"+element_value+"entry");

            if(e.type != 'radio'){
             
              //Finding if inputs are required!!
              // Clean UP the red borders for required inputs

              if(element_alt == "required"){
                  document.getElementById(required_notice).style.display = "none";
                  document.getElementsByName(element_name)[0].style.borderColor = "gray"; 
                  document.getElementsByName(element_name)[0].style["boxShadow"] = "none";
              } 
              if(e.required == true){
                document.getElementById(required_notice).style.display = "none";
                document.getElementsByName(element_name)[0].style.borderColor = "gray"; 
                document.getElementsByName(element_name)[0].style["boxShadow"] = "none";
              }
              
              // Adding UP the red borders for required inputs
              if(element_alt == "required"){
                  if(element_value == ""){
                      document.getElementsByName(element_name)[0].style.borderColor = "red";
                      document.getElementsByName(element_name)[0].style["boxShadow"] = "0 0 5px #f20a0a";
                      form_inputs_error++;//adding error if there is empty inputs!!
                  } 
              }
              if(e.required == true){
                if(element_value == "Empty"){
                  document.getElementsByName(element_name)[0].style.borderColor = "red";
                  document.getElementsByName(element_name)[0].style["boxShadow"] = "0 0 5px #f20a0a";
                  form_inputs_error++;//adding error if there is empty inputs!!
                }
              }
            }
        }
    }

    // Conditions for inputs if there is no error!!
    if(form_inputs_error != 0){
        document.getElementById(required_notice).style.display = "block";// if error display error for required inputs
        window.scrollTo(0, 0); 
    }else{
        $('#confirmation_box').modal({ // make conformation box background unclickable!!
            backdrop: 'static',
            keyboard: false
        });
        $('#confirmation_box').modal("show");// open confirmation box

        //set data details for conformation box
        document.getElementById("overlay").style.display = "block";//this will turn on the overlay effect/ the dark background
        document.getElementById("confirmation_des").innerHTML = des;

        document.getElementById("confirmation_operation").value = operation; //the operation to do
        document.getElementById("confirmation_form_id").value = form_id; //the form id where the inputs located
        document.getElementById("confirmation_form_file_name").value = form_file_name; //the form file name where the data will be process(ajax)
        document.getElementById("confirmation_table_div_id").value = table_div_id;  // the div ID whre the table will be display
        document.getElementById("confirmation_table_file_name").value = table_file_name; //the filename to be used for table (ajax)
        document.getElementById("confirmation_table_id").value = table_id; //the id of the table for bootstrap ID
        document.getElementById("confirmation_modal_open").value = modal_open; //the modal to open
        document.getElementById("confirmation_modal_close").value = modal_close; //the modal to close
    }
}
//Ones The Operation is Confirmed
function confirmation(){
    turn_off_overlay(); 
    //Get all the values needed from input in conformation boxes!!
    var operation = document.getElementById("confirmation_operation").value;
    var form_id = document.getElementById("confirmation_form_id").value;
    var form_file_name = document.getElementById("confirmation_form_file_name").value;
    var table_div_id = document.getElementById("confirmation_table_div_id").value;
    var table_file_name = document.getElementById("confirmation_table_file_name").value;
    var table_id = document.getElementById("confirmation_table_id").value;
    var modal_open = document.getElementById("confirmation_modal_open").value;
    var modal_close = document.getElementById("confirmation_modal_close").value;

    $('#'+modal_open).modal({ // make conformation box background unclickable!!
        backdrop: 'static',
        keyboard: false
    });
    
    //The CRUDE FUNCTION!!!
    if(operation == "create"){//Create Function!!
        //Ajax code for passing the value to a certain file name!
        sys_create(operation,form_id,form_file_name,table_div_id,table_file_name,table_id);
        $('#'+modal_open).modal("show");//the modal to open
        $('#'+modal_close).modal("hide");//the modal to close
    }
}
 //Create Function
function sys_create(operation,form_id,form_file_name,table_div_id,table_file_name,table_id){
    var form_data = [];
    var form = document.getElementById(form_id);//form ID
    for ( var i = 0; i < form.elements.length; i++ ) {
        var e = form.elements[i]; 
        form_data.push(encodeURIComponent(e.name) + "=" + encodeURIComponent(e.value));
    }
    var form = form_data.join("&");

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        document.getElementById(table_div_id).innerHTML = this.responseText;
    };
    xhttp.open("GET", form_file_name+"?operation="+operation+"&table_name="+table_file_name+"&"+form, true);
    xhttp.send();  
}

//for Selection with conditionals Function
function select_conditional(target_div, selection_value, table_name, table_col, selection_col_name, condition, other_conditions){
    var xhttp;
   
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        document.getElementById(target_div).innerHTML = this.responseText;
    };
    xhttp.open("GET","select_conditional.php?selection_value="+selection_value+"&table_name="+table_name+"&table_col="+table_col+"&selection_col_name="+selection_col_name+"&condition="+condition+"&other_conditions="+other_conditions, true);
    xhttp.send();  
}
</script>
<?php  include '../inc/copyfooter.php'; ?>
</body>

</html>
