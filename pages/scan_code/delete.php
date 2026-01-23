<?php

    // set the expiration date to one hour ago
    unset($_COOKIE['OVRM_QR_ID']); 
    setcookie('OVRM_QR_ID', null, -1, '/'); 

    unset($_COOKIE['OVRM_QR_NAME']); 
    setcookie('OVRM_QR_NAME', null, -1, '/'); 

    header("Location: http://bagocho.pagenet.info/");

?>