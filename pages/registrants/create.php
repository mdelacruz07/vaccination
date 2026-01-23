<?php 
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $System_Sessioning = $systemcore->System_Sessioning("session");
    date_default_timezone_set('Asia/Manila');
    // session_start();
    $date_added = date("Y-m-d");

    $booster = $_GET["booster"];
    $vaccine_name = $_GET["vaccine_name"]; // 1st vaccine name
    $batch_number = $_GET["batch_number"]; // 1st vaccine batch no
    $lot_number = $_GET["lot_number"]; // 1st vaccine lot no
    $time_stamp = $_GET["date_of_vaccination"]; // 1st vaccine date

    $sec_vaccine_name = $_GET["sec_vaccine_name"]; // 2nd vaccine name
    $sec_batch_number = $_GET["sec_batch_number"]; // 2nd vaccine batch no
    $sec_lot_number = $_GET["sec_lot_number"]; // 2nd vaccine lot no
    $sec_time_stamp = $_GET["sec_date_of_vaccination"]; // 2nd vaccine date

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
    $lastname = strtoupper($_GET["lastname"]);
    $firstname = strtoupper($_GET["firstname"]);
    $middlename = strtoupper($_GET["middlename"]);
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
    $vaccinator_name = $_GET["vaccinator_name"];
    $prof_vaccinator = $_GET["prof_vaccinator"];
    $dose_1 = $_GET["dose_1"];
    $dose_2 = $_GET["dose_2"];
    $defferal = $_GET["defferal"];
    $reason_refusal = $_GET["reason_refusal"];
    $indigenous = $_GET["indigenous"];
    $pwd = $_GET["pwd"];
    $adverse_event = $_GET["adverse_event"];
    $adverse_event_cons = $_GET["adverse_event_cons"];
    $allergy_to_vaccine = $_GET["allergy_to_vaccine"];
    $profile_comorbidity = $_GET["profile_comorbidity"];
    $guardian = $_GET["guardian"];
    $ped_comorbid = $_GET["ped_comorbid"];

    $encoded = "YES";

    $encoded_by = $_SESSION["user_full_name"];


    if($dose_1 == "01_Yes" || $dose_2 == "01_Yes"){
      $facility_id = $_SESSION["user_facility"];  
    }else{
      $facility_id = " ";
    }

    $letters=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
    $code_gen = $letters[rand(0,49)].$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].rand(10,99);

    $SelectDoubleEntry = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE firstname = '$firstname' AND lastname = '$lastname' AND middlename = '$middlename'");
    if($SelectDoubleEntry == "none"){

      $table = "vaccine_registration";
      $table_col = "employmentcategory, sub_category, idcategory, idnumber, phid, pwdid, lastname, firstname, middlename, suffix, contact, gender, bday, brgy, region, province, city, civil_status, employment_status, ocupation, agency, current_residence, pregnant, covid_status, covid_exposure, reason_refusal, if_severe_allergic, allergy, if_allergy, dose_1, dose_2, allergies_to_PEG, bleeding_disorders, if_bleeding, symtoms, if_receive_vaccine, comorbidity, consent, defferal, time_stamp, convalescent, if_pregnant, vaccine_name, batch_number, lot_number, vaccinator_name, prof_vaccinator, medical_clearance, allergy_to_vaccine, profile_comorbidity, qr_id, encoded, indigenous, pwd, adverse_event, adverse_event_cons, encoded_by, facility_id, guardian, ped_comorbid, booster, sec_vaccine_name, sec_batch_number, sec_lot_number, sec_date_of_vaccination";
      $table_val = "'$employmentcategory', '$sub_category', '$idcategory', '$idnumber', '$phid', '$pwdid', '$lastname', '$firstname', '$middlename', '$suffix', '$contact', '$gender', '$bday', '$brgy', '$region', '$province', '$city', '$civil_status', '$employment_status', '$occupation', '$agency', '$current_residence', '$pregnant', '$covid_status', '$covid_exposure', '$reason_refusal', '$if_severe_allergic', '$allergy', '$if_allergy', '$dose_1', '$dose_2', '$allergies_to_PEG', '$bleeding_disorders', '$if_bleeding', '$symtoms', '$if_receive_vaccine', '$comorbidity', '$consent', '$defferal', '$time_stamp', '$convalescent', '$if_pregnant', '$vaccine_name', '$batch_number', '$lot_number', '$vaccinator_name', '$prof_vaccinator', '$medical_clearance', '$allergy_to_vaccine', '$profile_comorbidity', '$code_gen', '$encoded', '$indigenous', '$pwd', '$adverse_event', '$adverse_event_cons', '$encoded_by', '$facility_id', '$guardian', '$ped_comorbid', '$booster', '$sec_vaccine_name', '$sec_batch_number', '$sec_lot_number', '$sec_time_stamp'"; 
      $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);

      $table = "local_data_fetcher";
      $table_col = "employmentcategory, sub_category, idcategory, idnumber, phid, pwdid, lastname, firstname, middlename, suffix, contact, gender, bday, brgy, region, province, city, civil_status, employment_status, ocupation, agency, current_residence, pregnant, covid_status, covid_exposure, reason_refusal, if_severe_allergic, allergy, if_allergy, dose_1, dose_2, allergies_to_PEG, bleeding_disorders, if_bleeding, symtoms, if_receive_vaccine, comorbidity, consent, defferal, time_stamp, convalescent, if_pregnant, vaccine_name, batch_number, lot_number, vaccinator_name, prof_vaccinator, medical_clearance, allergy_to_vaccine, profile_comorbidity, qr_id, encoded, indigenous, pwd, adverse_event, adverse_event_cons, encoded_by, facility_id, guardian, ped_comorbid, booster, sec_vaccine_name, sec_batch_number, sec_lot_number, sec_date_of_vaccination";
      $table_val = "'$employmentcategory', '$sub_category', '$idcategory', '$idnumber', '$phid', '$pwdid', '$lastname', '$firstname', '$middlename', '$suffix', '$contact', '$gender', '$bday', '$brgy', '$region', '$province', '$city', '$civil_status', '$employment_status', '$occupation', '$agency', '$current_residence', '$pregnant', '$covid_status', '$covid_exposure', '$reason_refusal', '$if_severe_allergic', '$allergy', '$if_allergy', '$dose_1', '$dose_2', '$allergies_to_PEG', '$bleeding_disorders', '$if_bleeding', '$symtoms', '$if_receive_vaccine', '$comorbidity', '$consent', '$defferal', '$time_stamp', '$convalescent', '$if_pregnant', '$vaccine_name', '$batch_number', '$lot_number', '$vaccinator_name', '$prof_vaccinator', '$medical_clearance', '$allergy_to_vaccine', '$profile_comorbidity', '$code_gen', '$encoded', '$indigenous', '$pwd', '$adverse_event', '$adverse_event_cons', '$encoded_by', '$facility_id', '$guardian', '$ped_comorbid', '$booster', '$sec_vaccine_name', '$sec_batch_number', '$sec_lot_number', '$sec_time_stamp'"; 
      $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);

      $SelectifAdded = $systemcore->SelectCustomize("SELECT * FROM local_data_fetcher WHERE firstname = '$firstname' AND lastname = '$lastname' AND middlename = '$middlename'");
      if($SelectifAdded != "none"){ ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> The New Registrant Has Been Added.
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div><?php
      }
      else{ ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> The Registrant Has Not Been Added(Network Error!!).
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
        </div><?php
      } 
    }else{
      ?>

      <div class="alert alert-danger alert-dismissible fade show" role="alert">
       <strong>Error!</strong> The Registrant Has Not Been Added(Double Entry!!).
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
         </button>
       </div>
     
     <?php
    }

     include '../../controller/systemtable.php'; 
    $systemtable = new systemtable();
    $table_name = $_GET["table_name"];

    $SelectTable = $systemtable->SelectingTable($table_name,'none');

    // echo "<h1 style='color:red'>READ ME! Attention!: Kindly Encode the Consent, Request From Mam Ceander!:) and Miss Gerty PM me on messenger Thank You --Bryan</h1>";
?>

