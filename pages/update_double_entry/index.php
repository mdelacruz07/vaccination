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
    $double_entry = array();
    $counter = 0;
    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration");
    foreach($SelectTable as $data){ 
      $id = $data["id"];
      
      $lastname = strtolower($data["lastname"]);
      $firstname = strtolower($data["firstname"]);
      $middlename = strtolower($data["middlename"]);

      array_push($double_entry,$lastname." ".$firstname." ".$middlename);
    }
    $duplicates = array_unique( array_diff_assoc( $double_entry, array_unique( $double_entry ) ) );
    // $withoutDuplicates = array_unique(array_map("strtoupper", $double_entry));
    // $duplicates = array_diff($double_entry, $withoutDuplicates);
    // echo $x."<br>";
    // echo $v."<br>";
    // echo $g."<br>";
    // sort($duplicates);
    foreach($duplicates as $double){
      echo $double."<br>";
      $counter++;

    }
    
    echo "<br>";
    echo "<br>";
    echo "MMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMMm<br>";
    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration");
    foreach($SelectTable as $data){ 
      $id = $data["id"];
      
      $lastname = strtolower($data["lastname"]);
      $firstname = strtolower($data["firstname"]);

      array_push($double_entry,$lastname." ".$firstname);
    }
    $duplicates = array_unique( array_diff_assoc( $double_entry, array_unique( $double_entry ) ) );

    foreach($duplicates as $double){
      $counter++;
      echo $double."<br>";



    }
    echo $counter;
    echo "<br>";
    echo "<br>";  echo "<br>";
    echo "<br>";  echo "<br>";
    
    ?>

    <!-- Main content -->
    <section class="content">
      

    </section>

    <?php 
        include '../inc/confirmation.php';
        include '../inc/footer.php';
    ?>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>