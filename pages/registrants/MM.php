
<?php 
  include '../../controller/systemcore.php'; 
  $systemcore = new systemcore();

  include '../registrants/vims_settings.php'; 
  $VIMS_settings = new VIMS_settings();

  $Global_category_array = $VIMS_settings->Global_category_array();
  $Global_sub_category_array = $VIMS_settings->Global_sub_category_array();
  $Global_allergy = $VIMS_settings->Global_allergy();
  $Global_refusal = $VIMS_settings->Global_refusal();
  $Global_reasons_for_not_FIT = $VIMS_settings->Global_reasons_for_not_FIT();
  $Global_vaccine_name = $VIMS_settings->Global_vaccine_name();
  $Global_comorbidity = $VIMS_settings->Global_comorbidity();
  $Global_regions = $VIMS_settings->Global_regions();
  $Global_province = $VIMS_settings->Global_province();
  $Global_city = $VIMS_settings->Global_city();
  $Global_barangay = $VIMS_settings->Global_barangay();
  $Global_adverse_event_condition = $VIMS_settings->Global_adverse_event_condition();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Bago City COVID-19 Contact Tracing & Surveillance: Management, Assesment, Monitoring, Bulletin Application</title> 
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <link rel="image_src" href="../../dist/img/resbakuna.png"> -->
  <link rel = "icon" href = "../../dist/img/<?php echo $_SESSION["system_logo"];?>">

  <meta property="og:image" content="http://bagocho.pagenet.info/VIMS/dist/img/VIMS_preview123.png" />
  <meta property="og:description" content="Get vaccinated! #RESBAKUNA \n #BIDABakunation \n #BIDASolusyon + \n #ExplainExplainExplain \n #BakunaBago" />
  <meta property="og:url"content="	http://bagocho.pagenet.info/VIMS/pages/vaccine_registration/" />
  <meta property="og:title" content="Bago City COVID-19 Vaccine Online Registration" />

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
</head>
<body style="background-color:rgb(95, 172, 176)!important;">
    <form action="index1.php" method="POST">
        <div class="form-group col-sm-6">
            <label for="exampleInputEmail1">Brgy Name<span style="color:red;">*</span></label>
            <input type="text" class="form-control regis_form" name="brgy" alt="required" >
        </div>
        <div class="form-group col-sm-6">
            <label for="exampleInputEmail1">Vaccinator Name<span style="color:red;">*</span></label>
            <input type="text" class="form-control regis_form" name="vaccinator" alt="required" >
        </div>

        <div class="form-group col-sm-6">
            <label for="exampleInputEmail1">Batch Number<span style="color:red;">*</span></label>
            <input type="text" class="form-control regis_form" name="batch_number" alt="required" >
        </div>

        <div class="form-group col-sm-4">
        <label for="exampleInputEmail1">Doses?<span style="color:red;">*</span></label>
            <select name="doses" class="form-control regis_form bg-info" >
                <option value="1st_Dose">1st_Dose</option>
                <option value="2nd_Dose">2nd_Dose</option>
            </select>
        </div>
        <div class="form-group col-sm-3">
            <select id="select_vaccine" name="vaccine_name" class="form-control bg-info"  >  
                <?php foreach($Global_vaccine_name as $data){ 
                    ?>
                    <option value="<?php echo $data; ?>"><?php echo $data; ?></option>
                <?php  
                }?>
            </select>
            <label for="exampleInputEmail1">Vaccine Manufacturer Name<span style="color:red;">*</span></label>
        </div>
        <button type="submit">PROCESS</button>
     </form>

</body>

</html>
