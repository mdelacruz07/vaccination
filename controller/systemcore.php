<?php

class systemcore {

    public function SystemLogs($operation, $description) { 
        // error_reporting(0);
        //include '../../database/connector.php';
        //session_start();
        //$description = preg_replace("/[^A-Za-z0-9 |]/", ' ', $description);

        //$name = $_SESSION['user_full_name'];
        //$user_id = $_SESSION["user_id"];
        //$access_level = $_SESSION["user_access_level"];
        
        //$sql = "INSERT INTO system_logs (description, access, user_id, user_name, operation) VALUES ('" . $description . "', '" . $access_level . "', '" . $user_id . "', '" . $name . "', '" . $operation . "')";
        //$result = $conn->query($sql);
    }
    
    
    public function SelectTable($table) { 
        // error_reporting(0);
        include '../../database/connector.php';
        $sql = "SELECT * FROM $table";
        // echo $sql;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }
        else{
            return $list = "none";
        }
    }

    public function SelectCustomize($query) { 
        // error_reporting(0);
        include '../../database/connector.php';
        // echo $query;    
        $sql = $query;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }
        else{
            return $list = "none";
        }
    }

    public function UpdateTable($table, $col_to_update, $indicator) { 
        // error_reporting(0);
        include '../../database/connector.php';

        // echo "UPDATE $table SET $col_to_update WHERE $indicator";   
        $sql = "UPDATE $table SET $col_to_update WHERE $indicator";
        $result = $conn->query($sql);

        if (!$result) {
            echo "SQL Error: " . $conn->error . "<br>";
            echo "Query: " . $sql;
        }

        return $result;

        // $description = "$sql";
        // $description = preg_replace("/[^A-Za-z0-9 |]/", ' ', $description);
        
        // $this->SystemLogs('Update', $description);
        
    }

    public function InsertTable($table, $table_col, $table_val) { 
        
        // error_reporting(0);
        include '../../database/connector.php';
        // echo "INSERT INTO $table ($table_col) VALUES ($table_val)"."<br>";
        $sql = "INSERT INTO $table ($table_col) VALUES ($table_val)";
        $result = $conn->query($sql);
        
        if (!$result) {
            echo "SQL Error: " . $conn->error . "<br>";
            echo "Query: " . $sql;
        }

        return $result;

        // $description = "$sql";
        // $description = preg_replace("/[^A-Za-z0-9 |]/", ' ', $description);
        
        // $this->SystemLogs('Create', $description);
    }

    public function DeleteTable($table, $indicator) { 
        // error_reporting(0);
        include '../../database/connector.php';
        // echo "DELETE FROM $table WHERE $indicator";
        $sql = "DELETE FROM $table WHERE $indicator";
        $result = $conn->query($sql);

        $description = "$sql";
        $description = preg_replace("/[^A-Za-z0-9 |]/", ' ', $description);
        
        $this->SystemLogs('Delete', $description);
    }

    public function SystemAlert() {  
        // error_reporting(0);
        
        if(empty($_SESSION["alert_type"])){
            // no alert
        }
        else{
            $message = $_SESSION["alert_message"];
            if($_SESSION["alert_type"] == "success"){
                echo "<script> system_alert('success','$message'); </script>";
            }
            else if($_SESSION["alert_type"] == "warning"){
                echo "<script> system_alert('warning','$message'); </script>";
            }
            else if($_SESSION["alert_type"] == "danger"){
                echo "<script> system_alert('error','$message'); </script>";
            }else{
                // no alert to display
            }

            $_SESSION["alert_type"] = " ";
            $_SESSION["alert_message"] = " ";
        }
    }

    public function System_Sessioning($session_type) {
        // error_reporting(0);  
        session_start();
        date_default_timezone_set('Asia/Manila');

        //Selecting The System UI
        include '../../database/connector.php';

        if(empty($_SESSION["system_title"])){
            $sql = "SELECT * FROM system_config";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while($row = mysqli_fetch_assoc($result)) { 
                    $_SESSION["system_title"] = $row["title"];
                    $_SESSION["system_head_title"] = $row["head_title"];
                    $_SESSION["nav_bar_title"] = $row['nav_bar_title'];
                    $_SESSION["system_nav_bar"] = $row["nav_bar"];  
                    $_SESSION["system_nav_bar_text_color"] = $row["nav_bar_text_color"]; 
                    $_SESSION["system_side_bar"] = $row["side_bar"];  
                    $_SESSION["system_side_bar_text"] = $row["side_bar_text"]; 
                    $_SESSION["system_hover_side_bar_text"] = $row["hover_side_bar_text"];  
                    $_SESSION["system_hover_side_bar_text_bg"] = $row["hover_side_bar_text_bg"]; 
                    $_SESSION["system_system_date_creation"] = $row["system_date_creation"];
                    $_SESSION["system_logo"] = $row["system_logo"];
                    $_SESSION["system_login_background_image"] = $row["login_background_image"];
                    $_SESSION["system_background_image"] = $row["background_image"];

                    $_SESSION["system_header_color"] = $row["header_color"];
                    $_SESSION["system_header_font_color"] = $row["header_font_color"];
                    $_SESSION["system_modal_header_color"] = $row["modal_header_color"];
                    $_SESSION["system_modal_header_font_color"] = $row["modal_header_font_color"];

                    $_SESSION["system_add_bg_btn_color"] = $row["system_add_bg_btn_color"];
                    $_SESSION["system_add_btn_border"] = $row["system_add_btn_border"];
                    $_SESSION["system_add_btn_color"] = $row["system_add_btn_color"];
                    $_SESSION["system_add_btn_size"] = $row["system_add_btn_size"];

                    $_SESSION["system_delete_bg_btn_color"] = $row['system_delete_bg_btn_color'];
                    $_SESSION["system_delete_btn_border"] = $row['system_delete_btn_border'];
                    $_SESSION["system_delete_btn_color"] = $row['system_delete_btn_color'];
                    $_SESSION["system_delete_btn_size"] = $row['system_delete_btn_size'];
            
                    $_SESSION["system_edit_bg_btn_color"] = $row['system_edit_bg_btn_color'];
                    $_SESSION["system_edit_btn_border"] = $row['system_edit_btn_border'];
                    $_SESSION["system_edit_btn_color"] = $row['system_edit_btn_color'];
                    $_SESSION["system_edit_btn_size"] = $row['system_edit_btn_size'];
                    
                    $main_link = $row["system_main_redirect"];
                    
                    if($main_link == "page_404"){
                        header("Location: ../error/404.php");
                    }else if($main_link == "page_500"){
                        header("Location: ../error/500.php");
                    }
                }
            }
        }
        
        if($session_type == "unsession"){
            if(!empty($_SESSION["user_id"])){
                header("Location: ../dashboard/");
            }
        }

        if($session_type == "session"){
            if(empty($_SESSION["user_id"])){
                header("Location: ../login/");
            }
        }
    }

    public function Condition_Query($department_id, $dep_conditional_string, $course_id, $first_course_conditional_string, $second_course_conditional_string) { 
        
        if($department_id != "none"){

            if($department_id != "ALL"){
                $condition_on_query = "$dep_conditional_string = ".$department_id;
            }else{
                $condition_on_query = "";
            }

            if($course_id != "none"){
                if($course_id != "ALL"){
                    if($condition_on_query != ""){
                        $condition_on_query = $condition_on_query."".$first_course_conditional_string." = '".$course_id."'";
                    }else{
                        $condition_on_query = $second_course_conditional_string." = '".$course_id."'";
                    }
                }
            }
        }else{
            $condition_on_query = "";
        }
        return $condition_on_query; 
    }


}
?>







