
<?php 
  include '../../controller/systemcore.php'; 
  $systemcore = new systemcore();

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

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bago City COVID-19 Contact Tracing & Surveillance: Management, Assesment, Monitoring, Bulletin Application</title> 
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="image_src" href="../../dist/img/resbakuna.png"> -->
  <link rel = "icon" href = "../../dist/img/<?php echo $_SESSION["system_logo"];?>">

  <meta property="og:image" content="http://bagocho.pagenet.info/VIMS/dist/img/VIMS_preview123.png" />
  <meta property="og:description" content="Get vaccinated! #RESBAKUNA \n #BIDABakunation \n #BIDASolusyon + \n #ExplainExplainExplain \n #BakunaBago" />
  <meta property="og:url"content="	http://bagocho.pagenet.info/VIMS/pages/vaccine_registration/" />
  <meta property="og:title" content="Bago City COVID-19 Vaccine Online Registration" />

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
  /* .btn-no{
    background-color:rgb(34, 161, 125);
    color:white;
  } */
  .btn-custom2{
    background-color:white;
    color:rgb(34, 161, 125);
    border:1px solid rgb(34, 161, 125);
  }

  #pills-home-tab{
    display:"none" !important;
  }
  #submit-btn{
    display:"none" !important;
  }
  </style>
</head>
<body class="hold-transition login-page"  onload="system_hidden('required_div_add_survey')" style="background-color:rgb(95, 172, 176)!important;">

<!-- <nav class=" navbar-dark navbar-light col-sm-12"  style="background-color: rgb(2, 13, 56);">
<center>
<div class="row">
    <div class="brand-link col-sm-12">
        <span class="brand-text font-weight-heavy d-none d-lg-block">
          <b><a href="http://bagocho.pagenet.info/" class="brand-link col-sm-12" style="color:gold; font-size:26px">BAGO CITY COVID-19 HEALTH EVENT</a></b>
        </span>

        <span class="brand-text font-weight-heavy d-lg-none">
          <b><a href="http://bagocho.pagenet.info/" class="brand-link col-sm-12" style="color:gold;">BAGO CITY COVID-19 HEALTH EVENT</a></b>
        </span>
    </div>
</div>
</center>
</nav> -->


