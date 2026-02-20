<?php
include '../../database/connector.php';

$year = isset($_POST['year']) ? $_POST['year'] : '';

$whereYearReceive = '';
$whereYearIssue   = '';

if (!empty($year)) {
    $whereYearReceive = " AND YEAR(created_date) = '$year' ";
    $whereYearIssue   = " AND YEAR(issued_date) = '$year' ";
}

$query_vaccine = "
    SELECT v.id, v.name,
    (IFNULL(vr.total_in,0) - IFNULL(vi.total_out,0)) AS balance
    FROM vaccines v
    LEFT JOIN (
        SELECT vaccine_id, SUM(quantity) AS total_in
        FROM vaccine_receive
        WHERE is_archive = 0 $whereYearReceive
        GROUP BY vaccine_id
    ) vr ON vr.vaccine_id = v.id
    LEFT JOIN (
        SELECT vaccine_id, SUM(quantity) AS total_out
        FROM vaccine_issuance
        WHERE is_archive = 0 $whereYearIssue
        GROUP BY vaccine_id
    ) vi ON vi.vaccine_id = v.id
    WHERE v.is_archive = 0
    GROUP BY v.id
    HAVING balance > 0
    ORDER BY v.name ASC
";

$result = $conn->query($query_vaccine);

$labels = [];
$data   = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_object()) {
        $labels[] = $row->name;
        $data[]   = (int)$row->balance;
    }
}

echo json_encode([
    "labels" => $labels,
    "data"   => $data
]);