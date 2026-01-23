<?php    
// local
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "local_vims";

// online
// $servername = "Host Name";
// $username = "Example";
// $password = "Example";
// $dbname = "blank_db";

// 
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "online_registration_scheduler";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>