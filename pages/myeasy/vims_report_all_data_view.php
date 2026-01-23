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
          <br>
          <div class="col-12 asdasdasd">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Full Name</th>
                  <th>ADDRESS</th>
                  <th>EMAIL ADDRESS</th>
                  <th>DOB</th>
                  <th>Vaccine Name</th>
                  <th>Dose 1</th>
                  <th>Dose 2</th>
                </tr>
              </thead>
              <tbody> 
              <?php
              
                $SelectR = $systemcore->SelectCustomize("SELECT * FROM vims_report WHERE vaccination_date = '$current_date'");
                foreach($SelectR as $value){ 
                  echo "<tr>";
                    echo "<td>".$value["lastname"]." ".$value["firstname"]." ".$value["middlename"]."</td>";
                    echo "<td>".$value["brgy"].", ".$value["city"]."</td>";
                    echo "<td>N/A</td>";
                    echo "<td>".$value["bday"]."</td>";
                    echo "<td>".$value["vaccine_name"]."</td>";
                    echo "<td>".$value["1st_dose"]."</td>";
                    echo "<td>".$value["2nd_dose"]."</td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
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

