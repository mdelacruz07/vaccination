
<?php
  date_default_timezone_set('Asia/Manila');
  include '../../controller/systemcore.php'; 
  $systemcore = new systemcore();
  $System_Sessioning = $systemcore->System_Sessioning("session");
  include '../registrants/vims_settings.php'; 
  $VIMS_settings = new VIMS_settings();

  $id = $_GET['primary_id'];
  $id = explode("cut",$id);
  $facility_id = $id[0];
  $date_selected = $id[1];

  // echo $date_selected."<BR>".$facility_id;
  ?>

<section class="row">
          <div class="col-1">
            <p>
              <?php echo $date_selected;?><br>
              <?php echo $facility_id;?>
            </p>
          </div>
          <div class="col-11 card">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>Full Name</th>
                  <th>ADDRESS</th>
                  <th>EMAIL ADDRESS</th>
                  <th>DOB</th>
                  <th>Vaccine Name</th>
                  <th>Dose 1</th>
                  <th>Dose 2</th>
                </tr>
              </thead>
              <tbody> 
              <?php
                $SelectR = $systemcore->SelectCustomize("SELECT * FROM vims_report WHERE vaccination_date = '$date_selected' AND bakuna_center = '$facility_id'");
                foreach($SelectR as $value){ 
                  echo "<tr>";
                    echo "<td>".$value["lastname"]." ".$value["firstname"]." ".$value["middlename"]."</td>";
                    echo "<td>".$value["brgy"].", ".$value["city"]."</td>";
                    echo "<td>N/A</td>";
                    echo "<td>".$value["bday"]."</td>";
                    echo "<td>".$value["vaccine_name"]."</td>";
                    echo "<td>".$value["1st_dose"]."</td>";
                    echo "<td>".$value["2nd_dose"]."</td>";
                  echo "</tr>";
                }
                ?>
              </tbody>
            </table>
          </div>
      <!-- /.col -->
    <Br>
    <div class="divFooter col-12"  style="background-image: url('../../dist/img/checkerboard-pattern-green-seamless-background-vector-14423303.jpg'); background-size: 100px 100px;"> 
    <div class="divFooter col-12"> 
        <center><p>Bago City College | B.S. in Information System <br> © 2020 James Bryan Flandez. All Rights Reserved.</p></center>
    </div> 
    <!-- /.row -->
  </section>