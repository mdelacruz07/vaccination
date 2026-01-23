<?php 
error_reporting(E_ERROR | E_PARSE);
$selected_date = $_GET["selected_date"];
$facility_id = $_GET["facility_id"];
date_default_timezone_set('Asia/Manila');
if($facility_id == "none" || $facility_id == " " || $facility_id == "ALL"){
    $f_query_2 = "";
}else{
    $f_query_2 = " AND bakuna_center = '$facility_id'";
}

function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
}

include '../../controller/systemcore.php'; 
$systemcore = new systemcore();
$customers_data = $systemcore->SelectCustomize("SELECT `category`, `unique_id`, `pwd_id`, `indigenous`, `lastname`, `firstname`, `middlename`, `suffix`, `contact`, `region`, `province`, `city`, `brgy`, `gender`, `bday`, `deferral`, `reason_for_deferral`, `vaccination_date`, `vaccine_name`, `batch_number`, `lot_number`, `bakuna_center`, `vaccinator_name`, `1st_dose`, `2nd_dose`, `booster`, `adverse_event`, `adverse_event_condition` FROM vims_vas_12 WHERE vaccination_date = '$selected_date' $f_query_2");
// print_r($customers_data);

// File Name & Content Header For Download
$file_name = "VIMS_VAS_".date("Y-m-d").".xls";
header("Content-Disposition: attachment; filename=\"$file_name\"");
header("Content-Type: application/vnd.ms-excel");

//To define column name in first row.
$column_names = false;
// run loop through each row in $customers_data
foreach($customers_data as $row) {
    if($row["category"] != "Pediatric A3(12-17 years old)" && $row["category"] != "Pediatric A3(5-11 years old)" && $row["category"] != "ROPP(12-17 years old)" && $row["category"] != "ROPP(5-11 years old)"){
        // echo $row["category"];
        // echo "rows<br>";
        if(!$column_names) {
        echo implode("\t", array_keys($row)) . "\n";
        $column_names = true;
        }
        // The array_walk() function runs each array element in a user-defined function.
        array_walk($row, 'filterData'); 
        echo implode("\t", array_values($row)) . "\n";
    }
}
// exit;
?>