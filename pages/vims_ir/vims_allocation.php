<?php
$selected_date = $_GET["primary_id"];
date_default_timezone_set('Asia/Manila');
include '../../controller/systemcore.php'; 
$systemcore = new systemcore();
$System_Sessioning = $systemcore->System_Sessioning("session");

include '../registrants/vims_settings.php'; 
$VIMS_settings = new VIMS_settings();

$Global_category_array = $VIMS_settings->Global_category_array();

array_push($Global_category_array, "N/A");
$regestered = array();
$consent_data = array(0, 0, 0);
$comorbid_data = array(0, 0, 0);
foreach($Global_category_array as $category){
  array_push($regestered, 0);
}




include '../inc/header.php';
?>
<body style="background-color:rgb(227, 225, 218); color:black; margin-left:20px;">

    <section class="content-header col-12">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-10">
            <h1><u>VIMS-IR</u></h1>
            <h5>Daily Data Allocation <?php echo $selected_date; ?></h5>
          </div>
          <div class="col-2">
            <a class="btn btn-block btn-outline-secondary col-12" href="download_vims_vas.php" target="_blank">Download VIMS-IR Excel File</a>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php

    // $current_date =$selected_date;
    $SelectGroups = $systemcore->DeleteTable("vims_ir", "id > 0");
    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration");
    foreach($SelectTable as $data){ 
      // echo "Operation Data Transfer FTP VIMS IR -<<>>- 1.00.22.980.0000 Operation passage data import SQL syntax coded data {table -> Vaccine_registration [data[".$counter++."]] transfer => VIMS_IR table [data[".$counter++."]] }:: ;=> COMPLETED<br>";
      $id = $data["id"];
      $allergy_to_vaccine = $data["allergy_to_vaccine"];
      $profile_comorbidity = $data["profile_comorbidity"];
      $Category = $data["employmentcategory"];
      $sub_category = $data["sub_category"];
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
      $occupation = $data["ocupation"];
      $consent = $data["consent"];
      $date_added = strtotime($data["date_added"]);
      $date_added =  date('Y-m-d', $date_added);
      $data_type= $data["encoded"];
      if($data_type == "YES"){
        if($date_added == $selected_date){$counter++; 
          $x = 0;
          foreach($Global_category_array as $category12){
            if($category12 == $Category){
              $regestered[$x]++;
            }
            $x++;
          }
          if($consent == "01_Yes"){
            $consent_data[0]++;
          }else if($consent == "02_No"){
            $consent_data[1]++;
          }else{
            $consent_data[2]++;
          }

          if($profile_comorbidity == "01_Yes"){
            $comorbid_data[0]++;
          }else if($profile_comorbidity == "02_None"){
            $comorbid_data[1]++;
          }else{
            $comorbid_data[2]++;
          }
          $table = "vims_ir";
          $table_col = "Priority_group, Sub_Priority, last_name, first_name, middle_name, suffix, contact, region, province, city, brgy, sex, bday, occupation, allergy_to_vaccine, with_comorbidity";
          $table_val = "'$Category', '$sub_category', '$lastname', '$firstname', '$middlename', '$suffix', '$contact', '$region', '$province', '$city', '$brgy', '$gender', '$bday', '$occupation', '$allergy_to_vaccine', '$profile_comorbidity'"; 
          $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
        }
      }
      elseif($data_type == "Online Registration"){
        if($date_added == date('Y-m-d', strtotime($selected_date. ' - 1 days'))){
          $counter++; 
          
          $x = 0;
          foreach($Global_category_array as $category12){
            if($category12 == $Category){
              $regestered[$x]++;
            }
            $x++;
          }
          if($consent == "01_Yes"){
            $consent_data[0]++;
          }else if($consent == "02_No"){
            $consent_data[1]++;
          }else{
            $consent_data[2]++;
          }

          if($profile_comorbidity == "01_Yes"){
            $comorbid_data[0]++;
          }else if($profile_comorbidity == "02_None"){
            $comorbid_data[1]++;
          }else{
            $comorbid_data[2]++;
          }
          $table = "vims_ir";
          $table_col = "Priority_group, Sub_Priority, last_name, first_name, middle_name, suffix, contact, region, province, city, brgy, sex, bday, occupation, allergy_to_vaccine, with_comorbidity";
          $table_val = "'$Category', '$sub_category', '$lastname', '$firstname', '$middlename', '$suffix', '$contact', '$region', '$province', '$city', '$brgy', '$gender', '$bday', '$occupation', '$allergy_to_vaccine', '$profile_comorbidity'"; 
          $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
        }

      }
    }


      // Has no allergy to food, egg, medicines, and no asthma?	* If with allergy or asthma, will the vaccinator able to monitor the patient for 30 minutes?	Has no history of bleeding disorders or currently taking anti-coagulants?	* if with bleeding history, is a gauge 23 - 25 syringe available for injection?	Does not manifest any of the following symptoms: Fever/chills, Headache, Cough, Colds, Sore throat,  Myalgia, Fatigue, Weakness, Loss of smell/taste, Diarrhea, Shortness of breath/ difficulty in breathing	* If manifesting any of the mentioned symptom/s, specify all that apply	Has no history of exposure to a confirmed or suspected COVID-19 case in the past 2 weeks?	Has not been previously treated for COVID-19 in the past 90 days?	Has not received any vaccine in the past 2 weeks?	Has not received convalescent plasma or monoclonal antibodies for COVID-19 in the past 90 days?	Not Pregnant?	* if pregnant, 2nd or 3rd Trimester?	Does not have any of the following: HIV, Cancer/ Malignancy, Underwent Transplant, Under Steroid Medication/ Treatment, Bed Ridden, terminal illness, less than 6 months prognosis	* If with mentioned condition/s, specify.	* If with mentioned condition, has presented medical clearance prior to vaccination day?
    ?>

    <!-- Main content -->
    <section class="content row col-12" >
        <div class="col-6 p-1">
          <div class="card col-12">
            <center><h3 style="color:rgb(89, 148, 84)">Category</h3></center>
            <table class="table table-bordered table-striped">
              <thead>
                <!-- <tr>
                    <th colspan="13" style="color: rgb(15, 130, 5)"><center><h5><b>1st Dose</b></h5></center></th>
                </tr> -->
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
                foreach($regestered as $data_ex){ ?>
                  <td><?php echo $data_ex; ?></td><?php 
                  
                  $total = $total + $data_ex; 
              } ?>
                <td><?php echo $total; ?></td>
              </tbody>
            </table>
            
          </div>
        </div>

        <div class="col-3 p-1">
          <div class="card col-12">
            <center><h3 style="color:rgb(89, 148, 84)">Consent</h3></center>
            <table class="table table-bordered table-striped">
              <thead>
                <!-- <tr>
                    <th colspan="13" style="color: rgb(15, 130, 5)"><center><h5><b>1st Dose</b></h5></center></th>
                </tr> -->
                <tr>
                  <th>Yes</th>
                  <th>No</th>
                  <th>Unknown</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody> <?php
              $total = 0;
                foreach($consent_data as $data){ ?>
                  <td><?php echo $data; ?></td><?php 
                  
                  $total = $total + $data; 
              } ?>
                <td><?php echo $total; ?></td>
              </tbody>
            </table>
          </div>
        </div>

        <div class="col-3 p-1">
          <div class="card col-12">
            <center><h3 style="color:rgb(89, 148, 84)">Comorbidity</h3></center>
            <table class="table table-bordered table-striped">
              <thead>
                <!-- <tr>
                    <th colspan="13" style="color: rgb(15, 130, 5)"><center><h5><b>1st Dose</b></h5></center></th>
                </tr> -->
                <tr>
                  <th>Yes</th>
                  <th>No</th>
                  <th>Unknown</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody> <?php
              $total = 0;
                foreach($comorbid_data as $data){ ?>
                  <td><?php echo $data; ?></td><?php 
                  
                  $total = $total + $data; 
              } ?>
                <td><?php echo $total; ?></td>
              </tbody>
            </table>
          </div>
        </div>
     
    </section>
    <!-- /.content -->

  <!-- /.content-wrapper -->

    <?php 
       include '../inc/confirmation_alerts.php';
        include '../inc/footer.php';
    ?>
    <script>
      // window.parent.location.href = "http://www.example.com"; 
    </script>
</body>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>