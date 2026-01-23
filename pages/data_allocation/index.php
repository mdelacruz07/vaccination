<!DOCTYPE html>
<html>
<?php

include '../../controller/systemcore.php'; 
$systemcore = new systemcore();
$System_Sessioning = $systemcore->System_Sessioning("session");

include '../registrants/vims_settings.php'; 
$VIMS_settings = new VIMS_settings();

$Global_category_array = $VIMS_settings->Global_category_array();
$Global_vaccine_name = $VIMS_settings->Global_vaccine_name();
$Global_regions = $VIMS_settings->Global_regions();
$Global_jun12_province = $VIMS_settings->Global_jun12_province();
$Global_jun12_city = $VIMS_settings->Global_jun12_city();

array_push($Global_category_array, "N/A");
array_push($Global_vaccine_name, "N/A");
$vaccines_1st = array();
$vaccines_2nd = array();

foreach($Global_vaccine_name as $vaccines){
  array_push($vaccines_cardinal, $vaccines);

  foreach($Global_category_array as $category){
    array_push($vaccines_1st, 0);
  }
  foreach($Global_category_array as $category){
    array_push($vaccines_2nd, 0);
  }

}

//New VIMS-VAS june 12
$newregion = array("REGION I (ILOCOS REGION)", "REGION II (CAGAYAN VALLEY)", "REGION III (CENTRAL LUZON)", "REGION IV-A (CALABARZON)", "REGION V (BICOL REGION)", "REGION VI (WESTERN VISAYAS)", "REGION VII (CENTRAL VISAYAS)", "REGION VIII (EASTERN VISAYAS)", "REGION IX (ZAMBOANGA PENINSULA)", "REGION X (NORTHERN MINDANAO)", "REGION XI (DAVAO REGION)", "REGION XII (SOCCSKSARGEN)", "NATIONAL CAPITAL REGION (NCR)", "CORDILLERA ADMINISTRATIVE REGION (CAR)", "AUTONOMOUS REGION IN MUSLIM MINDANAO (ARMM)", "REGION XIII (CARAGA)", "REGION IV-B (MIMAROPA)");
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

    $current_date = date("Y-m-d");
    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vims_vas_12");
    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE dose_2 = '01_Yes'");
    foreach($SelectTable as $data){ 
      $category = $data["category"];
      $unique_id = $data["unique_id"];
      $pwd = $data["pwd_id"];
      $indigenous = $data["indigenous"];
      $lastname = $data["lastname"];
      $firstname = $data["firstname"];
      $middlename = $data["middlename"];
      $suffix = $data["suffix"];
      $contact = $data["contact"];
      $region = $data["region"];
      $province = $data["province"];
      $city = $data["city"];
      $brgy = $data["brgy"];
      $gender = $data["gender"];
      $bday = $data["bday"];
      $deferral = $data["deferral"];
      $reason_for_deferral = $data["reason_for_deferral"];
      $vaccination_date = $data["vaccination_date"];
      $vaccine_name = $data["vaccine_name"];
      $batch_number = $data["batch_number"];
      $lot_number = $data["lot_number"];
      $bakuna_center = $data["bakuna_center"];
      $vaccinator_name = $data["vaccinator_name"];
      $st1_dose = $data["1st_dose"];
      $nd2_dose = $data["2nd_dose"];
      $adverse_event = $data["adverse_event"];
      $adverse_event_condition = $data["adverse_event_condition"];
      if($adverse_event_condition == "N/A"){
        $adverse_event_condition = "N";
      }
      if($suffix == "N/A" || $suffix == "NA"){
        $suffix = "N";
      }
      $SelectDouble = $systemcore->SelectCustomize("SELECT * FROM vims_report WHERE unique_id = '$unique_id' AND 1st_dose = '$st1_dose' AND 2nd_dose = '$nd2_dose' AND vaccination_date = '$vaccination_date'");
      if($SelectDouble == "none"){
        $table = "vims_report";
        $table_col = "`category`, `unique_id`, `pwd_id`, `indigenous`, `lastname`, `firstname`, `middlename`, `suffix`, `contact`, `region`, `province`, `city`, `brgy`, `gender`, `bday`, `deferral`, `reason_for_deferral`, `vaccination_date`, `vaccine_name`, `batch_number`, `lot_number`, `bakuna_center`, `vaccinator_name`, `1st_dose`, `2nd_dose`, `adverse_event`, `adverse_event_condition`";
        $table_val = "'$category', '$unique_id', '$pwd', '$indigenous', '$lastname', '$firstname', '$middlename', '$suffix', '$contact', '$region', '$province', '$city', '$brgy', '$gender', '$bday', '$deferral', '$reason_for_deferral', '$vaccination_date', '$vaccine_name', '$batch_number', '$lot_number', '$bakuna_center', '$vaccinator_name', '$st1_dose', '$nd2_dose', '$adverse_event', '$adverse_event_condition'"; 
        $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
      }
    }
    ?>

    <!-- Main content -->
    <section class="content row">
      <br><BR><br><br><br><br><br><Br>
      <center><h1>DATA ALLOCATION!!!</h1></center>
     
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