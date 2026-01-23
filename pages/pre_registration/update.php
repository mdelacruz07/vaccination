<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    
    $registration_id = $_GET["registration_id"];
    $vaccine_name = $_GET["vaccine_name"];
    $employmentcategory = $_GET["employmentcategory"];
    $current_residence = $_GET["current_residence"];
    $civil_status = $_GET["civil_status"];
    $employment_status = $_GET["employment_status"];
    $sub_category = $_GET["sub_category"];

    $province = $_GET["province"];
    $city = $_GET["city"];
    $region = $_GET["region"];

    $idcategory = $_GET["idcategory"];
    $idnumber = $_GET["idnumber"];
    $phid = $_GET["phid"];
    $pwdid = $_GET["pwdid"];
    $lastname = $_GET["lastname"];
    $firstname = $_GET["firstname"];
    $middlename = $_GET["middlename"];
    $suffix = $_GET["suffix"];
    $contact = $_GET["contact"];
    $gender = $_GET["gender"];
    $bday = $_GET["bday"];
    $brgy = $_GET["brgy"];
    $pregnant = $_GET["pregnant"];
    $covid_status = $_GET["covid_status"];
    $covid_exposure = $_GET["covid_exposure"];
  
    $medical_clearance = $_GET["medical_clearance"];
    $occupation = $_GET["occupation"];
    $agency = $_GET["agency"];
    $if_allergy = $_GET["if_allergy"];
    $if_severe_allergic = $_GET["if_severe_allergic"];
    $bleeding_disorders = $_GET["bleeding_disorders"];
    $allergies_to_PEG = $_GET["allergies_to_PEG"];
    $allergy = $_GET["allergy"];
    $if_bleeding = $_GET["if_bleeding"];
    $symtoms = $_GET["symtoms"];
    $if_receive_vaccine = $_GET["if_receive_vaccine"];
    $convalescent = $_GET["convalescent"];
    $if_pregnant = $_GET["if_pregnant"];
    $comorbidity = $_GET["comorbidity"];
    $consent = $_GET["consent"];
    $date_added = $_GET["time_stamp"];
    $batch_number = $_GET["batch_number"];
    $lot_number = $_GET["lot_number"];
    $vaccinator_name = $_GET["vaccinator_name"];
    $prof_vaccinator = $_GET["prof_vaccinator"];
    $dose_1 = $_GET["dose_1"];
    $dose_2 = $_GET["dose_2"];
    $defferal = $_GET["defferal"];

    $allergy_to_vaccine = $_GET["allergy_to_vaccine"];
    $profile_comorbidity = $_GET["profile_comorbidity"];


    $table = "vaccine_registration";
    $col_to_update = "`employmentcategory`= '$employmentcategory',
    `sub_category`='$sub_category',
    `idcategory`='$idcategory',
    `idnumber`='$idnumber',
    `phid`='$phid',
    `pwdid`='$pwdid',
    `lastname`='$lastname',
    `firstname`='$firstname',
    `middlename`='$middlename',
    `suffix`='$suffix',
    `contact`='$contact',
    `gender`='$gender',
    `bday`='$bday',
    `brgy`='$brgy',
    `region`='$region',
    `province`='$province',
    `city`='$city',
    `civil_status`='$civil_status',
    `employment_status`='$employment_status',
    `ocupation`='$occupation',
    `agency`='$agency',
    `current_residence`='$current_residence',
    `pregnant`='$pregnant',
    `covid_status`='$covid_status',
    `covid_exposure`='$covid_exposure',
    `if_severe_allergic`='$if_severe_allergic',
    `allergy`='$allergy',
    `if_allergy`='$if_allergy',
    `dose_1`='$dose_1',
    `dose_2`='$dose_2',
    `allergies_to_PEG`='$allergies_to_PEG',
    `bleeding_disorders`='$bleeding_disorders',
    `if_bleeding`='$if_bleeding',
    `symtoms`='$symtoms',
    `if_receive_vaccine`='$if_receive_vaccine',
    `comorbidity`='$comorbidity',
    `consent`='$consent',
    `defferal`='$defferal',
    `convalescent`='$convalescent',
    `if_pregnant`='$if_pregnant',
    `vaccine_name`='$vaccine_name',
    `batch_number`='$batch_number',
    `lot_number`='$lot_number',
    `vaccinator_name`='$vaccinator_name',
    `prof_vaccinator`='$prof_vaccinator',
    `allergy_to_vaccine`='$allergy_to_vaccine',
    `profile_comorbidity`='$profile_comorbidity',
    `medical_clearance`='$medical_clearance'";
    $indicator = "id = '$registration_id'";
    $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> The Regestrant Has Been Updated.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>