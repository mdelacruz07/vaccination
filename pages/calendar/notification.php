<?php
include '../../database/connector.php';

$query = "SELECT 
    p.id,
    CONCAT(p.firstname, ' ', p.lastname) AS patient_name,
    v.name,
    p.first_dose_date AS scheduled_date,
    'First Dose' AS dose_type

FROM patient p
LEFT JOIN vaccines v ON v.id = p.first_vaccine_id
WHERE 
    p.first_dose = 'No'
    AND p.first_dose_date IS NOT NULL
    AND p.first_dose_date <= DATE_ADD(CURDATE(), INTERVAL 3 DAY)

UNION ALL

SELECT 
    p.id,
    CONCAT(p.firstname, ' ', p.lastname) AS patient_name,
    v.name,
    p.second_dose_date AS scheduled_date,
    'Second Dose' AS dose_type

FROM patient p
LEFT JOIN vaccines v ON v.id = p.second_vaccine_id
WHERE 
    p.second_dose = 'No'
    AND p.second_dose_date IS NOT NULL
    AND p.second_dose_date <= DATE_ADD(CURDATE(), INTERVAL 3 DAY)
    AND p.is_archive = 0

ORDER BY scheduled_date ASC";

$result = $conn->query($query);

$notifications = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notifications[] = $row;
    }
}

echo json_encode([
    'count' => count($notifications),
    'notifications' => $notifications
]);