<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    session_start();
    date_default_timezone_set('Asia/Manila');

    // $date = $_POST["date"];
    // $facility_id = $_POST["facility_id"];
    // $employmentcategory = $_POST["employmentcategory"];

    // $month_number = date("m",strtotime($date));
    // $month_name = date("m",strtotime($date));
    // $year = date("Y",strtotime($date));
    // $day = date("d",strtotime($date));

    // $monthNum  = $month_number;
    // $dateObj   = DateTime::createFromFormat('!m', $monthNum);
    // $monthName = $dateObj->format('F');

    // $selected_month_no_zero = ltrim($month_number, '0');
    $get_month = "07";
    $month_report_name = "July 31 2021";

    $category_array = array( 
    "A1",
    "A1.8",
    "A1.9", 
    "A2", 
    "A3",
    "A4",
    "A5",
    "ROP");
    $category_array_value = array();

    $non_bago_barangay_array = array();
    $non_bago_barangay_array_value = array();


    // print_r($online_registration_array_time);

    $bago_barangay_array = array(
        "ABUANAN", 
        "ALIANZA", 
        "ATIPULUAN", 
        "BACONG MONTILLA", 
        "BAGROY", 
        "BALINGASAG", 
        "BINUBUHAN", 
        "BUSAY", 
        "CALUMANGAN", 
        "CARIDAD", 
        "DULAO", 
        "ILIJAN", 
        "LAG_ASAN", 
        "MA AO BARRIO", 
        "JORGE L. ARANETA MA AO CENTRAL", 
        "MAILUM", 
        "MALINGIN", 
        "NAPOLES", 
        "PACOL", 
        "POBLACION", 
        "SAGASA", 
        "TABUNAN", 
        "TALOC", 
        "SAMPINIT",
        "Non-Bago");
        
    $bago_barangay_array_value = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
    $bago_brgy_array_1st_dose = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
    $bago_brgy_array_2nd_dose = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
    $gender_array = array(0,0);

    $category_array_1st_dose = array();
    $category_array_2nd_dose = array();

    //Vaccination TIme Series
    $online_registration_array_value = array();
    $online_registration_array_time = array();
    $online_registration_array_name = array();
    $online_registration_array_value_sinovac = array();
    $online_registration_array_value_astra = array();

    $current_date = "2021-03-31";
    $starting_date = date("2021-03-01");  
    $inc_starting_date = date("2021-03-01");   
    for ($x = 0; $x < 1000; $x++) {
      $inc_starting_date = date('Y-m-d', strtotime($inc_starting_date. ' + 1 months'));
      $inc_date = explode("-", $inc_starting_date);
      array_push($online_registration_array_time,$inc_starting_date);
      array_push($online_registration_array_name,date('M Y', strtotime($inc_starting_date)));
      array_push($online_registration_array_value, 0);
      array_push($online_registration_array_value_sinovac, 0);
      array_push($online_registration_array_value_astra, 0);
      if($inc_date[0] == date("Y") && $inc_date[1] == date('m', strtotime($current_date. ' + 1 months'))){
        break;
      }
    }


 
    $SelectValue = $systemcore->SelectCustomize("SELECT * FROM vims_report");
    foreach($SelectValue as $data){
      $array_date_vacination = explode("-", $data["vaccination_date"]);
      $month_date_vacination = $array_date_vacination[1];
      if($month_date_vacination == $get_month){
        $Category = $data["category"];
        // array_push($category_array, $Category);
        $brgy = $data["brgy"];
        $brgy = str_replace(' ', '', $brgy);
        $brgy = preg_replace('/[0-9]+/', '', $brgy);
        $brgy = preg_replace('/[^\p{L}\p{N}\s]/u', '', $brgy);
        $gender = $data["gender"];

        $error = false;
        $x = 0;
        foreach($bago_barangay_array as $bago_brgy){
          $bago_brgy = str_replace(' ', '', $bago_brgy);
          $bago_brgy = preg_replace('/[0-9]+/', '', $bago_brgy);
          $bago_brgy = preg_replace('/[^\p{L}\p{N}\s]/u', '', $bago_brgy);
          

          if($brgy == $bago_brgy){
              $error = true;
              $bago_barangay_array_value[$x]++;
              if($data["1st_dose"] == "Y"){
                $bago_brgy_array_1st_dose[$x]++;
              }
              if($data["2nd_dose"] == "Y"){
                $bago_brgy_array_2nd_dose[$x]++;
              }
          }
          $x++;
        }
        if($error == false){
          array_push($non_bago_barangay_array, $brgy);
          $bago_barangay_array_value[24]++;
          if($data["1st_dose"] == "Y"){
            $bago_brgy_array_1st_dose[24]++;
          }
          if($data["2nd_dose"] == "Y"){
            $bago_brgy_array_2nd_dose[24]++;
          }
        }

        //Vaccination TIme Series
        $date_of_vaccination = $data["vaccination_date"];
        $vaccine_name = $data["vaccine_name"];
        for ($x = 0; $x < count($online_registration_array_time); $x++) {
          // echo $date_of_vaccination." >= ".$online_registration_array_time[$x]." && ".$date_of_vaccination." <= ".$online_registration_array_time[$x+1]."<br>";
          if($date_of_vaccination >= $online_registration_array_time[$x] && $date_of_vaccination <= $online_registration_array_time[$x+1]){
            $online_registration_array_value[$x]++;
            if($vaccine_name == "Sinovac" || $vaccine_name == "SINOVAC"){

              $online_registration_array_value_sinovac[$x]++;
            }else if($vaccine_name == "Astrazeneca"){
              $online_registration_array_value_astra[$x]++;
            }
          }
        }

        if($gender == "F"){
          $gender_array[0]++;
        }else{
          $gender_array[1]++;
        }
      }
    }

    // print_r($online_registration_array_value);echo "<br>";
    // print_r($online_registration_array_value_sinovac);echo "<br>";
    // print_r($online_registration_array_value_astra);echo "<br>";

    $category_array = array_values(array_unique($category_array));
    $non_bago_barangay_array = array_values(array_unique($non_bago_barangay_array));

    // foreach($non_bago_barangay_array as $data1){
    //   echo $data1."<br>";
    // }


    for($x = 0; $x < count($category_array); $x++){
      array_push($category_array_value, 0);
      array_push($category_array_1st_dose, 0);
      array_push($category_array_2nd_dose, 0);
    }
    for($x = 0; $x < count($non_bago_barangay_array); $x++){
      array_push($non_bago_barangay_array_value, 0);
    }

    foreach($SelectValue as $data){
      $array_date_vacination = explode("-", $data["vaccination_date"]);
      $month_date_vacination = $array_date_vacination[1];
      if($month_date_vacination == $get_month){
        for($x = 0; $x < count($category_array)+1; $x++){
          if($category_array[$x] == $data["category"]){
            $category_array_value[$x]++;
            if($data["1st_dose"] == "Y"){
              $category_array_1st_dose[$x]++;
            }
            if($data["2nd_dose"] == "Y"){
              $category_array_2nd_dose[$x]++;
            }
          }
        }
        for($x = 0; $x < count($non_bago_barangay_array); $x++){
          
          if($non_bago_barangay_array[$x] == $data["brgy"]){ 
            $non_bago_barangay_array_value[$x]++;
          }
        }
      }
    }


    // print_r($online_registration_array_value);
    array_pop($online_registration_array_value);
    array_pop($online_registration_array_time);
    array_pop($online_registration_array_name);

    array_pop($online_registration_array_value_sinovac);
    array_pop($online_registration_array_value_astra);

    // array_pop($online_registration_array_value);
    // array_pop($online_registration_array_time);
    // array_pop($online_registration_array_name);
    
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Contact List Report</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 4 -->

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>

