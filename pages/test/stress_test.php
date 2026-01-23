<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();

    $date_added = date("Y-m-d");

    $profile_picture = "Example";
    $first_name = "Example";
    $last_name = "Example";
    $middle_name = "Example";
    $suffix = "Example";
    $age = "Example";
    $birthday = date("Y-m-d");
    $gender = "Example";
    $address = "Example";
    $contuct = "Example";
    $username = "Example";
    $password = "Example";
    $access = "None";
    
    for ($i = 0; $i < 2000; $i++) {
        $table = "system_user";
        $table_col = "first_name, middle_name, last_name, suffix, age, birthday, gender, username, password, address, contuct, access, date_added, profile_picture";
        $table_val = "'$first_name', '$middle_name', '$last_name', '$suffix', '$age', '$birthday', '$gender', '$username', '$password', '$address', '$contuct', '$access', '$date_added', '$profile_picture'"; 
        $InsertTable = $systemcore->InsertTable($table, $table_col, $table_val);

        echo $table_val."------Number".$i."<br>";
    }



?>