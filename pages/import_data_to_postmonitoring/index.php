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

    $counter = 0;
    // $SelectGroups = $systemcore->SelectCustomize("TRUNCATE TABLE vims_ir");
    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration");
    foreach($SelectTable as $data){ 
      // echo "Operation Data Transfer FTP VIMS IR -<<>>- 1.00.22.980.0000 Operation passage data import SQL syntax coded data {table -> Vaccine_registration [data[".$counter++."]] transfer => VIMS_IR table [data[".$counter++."]] }:: ;=> COMPLETED<br>";
      $code_gen = $data["qr_id"];
      $bday = $data["bday"];
      $brgy = $data["brgy"];
      $lastname = $data["lastname"];
      $firstname = $data["firstname"];
      $middlename = $data["middlename"];

      $table = "post_vaccination";
      $table_col = "qr_id, firstname, middlename, lastname, bday, brgy";
      $table_val = "'$code_gen', '$firstname', '$middlename', '$lastname', '$bday', '$brgy'"; 
      $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
    }

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