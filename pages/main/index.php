<!DOCTYPE html>
<html>
<?php

  include '../../controller/systemcore.php'; 
  $systemcore = new systemcore();
  $System_Sessioning = $systemcore->System_Sessioning("session");
  include '../inc/header.php';
  include '../inc/navbar.php';

?>

<style>
/* html, body {
  overflow: hidden;
} */
</style>
<body onload="startTime()">
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <div id="loading"><img src="../../dist/img/loading_101.gif" style="width:100%; height:1000px;"></div>
  <iframe name="main_frame" id="main_frame" src="../dashboard/" style="border:none;" height="500px" width="99.5%"></iframe>

  </div>
  <!-- /.content-wrapper -->
<?php 
include '../inc/confirmation_alerts.php';
include '../inc/footer.php';
?>

<script>
  (function($){
      $(document).ready(function(){
          $('iframe').height( $(window).height() );
          $(window).resize(function(){
              $('iframe').height( $(this).height() );
          });
      });
  })(jQuery);
</script>
</body>
</html>
