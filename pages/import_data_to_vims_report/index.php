<!DOCTYPE html>
<html>
<?php
date_default_timezone_set('Asia/Manila');
include '../../controller/systemcore.php'; 
$systemcore = new systemcore();
$System_Sessioning = $systemcore->System_Sessioning("session");

//New VIMS-VAS june 12
include '../inc/header.php';
?>
<body style="background-color:rgb(227, 225, 218); color:black; margin-left:20px;">
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-10">
            <h1>VIMS-VAS</h1>
            <h5>Daily Data Allocation <?php echo date("Y-m-d"); ?></h5>
          </div>
          <div class="col-2">
            <a class="btn btn-block btn-outline-secondary" href="download_vims_vas.php" target="_blank">Download VIMS-VAS Excel File</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php

    
    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vims_report");
    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE dose_2 = '01_Yes'");
    foreach($SelectTable as $data){   
      // $category = $data["category"];
      // $unique_id = $data["unique_id"];
      // $pwd_id = $data["pwd_id"];
      // $indigenous = $data["indigenous"];
      // $lastname = $data["lastname"];
      // $firstname = $data["firstname"];
      // $middlename = $data["middlename"];
      // $suffix = $data["suffix"];
      // $contact = $data["contact"];
      // $region = $data["region"];
      // $province = $data["province"];
      // $city = $data["city"];
      // $brgy = $data["brgy"];
      // $gender = $data["gender"];
      // $bday = $data["bday"];
      // $deferral = $data["deferral"];
      // $reason_for_deferral = $data["reason_for_deferral"];
      // $vaccination_date = $data["vaccination_date"];
      // $vaccine_name = $data["vaccine_name"];
      // $batch_number = $data["batch_number"];
      // $lot_number = $data["lot_number"];
      // $bakuna_center = $data["bakuna_center"];

      // $vaccinator_name = $data["vaccinator_name"];
      // $dose_1 = $data["1st_dose"];
      // $dose_2 = $data["2nd_dose"];
      // $adverse_event = $data["adverse_event"];
      // $adverse_event_condition = $data["adverse_event_condition"];
      // echo "MIGRATE!!!<br>";
      // $table = "vims_report_test";
      // $table_col = "`category`, `unique_id`, `pwd_id`, `indigenous`, `lastname`, `firstname`, `middlename`, `suffix`, `contact`, `region`, `province`, `city`, `brgy`, `gender`, `bday`, `deferral`, `reason_for_deferral`, `vaccination_date`, `vaccine_name`, `batch_number`, `lot_number`, `bakuna_center`, `vaccinator_name`, `1st_dose`, `2nd_dose`, `adverse_event`, `adverse_event_condition`";
      // $table_val = "'$category', '$unique_id', '$pwd_id', '$indigenous', '$lastname', '$firstname', '$middlename', '$suffix', '$contact', '$region', '$province', '$city', '$brgy', '$gender', '$bday', '$deferral', '$reason_for_deferral', '$vaccination_date', '$vaccine_name', '$batch_number', '$lot_number', '$bakuna_center', '$vaccinator_name', '$dose_1', '$dose_2', '$adverse_event', '$adverse_event_condition'"; 
      // $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
    }
    ?>

    <!-- Main content -->
    <section class="content row">
     
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->

    <?php 
        include '../inc/confirmation.php';
        include '../inc/footer.php';
    ?>
    <script>
      // window.parent.location.href = "http://www.example.com"; 
    </script>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>