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

        $SelectTablePartiallyVaccinated = "SELECT COUNT(*) as total
            FROM patient 
            WHERE LOWER(first_dose) = 'yes'
            AND (second_dose IS NULL OR LOWER(second_dose) != 'yes')
            AND is_archive = 0
        ";

        $result = $conn->query($SelectTablePartiallyVaccinated);
        $row = $result->fetch_assoc();
        $first_vaccinated_count = $row['total'];

        // ==========================================================================================

        // Count fully vaccinated
        $SelectTableFullyVaccinated = "SELECT * FROM patient WHERE LOWER(first_dose) LIKE '%yes%' AND LOWER(second_dose) LIKE '%yes%' AND is_archive = 0";
        $fully_vaccinated_res = $conn->query($SelectTableFullyVaccinated);
        $fully_vaccinated_count = $fully_vaccinated_res ? $fully_vaccinated_res->num_rows : 0;

        // ==========================================================================================

        // Vaccine Calendar Data with Vaccine Name
        $select_vac_dates = "SELECT 
                CONCAT(p.firstname, ' ', p.lastname) AS full_name,
                p.first_dose_date AS first_date_of_vaccination,
                p.second_dose_date AS second_date_of_vaccination,
                p.first_dose,
                p.second_dose,
                v.name
            FROM patient p
            LEFT JOIN vaccines v ON p.first_vaccine_id = v.id
            WHERE p.is_archive = 0
        ";

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
                'color' => $colorFirstDose,
                'vaccine' => $row["name"] ? $row["name"] : 'Vaccine not set',
            ];

            // Second dose event
            if (!empty($row["second_date_of_vaccination"])) {
                $events[] = [
                    'title' => $row["full_name"] . ' - (2nd Dose)',
                    'start' => $row["second_date_of_vaccination"],
                    'color' => $colorSecondDose,
                    'vaccine' => $row["name"] ? $row["name"] : 'Vaccine not set',
                ];
            }
        }

        $events_json = json_encode($events);

        // ==========================================================================================

        // Include connector and get chart data from PHP
        $line_chart_json = include 'get_vaccine_prediction_chart.php'; // returns JSON array

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
            /* flex: 0 0 33.33%;
            max-width: 32%; */
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

        .fc .tooltip {
            z-index: 9999 !important;
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
                        <div class="card-header d-flex justify-content-end">
                            <div class="card-header-tools">
                                <div class="dropdown dropleft">
                                    <button class="btn btn-link position-relative" type="button" id="notificationDropdown" data-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-bell-fill text-white" style="font-size: 24px;"></i>
                                        <span id="notificationCount" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">0</span>
                                    </button>
                                    <ul id="notificationList" class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown" style="width: 350px; max-height: 400px; overflow-y: auto;"></ul>
                                </div>
                            </div>
                        </div>

                        <div class="card-body row" style="padding: 30px 80px;">
                            <div id="vaccine_date_count" class="row mx-0 mb-3 w-100 justify-content-between">
                                <div class="d-flex w-100 align-items-center justify-content-around">
                                    <div class="col-4">
                                        <div class="row calendar_data_incidator my-4">
                                            <div class="col-6 d-flex mb-2">
                                                <div class="circle blue"></div> 
                                                <span>1st Dose</span>
                                            </div>

                                            <div class="col-6 d-flex mb-2">
                                                <div class="circle orange"></div>
                                                <span>2nd Dose</span>
                                            </div>

                                            <div class="col-6 d-flex mb-2">
                                                <div class="circle green"></div>
                                                <span>1st or 2nd Dose Done</span>
                                            </div>

                                            <div class="col-6 d-flex">
                                                <div class="circle red"></div>
                                                <span>No 1st or 2nd Dose</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="jumbotron mb-0 col-3">
                                        <div class="col-4">
                                            <span class="text-center d-block">
                                                <i class="bi bi-people-fill" style="font-size: 45px"></i>
                                            </span>
                                        </div>
                                        <div class="col-8">
                                            <span>Partially Vaccinated <br> <?= $first_vaccinated_count ?></span>  
                                        </div>
                                    </div>

                                    <div class="jumbotron mb-0 col-3">
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
    loadDashboardData();

    // Auto refresh every 30 seconds
    setInterval(loadDashboardData, 30000);
});

function loadDashboardData() {
    $.ajax({
        url: 'notification.php',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Update badge count
            $('#notificationCount').text(response.count);

            let html = '';
            html += '<li><h6 class="dropdown-header">Vaccination Reminders</h6></li>';
            html += '<li><hr class="dropdown-divider"></li>';

            if (response.notifications.length > 0) {

                response.notifications.forEach(function(notif) {

                    let today = new Date().toISOString().split('T')[0];
                    let badge = '';

                    if (notif.scheduled_date < today) {
                        badge = '<span class="badge bg-danger">Overdue</span>';
                    } else if (notif.scheduled_date === today) {
                        badge = '<span class="badge bg-warning text-dark">Today</span>';
                    } else {
                        badge = '<span class="badge bg-primary">Upcoming</span>';
                    }

                    html += `
                        <li>
                            <a class="dropdown-item small">
                                <div class="fw-bold">${notif.patient_name}</div>
                                <div>${notif.vaccine_name ? notif.vaccine_name : 'Vaccine not set'} (${notif.dose_type})</div>
                                <div class="d-flex justify-content-between mt-1">
                                    <small>${moment(notif.scheduled_date).format('MMM DD, YYYY')}</small>
                                    ${badge}
                                </div>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                    `;
                });

            } else {

                html += `
                    <li>
                        <div class="dropdown-item text-center text-muted">
                            No upcoming vaccination reminders
                        </div>
                    </li>
                `;
            }

            // html += `
            //     <li>
            //         <a class="dropdown-item text-center text-primary" href="notifications.php">
            //             View All
            //         </a>
            //     </li>
            // `;

            $('#notificationList').html(html);
        },
        error: function(xhr, status, error) {
            console.error('Error loading notifications:', error);
        }
    });
}

// ==========================================================================================
// Fullcalendar Start
var eventsFromPHP = <?php echo $events_json; ?>;

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('vaccine_calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: eventsFromPHP,
        dayMaxEvents: true,
        height: 700,
        buttonText: {
            today: 'Today',
            month: 'Month',
        },
        eventDidMount: function(info) {
            $(info.el).tooltip({
                title: info.event.extendedProps.vaccine,
                placement: 'top',
                trigger: 'hover',
                container: '.fc'
            });
        },
    });

    calendar.render();
});

// Fullcalendar End 
// ==========================================================================================
</script>