<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    session_start();
    // $vaccine_name = "Sinovac";
    // $vaccine_name = "Astrazeneca";
    // $report_month_vaccination = "04";
    // $month_name_report = "April";
    // $dose_1_report = "Y";
    // $dose_2_report = "N";

    $vaccine_name = $_POST["vaccine_name"];
    $report_month_vaccination = $_POST["report_month_vaccination"];
    $month_name_report = $_POST["month_name_report"];
    $dose_1_report = $_POST["dose_1_report"];
    $dose_2_report = $_POST["dose_2_report"];

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
      "JORGE L. ARANETA  MA_AO_CENTRAL", 
      "MAILUM", 
      "MALINGIN", 
      "NAPOLES", 
      "PACOL", 
      "POBLACION", 
      "SAGASA", 
      "TABUNAN", 
      "TALOC", 
      "SAMPINIT",
      "Non-Bago"
    );
    $categoryraw = $_POST["category"];
    $category = explode(",", $categoryraw);
    //   $category1 = array(
    //     "A1",
    //     "A1.8",
    //     "A1.9",
    //     "A2",
    //     "A3",
    //     "A4",
    //     "ROP"
    // );

    // print_r($category);

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
  </style>
  <?php 
    // include '../inc/header.php';//FIX this this is for temporary include!!

  ?>
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">

 
    
      <?php 
      $total_counter = 0;
      foreach($bago_barangay_array as $brgy){ 
        $total = 0;
        foreach($category as $cat){
          $error = false;
          
          $SelectR = $systemcore->SelectCustomize("SELECT * FROM vims_report WHERE 2nd_dose = '$dose_2_report' AND 1st_dose = '$dose_1_report' AND vaccine_name = '$vaccine_name' ORDER BY lastname ASC");
            foreach($SelectR as $value){ $x++; 
              $v_brgy = $value["brgy"];
              $v_brgy = str_replace(' ', '', $v_brgy);
              $v_brgy = preg_replace('/[0-9]+/', '', $v_brgy);
              $v_brgy = preg_replace('/[^\p{L}\p{N}\s]/u', '', $v_brgy);

              $brgy_1 = str_replace(' ', '', $brgy);
              $brgy_1 = preg_replace('/[0-9]+/', '', $brgy_1);
              $brgy_1 = preg_replace('/[^\p{L}\p{N}\s]/u', '', $brgy_1);

              $month_of_vaccination = $value["vaccination_date"]; 
              // $month_of_vaccination = explode("-",$month_of_vaccination);
              // $month_of_vaccination = $month_of_vaccination[1];
              // echo $value["brgy"]." == ".$brgy." && ".$value["category"]." == ".$cat."<br>";
              // if($value["brgy"] == $brgy && $value["employmentcategory"] == $cat && $value["dose_1"] != "01_Yes"){  $error++;    }
              if($v_brgy == $brgy_1 && $value["category"] == $cat && $month_of_vaccination == $report_month_vaccination){  $error = true;    }
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
                          <b style="font-size:22px;">Monthly List of Vaccinated</b><br>
                          <b style="font-size:20px; color:rgb(3, 153, 56);"><u><?php echo $brgy; ?></u></b><br>
                          <b style="font-size:18px; color:red;"><u><?php echo $cat; ?></u></b><br>
                    </div>
                    <div class="col-3 text-left">
                          <p style="font-size:14px;" class="p-0 m-0">Vaccine Name: <b><?php echo $vaccine_name;?></b></p>
                          <p style="font-size:14px;" class="p-0 m-0">Monthly Report of: <b><?php echo $month_name_report;?></b></p>
                          <p style="font-size:14px;" class="p-0 m-0">1st Dose: <b><?php echo $dose_1_report;?></b></p>
                          <p style="font-size:14px;" class="p-0 m-0">2nd Dose: <b><?php echo $dose_2_report;?></b></p>
                    </div>
                  </h2>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Full Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>1st Dose</th>
                        <th>2nd Dose</th>
                        <th>Current Address</th>
                        <th>Mobile</th>
                        <th>Date of Vaccination</th>
                      </tr>
                    </thead>
                    <tbody> 
                    <?php 
                    $systemcore->SelectCustomize("SELECT * FROM vims_report WHERE 2nd_dose = '$dose_2_report' AND 1st_dose = '$dose_1_report' AND vaccine_name = '$vaccine_name' ORDER BY lastname ASC");
                      foreach($SelectR as $value){ $x++; 
                        // if($value["brgy"] == $brgy && $value["employmentcategory"] == $cat && $value["dose_1"] != "01_Yes"){
                          $s_brgy = $value["brgy"];
                          $s_brgy = str_replace(' ', '', $s_brgy);
                          $s_brgy = preg_replace('/[0-9]+/', '', $s_brgy);
                          $s_brgy = preg_replace('/[^\p{L}\p{N}\s]/u', '', $s_brgy);

                          $brgy_2 = str_replace(' ', '', $brgy);
                          $brgy_2 = preg_replace('/[0-9]+/', '', $brgy_2);
                          $brgy_2 = preg_replace('/[^\p{L}\p{N}\s]/u', '', $brgy_2);
                          
                          $month_of_vaccination = $value["vaccination_date"]; 
                          // $month_of_vaccination = explode("-",$month_of_vaccination);
                          // $month_of_vaccination = $month_of_vaccination[1];

                          // echo $s_brgy." == ".$brgy." && ".$value["category"]." == ".$cat."<br>";
                          if($s_brgy == $brgy_2 && $value["category"] == $cat && $month_of_vaccination == $report_month_vaccination){ $total_counter++;   
                            $total++;
                            $bday = $value["bday"];
                            $age = date_diff(date_create($bday), date_create('now'))->y; 
                            $dose_1 = $value["1st_dose"];                             if(strlen($dose_1) <= 0){ $dose_1="N"; };
                            $dose_2 = $value["2nd_dose"];                             if(strlen($dose_2) <= 0){ $dose_2="N"; };
                            $current_residence = $value["brgy"];       if(strlen($current_residence) <= 1){ $current_residence="N/A"; };

                            $contact = $value["contact"]; 
                            $contact_length = strlen($contact);
                            if($contact_length > 11 && $contact[0] == "0"){
                              $contact = substr($contact, 1);
                            }
                            if(strlen($contact) <= 1){ $contact="N/A"; };

                            $time_stamp = $value["vaccination_date"];                           if(strlen($time_stamp) <= 1 || $time_stamp == "0000-00-00" ){ $time_stamp="N/A"; }; ?>
                          <tr>
                            <td><?php echo $value["lastname"];?> <?php echo $value["firstname"];?> <?php echo $value["middlename"]; ?></td>
                            <td><?php echo $age;?></td>
                            <td><?php echo $value["gender"];?></td>
                            <td><?php echo $dose_1;?></td>
                            <td><?php echo $dose_2;?></td>
                            <td><?php echo $current_residence;?></td>
                            <td><?php echo $contact;?></td>
                            <td><?php echo $time_stamp;?></td>
                          </tr><?php
                        }
                      }
                      ?>
                      <tfoot>
                        <th>
                          <th><?php echo $total; ?></th>
                        </th>
                    </tfoot>
                    </tbody>
                    <tfoot style="border:none !important;">
                      <tr style="border:none !important;">
                        <td style="border:none !important; color:white;">...</td>
                      <tr style="border:none !important;">
                      <tr style="border:none !important;">
                        <td style="border:none !important; color:white;">Footer</td>
                      <tr style="border:none !important;">
                    </tfoot>
                  </table>
                </div> <?php 
              }
              if($brgy == "Non-Bago"){ ?>
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
                          <b style="font-size:22px;">Monthly List of Vaccinated</b><br>
                          <b style="font-size:20px; color:rgb(3, 153, 56);"><u><?php echo $brgy; ?></u></b><br>
                          <b style="font-size:18px; color:red;"><u><?php echo $cat; ?></u></b><br>
                    </div>
                    <div class="col-3 text-left">
                          <p style="font-size:14px;" class="p-0 m-0">Vaccine Name: <b><?php echo $vaccine_name;?></b></p>
                          <p style="font-size:14px;" class="p-0 m-0">Monthly Report of: <b><?php echo $month_name_report;?></b></p>
                          <p style="font-size:14px;" class="p-0 m-0">1st Dose: <b><?php echo $dose_1_report;?></b></p>
                          <p style="font-size:14px;" class="p-0 m-0">2nd Dose: <b><?php echo $dose_2_report;?></b></p>
                    </div>
                  </h2>
                  <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Full Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>1st Dose</th>
                        <th>2nd Dose</th>
                        <th>Current Address</th>
                        <th>Mobile</th>
                        <th>Date of Vaccination</th>
                      </tr>
                    </thead>
                    <tbody> 
                    <?php 
                    $systemcore->SelectCustomize("SELECT * FROM vims_report WHERE 2nd_dose = '$dose_1_report' AND 1st_dose = '$dose_2_report' AND vaccine_name = '$vaccine_name' ORDER BY lastname ASC");
                      foreach($SelectR as $value){ $x++; 
                        // if($value["brgy"] == $brgy && $value["employmentcategory"] == $cat && $value["dose_1"] != "01_Yes"){
                          $s_brgy = $value["brgy"];
                          $s_brgy = str_replace(' ', '', $s_brgy);
                          $s_brgy = preg_replace('/[0-9]+/', '', $s_brgy);
                          $s_brgy = preg_replace('/[^\p{L}\p{N}\s]/u', '', $s_brgy);

                          $month_of_vaccination = $value["vaccination_date"]; 
                          $month_of_vaccination = explode("-",$month_of_vaccination);
                          $month_of_vaccination = $month_of_vaccination[1];
                          $non_bago = true;
                          foreach($bago_barangay_array as $Non_brgy){ 
                            $brgy_2 = str_replace(' ', '', $Non_brgy);
                            $brgy_2 = preg_replace('/[0-9]+/', '', $brgy_2);
                            $brgy_2 = preg_replace('/[^\p{L}\p{N}\s]/u', '', $brgy_2);

                            if($s_brgy == $brgy_2){ 
                              $non_bago = false;
                            }
                          }
                          if($non_bago == true && $month_of_vaccination == $report_month_vaccination){
                          // echo $s_brgy." == ".$brgy." && ".$value["category"]." == ".$cat."<br>";
                            if($value["category"] == $cat){ 
                              $total_counter++;   
                              $total++;
                              $bday = $value["bday"];
                              $age = date_diff(date_create($bday), date_create('now'))->y; 
                              $dose_1 = $value["1st_dose"];                             if(strlen($dose_1) <= 0){ $dose_1="N"; };
                              $dose_2 = $value["2nd_dose"];                             if(strlen($dose_2) <= 0){ $dose_2="N"; };
                              $current_residence = $value["brgy"];       if(strlen($current_residence) <= 1){ $current_residence="N/A"; };

                              $contact = $value["contact"]; 
                              $contact_length = strlen($contact);
                              if($contact_length > 11 && $contact[0] == "0"){
                                $contact = substr($contact, 1);
                              }
                              if(strlen($contact) <= 1){ $contact="N/A"; };

                              $time_stamp = $value["vaccination_date"];                           if(strlen($time_stamp) <= 1 || $time_stamp == "0000-00-00" ){ $time_stamp="N/A"; }; ?>
                            <tr>
                              <td><?php echo $value["lastname"];?> <?php echo $value["firstname"];?> <?php echo $value["middlename"]; ?></td>
                              <td><?php echo $age;?></td>
                              <td><?php echo $value["gender"];?></td>
                              <td><?php echo $dose_1;?></td>
                              <td><?php echo $dose_2;?></td>
                              <td><?php echo $current_residence;?></td>
                              <td><?php echo $contact;?></td>
                              <td><?php echo $time_stamp;?></td>
                            </tr><?php
                          }
                        }
                      }
                      ?>
                      <tfoot>
                        <th>
                          <th><?php echo $total; ?></th>
                        </th>
                    </tfoot>
                    </tbody>
                    <tfoot style="border:none !important;">
                      <tr style="border:none !important;">
                        <td style="border:none !important; color:white;">...</td>
                      <tr style="border:none !important;">
                      <tr style="border:none !important;">
                        <td style="border:none !important; color:white;">Footer</td>
                      <tr style="border:none !important;">
                    </tfoot>
                  </table>
                </div> <?php 
              }
            } 
          } ?>
      <!-- /.col -->
    <Br>
    <!-- <h6>Total: <?php echo $total_counter; ?> </h6> -->
    <div class="divFooter col-12"  style="background-image: url('../../dist/img/checkerboard-pattern-green-seamless-background-vector-14423303.jpg'); background-size: 100px 100px;"> 
    <!-- <div class="divFooter col-12">  -->
        <center><p>Bago City College | B.S. in Information System <br> © 2020 James Bryan Flandez. All Rights Reserved.</p></center>
    </div>
    <!-- /.row -->

    <div class="col-12 asdasdasd">
            <h2 class="page-header row">
              <div class="col-sm-12"><center><br>
                <img src="../../dist/img/<?php echo $_SESSION["system_logo"];?>" style="width: 125px; hight:125px;"></center>
              </div>
              <div class="col-sm-12" >
                  <center><p style="font-size:18px; margin:none; padding:none;"><b  style="font-size:22px;">Bago City Health Office</b><br>
                  <u style="font-size:20px;">Vaccine Information Management System</u></p>
                  <!-- <b style="font-size:22px;">Registered Contact List Information</b><br> -->
                  <b style="font-size:22px;">Monthly Vaccinated Report</b><br>
                  <b style="font-size:20px;"><u>Report Information and Details</u></b><br></center><br>

                  <br><br>
                  <div class="callout callout-info row col-12"  style="border: 1px solid black;"> 
                      <h5><i class="fas fa-info col-3"></i><b>Note:</b></h5>
                      <div class="col-9">
                        <h6 class="col-12">This report is auto generated by the system and it is based on what the encoders are entering and providing in this system.</h6>
                        <h6 class="col-12">There are some data imported into the systems database, these may cause error or none compatible with the system database.</h6>
                        <h6 class="col-12"><b>Imported File Type:</b>Excel</h6>
                      </div>
                  </div>

            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                  <i class="fas fa-cog"></i> Details
                    <!-- <small class="float-right">Date: 2/10/2014</small> -->
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                  <h5><b>List Of Barangay</b></h5>
                  <address><h6><?php
                    foreach($bago_barangay_array as $brgy){ 
                        echo $brgy."<br>";
                    } ?></h6>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                <h5><b>List Of Category</b></h5>
                  <address><h6>
                  <?php
                    foreach($category as $cat){ 
                        echo $cat."<br>";
                    } ?></h6>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-6 invoice-col row">
  
                    <div class="col-6">
                      <h6 class="p-1" style="background-color: rgb(241, 255, 102)"><b>Vaccine Name:</b></h6>
                    </div>
                    <div class="col-6">
                      <h6 class="p-1" style="background-color: rgb(241, 255, 102)"><u><?php echo $vaccine_name; ?></u></h6>
                    </div>

                    <div class="col-6">
                      <h6 class="p-1" style="background-color: rgb(241, 255, 102)"><b>Report Name:</b></h6>
                    </div>
                    <div class="col-6">
                      <h6 class="p-1" style="background-color: rgb(241, 255, 102)"><u>Monthly List of Vaccinated</u></h6>
                    </div>

                    <div class="col-6">
                      <h6 class="p-1" style="background-color: rgb(241, 255, 102)"><b>Monthly Report of:</b></h6>
                    </div>
                    <div class="col-6">
                      <h6 class="p-1" style="background-color: rgb(241, 255, 102)"><u><?php echo $month_name_report; ?></u></h6>
                    </div>

                    <div class="col-6">
                      <h6 class="p-1" style="background-color: rgb(241, 255, 102)"><b>1st Dose:</b></h6>
                    </div>
                    <div class="col-6">
                      <h6 class="p-1" style="background-color: rgb(241, 255, 102)"><u><?php echo $dose_1_report; ?></u></h6>
                    </div>

                    <div class="col-6">
                      <h6 class="p-1" style="background-color: rgb(241, 255, 102)"><b>2nd Dose:</b></h6>
                    </div>
                    <div class="col-6">
                      <h6 class="p-1" style="background-color: rgb(241, 255, 102)"><u><?php echo $dose_2_report; ?></u></h6>
                    </div>

                    <div class="col-6">
                      <h6 class="p-1" style="background-color: rgb(241, 255, 102)"><b>Report Generated Date :</b></h6>
                    </div>
                    <div class="col-6">
                      <h6 class="p-1" style="background-color: rgb(241, 255, 102)"><u><?php echo date("Y-M-d") ?></u></h6>
                    </div>

                    <div class="col-6">
                      <h6><b>Date of System Creation :</b></h6>
                    </div>
                    <div class="col-6">
                      <h6><u>2021-04-23</u></h6>
                    </div>

                    <div class="col-6">
                      <h6><b>Date of System Usage(Import Data from Excel):</b></h6>
                    </div>
                    <div class="col-6">
                      <h6><u>May 26 2021</u></h6>
                    </div>

                    <div class="col-6">
                      <h6><b>Date of Using the Profiling:</b></h6>
                    </div>
                    <div class="col-6">
                      <h6><u>May 26 2021</u></h6>
                    </div>

                    <div class="col-6">
                      <h6><b>Date of Using the Online Registration </b></h6>
                    </div>
                    <div class="col-6">
                      <h6><u>June 01 2021</u></h6>
                    </div>

                    <div class="col-6">
                      <h6><b>Date of Using the Vaccination and Postmonitoring:</b></h6>
                    </div>
                    <div class="col-6">
                      <h6><u>June 14 2021</u></h6>
                    </div>

                      
                    <div class="col-6">
                      <h6 class="p-1" style="background-color: rgb(241, 255, 102)"><b>Total Vaccinated:</b></h6>
                    </div>
                    <div class="col-6">
                      <h6 class="p-1" style="background-color: rgb(241, 255, 102)"><u><?php echo $total_counter; ?></u></h6>
                    </div>
                 
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              </div>
            </h2>
          </div>
    <!-- title row -->

  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<?php
   include '../inc/footer.php';//fix this, this is for temporary include!!
?>
<script type="text/javascript"> 

 window.addEventListener("load", window.print());
</script>
</body>
</html>

