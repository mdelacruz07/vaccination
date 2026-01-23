
<?php

include '../../controller/systemcore.php'; 
$systemcore = new systemcore();

$array_academic = array('1','2','3','4','5','6','7','8','9','10');
for ($i = 0; $i < 300; $i++) {
  $academic_year = "10";
  $table = "system_department_student";
  $table_col = "`student_id`, `department_id`, `course_id`, `academic_year_id`, `semester_id`, `year_level_id`, `section_id`, `student_status`, `student_activation`";
  $table_val = "'example', '1', '1', '$academic_year', '1', '1', '1', 'NEW', 'ACTIVE'"; 
  $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);

  echo $table_val."------Number".$i."<br>";
}
?>