table, th, td, thead, tr {
  border: 0.5px solid black !important;
  border-collapse: collapse;
  margin:0px !important;
  padding: 5px !important;
}

.card-body{
  page-break-before: always;
}
@media screen {
  div.divFooter {
    display: none;
  }
}
@media print {
  div.divFooter {
    position: fixed;
    bottom: 0;
  }
}

.total_colored{
  background-color:rgb(255, 233, 122);
}

@media print {
  #printPageButton {
    display: none;
  }
}
  </style>
  <?php 
    // include '../inc/header.php';//FIX this this is for temporary include!!

  ?>
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row" >
      <div class="col-12">


      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
     
  
          <div class="col-sm-12">
            <h2 class="page-header row">
              <div class="col-1 offset-11 pr-3"> <button class="btn btn-outline-info col-12" id="printPageButton" onclick="Printer()">Print</button></div>
              <div class="col-sm-12"><center><br>
                <img src="../../dist/img/<?php echo $_SESSION["system_logo"];?>" style="width: 125px; hight:125px;"></center>
              </div>
              <div class="col-sm-12" >
                  <center><p style="font-size:18px; margin:none; padding:none;"><b  style="font-size:22px;">Bago City Health Office</b><br>
                  Vaccine Information Management System</p>
                  <!-- <b style="font-size:22px;">Monthly Vaccination Report</b><br> -->
                  <b style="font-size:20px;"><?php echo $month_report_name; ?></b><br></center>
              </div>
          </h2>
            <center><b style="font-size:20px;"><u>Total Vaccinated by Category</u></b><br></center>
            <canvas id="category" style="min-height: 350px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
              <table class="table table-bordered">
                  <thead>  
                      <tr>
                        <th>Name</th>
                        <th>1st Dose</th>
                        <th>2nd Dose</th>
                        <th><p  class="p-0 m-0 total_colored">Total</p></th>
                      </tr>
                  </thead>
                  <tbody><?php
                    $total = 0;
                    $total1 = 0;
                    $total2 = 0;
                    for($x = 0; $x < count($category_array); $x++){ ?>
                    <tr>
                      <td><?php echo $category_array[$x]; ?></td>
                      <td><?php echo $category_array_1st_dose[$x]; $total1 = $total1 + $category_array_1st_dose[$x];?></td>
                      <td><?php echo $category_array_2nd_dose[$x]; $total2 = $total2 + $category_array_2nd_dose[$x];?></td>
                      <td><p class="p-0 m-0 total_colored"><?php echo $category_array_value[$x]; $total = $total + $category_array_value[$x];?></p></td>
                    </tr>
                    <?php } ?>
                    <tr class="colored_row">
                      <td><p class="p-0 m-0 total_colored">Total:</p></td>
                      <td><p class="p-0 m-0 total_colored"><?php echo $total1; ?></p></td>
                      <td><p class="p-0 m-0 total_colored"><?php echo $total2; ?></p></td>
                      <td><p class="p-0 m-0 total_colored"><?php echo $total; ?></p></td>
                    </tr>
                  </tbody>
              </table>
          </div>

      <div class="card-body row">
          <div class="col-sm-12">
              <h2 class="page-header row">
                <!-- <div class="col-1 offset-11 pr-3"> <button class="btn btn-outline-info col-12" onclick="Printer()">Print</button></div> -->
                <div class="col-sm-12"><center><br>
                  <img src="../../dist/img/<?php echo $_SESSION["system_logo"];?>" style="width: 125px; hight:125px;"></center>
                </div>
                <div class="col-sm-12" >
                    <center><p style="font-size:18px; margin:none; padding:none;"><b  style="font-size:22px;">Bago City Health Office</b><br>
                    Vaccine Information Management System</p>
                    <!-- <b style="font-size:22px;">Monthly Vaccination Report</b><br> -->
                    <b style="font-size:20px;"><?php echo $month_report_name; ?></b><br></center>
                </div>
            </h2>
            <center><b style="font-size:20px;"><u>Total Vaccinated by Barangay</u></b><br></center>
            <canvas id="bago_brgy" style="min-height: 350px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
                <table class="table table-bordered">
                  <thead>  
                      <tr>
                        <th>Name</th>
                        <th>1st Dose</th>
                        <th>2nd Dose</th>
                        <th><p  class="p-0 m-0 total_colored">Total</p></th>
                      </tr>
                  </thead>
                  <tbody><?php
                    $total = 0;
                    $total1 = 0;
                    $total2 = 0;
                    for($x = 0; $x < count($bago_barangay_array); $x++){ ?>
                    <tr>
                      <td><?php echo $bago_barangay_array[$x]; ?></td>
                      <td><?php echo $bago_brgy_array_1st_dose[$x]; $total1 = $total1 + $bago_brgy_array_1st_dose[$x];?></td>
                      <td><?php echo $bago_brgy_array_2nd_dose[$x]; $total2 = $total2 + $bago_brgy_array_2nd_dose[$x];?></td>
                      <td><p  class="p-0 m-0 total_colored" ><?php echo $bago_barangay_array_value[$x]; $total = $total + $bago_barangay_array_value[$x];?></p></td>
                    </tr>
                    <?php } ?>
                    <tr class="colored_row">
                      <td><p  class="p-0 m-0 total_colored">Total:</p></td>
                      <td><p class="p-0 m-0 total_colored"><?php echo $total1; ?></p></td>
                      <td><p class="p-0 m-0 total_colored"><?php echo $total2; ?></p></td>
                      <td><p class="p-0 m-0 total_colored"><?php echo $total; ?></p></td>
                    </tr>
                  </tbody>
                  <tfoot style="background-color:white; color:white; border:none;">  
                      <tr style="background-color:white; color:white; border:none;">
                        <th style="background-color:white; color:white; border:none;">Date</th>
                        <th style="background-color:white; color:white; border:none;">Numbers</th>
                        <th style="background-color:white; color:white; border:none;">Numbers</th>
                        <th style="background-color:white; color:white; border:none;">Numbers</th>
                      </tr>
                      <tr style="background-color:white; color:white; border:none;">
                        <th style="background-color:white; color:white; border:none;">Date</th>
                        <th style="background-color:white; color:white; border:none;">Numbers</th>
                        <th style="background-color:white; color:white; border:none;">Numbers</th>
                        <th style="background-color:white; color:white; border:none;">Numbers</th>
                      </tr>
                      <tr style="background-color:white; color:white; border:none;">
                        <th style="background-color:white; color:white; border:none;">Date</th>
                        <th style="background-color:white; color:white; border:none;">Numbers</th>
                        <th style="background-color:white; color:white; border:none;">Numbers</th>
                        <th style="background-color:white; color:white; border:none;">Numbers</th>
                      </tr>
                  </tfoot>
              </table>
          </div>
      </div>

      <div class="card-body row" hidden>
          <div class="col-sm-12">
              <h2 class="page-header row">
                <!-- <div class="col-1 offset-11 pr-3"> <button class="btn btn-outline-info col-12" onclick="Printer()">Print</button></div> -->
                <div class="col-sm-12"><center><br>
                  <img src="../../dist/img/<?php echo $_SESSION["system_logo"];?>" style="width: 125px; hight:125px;"></center>
                </div>
                <div class="col-sm-12" >
                    <center><p style="font-size:18px; margin:none; padding:none;"><b  style="font-size:22px;">Bago City Health Office</b><br>
                    Vaccine Information Management System</p>
                    <!-- <b style="font-size:22px;">Monthly Vaccination Report</b><br> -->
                    <b style="font-size:20px;"><?php echo $month_report_name; ?></b><br></center>
                </div>
            </h2>
            <center><b style="font-size:20px;"><u>Total Vaccinated by Month</u></b><br></center>
            <canvas id="lineChart" style="min-height: 350px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
                <table class="table table-bordered">
                  <thead>  
                      <tr>
                        <th>Month</th>
                        <th>Numbers</th>
                      </tr>
                  </thead>
                  <tbody><?php
                    $total = 0;
                    for($x = 0; $x < count($online_registration_array_time); $x++){ ?>
                    <tr>
                      <td><?php echo $online_registration_array_name[$x]; ?></td>
                      <td><?php echo $online_registration_array_value[$x]; $total = $total + $online_registration_array_value[$x];?></td>
                    </tr>
                    <?php } ?>
                    <tr class="colored_row">
                      <td><p class="p-0 m-0 total_colored">Total:</p></td>
                      <td><p class="p-0 m-0 total_colored"><?php echo $total; ?></p></td>
                    </tr>
                  </tbody>
              </table>
          </div>
      </div>

      <div class="card-body row" hidden>
          <div class="col-sm-12">
              <h2 class="page-header row">
                <!-- <div class="col-1 offset-11 pr-3"> <button class="btn btn-outline-info col-12" onclick="Printer()">Print</button></div> -->
                <div class="col-sm-12"><center><br>
                  <img src="../../dist/img/<?php echo $_SESSION["system_logo"];?>" style="width: 125px; hight:125px;"></center>
                </div>
                <div class="col-sm-12" >
                    <center><p style="font-size:18px; margin:none; padding:none;"><b  style="font-size:22px;">Bago City Health Office</b><br>
                    Vaccine Information Management System</p>
                    <!-- <b style="font-size:22px;">Monthly Vaccination Report</b><br> -->
                    <b style="font-size:20px;"><?php echo $month_report_name; ?></b><br></center>
                </div>
            </h2>
            <center><b style="font-size:20px;"><u>Total Vaccinated by Month(<span style="color:red;">Sinovac</span>)</u></b><br></center>
            <canvas id="lineChartsinovac" style="min-height: 350px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
                <table class="table table-bordered">
                  <thead>  
                      <tr>
                        <th>Month</th>
                        <th>Numbers</th>
                      </tr>
                  </thead>
                  <tbody><?php
                    $total = 0;
                    for($x = 0; $x < count($online_registration_array_time); $x++){ ?>
                    <tr>
                      <td><?php echo $online_registration_array_name[$x]; ?></td>
                      <td><?php echo $online_registration_array_value_sinovac[$x]; $total = $total + $online_registration_array_value_sinovac[$x];?></td>
                    </tr>
                    <?php } ?>
                    <tr class="colored_row">
                      <td><p class="p-0 m-0 total_colored">Total:</p></td>
                      <td><p class="p-0 m-0 total_colored"><?php echo $total; ?></p></td>
                    </tr>
                  </tbody>
              </table>
          </div>
      </div>

      <div class="card-body row" hidden>
          <div class="col-sm-12">
              <h2 class="page-header row">
                <!-- <div class="col-1 offset-11 pr-3"> <button class="btn btn-outline-info col-12" onclick="Printer()">Print</button></div> -->
                <div class="col-sm-12"><center><br>
                  <img src="../../dist/img/<?php echo $_SESSION["system_logo"];?>" style="width: 125px; hight:125px;"></center>
                </div>
                <div class="col-sm-12" >
                    <center><p style="font-size:18px; margin:none; padding:none;"><b  style="font-size:22px;">Bago City Health Office</b><br>
                    Vaccine Information Management System</p>
                    <!-- <b style="font-size:22px;">Monthly Vaccination Report</b><br> -->
                    <b style="font-size:20px;"><?php echo $month_report_name; ?></b><br></center>
                </div>
            </h2>
            <center><b style="font-size:20px;"><u>Total Vaccinated by Month(<span style="color:red;">Astrazeneca</span>)</u></b><br></center>
            <canvas id="lineChartastra" style="min-height: 350px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
                <table class="table table-bordered">
                  <thead>  
                      <tr>
                        <th>Month</th>
                        <th>Numbers</th>
                      </tr>
                  </thead>
                  <tbody><?php
                    $total = 0;
                    for($x = 0; $x < count($online_registration_array_time); $x++){ ?>
                    <tr>
                      <td><?php echo $online_registration_array_name[$x]; ?></td>
                      <td><?php echo $online_registration_array_value_astra[$x]; $total = $total + $online_registration_array_value_astra[$x];?></td>
                    </tr>
                    <?php } ?>
                    <tr class="colored_row">
                      <td><p class="p-0 m-0 total_colored">Total:</p></td>
                      <td><p class="p-0 m-0 total_colored"><?php echo $total; ?></p></td>
                    </tr>
                  </tbody>
              </table>
          </div>
      </div>

      <div class="card-body row">
          <div class="col-sm-12">
              <h2 class="page-header row">
                <!-- <div class="col-1 offset-11 pr-3"> <button class="btn btn-outline-info col-12" onclick="Printer()">Print</button></div> -->
                <div class="col-sm-12"><center><br>
                  <img src="../../dist/img/<?php echo $_SESSION["system_logo"];?>" style="width: 125px; hight:125px;"></center>
                </div>
                <div class="col-sm-12" >
                    <center><p style="font-size:18px; margin:none; padding:none;"><b  style="font-size:22px;">Bago City Health Office</b><br>
                    Vaccine Information Management System</p>
                    <!-- <b style="font-size:22px;"><u>Monthly Vaccination Report</u></b><br> -->
                    <b style="font-size:20px;"><?php echo $month_report_name; ?></b><br></center>
                </div>
            </h2>
            <center><b style="font-size:20px;">Barangay's Total Vaccination by Month</b><br></center>
                <table class="table table-bordered">
                  <thead>  
                      <tr>
                        <th>Barangay</th><?php
                        foreach($online_registration_array_name as $month_name){ ?>
                          <th><?php echo $month_name; ?></th> <?php 
                        } ?>
                        <th><p class='p-0 m-0 total_colored'>Total</p></th>
                      </tr>
                  </thead>
                  <tbody><?php
                    $total_vaccinated = 0;
                    foreach($bago_barangay_array as $brgy){?>
                        <tr><th><?php echo $brgy;?></th><?php
                        $total_brgy = 0;
                        foreach($online_registration_array_time as $time){ 
                          $total = 0;
                          $time_cons = explode("-",$time);
                          $brgy_cons = str_replace(' ', '', $brgy);
                          $brgy_cons = preg_replace('/[0-9]+/', '', $brgy_cons);
                          $brgy_cons = preg_replace('/[^\p{L}\p{N}\s]/u', '', $brgy_cons);
                          
                          foreach($SelectValue as $person){
                            $array_date_vacination = explode("-", $data["vaccination_date"]);
                            $month_date_vacination = $array_date_vacination[1];
                            if($month_date_vacination == $get_month){

                              $time_per = explode("-",$person["vaccination_date"]);

                              $brgy_per = $person["brgy"];
                              $brgy_per = str_replace(' ', '', $brgy_per);
                              $brgy_per = preg_replace('/[0-9]+/', '', $brgy_per);
                              $brgy_per = preg_replace('/[^\p{L}\p{N}\s]/u', '', $brgy_per);

                              if($time_per[1] == $time_cons[1] && $brgy_cons == $brgy_per){
                                $total++;
                                $total_brgy++;
                                $total_vaccinated++;
                              }

                              if($brgy == "Non-Bago"){
                                if($time_per[1] == $time_cons[1]){
                                  $error = false;
                                  foreach($bago_barangay_array as $brgy_non){
                                    $brgy_cons_non = str_replace(' ', '', $brgy_non);
                                    $brgy_cons_non = preg_replace('/[0-9]+/', '', $brgy_cons_non);
                                    $brgy_cons_non = preg_replace('/[^\p{L}\p{N}\s]/u', '', $brgy_cons_non);
                                    if($brgy_cons_non == $brgy_per){
                                      $error = true;
                                    }
                                  
                                  }  
                                  if($error == false){
                                    $total++;
                                    $total_brgy++;
                                    $total_vaccinated++;
                                  }
                                }
                              }
                            }
                          }

                          echo "<th>$total</th>";
                        }
                        echo "<th><p class='p-0 m-0 total_colored'>$total_brgy</p></th>";?>
                      </tr><?php
                    } ?>
                    <tr>
                      <th><p class="p-0 m-0 total_colored">Total:</p></th><?php
                      foreach($online_registration_array_value as $total){ 
                        echo "<th><p class='p-0 m-0 total_colored'>$total</p></th>";
                      }?>
                      <th><p class="p-0 m-0 total_colored"><?php echo $total_vaccinated; ?></p></th>
                    </tr>
                  </tbody>
              </table>
          </div>
      </div>

      <div class="card-body row">
          <div class="col-sm-12">
              <h2 class="page-header row">
                <!-- <div class="col-1 offset-11 pr-3"> <button class="btn btn-outline-info col-12" onclick="Printer()">Print</button></div> -->
                <div class="col-sm-12"><center><br>
                  <img src="../../dist/img/<?php echo $_SESSION["system_logo"];?>" style="width: 125px; hight:125px;"></center>
                </div>
                <div class="col-sm-12" >
                    <center><p style="font-size:18px; margin:none; padding:none;"><b  style="font-size:22px;">Bago City Health Office</b><br>
                    Vaccine Information Management System</p>
                    <!-- <b style="font-size:22px;">Monthly Vaccination Report</b><br> -->
                    <b style="font-size:20px;"><?php echo $month_report_name; ?></b><br></center>
                </div>
            </h2>
            <center><b style="font-size:20px;">Barangay's Total Vaccination by Category</b><br></center>
                <table class="table table-bordered">
                  <thead>  
                      <tr>
                        <th>Barangay</th><?php
                        foreach($category_array as $cat){ ?>
                          <th><?php echo $cat; ?></th> <?php 
                        } ?>
                        <th><p class='p-0 m-0 total_colored'>Total</p></th>
                      </tr>
                  </thead>
                  <tbody><?php
                    $total_vaccinated = 0;
                    foreach($bago_barangay_array as $brgy){?>
                        <tr><th><?php echo $brgy;?></th><?php
                        $total_brgy = 0;
                        foreach($category_array as $category){ 

                          $brgy_cons = str_replace(' ', '', $brgy);
                          $brgy_cons = preg_replace('/[0-9]+/', '', $brgy_cons);
                          $brgy_cons = preg_replace('/[^\p{L}\p{N}\s]/u', '', $brgy_cons);
                          $total = 0;
                          foreach($SelectValue as $person){
                            $array_date_vacination = explode("-", $data["vaccination_date"]);
                            $month_date_vacination = $array_date_vacination[1];
                            if($month_date_vacination == $get_month){
                              $brgy_per = $person["brgy"];
                              $brgy_per = str_replace(' ', '', $brgy_per);
                              $brgy_per = preg_replace('/[0-9]+/', '', $brgy_per);
                              $brgy_per = preg_replace('/[^\p{L}\p{N}\s]/u', '', $brgy_per);

                              if($person["category"] == $category && $brgy_cons == $brgy_per){
                                $total++;
                                $total_brgy++;
                                $total_vaccinated++;
                              }
                              
                              if($brgy == "Non-Bago"){
                                if($person["category"] == $category){
                                  $error = false;
                                  foreach($bago_barangay_array as $brgy_non){
                                    $brgy_cons_non = str_replace(' ', '', $brgy_non);
                                    $brgy_cons_non = preg_replace('/[0-9]+/', '', $brgy_cons_non);
                                    $brgy_cons_non = preg_replace('/[^\p{L}\p{N}\s]/u', '', $brgy_cons_non);
                                    if($brgy_cons_non == $brgy_per){
                                      $error = true;
                                    }
                                  
                                  }  
                                  if($error == false){
                                    $total++;
                                    $total_brgy++;
                                    $total_vaccinated++;
                                  }
                                }
                              }
                            }
                          }

                          echo "<th>$total</th>";
                        } 
                        echo "<th><p class='p-0 m-0 total_colored'>$total_brgy</p></th>";?>
                      </tr><?php
                    } ?>
                    <tr>
                      <th><p class="p-0 m-0 total_colored">Total:</p></th><?php
                      foreach($category_array_value as $total){ 
                        echo "<th><p class='p-0 m-0 total_colored'>$total</p></th>";
                      }?>
                      <th><p class="p-0 m-0 total_colored"><?php echo $total_vaccinated; ?></p></th>
                    </tr>
                  </tbody>
              </table>
          </div>
      </div>

      <div class="card-body row mt-5 pt-5" hidden>
          <div class="col-4  offset-2">
              <h2 class="page-header row">
                <!-- <div class="col-1 offset-11 pr-3"> <button class="btn btn-outline-info col-12" onclick="Printer()">Print</button></div> -->
                <div class="col-sm-12"><center><br>
                  <img src="../../dist/img/<?php echo $_SESSION["system_logo"];?>" style="width: 125px; hight:125px;"></center>
                </div>
                <div class="col-sm-12" >
                    <center><p style="font-size:18px; margin:none; padding:none;"><b  style="font-size:22px;">Bago City Health Office</b><br>
                    Vaccine Information Management System</p>
                    <b style="font-size:22px;">Monthly Vaccination Report</b><br>
                    <b style="font-size:20px;"><?php echo $month_report_name; ?></b><br></center>
                </div>
            </h2>
            <center><b style="font-size:20px;">Vaccinated by Gender</b><br></center>
            <canvas id="gender" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              <table class="table table-bordered">
                  <thead>  
                      <tr> 
                        <th>Female</th>
                        <th>Male</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr><?php 
                        foreach($gender_array as $value){ 
                          echo "<th>".$value."</th>";
                        } ?>
                    </tr>
                  </tbody>
                </table>
          </div>
      </div>


    <div hidden>
      <?php 
        $category_array = implode(", ", $category_array);
        $category_array_value = implode(", ", $category_array_value);

        $non_bago_barangay_array = implode(", ", $non_bago_barangay_array);
        $non_bago_barangay_array_value = implode(", ", $non_bago_barangay_array_value);

        $bago_barangay_array = implode(", ", $bago_barangay_array);
        $bago_barangay_array_value = implode(", ", $bago_barangay_array_value);
        $gender_array = implode(", ", $gender_array);

        $category_array_1st_dose = implode(", ", $category_array_1st_dose);
        $bago_brgy_array_1st_dose = implode(", ", $bago_brgy_array_1st_dose);

        $category_array_2nd_dose = implode(", ", $category_array_2nd_dose);
        $bago_brgy_array_2nd_dose = implode(", ", $bago_brgy_array_2nd_dose);

        $online_registration_array_name = implode(", ", $online_registration_array_name);
        $online_registration_array_value = implode(", ", $online_registration_array_value);
        $online_registration_array_value_sinovac = implode(", ", $online_registration_array_value_sinovac);
        $online_registration_array_value_astra = implode(", ", $online_registration_array_value_astra);

      ?>
      <input type="text" id="category_array" value="<?php echo $category_array;?>">
      <input type="text" id="category_array_value" value="<?php echo $category_array_value;?>">
      <input type="text" id="non_bago_barangay_array" value="<?php echo $non_bago_barangay_array;?>">
      <input type="text" id="non_bago_barangay_array_value" value="<?php echo $non_bago_barangay_array_value;?>">
      <input type="text" id="bago_barangay_array" value="<?php echo $bago_barangay_array;?>">
      <input type="text" id="bago_barangay_array_value" value="<?php echo $bago_barangay_array_value;?>">
      <input type="text" id="gender_array" value="<?php echo $gender_array;?>">
      <input type="text" id="category_array_1st_dose" value="<?php echo $category_array_1st_dose;?>">
      <input type="text" id="bago_brgy_array_1st_dose" value="<?php echo $bago_brgy_array_1st_dose;?>">

      <input type="text" id="category_array_2nd_dose" value="<?php echo $category_array_2nd_dose;?>">
      <input type="text" id="bago_brgy_array_2nd_dose" value="<?php echo $bago_brgy_array_2nd_dose;?>">

      <input type="text" id="online_registration_array_time" value="<?php echo $online_registration_array_name ?>" >
      <input type="text" id="online_registration_array" value="<?php echo $online_registration_array_value ?>" >

      <input type="text" id="online_registration_array_sinovac" value="<?php echo $online_registration_array_value_sinovac ?>" >
      <input type="text" id="online_registration_array_astra" value="<?php echo $online_registration_array_value_astra ?>" >
    </div>
    
    <Br>
    <div class="divFooter col-12"  style="background-image: url('../../dist/img/checkerboard-pattern-green-seamless-background-vector-14423303.jpg'); background-size: 100px 100px;"> 
    <!-- <div class="divFooter col-12">  -->
        <center><p>Bago City College | B.S. in Information System <br> © 2020 James Bryan Flandez. All Rights Reserved.</p></center>
    </div>

    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<?php
   include '../inc/footer.php';//fix this, this is for temporary include!!
