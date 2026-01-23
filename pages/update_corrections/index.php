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

    // $counter = 0;
    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE province = 'NA' OR province = ' '");
    // foreach($SelectTable as $data){ 
     
    //   $registration_id = $data["id"];
    //   $table = "vaccine_registration";
    //   $col_to_update = "`province`='N/A'";
    //   $indicator = "id = '$registration_id'";
    //   $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    // }
    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE brgy = 'NA' OR brgy = ' '");
    // foreach($SelectTable as $data){ 
     
    //   $registration_id = $data["id"];
    //   $table = "vaccine_registration";
    //   $col_to_update = "`brgy`='N/A'";
    //   $indicator = "id = '$registration_id'";
    //   $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    // }
    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE region = 'NA' OR region = ' '");
    // foreach($SelectTable as $data){ 
     
    //   $registration_id = $data["id"];
    //   $table = "vaccine_registration";
    //   $col_to_update = "`region`='N/A'";
    //   $indicator = "id = '$registration_id'";
    //   $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    // }
    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE city = 'NA' OR city = ' '");
    // foreach($SelectTable as $data){ 
     
    //   $registration_id = $data["id"];
    //   $table = "vaccine_registration";
    //   $col_to_update = "`city`='N/A'";
    //   $indicator = "id = '$registration_id'";
    //   $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    // }

    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE employmentcategory = '07_Comorbidities'");
    foreach($SelectTable as $data){ 
     
      $registration_id = $data["id"];
      $table = "vaccine_registration";
      $col_to_update = "`employmentcategory`='03_A3: Adult with Comorbidity'";
      $indicator = "id = '$registration_id'";
      $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    }

    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE employmentcategory = '02_Senior_Citizen'");
    foreach($SelectTable as $data){ 
     
      $registration_id = $data["id"];
      $table = "vaccine_registration";
      $col_to_update = "`employmentcategory`='02_A2: Senior Citizens'";
      $indicator = "id = '$registration_id'";
      $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    }

    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE employmentcategory = '01_Health_Care_Worker'");
    foreach($SelectTable as $data){ 
     
      $registration_id = $data["id"];
      $table = "vaccine_registration";
      $col_to_update = "`employmentcategory`='01_A1: Health Care Workers'";
      $indicator = "id = '$registration_id'";
      $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    }

    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE employmentcategory = '05_Essential_Worker'");
    foreach($SelectTable as $data){ 
     
      $registration_id = $data["id"];
      $table = "vaccine_registration";
      $col_to_update = "`employmentcategory`='08_B3: Other Essential Workers'";
      $indicator = "id = '$registration_id'";
      $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    }

    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE employmentcategory = '04_Uniformed_Personnel'");
    foreach($SelectTable as $data){ 
     
      $registration_id = $data["id"];
      $table = "vaccine_registration";
      $col_to_update = "`employmentcategory`='06_B1: Teachers and Social Workers'";
      $indicator = "id = '$registration_id'";
      $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    }

    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE employmentcategory = '06_Other'");
    foreach($SelectTable as $data){ 
     
      $registration_id = $data["id"];
      $table = "vaccine_registration";
      $col_to_update = "`employmentcategory`='11_B6: Other Remaining Workforce'";
      $indicator = "id = '$registration_id'";
      $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    }

    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE employmentcategory = '11_B6: Other Remaing Workforce'");
    foreach($SelectTable as $data){ 
     
      $registration_id = $data["id"];
      $table = "vaccine_registration";
      $col_to_update = "`employmentcategory`='11_B6: Other Remaining Workforce'";
      $indicator = "id = '$registration_id'";
      $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    }

    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE sub_category = 'NA' OR sub_category = ' '");
    // foreach($SelectTable as $data){ 
     
    //   $registration_id = $data["id"];
    //   $table = "vaccine_registration";
    //   $col_to_update = "`sub_category`='N/A'";
    //   $indicator = "id = '$registration_id'";
    //   $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    // }

