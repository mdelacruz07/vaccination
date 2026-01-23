<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    session_start();
    date_default_timezone_set('Asia/Manila');

    // include '../registrants/vims_settings.php'; 
    // $VIMS_settings = new VIMS_settings();

    $Global_vaccine_name = array(
      // "Pfizer", 
      "Astrazeneca", 
      "Sinovac",
      "Johnson & Johnson",
      "Moderna"
    );
    $Global_new_category_array = array(
      "A1",
      "A1.8",
      "A1.9",
      "A2",
      "A3",
      "A4"
      // "A5",
      // "B1",
      // "B2",
      // "B3",
      // "B4",
      // "B5",
      // "B6",
      // "C"
  );

    $DosesNumber = array("1ST DOSE","2ND DOSE");
    // echo count($Global_vaccine_name);

    $Ncat = count($Global_new_category_array);
    $Nvac = count($Global_vaccine_name);
    $Ndose = count($DosesNumber);
    $dates = array();

    $SelectVaccineReport = $systemcore->SelectTable("vims_report");
    if($SelectVaccineReport != "none"){
      foreach($SelectVaccineReport as $value){
        $vaccination_date = $value["vaccination_date"];
        array_push($dates, $vaccination_date);
      }
    }
    $dates = array_unique($dates);
    sort($dates);
    
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Vaccination Matrix</title>
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
        text-align:center;
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

  
    @media print{
      body{
        background-color:#999;
      }
    }
  </style>
  <?php 
    // include '../inc/header.php';//FIX this this is for temporary include!!

  ?>
</head>
<body>
  <!-- Main content -->
    <!-- title row -->
     
  
<div class="col-sm-12">
  <table class="table table-bordered">
    <thead> 
      <tr>
        <th style='background-color:rgb(202, 239, 250)' rowspan="4"><h4><b>DATES</b></h4></th>
        <th colspan="<?php echo (($Ncat * $Ndose) * $Nvac) + ( 2*$Nvac); ?>" style='background-color:rgb(13, 120, 166); color:white;'><h4><b>COVID-19 VACCINATION MATRIX</b></h4></th>
        <th style='background-color:rgb(202, 239, 250)' rowspan="4"><h4><b>TOTAL</b></h4></th>
      </tr>
      <tr><?php  
        foreach($Global_vaccine_name as $vaccine){  ?>
          <th colspan="<?php echo $Ncat + $Ncat + 2; ?>" style='background-color:rgb(126, 157, 168); color:white;'><h5><b><?php echo strtoupper($vaccine); ?></b></h5></th><?php 
        } ?>
      </tr>
      <tr> <?php  
        foreach($Global_vaccine_name as $vaccine){  ?>
          <th style='background-color:rgb(0, 61, 117); color:white;' colspan="<?php echo $Ncat+1; ?>"><?php echo $DosesNumber[0]; ?></th>
          <th style='background-color:rgb(0, 61, 117); color:white;' colspan="<?php echo $Ncat+1; ?>"><?php echo $DosesNumber[1]; ?></th><?php
        } ?>
      </tr>
      <tr><?php  
        foreach($Global_vaccine_name as $vaccine){ 
          foreach($Global_new_category_array as $category){  ?>
            <th style='background-color:rgb(6, 122, 145); color:white;'><?php echo $category; ?></th> <?php 
          } ?>
          <th style='background-color:rgb(166, 194, 247)'>TOTAL</th> <?php
          foreach($Global_new_category_array as $category){  ?>
            <th style='background-color:rgb(6, 122, 145); color:white;'><?php echo $category; ?></th> <?php 
          } ?>
          <th style='background-color:rgb(166, 194, 247)'>TOTAL</th> <?php
        } ?>
      </tr>
    </thead>
    <tbody><?php  
      $dose_1 = "N";
      $dose_2 = "N";
      foreach($dates as $date){  ?>
        <tr>
          <td style='background-color:rgb(202, 239, 250)'><?php echo $date; ?></td><?php  
            $total_2 = "";
            foreach($Global_vaccine_name as $vaccine){
              foreach($DosesNumber as $dose){
                if($dose == "1ST DOSE"){
                  $dose_1 = "Y";
                  $dose_2 = "N";
                }else{
                  $dose_1 = "N";
                  $dose_2 = "Y";
                }
                $total_1 = "";
                foreach($Global_new_category_array as $cat){ 

                  $data="";
                  $SelectReport = $systemcore->SelectTable("vims_report WHERE vaccination_date = '$date' AND vaccine_name = '$vaccine' AND category = '$cat' AND 1st_dose = '$dose_1' AND 2nd_dose = '$dose_2'");
                  if($SelectReport != "none"){
                    foreach($SelectReport as $value){
                      $data++;
                      $total_1++;
                      $total_2++;
                    }
                  }else{
                    $data="";
                  }?>
                  <td><?php echo $data; ?></td> <?php
                }
                echo "<td style='background-color:rgb(166, 194, 247)'>".$total_1."</td>";
              }
            } ?>



            <td style='background-color:rgb(202, 239, 250)'><b><?php echo $total_2; ?></b></td>
        </tr>
        <?php
      } ?>
        <tr>
          <td style='background-color:rgb(202, 239, 250)'><b>TOTAL</b></td><?php  
            $total_2 = "";
            foreach($Global_vaccine_name as $vaccine){
              foreach($DosesNumber as $dose){
                if($dose == "1ST DOSE"){
                  $dose_1 = "Y";
                  $dose_2 = "N";
                }else{
                  $dose_1 = "N";
                  $dose_2 = "Y";
                }
                $total_1 = "";
                foreach($Global_new_category_array as $cat){ 

                  $data="";
                  $SelectReport = $systemcore->SelectTable("vims_report WHERE vaccine_name = '$vaccine' AND category = '$cat' AND 1st_dose = '$dose_1' AND 2nd_dose = '$dose_2'");
                  if($SelectReport != "none"){
                    foreach($SelectReport as $value){
                      $data++;
                      $total_1++;
                      $total_2++;
                    }
                  }else{
                    $data="";
                  }?>
                  <td style='background-color:rgb(202, 239, 250)'><b><?php echo $data; ?></b></td> <?php
                }
                echo "<td style='background-color:rgb(202, 239, 250)'><b>".$total_1."</b></td>";
              }
            } ?>
            <td style='background-color:rgb(202, 239, 250)'><b><?php echo $total_2; ?></b></td>
        </tr>
<!-- paste prediction here!!! -->

</div>
<br><Br><Br><Br>
<script>

function Printer(){
  window.print();
}




</script>
</body>
</html>