?>
<script type="text/javascript"> 
  // /- Category-
    //-------------
    var array_daily_report = document.getElementById("category_array").value;
    var array_data_report = document.getElementById("category_array_value").value;
    var array_data_report1 = document.getElementById("category_array_1st_dose").value;
    var array_data_report2 = document.getElementById("category_array_2nd_dose").value;

    array_daily_report = array_daily_report.split(",");

    array_data_report = array_data_report.split(",");
    array_data_report = array_data_report.map(Number);

    array_data_report1 = array_data_report1.split(",");
    array_data_report1 = array_data_report1.map(Number);

    
    array_data_report2 = array_data_report2.split(",");
    array_data_report2 = array_data_report2.map(Number);

    var areaChartData = {
      labels  : array_daily_report,
      datasets: [
        {
          label               : '1st Dose',
          backgroundColor     : 'rgba(74, 237, 136)',
          borderColor         : 'rgba(74, 237, 136)',
          pointRadius         : false,
          pointColor          : 'rgba(74, 237, 136)',
          pointStrokeColor    : '#23ad2f',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(74, 237, 136)',
          data                : array_data_report1
        },
        {
          label               : '2nd Dose',
          backgroundColor     : 'rgba(74, 210, 237)',
          borderColor         : 'rgba(74, 210, 237)',
          pointRadius         : false,
          pointColor          : 'rgba(74, 210, 237)',
          pointStrokeColor    : '#23ad2f',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(74, 210, 237)',
          data                : array_data_report2
        },
      ]
    }

    var stackedBarChartCanvas = $('#category').get(0).getContext('2d')
    var stackedBarChartData = jQuery.extend(true, {}, areaChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    var stackedBarChart = new Chart(stackedBarChartCanvas, {
      type: 'bar', 
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  //
  // /- bago Brgy-
    //-------------
    var array_daily_report = document.getElementById("bago_barangay_array").value;
    var array_data_report = document.getElementById("bago_barangay_array_value").value;
    var array_data_report1 = document.getElementById("bago_brgy_array_1st_dose").value;
    var array_data_report2 = document.getElementById("bago_brgy_array_2nd_dose").value;

    array_daily_report = array_daily_report.split(",");

    array_data_report = array_data_report.split(",");
    array_data_report = array_data_report.map(Number);

    array_data_report1 = array_data_report1.split(",");
    array_data_report1 = array_data_report1.map(Number);

    array_data_report2 = array_data_report2.split(",");
    array_data_report2 = array_data_report2.map(Number);

    var areaChartData = {
      labels  : array_daily_report,
      datasets: [
        {
          label               : '1st Dose',
          backgroundColor     : 'rgba(74, 237, 136)',
          borderColor         : 'rgba(74, 237, 136)',
          pointRadius         : false,
          pointColor          : 'rgba(74, 237, 136)',
          pointStrokeColor    : '#23ad2f',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(74, 237, 136)',
          data                : array_data_report1
        },
        {
          label               : '2nd Dose',
          backgroundColor     : 'rgba(74, 210, 237)',
          borderColor         : 'rgba(74, 210, 237)',
          pointRadius         : false,
          pointColor          : 'rgba(74, 210, 237)',
          pointStrokeColor    : '#23ad2f',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(74, 210, 237)',
          data                : array_data_report2
        },
      ]
    }

    var stackedBarChartCanvas = $('#bago_brgy').get(0).getContext('2d')
    var stackedBarChartData = jQuery.extend(true, {}, areaChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    var stackedBarChart = new Chart(stackedBarChartCanvas, {
      type: 'bar', 
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  // 
  // gender
   var array_data_report = document.getElementById("gender_array").value;
    array_data_report = array_data_report.split(",");
    array_data_report = array_data_report.map(Number);
      var donutChartCanvas = $('#gender').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'FEMALE', 
          'MALE',
      ],
      datasets: [
        {
          data: array_data_report,
          backgroundColor : ['#d42f89', '#422fd4'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var donutChart = new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions      
    })


 //-------------
    //- LINE CHART -
    //--------------
    // /- BAR CHART of per Daily-
    //-------------
    var array_daily_report = document.getElementById("online_registration_array_time").value;
    var array_data_report = document.getElementById("online_registration_array").value;

    array_daily_report = array_daily_report.split(",");

    array_data_report = array_data_report.split(",");
    array_data_report = array_data_report.map(Number);

    var BrgyData34 = {
      labels  : array_daily_report,
      datasets: [
        {
          label               : 'Close Contact',
          backgroundColor     : 'rgba(189, 11, 8)',
          borderColor         : 'rgba(189, 11, 8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(189, 11, 8)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(189, 11, 8)',
          data                : array_data_report
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }
    
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, BrgyData34)
    lineChartData.datasets[0].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, { 
      type: 'line',
      data: lineChartData, 
      options: lineChartOptions
    })


    function resizeIframe(obj) {
        obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
    }

    //-------------
    //- LINE CHART -
    //--------------
    // /- BAR CHART of per Daily-
    //-------------
    var array_daily_report = document.getElementById("online_registration_array_time").value;
    var array_data_report = document.getElementById("online_registration_array_sinovac").value;

    array_daily_report = array_daily_report.split(",");

    array_data_report = array_data_report.split(",");
    array_data_report = array_data_report.map(Number);

    var BrgyData34 = {
      labels  : array_daily_report,
      datasets: [
        {
          label               : 'Close Contact',
          backgroundColor     : 'rgba(189, 11, 8)',
          borderColor         : 'rgba(189, 11, 8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(189, 11, 8)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(189, 11, 8)',
          data                : array_data_report
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }
    
    var lineChartCanvas = $('#lineChartsinovac').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, BrgyData34)
    lineChartData.datasets[0].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, { 
      type: 'line',
      data: lineChartData, 
      options: lineChartOptions
    })


    function resizeIframe(obj) {
        obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
    }

    //-------------
    //- LINE CHART -
    //--------------
    // /- BAR CHART of per Daily-
    //-------------
    var array_daily_report = document.getElementById("online_registration_array_time").value;
    var array_data_report = document.getElementById("online_registration_array_astra").value;

    array_daily_report = array_daily_report.split(",");

    array_data_report = array_data_report.split(",");
    array_data_report = array_data_report.map(Number);

    var BrgyData34 = {
      labels  : array_daily_report,
      datasets: [
        {
          label               : 'Close Contact',
          backgroundColor     : 'rgba(189, 11, 8)',
          borderColor         : 'rgba(189, 11, 8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(189, 11, 8)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(189, 11, 8)',
          data                : array_data_report
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }
    
    var lineChartCanvas = $('#lineChartastra').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, BrgyData34)
    lineChartData.datasets[0].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, { 
      type: 'line',
      data: lineChartData, 
      options: lineChartOptions
    })


    function resizeIframe(obj) {
        obj.style.height = obj.contentWindow.document.documentElement.scrollHeight + 'px';
    }



function Printer(){
  window.print();
}




</script>
</body>
</html>





        <!-- //PREDICTION(2nd DOSE!!) -->
        <tr>
          <th style='background-color:rgb(245, 220, 176)'><h4><b>DATES</b></h4></th>
          <th colspan="<?php echo (($Ncat * $Ndose) * $Nvac) + ( 2*$Nvac); ?>" style='background-color:rgb(240, 156, 10); color:white;'><h4><b>Following 2nd Dose Schedule</b></h4></th>
          <th style='background-color:rgb(245, 220, 176)'><h4><b>TOTAL</b></h4></th>
        </tr>
        <?php
        $current_month = date("m");
        $current_day = date("Y-m-d");

        $dates_PRE = array();
        for($x = 0; $x <= 81; $x++){
          $vaccination_date = date('Y-m-d', strtotime($current_day. ' + 1 days'));
          $current_day = $vaccination_date;
          array_push($dates_PRE, $vaccination_date);
        }
          foreach($dates_PRE as $date){  
            $Astra_Pre_Date = date('Y-m-d', strtotime($date. ' - 81 days'));
            $Sino_Pre_Date = date('Y-m-d', strtotime($date. ' - 28 days'));

            $SelectCons = $systemcore->SelectTable("vims_report WHERE 1st_dose = 'Y' AND vaccine_name != 'Johnson & Johnson' AND (vaccination_date = '$Astra_Pre_Date' OR vaccination_date = '$Sino_Pre_Date')"); 
            if($SelectCons != "none"){?>
            <tr>
                <td style='background-color:rgb(245, 220, 176)'><?php echo $date; ?></td> <?php 
                $total_2 = "";
                foreach($Global_vaccine_name as $vaccine){
                  $process_cancel = FALSE;
                  if($vaccine == "Astrazeneca"){
                    $date_Pre = $Astra_Pre_Date;
                  }
                  if($vaccine == "Sinovac"){
                    $date_Pre = $Sino_Pre_Date;
                  }
                  if($vaccine == "Johnson & Johnson"){
                    $process_cancel = TRUE;
                  }
                    foreach($DosesNumber as $dose){
                      $total_1 = "";
                      foreach($Global_new_category_array as $cat){ 
                        $data="";
                        if($process_cancel == FALSE && $dose == "2ND DOSE"){
                          $SelectReport = $systemcore->SelectTable("vims_report WHERE vaccination_date = '$date_Pre' AND category = '$cat' AND vaccine_name = '$vaccine' AND 1st_dose = 'Y'");
                          if($SelectReport != "none"){
                            foreach($SelectReport as $value){
                              $data++;
                              $total_1++;
                              $total_2++;
                            }
                          }else{
                            $data="";
                          }
                        } ?>
                        <td><?php echo $data; ?></td> <?php
                      }
                      echo "<td style='background-color:rgb(255, 192, 82)'>".$total_1."</td>";
                    } 
                
                } ?>
                <td style='background-color:rgb(245, 220, 176)'><b><?php echo $total_2; ?></b></td>
            </tr>
            <?php
            }
          } ?>
    </tbody>
  </table>
  <!-- PREDICTION FACTION!! -->