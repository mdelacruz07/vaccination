
<?php
// error_reporting(E_ERROR | E_PARSE);
set_time_limit(0); // 
// error_reporting(0);

  $id = $_GET['primary_id'];
  $id = explode("cut",$id);
  $facility_id = $id[0];
  $facility_id = strtoupper($facility_id);
  $date_selected = $id[1];

  if($facility_id == "none" || $facility_id == " " || $facility_id == "ALL"){
    $f_query = "";
    $f_query_1 = "";
    $f_query_2 = "";
  }else{
    $f_query = " AND facility_id = '$facility_id'";
    $f_query_1 = " AND vaccine_registration.facility_id = '$facility_id'";
    $f_query_2 = " AND bakuna_center = '$facility_id'";
  }

  date_default_timezone_set('Asia/Manila');
  include '../../controller/systemcore.php'; 
  $systemcore = new systemcore();
  $System_Sessioning = $systemcore->System_Sessioning("session");
  include '../registrants/vims_settings.php'; 
  $VIMS_settings = new VIMS_settings();

  $Global_category_array = $VIMS_settings->Global_category_array();
  $Global_vaccine_name = $VIMS_settings->Global_vaccine_name();
  $Global_regions = $VIMS_settings->Global_regions();
  $Global_jun12_province = $VIMS_settings->Global_jun12_province();
  $Global_jun12_city = $VIMS_settings->Global_jun12_city();

  array_push($Global_category_array, "N/A");
  array_push($Global_vaccine_name, "N/A");

  $vaccines_1st = array();
  $vaccines_2nd = array();
  $booster = array();

  foreach($Global_vaccine_name as $vaccines){
    // array_push($vaccines_cardinal, $vaccines);

    foreach($Global_category_array as $category){
      array_push($vaccines_1st, 0);
    }
    foreach($Global_category_array as $category){
      array_push($vaccines_2nd, 0);
    }
    foreach($Global_category_array as $category){
      array_push($booster, 0);
    }

  }

  //New VIMS-VAS june 12
  $newregion = array("REGION I (ILOCOS REGION)", "REGION II (CAGAYAN VALLEY)", "REGION III (CENTRAL LUZON)", "REGION IV-A (CALABARZON)", "REGION V (BICOL REGION)", "REGION VI (WESTERN VISAYAS)", "REGION VII (CENTRAL VISAYAS)", "REGION VIII (EASTERN VISAYAS)", "REGION IX (ZAMBOANGA PENINSULA)", "REGION X (NORTHERN MINDANAO)", "REGION XI (DAVAO REGION)", "REGION XII (SOCCSKSARGEN)", "NATIONAL CAPITAL REGION (NCR)", "CORDILLERA ADMINISTRATIVE REGION (CAR)", "AUTONOMOUS REGION IN MUSLIM MINDANAO (ARMM)", "REGION XIII (CARAGA)", "REGION IV-B (MIMAROPA)");

  $current_date = date("Y-m-d");
  $SelectGroups = $systemcore->DeleteTable("vims_vas_12", "vaccination_date = '$date_selected' $f_query_2");
  $SelectTable = $systemcore->SelectCustomize("SELECT * FROM local_data_fetcher WHERE time_stamp = '$date_selected' $f_query");
  // $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_registration WHERE dose_2 = '01_Yes'");
  foreach($SelectTable as $data){ 
    $qr_id = "BAGOCITY".$data["id"];
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
    
    $guardian = $data["guardian"];                         if(strlen($guardian) <= 1){ $guardian="N/A"; };
    $ped_comorbid = $data["ped_comorbid"];                 if(strlen($ped_comorbid) <= 1){ $ped_comorbid="N/A"; };
    
    if($Category == "13_C: Rest of Pediatric Population"){
      $Category = "13_C: Rest of Pediatric Population(12-17 years old)";
    }

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
    $booster_raw = $data["booster"];
    $agency = $data["agency"];
    $occupation = $data["ocupation"];

    $bakuna_center = $data["facility_id"];

    // echo $vaccine_name."===".$Category."====".$dose_1."===".$dose_2."=====".$XXXX."<br>";

    $up_count = 0;
    $do_count = 0;
    $bo_count = 0;
    foreach($Global_vaccine_name as $vaccines){
      foreach($Global_category_array as $category12){
        // echo $vaccines." == ".$vaccine_name." && ".$category12." == ".$Category." && ".$dose_1." == 01_Yes <br>";
        if($vaccines == $vaccine_name && $category12 == $Category && $dose_1 == "01_Yes"){
          $vaccines_1st[$up_count]++;
        }

        if($vaccines == $vaccine_name && $category12 == $Category && $dose_1 != "01_Yes"){
          echo $lastname."--".$firstname."--".$middlename;
        }
        $up_count++;
      }
      foreach($Global_category_array as $category12){
        // echo $vaccines." == ".$vaccine_name." && ".$category12." == ".$Category." && ".$dose_2." == 01_Yes <br>";
        if($vaccines == $vaccine_name && $category12 == $Category && $dose_2 == "01_Yes"){
          $vaccines_2nd[$do_count]++;
          if($vaccines == $vaccine_name && $category12 == $Category && $dose_1 == "01_Yes"){
            $vaccines_1st[$do_count]--;//this function remove the person on the 1st dose report if he or she has recieve the 2nd dose
          }
          
        }
        $do_count++;
      }
      foreach($Global_category_array as $category12){
        // echo $vaccines." == ".$vaccine_name." && ".$category12." == ".$Category." && ".$dose_2." == 01_Yes <br>";
        if($vaccines == $vaccine_name && $category12 == $Category && $booster_raw == "01_Yes"){
          $booster[$bo_count]++;
          if($vaccines == $vaccine_name && $category12 == $Category && $booster_raw == "01_Yes"){
            $vaccines_2nd[$bo_count]--;//this function remove the person on the 1st dose report if he or she has recieve the 2nd dose
          }
          
        }
        $bo_count++;
      }
    }
    $data_with_no_doses = 0;
    $data_with_no_brgy = 0;
    $data_with_no_category = 0;
    //ERORR CHECKER
    if($dose_1 == "02_No" && $dose_2 == "02_No"){
      $data_with_no_doses++;
    }
    if($brgy == "" || $brgy == "N/A"){
      $data_with_no_brgy++;
    }
    if($Category == "" || $Category == "N/A"){
      $data_with_no_category++;
    }
    //NEW VIMS_VAS!!

      if($gender == "01_Female"){
        $gender = "F";
      }else{
        $gender = "M";
      }

      if($dose_1 == "01_Yes"){
        $dose_1 = "Y";
      }else{
        $dose_1 = "N";
      }
      if($dose_2 == "01_Yes"){
        $dose_2 = "Y";
        $dose_1 = "N";
      }else{
        $dose_2 = "N";
      }
      if($defferal == "02_No" || $defferal == "N/A"){
        $reason_for_deferral = "N";
        $defferal = "N";
      }else{
        $reason_for_deferral = $defferal;
        $defferal = "Y";
      }

      $indigenous = $data["indigenous"];
      if($indigenous == "02_No"){
        $indigenous = "N";
      }else{
        $indigenous = "Y";
      }
      $adverse_event = $data["adverse_event"];
        if($adverse_event == "01_Yes"){
          $adverse_event = "Y";
        }else{
          $adverse_event = "N";
        }
      $adverse_event_cons = $data["adverse_event_cons"];
      if($adverse_event_cons == "02_No"){
        $adverse_event_cons = "N";
      }

      $pwd = $data["pwd"];
        if($pwd == "01_Yes"){
          $pwd = "Y";
        }else{
          $pwd = "N";
        }

        //Region
      $nm = 0;
      $region1 = "";
      foreach($Global_regions as $old_region){
        $regionraw = str_replace(' ', '', $region);
        $regionraw = preg_replace('/[^\p{L}\p{N}\s]/u', '', $regionraw);
        $regionraw = preg_replace('/[0-9]+/', '', $regionraw);

        $old_regionraw = str_replace(' ', '', $old_region);
        $old_regionraw = preg_replace('/[^\p{L}\p{N}\s]/u', '', $old_regionraw);
        $old_regionraw = preg_replace('/[0-9]+/', '', $old_regionraw);
        if($old_regionraw == $regionraw){
          $region1 = $newregion[$nm];
        }
        $nm++;
      }

      //Province
      $province = preg_replace('/[^\p{L}\p{N}\s]/u', '', $province);
      $province = preg_replace("/[^0-9]/", "", $province);
    
      foreach($Global_jun12_province as $new_province){

        if(mb_substr($new_province, 0, 4) == $province){
          // echo mb_substr($new_province, 0, 4)." == ".$province."<br>";
          $province = $new_province;
        }
      }

      //City
      $city = preg_replace('/[^\p{L}\p{N}\s]/u', '', $city);
      $city = preg_replace("/[^0-9]/", "", $city);
      
      if(strlen($city) == "5" ){
        $city = "0".$city;
      }
      foreach($Global_jun12_city as $new_city){

        if(mb_substr($new_city, 0, 6) == $city){
          // echo mb_substr($new_province, 0, 4)." == ".$province."<br>";
          $city = $new_city;
        }
      }
      //brgy
      $brgy = preg_replace('/[^\p{L}\p{N}\s]/u', ' ', $brgy);
      $brgy = preg_replace('/[0-9]+/', '', $brgy);

      //Cat /// CHANGE of The category changes!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      if($Category == "01_A1: Health Care Workers"){
        $Category = "A1";
      }else if($Category == "01_A1.8: Outbound OFWS"){
        $Category = "A1.8";
      }else if($Category == "01_A1.9: Family Members of Healthcare Workers"){
        $Category = "A1.9";
      }else if($Category == "01_Additional_A1: All Adult Population Eligible to be Categorized as Priority Group A1"){
        $Category = "Additional A1";
      }else if($Category == "02_A2: Senior Citizens"){
        $Category = "A2";
      }else if($Category == "03_A3: Adult with Comorbidity"){
        $Category = "A3";
      }else if($Category == "03_Expanded_A3: Pregnant women"){
        $Category = "Expanded A3";
      }else if($Category == "03_Pediatric_A3: 12-17 year old with co-morbidity"){
        $Category = "Pediatric A3(12-17 years old)";
      }else if($Category == "03_Pediatric_A3: 5-11 year old with co-morbidity"){
        $Category = "Pediatric A3(5-11 years old)";
      }else if($Category == "04_A4: Frontline Personnel in Essential Sector"){
        $Category = "A4";
      }else if($Category == "05_A5: Poor Population"){
        $Category = "A5";
      }else if($Category == "12_C: Rest of Adult Population"){
        $Category = "ROAP";
      }else if($Category == "13_C: Rest of Pediatric Population(12-17 years old)" || $Category == "13_C: Rest of Pediatric Population"){
        $Category = "ROPP(12-17 years old)";
      }else if($Category == "13_C: Rest of Pediatric Population(5-11 years old)"){
        $Category = "ROPP(5-11 years old)";
      }else{
        $Category = "ROAP";
      }
      
    $table = "vims_vas_12";
    $table_col = "`category`, `unique_id`, `pwd_id`, `indigenous`, `lastname`, `firstname`, `middlename`, `suffix`, `contact`, `region`, `province`, `city`, `brgy`, `gender`, `bday`, `deferral`, `reason_for_deferral`, `vaccination_date`, `vaccine_name`, `batch_number`, `lot_number`, `bakuna_center`, `vaccinator_name`, `1st_dose`, `2nd_dose`, `adverse_event`, `adverse_event_condition`, `guardian`, `ped_comorbid`, `booster`";
    $table_val = "'$Category', '$qr_id', '$pwd', '$indigenous', '$lastname', '$firstname', '$middlename', '$suffix', '$contact', '$region1', '$province', '$city', '$brgy', '$gender', '$bday', '$defferal', '$reason_for_deferral', '$time_stamp', '$vaccine_name', '$batch_number', '$lot_number', '$bakuna_center', '$vaccinator_name', '$dose_1', '$dose_2', '$adverse_event', '$adverse_event_cons', '$guardian', '$ped_comorbid', '$booster_raw'"; 
    $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
  }
  $up_count = 0;
  $do_count = 0;
  $start = 0;
  $skip = count($Global_category_array); ?>
