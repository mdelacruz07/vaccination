<!DOCTYPE html>
<html>
<?php

include '../../controller/systemcore.php'; 
$systemcore = new systemcore();
$System_Sessioning = $systemcore->System_Sessioning("session");

include '../registrants/vims_settings.php'; 
$VIMS_settings = new VIMS_settings();

$Global_category_array = $VIMS_settings->Global_category_array();
$Global_vaccine_name = $VIMS_settings->Global_vaccine_name();

array_push($Global_category_array, "N/A");
array_push($Global_vaccine_name, "N/A");
$vaccines_1st = array();
$vaccines_2nd = array();

foreach($Global_vaccine_name as $vaccines){
  array_push($vaccines_cardinal, $vaccines);

  foreach($Global_category_array as $category){
    array_push($vaccines_1st, 0);
  }
  foreach($Global_category_array as $category){
    array_push($vaccines_2nd, 0);
  }

}


include '../inc/header.php';
?>
<body style="background-color:rgb(227, 225, 218); color:black; margin-left:20px;">
  <!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-10">
            <h1>VIMS-VAS</h1>
            <h5>Daily Data Allocation <?php echo date("Y-m-d"); ?></h5>
          </div>
          <div class="col-2">
            <a class="btn btn-block btn-outline-secondary" href="download_vims_vas.php" target="_blank">Download VIMS-VAS Excel File</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php

    $current_date = date("Y-m-d");
    $SelectGroups = $systemcore->DeleteTable("vims_vas_12", "R = 'N/A'");
    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE time_stamp = '$current_date'");
    // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE dose_2 = '01_Yes'");
    foreach($SelectTable as $data){ 

      $Category = $data["employmentcategory"];
      $Category_ID = $data["idcategory"];
      $idnumber = $data["idnumber"];
      $phid = $data["phid"];
      $pwdid = $data["pwdid"];
      $lastname = $data["lastname"];
      $firstname = $data["firstname"];
      $middlename = $data["middlename"];
      $suffix = $data["suffix"];
      $contact = $data["contact"];
      $current_residence = $data["current_residence"];
      $region = $data["region"];
      $province = $data["province"];
      $city = $data["city"];
      $brgy = $data["brgy"];
      $gender = $data["gender"];
      $bday = $data["bday"];
      $brgy = $data["brgy"];
      $consent = $data["consent"];
      $reason_refusal = $data["reason_refusal"];
      $age = date_diff(date_create(), date_create($bday));
      $age = $age->format("%Y");
      
      if($age > 16){
        $Age_more_16 = "01_Yes";
      }else{
        $Age_more_16 = "02_No";
      }

      $allergies_to_PEG = $data["allergies_to_PEG"];
      if($allergies_to_PEG == "N/A"){ $allergies_to_PEG="01_Yes"; };

      $if_severe_allergic = $data["if_severe_allergic"];
      $allergy = $data["allergy"];
      if($allergy == "01_Yes"){
        $if_allergy_1 = "01_Yes";
      }else{
        $if_allergy_1 = "02_No";
      }

      $if_allergy = $data["if_allergy"];
      $bleeding_disorders = $data["bleeding_disorders"];
      $if_bleeding = $data["if_bleeding"];
      $symtoms = $data["symtoms"];
      if($symtoms == "01_Yes"){ 
        $if_symtoms = "01_Yes";
      }else{
        $if_symtoms = "02_No";
      }
      $covid_exposure = $data["covid_exposure"];
      $covid_status = $data["covid_status"];
      $if_receive_vaccine = $data["if_receive_vaccine"];
      $convalescent = $data["convalescent"];
      $pregnant = $data["pregnant"];
      $if_pregnant = $data["if_pregnant"];
      $comorbidity = $data["comorbidity"];
      if($comorbidity == "01_Yes"){ 
        $if_comorbidity = "01_Yes";
      }else{
        $if_comorbidity = "02_No";
      }
      $medical_clearance = $data["medical_clearance"];
      $defferal = $data["defferal"];
      $time_stamp = $data["time_stamp"];
      $vaccine_name = $data["vaccine_name"];
      $batch_number = $data["batch_number"];
      $lot_number = $data["lot_number"];
      $vaccinator_name = $data["vaccinator_name"];
      $prof_vaccinator = $data["prof_vaccinator"];
      $dose_1 = $data["dose_1"];
      $dose_2 = $data["dose_2"];
      $agency = $data["agency"];
      $occupation = $data["ocupation"];

      $up_count = 0;
      $do_count = 0;
      foreach($Global_vaccine_name as $vaccines){
        foreach($Global_category_array as $category12){
          if($vaccines == $vaccine_name && $category12 == $Category && $dose_1 == "01_Yes"){
            $vaccines_1st[$up_count]++;
          }
          $up_count++;
        }
        foreach($Global_category_array as $category12){
          if($vaccines == $vaccine_name && $category12 == $Category && $dose_2 == "01_Yes"){
            $vaccines_2nd[$do_count]++;
            $vaccines_1st[$do_count]--;//this function remove the person on the 1st dose report if he or she has recieve the 2nd dose
          }
          $do_count++;
        }
      }
      
      //NEW VIMS_VAS!!
      if($dose_1 == "01_Yes"){
        $dose_1 = "Y";
      }else{
        $dose_1 = "N";
      }
      if($dose_2 == "01_Yes"){
        $dose_2 = "Y";
      }else{
        $dose_2 = "N";
      }
      if($defferal == "02_No"){
        $reason_for_deferral = "N/A";
      }else{
        $reason_for_deferral = $defferal;
        $defferal == "01_Yes";
      }

      $indigenous = $data["indigenous"];
      $adverse_event = $data["adverse_event"];
        if($adverse_event == "01_Yes"){
          $adverse_event = "Y";
        }else{
          $adverse_event = "N";
        }
      $adverse_event_cons = $data["adverse_event_cons"];
      $pwd = $data["pwd"];
        if($pwd == "01_Yes"){
          $pwd = "Y";
        }else{
          $pwd = "N";
        }

      $table = "vims_vas_12";
      $table_col = "`category`, `unique_id`, `pwd`, `indigenous`, `lastname`, `firstname`, `middlename`, `suffix`, `contact`, `region`, `province`, `city`, `brgy`, `gender`, `bday`, `deferral`, `reason_for_deferral`, `vaccination_date`, `vaccine_name`, `batch_number`, `lot_number`, `bakuna_center`, `vaccinator_name`, `1st_dose`, `2nd_dose`, `adverse_event`, `adverse_event_condition`";
      $table_val = "'$employmentcategory', '$qr_id', '$pwd', '$indigenous', '$lastname', '$firstname', '$middlename', '$suffix', '$contact', '$region', '$province', '$city', '$brgy', '$gender', '$bday', '$defferal', '$reason_for_deferral', '$time_stamp', '$vaccine_name', '$batch_number', '$lot_number', 'CBC04042', '$vaccinator_name', '$dose_1', '$dose_2', '$adverse_event', '$adverse_event_condition'"; 
      $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);


      // Has no allergy to food, egg, medicines, and no asthma?	* If with allergy or asthma, will the vaccinator able to monitor the patient for 30 minutes?	Has no history of bleeding disorders or currently taking anti-coagulants?	* if with bleeding history, is a gauge 23 - 25 syringe available for injection?	Does not manifest any of the following symptoms: Fever/chills, Headache, Cough, Colds, Sore throat,  Myalgia, Fatigue, Weakness, Loss of smell/taste, Diarrhea, Shortness of breath/ difficulty in breathing	* If manifesting any of the mentioned symptom/s, specify all that apply	Has no history of exposure to a confirmed or suspected COVID-19 case in the past 2 weeks?	Has not been previously treated for COVID-19 in the past 90 days?	Has not received any vaccine in the past 2 weeks?	Has not received convalescent plasma or monoclonal antibodies for COVID-19 in the past 90 days?	Not Pregnant?	* if pregnant, 2nd or 3rd Trimester?	Does not have any of the following: HIV, Cancer/ Malignancy, Underwent Transplant, Under Steroid Medication/ Treatment, Bed Ridden, terminal illness, less than 6 months prognosis	* If with mentioned condition/s, specify.	* If with mentioned condition, has presented medical clearance prior to vaccination day?



    }
    ?>

    <!-- Main content -->
    <section class="content row"><?php
      $up_count = 0;
      $do_count = 0;
      $start = 0;
      $skip = count($Global_category_array);

      foreach($Global_vaccine_name as $vaccine){ ?>
        <div class="col-6 p-1">
          <div class="card col-12">
            <center><h3 style="color:rgb(89, 148, 84)"><?php echo $vaccine;?></h3></center>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                    <th colspan="13" style="color: rgb(15, 130, 5)"><center><h5><b>1st Dose</b></h5></center></th>
                </tr>
                <tr>
                    <th>A1</th>
                    <th>A2</th>
                    <th>A3</th>
                    <th>A4</th>
                    <th>A5</th>
                    <th>B1</th>
                    <th>B2</th>
                    <th>B3</th>
                    <th>B4</th>
                    <th>B5</th>
                    <th>B6</th>
                    <th>C</th>
                    <th>N/A</th>
                    <th>Total</th>
                </tr>
              </thead>
              <tbody> <?php
              $total = 0;
                for($x = $start; $x < $skip; $x++){ ?>
                  <td><?php echo $vaccines_1st[$x]; ?></td>
                <?php $total = $total + $vaccines_1st[$x]; } ?>
                <td><?php echo $total; ?></td>
              </tbody>
            </table>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th colspan="13" style="color: rgb(15, 130, 5)"><center><h5><b>2nd Dose</b></h5></center></th>
                </tr>
                <tr>
                    <th>A1</th>
                    <th>A2</th>
                    <th>A3</th>
                    <th>A4</th>
                    <th>A5</th>
                    <th>B1</th>
                    <th>B2</th>
                    <th>B3</th>
                    <th>B4</th>
                    <th>B5</th>
                    <th>B6</th>
                    <th>C</th>
                    <th>N/A</th>
                    <th>Total</th>
                </tr>
              </thead>
              <tbody> <?php
                $total = 0;
                for($x = $start; $x < $skip; $x++){ ?>
                  <td><?php echo $vaccines_2nd[$x]; ?></td>
                <?php $total = $total + $vaccines_2nd[$x]; } ?>
                <td><?php echo $total; ?></td>
              </tbody>
            </table>
          </div>
        </div> <?php  
          $start = $start + count($Global_category_array);
          $skip = $skip + count($Global_category_array);
        
      } 
      
      ?>
     
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->

    <?php 
        include '../inc/confirmation.php';
        include '../inc/footer.php';
    ?>
    <script>
      // window.parent.location.href = "http://www.example.com"; 
    </script>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>