<?php
include '../../database/connector.php';

$year = isset($_POST['year']) ? trim($_POST['year']) : '';

$whereFirst = "";
$whereSecond = "";

if (!empty($year)) {
    $year = intval($year);
    $whereFirst = "AND YEAR(first_dose_date) = $year";
    $whereSecond = "AND YEAR(second_dose_date) = $year";
}

$query = "SELECT 
    v.id,
    v.name AS vaccine_name,
    COUNT(p.vaccine_id) AS total_doses_given
FROM vaccines v
LEFT JOIN (
    SELECT first_vaccine_id AS vaccine_id
    FROM patient
    WHERE first_vaccine_id IS NOT NULL
    $whereFirst

    UNION ALL

    SELECT second_vaccine_id AS vaccine_id
    FROM patient
    WHERE second_vaccine_id IS NOT NULL
    $whereSecond
) p ON p.vaccine_id = v.id
WHERE v.is_archive = 0
GROUP BY v.id, v.name
ORDER BY v.name ASC";

$result = $conn->query($query);

$data = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            "vaccine_name" => $row["vaccine_name"],
            "total_doses_given" => (int)$row["total_doses_given"]
        ];
    }
}

echo json_encode($data);