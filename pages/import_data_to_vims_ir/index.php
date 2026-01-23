<!DOCTYPE html>
<html>
<?php

include '../../controller/systemcore.php'; 
$systemcore = new systemcore();



$System_Sessioning = $systemcore->System_Sessioning("session");

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

    $counter = 0;
    
    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE employmentcategory = '02_A2: Senior Citizens'");
    foreach($SelectTable as $data){ 
      // echo "Operation Data Transfer FTP VIMS IR -<<>>- 1.00.22.980.0000 Operation passage data import SQL syntax coded data {table -> Vaccine_registration [data[".$counter++."]] transfer => VIMS_IR table [data[".$counter++."]] }:: ;=> COMPLETED<br>";
      $id = $data["id"];
      $allergy_to_vaccine = $data["allergy_to_vaccine"];
      $profile_comorbidity = $data["profile_comorbidity"];
      $Category = $data["employmentcategory"];
      $sub_category = $data["sub_category"];
      $lastname = $data["lastname"];
      $firstname = $data["firstname"];
      $middlename = $data["middlename"];
      $suffix = $data["suffix"];
      $contact = $data["contact"];
      $current_residence = $data["current_residence"];
      $region = $data["region"];
      $province = $data["province"];
      $city = $data["city"];
      $brgy = $data["brgy"];
      $gender = $data["gender"];
      $bday = $data["bday"];
      $occupation = $data["ocupation"];

      $date_added = strtotime($data["date_added"]);
      $date_added =  date('Y-m-d', $date_added);
      // if($date_added == date('Y-m-d') && $data["encoded"] == "YES"){$counter++;
      echo "Operation Data Transfer FTP VIMS IR -<<>>- 1.00.22.980.0000 Operation passage data import SQL syntax coded data {table -> Vaccine_registration [data[".$counter."]] transfer => VIMS_IR table [data[".$data['time_stamp']."]] }:: ;=> COMPLETED<br>";
            
      $table = "vims_ir";
      $table_col = "Priority_group, Sub_Priority, last_name, first_name, middle_name, suffix, contact, region, province, city, brgy, sex, bday, occupation, allergy_to_vaccine, with_comorbidity";
      $table_val = "'$Category', '$sub_category', '$lastname', '$firstname', '$middlename', '$suffix', '$contact', '$region', '$province', '$city', '$brgy', '$gender', '$bday', '$occupation', '$allergy_to_vaccine', '$profile_comorbidity'"; 
      $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
      
    }

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