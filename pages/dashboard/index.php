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
        if(empty($_GET["page_name"])) {
            $system_page_name = "Dashboard";
        } else {
            $system_page_name = $_GET["page_name"];
        }

        $current_date = date("Y-m-d 00:00:00");
        $counter = 0;
        $SelectTable = $systemcore->SelectTable("patient WHERE created_date >= '$current_date'");

        foreach($SelectTable as $value) {
            $counter++;
        }

        // ==========================================================================================
        
        // Count vaccine list
        $vax_query = "SELECT * FROM vaccines WHERE is_archive = '0'";
        $vax_result = $conn->query($vax_query);
        $vax_count = $vax_result ? $vax_result->num_rows : 0;

        // ==========================================================================================

        // Count facilities
        $SelectTablefacilities = "SELECT * FROM system_facilities WHERE status = 'active'";
        $result = $conn->query($SelectTablefacilities);
        $facility_count = $result ? $result->num_rows : 0;

        // ==========================================================================================

        // Count fully vaccinated
        $SelectTableFullyVaccinated = "SELECT * FROM patient WHERE LOWER(first_dose) LIKE '%yes%' AND LOWER(second_dose) LIKE '%yes%' AND is_archive = 0";
        $fully_vaccinated_res = $conn->query($SelectTableFullyVaccinated);
        $fully_vaccinated_count = $fully_vaccinated_res ? $fully_vaccinated_res->num_rows : 0;

        // ==========================================================================================

        // Vaccince Calendar Data
        $select_vac_dates = "SELECT CONCAT(firstname, ' ', lastname) AS full_name, first_dose_date AS first_date_of_vaccination, second_dose_date AS second_date_of_vaccination, first_dose, second_dose FROM patient WHERE is_archive = 0";
        $result_vac_dates = $conn->query($select_vac_dates);

        $events = [];

        while ($row = $result_vac_dates->fetch_assoc()) {
            $dose1 = strtolower(trim($row["first_dose"]));
            $dose2 = strtolower(trim($row["second_dose"]));
            
            // Determine color for dose 1
            if ($dose1 == 'yes') {
                $colorFirstDose = 'green';
            } elseif (!empty($row["first_date_of_vaccination"]) && strtotime($row["first_date_of_vaccination"]) < time()) {
                $colorFirstDose = '#fa003f'; // red - vaccination date exceeded
            } else {
                $colorFirstDose = '#3498db'; // blue
            }

            // Determine color for dose 2
            if ($dose2 == 'yes') {
                $colorSecondDose = 'green';
            } elseif (!empty($row["second_date_of_vaccination"]) && strtotime($row["second_date_of_vaccination"]) < time()) {
                $colorSecondDose = '#fa003f'; // red - vaccination date exceeded
            } else {
                $colorSecondDose = '#f39c12'; // orange
            }

            // First dose event
            $events[] = [
                'title' => $row["full_name"] . ' - (1st Dose)',
                'start' => $row["first_date_of_vaccination"],
                'color' => $colorFirstDose
            ];

            // Second dose event (if available)
            if (!empty($row["second_date_of_vaccination"])) {
                $events[] = [
                    'title' => $row["full_name"] . ' - (2nd Dose)',
                    'start' => $row["second_date_of_vaccination"],
                    'color' => $colorSecondDose
                ];
            }
        }

        $events_json = json_encode($events);

        // ==========================================================================================

        /**
         * Vaccine Balance for Doughnut Chart
         */
        $query_vaccine = "SELECT v.id, v.name,
            (IFNULL(SUM(DISTINCT vr.total_in), 0) - IFNULL(SUM(DISTINCT vi.total_out), 0)) AS balance
            FROM vaccines v
            LEFT JOIN (SELECT vaccine_id, SUM(quantity) AS total_in FROM vaccine_receive WHERE is_archive = 0 GROUP BY vaccine_id) vr ON vr.vaccine_id = v.id
            LEFT JOIN (SELECT vaccine_id, SUM(quantity) AS total_out FROM vaccine_issuance WHERE is_archive = 0 GROUP BY vaccine_id) vi ON vi.vaccine_id = v.id
            WHERE v.is_archive = 0
            GROUP BY v.id
            HAVING balance > 0
            ORDER BY v.name ASC
        ";

        $vax_list = $conn->query($query_vaccine);

        $vax_donut_labels = [];
        $vax_donut_data = [];

        if ($vax_list && $vax_list->num_rows > 0) {
            while ($row = $vax_list->fetch_object()) {
                $vax_donut_labels[] = $row->name;
                $vax_donut_data[] = (int)$row->balance;
            }
        }

        // ==========================================================================================

        // Vertical Bar Chart Data
        $query_vaccine = "SELECT v.id, v.name AS Vaccine_name, IFNULL(vr.total_in, 0) AS total_in, IFNULL(vi.total_out, 0) AS total_out, (IFNULL(vr.total_in, 0) - IFNULL(vi.total_out, 0)) AS balance
            FROM vaccines v
            LEFT JOIN (
                SELECT vaccine_id, SUM(quantity) AS total_in
                FROM vaccine_receive
                WHERE is_archive = 0
                GROUP BY vaccine_id
            ) vr ON vr.vaccine_id = v.id
            LEFT JOIN (
                SELECT vaccine_id, SUM(quantity) AS total_out
                FROM vaccine_issuance
                WHERE is_archive = 0
                GROUP BY vaccine_id
            ) vi ON vi.vaccine_id = v.id
            WHERE v.is_archive = 0
            HAVING balance > 0
            ORDER BY v.name ASC";

        $vax_list = $conn->query($query_vaccine);

        $vax_ver_bar_labels = [];
        $vax_ver_bar_data = [];

        $vax_in = [];
        $vax_out = [];
        $vax_balance = [];
        $vax_rows = []; // full rows with Vaccine_name, balance, In, Out

        if ($vax_list && $vax_list->num_rows > 0) {
            while ($row = $vax_list->fetch_object()) {
                $name = $row->Vaccine_name;
                $balance = (int)$row->balance;
                $in = (int)$row->total_in;
                $out = (int)$row->total_out;

                $vax_ver_bar_labels[] = $name;
                $vax_ver_bar_data[] = $balance;

                $vax_in[] = $in;
                $vax_out[] = $out;
                $vax_balance[] = $balance;

                $vax_rows[] = [
                    'Vaccine_name' => $name,
                    'balance' => $balance,
                    'In' => $in,
                    'Out' => $out
                ];
            }
        }
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
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>System <?php echo $system_page_name; ?></h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title col-lg-10" style="padding-top:10px; "><b>Dashboard</b></h2>
                            <p class="card-title col-lg-2" style="padding-top:10px; font-size:15px;"><b>Local LINK! : <?php echo gethostbyname(php_uname('n')); ?>/VIMS</b></p>
                        </div>

                        <div class="card-body row" style="padding: 30px 80px;">
                            <div id="vaccine_date_count" class="row mx-0 mb-5 w-100 justify-content-between">
                                <div class="jumbotron">
                                    <div class="col-4">
                                        <span class="text-center d-block">
                                            <i class="bi bi-card-checklist" style="font-size: 45px"></i>
                                        </span>
                                    </div>

                                    <div class="col-8">
                                        <span>Vaccine Listed <br> <?= $vax_count ?></span>                          
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

                            <div style="width:200px;">
                                <!-- <input type="text" id="year_filter" class="form-control" placeholder="Select Year">
                                <button id="filterBtn" class="btn btn-primary mt-2">Filter</button> -->

                                <input type="text" id="year_filter" class="form-control" placeholder="Select Year">
                            </div>

                            <div id="charts_container" class="charts_container w-100">
                                <div class="d-flex justify-content-between">
                                    <div class="col-6">
                                        <div class="doughnut" style="height: 500px;">
                                            <canvas id="myDoughnutChart"></canvas>
                                        </div>
                                    </div>
                                    
                                    <div class="col-6">
                                        <div class="vertical_bar" style="height: 500px;">
                                            <canvas id="myVerticalBarChart" height="500" width="500"></canvas>
                                        </div>
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

                            <div class="col-12 mb-5">
                                <div id="vaccine_calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php 
            include '../inc/confirmation_alerts.php';
            include '../inc/footer.php';
        ?>
    </body>
