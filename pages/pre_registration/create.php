<?php 
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    $date_added = date("Y-m-d");

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
    $gender = $_GET["gender"];
    $bday = $_GET["bday"];
    $brgy = $_GET["brgy"];
    $contact = $_GET["contact"];
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
    $batch_number = $_GET["batch_number"];
    $lot_number = $_GET["lot_number"];
    $vaccinator_name = $_GET["vaccinator_name"];
    $prof_vaccinator = $_GET["prof_vaccinator"];
    $dose_1 = $_GET["dose_1"];
    $dose_2 = $_GET["dose_2"];
    $defferal = $_GET["defferal"];
    $time_stamp = $_GET["date_of_vaccination"];
    $reason_refusal = $_GET["reason_refusal"];

    $allergy_to_vaccine = $_GET["allergy_to_vaccine"];
    $profile_comorbidity = $_GET["profile_comorbidity"];

    $encoded = "YES";

    $letters=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
    $code_gen = $letters[rand(0,49)].$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].$letters[rand(0,49)].rand(10,99).$idnumber;

    $SelectDoubleEntry = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE firstname = '$firstname' AND lastname = '$lastname' AND middlename = '$middlename' AND suffix = '$suffix' AND bday = '$bday'");
    if($SelectDoubleEntry == "none"){
      $table = "vaccine_registration";
      $table_col = "employmentcategory, sub_category, idcategory, idnumber, phid, pwdid, lastname, firstname, middlename, suffix, contact, gender, bday, brgy, region, province, city, civil_status, employment_status, ocupation, agency, current_residence, pregnant, covid_status, covid_exposure, reason_refusal, if_severe_allergic, allergy, if_allergy, dose_1, dose_2, allergies_to_PEG, bleeding_disorders, if_bleeding, symtoms, if_receive_vaccine, comorbidity, consent, defferal, time_stamp, convalescent, if_pregnant, vaccine_name, batch_number, lot_number, vaccinator_name, prof_vaccinator, medical_clearance, allergy_to_vaccine, profile_comorbidity, qr_id, encoded";
      $table_val = "'$employmentcategory', '$sub_category', '$idcategory', '$idnumber', '$phid', '$pwdid', '$lastname', '$firstname', '$middlename', '$suffix', '$contact', '$gender', '$bday', '$brgy', '$region', '$province', '$city', '$civil_status', '$employment_status', '$occupation', '$agency', '$current_residence', '$pregnant', '$covid_status', '$covid_exposure', '$reason_refusal', '$if_severe_allergic', '$allergy', '$if_allergy', '$dose_1', '$dose_2', '$allergies_to_PEG', '$bleeding_disorders', '$if_bleeding', '$symtoms', '$if_receive_vaccine', '$comorbidity', '$consent', '$defferal', '$time_stamp', '$convalescent', '$if_pregnant', '$vaccine_name', '$batch_number', '$lot_number', '$vaccinator_name', '$prof_vaccinator', '$medical_clearance', '$allergy_to_vaccine', '$profile_comorbidity', '$code_gen', '$encoded'"; 
      $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
    }
?>

 <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> The New Registrant Has Been Added.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
  </div>

<?php
     include '../../controller/systemtable.php'; 
    $systemtable = new systemtable();
    $table_name = $_GET["table_name"];

    $SelectTable = $systemtable->SelectingTable($table_name,'none');

    // echo "<h1 style='color:red'>READ ME! Attention!: Kindly Encode the Consent, Request From Mam Ceander!:) and Miss Gerty PM me on messenger Thank You --Bryan</h1>";
?>

