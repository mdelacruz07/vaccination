<!DOCTYPE html>
<html>
<?php

include '../../controller/systemcore.php'; 
$systemcore = new systemcore();



$System_Sessioning = $systemcore->System_Sessioning("session");

include '../inc/header.php';
?>
<body style="background-color:black; color:rgb(153, 191, 167); margin-left:20px;">
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>System Import VIMS_IR</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="../index/">Home</a></li>
              <li class="breadcrumb-item active"><?php echo date("F d Y"); ?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php




      $SelectTables = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE dose_1 != '01_Yes' AND employmentcategory != '02_A2: Senior Citizens'");
      if($SelectTables != "none"){
        foreach($SelectTables as $value){
          $bday = $value["bday"];
          $age = date_diff(date_create(), date_create($bday));
          $age = $age->format("%Y");
          if($age >= 60 && $age <= 120){
            echo $age."<br>";
            $counter++;
          }
        }
      }
    echo $counter;

    echo "<br>";
    echo "<br>";

    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";

    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "<br>";

    ?>

    <!-- Main content -->
    <section class="content">
      

    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->

    <?php 
        include '../inc/confirmation.php';
        include '../inc/footer.php';
    ?>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>