</html>

<script type="text/javascript" src="../../dist/js/fullcalendar/index.global.js"></script>

<script> 
$(document).ready(function() {
    // Load initial chart data
    loadChart();

    // Year filter button click event
    $('#filterBtn').on('click', function() {
        let year = $("#year_filter").val();
        loadChart(year);
    });

    $("#year_filter").on("change", function(){
        loadChart($(this).val());
    });
});

// ==========================================================================================

// ==========================================================================================

// ==========================================================================================
// Fullcalendar Start
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
        right: ''
      },
      height: 700,
      buttonText: {
          today: 'Today',
          month: 'Month',
          // week: 'Week', // Weekly view
          // list: 'List'
      },
      theme: true
  });

  calendar.render();
});

// Fullcalendar End 
// ==========================================================================================

// ==========================================================================================
// Doughnut Chart Start
// const ctx = document.getElementById('myDoughnutChart');

// const vaccineLabels = <?= json_encode($vax_donut_labels); ?>;
// const vaccineData   = <?= json_encode($vax_donut_data); ?>;

// new Chart(ctx, {
//     type: 'doughnut',
//     data: {
//         labels: vaccineLabels,
//         datasets: [{
//             label: 'Vaccine Balance',
//             data: vaccineData,
//             backgroundColor: [
//                 '#4CAF50',
//                 '#2196F3',
//                 '#FFC107',
//                 '#E91E63',
//                 '#9C27B0',
//                 '#00BCD4',
//                 '#FF5722',
//                 '#8BC34A'
//             ],
//             borderWidth: 1
//         }]
//     },
//     options: {
//         responsive: true,
//         maintainAspectRatio: false,
//         plugins: {
//             legend: {
//                 position: 'bottom'
//             },
//             tooltip: {
//                 callbacks: {
//                     label: function(context) {
//                         return context.label + ': ' + context.raw + ' doses';
//                     }
//                 }
//             }
//         }
//     }
// });
const ctx = document.getElementById('myDoughnutChart');

let myDoughnutChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: [],
        datasets: [{
            label: 'Vaccine Balance',
            data: [],
            backgroundColor: [
                '#4CAF50','#2196F3','#FFC107','#E91E63',
                '#9C27B0','#00BCD4','#FF5722','#8BC34A'
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { position: 'bottom' },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.label + ': ' + context.raw + ' doses';
                    }
                }
            }
        }
    }
});

// year filter for charts
$("#year_filter").datepicker({
    changeYear: true,
    showButtonPanel: true,
    dateFormat: 'yy',
    onClose: function(dateText, inst) {
        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
        $(this).val(year);
    },
    beforeShow: function(input, inst) {
        $(".ui-datepicker-calendar").hide();
    }
});

function loadChart(year = '') {

    $.ajax({
        url: "get_vaccine_donut_chart.php",
        type: "POST",
        data: { year: year },
        dataType: "json",
        success: function(response) {

            myDoughnutChart.data.labels = response.labels;
            myDoughnutChart.data.datasets[0].data = response.data;

            myDoughnutChart.update();
        }
    });

}
// Doughnut Chart End
// ==========================================================================================

// ==========================================================================================
// Vertical Bar Chart Start
const labels = <?= json_encode($vax_ver_bar_labels); ?>;
const totalIn = <?= json_encode($vax_in); ?>;
const totalOut = <?= json_encode($vax_out); ?>;
const totalBalance = <?= json_encode($vax_balance); ?>;

const ctx_ver_bar = document.getElementById('myVerticalBarChart');

new Chart(ctx_ver_bar, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [
            {
                label: 'IN',
                data: <?= json_encode($vax_in); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.6)', // blue
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            },
            {
                label: 'OUT',
                data: <?= json_encode($vax_out); ?>,
                backgroundColor: 'rgba(255, 99, 132, 0.6)', // red
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            },
            {
                label: 'BALANCE',
                data: <?= json_encode($vax_balance); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.6)', // green
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top'
            },
            title: {
                display: true,
                text: 'Vaccine Stock Movement'
            }
        },
        scales: {
            x: {
                grid: {
                    color: 'rgba(0,0,0,0.1)'
                }
            },
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0,0,0,0.1)'
                }
            }
        }
    }
});
// Vertical Bar Chart End
</script>