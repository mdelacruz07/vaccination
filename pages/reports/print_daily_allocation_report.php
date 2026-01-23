<!DOCTYPE html>
<html>
<?php
date_default_timezone_set('Asia/Manila');
include '../../controller/systemcore.php'; 
$systemcore = new systemcore();
$System_Sessioning = $systemcore->System_Sessioning("session");
$current_date = $_POST["current_date"];
include '../registrants/vims_settings.php'; 
$VIMS_settings = new VIMS_settings();

$Global_category_array = $VIMS_settings->Global_category_array();
$Global_vaccine_name = $VIMS_settings->Global_vaccine_name();
$Global_regions = $VIMS_settings->Global_regions();
$Global_jun12_province = $VIMS_settings->Global_jun12_province();
$Global_jun12_city = $VIMS_settings->Global_jun12_city();

$Global_new_category_array = $VIMS_settings->Global_new_category_array();



array_push($Global_new_category_array, "N/A");
array_push($Global_vaccine_name, "N/A");



$vaccines_1st = array();
$vaccines_2nd = array();

foreach($Global_vaccine_name as $vaccines){
  array_push($vaccines_cardinal, $vaccines);

  foreach($Global_new_category_array as $category){
    array_push($vaccines_1st, 0);
  }
  foreach($Global_new_category_array as $category){
    array_push($vaccines_2nd, 0);
  }

}

//New VIMS-VAS june 12
$newregion = array("REGION I (ILOCOS REGION)", "REGION II (CAGAYAN VALLEY)", "REGION III (CENTRAL LUZON)", "REGION IV-A (CALABARZON)", "REGION V (BICOL REGION)", "REGION VI (WESTERN VISAYAS)", "REGION VII (CENTRAL VISAYAS)", "REGION VIII (EASTERN VISAYAS)", "REGION IX (ZAMBOANGA PENINSULA)", "REGION X (NORTHERN MINDANAO)", "REGION XI (DAVAO REGION)", "REGION XII (SOCCSKSARGEN)", "NATIONAL CAPITAL REGION (NCR)", "CORDILLERA ADMINISTRATIVE REGION (CAR)", "AUTONOMOUS REGION IN MUSLIM MINDANAO (ARMM)", "REGION XIII (CARAGA)", "REGION IV-B (MIMAROPA)");
include '../inc/header.php';
?>
<style>
@media print {
  .printPageelements {
    display: none;
  }
}

