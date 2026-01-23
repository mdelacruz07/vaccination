<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    $selection_value = $_GET['selection_value'];
    $selection_value_status = explode(",", $selection_value);
    if($selection_value_status[0] == "multi"){
        $selection_value = $selection_value_status[1];
    }

    $table_name = $_GET['table_name'];
    $table_col = $_GET['table_col'];
    $selection_col_name = $_GET['selection_col_name'];
    $condition = $_GET['condition'];
    $m_indi = "normal";
    
    if($_GET['other_conditions'] == "other_conditions"){
        $other_conditions = "";
    }else{
        $other_conditions = $_GET['other_conditions'];
        
        $indicator = explode("oc",$other_conditions);
        $m_indi = "online_registration";
        echo $indicator[3];
        if($indicator[0] == "online_registration"){
            $age = date_diff(date_create(), date_create($indicator[3]));
            $age->format("%Y");
            $other_conditions = "AND system_schedule.brgy = '$indicator[2]' AND system_schedule.status = 'ACTIVE' AND system_schedule.vaccine = '1' OR system_schedule.vaccine = '$indicator[4]' OR system_schedule.brgy = '$indicator[1]'";
            
        }
    }
    
    // echo $other_conditions;

    if($condition == "COMPARE_ID"){
        if($selection_value == "ALL"){
            $selection_query = "$table_name $other_conditions";
        }else{
            $selection_query = "$table_name WHERE $table_col = '$selection_value' $other_conditions";
        }
        
    }// Add condition for new selection Conditions

    if($m_indi == "normal"){
        // conditional for multi selection in edits or normal selections on adding!!
        if($selection_value_status[0] == "multi"){
            $SelectGroups = $systemcore->SelectTable($selection_query);
            if($SelectGroups != "none"){
                echo "<option hidden value='Empty'></option>";
                echo "<option value='multi,ALL,ALL'>All</option>";
                foreach($SelectGroups as $value){  
                    echo "<option value='multi,".$value['id'].",".$value[$selection_col_name]."'>".$value[$selection_col_name]."</option>";
                }
            }else{
                echo "<option value='Empty'>Empty</option>";
            }
        }else{
            $SelectGroups = $systemcore->SelectTable($selection_query);
            if($SelectGroups != "none"){
                echo "<option hidden value='Empty'></option>";
                echo "<option value='ALL'>All</option>";
                foreach($SelectGroups as $value){  
                    echo "<option value='".$value['id']."'>".$value[$selection_col_name]."</option>";
                }
            }else{
                echo "<option value='Empty'>Empty</option>";
                echo "<option value='ALL'>All</option>";
            }
        }
    }else{
        $SelectGroups = $systemcore->SelectCustomize("SELECT system_schedule.*, system_facilities.location as location FROM system_schedule LEFT JOIN system_facilities ON system_schedule.facility_id = system_facilities.id  WHERE $table_col = '$selection_value' $other_conditions");
        if($SelectGroups != "none"){
            foreach($SelectGroups as $value){  
                $monthNum  = $value["month"];
                $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                $monthName = $dateObj->format('F');?>
                <button class="btn btn-outline-info col-12" type="button">
                    <div class="row">
                        <div class="col-3 border-right">
                            <h5 class="description-header"><b><?php echo $monthName; ?></b></h5>
                            <span class="description-text"><?php echo $value["day"]; ?></span>
                        </div>
                        <div class="col-3 border-right">
                            <h5 class="description-header"><b>Time</b></h5>
                            <span class="description-text"><?php echo $value["time"]; ?></span>
                        </div>
                        <div class="col-3 border-right">
                            <h5 class="description-header"><b>Location</b></h5>
                            <span class="description-text"><?php echo $value["location"]; ?></span>
                        </div>
                    </div>
                </button>
                   
                <?php
            }
        }
    }

   
?>