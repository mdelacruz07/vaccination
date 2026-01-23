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
<body style="background-color:black;">
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
            <div class="col-9">
                <div class="row col-12 bg-danger ">
                    <div class="col-4">
                        <img src="../../dist/img/stich_sorry.gif" class="col-12">
                    </div>
                    <div class="col-8 p-5">
                        <Center><h1 style="font-size:120px">SORRY NA LOVEKO</h1></Center>
                    </div>
                </div>
                <Br>
                <div class="row col-12 bg-warning ">
                    <div class="col-9 p-5">
                    <Center><h1 style="font-size:120px">PLEEAASSEE!!</h1></Center>
                    </div>
                    <div class="col-3">
                        <img src="../../dist/img/panda_sorry.gif" class="col-12">
                    </div>
                </div>
            </div>
            <div class="col-3 btn btn-info"  data-toggle="modal" data-target="#modal-default">
                <Center><h1 style="font-size:60px">CLICK HERE TO PROCEED TO THE VIMS SYSTEM</h1></Center>
                <br>
                <img src="../../dist/img/clicker_stich.gif" class="col-12">
                <p>“I still do not comprehend how I could have been so stupid and hurt you, You mean everything to me. I’m so sorry.”</p>
            </div>

        </div>
    </section>
    <!-- /.content -->
  <!-- </div> -->
  <!-- /.content-wrapper -->
  <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Confirmation</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are You Sure You want to disregard your boyfriends apologie?? He is so sorry right now and you are the most important person for him and he will always choose you even what happens!</p>
              <img src="../../dist/img/stitch-cry.gif" class="col-12">
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">I Need To Think</button>
              <a href="../main/index.php" type="button" class="btn btn-primary">Proceed</a>
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


