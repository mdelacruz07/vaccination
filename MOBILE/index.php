<?php
include '../database/connector.php';
    $sql = "SELECT * FROM system_config";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while($row = mysqli_fetch_assoc($result)) { 
            $main_link = $row["system_main_redirect"];
            if($main_link == "page_404"){
                header("Location: ../pages/error/404.php");
            }else if($main_link == "page_500"){
                header("Location: ../pages/error/500.php");
            }else{
                header("Location: ../pages/login/login_mobile.php");
            }
        }
    }
    
?>

<!-- 
make a select button where you can add a specific link to redirect any user incase of errors or in a specific login time!!!! the credentials are in the data base details are up ahead!!!
 -->