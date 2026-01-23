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
      $total_mobile = array();
      $SelectR = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration ORDER BY date_added ASC");
      foreach($SelectR as $value){ 
        $x++; 
        $contact = $value["contact"]; 
        $contact_r = $value["contact"]; 
        $contact_arr = explode("/",$contact);
        $contact = $contact_arr[0];
        $contact = str_replace(' ', '', $contact);

        $contact_length = strlen($contact);
        if($contact_length > 11 && $contact[0] == "0" && $contact_length != 23 ){
          $contact = substr($contact, 1);
        };
        $contact_length = strlen($contact);
        if($contact_length > 11 && $contact[0] == "0"){
          $contact = substr($contact, 1);
        };
        if(strlen($contact) <= 1){ $contact="N/A"; };
        $contact_length = strlen($contact);
        $contact_first_2_digit = $contact[0]."".$contact[1];

        
        if($contact_first_2_digit == "09" && $contact_length == 11){ 
          $total_counter++; 
          array_push($total_mobile, $contact);
        }
      }
      $total_mobile = array_unique($total_mobile);
      foreach($total_mobile as $contact){
        echo $contact."<br>";
      }
    ?>
    <!-- /.content -->
  <!-- /.content-wrapper -->

    <?php 
        include '../inc/footer.php';
    ?>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>