<!DOCTYPE html>
<html>
<?php
    $system_page_name = $_GET["page_name"];
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $System_Sessioning = $systemcore->System_Sessioning("session");

    include '../inc/header.php';
    // include '../inc/navbar.php';
    $facility = array();
    $SelectUser = $systemcore->SelectTable("system_user");
    foreach($SelectUser as $data){
    $facility_id = $data["facility_id"];
        array_push($facility, $facility_id);
    }
      
      $facility = array_unique($facility);
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
              <h2 class="card-title col-10"><b>List</b></h2>
              <!-- <a href="index.php" class="btn btn-warning col-2">Refresh</a> -->
              <!-- <button type="button" class="btn btn-block btn-outline-secondary col-lg-2" data-toggle="modal" data-target="#create_facility">Add New</button> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
		<label for="exampleInputEmail1">Facility ID</label>
                <form class="col-4 row">
		    <input type='date' name='date_select' class="form-control col-6">
                    <select name="facility_id" class="form-control col-6" onchange="show_table('facilities_table', 'show_check_vax', '#example1', this.value+','+date_select.value);"><?php
                    foreach($facility as $id){ 
                        if(strlen($id) >= 2 ){?>
                    <option value="<?php echo $id; ?>"><?php echo $id; ?></option> 
                    <?php
                    } 
                    }?>
                    <option value=" "> </option>
                    </select>
                </form>
                <br>
                <div id="facilities_table">
                    <!-- table will be showed here after the script executed!! -->
                </div>
                <form id="select_to_delete" hidden>
                    <h1>Deleted ID's</h1>
                    <input type="text" name="selected_id" id="select_to_delete_input" value="none">
                </form>
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

    <div class="modal fade" id="update">
        <div class="modal-dialog modal-xl" style="overflow-y: initial !important">
            <div class="modal-content" id="veiw_result">
                
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    

    <?php 
        include '../inc/confirmation_alerts.php';
        include '../inc/footer.php';
    ?>
    <script>
        // setting up the tables
        show_table("facilities_table", "show_check_vax", "#example1", "ALL");

        function minute_function(minute_to_add){

          var hour = document.getElementById("add_addmission_time_hour").value;
          var minute = document.getElementById("add_addmission_time_minute").value;
 
          var total_minutes = parseInt(minute) + parseInt(minute_to_add);
          if(total_minutes >= 60){
            hour = parseInt(hour) + 1;
            total_minutes = total_minutes - 60;
          }
          if(hour > 12){
            hour = parseInt(hour) - 12;
          }
          document.getElementById("add_discharge_time_hour").value = ('0' + hour).slice(-2);
          document.getElementById("add_discharge_time_minute").value = ('0' + total_minutes).slice(-2);

        }

        function minute_function1(minute_to_add, output_id, output_id1, input_id, input_id1){

            var hour = document.getElementById(input_id1).value;
            var minute = document.getElementById(input_id).value;

            var total_minutes = parseInt(minute) + parseInt(minute_to_add);
            if(total_minutes >= 60){
            hour = parseInt(hour) + 1;
            total_minutes = total_minutes - 60;
            }
            if(hour > 12){
            hour = parseInt(hour) - 12;
            }
            document.getElementById(output_id1).value = ('0' + hour).slice(-2);
            document.getElementById(output_id).value = ('0' + total_minutes).slice(-2);

        }

        function PrintElem(elem)
        {
            var mywindow = window.open('', 'PRINT', 'height=400,width=600');

            mywindow.document.write('<html><head><title>' + document.title  + '</title>');
            mywindow.document.write('</head><body >');
            mywindow.document.write('<h1>' + document.title  + '</h1>');
            mywindow.document.write(document.getElementById(elem).innerHTML);
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            // mywindow.print();
            // mywindow.close();

            return true;
        }
        
    </script>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>


