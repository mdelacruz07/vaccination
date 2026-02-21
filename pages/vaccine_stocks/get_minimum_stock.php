<?php
include '../../database/connector.php';

header('Content-Type: application/json');

$query = "SELECT min_qty FROM minimum_stock WHERE id = 1 LIMIT 1";
$result = $conn->query($query);

if($result && $result->num_rows > 0){
    $row = $result->fetch_assoc();

    echo json_encode([
        "status" => "success",
        "min_qty" => $row['min_qty']
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Minimum stock not found."
    ]);
}