<body>
<section class="content-header col-12">
  <div class="container-fluid col-12">
    <div class="row mb-2">
      <div class="col-7">
      </div>
      <div class="col-1">
        <button class="btn btn-outline-info col-12" id="printPageButton" onclick="Printer()">Print</button>
      </div>
      <div class="col-2">
        <a class="btn btn-block btn-outline-secondary printPageelements" href="download_vims_vas.php?selected_date=<?php echo $date_selected;?>&facility_id=<?php echo $facility_id?>" target="_blank">Download VIMS-VAS Excel File</a>
      </div>
      <div class="col-2">
        <a class="btn btn-block btn-outline-secondary printPageelements" href="download_vims_vas_ped.php?selected_date=<?php echo $date_selected;?>&facility_id=<?php echo $facility_id?>" target="_blank">Download VIMS-VAS-PEDIA Excel File</a>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>
    
  
    <div class="col-12">
      <center>
        <h1>VIMS-VAS</h1>
        <h5>Daily Data Allocation <?php echo $date_selected;?><br><?php echo $facility_id;?></h5>
      </center>
    </div>

  <?php

foreach($Global_vaccine_name as $vaccine){
  $print_hide = "";
  if($vaccine == "N/A"){
    $print_hide = "printPageelements";
  } ?>
  
  <div class="col-12 col-md-12<?php echo $print_hide; ?> page" >
    <div class="card col-12">
      
      <center><h3 style="color:rgb(89, 148, 84)"><?php echo $vaccine;?></h3></center>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
              <th colspan="17" style="color: rgb(15, 130, 5)"><center><h5><b>1st Dose</b></h5></center></th>
          </tr>
          <tr>
              <th>A1</th>
              <th>A1.8</th>
              <th>A1.9</th>
              <th>Additional A1</th>
              <th>A2</th>
              <th>A3</th>
              <th><span style="font-size:12px;">Expanded</span><br>A3</th>
              <th><span style="font-size:12px;">Pediatric</span><br>A3(12-17 yrs old)</th>
              <th><span style="font-size:12px;">Pediatric</span><br>A3(5-11 yrs old)</th>
              <th>A4</th>
              <th>A5</th>
              <!-- <th>B1</th>
              <th>B2</th>
              <th>B3</th>
              <th>B4</th>
              <th>B5</th>
              <th>B6</th>
              <th>C</th> -->
              <th>ROAP</th>
              <th>ROPP(12-17 yrs old)</th>
              <th>ROPP(5-11 yrs old)</th>
              <th>N/A</th>
              <th>Total</th>
          </tr>
        </thead>
        <tbody> <?php
        $total = 0;
          for($x = $start; $x < $skip; $x++){ ?>
            <td><?php echo $vaccines_1st[$x]; ?></td><?php $total = $total + $vaccines_1st[$x]; 
          } ?>
            <td><?php echo $total; ?></td>
        </tbody>
      </table>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th colspan="17" style="color: rgb(15, 130, 5)"><center><h5><b>2nd Dose</b></h5></center></th>
          </tr>
          <tr>
              <th>A1</th>
              <th>A1.8</th>
              <th>A1.9</th>
              <th>Additional A1</th>
              <th>A2</th>
              <th>A3</th>
              <th><span style="font-size:12px;">Expanded</span><br>A3</th>
              <th><span style="font-size:12px;">Pediatric</span><br>A3(12-17 yrs old)</th>
              <th><span style="font-size:12px;">Pediatric</span><br>A3(5-11 yrs old)</th>
              <th>A4</th>
              <th>A5</th>
              <!-- <th>B1</th>
              <th>B2</th>
              <th>B3</th>
              <th>B4</th>
              <th>B5</th>
              <th>B6</th>
              <th>C</th> -->
              <th>ROAP</th>
              <th>ROPP(12-17 yrs old)</th>
              <th>ROPP(5-11 yrs old)</th>
              <th>N/A</th>
              <th>Total</th>
          </tr>
        </thead>
        <tbody> <?php
          $total = 0;
          for($x = $start; $x < $skip; $x++){ ?>
            <td><?php echo $vaccines_2nd[$x]; ?></td> <?php $total = $total + $vaccines_2nd[$x]; 
          } ?>
            <td><?php echo $total; ?></td>
        </tbody>
      </table>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th colspan="17" style="color: rgb(15, 130, 5)"><center><h5><b>Booster Doses</b></h5></center></th>
          </tr>
          <tr>
              <th>A1</th>
              <th>A1.8</th>
              <th>A1.9</th>
              <th>Additional A1</th>
              <th>A2</th>
              <th>A3</th>
              <th><span style="font-size:12px;">Expanded</span><br>A3</th>
              <th><span style="font-size:12px;">Pediatric</span><br>A3(12-17 yrs old)</th>
              <th><span style="font-size:12px;">Pediatric</span><br>A3(5-11 yrs old)</th>
              <th>A4</th>
              <th>A5</th>
              <!-- <th>B1</th>
              <th>B2</th>
              <th>B3</th>
              <th>B4</th>
              <th>B5</th>
              <th>B6</th>
              <th>C</th> -->
              <th>ROAP</th>
              <th>ROPP(12-17 yrs old)</th>
              <th>ROPP(5-11 yrs old)</th>
              <th>N/A</th>
              <th>Total</th>
          </tr>
        </thead>
        <tbody> <?php
          $total = 0;
          for($x = $start; $x < $skip; $x++){ ?>
            <td><?php echo $booster[$x]; ?></td> <?php $total = $total + $booster[$x]; 
          } ?>
            <td><?php echo $total; ?></td>
        </tbody>
      </table>
    </div>
  </div> <?php  
    $start = $start + count($Global_category_array);
    $skip = $skip + count($Global_category_array);
  
} 

echo $data_with_no_doses;
echo $data_with_no_brgy;
echo $data_with_no_category;
?>
