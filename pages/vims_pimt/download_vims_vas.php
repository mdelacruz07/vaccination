<?php 
$selected_date = $_GET["selected_date"];
$facility_id = $_GET["facility_id"];

if($facility_id == "none" || $facility_id == " " || $facility_id == "ALL"){
    $f_query_2 = "";
}else{
    $f_query_2 = " AND bakuna_center = '$facility_id'";
}

include '../../controller/systemcore.php'; 
$systemcore = new systemcore();
$customers_data = $systemcore->SelectCustomize("SELECT * FROM vims_vas_12 WHERE vaccination_date = '$selected_date' $f_query_2");
print_r($customers_data);

// File Name & Content Header For Download
$file_name = "VIMS_VAS_".date("Y-m-d").".xls";
header("Content-Disposition: attachment; filename=\"$file_name\"");
header("Content-Type: application/vnd.ms-excel");

//To define column name in first row.
$column_names = false;
// run loop through each row in $customers_data
foreach($customers_data as $row) {
    echo "rows<br>";
if(!$column_names) {
echo implode("\t", array_keys($row)) . "\n";
$column_names = true;
}
// The array_walk() function runs each array element in a user-defined function.
array_walk($row, 'filterCustomerData');
echo implode("\t", array_values($row)) . "\n";
}
// exit;
?>