// SUBBCATEGORY
    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE sub_category = '11_'");
    // foreach($SelectTable as $data){ 
     
    //   $registration_id = $data["id"];
    //   $table = "vaccine_registration";
    //   $col_to_update = "`sub_category`='11_A3_2_Hypertension'";
    //   $indicator = "id = '$registration_id'";
    //   $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    // }

    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE sub_category = '16_'");
    // foreach($SelectTable as $data){ 
     
    //   $registration_id = $data["id"];
    //   $table = "vaccine_registration";
    //   $col_to_update = "`sub_category`='16_A3_7_Diabetes'";
    //   $indicator = "id = '$registration_id'";
    //   $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    // }

    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE sub_category = '23_'");
    // foreach($SelectTable as $data){ 
     
    //   $registration_id = $data["id"];
    //   $table = "vaccine_registration";
    //   $col_to_update = "`sub_category`='23_A3_14_Others'";
    //   $indicator = "id = '$registration_id'";
    //   $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    // }

    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE sub_category = '13_'");
    // foreach($SelectTable as $data){ 
     
    //   $registration_id = $data["id"];
    //   $table = "vaccine_registration";
    //   $col_to_update = "`sub_category`='13_A3_4_Chronic_Kidney_Disease'";
    //   $indicator = "id = '$registration_id'";
    //   $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    // }

    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE sub_category = '09_'");
    // foreach($SelectTable as $data){ 
     
    //   $registration_id = $data["id"];
    //   $table = "vaccine_registration";
    //   $col_to_update = "`sub_category`='09_A2.2: All Other Senior Citizens'";
    //   $indicator = "id = '$registration_id'";
    //   $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    // }

    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE sub_category = '08_'");
    // foreach($SelectTable as $data){ 
     
    //   $registration_id = $data["id"];
    //   $table = "vaccine_registration";
    //   $col_to_update = "`sub_category`='08_A2.1: Institutionalized Senior Citizens'";
    //   $indicator = "id = '$registration_id'";
    //   $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    // }

    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE sub_category = '05_'");
    // foreach($SelectTable as $data){ 
     
    //   $registration_id = $data["id"];
    //   $table = "vaccine_registration";
    //   $col_to_update = "`sub_category`='05_A1.5: Government Owned Community Based Primary Care Facilities'";
    //   $indicator = "id = '$registration_id'";
    //   $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    // }

    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE sub_category = '06_'");
    // foreach($SelectTable as $data){ 
     
    //   $registration_id = $data["id"];
    //   $table = "vaccine_registration";
    //   $col_to_update = "`sub_category`='06_A1.6: Stand-alone Clinics and Diagnostics'";
    //   $indicator = "id = '$registration_id'";
    //   $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    // }

    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE sub_category = '07_'");
    // foreach($SelectTable as $data){ 
     
    //   $registration_id = $data["id"];
    //   $table = "vaccine_registration";
    //   $col_to_update = "`sub_category`='07_A1.7: Closed Settings and Institutions'";
    //   $indicator = "id = '$registration_id'";
    //   $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    // }

    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE sub_category = '21_'");
    // foreach($SelectTable as $data){ 
     
    //   $registration_id = $data["id"];
    //   $table = "vaccine_registration";
    //   $col_to_update = "`sub_category`='21_A3_12_Chronic_Respiratory_Tract_Infection'";
    //   $indicator = "id = '$registration_id'";
    //   $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    // }

    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE sub_category = '12_'");
    // foreach($SelectTable as $data){ 
     
    //   $registration_id = $data["id"];
    //   $table = "vaccine_registration";
    //   $col_to_update = "`sub_category`='12_A3_3_Cardiovascular_Disease'";
    //   $indicator = "id = '$registration_id'";
    //   $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    // }

    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE sub_category = '04_'");
    // foreach($SelectTable as $data){ 
     
    //   $registration_id = $data["id"];
    //   $table = "vaccine_registration";
    //   $col_to_update = "`sub_category`='04_A1.4: Remaining Hospitals'";
    //   $indicator = "id = '$registration_id'";
    //   $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
    // }



    echo $counter;

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