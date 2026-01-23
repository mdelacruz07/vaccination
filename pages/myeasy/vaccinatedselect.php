<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    session_start();
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
      "LAG ASAN", 
      "MA AO BARRIO", 
      "JORGE L  ARANETA  MA AO CENTRAL ", 
      "MAILUM", 
      "MALINGIN", 
      "NAPOLES", 
      "PACOL", 
      "POBLACION", 
      "SAGASA", 
      "TABUNAN", 
      "TALOC", 
      "SAMPINIT"
    );
    $doc_title = "LIST OF VACCINATED (AstraZeneca)";
    $doc_vac_date = "July 24 2021";

    
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
        $total_counter_per_brgy = 0;
        $error = false;
        $SelectR = $systemcore->SelectCustomize("SELECT * FROM vims_report WHERE vaccination_date = '2021-07-24' AND vaccine_name = 'Astrazeneca' ORDER BY lastname ASC");
          foreach($SelectR as $value){ $x++; 
            $firstname = $value["firstname"];
            $middlename = $value["middlename"];
            $lastname = $value["lastname"];

            $month_of_vaccination = $value["vaccination_date"]; 
            $month_of_vaccination = explode("-",$month_of_vaccination);
            $month_of_vaccination = $month_of_vaccination[1];

            if(preg_replace('/[^A-Za-z0-9]/', "", $value["brgy"]) == preg_replace('/[^A-Za-z0-9]/', "", $brgy)){ 

              
              
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
                  <b style="font-size:22px;"><?php echo $doc_title; ?></b><br>
                  <b style="font-size:20px; color:rgb(3, 153, 56);"><u><?php echo $brgy; ?></u></b><br>
                  <b style="font-size:18px; color:red;"><u><?php echo $doc_vac_date; ?></u></b><br>
            </div>
          </h2>
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Full Name</th>
                <th>Mobile</th>
                <th>Birthday</th>
                <th>1st Dose</th>
                <th>2nd Dose</th>
                <th>Vaccine</th> 
              </tr>
            </thead>
            <tbody> 
            <?php
              $SelectR = $systemcore->SelectCustomize("SELECT * FROM vims_report WHERE vaccination_date = '2021-07-24' AND vaccine_name = 'Astrazeneca' ORDER BY lastname ASC");
              // $SelectR = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE MONTH(date_added) != '5' OR ocupation = 'seaman' OR ocupation = 'seafarer' ORDER BY lastname ASC");
              foreach($SelectR as $value){ $x++; 
                $firstname = $value["firstname"];
                $middlename = $value["middlename"];
                $lastname = $value["lastname"]; 

                $month_of_vaccination = $value["vaccination_date"]; 
                $month_of_vaccination = explode("-",$month_of_vaccination);
                $month_of_vaccination = $month_of_vaccination[1];
                $dose_1 = $value["1st_dose"];
                $dose_2 = $value["2nd_dose"];

                if(preg_replace('/[^A-Za-z0-9]/', "", $value["brgy"]) == preg_replace('/[^A-Za-z0-9]/', "", $brgy)){ 
                  // $SelectD = $systemcore->SelectCustomize("SELECT * FROM vims_report WHERE firstname = '$firstname' AND middlename = '$middlename' AND lastname = '$lastname' ORDER BY lastname ASC");
                  // if($SelectD == "none"){
                    $total_counter++; 
                    $total_counter_per_brgy++;
                    // if($value["brgy"] == $brgy && $value["employmentcategory"] == $cat){ $total_counter++;   
                    $bday = $value["bday"];
                    $age = date_diff(date_create($bday), date_create('now'))->y; 
                    $dose_1 = $value["1st_dose"];                         
                    $dose_2 = $value["2nd_dose"];                 

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
                      <td><?php echo $value["bday"];?></td>
                      <td><?php echo $dose_1;?></td>
                      <td><?php echo $dose_2;?></td>
                      <td><?php echo $value["vaccine_name"];?></td>
                    </tr><?php 
                  // }
                }
              } 
            }
              ?>
              <tr >
                <td colspan="6" class="text-right"><i>Total: <b><?php echo $total_counter_per_brgy; ?></b></i></td>
              <tr>
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
      } ?>
      <!-- /.col -->
    <Br>
    <div class="divFooter col-12"  style="background-image: url('../../dist/img/checkerboard-pattern-green-seamless-background-vector-14423303.jpg'); background-size: 100px 100px;"> 
      <!-- <div class="divFooter col-12">  -->
          <center><p>Bago City College | B.S. in Information System <br> © 2020 James Bryan Flandez. All Rights Reserved.</p></center>
    </div>
    
    <!-- /.row -->
  </section>
  <?php //echo $total_counter; ?>
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

