<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    include '../registrants/vims_settings.php'; 
    $VIMS_settings = new VIMS_settings();
  
    $Global_sub_category_array = $VIMS_settings->Global_sub_category_array();
    $Global_province = $VIMS_settings->Global_province();
    $Global_city = $VIMS_settings->Global_city();
    $Global_barangay = $VIMS_settings->Global_barangay();

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

    $current_year = date("Y");
    $current_month = (string)((int)(date("m")));
    
    if($_GET['other_conditions'] == "other_conditions"){
        $other_conditions = "";
    }else{
        $other_conditions = $_GET['other_conditions'];
        
        $indicator = explode("oc",$other_conditions);
        $m_indi = "online_registration";
        if($indicator[0] == "online_registration"){
            $other_conditions = " AND system_schedule.status = 'ACTIVE' AND (system_schedule.vaccine = '1' OR system_schedule.vaccine = '$indicator[2]') AND system_schedule.registered_status = 'ACTIVE'";
        }
    }
    
    echo $current_month."--".$current_year;
    // echo $other_conditions;

    if($condition == "COMPARE_ID"){
        if($selection_value == "ALL"){
            $selection_query = "$table_name $other_conditions";
        }else{
            $selection_query = "$table_name WHERE $table_col = '$selection_value' $other_conditions";
        }
        
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
            $Vaccine_Schedule = $systemcore->SelectCustomize("SELECT * FROM vaccine_schedule");
       
            if($SelectGroups != "none"){ ?>
                <center><h4>Schedule for Vaccination</h4></center> <?php
                $m = false;
                foreach($SelectGroups as $value){  
                    $monthNum  = $value["month"];
                    $dateObj   = DateTime::createFromFormat('!m', $monthNum);
                    $monthName = $dateObj->format('F');
                    if($value["facility_id"] == $selection_value){ 

                        $number_of_reg=0;
                        foreach($Vaccine_Schedule as $VacSched){ 
                            if($value["id"] == $VacSched["schedule_id"]){
                                $number_of_reg++;
                            }
                        }
                        if($number_of_reg <= $value["slots"] && $value["registered_status"] == "ACTIVE"){
                        $m = true;?>
                            <button class="btn btn-custom2 col-12 mb-2 sched_btn_class" type="button" id="sched_id_<?php echo $value['id']; ?>">
                                <div class="row col-12" >
                                    <div class="col-2 border-right">
                                        <h6 class="description-header"><b><?php echo $monthName; ?></b></h6>
                                        <span class="description-text"><B><?php echo $value["day"]; ?></b></span>
                                    </div>
                                    <div class="col-3 border-right">
                                        <h6 class="description-header"><b>Time</b></h6>
                                        <span class="description-text"><?php echo $value["time"]; ?></span>
                                    </div>
                                    <div class="col-4 border-right">
                                        <h6 class="description-header"><b>Location</b></h6>
                                        <span class="description-text"><?php echo $value["location"]; ?></span>
                                    </div>
                                    <div class="col-3">
                                        <span class="btn btn-custom" onclick="select_schedule('<?php echo $value['id']; ?>', 'sched_id_<?php echo $value['id']; ?>')">Piliin ang Schedule Nato</span>
                                    </div>
                                </div>
                            </button> <?php
                        }
                    }
                }
                
                if($m == false){ ?>
                    <center><h5>No Schedule Found</h5> 
                    <span style="color:gray; font-size:14px">(Kasalukuyang Puno o Walang mahanap na Iskedyul sa pasilidad na ito maaari kang pumili ng iba pang mga pasilidad.)</span></center><?php
                }
            }

        }// Add condition for new selection Conditions
    }

    if($condition == "select_vaccine_by_age"){
        $selection_value = $_GET['selection_value'];
        $table_name = $_GET['table_name'];


        $age = date_diff(date_create(), date_create($selection_value));
        $age = (string)$age->format("%Y");

        echo $age;
        $SelectGroups = $systemcore->SelectTable($table_name." WHERE id != 1 AND from_age <= $age AND to_age >= $age");
        if($SelectGroups != "none"){
            echo "<option hidden value='Empty'></option>";
            foreach($SelectGroups as $value){  
                echo "<option value='".$value['id']."'>".$value["vaccine_name"]."</option>";
            }
        }else{
            echo "<option value='Empty'>Sorry No available Vaccine for your Age</option>";
        }
    }
    if($condition == "select_sub_category_by_category"){

        $selection_value = str_replace("_","c*t",$selection_value);
        $selection_value = str_replace(":","c*t",$selection_value);
        $selection_value = explode('c*t', $selection_value);
        $k = 0;
        foreach($Global_sub_category_array as $data){  
            $data_o = str_replace("_","c*t",$data);
            $data_o = str_replace(".","c*t",$data_o);
            $data_o = explode('c*t', $data_o);
            if($data_o[1] == $selection_value[1]){ $k++;?>
            <option value="<?php echo $data; ?>"><?php echo $data; ?></option> <?php 
            }
        }
        if($k == 0){ ?>
            <option value="N/A">N/A</option> <?php
        }
    }
    if($condition == "select_province"){

        $selection_value = str_replace("_","c*t",$selection_value);
        $selection_value = explode('c*t', $selection_value);
        $k = 0;
        echo "<option value='Empty' hidden> </option>";
        foreach($Global_province as $data){  
            $data_o = str_replace("_","c*t",$data);
            $data_o = explode('c*t', $data_o);
            
            if(substr($data_o[1], 0, 2) == $selection_value[0]){ $k++;?>
            <option value="<?php echo $data; ?>"><?php echo $data; ?></option> <?php 
            }
        }
        if($k == 0){ ?>
            <option value="N/A">N/A</option> <?php
        }
    }

    if($condition == "select_city"){

        $selection_value = str_replace("_","c*t",$selection_value);
        $selection_value = explode('c*t', $selection_value);
        if($selection_value[1][0] == 0){
            $selection_value = substr($selection_value[1], 1);
        }else{
            $selection_value = $selection_value[1];
        }
        $k = 0;
        echo "<option value='Empty' hidden> </option>";
        foreach($Global_city as $data){  
            $data_o = str_replace("_","c*t",$data);
            $data_o = explode('c*t', $data_o);

            if(substr($data_o[1], 0, 3) == $selection_value){ $k++;?>
            <option value="<?php echo $data; ?>"><?php echo $data; ?></option> <?php 
            }
        }
        if($k == 0){ ?>
            <option value="N/A">N/A</option> <?php
        }
    }

    if($condition == "select_brgy"){

        $selection_value = str_replace("_","c*t",$selection_value);
        $selection_value = explode('c*t', $selection_value);
        $k = 0;
        echo "<option value='Empty' hidden> </option>";
        foreach($Global_barangay as $data){  
            $data_o = str_replace("_","c*t",$data);
            $data_o = explode('c*t', $data_o);

            if(substr($data_o[1], 0, 5) == $selection_value[1]){ $k++;?>
            <option value="<?php echo $data; ?>"><?php echo $data; ?></option> <?php 
            }
        }
        if($k == 0){ ?>
            <option value="N/A">N/A</option> <?php
        }
    }
    
    

   
?>