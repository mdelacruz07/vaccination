<!DOCTYPE html>
<html>
<?php
date_default_timezone_set('Asia/Manila');
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

    $brgy_list = array();
    $current_date = date("Y-m-d");
    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM Sheet1");
    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE dose_2 = '01_Yes'");
    foreach($SelectTable as $data){ 
      $brgy = $data["N"];
      array_push($brgy_list, $brgy);

    }

    $brgy_list = array_values(array_unique($brgy_list));
    foreach( $brgy_list as $brgy){
      echo $brgy."<br>";
    }
    ?>

    <!-- Main content -->
    <section class="content row"><?php
      $up_count = 0;
      $do_count = 0;
      $start = 0;
      $skip = count($Global_category_array);

      foreach($Global_vaccine_name as $vaccine){ ?>
        <div class="col-6 p-1">
          <div class="card col-12">
            <center><h3 style="color:rgb(89, 148, 84)"><?php echo $vaccine;?></h3></center>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                    <th colspan="13" style="color: rgb(15, 130, 5)"><center><h5><b>1st Dose</b></h5></center></th>
                </tr>
                <tr>
                    <th>A1</th>
                    <th>A2</th>
                    <th>A3</th>
                    <th>A4</th>
                    <th>A5</th>
                    <th>B1</th>
                    <th>B2</th>
                    <th>B3</th>
                    <th>B4</th>
                    <th>B5</th>
                    <th>B6</th>
                    <th>C</th>
                    <th>N/A</th>
                    <th>Total</th>
                </tr>
              </thead>
              <tbody> <?php
              $total = 0;
                for($x = $start; $x < $skip; $x++){ ?>
                  <td><?php echo $vaccines_1st[$x]; ?></td>
                <?php $total = $total + $vaccines_1st[$x]; } ?>
                <td><?php echo $total; ?></td>
              </tbody>
            </table>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th colspan="13" style="color: rgb(15, 130, 5)"><center><h5><b>2nd Dose</b></h5></center></th>
                </tr>
                <tr>
                    <th>A1</th>
                    <th>A2</th>
                    <th>A3</th>
                    <th>A4</th>
                    <th>A5</th>
                    <th>B1</th>
                    <th>B2</th>
                    <th>B3</th>
                    <th>B4</th>
                    <th>B5</th>
                    <th>B6</th>
                    <th>C</th>
                    <th>N/A</th>
                    <th>Total</th>
                </tr>
              </thead>
              <tbody> <?php
                $total = 0;
                for($x = $start; $x < $skip; $x++){ ?>
                  <td><?php echo $vaccines_2nd[$x]; ?></td>
                <?php $total = $total + $vaccines_2nd[$x]; } ?>
                <td><?php echo $total; ?></td>
              </tbody>
            </table>
          </div>
        </div> <?php  
          $start = $start + count($Global_category_array);
          $skip = $skip + count($Global_category_array);
        
      } 
      
      ?>
     
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