<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    session_start();
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
    // $vaccine_name = $_POST["vaccine_name"];
    // $report_month_vaccination = $_POST["report_month_vaccination"];
    // $month_name_report = $_POST["month_name_report"];
    // $month_name_report_2 = $_POST["month_name_report_2"];
    $current_date=date("Y-m-d");

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
      "_64502024_SAMPINIT"
    );
      $category = array(
        // "Astrazeneca"
        "Moderna"
    );

    $vaccine_name = array(
      // "01_A1: Health Care Workers",
      "01_A1.8: Outbound OFWS",
      // "01_A1.9: Family Members of Healthcare Workers",
      // "02_A2: Senior Citizens",
      // "03_A3: Adult with Comorbidity",
      // "04_A4: Frontline Personnel in Essential Sector",
      // "05_A5: Poor Population",
      // "06_B1: Teachers and Social Workers",
      // "07_B2: Other Government Workers",
      // "08_B3: Other Essential Workers",
      // "09_B4: Socio-demographic Groups",
      "10_B5: Overseas Filipino Workers"
      // "11_B6: Other Remaing Workforce",
      // "12_C: Rest of the Population"
  );

    
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>...</title>
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

th, td, thead, tr {
  border: 0.5px solid black !important;
  border-collapse: collapse;
  margin:0px !important;
  padding: 5px !important;
}
.asdasdasd{
  page-break-after: always;
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
  <div class="col-1 offset-11 pr-3"> <button class="btn btn-outline-info col-12" id="printPageButton" onclick="Printer()">Print</button></div>
    
      <?php 
      $total_counter = 0;
      foreach($bago_barangay_array as $brgy){ 
        foreach($category as $cat){
          $error = false;
          $SelectR = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE dose_1 = '01_Yes' AND dose_2 != '01_Yes' ORDER BY lastname ASC");
            foreach($SelectR as $value){ $x++; 
              $firstname = $value["firstname"];
              $middlename = $value["middlename"];
              $lastname = $value["lastname"];

              $month_of_vaccination = $value["time_stamp"]; 


              $dose_1 = $value["dose_1"];
              $dose_2 = $value["dose_2"];

              if($value["vaccine_name"] == "Moderna"){
                $dose2date = date('Y-m-d', strtotime($month_of_vaccination. ' + 28 days'));
              }else if($value["vaccine_name"] == "Astrazeneca"){
                $dose2date = date('Y-m-d', strtotime($month_of_vaccination. ' + 3 months'));
              }
              $month_of_vaccination = explode("-",$month_of_vaccination);
              $month_of_vaccination = $month_of_vaccination[1];
             

              if($value["brgy"] == $brgy && $value["vaccine_name"] == $cat && $current_date >= $dose2date){ 
                
                // $SelectD = $systemcore->SelectCustomize("SELECT * FROM vims_report WHERE firstname = '$firstname' AND middlename = '$middlename' AND lastname = '$lastname' ORDER BY lastname ASC");
                // if($SelectD == "none"){
                  $error = true;
                // }
              // if($value["brgy"] == $brgy && $value["employmentcategory"] == $cat){  $error++;    }
            }   
          }
            if($error == true){                          ?>
          <br>
          <div class="col-12 asdasdasd">
            <h2 class="page-header row">
                    <div class="col-sm-12"><center><br>
                      <img src="../../dist/img/<?php echo $_SESSION["system_logo"];?>" style="width: 125px; hight:125px;"></center>
                    </div>
                    <div class="col-sm-12">
                        <center><p style="font-size:18px; margin:none; padding:none;"><b  style="font-size:22px;">Bago City Health Office</b><br>
                        <u style="font-size:20px;">Vaccine Information Management System</u></p></center>
                        <!-- <b style="font-size:22px;">Registered Contact List Information</b><br> -->
                    </div>
                    <div class="col-6 text-center offset-3">
                          <b style="font-size:22px;">List of 1st Dose Vaccinated with No Second Dose</b><br>
                          <b style="font-size:20px; color:rgb(3, 153, 56);"><u><?php echo $brgy; ?></u></b><br>
                          <b style="font-size:18px; color:red;"><u><?php echo $cat; ?></u></b><br>
                    </div>
            </h2>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Full Name</th>
                  <th>Mobile</th>
                  <th>1st Dose</th>
                  <th>2nd Dose</th>
                  <th>Date of Vaccination</th>
                </tr>
              </thead>
              <tbody> 
              <?php
              
                $SelectR = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE dose_1 = '01_Yes' AND dose_2 != '01_Yes' ORDER BY lastname ASC");
                foreach($SelectR as $value){ $x++; 
                  $firstname = $value["firstname"];
                  $middlename = $value["middlename"];
                  $lastname = $value["lastname"]; 

                  $month_of_vaccination = $value["time_stamp"]; 

                  $dose_1 = $value["dose_1"];
                  $dose_2 = $value["dose_2"];

                  if($value["vaccine_name"] == "Moderna"){
                    $dose2date = date('Y-m-d', strtotime($month_of_vaccination. ' + 28 days'));
                  }else if($value["vaccine_name"] == "Astrazeneca"){
                    $dose2date = date('Y-m-d', strtotime($month_of_vaccination. ' + 3 months'));
                  }

                  $month_of_vaccination = explode("-",$month_of_vaccination);
                  $month_of_vaccination = $month_of_vaccination[1];

                  if($value["brgy"] == $brgy && $value["vaccine_name"] == $cat && $current_date >= $dose2date){ 
                    // $SelectD = $systemcore->SelectCustomize("SELECT * FROM vims_report WHERE firstname = '$firstname' AND middlename = '$middlename' AND lastname = '$lastname' ORDER BY lastname ASC");
                    // if($SelectD == "none"){
                      $total_counter++; 
                      // if($value["brgy"] == $brgy && $value["employmentcategory"] == $cat){ $total_counter++;   
                      $bday = $value["bday"];
                      $age = date_diff(date_create($bday), date_create('now'))->y; 
                      $dose_1 = $value["dose_1"];                             if(strlen($dose_1) <= 1){ $dose_1="02_No"; };
                      $dose_2 = $value["dose_2"];                             if(strlen($dose_2) <= 1){ $dose_2="02_No"; };
                      $current_residence = $value["current_residence"];       if(strlen($current_residence) <= 1){ $current_residence="N/A"; };

                      $contact = $value["contact"]; 
                      $contact_length = strlen($contact);
                      if($contact_length > 11 && $contact[0] == "0"){
                        $contact = substr($contact, 1);
                      }
                      if(strlen($contact) <= 1){ $contact="N/A"; };

                        $time_stamp = $value["time_stamp"];                           if(strlen($time_stamp) <= 1 || $time_stamp == "0000-00-00" ){ $time_stamp="N/A"; }; ?>
                      <tr>
                        <td><?php echo $value["lastname"];?> <?php echo $value["firstname"];?> <?php echo $value["middlename"]; ?></td>
                        <td><?php echo $contact;?></td>
                        <td><?php echo $dose_1;?></td>
                        <td><?php echo $dose_2;?></td>
                        <td><?php echo $value["time_stamp"];?></td>
                      </tr><?php
                    // }
                  }
                } 
              }
                ?>
              </tbody>
              <tfoot style="border:none !important;">
                <tr style="border:none !important;">
                  <td style="border:none !important; color:white;"></td>
                <tr style="border:none !important;">
                <tr style="border:none !important;">
                  <td style="border:none !important; color:white;"></td>
                <tr style="border:none !important;">
              </tfoot>
            </table>
          </div> <?php 
        } 
      } ?>
      <!-- /.col -->
    <Br>
    <div class="divFooter col-12"  style="background-image: url('../../dist/img/checkerboard-pattern-green-seamless-background-vector-14423303.jpg'); background-size: 100px 100px;"> 
    <div class="divFooter col-12"> 
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



function Printer(){
  window.print();
}


</script>
</body>
</html>

