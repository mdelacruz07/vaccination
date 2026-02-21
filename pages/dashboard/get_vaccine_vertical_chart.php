<?php
include '../../database/connector.php';

$year = isset($_POST['year']) ? trim($_POST['year']) : '';

$whereReceive = "WHERE is_archive = 0";
$whereIssuance = "WHERE is_archive = 0";

if ($year !== '') {   // 👈 strict check
    $year = intval($year);

    $whereReceive .= " AND YEAR(created_date) = $year";
    $whereIssuance .= " AND YEAR(issued_date) = $year";
}

$query = "SELECT v.id, v.name AS vaccine_name,
        IFNULL(vr.total_in, 0) AS total_in,
        IFNULL(vi.total_out, 0) AS total_out,
        (IFNULL(vr.total_in, 0) - IFNULL(vi.total_out, 0)) AS balance
    FROM vaccines v
    LEFT JOIN (
        SELECT vaccine_id, SUM(quantity) AS total_in
        FROM vaccine_receive
        $whereReceive
        GROUP BY vaccine_id
    ) vr ON vr.vaccine_id = v.id
    LEFT JOIN (
        SELECT vaccine_id, SUM(quantity) AS total_out
        FROM vaccine_issuance
        $whereIssuance
        GROUP BY vaccine_id
    ) vi ON vi.vaccine_id = v.id
    WHERE v.is_archive = 0
    HAVING balance > 0
    ORDER BY v.name ASC
";

$result = $conn->query($query);

$data = [
    "labels" => [],
    "in" => [],
    "out" => [],
    "balance" => []
];

while ($row = $result->fetch_object()) {
    $data["labels"][] = $row->vaccine_name;
    $data["in"][] = (int)$row->total_in;
    $data["out"][] = (int)$row->total_out;
    $data["balance"][] = (int)$row->balance;
}

echo json_encode($data);