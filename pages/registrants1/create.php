<?php 
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $System_Sessioning = $systemcore->System_Sessioning("session");
    date_default_timezone_set('Asia/Manila');
    session_start();
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
    $batch_number = $_GET["batch_number"];
    $lot_number = $_GET["lot_number"];
    $vaccinator_name = $_GET["vaccinator_name"];
    $prof_vaccinator = $_GET["prof_vaccinator"];
    $dose_1 = $_GET["dose_1"];
    $dose_2 = $_GET["dose_2"];
    $defferal = $_GET["defferal"];
    $time_stamp = $_GET["date_of_vaccination"];
    $reason_refusal = $_GET["reason_refusal"];

    $indigenous = $_GET["indigenous"];
    $pwd = $_GET["pwd"];
    $adverse_event = $_GET["adverse_event"];
    $adverse_event_cons = $_GET["adverse_event_cons"];

    $allergy_to_vaccine = $_GET["allergy_to_vaccine"];
    $profile_comorbidity = $_GET["profile_comorbidity"];

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
      $table_col = "employmentcategory, sub_category, idcategory, idnumber, phid, pwdid, lastname, firstname, middlename, suffix, contact, gender, bday, brgy, region, province, city, civil_status, employment_status, ocupation, agency, current_residence, pregnant, covid_status, covid_exposure, reason_refusal, if_severe_allergic, allergy, if_allergy, dose_1, dose_2, allergies_to_PEG, bleeding_disorders, if_bleeding, symtoms, if_receive_vaccine, comorbidity, consent, defferal, time_stamp, convalescent, if_pregnant, vaccine_name, batch_number, lot_number, vaccinator_name, prof_vaccinator, medical_clearance, allergy_to_vaccine, profile_comorbidity, qr_id, encoded, indigenous, pwd, adverse_event, adverse_event_cons, encoded_by, facility_id";
      $table_val = "'$employmentcategory', '$sub_category', '$idcategory', '$idnumber', '$phid', '$pwdid', '$lastname', '$firstname', '$middlename', '$suffix', '$contact', '$gender', '$bday', '$brgy', '$region', '$province', '$city', '$civil_status', '$employment_status', '$occupation', '$agency', '$current_residence', '$pregnant', '$covid_status', '$covid_exposure', '$reason_refusal', '$if_severe_allergic', '$allergy', '$if_allergy', '$dose_1', '$dose_2', '$allergies_to_PEG', '$bleeding_disorders', '$if_bleeding', '$symtoms', '$if_receive_vaccine', '$comorbidity', '$consent', '$defferal', '$time_stamp', '$convalescent', '$if_pregnant', '$vaccine_name', '$batch_number', '$lot_number', '$vaccinator_name', '$prof_vaccinator', '$medical_clearance', '$allergy_to_vaccine', '$profile_comorbidity', '$code_gen', '$encoded', '$indigenous', '$pwd', '$adverse_event', '$adverse_event_cons', '$encoded_by', '$facility_id'"; 
      $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);

      $table = "post_vaccination";
      $table_col = "qr_id, firstname, middlename, lastname, bday, brgy";
      $table_val = "'$code_gen', '$firstname', '$middlename', '$lastname', '$bday', '$brgy'"; 
      $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);

      ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Success!</strong> The New Registrant Has Been Added.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
          </div>

        <?php

        if($dose_1 != "01_Yes" && $dose_2 != "01_Yes" && strlen($contact) == 11 && substr($contact, 0, 2) == "09"){
          $servername1 = "localhost";
          $username1 = "bagocho_db2";
          $password1 = "june171991";
          $dbname1 = "bagocho_db2_3";
          $conn1 = new mysqli($servername1, $username1, $password1, $dbname1);

          $list_of_outgoing = array();
          $sql1 = "SELECT outgoing FROM SMS_gateway WHERE status = 'active'";
          $result1 = $conn1->query($sql1);
          while($row = $result1->fetch_assoc()) {
            array_push($list_of_outgoing, $row["outgoing"]);
          }

          $current_time = date("Y-m-d H:i");
          $message_minutes = 5;
          $body = "Thank you! You have been registered to our COVID-19 Vaccination Program!\n\nPlease be advised that once you have registered, you are directed to coordinate with your nearest Barangay Health Centers or Barangay Halls for masterlisting.\nThe Bago City LGU will be posting updates regarding the vaccination schedules & the concerned priority groups thru our Bago City Official FB Page The City Bridge\n\nFor More Information:\nOur Automated Text Blast System is available 24/7.\nJust text INFO to any of the following numbers:\n09755696436\n09755696439\n0975569643\n09755696433\n09755696435";
          $static_minutes = 50;
          
          $time = new DateTime($current_time);
          $time->add(new DateInterval('PT' . $message_minutes . 'M'));
          $adding_current_time = $time->format('Y-m-d H:i:00');
      
          $time = new DateTime($adding_current_time);
          $time->sub(new DateInterval('PT' . $static_minutes . 'M'));
          $subtract_current_time = $time->format('Y-m-d H:i:00'); 

          $sql1 = "SELECT SMS_current_outgoing FROM SMS_settings WHERE id = '1'";
          $result1 = $conn1->query($sql1);
          while($row = $result1->fetch_assoc()) {
            if($row["SMS_current_outgoing"]+1 >= count($list_of_outgoing)){
              $position_out = 0;
            }else{
              $position_out = $row["SMS_current_outgoing"] + 1;
            }
          }

          $gateway = $list_of_outgoing[$position_out];
      
          $sql1 = "INSERT INTO SMS_messages (contact, message, time_in, time_out, outgoing_sms) VALUES ('" . $contact . "', '" . $body . "', '" . $subtract_current_time . "', '" . $adding_current_time . "', '" . $gateway . "')";
          $result1 = $conn1->query($sql1);

          $sql1 = "UPDATE SMS_settings SET SMS_current_outgoing = '".$position_out."' WHERE id = '1'";
          $result1 = $conn1->query($sql1);
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

