<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
$counter_num=0;
$SelectGroupsa = $systemcore->SelectTable("system_department_student WHERE student_activation ='PENDING'");

foreach($SelectGroupsa as $value1){  

    $account_id = $value1["student_id"];

    $payment = '1000';
    $course_id = $value1["course_id"];
    $academic_year_id = $value1["academic_year_id"];
    $semester_id = $value1["semester_id"];
    $year_level_id = $value1["year_level_id"];
    $section_id = $value1["section_id"];

    $table = "system_student_payments";
    $table_col = "`student_id`, `amount`, `course_id`, `academic_year_id`, `semester_id`, `year_level_id`, `section_id`";
    $table_val = "'$account_id', '$payment', '$course_id', '$academic_year_id', '$semester_id', '$year_level_id', '$section_id'"; 
    $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);

    $table = "system_department_student";
    $col_to_update = "student_activation='ACTIVE'";
    $indicator = "student_id = '$account_id' AND course_id = '$course_id' AND academic_year_id = '$academic_year_id' AND semester_id = '$semester_id' AND year_level_id = '$year_level_id' AND section_id = '$section_id'";
    $UpdateTable = $systemcore->UpdateTable($table, $col_to_update, $indicator);
}
