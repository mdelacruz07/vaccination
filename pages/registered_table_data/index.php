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
              <h2 class="card-title col-lg-10" style="padding-top:10px; "><b>List Of System Users</b></h2>
              <!-- <button type="button" class="btn btn-block btn-outline-secondary col-lg-2" data-toggle="modal" data-target="#create_user">Add New User</button> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="user_table">
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

    <?php 
        include '../inc/confirmation_alerts.php';
        include '../inc/footer.php';
    ?>
    <script>
        // setting up the tables
        show_table("user_table", "show_registered_table", "#example1");
        
    </script>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>


