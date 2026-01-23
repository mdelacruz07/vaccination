<?php 
  include '../../controller/systemcore.php'; 
  $systemcore = new systemcore();
  $qr_id = $_GET["qr_id"];
  $qr_id = preg_replace('/[^A-Za-z0-9\-]/', '', $qr_id);
  $SelectA = $systemcore->SelectTable("system_user WHERE code = '$qr_id'");
  if($SelectA == "none"){
    // header("Location: http://bagocho.pagenet.info/");
  }else{
    foreach($SelectA as $value){ 
      $cookie_name = "OVRM_QR_ID";
      $cookie_value = $value["code"];
      setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day

      $cookie_name = "OVRM_QR_NAME";
      $cookie_value = $value["first_name"]." ".$value["middle_name"]." ".$value["last_name"];
      setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
      // echo $value["code"];
      // echo $cookie_name;

      // if(!isset($_COOKIE[$cookie_name])) {
      //   echo "Cookie named '" . $cookie_name . "' is not set!";
      // } else {
      //   echo "Cookie '" . $cookie_name . "' is set!<br>";
      //   echo "Value is: " . $_COOKIE[$cookie_name];
      // }

      $name = $value["first_name"]." ".$value["middle_name"]." ".$value["last_name"];
      $gender = $value["gender"];
      $bday = $value["birthday"];
      $age = date_diff(date_create($bday), date_create('today'))->y;
    }
  } 
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bago City COVID-19 Contact Tracing & Surveillance: Management, Assesment, Monitoring, Bulletin Application</title> 
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    #overlay {
      position: fixed; /* Sit on top of the page content */
      display: none; /* Hidden by default */
      width: 100%; /* Full width (cover the whole page) */
      height: 100%; /* Full height (cover the whole page) */
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: rgba(0,0,0,0.5); /* Black background with opacity */
      z-index: 99999; /* Specify a stack order in case you're using a different order for other elements */
      cursor: pointer; /* Add a pointer on hover */
    }
    #confirmation_box {
      z-index: 999999; /* Specify a stack order in case you're using a different order for other elements */
    }
  </style>
</head>
<body style="background-color:rgb(95, 172, 176)!important;">

  <div id="overlay"></div>
  <br>
  <div class="container">
    <div>
      <div class="login-logo row text-center">
        <img src="../../dist/img/bago_Logo.png" alt="User Image"  width="50px" height="50px" class="mx-auto d-block">
        <b style="color:white; font-weight: 900; font-size:14px;" class="col-sm-12">Bago City COVID-19 Online Registration Managemnet System <br>(Schedule Viewer)</b>
        <!-- <span style="color:white; font-weight: 900; margin:0px !important; font-size:20px !important;" class="col-sm-12">( for 18 years old and Above )</span> -->
        <!-- <b style="color:white; font-weight: 900;" class="col-sm-12">Bago City Residents</b> -->
      </div>
      <br>
      <!-- /.login-logo -->
      <div class="card" style="background-color:rgb(217, 255, 255); " >
        <div class="card-header">
            <h3 class="card-title">Your Information Details</h3>
        </div>
        <div class="card-body login-card-body" id="survey_result">
          <table class="table table-bordered">
            <tr>
              <td>Full Name:</td>
              <td><?php echo $name; ?></td>
            </tr>
            <tr>
              <td>Age:</td>
              <td><?php echo $age; ?></td>
            </tr>
            <tr>
              <td>Gender:</td>
              <td><?php echo $gender; ?></td>
            </tr>
          </table>
        </div>
      </div>

      <div class="card" style="background-color:rgb(217, 255, 255); " >
        <div class="card-header">
            <h3 class="card-title">Vaccination Facilities</h3>
        </div>
        <div class="card-body login-card-body" id="survey_result"><?php
                      
          $SelectGroups = $systemcore->SelectTable("system_facilities");
          foreach($SelectGroups as $value){  ?>
            <button type="button" class="btn btn-warning col-12 p-2 mb-2" data-toggle="modal" data-target="#update" onclick="sys_edit('view_schedule.php', 'veiw_result', '<?php echo $value['id'];?>,<?php echo date('m');?>,<?php echo date('Y');?>,<?php echo $value['facility_name']; ?>', 'required_div', 'none')" ><?php echo $value["facility_name"]; ?></button><?php
          } ?>
          
        </div>
      </div>
    </div>
    <center><a href="delete.php"><button class="btn btn-danger">Log-out</button></a></center><br>
  </div>
  <!-- /.login-box -->

      <div class="modal fade" id="update">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="veiw_result">
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
    <!-- /.modal -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<script>
//Edit Function
function sys_edit(form_file_name,result_id,primary_id,required_notice,table_id){

xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    document.getElementById(result_id).innerHTML = this.responseText;
    document.getElementById(required_notice).style.display = "none";
    $(table_id).DataTable();
};
xhttp.open("GET", form_file_name+"?primary_id="+primary_id, true);
xhttp.send();  
}
</script>
<?php  include '../inc/copyfooter.php'; ?>
</body>
</html>
