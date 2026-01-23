<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    
    //Personal Information
    $qr_id = $_GET["qr_id"];
    $if_pregnant = $_GET["if_pregnant"];
    $convalescent = $_GET["convalescent"];
    $chills = $_GET["chills"];
    $headache = $_GET["headache"];
    $cough = $_GET["cough"];
    $colds = $_GET["colds"];
    $sore_throat = $_GET["sore_throat"];
    $myalgia_fatigue_Weakness = $_GET["myalgia_fatigue_Weakness"];
    $smell = $_GET["smell"];
    $diarrhea = $_GET["diarrhea"];
    $difficulty_breathing =$_GET["difficulty_breathing"];
    $if_allergy = $_GET["if_allergy"];
    $if_bleeding = $_GET["if_bleeding"];
    $medical_clearance =$_GET["medical_clearance"];
    $vaccinator_name = $_GET["vaccinator_name"];
    $batch_number = $_GET["batch_number"];
    $lot_number = $_GET["lot_number"];
    $dose = $_GET["dose"];

    $table = "vaccine_registration";
    $col_to_update = "nurse_response='$if_pregnant', vaccination_status='Vaccinated'";
    $indicator = "qr_id = '$qr_id'";
    $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);

    $table = "vaccination_information";
    $table_col = "`qr_id`, `convalescent`, `chills`, `headache`, `cough`, `colds`, `sore_throat`, `myalgia_fatigue_Weakness`, `smell`, `diarrhea`, `difficulty_breathing`, `if_allergy`, `if_bleeding`, `medical_clearance`, `vaccinator_name`, `batch_number`, `lot_number`, `dose`";
    $table_val = "'$qr_id','$convalescent', '$chills', '$headache', '$cough', '$colds', '$sore_throat', '$myalgia_fatigue_Weakness', '$smell', '$diarrhea', '$difficulty_breathing', '$if_allergy', '$if_bleeding', '$medical_clearance', '$vaccinator_name', '$batch_number', '$lot_number', '$dose'"; 
    $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);

    $greetings = array("We appreciate all you do!", "Sending thanks and warm thoughts to all of you who are working through these challenging times", "Thank you for giving your strength to so many", "We are thankful for your commitment to caring for our community!", "Your dedication and skill are making a difference", "We are here for you!!! Thanks for being there for us", "We are so grateful for your support", "We are very lucky to have you, and we know it", "Thank you so much for what you are doing for our world", "You are truly a hero. Thank you", "You show us that we are all in this together", "Every day you make a commitment to serve. Thank you", "You are one of the best and the bravest", "Your selfless service to the greater community is helping us all get through these tough times", "Your tireless efforts are not going unnoticed. Thank you", "You have my support and heartfelt appreciation for all you do", "We are deeply grateful to you for all the sacrifices that you and your family are making", "Words are not enough to thank you for your strength, courage and dedication", "Being on the frontline isn’t easy, but it is very much appreciated","Stay safe. I’m rooting for you", "You deserve our applause, our thanks and our respect", "You are making a bigger impact than you realize", "Our community is better because you are a part of it", "Thank you for everything you are doing to help us all", "We depend on your strength and can never thank you enough");
    $greetings_to_say = $greetings[rand(0,24)];
?>
<center>
<h1>Success!</h1>
<p>(The Registrant Information has been Updated!)</p>

<div class="alert alert-warning fade show text-center">
  <h2><strong>Thank You!</strong></h2>
  <p><?php echo $greetings_to_say; ?></p>
</div>
</center>
<img src="../../dist/img/frontliner.jpg" alt="User Image" width="90%" class="mx-auto d-block">