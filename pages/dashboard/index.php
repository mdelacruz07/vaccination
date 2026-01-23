<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
<?php
include '../../database/connector.php';
include '../../controller/systemcore.php'; 
$systemcore = new systemcore();
$System_Sessioning = $systemcore->System_Sessioning("session");
include '../inc/header.php';
// include '../inc/navbar.php';

include '../registrants/vims_settings.php'; 
$VIMS_settings = new VIMS_settings();

//Page Credetials!!!
if(empty($_GET["page_name"])){
  $system_page_name = "Dashboard";
}else{
  $system_page_name = $_GET["page_name"];
}
$current_date = date("Y-m-d 00:00:00");
$counter = 0;
$SelectTable = $systemcore->SelectTable("local_data_fetcher WHERE date_added >= '$current_date'");
foreach($SelectTable as $value){
  $counter++;
}

// Count vaccine list
$global_vaccine_name_count = count($VIMS_settings->Global_vaccine_name());

// Count facilities
$SelectTablefacilities = "SELECT * FROM system_facilities WHERE status = 'active'";
$result = $conn->query($SelectTablefacilities);
$facility_count = $result ? $result->num_rows : 0;

// Count fully vaccinated
$SelectTableFullyVaccinated = "SELECT * FROM local_data_fetcher WHERE LOWER(dose_1) LIKE '%yes%' AND LOWER(dose_2) LIKE '%yes%'";
$fully_vaccinated_res = $conn->query($SelectTableFullyVaccinated);
$fully_vaccinated_count = $fully_vaccinated_res ? $fully_vaccinated_res->num_rows : 0;

?>
<style>
  .circle {
    width: 20px;
    height: 20px;
    background-color: #3498db;
    border-radius: 50%;
    margin: 0 10px 0 0;
  }
  .circle.blue { background-color: #3498db; }
  .circle.orange { background-color: #f39c12; }
  .circle.green { background-color: #008000; }
  .circle.red { background-color: #fa003f; }
  .calendar_data_incidator .col-12 {
    display: flex;
    align-items: center;
    justify-content: start;
  }

  #vaccine_date_count .jumbotron {
    flex: 0 0 33.33%;
    max-width: 32%;
    display: flex;
    align-items: center;
    margin: 0 0 20px 0;
    padding: 25px 0;
    box-shadow: 0 3px 10px rgb(0 0 0 / 0.2);
  }

  #vaccine_date_count .jumbotron span {
    font-size: 22px;
    font-weight: 600;
  }

  #vaccine_calendar .fc-event-title-container {
    padding: 0 8px;
  }

  #vaccine_calendar .fc-event-title {
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 0.5px;
  }
