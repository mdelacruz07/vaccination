<?php
include '../../database/connector.php';

header('Content-Type: application/json');

// Get minimum stock value
$minResult = $conn->query("SELECT min_qty FROM minimum_stock WHERE id = 1");
$minRow = $minResult->fetch_assoc();
$min_qty = intval($minRow['min_qty']);

$query = "SELECT
    v.id,
    v.name AS vaccine_name,
    IFNULL(SUM(DISTINCT vr.total_in), 0) -
    IFNULL(SUM(DISTINCT vi.total_out), 0) AS current_balance
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
GROUP BY v.id
HAVING current_balance <= $min_qty
ORDER BY current_balance ASC
";

$result = $conn->query($query);

$data = [];

if($result){
    while($row = $result->fetch_assoc()){
        $data[] = [
            "vaccine_name" => $row['vaccine_name'],
            "current_balance" => intval($row['current_balance'])
        ];
    }
}

echo json_encode([
    "count" => count($data),
    "minimum_stock" => $min_qty,
    "data" => $data
]);