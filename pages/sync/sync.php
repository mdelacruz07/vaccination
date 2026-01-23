<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $System_Sessioning = $systemcore->System_Sessioning("session");
    $count = 0;
    $SelectEntry = $systemcore->SelectCustomize("SELECT * FROM online_data_fetcher");
    if($SelectEntry != "none"){
        foreach($SelectEntry as $value){ $count++;
            $database_main_id = $value["database_main_id"];

            $employmentcategory = $value["employmentcategory"];
            $sub_category = $value["sub_category"];
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
            $region = $value["region"];
            $province = $value["province"];
            $city = $value["city"];
            $civil_status = $value["civil_status"];
            $employment_status = $value["employment_status"];
            $ocupation = $value["ocupation"];
            $agency = $value["agency"];
            $current_residence = $value["current_residence"];
            $pregnant = $value["pregnant"];
            $covid_status = $value["covid_status"];
            $covid_exposure = $value["covid_exposure"];
            $reason_refusal = $value["reason_refusal"];
            $if_severe_allergic = $value["if_severe_allergic"];
            $allergy = $value["allergy"];
            $if_allergy = $value["if_allergy"];
            $dose_1 = $value["dose_1"];
            $dose_2 = $value["dose_2"];
            $allergies_to_PEG = $value["allergies_to_PEG"];
            $bleeding_disorders = $value["bleeding_disorders"];
            $if_bleeding = $value["if_bleeding"];
            $symtoms = $value["symtoms"];
            $if_receive_vaccine = $value["if_receive_vaccine"];
            $comorbidity = $value["comorbidity"];
            $consent = $value["consent"];
            $defferal = $value["defferal"];
            $time_stamp = $value["time_stamp"];
            $convalescent = $value["convalescent"];
            $if_pregnant = $value["if_pregnant"];
            $vaccine_name = $value["vaccine_name"];
            $batch_number = $value["batch_number"];
            $lot_number = $value["lot_number"];
            $vaccinator_name = $value["vaccinator_name"];
            $prof_vaccinator = $value["prof_vaccinator"];
            $medical_clearance = $value["medical_clearance"];
            $allergy_to_vaccine = $value["allergy_to_vaccine"];
            $profile_comorbidity = $value["profile_comorbidity"];
            $qr_id = $value["qr_id"];
            $encoded = $value["encoded"];
            $indigenous = $value["indigenous"];
            $pwd = $value["pwd"];
            $adverse_event = $value["adverse_event"];
            $adverse_event_cons = $value["adverse_event_cons"];
            $encoded_by = $value["encoded_by"];
            $facility_id = $value["facility_id"];

            if($database_main_id == "NEW"){
                echo "<==== Data Process ==>>> Excute 200890, CORE FUNCTION RUNNING <Br> ===----==---=== PORT 95 56 and 58 ======---===POSIBO INSERT PROCESS =}$count{= <Br>";
                
                $table = "vaccine_registration";
                $table_col = "employmentcategory, sub_category, idcategory, idnumber, phid, pwdid, lastname, firstname, middlename, suffix, contact, gender, bday, brgy, region, province, city, civil_status, employment_status, ocupation, agency, current_residence, pregnant, covid_status, covid_exposure, reason_refusal, if_severe_allergic, allergy, if_allergy, dose_1, dose_2, allergies_to_PEG, bleeding_disorders, if_bleeding, symtoms, if_receive_vaccine, comorbidity, consent, defferal, time_stamp, convalescent, if_pregnant, vaccine_name, batch_number, lot_number, vaccinator_name, prof_vaccinator, medical_clearance, allergy_to_vaccine, profile_comorbidity, qr_id, encoded, indigenous, pwd, adverse_event, adverse_event_cons, encoded_by, facility_id";
                $table_val = "'$employmentcategory', '$sub_category', '$idcategory', '$idnumber', '$phid', '$pwdid', '$lastname', '$firstname', '$middlename', '$suffix', '$contact', '$gender', '$bday', '$brgy', '$region', '$province', '$city', '$civil_status', '$employment_status', '$ocupation', '$agency', '$current_residence', '$pregnant', '$covid_status', '$covid_exposure', '$reason_refusal', '$if_severe_allergic', '$allergy', '$if_allergy', '$dose_1', '$dose_2', '$allergies_to_PEG', '$bleeding_disorders', '$if_bleeding', '$symtoms', '$if_receive_vaccine', '$comorbidity', '$consent', '$defferal', '$time_stamp', '$convalescent', '$if_pregnant', '$vaccine_name', '$batch_number', '$lot_number', '$vaccinator_name', '$prof_vaccinator', '$medical_clearance', '$allergy_to_vaccine', '$profile_comorbidity', '$qr_id', '$encoded', '$indigenous', '$pwd', '$adverse_event', '$adverse_event_cons', '$encoded_by', '$facility_id'"; 
                $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
            }else{
                echo "<==== Data Process ==>>> Excute 200890, CORE FUNCTION RUNNING <Br> ===----==---=== PORT 195 156 and 158 ======---===NOSIBO UPDATE PROCESS =}$count{= <Br>";
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
                `ocupation`='$ocupation',
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
                `facility_id`='$facility_id',
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
                `time_stamp`='$time_stamp',
                `vaccinator_name`='$vaccinator_name',
                `prof_vaccinator`='$prof_vaccinator',
                `indigenous`='$indigenous',
                `pwd`='$pwd',
                `adverse_event`='$adverse_event',
                `adverse_event_cons`='$adverse_event_cons',
                `allergy_to_vaccine`='$allergy_to_vaccine',
                `profile_comorbidity`='$profile_comorbidity',
                `medical_clearance`='$medical_clearance'";
                $indicator = "id = '$database_main_id'";
                $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
            }
        }
    }else{
        echo "ERROR 407:::==> DATA IS 0 NO Data Detected 000-.000  \n  EXPORT TO DATABASE TO START THE SYNC \n CALL->BACK TRANSACTION!= 808 PORT@@";
    }