.error_report{
  page-break-before: always;
}
</style>
<body style="background-color:rgb(227, 225, 218); color:black; margin-left:20px;">
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-7">
          </div>
          <div class="col-2">
            <button class="btn btn-outline-info col-12" id="printPageButton" onclick="Printer()">Print</button>
          </div>
          <div class="col-3">
            <form method="POST" class="row" enctype="multipart/form-data" action="../reports/print_daily_allocation_report.php">
  
              <input type="date" class="form-control float-right col-10" value="<?php echo $current_date;?>" name="current_date" alt="required">
             

              <button class="col-2 btn btn-info" type="submit">Search</button>
            </form>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php
    // $current_date = date("Y-m-d");
    // $current_date = "2021-04-08";

    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vims_report WHERE vaccination_date = '$current_date'");
    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE dose_2 = '01_Yes'");
    foreach($SelectTable as $data){ 
      $vaccine_name = $data["vaccine_name"];
      $Category = $data["category"];
      $brgy = $data["brgy"];
      $dose_1 = $data["1st_dose"];
      $dose_2 = $data["2nd_dose"];

      $up_count = 0;
      $do_count = 0;
      foreach($Global_vaccine_name as $vaccines){
        foreach($Global_new_category_array as $category12){
          if(strtolower($vaccines) == strtolower($vaccine_name) && $category12 == $Category && $dose_1 == "Y"){
            $vaccines_1st[$up_count]++;
          }
          $up_count++;
        }
        foreach($Global_new_category_array as $category12){
          if(strtolower($vaccines) == strtolower($vaccine_name) && $category12 == $Category && $dose_2 == "Y"){
            $vaccines_2nd[$do_count]++;
            // $vaccines_1st[$do_count]--;
          }
          $do_count++;
        }
      }
      $data_with_no_doses = 0;
      $data_with_no_brgy = 0;
      $data_with_no_category = 0;

      if($dose_1 == "N" && $dose_2 == "N"){
        $data_with_no_doses++;
      }
      if($brgy == "" || $brgy == "N/A"){
        $data_with_no_brgy++;
      }
      if($Category == "" || $Category == "N/A"){
        $data_with_no_category++;
      }

 
          // $Category = "A1";
          // $Category = "A1.8";
          // $Category = "A1.9";
          // $Category = "A2";
          // $Category = "A3";
          // $Category = "A4";
          // $Category = "A5";
          // $Category = "ROP";

    }
    ?>

    <!-- Main content -->
    <center>
    <h1>VIMS-VAS</h1>
    <h5>Daily Data Allocation <?php echo $current_date; ?></h5>
    </center>
    <section class="content row"><?php
      $up_count = 0;
      $do_count = 0;
      $start = 0;
      $skip = count($Global_new_category_array);

      foreach($Global_vaccine_name as $vaccine){
        $print_hide = "";
        if($vaccine == "N/A"){
          $print_hide = "printPageelements";
        } ?>
        <div class="col-12 col-md-6 p-1 <?php echo $print_hide; ?>" >
          <div class="card col-12">
            <center><h3 style="color:rgb(89, 148, 84)"><?php echo $vaccine;?></h3></center>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                    <th colspan="16" style="color: rgb(15, 130, 5)"><center><h5><b>1st Dose</b></h5></center></th>
                </tr>
                <tr>
                    <th>A1</th>
                    <th>A1.8</th>
                    <th>A1.9</th>
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
                  <td><?php echo $vaccines_1st[$x]; ?></td><?php $total = $total + $vaccines_1st[$x]; 
                } ?>
                  <td><?php echo $total; ?></td>
              </tbody>
            </table>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th colspan="16" style="color: rgb(15, 130, 5)"><center><h5><b>2nd Dose</b></h5></center></th>
                </tr>
                <tr>
                    <th>A1</th>
                    <th>A1.8</th>
                    <th>A1.9</th>
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
                  <td><?php echo $vaccines_2nd[$x]; ?></td> <?php $total = $total + $vaccines_2nd[$x]; 
                } ?>
                  <td><?php echo $total; ?></td>
              </tbody>
            </table>
          </div>
        </div> <?php  
          $start = $start + count($Global_new_category_array);
          $skip = $skip + count($Global_new_category_array);
        
      } 
      
      ?>
      <div class="col-12 col-md-4 p-1 error_report" >
        <div class="card">
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th colspan="16" style="color: rgb(15, 130, 5)"><center><h5><b>Data With Missing Value</b></h5></center></th>
                </tr>
                <tr>
                    <th>Data without Brgy</th>
                    <th>Data Without Doses</th>
                    <th>Data Without Category</th>
                </tr>
              </thead>
              <tbody>
                <tr><?php
                  echo "<td>".$data_with_no_brgy."</td>";
                  echo "<td>".$data_with_no_doses."</td>"; 
                  echo "<td>".$data_with_no_category."</td>"; ?>
                  
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- <div class="col-12 col-md-8 p-1">
        <div class="card">
          <div class="card-body">
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th colspan="16" style="color: rgb(15, 130, 5)"><center><h5><b>Vaccinated Persons Without Post Monitoring</b></h5></center></th>
                </tr>
                <tr>
                    <th>Category</th>
                    <th>Full Name</th>
                    <th>Barangay</th>
                    <th>Mobile</th>
                </tr>
              </thead>
              <tbody><?php 
                $SelectTable = $systemcore->SelectCustomize("SELECT post_vaccination.*, vaccine_registration.employmentcategory as category, vaccine_registration.dose_2 as dose_2, vaccine_registration.dose_1 as dose_1, vaccine_registration.brgy as brgy, vaccine_registration.contact as contact FROM post_vaccination LEFT JOIN vaccine_registration ON post_vaccination.qr_id = vaccine_registration.qr_id WHERE vaccine_registration.time_stamp = '$current_date'");

                // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM post_vaccination WHERE addmission_time_hour = '' AND addmission_time_minute = '' AND discharge_time_hour = '' AND discharge_time_minute = '' WHERE time_stamp = '$current_date'");
                foreach($SelectTable as $data){ 
                  $check = str_split($data["BP_1"]);
                  $check2 = str_split($data["BP_1_1"]);
                  $dose_1 = $data["dose_1"];
                  $dose_2 = $data["dose_2"];

                  // echo "<tr><td>".$dose_1."asd===".count($check2)."</td></tr>";
                  // if($dose_1 == "01_Yes"){
                  if($dose_2 == "01_Yes"){
                    if(count($check2) == 1 || count($check2) == 0){?>
                      <tr><?php
                        echo "<td>".$data['category']."</td>";
                        echo "<td>".$data['lastname']." ".$data['firstname']." ".$data['middlename']."</td>";
                        echo "<td>".$data['brgy']."</td>";
                        echo "<td>".$data['contact']."</td>"; ?>
                      </tr><?php 
                    }
                  }
                  else{
                    if(count($check) == 1 || count($check) == 0){?>
                    <tr><?php
                      echo "<td>".$data['category']."</td>";
                      echo "<td>".$data['lastname']." ".$data['firstname']." ".$data['middlename']."</td>";
                      echo "<td>".$data['brgy']."</td>";
                      echo "<td>".$data['contact']."</td>"; ?>
                    </tr><?php 
                    }
                  }
                }?>
              </tbody>
            </table>
          </div>
        </div>
      </div> -->

    </section>
    <br>
    <Br>
    <br>
    <!-- /.content -->

  <!-- /.content-wrapper -->

    <?php 
        include '../inc/confirmation.php';
        include '../inc/footer.php';
    ?>
    <script>
      // window.parent.location.href = "http://www.example.com"; 
      function Printer(){
        window.print();
      }
    </script>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>