<div id="overlay"></div>
<br>
<div style="margin:10px; max-width: 700px;">
  <div class="login-logo row text-center">
    <img src="../../dist/img/bago_Logo.png" alt="User Image" width="120px" height="120px" class="mx-auto d-block">
    <b style="color:white; font-weight: 900;" class="col-sm-12">Bago City COVID-19 Vaccine<br>Registration Form</b>
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

        <div class="alert" role="alert" style="border:rgb(196, 146, 20) 1px solid; background-color:rgba(242, 178, 17, 0.3)">
          <p style="margin:0px !important;">For the health and safety of our community.</p>
          <p style="margin:0px !important;">Be sure that the information you'll give is accurate and complete.</p>
          <span style="color:gray; font-size:14px">(Para sa kalusugan at kaligtasan ng ating pamayanan. Tiyaking tumpak at kumpleto ang impormasyong ibibigay mo.)</span>
        </div>

        <div id="result_div">

        </div>
        <form id="survey_form" method="post">
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              <center><h4><u>Personal Information</u></h4>
              <p>(Personal na Impormasyon)</p><br></center>
              
              <div class="row">
                <div class="form-group col-sm-6">
                  <label for="exampleInputEmail1">Category<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Kategorya)</span></label>
                  <select name="employmentcategory" class="form-control regis_form" alt="required" required onchange="select_conditional('sub_category1', this.value, 'array', 'array', 'array', 'select_sub_category_by_category', 'array')">
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

                <div class="form-group col-sm-6">
                  <label for="exampleInputEmail1">ID Category<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Kategorya ng ID)<br><br></span></label>
                  <select name="idcategory" class="form-control regis_form" >
                    <option value="Empty" hidden></option>
                    <option value="01_PRC_number">PRC Number</option>
                    <option value="02_OSCA_number">OSCA Number</option>
                    <option value="03_Facility_ID_number">Facility ID Number</option>
                    <option value="04_Other_ID">Other ID</option>
                    <option value="00_UNKNOWN">UNKNOWN</option>
                  </select>
                </div>

                <div class="form-group col-sm-6">
                  <label for="exampleInputEmail1">ID Number <span style="color:red;">*</span><span style="color:gray; font-size:14px">(Ilagay ang ID na basi sa piniling kategorya ng ID)</span></label>
                  <input type="text" class="form-control regis_form" name="idnumber" value="">
                </div>

                <div class="form-group col-sm-6">
                  <label for="exampleInputEmail1">PhilHealth ID</label>
                  <input type="text" class="form-control regis_form" name="phid" value="">
                </div>

                <div class="form-group col-sm-6">
                  <label for="exampleInputEmail1">PWD ID</label>
                  <input type="text" class="form-control regis_form" name="pwdid">
                </div>

                <div class="form-group col-sm-6">
                  <label for="exampleInputEmail1">Last Name<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Apelyido)</span></label>
                  <input type="text" class="form-control regis_form" name="lastname" alt="required" required>
                </div>

                <div class="form-group col-sm-6">
                  <label for="exampleInputEmail1">First Name<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Pangalan)</span></label>
                  <input type="text" class="form-control regis_form" name="firstname" alt="required" required>
                </div>

                <div class="form-group col-sm-6">
                  <label for="exampleInputEmail1">Middle Name<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Gitnang Pangalan)</span></label>
                  <input type="text" class="form-control regis_form" name="middlename" alt="required"  >
                </div>

                <div class="form-group col-sm-6">
                  <label for="exampleInputEmail1">Suffix</label>
                  <select name="suffix" class="form-control regis_form">
                    <option value="N\A">N\A</option>
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
                  <label for="exampleInputEmail1">Current Residence:<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Kasalukuyang Tirahan)</span></span><span style="color:gray; font-size:12px">(Unit/Building/House_Number,_Street_Name)</span></label>
                  <input type="text" class="form-control regis_form" alt="required"  name="current_residence" >
                </div>

                <div class="form-group col-sm-6">
                  <label for="exampleInputEmail1">Region<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Rehiyon)</span></label>
                  <select name="region" class="form-control regis_form" alt="required" required onchange="select_conditional('province', this.value, 'array', 'array', 'array', 'select_province', 'array')">
                    <option value="Empty" hidden></option>
                    <?php foreach($Global_regions as $data){   ?>
                      <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                    <?php } ?>
                  </select>
                </div>

                <div class="form-group col-sm-6">
                  <label for="exampleInputEmail1">Province<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Lalawigan)</span></label>
                  <select name="province" id="province" class="form-control regis_form" alt="required" required onchange="select_conditional('city', this.value, 'array', 'array', 'array', 'select_city', 'array')">
                    <option value="Empty" hidden>Select Region First</option>
                  </select>
                </div>

                <div class="form-group col-sm-6">
                  <label for="exampleInputEmail1">City/Municipality<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Lungsod / Munisipalidad)</span></label>
                  <select name="city" id="city" class="form-control regis_form" alt="required" required onchange="select_conditional('brgy', this.value, 'array', 'array', 'array', 'select_brgy', 'array')">
                    <option value="Empty" hidden>Select Province First</option>
                  </select>
                </div>

                <div class="form-group col-sm-6">
                  <label for="exampleInputEmail1">Barangay<span style="color:red;">*</span></label>
                  <select name="brgy" id="brgy" class="form-control regis_form" alt="required" required>
                    <option value="Empty" hidden>Select City / Municipality First</option>
                  </select>
                </div>

                <div class="form-group col-sm-6">
                  <label for="exampleInputEmail1">Civil Status<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Katayuang sibil)</span></label>
                  <select name="civil_status" class="form-control regis_form" required>
                    <option value="Empty" hidden></option>
                    <option value="01_Single">Single</option>
                    <option value="02_Married">Married</option>
                    <option value="03_Widow/Widower">Widow/Widower</option>
                    <option value="04_Separated/Annulled">Separated/Annulled</option>
                    <option value="05_Living_with_Partner">Living with Partner</option>
                  </select>
                </div>

                <div class="form-group col-sm-6">
                  <label for="exampleInputEmail1">Employment Status<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Katayuan sa Trabaho)</span></label>
                  <select name="employment_status" class="form-control regis_form" required>
                    <option value="Empty" hidden></option>
                    <option value="01_Government_Employed">Government Employed</option>
                    <option value="02_Private_Employed">Private Employed</option>
                    <option value="03_Self_employed">Self Employed</option>
                    <option value="04_Private_practitioner">Private Practitioner</option>
                    <option value="05_Others">Other</option>
                  </select>
                </div>

                <div class="form-group col-sm-6">
                  <label required for="exampleInputEmail1">Occupation<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Trabaho)</span></label>
                  <input type="text" class="form-control regis_form" name="occupation" >
                </div>

                <div class="form-group col-sm-6">
                  <label required for="exampleInputEmail1">Mobile Number<span style="color:red;">*</span><span class="bg-info" style="color:gray; font-size:14px">(09XXXXXXXXX)</span><br><span class="bg-info" style="color:gray; font-size:14px">(Mobile Number not Telephone Number)</span><Br><span class="bg-info" style="color:gray; font-size:14px">(Phillipine Local Number)</span></label>
                  <input type="text" class="form-control regis_form" alt="required"  name="contact" >
                </div>

                <div class="form-group col-sm-6">
                  <label for="exampleInputEmail1">Gender<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Kasarian)</span></label>
                  <select name="gender" class="form-control regis_form" required>
                      <option value="Empty" hidden></option>
                      <option value="02_Male">Male</option>
                      <option value="01_Female">Female</option>
                  </select>
                </div>

                <div class="form-group col-sm-6">
                  <label for="exampleInputEmail1">Birthday<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Kapanganakan)</span></label>
                  <input type="date" class="form-control regis_form" name="bday" alt="required" required>
                </div>
                <!-- <div class="form-group col-sm-12">
                  <div class="row pt-2 pb-2">
                    <div class="col-6">
                      <label for="exampleInputEmail1">Buntis<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Pregnant)</span></label>
                      <input type="text" class="form-control" name="pregnant" value="NO" id="pregnant" hidden>
                    </div>
                    <div class="col-6 row">
                      <button type="button" id="pregnant_yes" onclick="pick_button('YES','pregnant',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                      <button type="button" id="pregnant_no" onclick="pick_button('NO','pregnant',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                    </div>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <div class="row pt-2 pb-2">
                    <div class="col-6">
                      <label for="exampleInputEmail1">History of Covid-19 Infection<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Naging Positibo kaba sa Covid-19 Infection)</span></label>
                      <input type="text" class="form-control" name="covid_status" value="NO" id="covid_status" hidden>
                    </div>
                    <div class="col-6 row">
                      <button type="button" id="covid_status_yes" onclick="pick_button('YES','covid_status',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                      <button type="button" id="covid_status_no" onclick="pick_button('NO','covid_status',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                    </div>
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="exampleInputEmail1">Covid Classification<span style="color:gray; font-size:14px">(For Resent Covid-19 Patient)</span></label>
                  <select name="covid_classification" class="form-control regis_form">
                    <option value="N\A">N\A</option>
                    <option value="Asymtomatic">Asymtomatic</option>
                    <option value="Mild">Mild</option>
                    <option value="Moderate">Moderate</option>
                    <option value="Severe">Severe</option>
                    <option value="Critical">Critical</option>
                  </select>
                </div>

                <div class="form-group col-sm-12">
                  <div class="row pt-2 pb-2">
                    <div class="col-6">
                      <label for="exampleInputEmail1">Exposure to confirmed or suspected COVID-19 case<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Pagkakalantad sa nakumpirma o pinaghihinalaang nag positibo sa COVID-19)</span></label>
                      <input type="text" class="form-control" name="covid_exposure" value="NO" id="covid_exposure" hidden>
                    </div>
                    <div class="col-6 row">
                      <button type="button" id="covid_exposure_yes" onclick="pick_button('YES','covid_exposure',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                      <button type="button" id="covid_exposure_no" onclick="pick_button('NO','covid_exposure',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                    </div>
                  </div>
                </div> -->

                <div class="form-group col-sm-12">
                  <div class="row pt-2 pb-2">
                    <div class="col-6">
                      <label for="exampleInputEmail1">Consent<span style="color:red;">*</span><span style="color:gray; font-size:14px">(Pahintulot para sa pagbabakuna)</span></label>
                      <input type="text" class="form-control" name="consent" value="NO" id="consent" hidden>
                    </div>
                    <div class="col-6 row">
                      <button type="button" id="consent_yes" onclick="pick_button('YES','consent',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                      <button type="button" id="consent_no" onclick="pick_button('NO','consent',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <center><h4><u>Allergy</u></h4>
              <p>Mayroon ka ba ng mga sumusunod na Alerhiya(Allergy)?</p><br></center> -->
              <div class="row pt-2 pb-2">
                <div class="col-6">
                  <label for="exampleInputEmail1">Allergy to Vaccine & related products<span style="color:red;">*</span><br><span style="color:gray; font-size:14px">(Allergy sa Bakuna at mga kaugnay na produkto)</span></label>
                  <input type="text" class="form-control" name="vaccine_allergy" value="NO" id="PEG_alergy" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="PEG_alergy_yes" onclick="pick_button('YES','PEG_alergy',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="PEG_alergy_no" onclick="pick_button('NO','PEG_alergy',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>

              <!-- <div class="row pt-2 pb-2" style="border-bottom:1px solid gray">
                <div class="col-6">
                  <label for="exampleInputEmail1">Allergy sa Pagkain<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Food Allergy)</span></label>
                  <input type="text" class="form-control" name="food_alergy" value="NO" id="food_alergy" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="food_alergy_yes" onclick="pick_button('YES','food_alergy',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="food_alergy_no" onclick="pick_button('NO','food_alergy',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>

              <div class="row pt-2 pb-2" style="border-bottom:1px solid gray">
                <div class="col-6">
                  <label for="exampleInputEmail1">Allergy sa Gamot<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Drug Allergy)</span></label>
                  <input type="text" class="form-control" name="drug_alergy" value="NO" id="drug_alergy" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="drug_alergy_yes" onclick="pick_button('YES','drug_alergy',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="drug_alergy_no" onclick="pick_button('NO','drug_alergy',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>

              <div class="row pt-2 pb-2" style="border-bottom:1px solid gray">
                <div class="col-6">
                  <label for="exampleInputEmail1">Allergy sa Polen<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Pollen Allergy)</span></label>
                  <input type="text" class="form-control" name="pollen_alergy" value="NO" id="pollen_alergy" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="pollen_alergy_yes" onclick="pick_button('YES','pollen_alergy',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="pollen_alergy_no" onclick="pick_button('NO','pollen_alergy',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>

              <div class="row pt-2 pb-2" style="border-bottom:1px solid gray">
                <div class="col-6">
                  <label for="exampleInputEmail1">Allergy sa Insekto<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Insect Allergy)</span></label>
                  <input type="text" class="form-control" name="insect_alergy" value="NO" id="insect_alergy" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="insect_alergy_yes" onclick="pick_button('YES','insect_alergy',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="insect_alergy_no" onclick="pick_button('NO','insect_alergy',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>

              <div class="row pt-2 pb-2" style="border-bottom:1px solid gray">
                <div class="col-6">
                  <label for="exampleInputEmail1">Allergy sa Latex<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Latex Allergy)</span></label>
                  <input type="text" class="form-control" name="latex_alergy" value="NO" id="latex_alergy" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="latex_alergy_yes" onclick="pick_button('YES','latex_alergy',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="latex_alergy_no" onclick="pick_button('NO','latex_alergy',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>

              <div class="row pt-2 pb-2" style="border-bottom:1px solid gray">
                <div class="col-6">
                  <label for="exampleInputEmail1">Allergy sa Amag<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Mold Allergy)</span></label>
                  <input type="text" class="form-control" name="mold_alergy" value="NO" id="mold_alergy" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="mold_alergy_yes" onclick="pick_button('YES','mold_alergy',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="mold_alergy_no" onclick="pick_button('NO','mold_alergy',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>

              <div class="row pt-2 pb-2" style="border-bottom:1px solid gray">
                <div class="col-6">
                  <label for="exampleInputEmail1">Allergy sa Hayop<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">Pet Allergy)</span></label>
                  <input type="text" class="form-control" name="pet_alergy" value="NO" id="pet_alergy" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="pet_alergy_yes" onclick="pick_button('YES','pet_alergy',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="pet_alergy_no" onclick="pick_button('NO','pet_alergy',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div> -->


              <!-- <br>
              <center><h4><u>Medical History</u></h4>
              <p>Mayroon / nagkaroon ka ba ng mga sumusunod na karamdaman? <br><u>(Kapag meron mg presenta ng medical clearance prior sa vaccination day)</u></p><br></center>

              <div class="row pt-2 pb-2" style="border-bottom:1px solid gray">
                <div class="col-6">
                  <label for="exampleInputEmail1">Sakit sa baga<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Lung disease)</span></label>
                  <input type="text" class="form-control" name="lung_disease" value="NO" id="lung_disease" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="lung_disease_yes" onclick="pick_button('YES','lung_disease',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="lung_disease_no" onclick="pick_button('NO','lung_disease',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>

              <div class="row pt-2 pb-2" style="border-bottom:1px solid gray">
                <div class="col-6">
                  <label for="exampleInputEmail1">Sakit sa bato<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Kidney disease)</span></label>
                  <input type="text" class="form-control" name="kidney_disease" value="NO" id="kidney_disease" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="kidney_disease_yes" onclick="pick_button('YES','kidney_disease',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="kidney_disease_no" onclick="pick_button('NO','kidney_disease',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>

              <div class="row pt-2 pb-2" style="border-bottom:1px solid gray">
                <div class="col-6">
                  <label for="exampleInputEmail1">Diyabetes<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Diabetes)</span></label>
                  <input type="text" class="form-control" name="diabetes" value="NO" id="diabetes" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="diabetes_yes" onclick="pick_button('YES','diabetes',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="diabetes_no" onclick="pick_button('NO','diabetes',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>  

              <div class="row pt-2 pb-2" style="border-bottom:1px solid gray">
                <div class="col-6">
                  <label for="exampleInputEmail1">Transplantasyon ng organo<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Organ Transplant)</span></label>
                  <input type="text" class="form-control" name="transplant" value="NO" id="transplant" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="transplant_yes" onclick="pick_button('YES','transplant',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="transplant_no" onclick="pick_button('NO','transplant',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>  

              <div class="row pt-2 pb-2" style="border-bottom:1px solid gray">
                <div class="col-6">
                  <label for="exampleInputEmail1">Leukemia<span style="color:red;"></label>
                  <input type="text" class="form-control" name="leukemia" value="NO" id="leukemia" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="leukemia_yes" onclick="pick_button('YES','leukemia',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="leukemia_no" onclick="pick_button('NO','leukemia',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>

              <div class="row pt-2 pb-2" style="border-bottom:1px solid gray">
                <div class="col-6">
                  <label for="exampleInputEmail1">Sakit sa dugo<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Blood disease)</span></label>
                  <input type="text" class="form-control" name="blood_disease" value="NO" id="blood_disease" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="blood_disease_yes" onclick="pick_button('YES','blood_disease',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="blood_disease_no" onclick="pick_button('NO','blood_disease',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>

              <div class="row pt-2 pb-2" style="border-bottom:1px solid gray">
                <div class="col-6">
                  <label for="exampleInputEmail1">Sakit sa puso<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Heart disease)</span></label>
                  <input type="text" class="form-control" name="heart_disease" value="NO" id="heart_disease" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="heart_disease_yes" onclick="pick_button('YES','heart_disease',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="heart_disease_no" onclick="pick_button('NO','heart_disease',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>

              <div class="row pt-2 pb-2" style="border-bottom:1px solid gray">
                <div class="col-6">
                  <label for="exampleInputEmail1">Hika<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Asthma)</span></label>
                  <input type="text" class="form-control" name="asthma" value="NO" id="asthma" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="asthma_yes" onclick="pick_button('YES','asthma',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="asthma_no" onclick="pick_button('NO','asthma',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>

              <div class="row pt-2 pb-2" style="border-bottom:1px solid gray">
                <div class="col-6">
                  <label for="exampleInputEmail1">Altapresyon<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Hypertension)</span></label>
                  <input type="text" class="form-control" name="hypertension" value="NO" id="hypertension" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="hypertension_yes" onclick="pick_button('YES','hypertension',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="hypertension_no" onclick="pick_button('NO','hypertension',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>

              <div class="row pt-2 pb-2" style="border-bottom:1px solid gray">
                <div class="col-6">
                  <label for="exampleInputEmail1">Kanser<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Cancer)</span></label>
                  <input type="text" class="form-control" name="cancer_med" value="NO" id="cancer_med" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="cancer_med_yes" onclick="pick_button('YES','cancer_med',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="cancer_med_no" onclick="pick_button('NO','cancer_med',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>

              <div class="row pt-2 pb-2" style="border-bottom:1px solid gray">
                <div class="col-6">
                  <label for="exampleInputEmail1">Sakit sa pag-iisip / Seizure disorder</label>
                  <input type="text" class="form-control" name="seizure" value="NO" id="seizure" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="seizure_yes" onclick="pick_button('YES','seizure',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="seizure_no" onclick="pick_button('NO','seizure',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>

              <div class="row pt-2 pb-2" style="border-bottom:1px solid gray">
                <div class="col-6">
                  <label for="exampleInputEmail1">HIV<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Immunodeficiency state)</span></label>
                  <input type="text" class="form-control" name="hiv_med" value="NO" id="hiv_med" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="hiv_med_yes" onclick="pick_button('YES','hiv_med',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="hiv_med_no" onclick="pick_button('NO','hiv_med',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div> -->

              
              <div class="row pt-2 pb-2" style="border-bottom:1px solid gray">
                <div class="col-6">
                  <label for="exampleInputEmail1">With Comorbidity<span style="color:red;">*</span></label>
                  <input type="text" class="form-control" name="profile_comorbidity" value="NO" id="profile_comorbidity" hidden>
                </div>
                <div class="col-6 row">
                  <button type="button" id="profile_comorbidity_yes" onclick="pick_button('YES','profile_comorbidity',this)" class="btn btn-custom mr-2 col-5"><b>OO (YES)</b></button>
                  <button type="button" id="profile_comorbidity_no" onclick="pick_button('NO','profile_comorbidity',this)" class="btn btn-custom col-6 btn-no"><b>HINDI (NO)</b></button>
                </div>
              </div>

            </div>
            <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
              <div class="form-group">
                <br>
                <div class="alert alert-danger alert-dismissible fade show" id="statement_registrant_alert" role="alert" style="display:none;">
                <strong>Paalala!</strong> Mangyaring suriin ang checkbox sa ibaba!
                <button type="button" class="close"  onclick="turn_off_required('statement_registrant_alert')" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
              </div> 
                <label for="exampleInputEmail1">Statement of Registrant<span style="color:red;">*</span><br> <span style="color:gray; font-size:14px">(Mangyaring basahin at suriin kung sumasang-ayon ka)</span></label>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" id="customCheckbox1" name="statement_registrant" required alt="required"><span style="color:red;">*</span>
                  <label for="customCheckbox1" class="custom-control-label">I hereby understand and authorize that Bago City will collect and process the data herein for the purpose of effecting control of the COVID-19 infection, my personal information is protected by RA 10173, Data Privacy Act of 2012, and that I am required by RA 11463, Bayanihan to Heal as One Act, to provide thruthful information.</label>
                </div>
              </div>
            </div>
          </div>

          <ul class="nav nav-pills mb-3 mt-4" id="pills-tab" role="tablist">
            <li class="nav-item col-6">
              <a class="nav-link active btn-info text-white col-9 text-center prev-btn" onclick="hide_again()" style="display:none;" id="pills-home-tab" data-toggle="pill" role="tab" aria-controls="pills-home" aria-selected="true"><h5><b>Previous<br><span style="color:white; font-size:12px">(Bumalik)</span></b></h5></a>
            </li>
            <li class="nav-item col-6">
              <a class="nav-link btn-info text-white col-8 offset-4 text-center" onclick="check_first_confirmation(this)" id="pills-profile-tab"  data-toggle="pill" role="tab" aria-controls="pills-profile" aria-selected="false"><h5><b>Next<br><span style="color:white; font-size:12px">(Susunod)</span></b></h5></a>
              <a class="nav-link btn-info text-white col-8 offset-4 text-center" onclick="set_system_cardinal_operation('You want to submit your registration?', 'create', 'survey_form', 'insert_survey.php', 'survey_result', 'none', 'none', 'required_div_add_survey', 'confirmation_create_success', 'none')" id="pills-submit-tab" style="display:none;" role="tab"><h5><b>Submit<br><span style="color:white; font-size:12px">(Ipasa)</span></b></h5></a>
            </li>
          </ul>
        </form>
    </div>
  </div>
  <?php  include '../inc/copyfooter.php'; ?>
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
$('#pills-profile').hide();
function hide_again(){
  document.getElementById("pills-profile-tab").style.display = "block";
  document.getElementById("pills-home-tab").style.display = "none"; 
  document.getElementById("pills-submit-tab").style.display = "none"; 

  $('#pills-home').show();
  $('#pills-profile').hide();
}
function check_first_confirmation(element){

  var form_inputs = document.getElementsByClassName("regis_form"); 
  var form_inputs_error = 0;
  for (i = 0; i < form_inputs.length; i++) { 
    if(form_inputs[i].alt == "required"){
      form_inputs[i].style.borderColor = "gray"; 
      form_inputs[i].style["boxShadow"] = "none";
    } 
    if(form_inputs[i].required == true){
      form_inputs[i].style.borderColor = "gray"; 
      form_inputs[i].style["boxShadow"] = "none";
    }
    
    // Adding UP the red borders for required inputs
    if(form_inputs[i].alt == "required"){
        if(form_inputs[i].value == "" || form_inputs[i].value == "Empty"){
          form_inputs[i].style.borderColor = "red";
          form_inputs[i].style["boxShadow"] = "0 0 5px #f20a0a";
          form_inputs_error++;//adding error if there is empty inputs!!
          
        } 
    }
    if(form_inputs[i].required == true){
      if(form_inputs[i].value == "Empty" || form_inputs[i].value == ""){
        form_inputs[i].style.borderColor = "red";
        form_inputs[i].style["boxShadow"] = "0 0 5px #f20a0a";
        form_inputs_error++;//adding error if there is empty inputs!!
        
      }
    }
    
  }
  if(form_inputs_error != 0){
    document.getElementById("required_div_add_survey").style.display = "block";// if error display error for required inputs
    window.scrollTo(0, 0); 
  } else{
    // $('.nav-item a[href="pills-profile"]').tab('show')///////////////////////fix this part!!!!!!!!!!!!!
    // $('.nav-pills a[href="#pills-profile"]').tab('show');
    $('#pills-profile').show();
    $('#pills-home').hide();
    document.getElementById("required_div_add_survey").style.display = "none";// if error display error for required inputs
    // .hide();
    // document.getElementById("pills-home").style.display = "none";

    element.style.display = "none";
    document.getElementById("pills-home-tab").style.display = "block"; 
    document.getElementById("pills-submit-tab").style.display = "block"; 
  }
}

function select_schedule(sched_value, btn_id){
  button = document.getElementsByClassName("sched_btn_class"); 
  for (i = 0; i < button.length; i++) { 
    button[i].style.backgroundColor = "white";
    button[i].style.color = "rgb(34, 161, 125)";
  } 

  document.getElementById(btn_id).style.backgroundColor = "rgb(34, 161, 125)";
  document.getElementById(btn_id).style.color = "white";

  document.getElementById("schedule_id").value = sched_value;
}

function pick_button(data,id,element){
  document.getElementById(id).value = data;
  if(data == "YES"){
    document.getElementById(id+"_no").style.backgroundColor = "white";
    document.getElementById(id+"_no").style.color = "rgb(34, 161, 125)";
  }else{
    document.getElementById(id+"_yes").style.backgroundColor = "white";
    document.getElementById(id+"_yes").style.color = "rgb(34, 161, 125)";
  }
  element.style.backgroundColor = "rgb(34, 161, 125)";
  element.style.color = "white";
}

function RegistrationRadio(data, target){
  document.getElementById(target).value = data;
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
            if(element_name == "statement_registrant"){
              if(e.checked == false){
                document.getElementById("statement_registrant_alert").style.display = "block";// if error display error for required inputs
                form_inputs_error++;//adding error if there is empty inputs!!
              }
            }

            if(e.type != 'radio'){
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

</body>

</html>
