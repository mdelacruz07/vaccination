<!DOCTYPE html>
<html>
<?php

include '../../controller/systemcore.php'; 
$systemcore = new systemcore();
$System_Sessioning = $systemcore->System_Sessioning("session");
include '../inc/header.php';
// include '../inc/navbar.php';

//Page Credetials!!!
if(empty($_GET["page_name"])){
  $system_page_name = "Dashboard";
}else{
  $system_page_name = $_GET["page_name"];
}

?>
<style>
</style>
<body class="pages_body">
  <!-- Content Wrapper. Contains page content -->
  <!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>System <?php echo $system_page_name; ?></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

      <!-- Main content -->
      <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h2 class="card-title col-lg-10" style="padding-top:10px; "><b>List Of Schedules</b></h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <h4>Vaccine Facilities</h4>
                <div class="row">
                <div class="col-5 col-sm-1">
                    <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical"><?php
                        $SelectGroups = $systemcore->SelectTable("system_facilities");
                        foreach($SelectGroups as $value){  ?>
                            <a class="nav-link" id="vert-tabs-home-tab" onclick="show_table('tab', 'show_schedule_dashboard', '#example1', '<?php echo $value['id'];?>,<?php echo date('m');?>,<?php echo date('Y');?>, ')" data-toggle="pill" href="#tab" role="tab" aria-controls="vert-tabs-home" aria-selected="true"><?php echo $value["facility_name"] ?></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-7 col-sm-11">
                    <div class="tab-content" id="vert-tabs-tabContent">
                        <div class="tab-pane text-left fade show active" id="tab" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                            Content!
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
<?php 
include '../inc/confirmation_alerts.php';
include '../inc/footer.php';
?>
<script>
  show_table('tab', 'show_schedule_dashboard', '#example1', '1,<?php echo date('m');?>,<?php echo date('Y');?>, ');
</script>
</body>
</html>