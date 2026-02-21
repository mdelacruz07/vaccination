<?php
include '../../database/connector.php';
include '../../controller/systemcore.php'; 
$systemcore = new systemcore();
$systemcore->System_Sessioning("session");

header('Content-Type: application/json');

if(empty($_SESSION["user_id"])) {
    echo json_encode([
        "status" => "error",
        "message" => "Session expired."
    ]);
    exit;
}

if(isset($_POST['minimum_stock'])) {

    $minimum_stock = intval($_POST['minimum_stock']);
    $updated_by = $_SESSION["user_id"];

    if($minimum_stock < 0){
        echo json_encode([
            "status" => "error",
            "message" => "Minimum stock cannot be negative."
        ]);
        exit;
    }

    // Update minimum stock with audit fields
    $query = "UPDATE minimum_stock 
              SET min_qty = ?, 
                  update_by = ?, 
                  update_date = NOW() 
              WHERE id = 1";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("ii", $minimum_stock, $updated_by);

    if($stmt->execute()) {
        echo json_encode([
            "status" => "success",
            "message" => "Minimum stock updated successfully."
        ]);
    } else {
        echo json_encode([
            "status" => "error",
            "message" => "Database error."
        ]);
    }

} else {
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request."
    ]);
}