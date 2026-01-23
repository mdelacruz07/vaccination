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
    $category_array = array();
    $category_array_value = array();

    $non_bago_barangay_array = array();
    $non_bago_barangay_array_value = array();

    $online_registration_array = array();
    $online_registration_array_time = array();

    $current_date = date("Y-m-d"); 
    $starting_date = date("2021-05-29");  
    $start_date = strtotime($starting_date); 
    $end_date = strtotime($current_date); 
    $total_days = ($end_date - $start_date)/60/60/24; 
    $inc_starting_date = date("2021-05-29");   
    for ($x = 0; $x < $total_days; $x++) {
      $inc_starting_date = date('Y-m-d', strtotime($inc_starting_date. ' + 1 days'));
      array_push($online_registration_array_time,$inc_starting_date);
    }

    foreach($online_registration_array_time as $date){
      array_push($online_registration_array, 0);
    }

    // print_r($online_registration_array_time);

    $bago_barangay_array = array(
        "_64502001_ABUANAN", 
        "_64502002_ALIANZA", 
        "_64502003_ATIPULUAN", 
        "_64502004_BACONG_MONTILLA", 
        "_64502005_BAGROY", 
        "_64502006_BALINGASAG", 
        "_64502007_BINUBUHAN", 
        "_64502008_BUSAY", 
        "_64502009_CALUMANGAN", 
        "_64502010_CARIDAD", 
        "_64502011_DULAO", 
        "_64502012_ILIJAN", 
        "_64502013_LAG_ASAN", 
        "_64502014_MA_AO_BARRIO", 
        "_64502015_JORGE_L._ARANETA_(MA_AO_CENTRAL)", 
        "_64502016_MAILUM", 
        "_64502017_MALINGIN", 
        "_64502018_NAPOLES", 
        "_64502019_PACOL", 
        "_64502020_POBLACION", 
        "_64502021_SAGASA", 
        "_64502022_TABUNAN", 
        "_64502023_TALOC", 
        "_64502024_SAMPINIT");
        
    $bago_barangay_array_value = array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);
    $with_comorbidity_array = array(0,0);
    $allergy_to_vaccine_tools_array = array(0,0);
    $gender_array = array(0,0);
    $consent_array = array(0,0);
 
    $SelectValue = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration");
    foreach($SelectValue as $data){

      $allergy_to_vaccine = $data["allergy_to_vaccine"];
      $profile_comorbidity = $data["profile_comorbidity"];

      $Category = $data["employmentcategory"];
      array_push($category_array, $Category);
      $brgy = $data["brgy"];
      $brgy = str_replace(' ', '', $brgy);
      $gender = $data["gender"];
      $consent = $data["consent"];

      $error = false;
      $x = 0;
      foreach($bago_barangay_array as $bago_brgy){
        if($brgy == $bago_brgy){
            $error = true;
            $bago_barangay_array_value[$x]++;
        }
        $x++;
      }
      if($error == false){
        array_push($non_bago_barangay_array, $brgy);
      }

      if($allergy_to_vaccine == "01_Yes"){
        $allergy_to_vaccine_tools_array[0]++;
      }else{
        $allergy_to_vaccine_tools_array[1]++;
      }

      if($profile_comorbidity == "01_Yes"){
        $with_comorbidity_array[0]++;
      }else{
        $with_comorbidity_array[1]++;
      }

      if($gender == "01_Female"){
        $gender_array[0]++;
      }else{
        $gender_array[1]++;
      }

      if($consent == "01_Yes"){
        $consent_array[0]++;
      }else if($consent == "02_No"){
        $consent_array[1]++;
      }

      if($data["encoded"] == "Online Registration"){
        $x = 0;
        foreach($online_registration_array as $dataa){
          $date_added = $data["date_added"];
          $date_added = date('Y-m-d', strtotime($date_added));
          $date_B = $online_registration_array_time[$x];

          if($date_added == $date_B){
          $online_registration_array[$x]++;
          }
          $x++;
        }

      }
    }

    $category_array = array_values(array_unique($category_array));
    $non_bago_barangay_array = array_values(array_unique($non_bago_barangay_array));


    for($x = 0; $x < count($category_array); $x++){
      array_push($category_array_value, 0);
    }
    for($x = 0; $x < count($non_bago_barangay_array); $x++){
      array_push($non_bago_barangay_array_value, 0);
    }

    foreach($SelectValue as $data){
      for($x = 0; $x < count($category_array); $x++){
        if($category_array[$x] == $data["employmentcategory"]){
          $category_array_value[$x]++;
        }
      }
      for($x = 0; $x < count($non_bago_barangay_array); $x++){
        if($non_bago_barangay_array[$x] == $data["brgy"]){
          $non_bago_barangay_array_value[$x]++;
        }
      }
    }

    
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
     
  
          <div class="col-sm-12">
              <h2 class="page-header row">
                <div class="col-1 offset-11 pr-3"> <button class="btn btn-outline-info col-12" id="printPageButton" onclick="Printer()">Print</button></div>
                <div class="col-sm-12"><center><br>
                  <img src="../../dist/img/<?php echo $_SESSION["system_logo"];?>" style="width: 125px; hight:125px;"></center>
                </div>
                <div class="col-sm-12" >
                    <center><p style="font-size:18px; margin:none; padding:none;"><b  style="font-size:22px;">Bago City Health Office</b><br>
                    Vaccine Information Management System</p>
                    <b style="font-size:22px;">Online Registration And Profiling Report</b><br>
                    <b style="font-size:20px;"><?php echo date("F d Y"); ?></b><br></center>
                </div>
            </h2>
            <center><b style="font-size:20px;">Registered by Category</b><br></center>
            <canvas id="category" style="min-height: 350px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
              <table class="table table-bordered">
                  <thead>  
                      <tr>
                        <th>Name</th>
                        <th>Profiled</th>
                      </tr>
                  </thead>
                  <tbody><?php
                    $total = 0;
                    for($x = 0; $x < count($category_array); $x++){ ?>
                    <tr>
                      <td><?php echo $category_array[$x]; ?></td>
                      <td><?php echo $category_array_value[$x]; $total = $total + $category_array_value[$x];?></td>
                    </tr>
                    <?php } ?>
                    <tr class="colored_row">
                      <td><B>Total:</b></td>
                      <td><b><?php echo $total; ?></b></td>
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
                  <b style="font-size:22px;">Online Registration And Profiling Report</b><br>
                  <b style="font-size:20px;"><?php echo date("F d Y"); ?></b><br></center>
              </div>
          </h2>
            <center><b style="font-size:20px;">Online Registration</b><br></center>
            <canvas id="lineChart" style="min-height: 350px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
                <table class="table table-bordered">
                  <thead>  
                      <tr>
                        <th>Date</th>
                        <th>Numbers</th>
                      </tr>
                  </thead>
                  <tbody><?php
                    $total = 0;
                    for($x = 0; $x < count($online_registration_array_time); $x++){ ?>
                    <tr>
                      <td><?php echo $online_registration_array_time[$x]; ?></td>
                      <td><?php echo $online_registration_array[$x]; $total = $total + $online_registration_array[$x];?></td>
                    </tr>
                    <?php } ?>
                    <tr class="colored_row">
                      <td><B>Total:</b></td>
                      <td><b><?php echo $total; ?></b></td>
                    </tr>
                  </tbody>
                  <tfoot style="background-color:white; color:white; border:none;">  
                      <tr style="background-color:white; color:white; border:none;">
                        <th style="background-color:white; color:white; border:none;">Date</th>
                        <th style="background-color:white; color:white; border:none;">Numbers</th>
                      </tr>
                      <tr style="background-color:white; color:white; border:none;">
                        <th style="background-color:white; color:white; border:none;">Date</th>
                        <th style="background-color:white; color:white; border:none;">Numbers</th>
                      </tr>
                      <tr style="background-color:white; color:white; border:none;">
                        <th style="background-color:white; color:white; border:none;">Date</th>
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
                  <b style="font-size:22px;">Online Registration And Profiling Report</b><br>
                  <b style="font-size:20px;"><?php echo date("F d Y"); ?></b><br></center>
              </div>
          </h2>
            <center><b style="font-size:20px;">Registered by Barangay</b><br></center>
            <canvas id="bago_brgy" style="min-height: 350px; height: 450px; max-height: 450px; max-width: 100%;"></canvas>
                <table class="table table-bordered">
                  <thead>  
                      <tr>
                        <th>Name</th>
                        <th>Profiled</th>
                      </tr>
                  </thead>
                  <tbody><?php
                    $total = 0;
                    for($x = 0; $x < count($bago_barangay_array); $x++){ ?>
                    <tr>
                      <td><?php echo $bago_barangay_array[$x]; ?></td>
                      <td><?php echo $bago_barangay_array_value[$x]; $total = $total + $bago_barangay_array_value[$x];?></td>
                    </tr>
                    <?php } ?>
                    <tr class="colored_row">
                      <td><B>Total:</b></td>
                      <td><b><?php echo $total; ?></b></td>
                    </tr>
                  </tbody>
                  <tfoot style="background-color:white; color:white; border:none;">  
                      <tr style="background-color:white; color:white; border:none;">
                        <th style="background-color:white; color:white; border:none;">Date</th>
                        <th style="background-color:white; color:white; border:none;">Numbers</th>
                      </tr>
                      <tr style="background-color:white; color:white; border:none;">
                        <th style="background-color:white; color:white; border:none;">Date</th>
                        <th style="background-color:white; color:white; border:none;">Numbers</th>
                      </tr>
                      <tr style="background-color:white; color:white; border:none;">
                        <th style="background-color:white; color:white; border:none;">Date</th>
                        <th style="background-color:white; color:white; border:none;">Numbers</th>
                      </tr>
                  </tfoot>
              </table>
          </div>
      </div>

      <div class="card-body row mt-5 pt-5">
          <div class="col-4 offset-2">
          
            <center><b style="font-size:20px;">Registered by Comorbidity</b><br><br></center>
            <canvas id="comorbidity" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              <table class="table table-bordered">
                  <thead>  
                      <tr> 
                        <th>YES</th>
                        <th>NONE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr><?php 
                        foreach($with_comorbidity_array as $value){ 
                          echo "<th>".$value."</th>";
                        } ?>
                    </tr>
                  </tbody>
                </table>
          </div>
          <div class="col-4">
            <center><b style="font-size:20px;">Allergy to Vaccines/Components of Vaccines</b><br></center>
            <canvas id="allergy" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              <table class="table table-bordered">
                  <thead>  
                      <tr> 
                        <th>YES</th>
                        <th>NONE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr><?php 
                        foreach($allergy_to_vaccine_tools_array as $value){ 
                          echo "<th>".$value."</th>";
                        } ?>
                    </tr>
                  </tbody>
                </table>
          </div>
          <div class="col-4  offset-2">
            <center><b style="font-size:20px;">Registered by Gender</b><br></center>
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
          <div class="col-4">
            <center><b style="font-size:20px;">Registered by Consent</b><br></center>
            <canvas id="consent" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              <table class="table table-bordered">
                  <thead>  
                      <tr> 
                        <th>Yes</th>
                        <th>No</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr><?php 
                        foreach($consent_array as $value){ 
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

        $with_comorbidity_array = implode(", ", $with_comorbidity_array);
        $allergy_to_vaccine_tools_array = implode(", ", $allergy_to_vaccine_tools_array);
        $gender_array = implode(", ", $gender_array);
        $consent_array = implode(", ", $consent_array);

        $category_array_1st_dose = implode(", ", $category_array_1st_dose);
        $bago_brgy_array_1st_dose = implode(", ", $bago_brgy_array_1st_dose);

        $online_registration_array_time = implode(", ", $online_registration_array_time);
        $online_registration_array = implode(", ", $online_registration_array);
      ?>
      <input type="text" id="category_array" value="<?php echo $category_array;?>">
      <input type="text" id="category_array_value" value="<?php echo $category_array_value;?>">
      <input type="text" id="non_bago_barangay_array" value="<?php echo $non_bago_barangay_array;?>">
      <input type="text" id="non_bago_barangay_array_value" value="<?php echo $non_bago_barangay_array_value;?>">
      <input type="text" id="bago_barangay_array" value="<?php echo $bago_barangay_array;?>">
      <input type="text" id="bago_barangay_array_value" value="<?php echo $bago_barangay_array_value;?>">
      <input type="text" id="with_comorbidity_array" value="<?php echo $with_comorbidity_array;?>">
      <input type="text" id="allergy_to_vaccine_tools_array" value="<?php echo $allergy_to_vaccine_tools_array;?>">
      <input type="text" id="gender_array" value="<?php echo $gender_array;?>">
      <input type="text" id="consent_array" value="<?php echo $consent_array;?>">
      <input type="text" id="category_array_1st_dose" value="<?php echo $category_array_1st_dose;?>">
      <input type="text" id="bago_brgy_array_1st_dose" value="<?php echo $bago_brgy_array_1st_dose;?>">

      <input type="text" id="online_registration_array_time" value="<?php echo $online_registration_array_time ?>" >
      <input type="text" id="online_registration_array" value="<?php echo $online_registration_array ?>" >
    </div>
    
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

    array_daily_report = array_daily_report.split(",");

    array_data_report = array_data_report.split(",");
    array_data_report = array_data_report.map(Number);

    var areaChartData = {
      labels  : array_daily_report,
      datasets: [
        {
          label               : 'Profiled',
          backgroundColor     : 'rgba(173, 49, 35)',
          borderColor         : 'rgba(173, 49, 35)',
          pointRadius          : false,
          pointColor          : '#ad3123',
          pointStrokeColor    : 'rgba(173, 49, 35)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(173, 49, 35)',
          data                : array_data_report
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

    array_daily_report = array_daily_report.split(",");

    array_data_report = array_data_report.split(",");
    array_data_report = array_data_report.map(Number);

    var areaChartData = {
      labels  : array_daily_report,
      datasets: [
        {
          label               : 'Profiled',
          backgroundColor     : 'rgba(173, 49, 35)',
          borderColor         : 'rgba(173, 49, 35)',
          pointRadius          : false,
          pointColor          : '#ad3123',
          pointStrokeColor    : 'rgba(173, 49, 35)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(173, 49, 35)',
          data                : array_data_report
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
  // comorbidity
   var array_data_report = document.getElementById("with_comorbidity_array").value;
    array_data_report = array_data_report.split(",");
    array_data_report = array_data_report.map(Number);
      var donutChartCanvas = $('#comorbidity').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'YES', 
          'NONE',
      ],
      datasets: [
        {
          data: array_data_report,
          backgroundColor : ['#35ccc2', '#5d635b'],
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
  // 
 // allergy
   var array_data_report = document.getElementById("allergy_to_vaccine_tools_array").value;
    array_data_report = array_data_report.split(",");
    array_data_report = array_data_report.map(Number);
      var donutChartCanvas = $('#allergy').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'YES', 
          'NONE',
      ],
      datasets: [
        {
          data: array_data_report,
          backgroundColor : ['#23b007', '#d4662f'],
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

      // consent
   var array_data_report = document.getElementById("consent_array").value;
    array_data_report = array_data_report.split(",");
    array_data_report = array_data_report.map(Number);
      var donutChartCanvas = $('#consent').get(0).getContext('2d')
    var donutData        = {
      labels: [
          'YES', 
          'NO',
      ],
      datasets: [
        {
          data: array_data_report,
          backgroundColor : ['#23b007', '#cc4435'],
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






function Printer(){
  window.print();
}




</script>
</body>
</html>

