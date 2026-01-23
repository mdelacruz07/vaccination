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
        // "01_A1: Health Care Workers",
        "02_A2: Senior Citizens",
        // "03_A3: Adult with Comorbidity",
        // "04_A4: Frontline Personnel in Essential Sector",
        // "05_A5: Poor Population",
        // "06_B1: Teachers and Social Workers",
        // "07_B2: Other Government Workers",
        // "08_B3: Other Essential Workers",
        // "09_B4: Socio-demographic Groups",
        // "10_B5: Overseas Filipino Workers",
        // "11_B6: Other Remaing Workforce",
        // "12_C: Rest of the Population"
    );

    
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
.asdasdasd{
  page-break-before: always;
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
    
      <?php 
      foreach($bago_barangay_array as $brgy){ 
        foreach($category as $cat){
          $error = 0;
          $SelectR = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration");
            foreach($SelectR as $value){ $x++; 
              if($value["brgy"] == $brgy && $value["employmentcategory"] == $cat && $value["dose_1"] != "01_Yes"){  $error++;    }
            }   
            if($error > 1){                          ?>
          <br>
          <div class="col-12 asdasdasd">
            <h2 class="page-header row">
              <div class="col-sm-12"><center><br>
                <img src="../../dist/img/<?php echo $_SESSION["system_logo"];?>" style="width: 125px; hight:125px;"></center>
              </div>
              <div class="col-sm-12" >
                  <center><p style="font-size:18px; margin:none; padding:none;"><b  style="font-size:22px;">Bago City Health Office</b><br>
                  Vaccine Information Management System</p>
                  <b style="font-size:22px;">Registered Contact List Information</b><br>
                  <b style="font-size:20px;"><?php echo $brgy; ?></b><br>
                  <b style="font-size:14px;"><?php echo $cat; ?></b><br></center>
              </div>
            </h2>
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Full Name</th>
                  <th>Contact Number</th>
                  <th>Date Added</th>
                </tr>
              </thead>
              <tbody> 
              <?php
                $SelectR = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration ORDER BY date_added ASC");
                foreach($SelectR as $value){ $x++; 
                  if($value["brgy"] == $brgy && $value["employmentcategory"] == $cat && $value["dose_1"] != "01_Yes"){ ?>
                  <tr>
                    <td><?php echo $value["lastname"];?> <?php echo $value["firstname"];?> <?php echo $value["middlename"]; ?></td>
                    <td><?php echo $value["contact"];?></td>
                    <td><?php echo $value["date_added"];?></td>
                  </tr><?php
                  }
                } 
                ?>
              </tbody>
            </table>
          </div> <?php 
            }
        } 
      } ?>
      <!-- /.col -->
    <Br>
    <div  style="background-image: url('../../dist/img/checkerboard-pattern-green-seamless-background-vector-14423303.jpg'); background-size: 100px 100px;"> 
        <center><p>This copy reflects the list of registered person for the vaccination</p></center>
        <Br>
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

 window.addEventListener("load", window.print());
</script>
</body>
</html>

