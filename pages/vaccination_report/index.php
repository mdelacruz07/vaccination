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

    include '../registrants/vims_settings.php'; 
    $VIMS_settings = new VIMS_settings();
    $category_array = $VIMS_settings->Global_new_category_array();
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

    $online_registration_array_value_1st = array();//1st dose
    $online_registration_array_value_2nd = array();//2nd dose

    $online_registration_array_time = array();
    $online_registration_array_name = array();

    $online_registration_array_value_sinovac = array();
    $online_registration_array_value_sinovac_1st = array();//1st dose
    $online_registration_array_value_sinovac_2nd = array();//2nd dose

    $online_registration_array_value_astra = array();
    $online_registration_array_value_astra_1st = array();//1st dose
    $online_registration_array_value_astra_2nd = array();//2nd dose

    $online_registration_array_value_jnj = array();
    $online_registration_array_value_jnj_1st = array();//1st dose
    $online_registration_array_value_jnj_2nd = array();//2nd dose

    $online_registration_array_value_moderna = array();
    $online_registration_array_value_moderna_1st = array();//1st dose
    $online_registration_array_value_moderna_2nd = array();//2nd dose

    $online_registration_array_value_sinopharm = array();
    $online_registration_array_value_sinopharm_1st = array();//1st dose
    $online_registration_array_value_sinopharm_2nd = array();//2nd dose

    $current_date = date("Y-m-d"); 
    $starting_date = date("2021-02-01");  
    $inc_starting_date = date("2021-02-01");   
    for ($x = 0; $x < 1000; $x++) {
      $inc_starting_date = date('Y-m-d', strtotime($inc_starting_date. ' + 1 months'));
      $inc_date = explode("-", $inc_starting_date);
      array_push($online_registration_array_time,$inc_starting_date);
      array_push($online_registration_array_name,date('M Y', strtotime($inc_starting_date)));
      array_push($online_registration_array_value, 0);
      array_push($online_registration_array_value_sinovac, 0);
      array_push($online_registration_array_value_astra, 0);

      array_push($online_registration_array_value_1st, 0);
      array_push($online_registration_array_value_2nd, 0);
      array_push($online_registration_array_value_sinovac_1st, 0);
      array_push($online_registration_array_value_sinovac_2nd, 0);
      array_push($online_registration_array_value_astra_1st, 0);
      array_push($online_registration_array_value_astra_2nd, 0);
      array_push($online_registration_array_value_jnj_1st, 0);
      array_push($online_registration_array_value_jnj_2nd, 0);
      array_push($online_registration_array_value_moderna_1st, 0);
      array_push($online_registration_array_value_moderna_2nd, 0);

      if($inc_date[0] == date("Y") && $inc_date[1] == date('m', strtotime($current_date. ' + 1 months'))){
        break;
      }
    }


 
    $SelectValue = $systemcore->SelectCustomize("SELECT * FROM vims_report");
    foreach($SelectValue as $data){
      $Category = $data["category"];
      $vaccine_name = $data["vaccine_name"];
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

            if($vaccine_name == "Johnson & Johnson"){ //JNJ has only 1 dose
              $bago_brgy_array_2nd_dose[$x]++;
            }else{
              if($data["2nd_dose"] == "Y"){
                $bago_brgy_array_2nd_dose[$x]++;
              }else{
                $bago_brgy_array_1st_dose[$x]++;
              }
            }

        }
        $x++;
      }
      if($error == false){
        array_push($non_bago_barangay_array, $brgy);
        $bago_barangay_array_value[24]++;
        if($vaccine_name == "Johnson & Johnson"){ //JNJ has only 1 dose
          $bago_brgy_array_2nd_dose[24]++;
        }else{
          if($data["2nd_dose"] == "Y"){
            $bago_brgy_array_2nd_dose[24]++;
          }else{
            $bago_brgy_array_1st_dose[24]++;
          }
        }

      }

      //Vaccination TIme Series
      $date_of_vaccination = $data["vaccination_date"];
      $vaccine_name = $data["vaccine_name"];
      for ($x = 0; $x < count($online_registration_array_time); $x++) {
        // echo $date_of_vaccination." >= ".$online_registration_array_time[$x]." && ".$date_of_vaccination." <= ".$online_registration_array_time[$x+1]."<br>";
        if($date_of_vaccination >= $online_registration_array_time[$x] && $date_of_vaccination < $online_registration_array_time[$x+1]){
          $online_registration_array_value[$x]++;

          if($vaccine_name == "Sinovac" || $vaccine_name == "SINOVAC"){
            $online_registration_array_value_sinovac[$x]++;
            //Dose Conditions
            if($data["2nd_dose"] == "Y"){
              $online_registration_array_value_sinovac_2nd[$x]++;
              // $online_registration_array_value_2nd[$x]++;
            }else{
              $online_registration_array_value_sinovac_1st[$x]++;
              // $online_registration_array_value_1st[$x]++;
            }

          }else if($vaccine_name == "Astrazeneca"){
            $online_registration_array_value_astra[$x]++;

            //Dose Conditions
            if($data["2nd_dose"] == "Y"){
              $online_registration_array_value_astra_2nd[$x]++;
              // $online_registration_array_value_2nd[$x]++;
            }else{
              $online_registration_array_value_astra_1st[$x]++;
              // $online_registration_array_value_1st[$x]++;
            }
          }

          else if($vaccine_name == "Moderna"){
            $online_registration_array_value_moderna[$x]++;

            //Dose Conditions
            if($data["2nd_dose"] == "Y"){
              $online_registration_array_value_moderna_2nd[$x]++;
              // $online_registration_array_value_2nd[$x]++;
            }else{
              $online_registration_array_value_moderna_1st[$x]++;
              // $online_registration_array_value_1st[$x]++;
            }
          }

          else if($vaccine_name == "Sinopharm"){
            $online_registration_array_value_sinopharm[$x]++;

            //Dose Conditions
            if($data["2nd_dose"] == "Y"){
              $online_registration_array_value_sinopharm_2nd[$x]++;
              // $online_registration_array_value_2nd[$x]++;
            }else{
              $online_registration_array_value_sinopharm_1st[$x]++;
              // $online_registration_array_value_1st[$x]++;
            }
          }

          
          
          else if($vaccine_name == "Johnson & Johnson"){
            $online_registration_array_value_jnj[$x]++;

            //Dose Conditions
            if($data["1st_dose"] == "Y"){
              $online_registration_array_value_jnj_1st[$x]++;
              $online_registration_array_value_jnj_2nd[$x]++;
              // $online_registration_array_value_2nd[$x]++;
            }
          }

          //Dose Conditions
          if($vaccine_name == "Johnson & Johnson"){ //JNJ has only 1 dose
            $online_registration_array_value_2nd[$x]++;
          }else{
            if($data["2nd_dose"] == "Y"){
              $online_registration_array_value_2nd[$x]++;
            }else if($data["1st_dose"] == "Y"){
              $online_registration_array_value_1st[$x]++;
            }
          }


        }
      }

      if($gender == "F"){
        $gender_array[0]++;
      }else{
        $gender_array[1]++;
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

    //BY CATEGORY STATS
    foreach($SelectValue as $data){
      $vaccine_name = $data["vaccine_name"];
      for($x = 0; $x < count($category_array)+1; $x++){
        if($category_array[$x] == $data["category"]){
          $category_array_value[$x]++;

          if($vaccine_name == "Johnson & Johnson"){ //JNJ has only 1 dose
            $category_array_2nd_dose[$x]++;
          }else{
            if($data["2nd_dose"] == "Y"){
              $category_array_2nd_dose[$x]++;
            }else{
              $category_array_1st_dose[$x]++;
            }
          }
        }
      }
      for($x = 0; $x < count($non_bago_barangay_array); $x++){
        
        if($non_bago_barangay_array[$x] == $data["brgy"]){ 
          $non_bago_barangay_array_value[$x]++;
        }
      }
    }


    // print_r($online_registration_array_value);
    array_pop($online_registration_array_value);
    array_pop($online_registration_array_time);
    array_pop($online_registration_array_name);

    array_pop($online_registration_array_value_sinovac);
    array_pop($online_registration_array_value_astra);

    array_pop($online_registration_array_value_1st);
    array_pop($online_registration_array_value_2nd);

    array_pop($online_registration_array_value_sinovac_1st);
    array_pop($online_registration_array_value_sinovac_2nd);

    array_pop($online_registration_array_value_astra_1st);
    array_pop($online_registration_array_value_astra_2nd);

    array_pop($online_registration_array_value_jnj_1st);
    array_pop($online_registration_array_value_jnj_2nd);

    array_pop($online_registration_array_value_moderna_1st);
    array_pop($online_registration_array_value_moderna_2nd);

    array_pop($online_registration_array_value_sinopharm_1st);
    array_pop($online_registration_array_value_sinopharm_2nd);

    

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
                  <b style="font-size:20px;"><?php echo date("F d Y"); ?></b><br></center>
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
                    <b style="font-size:20px;"><?php echo date("F d Y"); ?></b><br></center>
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
                    <b style="font-size:20px;"><?php echo date("F d Y"); ?></b><br></center>
                </div>
            </h2>
            <center><b style="font-size:20px;"><u>Total Vaccinated by Month</u></b><br></center>
            <canvas id="lineChart" style="min-height: 350px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
                <table class="table table-bordered">
                  <thead>  
                      <tr>
                        <th>Month</th>
                        <th>1st Dose</th>
                        <th>2nd Dose</th>
                        <th>Total</th>
                      </tr>
                  </thead>
                  <tbody><?php
                    $total = 0;
                    $total_1 = 0;
                    $total_2 = 0;
                    for($x = 0; $x < count($online_registration_array_time); $x++){ ?>
                    <tr>
                      <td><?php echo $online_registration_array_name[$x]; ?></td>
                      <td><?php echo $online_registration_array_value_1st[$x]; $total_1 = $total_1 + $online_registration_array_value_1st[$x];?></td>
                      <td><?php echo $online_registration_array_value_2nd[$x]; $total_2 = $total_2 + $online_registration_array_value_2nd[$x];?></td>
                      <td><?php echo $online_registration_array_value[$x]; $total = $total + $online_registration_array_value[$x];?></td>
                    </tr>
                    <?php } ?>
                    <tr class="colored_row">
                      <td><p class="p-0 m-0 total_colored">Total:</p></td>
                      <td><p class="p-0 m-0 total_colored"><?php echo $total_1; ?></p></td>
                      <td><p class="p-0 m-0 total_colored"><?php echo $total_2; ?></p></td>
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
                    <!-- <b style="font-size:22px;">Monthly Vaccination Report</b><br> -->
                    <b style="font-size:20px;"><?php echo date("F d Y"); ?></b><br></center>
                </div>
            </h2>
            <center><b style="font-size:20px;"><u>Total Vaccinated by Month(<span style="color:red;">Sinovac</span>)</u></b><br></center>
            <canvas id="lineChartsinovac" style="min-height: 350px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
                <table class="table table-bordered">
                  <thead>  
                      <tr>
                        <th>Month</th>
                        <th>1st Dose</th>
                        <th>2nd Dose</th>
                        <th>Total</th>
                      </tr>
                  </thead>
                  <tbody><?php
                    $total = 0;
                    $total_1 = 0;
                    $total_2 = 0;
                    for($x = 0; $x < count($online_registration_array_time); $x++){ ?>
                    <tr>
                      <td><?php echo $online_registration_array_name[$x]; ?></td>
                      <td><?php echo $online_registration_array_value_sinovac_1st[$x]; $total_1 = $total_1 + $online_registration_array_value_sinovac_1st[$x];?></td>
                      <td><?php echo $online_registration_array_value_sinovac_2nd[$x]; $total_2 = $total_2 + $online_registration_array_value_sinovac_2nd[$x];?></td>
                      <td><?php echo $online_registration_array_value_sinovac[$x]; $total = $total + $online_registration_array_value_sinovac[$x];?></td>
                    </tr>
                    <?php } ?>
                    <tr class="colored_row">
                      <td><p class="p-0 m-0 total_colored">Total:</p></td>
                      <td><p class="p-0 m-0 total_colored"><?php echo $total_1; ?></p></td>
                      <td><p class="p-0 m-0 total_colored"><?php echo $total_2; ?></p></td>
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
                    <!-- <b style="font-size:22px;">Monthly Vaccination Report</b><br> -->
                    <b style="font-size:20px;"><?php echo date("F d Y"); ?></b><br></center>
                </div>
            </h2>
            <center><b style="font-size:20px;"><u>Total Vaccinated by Month(<span style="color:red;">Astrazeneca</span>)</u></b><br></center>
            <canvas id="lineChartastra" style="min-height: 350px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
                <table class="table table-bordered">
                  <thead>  
                      <tr>
                        <th>Month</th>
                        <th>1st Dose</th>
                        <th>2nd Dose</th>
                        <th>Total</th>
                      </tr>
                  </thead>
                  <tbody><?php
                    $total = 0;
                    $total1 = 0;
                    $total2 = 0;
                    for($x = 0; $x < count($online_registration_array_time); $x++){ ?>
                    <tr>
                      <td><?php echo $online_registration_array_name[$x]; ?></td>
                      <td><?php echo $online_registration_array_value_astra_1st[$x]; $total1 = $total1 + $online_registration_array_value_astra_1st[$x];?></td>
                      <td><?php echo $online_registration_array_value_astra_2nd[$x]; $total2 = $total2 + $online_registration_array_value_astra_2nd[$x];?></td>
                      <td><?php echo $online_registration_array_value_astra[$x]; $total = $total + $online_registration_array_value_astra[$x];?></td>
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
                    <b style="font-size:20px;"><?php echo date("F d Y"); ?></b><br></center>
                </div>
            </h2>
            <center><b style="font-size:20px;"><u>Total Vaccinated by Month(<span style="color:red;">Johnson & Johnson</span>)</u></b><br></center>
            <canvas id="lineChartjnj" style="min-height: 350px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
                <table class="table table-bordered">
                  <thead>  
                      <tr>
                        <th>Month</th>
                        <!-- <th>1st Dose</th> -->
                        <th>2nd Dose</th>
                        <th>Total</th>
                      </tr>
                  </thead>
                  <tbody><?php
                    $total = 0;
                    $total1 = 0;
                    $total2 = 0;
                    for($x = 0; $x < count($online_registration_array_time); $x++){ ?>
                    <tr>
                      <td><?php echo $online_registration_array_name[$x]; ?></td>
                      <!-- <td><?php echo $online_registration_array_value_jnj_1st[$x]; $total1 = $total1 + $online_registration_array_value_jnj_1st[$x];?></td> -->
                      <td><?php echo $online_registration_array_value_jnj_2nd[$x]; $total2 = $total2 + $online_registration_array_value_jnj_2nd[$x];?></td>
                      <td><?php echo $online_registration_array_value_jnj[$x]; $total = $total + $online_registration_array_value_jnj[$x];?></td>
                    </tr>
                    <?php } ?>
                    <tr class="colored_row">
                      <td><p class="p-0 m-0 total_colored">Total:</p></td>
                      <!-- <td><p class="p-0 m-0 total_colored"><?php echo $total1; ?></p></td> -->
                      <td><p class="p-0 m-0 total_colored"><?php echo $total2; ?></p></td>
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
                    <!-- <b style="font-size:22px;">Monthly Vaccination Report</b><br> -->
                    <b style="font-size:20px;"><?php echo date("F d Y"); ?></b><br></center>
                </div>
            </h2>
            <center><b style="font-size:20px;"><u>Total Vaccinated by Month(<span style="color:red;">Moderna</span>)</u></b><br></center>
            <canvas id="lineChartmoderna" style="min-height: 350px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
                <table class="table table-bordered">
                  <thead>  
                      <tr>
                        <th>Month</th>
                        <th>1st Dose</th>
                        <th>2nd Dose</th>
                        <th>Total</th>
                      </tr>
                  </thead>
                  <tbody><?php
                    $total = 0;
                    $total1 = 0;
                    $total2 = 0;
                    for($x = 0; $x < count($online_registration_array_time); $x++){ ?>
                    <tr>
                      <td><?php echo $online_registration_array_name[$x]; ?></td>
                      <td><?php echo $online_registration_array_value_moderna_1st[$x]; $total1 = $total1 + $online_registration_array_value_moderna_1st[$x];?></td>
                      <td><?php echo $online_registration_array_value_moderna_2nd[$x]; $total2 = $total2 + $online_registration_array_value_moderna_2nd[$x];?></td>
                      <td><?php echo $online_registration_array_value_moderna[$x]; $total = $total + $online_registration_array_value_moderna[$x];?></td>
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
                    <b style="font-size:20px;"><?php echo date("F d Y"); ?></b><br></center>
                </div>
            </h2>
            <center><b style="font-size:20px;"><u>Total Vaccinated by Month(<span style="color:red;">Sinopharm</span>)</u></b><br></center>
            <canvas id="lineChartsinopharm" style="min-height: 350px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
                <table class="table table-bordered">
                  <thead>  
                      <tr>
                        <th>Month</th>
                        <th>1st Dose</th>
                        <th>2nd Dose</th>
                        <th>Total</th>
                      </tr>
                  </thead>
                  <tbody><?php
                    $total = 0;
                    $total1 = 0;
                    $total2 = 0;
                    for($x = 0; $x < count($online_registration_array_time); $x++){ ?>
                    <tr>
                      <td><?php echo $online_registration_array_name[$x]; ?></td>
                      <td><?php echo $online_registration_array_value_sinopharm_1st[$x]; $total1 = $total1 + $online_registration_array_value_sinopharm_1st[$x];?></td>
                      <td><?php echo $online_registration_array_value_sinopharm_2nd[$x]; $total2 = $total2 + $online_registration_array_value_sinopharm_2nd[$x];?></td>
                      <td><?php echo $online_registration_array_value_sinopharm[$x]; $total = $total + $online_registration_array_value_sinopharm[$x];?></td>
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
                    <b style="font-size:20px;"><?php echo date("F d Y"); ?></b><br></center>
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
                    <b style="font-size:20px;"><?php echo date("F d Y"); ?></b><br></center>
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
                    <b style="font-size:20px;"><?php echo date("F d Y"); ?></b><br></center>
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

        $online_registration_array_value_1st = implode(", ", $online_registration_array_value_1st);
        $online_registration_array_value_2nd = implode(", ", $online_registration_array_value_2nd);

        $online_registration_array_value_sinovac_1st = implode(", ", $online_registration_array_value_sinovac_1st);
        $online_registration_array_value_sinovac_2nd = implode(", ", $online_registration_array_value_sinovac_2nd);

        $online_registration_array_value_astra_1st = implode(", ", $online_registration_array_value_astra_1st);
        $online_registration_array_value_astra_2nd = implode(", ", $online_registration_array_value_astra_2nd);

        $online_registration_array_value_jnj = implode(", ", $online_registration_array_value_jnj);
        $online_registration_array_value_jnj_1st = implode(", ", $online_registration_array_value_jnj_1st);
        $online_registration_array_value_jnj_2nd = implode(", ", $online_registration_array_value_jnj_2nd);

        $online_registration_array_value_moderna = implode(", ", $online_registration_array_value_moderna);
        $online_registration_array_value_moderna_1st = implode(", ", $online_registration_array_value_moderna_1st);
        $online_registration_array_value_moderna_2nd = implode(", ", $online_registration_array_value_moderna_2nd);

        $online_registration_array_value_sinopharm = implode(", ", $online_registration_array_value_sinopharm);
        $online_registration_array_value_sinopharm_1st = implode(", ", $online_registration_array_value_sinopharm_1st);
        $online_registration_array_value_sinopharm_2nd = implode(", ", $online_registration_array_value_sinopharm_2nd);


      ?>
      <input type="text" id="online_registration_array_value_moderna_1st" value="<?php echo $online_registration_array_value_moderna_1st ?>" >
      <input type="text" id="online_registration_array_value_moderna_2nd" value="<?php echo $online_registration_array_value_moderna_2nd ?>" >
      <input type="text" id="online_registration_array_moderna" value="<?php echo $online_registration_array_value_moderna ?>" >

      <input type="text" id="online_registration_array_value_sinopharm_1st" value="<?php echo $online_registration_array_value_sinopharm_1st ?>" >
      <input type="text" id="online_registration_array_value_sinopharm_2nd" value="<?php echo $online_registration_array_value_sinopharm_2nd ?>" >
      <input type="text" id="online_registration_array_sinopharm" value="<?php echo $online_registration_array_value_sinopharm ?>" >

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

      <input type="text" id="online_registration_array_value_1st" value="<?php echo $online_registration_array_value_1st ?>" >
      <input type="text" id="online_registration_array_value_2nd" value="<?php echo $online_registration_array_value_2nd ?>" >

      <input type="text" id="online_registration_array_value_sinovac_1st" value="<?php echo $online_registration_array_value_sinovac_1st ?>" >
      <input type="text" id="online_registration_array_value_sinovac_2nd" value="<?php echo $online_registration_array_value_sinovac_2nd ?>" >

      <input type="text" id="online_registration_array_value_astra_1st" value="<?php echo $online_registration_array_value_astra_1st ?>" >
      <input type="text" id="online_registration_array_value_astra_2nd" value="<?php echo $online_registration_array_value_astra_2nd ?>" >

      <input type="text" id="online_registration_array_value_jnj_1st" value="<?php echo $online_registration_array_value_jnj_1st ?>" >
      <input type="text" id="online_registration_array_value_jnj_2nd" value="<?php echo $online_registration_array_value_jnj_2nd ?>" >
      <input type="text" id="online_registration_array_jnj" value="<?php echo $online_registration_array_value_jnj ?>" >
      

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

    var online_registration_array_value_1st = document.getElementById("online_registration_array_value_1st").value;
    var online_registration_array_value_2nd = document.getElementById("online_registration_array_value_2nd").value;

    array_daily_report = array_daily_report.split(",");

    array_data_report = array_data_report.split(",");
    array_data_report = array_data_report.map(Number);
    online_registration_array_value_1st = online_registration_array_value_1st.split(",");
    online_registration_array_value_1st = online_registration_array_value_1st.map(Number);
    online_registration_array_value_2nd = online_registration_array_value_2nd.split(",");
    online_registration_array_value_2nd = online_registration_array_value_2nd.map(Number);

    var BrgyData34 = {
      labels  : array_daily_report,
      datasets: [
        {
          label               : 'Total',
          backgroundColor     : 'rgba(6, 148, 77)',
          borderColor         : 'rgba(6, 148, 77)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(6, 148, 77)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(6, 148, 77)',
          data                : array_data_report
        },
        {
          label               : '1st Dose',
          backgroundColor     : 'rgba(189, 11, 8)',
          borderColor         : 'rgba(189, 11, 8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(189, 11, 8)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(189, 11, 8)',
          data                : online_registration_array_value_1st
        },
        {
          label               : '2nd Dose',
          backgroundColor     : 'rgba(14, 179, 230)',
          borderColor         : 'rgba(14, 179, 230)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(14, 179, 230)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(14, 179, 230)',
          data                : online_registration_array_value_2nd
        },
        
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: true
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : true,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,
          }
        }]
      }
    }
    
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, BrgyData34)

    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartData.datasets[2].fill = false;
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

    var online_registration_array_value_sinovac_1st = document.getElementById("online_registration_array_value_sinovac_1st").value;
    var online_registration_array_value_sinovac_2nd = document.getElementById("online_registration_array_value_sinovac_2nd").value;

    online_registration_array_value_sinovac_1st = online_registration_array_value_sinovac_1st.split(",");
    online_registration_array_value_sinovac_1st = online_registration_array_value_sinovac_1st.map(Number);
    online_registration_array_value_sinovac_2nd = online_registration_array_value_sinovac_2nd.split(",");
    online_registration_array_value_sinovac_2nd = online_registration_array_value_sinovac_2nd.map(Number);

    var BrgyData34 = {
      labels  : array_daily_report,
      datasets: [
        {
          label               : 'Total',
          backgroundColor     : 'rgba(6, 148, 77)',
          borderColor         : 'rgba(6, 148, 77)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(6, 148, 77)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(6, 148, 77)',
          data                : array_data_report
        },
        {
          label               : '1st Dose',
          backgroundColor     : 'rgba(189, 11, 8)',
          borderColor         : 'rgba(189, 11, 8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(189, 11, 8)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(189, 11, 8)',
          data                : online_registration_array_value_sinovac_1st
        },
        {
          label               : '2nd Dose',
          backgroundColor     : 'rgba(14, 179, 230)',
          borderColor         : 'rgba(14, 179, 230)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(14, 179, 230)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(14, 179, 230)',
          data                : online_registration_array_value_sinovac_2nd
        },
      ]
    }
    
    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: true
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : true,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,
          }
        }]
      }
    }

    var lineChartCanvas = $('#lineChartsinovac').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, BrgyData34)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartData.datasets[2].fill = false;
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

    var online_registration_array_value_astra_1st = document.getElementById("online_registration_array_value_astra_1st").value;
    var online_registration_array_value_astra_2nd = document.getElementById("online_registration_array_value_astra_2nd").value;

    online_registration_array_value_astra_1st = online_registration_array_value_astra_1st.split(",");
    online_registration_array_value_astra_1st = online_registration_array_value_astra_1st.map(Number);
    online_registration_array_value_astra_2nd = online_registration_array_value_astra_2nd.split(",");
    online_registration_array_value_astra_2nd = online_registration_array_value_astra_2nd.map(Number);

    var BrgyData34 = {
      labels  : array_daily_report,
      datasets: [
        {
          label               : 'Total',
          backgroundColor     : 'rgba(6, 148, 77)',
          borderColor         : 'rgba(6, 148, 77)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(6, 148, 77)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(6, 148, 77)',
          data                : array_data_report
        },
        {
          label               : '1st Dose',
          backgroundColor     : 'rgba(189, 11, 8)',
          borderColor         : 'rgba(189, 11, 8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(189, 11, 8)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(189, 11, 8)',
          data                : online_registration_array_value_astra_1st
        },
        {
          label               : '2nd Dose',
          backgroundColor     : 'rgba(14, 179, 230)',
          borderColor         : 'rgba(14, 179, 230)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(14, 179, 230)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(14, 179, 230)',
          data                : online_registration_array_value_astra_2nd
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: true
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : true,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,
          }
        }]
      }
    }
    
    var lineChartCanvas = $('#lineChartastra').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, BrgyData34)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartData.datasets[2].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, { 
      type: 'line',
      data: lineChartData, 
      options: lineChartOptions
    })



        //-------------
    //- LINE CHART -
    //--------------
    // /- BAR CHART of per Daily-
    //-------------
    var array_daily_report = document.getElementById("online_registration_array_time").value;
    var array_data_report = document.getElementById("online_registration_array_jnj").value;

    array_daily_report = array_daily_report.split(",");

    array_data_report = array_data_report.split(",");
    array_data_report = array_data_report.map(Number);

    var online_registration_array_value_jnj_1st = document.getElementById("online_registration_array_value_jnj_1st").value;
    var online_registration_array_value_jnj_2nd = document.getElementById("online_registration_array_value_jnj_2nd").value;

    online_registration_array_value_jnj_1st = online_registration_array_value_jnj_1st.split(",");
    online_registration_array_value_jnj_1st = online_registration_array_value_jnj_1st.map(Number);
    online_registration_array_value_jnj_2nd = online_registration_array_value_jnj_2nd.split(",");
    online_registration_array_value_jnj_2nd = online_registration_array_value_jnj_2nd.map(Number);

    var BrgyData34 = {
      labels  : array_daily_report,
      datasets: [
        {
          label               : 'Total',
          backgroundColor     : 'rgba(6, 148, 77)',
          borderColor         : 'rgba(6, 148, 77)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(6, 148, 77)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(6, 148, 77)',
          data                : array_data_report
        },
        {
          label               : '1st Dose',
          backgroundColor     : 'rgba(189, 11, 8)',
          borderColor         : 'rgba(189, 11, 8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(189, 11, 8)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(189, 11, 8)',
          data                : online_registration_array_value_jnj_1st
        },
        {
          label               : '2nd Dose',
          backgroundColor     : 'rgba(14, 179, 230)',
          borderColor         : 'rgba(14, 179, 230)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(14, 179, 230)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(14, 179, 230)',
          data                : online_registration_array_value_jnj_2nd
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: true
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : true,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,
          }
        }]
      }
    }
    
    var lineChartCanvas = $('#lineChartjnj').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, BrgyData34)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartData.datasets[2].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, { 
      type: 'line',
      data: lineChartData, 
      options: lineChartOptions
    })

    

    //-------------
    //- LINE CHART -
    //--------------
    // /- BAR CHART of per Daily-
    //-------------
    var array_daily_report = document.getElementById("online_registration_array_time").value;
    var array_data_report = document.getElementById("online_registration_array_moderna").value;

    array_daily_report = array_daily_report.split(",");
    array_data_report = array_data_report.split(",");
    array_data_report = array_data_report.map(Number);

    var online_registration_array_value_moderna_1st = document.getElementById("online_registration_array_value_moderna_1st").value;
    var online_registration_array_value_moderna_2nd = document.getElementById("online_registration_array_value_moderna_2nd").value;

    online_registration_array_value_moderna_1st = online_registration_array_value_moderna_1st.split(",");
    online_registration_array_value_moderna_1st = online_registration_array_value_moderna_1st.map(Number);
    online_registration_array_value_moderna_2nd = online_registration_array_value_moderna_2nd.split(",");
    online_registration_array_value_moderna_2nd = online_registration_array_value_moderna_2nd.map(Number);

    var BrgyData34 = {
      labels  : array_daily_report,
      datasets: [
        {
          label               : 'Total',
          backgroundColor     : 'rgba(6, 148, 77)',
          borderColor         : 'rgba(6, 148, 77)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(6, 148, 77)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(6, 148, 77)',
          data                : array_data_report
        },
        {
          label               : '1st Dose',
          backgroundColor     : 'rgba(189, 11, 8)',
          borderColor         : 'rgba(189, 11, 8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(189, 11, 8)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(189, 11, 8)',
          data                : online_registration_array_value_moderna_1st
        },
        {
          label               : '2nd Dose',
          backgroundColor     : 'rgba(14, 179, 230)',
          borderColor         : 'rgba(14, 179, 230)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(14, 179, 230)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(14, 179, 230)',
          data                : online_registration_array_value_moderna_2nd
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: true
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : true,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,
          }
        }]
      }
    }
    
    var lineChartCanvas = $('#lineChartmoderna').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, BrgyData34)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartData.datasets[2].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, { 
      type: 'line',
      data: lineChartData, 
      options: lineChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    // /- BAR CHART of per Daily-
    //-------------
    var array_daily_report = document.getElementById("online_registration_array_time").value;
    var array_data_report = document.getElementById("online_registration_array_sinopharm").value;

    array_daily_report = array_daily_report.split(",");
    array_data_report = array_data_report.split(",");
    array_data_report = array_data_report.map(Number);

    var online_registration_array_value_sinopharm_1st = document.getElementById("online_registration_array_value_sinopharm_1st").value;
    var online_registration_array_value_sinopharm_2nd = document.getElementById("online_registration_array_value_sinopharm_2nd").value;

    online_registration_array_value_sinopharm_1st = online_registration_array_value_sinopharm_1st.split(",");
    online_registration_array_value_sinopharm_1st = online_registration_array_value_sinopharm_1st.map(Number);
    online_registration_array_value_sinopharm_2nd = online_registration_array_value_sinopharm_2nd.split(",");
    online_registration_array_value_sinopharm_2nd = online_registration_array_value_sinopharm_2nd.map(Number);

    var BrgyData34 = {
      labels  : array_daily_report,
      datasets: [
        {
          label               : 'Total',
          backgroundColor     : 'rgba(6, 148, 77)',
          borderColor         : 'rgba(6, 148, 77)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(6, 148, 77)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(6, 148, 77)',
          data                : array_data_report
        },
        {
          label               : '1st Dose',
          backgroundColor     : 'rgba(189, 11, 8)',
          borderColor         : 'rgba(189, 11, 8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(189, 11, 8)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(189, 11, 8)',
          data                : online_registration_array_value_sinopharm_1st
        },
        {
          label               : '2nd Dose',
          backgroundColor     : 'rgba(14, 179, 230)',
          borderColor         : 'rgba(14, 179, 230)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(14, 179, 230)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(14, 179, 230)',
          data                : online_registration_array_value_sinopharm_2nd
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: true
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : true,
          }
        }],
        yAxes: [{
          gridLines : {
            display : true,
          }
        }]
      }
    }
    
    var lineChartCanvas = $('#lineChartsinopharm').get(0).getContext('2d')
    var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
    var lineChartData = jQuery.extend(true, {}, BrgyData34)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartData.datasets[2].fill = false;
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

