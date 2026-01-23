<!DOCTYPE html>
<html>
<?php

include '../../controller/systemcore.php'; 
$systemcore = new systemcore();
include '../inc/header.php';
?>
<body style="background-color:black; color:rgb(153, 191, 167); margin-left:20px;">
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>System Import VIMS_IR</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../index/">Home</a></li>
              <li class="breadcrumb-item active"><?php echo date("F d Y"); ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php
    $SelectGroups = $systemcore->DeleteTable("back_up", "vaccination_status = 'Not-Vaccinated'");
    $counter = 0;
    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration");
    foreach($SelectTable as $data){ 
      echo "Operation Data Transfer FTP VIMS IR -<<>>- 1.00.22.980.0000 Operation passage data import SQL syntax coded data {table -> Vaccine_registration [data[".$counter++."]] transfer => VIMS_IR table [data[".$counter++."]] }:: ;=> COMPLETED<br>";
      $counter++;

      $qr_id = $data["qr_id"];
      $employmentcategory = $data["employmentcategory"];
      $sub_category = $data["sub_category"];
      $idcategory = $data["idcategory"];
      $idnumber = $data["idnumber"];
      $phid = $data["phid"];
      $pwdid = $data["pwdid"];
      $lastname = $data["lastname"];
      $firstname = $data["firstname"];
      $middlename = $data["middlename"];
      $suffix = $data["suffix"];
      $contact = $data["contact"];
      $gender = $data["gender"];
      $bday = $data["bday"];
      $brgy = $data["brgy"];
      $region = $data["region"];
      $province = $data["province"];
      $city = $data["city"];
      $civil_status = $data["civil_status"];
      $employment_status = $data["employment_status"];
      $ocupation = $data["ocupation"];
      $agency = $data["agency"];
      $current_residence = $data["current_residence"];
      $pregnant = $data["pregnant"];
      $nurse_response = $data["nurse_response"];
      $covid_status = $data["covid_status"];
      $covid_exposure = $data["covid_exposure"];
      $vaccination_status = $data["vaccination_status"];
      $reason_refusal = $data["reason_refusal"];
      $if_severe_allergic = $data["if_severe_allergic"];
      $allergy = $data["allergy"];
      $if_allergy = $data["if_allergy"];
      $dose_1 = $data["dose_1"];
      $dose_2 = $data["dose_2"];
      $allergies_to_PEG = $data["allergies_to_PEG"];
      $bleeding_disorders = $data["bleeding_disorders"];
      $if_bleeding = $data["if_bleeding"];
      $symtoms = $data["symtoms"];
      $if_receive_vaccine = $data["if_receive_vaccine"];
      $comorbidity = $data["comorbidity"];
      $consent = $data["consent"];
      $defferal = $data["defferal"];
      $time_stamp = $data["time_stamp"];
      $convalescent = $data["convalescent"];
      $if_pregnant = $data["if_pregnant"];
      $vaccine_name = $data["vaccine_name"];
      $batch_number = $data["batch_number"];
      $lot_number = $data["lot_number"];
      $vaccinator_name = $data["vaccinator_name"];
      $prof_vaccinator = $data["prof_vaccinator"];
      $medical_clearance = $data["medical_clearance"];
      $allergy_to_vaccine = $data["allergy_to_vaccine"];
      $profile_comorbidity = $data["profile_comorbidity"];
      $encoded = $data["encoded"];
      $covid_classification = $data["covid_classification"];
      $date_added = $data["date_added"];

      $table = "back_up";
      $table_col = "`qr_id`, `employmentcategory`, `sub_category`, `idcategory`, `idnumber`, `phid`, `pwdid`, `lastname`, `firstname`, `middlename`, `suffix`, `contact`, `gender`, `bday`, `brgy`, `region`, `province`, `city`, `civil_status`, `employment_status`, `ocupation`, `agency`, `current_residence`, `pregnant`, `nurse_response`, `covid_status`, `covid_exposure`, `vaccination_status`, `reason_refusal`, `if_severe_allergic`, `allergy`, `if_allergy`, `dose_1`, `dose_2`, `allergies_to_PEG`, `bleeding_disorders`, `if_bleeding`, `symtoms`, `if_receive_vaccine`, `comorbidity`, `consent`, `defferal`, `time_stamp`, `convalescent`, `if_pregnant`, `vaccine_name`, `batch_number`, `lot_number`, `vaccinator_name`, `prof_vaccinator`, `medical_clearance`, `allergy_to_vaccine`, `profile_comorbidity`, `encoded`, `covid_classification`, `date_added`";
      $table_val = "'$qr_id', '$employmentcategory', '$sub_category', '$idcategory', '$idnumber', '$phid', '$pwdid', '$lastname', '$firstname', '$middlename', '$suffix', '$contact', '$gender', '$bday', '$brgy', '$region', '$province', '$city', '$civil_status', '$employment_status', '$ocupation', '$agency', '$current_residence', '$pregnant', '$nurse_response', '$covid_status', '$covid_exposure', '$vaccination_status', '$reason_refusal', '$if_severe_allergic', '$allergy', '$if_allergy', '$dose_1', '$dose_2', '$allergies_to_PEG', '$bleeding_disorders', '$if_bleeding', '$symtoms', '$if_receive_vaccine', '$comorbidity', '$consent', '$defferal', '$time_stamp', '$convalescent', '$if_pregnant', '$vaccine_name', '$batch_number', '$lot_number', '$vaccinator_name', '$prof_vaccinator', '$medical_clearance', '$allergy_to_vaccine', '$profile_comorbidity', '$encoded', '$covid_classification', '$date_added'"; 
      $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
     
    }
    echo $counter;

    echo "<br>";
    echo "<br>";

    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";

    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";

    ?>

    <!-- Main content -->
    <section class="content">
      

    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->

    <?php 
        include '../inc/confirmation.php';
        include '../inc/footer.php';
    ?>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>