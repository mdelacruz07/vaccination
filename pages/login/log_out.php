<?php   
        session_start();

        include '../../controller/systemcore.php'; 
        $systemcore = new systemcore();

        $operation = "Log-Out";
        $description = "Performed $operation";
        $SystemLogs = $systemcore->SystemLogs($operation, $description);

        session_destroy();
        header("Location: ../login/");
?>