<!DOCTYPE html>
<html>
<?php
    $system_page_name = $_GET["page_name"];
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $System_Sessioning = $systemcore->System_Sessioning("session");

    include '../inc/header.php';
?>
<body class="pages_body">
  <!-- Content Wrapper. Contains page content -->
  <!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card mb-5 pb-5">
            <!-- /.card-header -->
            <div class="card-body text-center p-5 m-5">
                <h1 class="mt-5 pt-5"><?php echo $system_page_name; ?></h1>
                <button type="button" class="btn btn-block btn-outline-secondary col-lg-2 offset-5 mb-5" data-toggle="modal" data-target="#sync">RUN ONLINE SYSTEM SYNC!!</button>
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



    <div class="modal fade" id="sync">
        <div class="modal-dialog modal-sm" style="overflow-y: initial !important">
            <div class="modal-content">
                <div class="modal-header p-1">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-footer p-1 justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="sync.php" type="submit" class="btn btn-primary">Start Sync</a>                           
                </div>
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
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>


