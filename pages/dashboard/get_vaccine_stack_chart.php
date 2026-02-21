<?php
    include '../../database/connector.php';

$year = isset($_POST['year']) ? intval($_POST['year']) : '';

$where = "";
if (!empty($year)) {
    $where = "AND YEAR(vi.issued_date) = $year";
}

// Get all facilities
$facilityQuery = "SELECT id, facility_name FROM system_facilities WHERE status = 'active' ORDER BY facility_name";
$facilityRes = $conn->query($facilityQuery);

$facilities = [];
while ($row = $facilityRes->fetch_assoc()) {
    $facilities[] = $row['facility_name'];
}

// Get all vaccines
$vaccineQuery = "SELECT id, name FROM vaccines WHERE is_archive = 0 ORDER BY name";
$vaccineRes = $conn->query($vaccineQuery);

$vaccines = [];
while ($row = $vaccineRes->fetch_assoc()) {
    $vaccines[] = $row['name'];
}

// Get quantities grouped by facility + vaccine
$dataQuery = "
    SELECT 
        sf.facility_name,
        v.name as vaccine_name,
        SUM(vi.quantity) as total_quantity
    FROM vaccine_issuance vi
    JOIN system_facilities sf ON vi.issued_to = sf.id
    JOIN vaccines v ON vi.vaccine_id = v.id
    WHERE 1=1 $where
    GROUP BY sf.facility_name, v.name
";

$dataRes = $conn->query($dataQuery);

// Build map
$dataMap = [];
while ($row = $dataRes->fetch_assoc()) {
    $dataMap[$row['vaccine_name']][$row['facility_name']] = (int)$row['total_quantity'];
}

// Build datasets
$datasets = [];
$colors = ['#4e73df', '#1cc88a', '#f6c23e', '#e74a3b', '#858796'];
$colorIndex = 0;

foreach ($vaccines as $vaccine) {

    $facilityData = [];

    foreach ($facilities as $facility) {
        $facilityData[] = $dataMap[$vaccine][$facility] ?? 0;
    }

    $datasets[] = [
        "label" => $vaccine,
        "data" => $facilityData,
        "backgroundColor" => $colors[$colorIndex % count($colors)]
    ];

    $colorIndex++;
}

echo json_encode([
    "labels" => $facilities,
    "datasets" => $datasets
]);