</style>
<body class="pages_body">
  <!-- Content Wrapper. Contains page content -->
  <!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>System <?php echo $system_page_name; ?></h1>
            
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
              <h2 class="card-title col-lg-10" style="padding-top:10px; "><b>Dashboard</b></h2>
              <p class="card-title col-lg-2" style="padding-top:10px; font-size:15px;"><b>Local LINK! : <?php echo gethostbyname(php_uname('n')); ?>/VIMS</b></p>
            </div>
            <!-- /.card-header -->
            <div class="card-body row" style="padding: 30px 80px;">
              <div id="vaccine_date_count" class="row m-0 w-100 justify-content-between">
                  <div class="jumbotron">
                      <div class="col-4">
                        <span class="text-center d-block">
                          <i class="bi bi-card-checklist" style="font-size: 45px"></i>
                        </span>
                      </div>
                      <div class="col-8">
                          <span>Vaccine Listed <br> <?= $global_vaccine_name_count ?></span>
                          
                      </div>
                  </div>

                  <div class="jumbotron">
                      <div class="col-4">
                        <span class="text-center d-block">
                          <i class="bi bi-hospital" style="font-size: 45px"></i>
                        </span>
                      </div>
                      <div class="col-8">
                          <span>Facility <br> <?= $facility_count ?></span>  
                      </div>
                  </div>

                  <div class="jumbotron">
                      <div class="col-4">
                        <span class="text-center d-block">
                          <i class="bi bi-people-fill" style="font-size: 45px"></i>
                        </span>
                      </div>
                      <div class="col-8">
                          <span>Fully Vaccinated <br> <?= $fully_vaccinated_count ?></span>  
                      </div>
                  </div>
              </div>
              
              <div class="row calendar_data_incidator my-4">
                <div class="col-12 mb-2">
                  <div class="circle blue"></div> 
                  <span>1st Dose</span>
                </div>

                <div class="col-12 mb-2">
                  <div class="circle orange"></div>
                  <span>2nd Dose</span>
                </div>

                <div class="col-12 mb-2">
                  <div class="circle green"></div>
                  <span>1st or 2nd Dose Done</span>
                </div>

                <div class="col-12">
                  <div class="circle red"></div>
                  <span>No 1st or 2nd Dose</span>
                </div>
              </div>

              <div class="col-12">
                <!-- <center>
                  <h1 style="font-size:140px;"><?php //echo $counter;?></h1>
                  <h6>Encoded for Today <?php //echo date("Y-m-d");?></h6>
                </center> -->

                <div id="vaccine_calendar">

                </div>

                <!-- <img src="../../dist/img/resbakuna.jpg" alt="Girl in a jacket" width="100%" height="100%"> -->
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
<?php 
include '../inc/confirmation_alerts.php';
include '../inc/footer.php';
?>
<script>
  show_table('tab', 'show_schedule_dashboard', '#example1', '1,<?php echo date('m');?>,<?php echo date('Y');?>, ');
</script>

<!-- Fullcalendar Start -->
<script type="text/javascript" src="../../dist/js/fullcalendar/index.global.js"></script>

<?php 
  // Vaccince Calendar Data
  $select_vac_dates = "SELECT CONCAT(firstname, ' ', lastname) AS full_name, time_stamp AS first_date_of_vaccination, sec_date_of_vaccination, dose_1, dose_2 FROM local_data_fetcher";
  $result_vac_dates = $conn->query($select_vac_dates);

  $events = [];

  while ($row = $result_vac_dates->fetch_assoc()) {
    $dose1 = strtolower(trim($row["dose_1"]));
    $dose2 = strtolower(trim($row["dose_2"]));
    
    // Determine color for dose 1
    if (stripos($dose1, 'yes') !== false) {
      $colorFirstDose = 'green';
    } elseif (stripos($dose1, 'no') !== false) {
      $colorFirstDose = '#fa003f';
    } else {
      $colorFirstDose = '#3498db'; // blue
    }

    // Determine color for dose 2
    if (stripos($dose2, 'yes') !== false) {
      $colorSecondDose = 'green';
    } elseif (stripos($dose2, 'no') !== false) {
      $colorSecondDose = '#fa003f';
    } else {
      $colorSecondDose = '#f39c12'; // orange
    }

    // First dose event
    $events[] = [
      'title' => $row["full_name"],
      'start' => $row["first_date_of_vaccination"],
      'color' => $colorFirstDose
    ];

    // Second dose event (if available)
    if (!empty($row["sec_date_of_vaccination"])) {
      $events[] = [
        'title' => $row["full_name"],
        'start' => $row["sec_date_of_vaccination"],
        'color' => $colorSecondDose
      ];
    }
  }

  $events_json = json_encode($events);
?>

<script> 
 var eventsFromPHP = <?php echo $events_json; ?>;

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('vaccine_calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      events: eventsFromPHP,
      dayMaxEvents: true,
      headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          // right: 'dayGridMonth,timeGridWeek,listWeek' //Weekly view
        right: 'dayGridMonth,listWeek'
      },
      height: 700,
      buttonText: {
          today: 'Today',
          month: 'Month',
          // week: 'Week', // Weekly view
          list: 'List'
      },
      theme: true
    });

    calendar.render();
  });
</script>

<!-- Fullcalendar End -->
</body>
</html>