<!DOCTYPE html>
<html>
<?php
    $system_page_name = $_GET["page_name"];
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $System_Sessioning = $systemcore->System_Sessioning("session");

    include '../inc/header.php';
    // include '../inc/navbar.php';
?>
<body class="pages_body">
  <!-- Content Wrapper. Contains page content -->
  <!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $system_page_name; ?></h1>
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
                        $SelectGroups = $systemcore->SelectTable("system_facilities WHERE status='ACTIVE'");
                        foreach($SelectGroups as $value){  ?>
                            <a class="nav-link" id="vert-tabs-home-tab" onclick="show_table('tab', 'show_schedule', '#example1', '<?php echo $value['id'];?>,<?php echo date('m');?>,<?php echo date('Y');?>, ')" data-toggle="pill" href="#tab" role="tab" aria-controls="vert-tabs-home" aria-selected="true"><?php echo $value["facility_name"] ?></a>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-7 col-sm-11">
                    <div class="tab-content" id="vert-tabs-tabContent">
                        <div class="tab-pane text-left fade" id="tab" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
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
    <!-- /.content -->
  <!-- </div> -->
  <!-- /.content-wrapper -->
    <script>

      function Select_all(inputs){
        var checkboxes = document.getElementsByClassName(inputs);
        document.getElementById("selected_days_checkbox").value = "";
        for (var i = 0; i < checkboxes.length; i++) {
          checkboxes[i].checked = true;
          var e_id = checkboxes[i].value;
          document.getElementById("selected_days_checkbox").value += ","+e_id;
        }
      }

      function Un_Select_all(inputs){
        var checkboxes = document.getElementsByClassName(inputs);
        for (var i = 0; i < checkboxes.length; i++) {
          checkboxes[i].checked = false;
        }
        document.getElementById("selected_days_checkbox").value = "";
      }

      
      function set_brgy_value(data){
        var checkboxes = document.getElementById("selected_days_checkbox").value;
        var checkboxes_array = checkboxes.split(','); 
        for (var i = 1; i < checkboxes_array.length; i++) {
          document.getElementById("brgy_"+checkboxes_array[i]).selectedIndex = data;
          // alert("brgy_"+checkboxes_array[i]);
        }
      }

      function set_vaccine_value(data){
        var checkboxes = document.getElementById("selected_days_checkbox").value;
        var checkboxes_array = checkboxes.split(','); 
        for (var i = 1; i < checkboxes_array.length; i++) {
          document.getElementById("vaccine_"+checkboxes_array[i]).selectedIndex = data;
          // alert("brgy_"+checkboxes_array[i]);
        }
      }

      function set_age_limit_value(data){
        var checkboxes = document.getElementById("selected_days_checkbox").value;
        var checkboxes_array = checkboxes.split(','); 
        for (var i = 1; i < checkboxes_array.length; i++) {
          document.getElementById("age_limit_"+checkboxes_array[i]).value = data;
          // alert("brgy_"+checkboxes_array[i]);
        }
      }

      function set_slots_value(data){
        var checkboxes = document.getElementById("selected_days_checkbox").value;
        var checkboxes_array = checkboxes.split(','); 
        for (var i = 1; i < checkboxes_array.length; i++) {
          document.getElementById("slots_"+checkboxes_array[i]).value = data;
          // alert("brgy_"+checkboxes_array[i]);
        }
      }

      function set_time_value(data){
        var checkboxes = document.getElementById("selected_days_checkbox").value;
        var checkboxes_array = checkboxes.split(','); 
        for (var i = 1; i < checkboxes_array.length; i++) {
          document.getElementById("time_"+checkboxes_array[i]).value = data;
          // alert("brgy_"+checkboxes_array[i]);
        }
      }

      function set_status_value(data){
        var checkboxes = document.getElementById("selected_days_checkbox").value;
        var checkboxes_array = checkboxes.split(','); 
        for (var i = 1; i < checkboxes_array.length; i++) {
          document.getElementById("status_"+checkboxes_array[i]).selectedIndex = data;
          // alert("brgy_"+checkboxes_array[i]);
        }
      }




    </script>

    <?php 
        include '../inc/confirmation_alerts.php';
        include '../inc/footer.php';
    ?>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>


