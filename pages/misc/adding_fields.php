<?php
   include '../../controller/systemcore.php'; 
   $systemcore = new systemcore();
    $field_name = $_GET["field_name"];
    $number_of_field = $_GET["number_of_field"];
    $value_to_passed = $_GET["value_to_passed"];
    
    if($field_name == "adding_primary_fields"){ ?>
        
        <div class="col-sm-12 row" id="primary_remove_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">
            <div class="form-group col-lg-8">
                <label>Name of School:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-school"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="add_primary_school_name[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Primary Level:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-level-up-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="add_primary_school_grade_level[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Year Graduated:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-graduation-cap"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="add_primary_school_year_graduated[]"> 
                    <button class="btn btn-outline-danger" style="margin-left:5px" onclick="adding_and_removing_field(this.value,'remove_fields','primary_remove_field_<?php echo $number_of_field;?>')" type="submit"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
        <div class="col-sm-12 row" id="primary_add_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">

            <div class="form-group col-lg-10"></div>
            <button value="<?php echo $number_of_field;?>" class="btn btn-primary col-lg-2" type="submit" onclick="adding_and_removing_field(this.value,'adding_primary_fields','primary_add_field_<?php echo $number_of_field;?>')" >Add New Fields</button>                           
            
        </div> <?php
    }elseif($field_name == "adding_secondary_fields"){ ?>
        
        <div class="col-sm-12 row" id="secondary_remove_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">
            <div class="form-group col-lg-8">
                <label>Name of School:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-school"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="add_secondary_name[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Secondary Level:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-level-up-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="add_secondary_grade_level[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Year Graduated:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-graduation-cap"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="add_secondary_year_graduated[]">
                    <button class="btn btn-outline-danger" style="margin-left:5px" onclick="adding_and_removing_field(this.value,'remove_fields','secondary_remove_field_<?php echo $number_of_field;?>')" type="submit"><span aria-hidden="true">&times;</span></button> 
                </div>
            </div>

        </div>
        <div class="col-sm-12 row" id="secondary_add_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">

            <div class="form-group col-lg-10"></div>
            <button value="<?php echo $number_of_field;?>" class="btn btn-primary col-lg-2" type="submit" onclick="adding_and_removing_field(this.value,'adding_secondary_fields','secondary_add_field_<?php echo $number_of_field;?>')" >Add New Fields</button>                           
            
        </div> <?php
    }elseif($field_name == "adding_senior_fields"){ ?>
        
        <div class="col-sm-12 row" id="senior_remove_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">
            <div class="form-group col-lg-4">
                <label>Name of School:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-school"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="add_senior_name[]"> 
                </div>
            </div>
            <div class="form-group col-lg-4">
                <label>Senior Strand:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-book-open"></i>
                    </span>
                    </div>
                    <select name="add_senior_strand[]" class="form-control"  alt="required"><?php
                    $SelectGroups = $systemcore->SelectTable("system_senior_strands WHERE strand_status = 'ACTIVE'");
                    foreach($SelectGroups as $value){  
                        echo "<option value='".$value['id']."'>".$value['strand_name']."</option>";
                    }?>
                    </select>
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Senior Level:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-level-up-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="add_senior_level[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Year Graduated:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-graduation-cap"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="add_senior_year_graduated[]"> 
                    <button class="btn btn-outline-danger" style="margin-left:5px" onclick="adding_and_removing_field(this.value,'remove_fields','senior_remove_field_<?php echo $number_of_field;?>')" type="submit"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
        <div class="col-sm-12 row" id="senior_add_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">

            <div class="form-group col-lg-10"></div>
            <button value="<?php echo $number_of_field;?>" class="btn btn-primary col-lg-2" type="submit" onclick="adding_and_removing_field(this.value,'adding_senior_fields','senior_add_field_<?php echo $number_of_field;?>')" >Add New Fields</button>                           
            
        </div> <?php
    }elseif($field_name == "adding_tertiary_fields"){ ?>
            
        <div class="col-sm-12 row" id="tertiary_remove_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">
            <div class="form-group col-lg-4">
                <label>Name of School:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-school"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="add_tertiary_name[]"> 
                </div>
            </div>
            <div class="form-group col-lg-4">
                <label>Course:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-book-open"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="add_tertiary_course[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Tertiary Level:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-level-up-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="add_tertiary_level[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Year Graduated:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-graduation-cap"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="add_tertiary_year_graduated[]"> 
                    <button class="btn btn-outline-danger" style="margin-left:5px" onclick="adding_and_removing_field(this.value,'remove_fields','tertiary_remove_field_<?php echo $number_of_field;?>')" type="submit"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
        <div class="col-sm-12 row" id="tertiary_add_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">

            <div class="form-group col-lg-10"></div>
            <button value="<?php echo $number_of_field;?>" class="btn btn-primary col-lg-2" type="submit" onclick="adding_and_removing_field(this.value,'adding_tertiary_fields','tertiary_add_field_<?php echo $number_of_field;?>')" >Add New Fields</button>                           
            
        </div> <?php
    }elseif($field_name == "adding_in_updating_primary_fields"){ ?>
        
        <div class="col-sm-12 row" id="primary_remove_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">
            <div class="form-group col-lg-8">
                <label>Name of School:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-school"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" hidden value="new" name="primary_id[]"> 
                    <input type="text" class="form-control float-right" name="primary_school_name[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Primary Level:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-level-up-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="primary_school_grade_level[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Year Graduated:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-graduation-cap"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="primary_school_year_graduated[]"> 
                    <button class="btn btn-outline-danger" style="margin-left:5px" onclick="adding_and_removing_field(this.value,'remove_fields','primary_remove_field_<?php echo $number_of_field;?>')" type="submit"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
        <div class="col-sm-12 row" id="primary_add_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">

            <div class="form-group col-lg-10"></div>
            <button value="<?php echo $number_of_field;?>" class="btn btn-primary col-lg-2" type="submit" onclick="adding_and_removing_field(this.value,'adding_primary_fields','primary_add_field_<?php echo $number_of_field;?>')" >Add New Fields</button>                           
            
        </div> <?php
    }elseif($field_name == "adding_in_updating_secondary_fields"){ ?>
        
        <div class="col-sm-12 row" id="secondary_remove_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">
            <div class="form-group col-lg-8">
                <label>Name of School:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-school"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" hidden value="new" name="secondary_id[]"> 
                    <input type="text" class="form-control float-right" name="secondary_name[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Secondary Level:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-level-up-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="secondary_grade_level[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Year Graduated:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-graduation-cap"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="secondary_year_graduated[]">
                    <button class="btn btn-outline-danger" style="margin-left:5px" onclick="adding_and_removing_field(this.value,'remove_fields','secondary_remove_field_<?php echo $number_of_field;?>')" type="submit"><span aria-hidden="true">&times;</span></button> 
                </div>
            </div>

        </div>
        <div class="col-sm-12 row" id="secondary_add_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">

            <div class="form-group col-lg-10"></div>
            <button value="<?php echo $number_of_field;?>" class="btn btn-primary col-lg-2" type="submit" onclick="adding_and_removing_field(this.value,'adding_secondary_fields','secondary_add_field_<?php echo $number_of_field;?>')" >Add New Fields</button>                           
            
        </div> <?php
    }elseif($field_name == "adding_in_updating_senior_fields"){ ?>
        
        <div class="col-sm-12 row" id="senior_remove_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">
            <div class="form-group col-lg-4">
                <label>Name of School:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-school"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" hidden value="new" name="senior_id[]"> 
                    <input type="text" class="form-control float-right" name="senior_name[]"> 
                </div>
            </div>
            <div class="form-group col-lg-4">
                <label>Senior Strand:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-book-open"></i>
                    </span>
                    </div>
                    <select name="senior_strand[]" class="form-control"  alt="required"><?php
                    $SelectGroups = $systemcore->SelectTable("system_senior_strands WHERE strand_status = 'ACTIVE'");
                    foreach($SelectGroups as $value){  
                        echo "<option value='".$value['id']."'>".$value['strand_name']."</option>";
                    }?>
                    </select>
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Senior Level:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-level-up-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="senior_level[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Year Graduated:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-graduation-cap"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="senior_year_graduated[]"> 
                    <button class="btn btn-outline-danger" style="margin-left:5px" onclick="adding_and_removing_field(this.value,'remove_fields','senior_remove_field_<?php echo $number_of_field;?>')" type="submit"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
        <div class="col-sm-12 row" id="senior_add_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">

            <div class="form-group col-lg-10"></div>
            <button value="<?php echo $number_of_field;?>" class="btn btn-primary col-lg-2" type="submit" onclick="adding_and_removing_field(this.value,'adding_senior_fields','senior_add_field_<?php echo $number_of_field;?>')" >Add New Fields</button>                           
            
        </div> <?php
    }elseif($field_name == "adding_in_updating_tertiary_fields"){ ?>
            
        <div class="col-sm-12 row" id="tertiary_remove_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">
            <div class="form-group col-lg-4">
                <label>Name of School:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-school"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" hidden value="new" name="tertiary_id[]"> 
                    <input type="text" class="form-control float-right" name="tertiary_name[]"> 
                </div>
            </div>
            <div class="form-group col-lg-4">
                <label>Course:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-book-open"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="tertiary_course[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Tertiary Level:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-level-up-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="tertiary_level[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Year Graduated:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-graduation-cap"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="tertiary_year_graduated[]"> 
                    <button class="btn btn-outline-danger" style="margin-left:5px" onclick="adding_and_removing_field(this.value,'remove_fields','tertiary_remove_field_<?php echo $number_of_field;?>')" type="submit"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
        <div class="col-sm-12 row" id="tertiary_add_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">

            <div class="form-group col-lg-10"></div>
            <button value="<?php echo $number_of_field;?>" class="btn btn-primary col-lg-2" type="submit" onclick="adding_and_removing_field(this.value,'adding_tertiary_fields','tertiary_add_field_<?php echo $number_of_field;?>')" >Add New Fields</button>                           
            
        </div> <?php
    }elseif($field_name == "adding_subject_fields"){ ?>
            
        <div class="col-sm-12 row" id="tertiary_remove_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">
            <div class="form-group col-lg-4">
                <label>Name of School:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-school"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" hidden value="new" name="tertiary_id[]"> 
                    <input type="text" class="form-control float-right" name="tertiary_name[]"> 
                </div>
            </div>
            <div class="form-group col-lg-4">
                <label>Course:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-book-open"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="tertiary_course[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Tertiary Level:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-level-up-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="tertiary_level[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Year Graduated:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-graduation-cap"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="tertiary_year_graduated[]"> 
                    <button class="btn btn-outline-danger" style="margin-left:5px" onclick="adding_and_removing_field(this.value,'remove_fields','tertiary_remove_field_<?php echo $number_of_field;?>')" type="submit"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
        <div class="col-sm-12 row" id="tertiary_add_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">

            <div class="form-group col-lg-10"></div>
            <button value="<?php echo $number_of_field;?>" class="btn btn-primary col-lg-2" type="submit" onclick="adding_and_removing_field(this.value,'adding_tertiary_fields','tertiary_add_field_<?php echo $number_of_field;?>')" >Add New Fields</button>                           
            
        </div> <?php
    
    }elseif($field_name == "adding_subject_on_schedule"){ 
        
        $SelectTable = $systemcore->SelectCustomize("SELECT system_schedule.*, system_section.section_name as section_name, system_subject.subject_name as subject_name, system_subject.subject_code as subject_code, system_user.first_name as first_name, system_user.middle_name as middle_name, system_user.last_name as last_name, system_rooms.room_code as room_code FROM system_schedule LEFT JOIN system_section ON system_schedule.section_id = system_section.id LEFT JOIN system_subject ON system_schedule.subject_id = system_subject.id LEFT JOIN system_user ON system_schedule.professor_id = system_user.id LEFT JOIN system_rooms ON system_schedule.room_id = system_rooms.id WHERE system_schedule.id = '$value_to_passed'");
        if($SelectTable != "none"){
            $x = 0;
            foreach($SelectTable as $value){
                $x++;
                echo "<div class='row' id='subject".$value['id']."'>";
                    echo "<div class='col-sm-1 border-bottom' style='padding: 20px 10px 20px 10px;'>";?> <input type="text" class="form-control" hidden value="<?php echo $value['id'];?>" name="schedule_id[]"> <input type="text" class="form-control" value="<?php echo $value['ordered_list'];?>" name="ordered_list[]" style="width:100%;"> <input type="text" hidden class="form-control" value="<?php echo $value['professor_id'];?>" name="teacher_id[]" style="width:100%;"> <input type="text" class="form-control" hidden value="<?php echo $value['subject_id'];?>" name="subject_id[]" style="width:100%;"> <?php echo "</div>";
                    echo "<div class='col-sm-2 border-bottom' style='padding: 20px 10px 20px 10px;'><b>".$value['subject_code']."</b></div>";
                    echo "<div class='col-sm-2 border-bottom' style='padding: 20px 10px 20px 10px;'><b>".$value['subject_name']."</b></div>"; 
                    echo "<div class='col-sm-2 border-bottom' style='padding: 20px 10px 20px 10px;'><b>".$value['first_name']." ".$value['middle_name']." ".$value['last_name']."</b></div>"; 
                    echo "<div class='col-sm-1 border-bottom' style='padding: 20px 10px 20px 10px;'><b>".$value['days']."</b></div>"; 
                    echo "<div class='col-sm-1 border-bottom' style='padding: 20px 10px 20px 10px;'><b>".$value['room_code']."</b></div>"; 
                    echo "<div class='col-sm-2 border-bottom' style='padding: 20px 10px 20px 10px;'><b>".$value['time']."</b></div>"; ?>
                    <div class='col-sm-1 border-bottom' style='padding: 20px 10px 20px 10px;'>
                    <button class="btn btn-outline-danger" style="margin-left:5px" onclick="adding_and_removing_field('<?php echo $value['id'];?>','remove_fields','subject<?php echo $value['id'];?>')" type="button" name="schedule_button"><span aria-hidden="true"><i class="fas fa-minus-circle"></i></span></button>
                    </div> <?php
                echo "</div>";
            }
        }else{
            echo "<div style='margin : 40px;'><center><h5><b>No Schedule Found</b></h5></center></div>";
        } ?>
        <div id="add_student_subjects<?php echo $number_of_field; ?>">
        </div> <?php
    }elseif($field_name == "adding_bachelor_fields"){ ?>
            
        <div class="col-sm-12 row" id="bachelor_remove_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">
            <div class="form-group col-lg-4">
                    <label>Name of School:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fas fa-school"></i>
                        </span>
                        </div>
                        <input type="text" class="form-control float-right" name="add_bachelor[]"> 
                    </div>
                </div>
                <div class="form-group col-lg-4">
                    <label>Course:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fas fa-book-open"></i>
                        </span>
                        </div>
                        <input type="text" class="form-control float-right" name="add_bachelor_course[]"> 
                    </div>
                </div>
                <div class="form-group col-lg-2">
                    <label>Level:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fas fa-level-up-alt"></i>
                        </span>
                        </div>
                        <input type="text" class="form-control float-right" name="add_bachelor_level[]"> 
                    </div>
                </div>
                <div class="form-group col-lg-2">
                    <label>Year Graduated:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fas fa-graduation-cap"></i>
                        </span>
                        </div>
                        <input type="text" class="form-control float-right" name="add_bachelor_graduated[]"> 
                        <button class="btn btn-outline-danger" style="margin-left:5px" onclick="adding_and_removing_field(this.value,'remove_fields','bachelor_remove_field_<?php echo $number_of_field;?>')" type="submit"><span aria-hidden="true">&times;</span></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 row" id="bachelor_add_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">

            <div class="form-group col-lg-10"></div>
            <button value="<?php echo $number_of_field;?>" class="btn btn-primary col-lg-2" type="submit" onclick="adding_and_removing_field(this.value,'adding_bachelor_fields','bachelor_add_field_<?php echo $number_of_field;?>')" >Add New Fields</button>                           
            
        </div> <?php
    }elseif($field_name == "adding_master_fields"){ ?>
            
        <div class="col-sm-12 row" id="master_remove_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">
            <div class="form-group col-lg-4">
                <label>Name of School:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-school"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="add_master[]"> 
                </div>
            </div>
            <div class="form-group col-lg-4">
                <label>Course:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-book-open"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="add_master_course[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Level:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-level-up-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="add_master_level[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Year Graduated:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-graduation-cap"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="add_master_graduated[]"> 
                    <button class="btn btn-outline-danger" style="margin-left:5px" onclick="adding_and_removing_field(this.value,'remove_fields','master_remove_field_<?php echo $number_of_field;?>')" type="submit"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
        <div class="col-sm-12 row" id="master_add_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">

            <div class="form-group col-lg-10"></div>
            <button value="<?php echo $number_of_field;?>" class="btn btn-primary col-lg-2" type="submit" onclick="adding_and_removing_field(this.value,'adding_master_fields','master_add_field_<?php echo $number_of_field;?>')" >Add New Fields</button>                           
            
        </div> <?php
    }elseif($field_name == "adding_in_updating_bachelor_fields"){ ?>
            
        <div class="col-sm-12 row" id="bachelor_remove_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">
            <div class="form-group col-lg-4">
                <label>Name of School:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-school"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" hidden value="new" name="bachelor_id[]"> 
                    <input type="text" class="form-control float-right" name="bachelor_name[]"> 
                </div>
            </div>
            <div class="form-group col-lg-4">
                <label>Course:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-book-open"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="bachelor_course[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Level:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-level-up-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="bachelor_level[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Year Graduated:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-graduation-cap"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="bachelor_year_graduated[]"> 
                    <button class="btn btn-outline-danger" style="margin-left:5px" onclick="adding_and_removing_field(this.value,'remove_fields','bachelor_remove_field_<?php echo $number_of_field;?>')" type="submit"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
        <div class="col-sm-12 row" id="bachelor_add_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">

            <div class="form-group col-lg-10"></div>
            <button value="<?php echo $number_of_field;?>" class="btn btn-primary col-lg-2" type="submit" onclick="adding_and_removing_field(this.value,'adding_bachelor_fields','bachelor_add_field_<?php echo $number_of_field;?>')" >Add New Fields</button>                           
            
        </div> <?php
    }elseif($field_name == "adding_in_updating_master_fields"){ ?>
            
        <div class="col-sm-12 row" id="master_remove_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">
            <div class="form-group col-lg-4">
                <label>Name of School:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-school"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" hidden value="new" name="master_id[]"> 
                    <input type="text" class="form-control float-right" name="master_name[]"> 
                </div>
            </div>
            <div class="form-group col-lg-4">
                <label>Course:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-book-open"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="master_course[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Level:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-level-up-alt"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="master_level[]"> 
                </div>
            </div>
            <div class="form-group col-lg-2">
                <label>Year Graduated:</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text">
                    <i class="fas fa-graduation-cap"></i>
                    </span>
                    </div>
                    <input type="text" class="form-control float-right" name="master_year_graduated[]"> 
                    <button class="btn btn-outline-danger" style="margin-left:5px" onclick="adding_and_removing_field(this.value,'remove_fields','master_remove_field_<?php echo $number_of_field;?>')" type="submit"><span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
        <div class="col-sm-12 row" id="master_add_field_<?php echo $number_of_field;?>" style="padding:0px; margin:0px;">

            <div class="form-group col-lg-10"></div>
            <button value="<?php echo $number_of_field;?>" class="btn btn-primary col-lg-2" type="submit" onclick="adding_and_removing_field(this.value,'adding_master_fields','master_add_field_<?php echo $number_of_field;?>')" >Add New Fields</button>                           
            
        </div> <?php
    }else{
        // if the condition is remove_fields the fields would be removed!!
    }
?>