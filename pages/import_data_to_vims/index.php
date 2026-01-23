<!DOCTYPE html>
<html>
<?php
date_default_timezone_set('Asia/Manila');
include '../../controller/systemcore.php'; 
$systemcore = new systemcore();
$System_Sessioning = $systemcore->System_Sessioning("session");
$user_facility = $_SESSION["user_facility"]; 
$facility = array();
if($user_facility == "ALL"){
  $SelectUser = $systemcore->SelectTable("system_user");
}else{
  $SelectUser = $systemcore->SelectTable("system_user WHERE facility_id = '$user_facility'");
}
foreach($SelectUser as $data){
  $facility_id = $data["facility_id"];
  array_push($facility, $facility_id);
}

$facility = array_unique($facility);

include '../inc/header.php';
?>
<style>
@media print {
  .printPageelements {
    display: none;
  }
}

.error_report{
  page-break-before: always;
}
</style>
<body style="background-color:rgb(227, 225, 218); color:black; margin-left:20px;">
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <form class="container-fluid">
        <div class="row mb-2">
          <div class="col-6">
              <br>
            <h2>VIMS-VAS Allocation</h2>
          </div>
          <div class="col-2">
            <label for="exampleInputEmail1">Facility</label>
            <select name="facility_id" class="form-control"><?php
              foreach($facility as $id){ 
                if(strlen($id) >= 2){?>
              <option value="<?php echo $id; ?>"><?php echo $id; ?></option> 
              <?php
              } 
              }?>
              <option value=" "> </option>
            </select>
          </div>
          <div class="col-2">
            <label  for="exampleInputEmail1">Date:</label>
            <input type="date" class="form-control"  name="selected_date" value="<?php echo date('Y-m-d'); ?>">
          </div>
          <div class="col-2">
            <label  for="exampleInputEmail1"><br></label>
            <button class="btn btn-warning col-12" type="button" id="printPageButton" onclick="sys_edit('vims_allocation.php', 'allocation', facility_id.value+'cut'+selected_date.value, 'required_div', '#example1')">Generate Vims Allocation</button>
          </div>
        </div>
      </form><!-- /.container-fluid -->
    </section>
    <hr>

    <!-- Main content -->

    <section class="content row" id="allocation">
      <!-- <div id="loading1"><img src="../../dist/img/loading_101.gif" style="width:100%; height:1000px;"></div> -->
    </section>
    <br>
    <Br>
    <br>
    <!-- /.content -->

  <!-- /.content-wrapper -->

    <?php 
        include '../inc/confirmation.php';
        include '../inc/footer.php';
    ?>
    <script>
      // window.parent.location.href = "http://www.example.com"; 
      function Printer(){
        window.print();
      }
    </script>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>