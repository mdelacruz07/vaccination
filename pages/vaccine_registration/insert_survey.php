<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    //Personal Information
    $employmentcategory = $_GET["employmentcategory"];
    $sub_category = $_GET["sub_category"];
    $idcategory = $_GET["idcategory"];
    $idnumber = $_GET["idnumber"];
    $phid = $_GET["phid"];
    $pwdid = $_GET["pwdid"];
    $lastname = strtoupper($_GET["lastname"]);
    $firstname = strtoupper($_GET["firstname"]);
    $middlename = strtoupper($_GET["middlename"]);
    $suffix = $_GET["suffix"];
    $contact = $_GET["contact"];
    $gender =$_GET["gender"];
    $bday = $_GET["bday"];
    $region = $_GET["region"];
    $province = $_GET["province"];
    $city = $_GET["city"];
    $brgy = $_GET["brgy"];
    $vaccine_allergy = $_GET["vaccine_allergy"];
    if($vaccine_allergy == "NO"){
        $vaccine_allergy = "02_No";
    }else{
        $vaccine_allergy = "01_Yes";
    }
    $occupation = $_GET["occupation"];
    if($occupation == " "){
        $occupation = "N/A";
    }
    $covid_classification = $_GET["covid_classification"];
    $consent = $_GET["consent"];
    if($consent == "NO"){
        $consent = "02_No";
    }else{
        $consent = "01_Yes";
    }
    $civil_status = $_GET["civil_status"];
    $employment_status =$_GET["employment_status"];
    $current_residence = $_GET["current_residence"];


    $pregnant =$_GET["pregnant"];

    if($pregnant == "YES"){
        $pregnant = "02_No";
    }else{
        $pregnant = "01_Yes";
    }

    $covid_status = $_GET["covid_status"];
    if($covid_status == "NO"){
        $covid_status = "02_No";
    }else{
        $covid_status = "01_Yes";
    }
    $covid_exposure = $_GET["covid_exposure"];
    if($covid_exposure == "NO"){
        $covid_exposure = "02_No";
    }else{
        $covid_exposure = "01_Yes";
    }

    $letters=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z");
    $code_gen = $letters[rand(0,49)].$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].$letters[rand(0,49)].rand(10,99).$letters[rand(0,49)].$letters[rand(0,49)].rand(10,99);

    //Allergy Information
    $PEG_alergy = $_GET["PEG_alergy"];
    $food_alergy = $_GET["food_alergy"];
    $drug_alergy = $_GET["drug_alergy"];
    $pollen_alergy = $_GET["pollen_alergy"];
    $insect_alergy = $_GET["insect_alergy"];
    $pet_alergy = $_GET["pet_alergy"];
    $mold_alergy = $_GET["mold_alergy"];
    $latex_alergy = $_GET["latex_alergy"];
    $allergy = "02_No";
    if($food_alergy == "YES"){ $allergy = "01_Yes";}
    if($pollen_alergy == "YES"){ $allergy = "01_Yes";}
    if($insect_alergy == "YES"){ $allergy = "01_Yes";}
    if($pet_alergy == "YES"){ $allergy = "01_Yes";}
    if($mold_alergy == "YES"){ $allergy = "01_Yes";}
    if($latex_alergy == "YES"){ $allergy = "01_Yes";}

    //Med Information
    $lung_disease = $_GET["lung_disease"];
    $kidney_disease = $_GET["kidney_disease"];
    $diabetes = $_GET["diabetes"];
    $transplant = $_GET["transplant"];
    $leukemia = $_GET["leukemia"];
    $blood_disease = $_GET["blood_disease"];
    $heart_disease = $_GET["heart_disease"];
    $asthma = $_GET["asthma"];
    $hypertension = $_GET["hypertension"];
    $cancer_med = $_GET["cancer_med"];
    $seizure =$_GET["seizure"];
    $hiv_med = $_GET["hiv_med"];
    $comorbidity = "";
    $profile_comorbidity = "02_No";
    if($lung_disease == "YES"){ $comorbidity = $comorbidity.", lung disease"; $profile_comorbidity = "01_Yes";}
    if($kidney_disease == "YES"){ $comorbidity = $comorbidity.", kidney disease"; $profile_comorbidity = "01_Yes";}
    if($transplant == "YES"){ $comorbidity = $comorbidity.", transplant"; $profile_comorbidity = "01_Yes";}
    if($leukemia == "YES"){ $comorbidity = $comorbidity.", leukemia"; $profile_comorbidity = "01_Yes";}
    if($blood_disease == "YES"){ $comorbidity = $comorbidity.", blood disease"; $profile_comorbidity = "01_Yes";}
    if($heart_disease == "YES"){ $comorbidity = $comorbidity.", heart disease"; $profile_comorbidity = "01_Yes";}
    if($asthma == "YES"){ $comorbidity = $comorbidity.", asthma"; $profile_comorbidity = "01_Yes";}
    if($hypertension == "YES"){ $comorbidity = $comorbidity.", hypertension"; $profile_comorbidity = "01_Yes";}
    if($cancer_med == "YES"){ $comorbidity = $comorbidity.", cancer "; $profile_comorbidity = "01_Yes";}
    if($seizure == "YES"){ $comorbidity = $comorbidity.", seizure"; $profile_comorbidity = "01_Yes";}
    if($hiv_med == "YES"){ $comorbidity = $comorbidity.", hiv"; $profile_comorbidity = "01_Yes";}
    $profile_comorbidity = $_GET["profile_comorbidity"];
    $encoded = "Online Registration";
    $SelectDoubleEntry = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE firstname = '$firstname' AND lastname = '$lastname' AND middlename = '$middlename'");
    if($SelectDoubleEntry == "none"){

        $table = "vaccine_registration";
        $table_col = "employmentcategory, sub_category, idcategory, idnumber, phid, pwdid, lastname, firstname, middlename, suffix, contact, gender, bday, brgy, region, province, city, civil_status, 
        employment_status, ocupation, current_residence, pregnant, covid_status, covid_exposure, allergy, comorbidity, consent, allergy_to_vaccine, profile_comorbidity, qr_id, encoded, covid_classification";
        $table_val = "'$employmentcategory', '$sub_category', '$idcategory', '$idnumber', '$phid', '$pwdid', '$lastname', '$firstname', '$middlename', '$suffix', '$contact', '$gender', '$bday', 
        '$brgy', '$region', '$province', '$city', '$civil_status', '$employment_status', '$occupation', '$current_residence', '$pregnant', '$covid_status', '$covid_exposure', 
        '$allergy', '$comorbidity', '$consent', '$vaccine_allergy', 
        '$profile_comorbidity', '$code_gen', '$encoded', '$covid_classification'"; 
        
        $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
  
        $table = "post_vaccination";
        $table_col = "qr_id, firstname, middlename, lastname, bday, brgy";
        $table_val = "'$code_gen', '$firstname', '$middlename', '$lastname', '$bday', '$brgy'"; 
        $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);


        ///SMSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSSS?????????????????????????????S<MSMSMSMS
        if(strlen($contact) == 11 && substr($contact, 0, 2) == "09"){
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
    }
