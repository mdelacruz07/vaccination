<?php
include '../../database/connector.php';

$vaccine_id = $_POST['vaccine_id'] ?? 0;

$sql = "
    SELECT SUM(quantity_received) AS quantity_available
    FROM vaccine_inventory
    WHERE vaccine_id = ?
      AND is_archive = 0
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $vaccine_id);
$stmt->execute();
$result = $stmt->get_result()->fetch_assoc();

echo json_encode([
    'status' => 'success',
    'quantity_available' => $result['quantity_available'] ?? 0
]);
