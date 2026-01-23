<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    session_start();
    date_default_timezone_set('Asia/Manila');
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
@media print {
  .row {page-break-after: always;}
}
  </style>
  <?php 
    // include '../inc/header.php';//FIX this this is for temporary include!!

  ?>
</head>
<body>
    <!-- <div class="col-12" style="height:1465px">Print Number</div> -->
    <?php
        $numbers = 24;
        $counter = 0;
        for($x = 0; $x < 999; $x++){ ?>
          <div class="row p-5 m-0" ><?php 
            for($m = 0; $m < 5; $m++){
              for($i = 0; $i < 3; $i++){ 
                $counter++; ?>
                  <div class="card col-4 p-0 m-0 text-center" style="border:black 1px solid; background-image: url('../../dist/img/123.jpg'); background-size: contain;">
                    <h1 class="m-0 p-0" style='font-size:180px;'><?php echo $counter; ?></h1>
                    <h4 class="m-0 p-0 mb-3">Covid-19 Vaccination</h4>
                    <h4 class="m-0 p-0"><?php echo date("Y-m-d", time() + 86400); ?></h4>
                    <br>
                    
                  </div> <?php
                if($counter >= $numbers){
                  exit();
                }
              } 
            } ?>
          </div><?php
        } ?>

<?php
   include '../inc/footer.php';//fix this, this is for temporary include!!
?>
<script type="text/javascript"> 

 window.addEventListener("load", window.print());
</script>
</body>
</html>