?>
<center>
<h2>Thank you have been registered to our COVID-19 vaccination program!</h2><Br>
<hr>
<p>The Bago City LGU will be posting updates regarding the vaccination schedules and the concerned priority groups or you can coordinate with your nearest Barangay Health Center/Barangay Hall. </p><Br>
<hr>
<h3>Priority Group</h3>
<b>01_A1: Health Care Workers</b><br>
<b>01_A1.8: Outbound OFWS with 4 Months Deployment </b><br>
<b>01_A1.9: Family Members of Healthcare Workers Working on Referral Hospitals, Hospitals Catering to Covid 19 Cases and Quarantine Isolation Facilities</b><br>
<b>02_A2: Senior Citizens</b><br>
<b>03_A3: Adult with Comorbidity</b><br>
<b>04_A4: Frontline Personnel in Essential Sector</b><br>
<hr>
<h3>For More Information:</h3>
<p>Our Automated Text Blast System is available 24/7.<br> Just text INFO to any of the following numbers</p><br>
<b>09755696436</b><br>
<b>09755696439</b><br>
<b>09755696430</b><br>
<b>09755696433</b><br>
<b>09755696435</b><br>
<!-- <p><span style="color:gray; font-size:14px">(Salamat! para sa iyong pagrehistro sa aming programa sa pagbabakuna laban sa COVID-19!)</span></p> -->
</center>
<hr>
<!-- <center><button type="button" class="btn btn-success"><a href="http://bagocho.pagenet.info/" style="color:white;">Visit Bago City </a></button></center> -->