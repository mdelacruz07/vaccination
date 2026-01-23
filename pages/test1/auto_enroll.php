<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
$counter_num=0;
$SelectGroupsa = $systemcore->SelectTable("system_user WHERE access = '6' and id !='25'");

foreach($SelectGroupsa as $value1){  

    $account_id = $value1["account_id"];

    //system_user
    $section_id = '5';
    $academic_id = '3';
    $semester_id = '7';
    
    $department_id = '2';
    $course_id = '1';

    $year_level_id = '1';
   
    $student_status = 'NEW';

    $schedule_id = array();
    $ordered_list = array();
    $teacher_id = array();
    $subject_id = array();

    $SelectGroups = $systemcore->SelectTable("system_schedule WHERE section_id = '$section_id'");
    foreach($SelectGroups as $value){  
        array_push($schedule_id, $value["id"]);
        array_push($ordered_list, $value["ordered_list"]);
        array_push($teacher_id, $value["professor_id"]);
        array_push($subject_id, $value["subject_id"]);
    }

    $table = "system_department_student";
    $table_col = "`student_id`, `department_id`, `course_id`, `academic_year_id`, `semester_id`, `year_level_id`, `section_id`, `student_status`";
    $table_val = "'$account_id', '$department_id', '$course_id', '$academic_id', '$semester_id', '$year_level_id', '$section_id', '$student_status'"; 
    $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);

    // echo $table."==".$table_col."==".$table_val."<br>";
    $enrollment_form_id = $account_id."on".$academic_id."on".$semester_id."on".$department_id."on".$course_id."on".$year_level_id."on".$section_id;
    $length = count($schedule_id);
    for ($x = 1; $x < $length; $x++) {

        $table = "system_student_owned_schedule";
        $table_col = "`student_id`, `schedule_id`, `ordered_list`, `course_id`, `academic_year_id`, `semester_id`, `year_level_id`, `section_id`";
        $table_val = "'$account_id', '$schedule_id[$x]', '$ordered_list[$x]', '$course_id', '$academic_id', '$semester_id', '$year_level_id', '$section_id'"; 
        $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
        // echo $table."==".$table_col."==".$table_val."<br>";
        
        $table = "system_student_grades";
        $table_col = "`student_id`, `subject_id`, `teacher_id`, `course_id`, `academic_year_id`, `semester_id`, `year_level_id`, `section_id`";
        $table_val = "'$account_id', '$subject_id[$x]', '$teacher_id[$x]', '$course_id', '$academic_id', '$semester_id', '$year_level_id', '$section_id'"; 
        $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
        // echo $table."==".$table_col."==".$table_val."<br>";
    }

    $SelectGroups = $systemcore->SelectTable("yearl_level_fees WHERE year_level_id = '$year_level_id'");
    foreach($SelectGroups as $value){
      $fee_id = $value["fees_id"];
    }
    $fees_id = explode(",",$fee_id);

    foreach($fees_id as $id){
      $SelectFees = $systemcore->SelectTable("system_fees WHERE id = '$id'");
      foreach($SelectFees as $value){
        $amount = $value["fees_amount"];
        $fees_name = $value["fees_name"];
        $type = $value["fees_type"];

        $table = "student_fees";
        $table_col = "`student_id`, `department_id`, `course_id`, `year_level_id`,  `amount`, `fees_name`, `fee_type`, `academic_year_id`, `semester_id`, `section_id`";
        $table_val = "'$account_id', '$department_id', '$course_id', '$year_level_id', '$amount', '$fees_name', '$type', '$academic_id', '$semester_id', '$section_id'"; 
        $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);
        }
    }

    if($counter_num == 8){
        exit;
    }
    $counter_num++;
    echo $counter_num;
}
