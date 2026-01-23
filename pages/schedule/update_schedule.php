<?php 
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $facility_id = $_GET["facility_id"];
    $month = $_GET["month"];
    $year = $_GET["year"];

    $sched_indicator = $_GET["sched_indicator"];
    $day = $_GET["day"];
    $brgy = $_GET["brgy"];
    $vaccine = $_GET["vaccine"];
    $age_limit = $_GET["age_limit"];
    $slots = $_GET["slots"];
    $time = $_GET["time"];
    $status = $_GET["status"];
   
    // echo $month."<br>";
    // echo $year."<br>";
    // print_r($day)."<br>";
    // print_r($brgy)."<br>";
    // print_r($vaccine)."<br>";
    // print_r($age_limit)."<br>";
    // print_r($slots)."<br>";
    // print_r($time)."<br>";
    // print_r($status)."<br>";
    $table = "system_schedule";
    $monthNum  = $month;
    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
    $monthName = $dateObj->format('F');

    for($x = 0; $x < count($brgy); $x++){
        $schedule_name = $monthName."-".$day[$x];
        if($sched_indicator[$x] == "OLD"){
            if($status[$x] == "REMOVE"){
                $indicator = "facility_id = '$facility_id' AND year = '$year' AND month = $month AND day = $day[$x]";
                $DeleteTable = $systemcore->DeleteTable($table, $indicator);
            }else{
                $col_to_update = "brgy='$brgy[$x]', vaccine='$vaccine[$x]', age_limit='$age_limit[$x]', slots='$slots[$x]', time='$time[$x]', status='$status[$x]', schedule_name='$schedule_name'";
                $indicator = "facility_id = '$facility_id' AND year = '$year' AND month = $month AND day = $day[$x]";
                $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
            }
        }else{
            if($status[$x] == "PENDING"){

                $table_col = "facility_id, year, month, day, brgy, vaccine, age_limit, slots, time, status, schedule_name";
                $table_val = "'$facility_id', '$year', '$month', '$day[$x]', '$brgy[$x]', '$vaccine[$x]', '$age_limit[$x]', '$slots[$x]', '$time[$x]', '$status[$x]' , '$schedule_name'"; 
                $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
            }
        }
    }
?>


<?php
    include '../../controller/systemtable.php'; 
    $systemtable = new systemtable();
    $table_name = "show_schedule";
    $values_pass = $facility_id.",".$month.",".$year.","." ";
    $SelectTable = $systemtable->SelectingTable($table_name,$values_pass);
?>