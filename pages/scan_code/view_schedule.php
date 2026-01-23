    <?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $id = $_GET['primary_id'];

    $id = explode(",",$id);
    $selected_facility_id = $id[0];
    $selected_month = $id[1];
    $selected_year = $id[2];
    $facility_name = $id[3];
    $selected_month_no_zero = ltrim($selected_month, '0');

    $back_month = $selected_month;
    $back_year = $selected_year;
    $next_year = $selected_year;
    $next_month = $selected_month;

    if($selected_month_no_zero == 12){
        $next_year++;
        $next_month = 1;
        $back_month--;
    }else if($selected_month_no_zero == 1){
        $back_year = $next_year - 1;
        $back_month = 12;
        $next_month++;
    }else{
        $back_month--;
        $next_month++;
    }
    // echo $selected_facility_id."<br>";
    // echo $selected_month."<br>";
    // echo $selected_year."<br>";
    // echo $selected_month_no_zero."<br>";

    // echo $back_month."<br>";
    // echo $back_year."<br>";
    // echo $next_year."<br>";
    // echo $next_month."<br>";


    $display_date = "OFF";
    $monthNum  = $selected_month;
    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
    $monthName = $dateObj->format('F');
    
    $Selected_Schedules = $systemcore->SelectCustomize("SELECT * FROM system_schedule WHERE facility_id = '$selected_facility_id' AND month = '$selected_month_no_zero' AND year = '$selected_year' ORDER BY day");
    $SelectVaccine = $systemcore->SelectTable("system_vaccines WHERE id != '1'");
    $vaccine = array();
    foreach($SelectVaccine as $value){
        array_push($vaccine, 0);
    }
    ?>
<div class="modal-header">
    <h5 class="modal-title"><?php echo $facility_name; ?> Schedules</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
    </button>
</div>
<span class="ml-3"><b><?php echo $monthName; ?>-<?php echo $selected_year; ?></b></span>
<table class="table table-bordered">
    <thead>                  
        <tr>
            <th style="width: 10px">Day</th>
            <th>Schedule Information</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($Selected_Schedules as $schedule){ ?>
            <tr>
                <td><h4><b><?php echo $schedule["day"] ?></b></h4></td>
                <td class="row m-0 p-0" style="font-size:17px;">
                    <div class="col-6 m-0 p-0">
                        <span>Time: <b class="text-success"><br><?php echo $schedule["time"] ?></b></span><br>
                    </div>
                    <div class="col-6 m-0 p-0"><?php
                        $schedule_id = $schedule["id"];
                        $SelectR = $systemcore->SelectCustomize("SELECT vaccine_registration.*, vaccine_schedule.selected_vaccine as selected_vaccine FROM vaccine_registration LEFT JOIN vaccine_schedule ON vaccine_registration.qr_id = vaccine_schedule.qr_id WHERE vaccine_schedule.schedule_id = '$schedule_id'"); 
                        $vaccine_a = $vaccine;
                        $total = 0;
                        foreach($SelectR as $R){
                            $total++;
                            $x = 0;
                            foreach($SelectVaccine as $vaccine_data){
                                if($R["selected_vaccine"] == $vaccine_data["id"]){
                                    $vaccine_a[$x]++;
                                }
                                $x++;
                            }
                        } ?>
                        <span>Registrants: <b class="text-danger"><Br><?php echo $total ?></b></span>
                        
                    </div>
                    <div class="col-12 m-0 p-0"><?php
                        $x = 0;
                        foreach($SelectVaccine as $vaccine_data){ ?>
                        <span class="ml-1 text-info" style="font-size:12px;"><b style="font-size:10px;"><?php echo $vaccine_data["vaccine_name"]; ?>(<?php echo $vaccine_a[$x]; ?>)</span><?php
                            $x++;
                        } ?>
                    </div>
                </td>
            </tr> <?php  
        } ?>

    </tbody>

</table>


<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <div class="row">
    <button type="button" class="btn btn-default mr-1" data-dismiss="modal" onclick="sys_edit('view_schedule.php', 'veiw_result', '<?php echo $selected_facility_id;?>,<?php echo $back_month;?>,<?php echo $back_year;?>,<?php echo $facility_name; ?>', 'required_div', 'none')" >Back</button>
    <button type="button" class="btn btn-default" data-dismiss="modal" onclick="sys_edit('view_schedule.php', 'veiw_result', '<?php echo $selected_facility_id;?>,<?php echo $next_month;?>,<?php echo $next_year;?>,<?php echo $facility_name; ?>', 'required_div', 'none')" >Next</button>
    </div>
</div>