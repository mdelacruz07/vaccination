<?php

class systemtable {
    public function SelectCustomize($query) { 
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

    public function List_Barangay() { 
        $barangay = array("ABUANAN","ALIANZA","ATIPULUAN","BACONG-MONTILLA","BAGROY","BALINGASAG","BINUBUHAN","BUSAY","CALUMANGAN","CARIDAD","DON JORGE L. ARANETA","DULAO","ILIJAN","LAG-ASAN","MA-AO","MAILUM","MALINGIN","NAPOLES","PACOL","POBLACION","SAGASA","SAMPINIT","TABUNAN","TALOC");
        return  $barangay;
    }   

    public function List_Barangay_Selector() { 
        $barangay = array("1","2","3","4","5","6","7","8","9","10","1","12","13","14","15","16","17","18","19","20","21","22","23","24","25","26");
        return  $barangay;
    }  
    public function List_Barangay_Selector_Names() { 
        $barangay = array("","All","ABUANAN","ALIANZA","ATIPULUAN","BACONG-MONTILLA","BAGROY","BALINGASAG","BINUBUHAN","BUSAY","CALUMANGAN","CARIDAD","DON JORGE L. ARANETA","DULAO","ILIJAN","LAG-ASAN","MA-AO","MAILUM","MALINGIN","NAPOLES","PACOL","POBLACION","SAGASA","SAMPINIT","TABUNAN","TALOC");
        return  $barangay;
    } 
    public function List_Months() { 
        $barangay = array("January","Febuary","March","April","May","June","July","August","September","October","November","December");
        return  $barangay;
    } 

    public function SelectingTable($table_name,$values) { 
        
        // session_start();
        if($table_name == "show_user"){ ?>

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Access</th>
                    <th>Date Added</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody> <?php
                $SelectTable = $this->SelectCustomize("SELECT system_user.*, system_page_access.name as access_name FROM system_user LEFT JOIN system_page_access ON system_user.access = system_page_access.page_access WHERE username!='super.admin'");
                if($SelectTable != "none"){
                    $x = 0;
                    foreach($SelectTable as $value){
                        $x++;
                        echo "<tr>";
                            echo "<td><span id='".$value['id']."-first_name'>".$value['first_name']."</span></td>";
                            echo "<td id='".$value['id']."-access'>".$value['access_name']."</td>";
                            echo "<td>".$value['date_added']."</td>" ;
                            ?>
                            <td class="row">
                                <button onclick="sys_edit('edit.php', 'veiw_result', '<?php echo $value['id'];?>', 'required_div', '#example1')" type="button" class="col-sm-10 btn btn-block btn-outline-info" data-toggle="modal" data-target="#update">Edit</button><br>
                                <div class="icheck-danger col-sm-2 d-inline">
                                    <input type="checkbox" value="<?php echo $value['id'];?>" onclick="selection(this.value, 'select_to_delete_input', 'none')" id="checkboxPrimary<?php echo $x;?>">
                                    <label for="checkboxPrimary<?php echo $x;?>">
                                    </label>
                                </div>
                            </td> <?php
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='4' style='text-align: center;'>No Data Available</td></tr>";
                } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><button onclick="set_system_cardinal_operation('You want to Delete all the selected?', 'delete', 'select_to_delete', 'delete_user.php', 'user_table', 'show_user', '#example1', 'required_div', 'confirmation_delete_success', 'none')" type="button" class="col-sm-12 btn btn-block btn-outline-danger">Delete Selected</button></th>
                    </tr>
                </tfoot>
            </table> <?php


        }else if($table_name == "show_logs"){ ?>
           
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>time_stamp</th>
                    <th>description</th>
                    <th>user_name</th>
                    <th>operation</th>
                </tr>
                </thead>
                <tbody> <?php
                $SelectTable = $this->SelectCustomize("SELECT * FROM system_logs");
                if($SelectTable != "none"){
                    $x = 0;
                    foreach($SelectTable as $value){
                        $x++;
                        echo "<tr>";
                            echo "<td>".$value['time_stamp']."</td>";
                            echo "<td>".$value['description']."</td>";
                            echo "<td>".$value['user_name']."</td>";
                            echo "<td>".$value['operation']."</td>";
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='4' style='text-align: center;'>No Data Available</td></tr>";
                } ?>
                </tbody>
            </table> <?php

        }else if($table_name == "sys_confi_page_access"){ ?>
            <div class="row">
                <div class="col-sm-6 card  card-info card-outline" style="padding-top:10px; ">
                    <label>Type of Access Levels</label> <br>
                    <button type='button' class='btn btn-block btn-success' data-toggle="modal" data-target="#create_access_level" style="margin-bottom:5px;">Add New Access Level</button>
                    
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Access Name</th>
                            <th>Time-Stamp</th>
                        </tr>
                        </thead>
                        <tbody> <?php
                        $SelectTable = $this->SelectCustomize("SELECT * FROM system_page_access");
                        if($SelectTable != "none"){
                            $x = 0;
                            foreach($SelectTable as $value){
                                $x++;
                                echo "<tr>";
                                    echo "<td>".$value['page_access']."</td>"; ?> 
                                    <td><button onclick="sys_edit('edit_access.php', 'page_access_edit', '<?php echo $value['page_access'];?>', 'required_div', '#example1')" type='button' class='btn btn-block btn-default' id='<?php echo $value['page_access']?>-access_name' ><?php echo $value['name']; ?></button></td> <?php
                                    echo "<td>".$value['time_stamp']."</td>";
                                   
                                echo "</tr>";
                            }
                        }else{
                            echo "<tr><td colspan='3' style='text-align: center;'>No Data Available</td></tr>";
                        } ?>
                        </tbody>
                    </table>
                    <br>
                </div>
                <div class="col-sm-6 card" id="page_access_edit" style="padding-top:10px; ">
                    
                </div>
            </div><?php
        }else if($table_name == "sys_confi_page_access_edit"){ ?>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Page Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody> <?php

                $length = count($values);
                $SelectTable = $this->SelectCustomize("SELECT * FROM system_pages");
                if($SelectTable != "none"){
                    $x = 0;
                    
                    foreach($SelectTable as $value){
                    $input_status = "";
                    $value_error = 0;
                        for ($i = 0; $i < $length; $i++) {
                            if($value['pages_id'] == $values[$i]){
                                $value_error++;
                            }
                        }
                        if($value_error != 0){
                            $input_status = "checked";
                        }
                        $x++;
                        echo "<tr>";
                            echo "<td>".$value['pages_id']."</td>"; 
                            echo "<td>".$value['page_name']."</td>";
                            echo "<td>"; ?>
                            <div class="icheck-danger col-sm-2 d-inline">
                                <input type="checkbox" <?php echo $input_status; ?> id="checkboxPrimary<?php echo $x;?>" name="selection[]" onclick="selection('<?php echo $value['pages_id']; ?>', 'selected_id')">
                                <label for="checkboxPrimary<?php echo $x;?>">
                                </label>
                            </div> <?php
                            echo "</td>";  
                        echo "</tr>";
                    }
                }?>
                </tbody>
            </table><?php
        }else if($table_name == "sys_confi_pages"){ ?>
            <div class="row">
                <div class="col-sm-12 card  card-info card-outline" style="padding:20px; ">
                    <div class="row">
                        <h2 class="card-title col-lg-10" style="padding-top:10px; "><b>List of Pages</b></h2>
                        <button type='button' class='btn btn-block btn-success col-lg-2' data-toggle="modal" data-target="#create_new_page" style="margin-bottom:5px;">Add New Page</button>
                    </div>
                    <hr>
                    <div id="page_result">
                    </div>
                    <!-- This Alert is needed -->
                    <div class="alert alert-danger custom_required alert-dismissible fade show" id="required_div" role="alert" hidden>
                        <strong>ERROR!</strong> Please Fill in the required Inputs below!
                        <button type="button" class="close" onclick="turn_off_required('required_div')" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
                    <form id ="page_update_form" enctype="multipart/form-data">
                        <table id="example2" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Link</th>
                                <th>Icon</th>
                                <th>Navigation Group</th>
                                <th>Time-Stamp</th>
                            </tr>
                            </thead>
                            <tbody> <?php
                            // $SelectTable = $this->SelectCustomize("SELECT * FROM system_pages");
                            $SelectTable = $this->SelectCustomize("SELECT system_pages.*, system_nav_group.nav_group_name as nav_group_name FROM system_pages LEFT JOIN system_nav_group ON system_pages.nav_group_id = system_nav_group.id");
                            if($SelectTable != "none"){
                                $x = 0;
                                foreach($SelectTable as $value){
                                    $x++;
                                    echo "<tr>";
                                        echo "<td hidden><input type='text' class='form-control float-right' value='".$value['pages_id']."' name='primary_key[]' hidden> </td>"; 
                                        echo "<td>".$value['pages_id']." <span id='".$value['pages_id']."-page_name'>".$value['page_name']."</span> <input type='text' class='form-control float-right' value='".$value['pages_id']."' name='pages_id[]' hidden> </td>"; 
                                        echo "<td><input type='text' class='form-control float-right' value='".$value['page_name']."' name='page_name[]'> </td>";
                                        echo "<td><input type='text' class='form-control float-right' value='".$value['page_link']."' name='page_link[]'> </td>";
                                        echo "<td><input type='text' class='form-control float-right' value='".$value['page_icon']."' name='page_icon[]'> </td>"; ?>
                                        <td>
                                        <div class="form-group col-lg-12">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                </div>
                                                <select name="nav_group_id[]" class="form-control"  alt="required"><?php
                                                    echo "<option hidden value='".$value['nav_group_id']."'>".$value['nav_group_name']."</option>";
                                                    $SelectGroups = $this->SelectCustomize("SELECT * FROM system_nav_group");
                                                    foreach($SelectGroups as $data){  
                                                        echo "<option value='".$data['id']."'>".$data['nav_group_name']."</option>";
                                                }?>
                                                </select>
                                            </div>
                                        </div>
                                        </td> <?php
                                        echo "<td><input type='text' class='form-control float-right' value='".$value['time_stamp']."' name='time_stamp[]' readonly> </td>";
                                    
                                    echo "</tr>";
                                }
                            }else{
                                echo "<tr><td colspan='5' style='text-align: center;'>No Data Available</td></tr>";
                            } ?>
                            </tbody>
                        </table>
                    </form>
                    <div class="modal-footer justify-content-between">
                            <div></div>
                            <button type="submit" onclick="set_system_cardinal_operation('You want to Update this Page Settings?', 'update', 'page_update_form', 'update_pages.php', 'page_result', 'none', 'none', 'required_div', 'confirmation_update_success', 'none')" class="btn btn-primary col-sm-2">Update</button>                           
                        </div>
                    <br>
                </div>
            </div><?php 
        }else if($table_name == "sys_confi_page_group"){ ?>
            <div class="row">
                <div class="col-sm-12 card  card-info card-outline" style="padding:20px; ">
                    <div class="row">
                        <h2 class="card-title col-lg-10" style="padding-top:10px; "><b>List of Navigation Groups</b></h2>
                        <button type='button' class='btn btn-block btn-success col-lg-2' data-toggle="modal" data-target="#create_new_nav_group" style="margin-bottom:5px;">Add New Navigation Group Page</button>
                    </div>
                    <hr>
                    <div id="page_result">
                    </div>
                    <!-- This Alert is needed -->
                    <div class="alert alert-danger custom_required alert-dismissible fade show" id="required_div" role="alert" hidden>
                        <strong>ERROR!</strong> Please Fill in the required Inputs below!
                        <button type="button" class="close" onclick="turn_off_required('required_div')" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> 
                    <form id ="page_nav_group_update_form" enctype="multipart/form-data">
                        <table id="example3" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Navigation Name</th>
                                <th>Time-Stamp</th>
                            </tr>
                            </thead>
                            <tbody> <?php
                            // $SelectTable = $this->SelectCustomize("SELECT * FROM system_pages");
                            $SelectTable = $this->SelectCustomize("SELECT * FROM system_nav_group");
                            if($SelectTable != "none"){
                                $x = 0;
                                foreach($SelectTable as $value){
                                    $x++;
                                    echo "<tr>";
                                        echo "<td><input type='text' hidden class='form-control float-right' readonly value='".$value['id']."' name='primary_key[]'> </td>"; 
                                        echo "<td><input type='text' class='form-control float-right' readonly value='".$value['id']."' name='nav_id[]'> </td>"; 
                                        echo "<td><input type='text' class='form-control float-right' value='".$value['nav_group_name']."' name='nav_group_name[]'> </td>";
                                        echo "<td><input type='text' class='form-control float-right' value='".$value['time_stamp']."' name='time_stamp[]' readonly> </td>";
                                    echo "</tr>";
                                }
                            }else{
                                echo "<tr><td colspan='5' style='text-align: center;'>No Data Available</td></tr>";
                            } ?>
                            </tbody>
                        </table>
                    </form>
                    <div class="modal-footer justify-content-between">
                            <div></div>
                            <button type="submit" onclick="set_system_cardinal_operation('You want to Update this Navigation Settings?', 'update', 'page_nav_group_update_form', 'update_nav_group_pages.php', 'page_result', 'none', 'none', 'required_div', 'confirmation_update_success', 'none')" class="btn btn-primary col-sm-2">Update</button>                           
                        </div>
                    <br>
                </div>
            </div><?php 
        }else if($table_name == "show_facilities"){ ?>

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Facility Name</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Date Added</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody> <?php
                $SelectTable = $this->SelectCustomize("SELECT * FROM system_facilities");
                if($SelectTable != "none"){
                    $x = 0;
                    foreach($SelectTable as $value){
                        $x++;
                        echo "<tr>";
                            echo "<td id='".$value['id']."-facility_name'>".$value['facility_name']."</td>";
                            echo "<td id='".$value['id']."-location'>".$value['location']."</td>";
                            echo "<td id='".$value['id']."-status'>".$value['status']."</td>";
                            echo "<td>".$value['time_stamp']."</td>" ;
                            ?>
                            <td class="row">
                                <button onclick="sys_edit('edit.php', 'veiw_result', '<?php echo $value['id'];?>', 'required_div', '#example1')" type="button" class="col-sm-12 btn btn-block btn-outline-info" data-toggle="modal" data-target="#update">Edit</button>
                            </td> <?php
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='4' style='text-align: center;'>No Data Available</td></tr>";
                } ?>
                </tbody>
            </table> <?php


        }else if($table_name == "vaccines"){ ?>
            <table id="tbl_vaccines" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Vaccine Name</th>
                    <th>Type</th>
                    <th>Manufacturer</th>
                    <th>Dose per Vial</th>
                    <th>Description</th>
                    <th>Date Added</th>
                    <th>Edit / Delete</th>
                </tr>
                </thead>
                <tbody> <?php
                $SelectTable = $this->SelectCustomize("SELECT * FROM vaccines WHERE is_archive = 0");
                if($SelectTable != "none"){
                    $x = 0;
                    foreach($SelectTable as $value){
                        $x++;
                        echo "<tr>";
                            echo "<td>".$x."</td>";
                            echo "<td>".$value['name']."</td>";
                            echo "<td>".$value['type']."</td>";
                            echo "<td>".$value['manufacturer']."</td>";
                            echo "<td>".$value['dose_per_vial']."</td>";
                            echo "<td>".$value['description']."</td>";
                            echo "<td>".$value['created_at']."</td>" ;
                            ?>
                            <td class="row m-0">
                                <button onclick="sys_edit('edit.php', 'veiw_result', '<?php echo $value['id'];?>', 'required_div', '#tbl_vaccines')" type="button" class="col-sm-10 btn btn-block btn-outline-info" data-toggle="modal" data-target="#update">Edit</button>
                                <div class="icheck-danger col-sm-2 d-inline">
                                    <input type="checkbox" class="delete-checkbox-vaccines" value="<?php echo $value['id'];?>" onclick="selection(this.value, 'select_to_delete_input', 'none')" id="checkboxPrimary<?php echo $x;?>">
                                    <label for="checkboxPrimary<?php echo $x;?>"></label>
                                </div>
                            </td> <?php
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='4' style='text-align: center;'>No Data Available</td></tr>";
                } ?>
                </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th><button onclick="set_system_cardinal_operation('You want to Delete all the selected?', 'delete', 'select_to_delete', 'delete_vaccine.php', 'vaccine_table', 'vaccines', '#tbl_vaccines', 'required_div', 'confirmation_delete_success', 'none')" type="button" id="btn-delete-selected-vaccines" class="col-sm-12 btn btn-block btn-outline-danger" disabled>Delete Selected</button></th>
                        </tr>
                    </tfoot>
            </table> <?php

        }else if($table_name == "vaccine_supplier"){ ?>
            <table id="tbl_suppliers" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>Name</th>
                    <th>Contact Person</th>
                    <th>Phones</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Date Added</th>
                    <th>Edit / Delete</th>
                </tr>
                </thead>
                <tbody> <?php
                $SelectTable = $this->SelectCustomize("SELECT * FROM vaccine_supplier WHERE is_archive = 0");
                if($SelectTable != "none"){
                    $x = 0;
                    foreach($SelectTable as $value){
                        $x++;
                        echo "<tr>";
                            echo "<td>".$x."</td>";
                            echo "<td>".$value['name']."</td>";
                            echo "<td>".$value['contact_person']."</td>";
                            echo "<td>".$value['phone']."</td>";
                            echo "<td>".$value['email']."</td>";
                            echo "<td>".$value['address']."</td>";
                            echo "<td>".$value['created_at']."</td>" ;
                            ?>
                            <td class="row m-0">
                                <button onclick="sys_edit('edit.php', 'veiw_result', '<?php echo $value['id'];?>', 'required_div', '#tbl_suppliers')" type="button" class="col-sm-10 btn btn-block btn-outline-info" data-toggle="modal" data-target="#update">Edit</button>
                                <div class="icheck-danger col-sm-2 d-inline">
                                    <input type="checkbox" class="delete-checkbox-vaccines" value="<?php echo $value['id'];?>" onclick="selection(this.value, 'select_to_delete_input', 'none')" id="checkboxPrimary<?php echo $x;?>">
                                    <label for="checkboxPrimary<?php echo $x;?>"></label>
                                </div>
                            </td> <?php
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='4' style='text-align: center;'>No Data Available</td></tr>";
                } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><button onclick="set_system_cardinal_operation('You want to Delete all the selected?', 'delete', 'select_to_delete', 'delete_supplier.php', 'supplier_table', 'vaccine_supplier', '#tbl_suppliers', 'required_div', 'confirmation_delete_success', 'none')" type="button" id="btn-delete-selected-vaccines" class="col-sm-12 btn btn-block btn-outline-danger" disabled>Delete Selected</button></th>
                    </tr>
                </tfoot>
            </table> <?php


        }else if($table_name == "show_schedule"){ 
            // echo $values;
            $values = explode(",",$values);
            $selected_facility_id = $values[0];
            $selected_month = $values[1];
            $selected_year = $values[2];
            $accordion_status = $values[3];
    
            $starting_day = date('l',mktime(0, 0, 0, $selected_month, 1, $selected_year));
            $end_date = date('t',mktime(0, 0, 0, $selected_month, 1, $selected_year));


            $display_date = "OFF";
            $monthNum  = $selected_month;
            $dateObj   = DateTime::createFromFormat('!m', $monthNum);
            $monthName = $dateObj->format('F');

            $selected_month_no_zero = ltrim($selected_month, '0');
            // echo $selected_month_no_zero;
            $Selected_Schedules = $this->SelectCustomize("SELECT system_schedule.*,
                system_vaccines.vaccine_name as vaccine_name 
                FROM system_schedule 
                LEFT JOIN system_vaccines 
                ON system_schedule.vaccine = system_vaccines.id 
                WHERE system_schedule.year = '$selected_year' 
                AND system_schedule.month = '$selected_month_no_zero' 
                AND system_schedule.facility_id = '$selected_facility_id' ORDER BY day");

            $Selected_Vaccine = $this->SelectCustomize("SELECT * FROM system_vaccines");
            $Selected_Barangay = $this->List_Barangay();
            $List_Barangay_Selector = $this->List_Barangay_Selector();
            $List_Barangay_Selector_names = $this->List_Barangay_Selector_Names();
            $List_Months = $this->List_Months();
            $day_name = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
            $days = 0;?>

            <style>
                td{
                    height: 150px;
                    
                }
                .row input{
                    font-size:13px;
                    padding: 0px 0px 0px 5px;
                    height:30px;    
                }
                .row select{
                    font-size:13px;
                    padding: 0px 0px 0px 5px;
                    height:30px;    
                }
            </style>

            <div id="accordion">
                <div class="card">
                    <div class="card-body text-center" id="headingTwo">
                        <h5 class="mb-0">
                            <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <b>View Schedule Settings</b>
                            </button>
                            
                        </h5>
                    </div>
                    <div id="collapseTwo" class="collapse <?php echo $accordion_status; ?>" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body mt-0 pt-0 row">
                            <div class="col-sm-2">
                                <p class="col-sm-12 text-center"><b>Options</b></p>
                                <button class="btn btn-default col-sm-12  mb-2" onclick="Select_all('check_box')" >Select All</button>
                                <button class="btn btn-outline-warning col-sm-12 mb-2" onclick="Un_Select_all('check_box')" >Un-Select All</button>
                            </div>
                            <div class="col-sm-8 row">
                                <p class="col-sm-12 text-center"><b>Change Selected Details</b></p>
                                <div class="col-4">
                                    <select class="form-control col-12 mb-2" onchange="set_brgy_value(this.value)"><?php
                                        $c = 0;
                                        foreach($List_Barangay_Selector as $brgy){  
                                            echo "<option value='".$brgy."'>".$List_Barangay_Selector_names[$c]."</option>";
                                            $c++;
                                        }?>
                                    </select>
                                    <select class="form-control col-12 mb-2" onchange="set_vaccine_value(this.value)">  
                                        <option value=" "> </option><?php
                                        $c = 2;
                                        foreach($Selected_Vaccine as $vaccine){  
                                            echo "<option value='".$c."'>".$vaccine['vaccine_name']."</option>";
                                            $c++;
                                        }?>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control col-12 mb-2 " placeholder="Age Limit (ex. 19-26)" oninput="set_age_limit_value(this.value)">
                                    <input type="text" class="form-control col-12 mb-2" placeholder="Slots (ex. 250)" oninput="set_slots_value(this.value)">
                                </div>
                                <div class="col-4">
                                    <input type="text" class="form-control col-12 mb-2" placeholder="Time (ex. 6:00 AM-5:00 PM)" oninput="set_time_value(this.value)">
                                    <select  class="form-control col-12 mb-2" onchange="set_status_value(this.value)">
                                        <option value="0" hidden></option>
                                        <option value="1" ></option>
                                        <option value="2" >Remove</option>
                                        <option value="3">Pending</option>
                                        <option value="4">In-Active</option>
                                        <option value="5" >Active</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <p class="col-sm-12 text-center"><b>Date</b></p>
                                <form id="schedule_date_form">
                                    <input type="text" id="selected_facility_id" hidden value="<?php echo $selected_facility_id; ?>">
                                    <input id="accordion_status" type="text" value="show" hidden>
                                    <select id="selected_month" class="form-control col-12 mb-2">
                                        <option hidden value="<?php echo $selected_month;?>"><?php echo $List_Months[$selected_month-1];?></option><?php
                                        $c = 1;
                                        foreach($List_Months as $month){  
                                            echo "<option value='".$c."'>".$month."</option>";
                                            $c++;
                                        }?>
                                    </select>
                                    <select id="selected_year" class="form-control col-12 mb-2">
                                        <option hidden value="<?php echo $selected_year;?>"><?php echo $selected_year;?> </option><?php
                                        $sy = 2020;
                                        $ey = date("Y") + 3;
                                        for($c = $sy ; $c <= $ey ; $c++){  
                                            echo "<option value='".$c."'>".$c."</option>";
                                        }?>
                                    </select>
                                    <button type="button" class="btn btn-outline-info col-sm-12 mb-2"  onclick="select_for_filtering('tab', 'show_schedule', '#example1', 'selected_facility_id,selected_month,selected_year,accordion_status')">Select Date </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="update_result">
            </div>
            <form id="schedule_form">
            
            <input id="selected_days_checkbox" type="text" hidden>
            <input type="text" value="<?php echo $selected_month_no_zero; ?>" name="month" hidden>
            <input type="text" value="<?php echo $selected_year; ?>" name="year" hidden >
            <input type="text" value="<?php echo $selected_facility_id; ?>" name="facility_id" hidden >
            <table class="table table-bordered table-striped">
                <thead>
                    <tr colspan="8"><center><h3><b><?php echo $monthName; ?><Br><h5><?php echo $selected_year; ?></h5></b></h3></center></tr>
                    <tr> <?php 
                        foreach ($day_name as $day){ ?>
                            <th><?php echo $day ?></th> <?php 
                        }  ?> 
                    </tr>
                </thead>
                <tbody> <?php 
                    for($x = 1; $x <= 6; $x++){ ?>
                        <tr><?php 
                            foreach ($day_name as $day){
                                    if($starting_day == $day){
                                        $display_date = "ON";
                                    }
                                    if($end_date == $days){
                                        $display_date = "OFF";
                                    }
                                    if($display_date == "ON"){
                                        $days++; 
                                        $none_indicator = "ON";
                                        if($Selected_Schedules != 'none'){
                                            foreach($Selected_Schedules as $sched){ 
                                                if($days == $sched["day"]){
                                                    $none_indicator = "OFF";
                                                    if($sched["status"] == "ACTIVE"){
                                                        $td_color = "background-color:rgb(180, 212, 74);";
                                                        $td_status = " ";
                                                    }else if($sched["status"] == "IN-ACTIVE"){
                                                        $td_color = "background-color:rgb(237, 155, 126);";
                                                        $td_status = " ";
                                                    }else{
                                                        $td_color = "background-color:rgb(237, 188, 83);";
                                                        $td_status = " ";
                                                    }
                                                    ?>
                                                    <td style="<?php echo $td_color ?>">
                                                        <div class="row">
                                                            <p class="col-sm-10"><b style="font-size:20px;"><?php echo $sched["day"]; ?></b></p>
                                                            <input type="text" class="form-control" value="OLD" name="sched_indicator[]" hidden>
                                                            <input type="text" class="form-control" value="<?php echo $sched["day"] ?>" name="day[]" hidden>
                                                            <div class="icheck-success  col-sm-2 d-inline">
                                                                <input type="checkbox" class="check_box<?php echo $td_status ?>" value="<?php echo $sched["day"];?>" id="checkboxPrimary<?php echo $sched["day"];?>" onclick="selection('<?php echo $days;?>','selected_days_checkbox')" <?php echo $td_status ?>>
                                                                <label for="checkboxPrimary<?php echo $sched["day"];?>">
                                                                </label>
                                                            </div>
                                                            
                                                            <select hidden name="brgy[]" class="form-control" id="brgy_<?php echo $sched["day"];?>" <?php echo $td_status ?>>
                                                                <option value="<?php echo $sched["brgy"];?>" hidden><?php echo $sched["brgy"];?></option>
                                                                <option value="sys_none"></option>
                                                                <option value="All">All</option><?php
                                                                foreach($Selected_Barangay as $brgy){  
                                                                    echo "<option value='".$brgy."'>".$brgy."</option>";
                                                                }?>
                                                            </select>
                                                            <select name="vaccine[]" class="form-control" id="vaccine_<?php echo $sched["day"];?>" <?php echo $td_status ?>>
                                                                <option value="<?php echo $sched["vaccine"];?>" hidden><?php echo $sched["vaccine_name"];?></option>
                                                                <option value="sys_none"></option><?php
                                                                foreach($Selected_Vaccine as $vaccine){  
                                                                    echo "<option value='".$vaccine['id']."'>".$vaccine['vaccine_name']."</option>";
                                                                }?>
                                                            </select>
                                                            <input hidden type="text" class="form-control" value="<?php echo $sched["age_limit"];?>" name="age_limit[]" placeholder="Age Limit (ex. 19-26)" id="age_limit_<?php echo $sched["day"];?>" <?php echo $td_status ?>>
                                                            <input type="text" class="form-control" value="<?php echo $sched["slots"];?>" name="slots[]"placeholder="Slots (ex. 250)" id="slots_<?php echo $sched["day"];?>" <?php echo $td_status ?>>
                                                            <input type="text" class="form-control" value="<?php echo $sched["time"];?>" name="time[]" placeholder="Time (ex. 6:00 AM-5:00 PM)" id="time_<?php echo $sched["day"];?>" <?php echo $td_status ?>>
                                                            
                                                            <select name="status[]" class="form-control" id="status_<?php echo $sched["day"];?>" <?php echo $td_status ?>>
                                                                <option value="<?php echo $sched["status"];?>" hidden><?php echo $sched["status"];?></option>
                                                                <option value="sys_none"></option>
                                                                <option value="REMOVE">Remove</option>
                                                                <option value="PENDING">Pending</option>
                                                                <option value="IN-ACTIVE">In-Active</option>
                                                                <option value="ACTIVE">Active</option>
                                                            
                                                            </select>
                                                            <a target="_blank" href="../reports/print_masterlist_sched.php?id=<?php echo $sched["id"]; ?>"  class="btn btn-success col-12">Print Scheduled Master List</a>
                                                        </div>
                                                    </td><?php 
                                                }
                                            }
                                        }
                                        if($none_indicator == "ON"){?>
                                            <td>
                                                <div class="row">
                                                    <p class="col-sm-10"><b style="font-size:20px;"><?php echo $days ?></b></p>
                                                    <input type="text" class="form-control" value="<?php echo $days ?>" name="day[]" hidden>
                                                            <input type="text" class="form-control" value="NEW" name="sched_indicator[]" hidden>
                                                    <div class="icheck-success  col-sm-2 d-inline">
                                                        <input type="checkbox" class="check_box" value="<?php echo $days;?>" id="checkboxPrimary<?php echo $days;?>" onclick="selection('<?php echo $days;?>','selected_days_checkbox')">
                                                        <label for="checkboxPrimary<?php echo $days;?>">
                                                        </label>
                                                    </div>
                                                    
                                                    <select hidden name="brgy[]" class="form-control" id="brgy_<?php echo $days;?>">
                                                        <option hidden value="sys_none"></option>
                                                        <option value="sys_none"></option>
                                                        <option value="All">All</option><?php
                                                        foreach($Selected_Barangay as $brgy){  
                                                            echo "<option value='".$brgy."'>".$brgy."</option>";
                                                        }?>
                                                    </select>
                                                    <select name="vaccine[]" class="form-control" id="vaccine_<?php echo $days;?>">
                                                        <option hidden value="sys_none"></option>
                                                        <option value="sys_none"></option><?php
                                                        foreach($Selected_Vaccine as $vaccine){  
                                                            echo "<option value='".$vaccine['id']."'>".$vaccine['vaccine_name']."</option>";
                                                        }?>
                                                    </select>
                                                    <input hidden type="text" class="form-control" name="age_limit[]" placeholder="Age Limit (ex. 19-26)" id="age_limit_<?php echo $days;?>">
                                                    <input type="text" class="form-control" name="slots[]"placeholder="Slots (ex. 250)" id="slots_<?php echo $days;?>">
                                                    <input type="text" class="form-control" name="time[]" placeholder="Time (ex. 6:00 AM-5:00 PM)" id="time_<?php echo $days;?>">
                                                    <select name="status[]" class="form-control" id="status_<?php echo $days;?>">
                                                        <option value="sys_none"></option>
                                                        <option value="sys_none" hidden></option>
                                                        <option value="REMOVE" hidden>Remove</option>
                                                        <option value="PENDING">Pending</option>
                                                        <option value="ACTIVE" hidden>Active</option>
                                                    </select>
                                                </div>
                                            </td><?php 
                                        }
                                    }else{?>
                                        <td style="background-color: rgb(232, 250, 235)">

                                        </td> <?php 
                                    } 
                                }  ?> 
                        </tr><?php 
                    }  ?> 
                </tbody>
            </table> 
            </form>
            <div class="col-12 text-right">
                <button type="submit" onclick="set_system_cardinal_operation('You want to Update this Schedule?', 'update', 'schedule_form', 'update_schedule.php', 'tab', 'none', 'none', 'required_div', 'confirmation_update_success', 'none')" class="btn btn-primary">Update Schedule</button>                           
            </div> <?php
           
        }else if($table_name == "show_schedule_dashboard"){ 
            // echo $values;
            $values = explode(",",$values);
            $selected_facility_id = $values[0];
            $selected_month = $values[1];
            $selected_year = $values[2];
            $accordion_status = $values[3];
    
            $starting_day = date('l',mktime(0, 0, 0, $selected_month, 1, $selected_year));
            $end_date = date('t',mktime(0, 0, 0, $selected_month, 1, $selected_year));


            $display_date = "OFF";
            $monthNum  = $selected_month;
            $dateObj   = DateTime::createFromFormat('!m', $monthNum);
            $monthName = $dateObj->format('F');

            $selected_month_no_zero = ltrim($selected_month, '0');
            // echo $selected_month_no_zero;
            $Selected_Schedules = $this->SelectCustomize("SELECT system_schedule.*,
                system_vaccines.vaccine_name as vaccine_name 
                FROM system_schedule 
                LEFT JOIN system_vaccines 
                ON system_schedule.vaccine = system_vaccines.id 
                WHERE system_schedule.year = '$selected_year' 
                AND system_schedule.month = '$selected_month_no_zero' 
                AND system_schedule.facility_id = '$selected_facility_id' ORDER BY day");

            $Selected_Vaccine = $this->SelectCustomize("SELECT * FROM system_vaccines");
            $Vaccine_Schedule = $this->SelectCustomize("SELECT * FROM vaccine_schedule");
            $Selected_Barangay = $this->List_Barangay();
            $List_Barangay_Selector = $this->List_Barangay_Selector();
            $List_Barangay_Selector_names = $this->List_Barangay_Selector_Names();
            $List_Months = $this->List_Months();
            $day_name = array("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
            $days = 0;?>

            <style>
                td{
                    height: 150px;
                    
                }
                .row input{
                    font-size:13px;
                    padding: 0px 0px 0px 5px;
                    height:30px;    
                }
                .row select{
                    font-size:13px;
                    padding: 0px 0px 0px 5px;
                    height:30px;    
                }
            </style>   
            <form id="schedule_date_form " class="row col-12 container">
                <input type="text" id="selected_facility_id" hidden value="<?php echo $selected_facility_id; ?>">
                <input id="accordion_status" type="text" value="show" hidden>
                <label class="col-2 text-right pt-1 offset-7">Date: </label>
                <select id="selected_month" class="form-control col-1" style="height:40px;">
                    <option hidden value="<?php echo $selected_month;?>"><?php echo $List_Months[$selected_month-1];?></option><?php
                    $c = 1;
                    foreach($List_Months as $month){  
                        echo "<option value='".$c."'>".$month."</option>";
                        $c++;
                    }?>
                </select>
                <select id="selected_year" class="form-control col-1" style="height:40px;">
                    <option hidden value="<?php echo $selected_year;?>"><?php echo $selected_year;?> </option><?php
                    $sy = 2020;
                    $ey = date("Y") + 3;
                    for($c = $sy ; $c <= $ey ; $c++){  
                        echo "<option value='".$c."'>".$c."</option>";
                    }?>
                </select>
                <button type="button" class="btn btn-outline-info col-1"  onclick="select_for_filtering('tab', 'show_schedule_dashboard', '#example1', 'selected_facility_id,selected_month,selected_year,accordion_status')">Select Date </button>
            </form>
            <form id="schedule_form">
            
            <input id="selected_days_checkbox" type="text" hidden>
            <input type="text" value="<?php echo $selected_month_no_zero; ?>" name="month" hidden>
            <input type="text" value="<?php echo $selected_year; ?>" name="year" hidden >
            <input type="text" value="<?php echo $selected_facility_id; ?>" name="facility_id" hidden >
            <table class="table table-bordered table-striped">
                <thead>
                    <tr colspan="8"><center><h3><b><?php echo $monthName; ?><Br><h5><?php echo $selected_year; ?></h5></b></h3></center></tr>
                    <tr> <?php 
                        foreach ($day_name as $day){ ?>
                            <th><?php echo $day ?></th> <?php 
                        }  ?> 
                    </tr>
                </thead>
                <tbody> <?php 
                    for($x = 1; $x <= 6; $x++){ ?>
                        <tr><?php 
                            foreach ($day_name as $day){
                                    if($starting_day == $day){
                                        $display_date = "ON";
                                    }
                                    if($end_date == $days){
                                        $display_date = "OFF";
                                    }
                                    if($display_date == "ON"){
                                        $days++; 
                                        $none_indicator = "ON";
                                        if($Selected_Schedules != 'none'){
                                            foreach($Selected_Schedules as $sched){ 
                                                $number_of_reg=0;
                                                foreach($Vaccine_Schedule as $VacSched){ 
                                                    if($sched["id"] == $VacSched["schedule_id"]){
                                                        $number_of_reg++;
                                                    }
                                                }
                                                if($days == $sched["day"]){
                                                    $none_indicator = "OFF";
                                                    if($sched["status"] == "ACTIVE"){
                                                        $td_color = "background-color:rgb(180, 212, 74);";
                                                        $td_status = "disabled";
                                                    }else{
                                                        $td_color = "background-color:rgb(237, 188, 83);";
                                                        $td_status = " ";
                                                    }
                                                    ?>
                                                    <td style="<?php echo $td_color ?>">
                                                        <div class="row" style="font-size:14px;">
                                                            <p class="col-sm-12 text-white "><b style="font-size:40px !important;"><?php echo $sched["day"]; ?></b></p>
                                                            <p class="col-sm-6 m-0 p-0 text-white">Brgy: </p><b class="col-sm-6 m-0 p-0 text-white"><?php echo $sched["brgy"];?></b>
                                                            <p class="col-sm-6 m-0 p-0 text-white">Vaccine: </p><b class="col-sm-6 m-0 p-0 text-white"><?php echo $sched["vaccine_name"];?></b>
                                                            <p class="col-sm-6 m-0 p-0 text-white">Age Limit: </p><b class="col-sm-6 m-0 p-0 text-white"><?php echo $sched["age_limit"];?></b>
                                                            <p class="col-sm-6 m-0 p-0 text-white">Slots: </p><b class="col-sm-6 m-0 p-0 text-white"><?php echo $sched["slots"];?></b>
                                                            <p class="col-sm-6 m-0 p-0 text-white">Time: </p><b class="col-sm-6 m-0 p-0 text-white"><?php echo $sched["time"];?></b>
                                                            <p class="col-sm-6 m-0 p-0 text-white">Sched Status: </p><b class="col-sm-6 m-0 p-0 text-white"><?php echo $sched["status"];?></b>
                                                            <p class="col-sm-6 m-0 p-0 text-white">Registered: </p><b class="col-sm-6 m-0 p-0 text-danger"><?php echo $number_of_reg;?></b>
                                                        </div>
                                                    </td><?php 
                                                }
                                            }
                                        }
                                        if($none_indicator == "ON"){?>
                                            <td>
                                                <div class="row" style="color:transparent">
                                                    <p class="col-sm-12"><b style="font-size:40px; color:black;"><?php echo $days ?></b></p>
                                                    <p class="col-sm-6 m-0 p-0">Brgy: </p><b class="col-sm-6 m-0 p-0 ">none</b>
                                                    <p class="col-sm-6 m-0 p-0">Vaccine: </p><b class="col-sm-6 m-0 p-0 ">none</b>
                                                    <p class="col-sm-6 m-0 p-0">Age Limit: </p><b class="col-sm-6 m-0 p-0 ">none</b>
                                                    <p class="col-sm-6 m-0 p-0">Slots: </p><b class="col-sm-6 m-0 p-0 ">none</b>
                                                    <p class="col-sm-6 m-0 p-0">Time: </p><b class="col-sm-6 m-0 p-0 ">none</b>
                                                    <p class="col-sm-6 m-0 p-0">Sched Status: </p><b class="col-sm-6 m-0 p-0 ">none</b>
                                                </div>
                                            </td><?php 
                                        }
                                    }else{?>
                                        <td style="background-color: rgb(232, 250, 235)">

                                        </td> <?php 
                                    } 
                                }  ?> 
                        </tr><?php 
                    }  ?> 
                </tbody>
            </table> 
            </form><?php
           
        }else if($table_name == "show_search"){ ?>

            <div class="form-group col-lg-6 offset-3">
                <form class="input-group pb-0 mb-0">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control float-right" style="background-color:rgb(240, 255, 248);" name="search" placeholder="Search by Name or Scan QR Code" alt="required">
                    <button type="button" class="btn btn-outline-success" onclick="show_table('registrants_table', 'show_registrants', '#example1', search.value);">Search</button>
                </form>
                <center class="mt-3 mb-3">
                    <i class="fas fa-qrcode fa-5x"></i>
                    <i class="fas fa-users fa-5x"></i>
                </center>
                <p class="p-0 m-0"><Center>Search the registrants by there lastname or firstname or middlename or QR code!</center></p>
            </div>
         <?php
           
        }else if($table_name == "show_registrants"){ ?>

            <div class="form-group col-lg-6 offset-3">
                <form class="input-group pb-0 mb-0">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control float-right" value="<?php echo $values; ?>" style="background-color:rgb(240, 255, 248);" name="search" placeholder="Search by Name or Scan QR Code" alt="required">
                    <button type="button" class="btn btn-outline-success" onclick="show_table('registrants_table', 'show_registrants', '#example1', search.value);">Search</button>
                </form>
                <p class="p-0 m-0"><Center>Search the registrants by there lastname or firstname or middlename or QR code!</center></p>
            </div>
            <hr class="mb-5">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Qr Code</th>
                    <th>Category</th>
                    <th>Barangay</th>
                    <th>Date Added</th>
                    <th>Encoded By</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody> <?php
                $SelectTable = $this->SelectCustomize("SELECT * FROM vaccine_registration WHERE lastname LIKE '$values' OR firstname LIKE '%$values%' OR middlename LIKE '%$values%' OR qr_id LIKE '$values'");
                if($SelectTable != "none"){
                    $x = 0;
                    foreach($SelectTable as $value){

                        if($value['encoded_by'] == "Unrecorded"){
                            if($value['encoded'] == "Online Registration"){
                                $encoded_by = "Online Registration";
                            }else{
                                $encoded_by = $value['encoded_by'];
                            }
                        }else{
                            $encoded_by = $value['encoded_by'];
                        }
                        
                        $x++;
                        echo "<tr>";
                            echo "<td><span id='".$value['id']."-lastname'>".$value['lastname']."</span> <span id='".$value['id']."-firstname'>".$value['firstname']."</span> <span id='".$value['id']."-middlename'>".$value['middlename']."</span></td>";
                            echo "<td id='".$value['id']."-qr_id'>".$value['qr_id']."</td>";
                            echo "<td id='".$value['id']."-employmentcategory'>".$value['employmentcategory']."</td>";
                            echo "<td id='".$value['id']."-brgy'>".$value['brgy']."</td>";
                            echo "<td>".$value['date_added']."</td>" ;
                            echo "<td>".$encoded_by."</td>";
                            ?>
                            <td>
                                <button onclick="sys_edit('edit.php', 'veiw_result', '<?php echo $value['id'];?>', 'required_div', '#example1')" type="button" class="col-sm-10 btn btn-block btn-outline-info" data-toggle="modal" data-target="#update">Edit</button><br>
                                <button onclick="sys_edit('edit_delete.php', 'veiw_result_edit_delete', '<?php echo $value['id'];?>', 'required_div', '#example1')" type="button" class="col-sm-10 btn btn-block btn-outline-danger" data-toggle="modal" data-target="#delete_edit">Delete</button>
                                <!-- <div class="icheck-danger col-sm-2 d-inline">
                                    <input type="checkbox" value="<?php echo $value['id'];?>" onclick="selection(this.value, 'select_to_delete_input', 'none')" id="checkboxPrimary<?php echo $x;?>">
                                    <label for="checkboxPrimary<?php echo $x;?>">
                                    </label>
                                </div> -->
                            </td> <?php
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='4' style='text-align: center;'>No Data Available</td></tr>";
                } ?>
                </tbody>
                <!-- <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><button onclick="set_system_cardinal_operation('You want to Delete all the selected?', 'delete', 'select_to_delete', 'delete_user.php', 'user_table', 'show_user', '#example1', 'required_div', 'confirmation_delete_success', 'none')" type="button" class="col-sm-12 btn btn-block btn-outline-danger">Delete Selected</button></th>
                    </tr>
                </tfoot> -->
            </table> <?php
           
        }else if($table_name == "show_registered_table"){
            ?>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Qr Code</th>
                    <th>Category</th>
                    <th>Vaccinated</th>
                    <th>City</th>
                    <th>Barangay</th>
                    <th>Mobile</th>
                    <th>Date Added</th>
                </tr>
                </thead>
                <tbody> <?php
                $SelectTable = $this->SelectCustomize("SELECT * FROM vaccine_registration");
                if($SelectTable != "none"){
                    $x = 0;
                    foreach($SelectTable as $value){
                        $x++;
                        echo "<tr>";
                            echo "<td><span id='".$value['id']."-first_name'>".$value['lastname']." ".$value['firstname']." ".$value['middlename']."</span></td>";
                            echo "<td id='".$value['id']."-qr_id'>".$value['qr_id']."</td>";
                            echo "<td id='".$value['id']."-employmentcategory'>".$value['employmentcategory']."</td>";
                            echo "<td id='".$value['id']."-brgy'>".$value['dose_1']."</td>";
                            echo "<td id='".$value['id']."-brgy'>".$value['city']."</td>";
                            echo "<td id='".$value['id']."-brgy'>".$value['brgy']."</td>";
                            echo "<td id='".$value['id']."-brgy'>".$value['contact']."</td>";
                            echo "<td>".$value['date_added']."</td>" ;
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='4' style='text-align: center;'>No Data Available</td></tr>";
                } ?>
                </tbody>
                <!-- <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><button onclick="set_system_cardinal_operation('You want to Delete all the selected?', 'delete', 'select_to_delete', 'delete_user.php', 'user_table', 'show_user', '#example1', 'required_div', 'confirmation_delete_success', 'none')" type="button" class="col-sm-12 btn btn-block btn-outline-danger">Delete Selected</button></th>
                    </tr>
                </tfoot> -->
            </table> <?php
           
        }else if($table_name == "show_search_PCM"){ ?>

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <!-- <th>Initial Vital Sign</th> -->
                    <th>Blood Presure</th>
                    <th>SPO<sub>2</sub></th>
                    <th>Pulse Rate</th>
                    <th>Addmision Time</th>
                    <th>Discharge Time</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody> <?php
                date_default_timezone_set('Asia/Manila');
                $current_date = date("Y-m-d");
                // $SelectTable = $this->SelectCustomize("SELECT * FROM post_vaccination");
                $SelectTable = $this->SelectCustomize("SELECT local_pv.*, vaccine_registration.dose_2 as dose_2 FROM local_pv LEFT JOIN vaccine_registration ON local_pv.qr_id = vaccine_registration.qr_id");
                if($SelectTable != "none"){
                   
                    $x = 0;
                    foreach($SelectTable as $value){
                        $x++;
                        echo "<tr>";
                            echo "<td id='".$value['id']."-id'>".$value['id']."</td>";
                            echo "<td><span id='".$value['id']."-firstname'>".$value['firstname']."</span> <span id='".$value['id']."-middlename'>".$value['middlename']."</span> <span id='".$value['id']."-lastname'>".$value['lastname']."</span></td>";
                            // echo "<td id='".$value['id']."-initial_VS'>".$value['initial_VS']."</td>";
                            echo "<td> <span id='".$value['id']."-BP_1'>".$value['BP_1']."</span><br><span id='".$value['id']."-BP_1_1'>".$value['BP_1_1']."</span></td>";
                            echo "<td> <span id='".$value['id']."-BP_2'>".$value['BP_2']."</span><br><span id='".$value['id']."-BP_2_1'>".$value['BP_2_1']."</span></td>";
                            echo "<td> <span id='".$value['id']."-BP_3'>".$value['BP_3']."</span><br><span id='".$value['id']."-BP_3_1'>".$value['BP_3_1']."</span></td>";
                            echo "<td> <span id='".$value['id']."-addmission_time_hour'>".$value['addmission_time_hour']."</span> : <span id='".$value['id']."-addmission_time_minute'>".$value['addmission_time_minute']."</span> <br> <span id='".$value['id']."-addmission_time_hour_1'>".$value['addmission_time_hour_1']."</span> : <span id='".$value['id']."-addmission_time_minute_1'>".$value['addmission_time_minute_1']."</span></td>";
                            echo "<td> <span id='".$value['id']."-discharge_time_hour'>".$value['discharge_time_hour']."</span> : <span id='".$value['id']."-discharge_time_minute'>".$value['discharge_time_minute']."</span> <br> <span id='".$value['id']."-discharge_time_hour_1'>".$value['discharge_time_hour_1']."</span> : <span id='".$value['id']."-discharge_time_minute_1'>".$value['discharge_time_minute_1']."</span></td>";
                            echo "<td>".$value['remarks']."</td>" ;
                            ?>
                            <td class="row">
                                <button onclick="sys_edit('edit.php', 'veiw_result', '<?php echo $value['qr_id'];?>cut<?php echo $value['dose_2'];?>', 'required_div', '#example1')" type="button" class="col-sm-12 btn btn-block btn-outline-info" data-toggle="modal" data-target="#update">Edit</button>
                            </td> <?php
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='8' style='text-align: center;'>No Data Available</td></tr>";
                } ?>
                </tbody>
            </table> 
         <?php
           
        }else if($table_name == "show_PCM_O"){ ?>
            <div class="form-group col-lg-6 offset-3">
                <form class="input-group pb-0 mb-0">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control float-right" name="search1" placeholder="Search by Name or Scan QR Code" alt="required" value="<?php echo $values; ?>">
                    <button type="button" class="btn btn-outline-success" onclick="show_table('facilities_table', 'show_PCM_O', '#example1', search1.value);">Search</button>
                </form>
                <p class="p-0 m-0"><Center>Search the registrants by there lastname or firstname or middlename or QR code!</center></p>
            </div>

            <hr class="mb-5">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Initial Vital Sign</th>
                    <th>Blodd Presure Upon Discharge</th>
                    <th>Addmision Time</th>
                    <th>Discharge Time</th>
                    <th>Remarks</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody> <?php
                $SelectTable = $this->SelectCustomize("SELECT * FROM post_vaccination WHERE lastname LIKE '%$values%' OR firstname LIKE '%$values%' OR middlename LIKE '%$values%'");
                if($SelectTable != "none"){
                   
                    $x = 0;
                    foreach($SelectTable as $value){
                        $x++;
                        echo "<tr>";
                            echo "<td id='".$value['id']."-id'>".$value['id']."</td>";
                            echo "<td><span id='".$value['id']."-firstname'>".$value['firstname']."</span> <span id='".$value['id']."-middlename'>".$value['middlename']."</span> <span id='".$value['id']."-lastname'>".$value['lastname']."</span></td>";
                            echo "<td id='".$value['id']."-initial_VS'>".$value['initial_VS']."</td>";
                            echo "<td> <span id='".$value['id']."-BP_1'>".$value['BP_1']."</span> : <span id='".$value['id']."-BP_2'>".$value['BP_2']."</span> : <span id='".$value['id']."-BP_3'>".$value['BP_3']."</span></td>";
                            echo "<td> <span id='".$value['id']."-addmission_time_hour'>".$value['addmission_time_hour']."</span> : <span id='".$value['id']."-addmission_time_minute'>".$value['addmission_time_minute']."</span></td>";
                            echo "<td> <span id='".$value['id']."-discharge_time_hour'>".$value['discharge_time_hour']."</span> : <span id='".$value['id']."-discharge_time_minute'>".$value['discharge_time_minute']."</span></td>";
                            echo "<td>".$value['remarks']."</td>" ;
                            ?>
                            <td class="row">
                                <button onclick="sys_edit('edit.php', 'veiw_result', '<?php echo $value['id'];?>', 'required_div', '#example1')" type="button" class="col-sm-12 btn btn-block btn-outline-info" data-toggle="modal" data-target="#update">Edit</button>
                            </td> <?php
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='8' style='text-align: center;'>No Data Available</td></tr>";
                } ?>
                </tbody>
            </table> <?php


        }else if($table_name == "sched_show_search"){ ?>

            <div class="form-group col-lg-6 offset-3">
                <form class="input-group pb-0 mb-0">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control float-right" style="background-color:rgb(240, 255, 248);" name="search" placeholder="Search by Name or Scan QR Code" alt="required">
                    <button type="button" class="btn btn-outline-success" onclick="show_table('registrants_table', 'show_registrants', '#example1', search.value);">Search</button>
                </form>
                <center class="mt-3 mb-3">
                    <i class="fas fa-qrcode fa-5x"></i>
                    <i class="fas fa-users fa-5x"></i>
                </center>
                <p class="p-0 m-0"><Center>Search the registrants by there lastname or firstname or middlename or QR code!</center></p>
            </div>
         <?php
           
        }else if($table_name == "show_sched_sort"){ 
            $values = explode("c*u*t", $values); ?>
        
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Qr Code</th>
                    <th>Category</th>
                    <th>Barangay</th>
                    <th>Date Added</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody> <?php
                $SelectTable = $this->SelectCustomize("SELECT * FROM vaccine_registration WHERE brgy = '$values[0]' AND employmentcategory = '$values[1]' AND dose_1 != '01_Yes' AND dose_2 != '01_Yes'");
                if($SelectTable != "none"){
                    $x = 0;
                    foreach($SelectTable as $value){
                        $x++;
                        echo "<tr>";
                            echo "<td><span id='".$value['id']."-lastname'>".$value['lastname']."</span> <span id='".$value['id']."-firstname'>".$value['firstname']."</span> <span id='".$value['id']."-middlename'>".$value['middlename']."</span></td>";
                            echo "<td id='".$value['id']."-qr_id'>".$value['qr_id']."</td>";
                            echo "<td id='".$value['id']."-employmentcategory'>".$value['employmentcategory']."</td>";
                            echo "<td id='".$value['id']."-brgy'>".$value['brgy']."</td>";
                            echo "<td>".$value['date_added']."</td>" ;
                            ?>
                            <td>
                                <button onclick="sys_edit('edit.php', 'veiw_result', '<?php echo $value['id'];?>', 'required_div', '#example1')" type="button" class="col-sm-10 btn btn-block btn-outline-info" data-toggle="modal" data-target="#update">Option</button><br>
                            </td> <?php
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='4' style='text-align: center;'>No Data Available</td></tr>";
                } ?>
                </tbody>
                <!-- <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><button onclick="set_system_cardinal_operation('You want to Delete all the selected?', 'delete', 'select_to_delete', 'delete_user.php', 'user_table', 'show_user', '#example1', 'required_div', 'confirmation_delete_success', 'none')" type="button" class="col-sm-12 btn btn-block btn-outline-danger">Delete Selected</button></th>
                    </tr>
                </tfoot> -->
            </table> 


        
         <?php
           
        }else if($table_name == "shed_show_registrants"){ ?>

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Qr Code</th>
                    <th>Category</th>
                    <th>Barangay</th>
                    <th>Date Added</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody> <?php
                $SelectTable = $this->SelectCustomize("SELECT * FROM vaccine_registration WHERE dose_1 != '01_Yes' AND dose_2 != '01_Yes' AND lastname LIKE '$values' OR firstname LIKE '%$values%' OR middlename LIKE '%$values%' OR qr_id LIKE '$values'");
                if($SelectTable != "none"){
                    $x = 0;
                    foreach($SelectTable as $value){
                        $x++;
                        echo "<tr>";
                            echo "<td><span id='".$value['id']."-lastname'>".$value['lastname']."</span> <span id='".$value['id']."-firstname'>".$value['firstname']."</span> <span id='".$value['id']."-middlename'>".$value['middlename']."</span></td>";
                            echo "<td id='".$value['id']."-qr_id'>".$value['qr_id']."</td>";
                            echo "<td id='".$value['id']."-employmentcategory'>".$value['employmentcategory']."</td>";
                            echo "<td id='".$value['id']."-brgy'>".$value['brgy']."</td>";
                            echo "<td>".$value['date_added']."</td>" ;
                            ?>
                            <td>
                                <button onclick="sys_edit('edit.php', 'veiw_result', '<?php echo $value['id'];?>', 'required_div', '#example1')" type="button" class="col-sm-10 btn btn-block btn-outline-info" data-toggle="modal" data-target="#update">Option</button><br>
                            </td> <?php
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='4' style='text-align: center;'>No Data Available</td></tr>";
                } ?>
                </tbody>
                <!-- <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><button onclick="set_system_cardinal_operation('You want to Delete all the selected?', 'delete', 'select_to_delete', 'delete_user.php', 'user_table', 'show_user', '#example1', 'required_div', 'confirmation_delete_success', 'none')" type="button" class="col-sm-12 btn btn-block btn-outline-danger">Delete Selected</button></th>
                    </tr>
                </tfoot> -->
            </table> <?php
           
        }else if($table_name == "show_check_vax"){  ?>

            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Dose 1</th>
                    <th>Dose 2</th>
                    <th>Barangay</th>
                    <th>Vaccine Name</th>
                    <th>Category</th>
                    <th>Facility ID</th>
                    <th>Date of Birth</th>
                    <th>Vaccination Date</th>
                    <th>Guardian</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody> <?php
                date_default_timezone_set('Asia/Manila');
                $current_date = date("Y-m-d");
                // $SelectTable = $this->SelectCustomize("SELECT * FROM post_vaccination");
                if($values != "ALL"){
		    $values_array = explode(",",$values);
	 	    $facility_id = $values_array[0];
		    $date_value = $values_array[1];	
                    $SelectTable = $this->SelectCustomize("SELECT * FROM local_data_fetcher WHERE facility_id = '$facility_id' AND time_stamp = '$date_value'");
                }else{
                    $SelectTable = $this->SelectCustomize("SELECT * FROM local_data_fetcher");
                }
                
                if($SelectTable != "none"){
                    
                    $x = 0;
                    foreach($SelectTable as $value){
                        $x++;
                        echo "<tr>";
                            echo "<td id='".$value['id']."-id'>".$value['id']."</td>";
                            echo "<td><span id='".$value['id']."-firstname'>".$value['firstname']."</span> <span id='".$value['id']."-middlename'>".$value['middlename']."</span> <span id='".$value['id']."-lastname'>".$value['lastname']."</span></td>";
                            echo "<td>".$value['dose_1']."</td>" ;
                            echo "<td>".$value['dose_2']."</td>" ;
                            echo "<td>".$value['brgy']."</td>" ;
                            echo "<td>".$value['vaccine_name']."</td>" ;
                            echo "<td>".$value['employmentcategory']."</td>" ;
                            echo "<td>".$value['facility_id']."</td>" ;
                            echo "<td>".$value['bday']."</td>" ;
                            echo "<td>".$value['time_stamp']."</td>" ;
                            echo "<td>".$value['guardian']."</td>" ;?>
                            <td>
                                <button onclick="sys_edit('edit.php', 'veiw_result', '<?php echo $value['id'];?>', 'required_div', '#example1')" type="button" class="col-sm-10 btn btn-block btn-outline-info" data-toggle="modal" data-target="#update">Edit</button><br>
                            </td>  <?php
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='8' style='text-align: center;'>No Data Available</td></tr>";
                } ?>
                </tbody>
            </table> 
         <?php
           
        }else if($table_name == "show_registered"){ 
            $keyword = explode(" ",$values);
            $key1 = $keyword[0];
            ?>

            <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Qr Code</th>
                    <th>Category</th>
                    <th>Barangay</th>
                    <th>Date Added</th>
                    <th>Encoded By</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody> <?php
                $SelectTable = $this->SelectCustomize("SELECT * FROM vaccine_registration WHERE firstname LIKE '%$key1%' OR lastname LIKE '%$key1%' OR middlename LIKE '%$key1%'");

                if($SelectTable != "none"){
                    $count = 0;
                    foreach($SelectTable as $value){
                        $full_name = strtolower($value['lastname']." ".$value['firstname']." ".$value['middlename']);//this engine will start compare with fullname!
                        $search_status = array();//Storage for the bolean function how many points the keyword is right compared with the fullname
                        for($i = 1;$i < count($keyword);$i++){ //count all the keyword that has been explode to array by space like Flandez Bryan
                            $key = strtolower($keyword[$i]);
                            $search = strpos($full_name, $key);//Detector code if there is cimilarities between the full name and the key like (George Domadiga Yata)<--the full name][the Key -->(George)
                            if($search === false){//if there is a cimilarities
                                array_push($search_status, 0);//no
                            }else{
                                array_push($search_status, 1);//yes
                            }
                        }
                        $output_result = 1;//set output as Yes
                        foreach($search_status as $ss){//find if the search status has no
                            if($ss == 0){// if the status has no the name will not bi output
                                $output_result = 0;
                            }
                        }
                        if($output_result == 1){//only the data with full yes in search status can be output!!
                            echo "<tr>";
                                echo "<td><span id='".$value['id']."-lastname'>".$value['lastname']."</span> <span id='".$value['id']."-firstname'>".$value['firstname']."</span> <span id='".$value['id']."-middlename'>".$value['middlename']."</span></td>";
                                echo "<td id='".$value['id']."-qr_id'>".$value['qr_id']."</td>";
                                echo "<td id='".$value['id']."-employmentcategory'>".$value['employmentcategory']."</td>";
                                echo "<td id='".$value['id']."-brgy'>".$value['brgy']."</td>";
                                echo "<td>".$value['date_added']."</td>" ;
                                echo "<td>".$value['encoded_by']."</td>";$value['encoded_by']
                                ?>
                                <td>
                                    <button onclick="sys_edit('edit.php', 'veiw_result', '<?php echo $value['id'];?>', 'required_div', '#example1')" type="button" class="col-sm-10 btn btn-block btn-outline-info" data-toggle="modal" data-target="#update">Edit</button><br>
                                    <button onclick="sys_edit('edit_delete.php', 'veiw_result_edit_delete', '<?php echo $value['id'];?>', 'required_div', '#example1')" type="button" class="col-sm-10 btn btn-block btn-outline-danger" data-toggle="modal" data-target="#delete_edit">Delete</button>
                                    <!-- <div class="icheck-danger col-sm-2 d-inline">
                                        <input type="checkbox" value="<?php echo $value['id'];?>" onclick="selection(this.value, 'select_to_delete_input', 'none')" id="checkboxPrimary<?php echo $x;?>">
                                        <label for="checkboxPrimary<?php echo $x;?>">
                                        </label>
                                    </div> -->
                                </td> <?php
                            echo "</tr>";
                        }
                        $count++;
                        if($count == 200){
                            break;
                        }
                    }
                }else{
                    echo "<tr><td colspan='6' style='text-align: center;'>No Data Available</td></tr>";
                } ?>
                </tbody>
            </table> <?php


        }else if($table_name == "show_registered_mobile"){ 
            $keyword = explode(" ",$values);
            $key1 = $keyword[0];
            ?>

            <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody> <?php
                $SelectTable = $this->SelectCustomize("SELECT * FROM vaccine_registration WHERE firstname LIKE '%$key1%' OR lastname LIKE '%$key1%' OR middlename LIKE '%$key1%'");

                if($SelectTable != "none"){
                    $count = 0;
                    foreach($SelectTable as $value){
                        $full_name = strtolower($value['lastname']." ".$value['firstname']." ".$value['middlename']);//this engine will start compare with fullname!
                        $search_status = array();//Storage for the bolean function how many points the keyword is right compared with the fullname
                        for($i = 1;$i < count($keyword);$i++){ //count all the keyword that has been explode to array by space like Flandez Bryan
                            $key = strtolower($keyword[$i]);
                            $search = strpos($full_name, $key);//Detector code if there is cimilarities between the full name and the key like (George Domadiga Yata)<--the full name][the Key -->(George)
                            if($search === false){//if there is a cimilarities
                                array_push($search_status, 0);//no
                            }else{
                                array_push($search_status, 1);//yes
                            }
                        }
                        $output_result = 1;//set output as Yes
                        foreach($search_status as $ss){//find if the search status has no
                            if($ss == 0){// if the status has no the name will not bi output
                                $output_result = 0;
                            }
                        }
                        if($output_result == 1){//only the data with full yes in search status can be output!!
                            echo "<tr>";
                                echo "<td><span id='".$value['id']."-lastname'>".$value['lastname']."</span> <span id='".$value['id']."-firstname'>".$value['firstname']."</span> <span id='".$value['id']."-middlename'>".$value['middlename']."</span></td>";
                                ?>
                                <td>
                                    <button onclick="sys_edit('edit.php', 'veiw_result', '<?php echo $value['id'];?>', 'required_div', '#example1')" type="button" class="col-sm-10 btn btn-block btn-outline-info" data-toggle="modal" data-target="#update">Edit</button><br>
                                    <!-- <div class="icheck-danger col-sm-2 d-inline">
                                        <input type="checkbox" value="<?php echo $value['id'];?>" onclick="selection(this.value, 'select_to_delete_input', 'none')" id="checkboxPrimary<?php echo $x;?>">
                                        <label for="checkboxPrimary<?php echo $x;?>">
                                        </label>
                                    </div> -->
                                </td> <?php
                            echo "</tr>";
                        }
                        $count++;
                        if($count == 200){
                            break;
                        }
                    }
                }else{
                    echo "<tr><td colspan='6' style='text-align: center;'>No Data Available</td></tr>";
                } ?>
                </tbody>
            </table> <?php


        }else if($table_name == "show_deep_search"){ 
            $search_array = explode("code404", $values); 
            $first_name = $search_array[0];
            $lastname = $search_array[1]; ?>
            <hr class="mb-5">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Full Name</th>
                    <th>Qr Code</th>
                    <th>Category</th>
                    <th>Barangay</th>
                    <th>Date Added</th>
                    <th>Encoded By</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody> <?php
                $SelectTable = $this->SelectCustomize("SELECT * FROM vaccine_registration WHERE lastname = '$lastname' AND firstname = '$first_name'");
                if($SelectTable != "none"){
                    $x = 0;
                    foreach($SelectTable as $value){

                        if($value['encoded_by'] == "Unrecorded"){
                            if($value['encoded'] == "Online Registration"){
                                $encoded_by = "Online Registration";
                            }else{
                                $encoded_by = $value['encoded_by'];
                            }
                        }else{
                            $encoded_by = $value['encoded_by'];
                        }
                        
                        $x++;
                        echo "<tr>";
                            echo "<td><span id='".$value['id']."-lastname'>".$value['lastname']."</span> <span id='".$value['id']."-firstname'>".$value['firstname']."</span> <span id='".$value['id']."-middlename'>".$value['middlename']."</span></td>";
                            echo "<td id='".$value['id']."-qr_id'>".$value['qr_id']."</td>";
                            echo "<td id='".$value['id']."-employmentcategory'>".$value['employmentcategory']."</td>";
                            echo "<td id='".$value['id']."-brgy'>".$value['brgy']."</td>";
                            echo "<td>".$value['date_added']."</td>" ;
                            echo "<td>".$encoded_by."</td>";
                            ?>
                            <td>
                                <button onclick="sys_edit('edit.php', 'veiw_result', '<?php echo $value['id'];?>', 'required_div', '#example1')" type="button" class="col-sm-10 btn btn-block btn-outline-info" data-toggle="modal" data-target="#update">Edit</button><br>
                                <button onclick="sys_edit('edit_delete.php', 'veiw_result_edit_delete', '<?php echo $value['id'];?>', 'required_div', '#example1')" type="button" class="col-sm-10 btn btn-block btn-outline-danger" data-toggle="modal" data-target="#delete_edit">Delete</button>
                                <!-- <div class="icheck-danger col-sm-2 d-inline">
                                    <input type="checkbox" value="<?php echo $value['id'];?>" onclick="selection(this.value, 'select_to_delete_input', 'none')" id="checkboxPrimary<?php echo $x;?>">
                                    <label for="checkboxPrimary<?php echo $x;?>">
                                    </label>
                                </div> -->
                            </td> <?php
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='4' style='text-align: center;'>No Data Available</td></tr>";
                } ?>
                </tbody>
                <!-- <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><button onclick="set_system_cardinal_operation('You want to Delete all the selected?', 'delete', 'select_to_delete', 'delete_user.php', 'user_table', 'show_user', '#example1', 'required_div', 'confirmation_delete_success', 'none')" type="button" class="col-sm-12 btn btn-block btn-outline-danger">Delete Selected</button></th>
                    </tr>
                </tfoot> -->
            </table> <?php
           
        }else if($table_name == "vaccine_inventory"){?>
            <table id="tbl_vaccines_inv" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Vaccine</th>
                    <th>QTY. Avail.</th>
                    <th>Supplier</th>
                    <th>Expiry Date</th>
                    <th>Date Received</th>
                    <th>Edit / Delete</th>
                </tr>
                </thead>
                <tbody> <?php
                $SelectTable = $this->SelectCustomize(" SELECT
                        vi.id as vaccine_inv_id,
                        v.id AS vaccine_id,
                        v.name AS vaccine_name,
                        SUM(vi.quantity_received) AS quantity_available,
                        GROUP_CONCAT(DISTINCT vs.name SEPARATOR ', ') AS supplier_name,
                        MIN(vi.expiry_date) AS expiry_date,
                        MAX(vi.date_received) AS date_received
                        FROM vaccine_inventory vi 
                        LEFT JOIN vaccines v ON vi.vaccine_id = v.id 
                        LEFT JOIN vaccine_supplier vs ON vi.supplier_id = vs.id 
                        WHERE vi.is_archive = 0
                        GROUP BY v.id, vi.id, v.name
                        ");
                if($SelectTable != "none"){
                    $x = 0;
                    foreach($SelectTable as $value){
                        $x++;
                        echo "<tr>";
                            echo "<td>".$x."</td>";
                            echo "<td>".$value['vaccine_name']."</td>";
                            echo "<td>".$value['quantity_available']."</td>";
                            echo "<td>".$value['supplier_name']."</td>";
                            echo "<td>".$value['expiry_date']."</td>";
                            echo "<td>".$value['date_received']."</td>";
                            ?>
                            <td class="row m-0" style="justify-content: space-evenly;">
                                <!-- <a href="index.php?page_name=Vaccine%20Inventory&primary_id=<?php //echo $value['id'];?>" class="col-sm-10 btn btn-block btn-outline-info" data-toggle="modal" data-target="#view_vaccine_inv">View</a> -->

                                <button onclick="sys_edit('view.php', 'veiw_result_view', '<?php echo $value['vaccine_inv_id'];?>', 'required_div', '#tbl_vaccines_inv')" type="button" class="col-5 btn btn-block btn-outline-info" data-toggle="modal" data-target="#view_vaccine_inv">View</button>
                            
                                <button onclick="sys_edit('edit.php', 'veiw_result_update', '<?php echo $value['vaccine_inv_id'];?>', 'required_div', '#tbl_vaccines_inv')" type="button" class="col-5 btn btn-outline-info" data-toggle="modal" data-target="#update">Edit</button>

                               
                                <div class="icheck-danger col-1 d-inline">
                                    <input type="checkbox" class="delete-checkbox-vaccines-inv" value="<?php echo $value['vaccine_inv_id'];?>" onclick="selection(this.value, 'select_to_delete_input', 'none')" id="checkboxPrimary<?php echo $x;?>">
                                    <label for="checkboxPrimary<?php echo $x;?>"></label>
                                </div>
                            </td> <?php
                        echo "</tr>";
                    }
                }else{
                    echo "<tr><td colspan='9' style='text-align: center;'>No Data Available</td></tr>";
                }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><button onclick="set_system_cardinal_operation('You want to Delete all the selected?', 'delete', 'select_to_delete', 'delete_vaccine_inv.php', 'vaccine_inv_table', 'vaccine_inventory', '#tbl_vaccines_inv', 'required_div', 'confirmation_delete_success', 'none')" type="button" id="btn-delete-selected-vaccines-inv" class="col-sm-12 btn btn-block btn-outline-danger" disabled>Delete Selected</button></th>
                    </tr>
                </tfoot>
            </table> <?php

        } else if ($table_name == "vaccine_receive") { ?>

            <table id="tbl_vaccines_receive" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Vaccine</th>
                        <th>Supplier</th>
                        <th>Facility</th>
                        <th>Quantity</th>
                        <th>Expiry</th>
                        <th>Edit / Delete</th>
                    </tr>
                </thead>
                <tbody> <?php
                $SelectTable = $this->SelectCustomize(" SELECT
                        r.id AS vaccine_receive_id,
                        v.name AS vaccine_name,
                        s.name AS supplier_name,
                        f.facility_name,
                        r.quantity,
                        r.remarks,
                        r.expiry_date
                        FROM vaccine_receive r
                        LEFT JOIN vaccines v ON v.id = r.vaccine_id
                        LEFT JOIN vaccine_supplier s ON s.id = r.supplier_id
                        LEFT JOIN system_facilities f ON f.id = r.facility_id
                        WHERE r.is_archive = 0");
                if($SelectTable != "none"){
                    $x = 0;
                    foreach($SelectTable as $value){
                        $exp = ($value['expiry_date'] != "") ? $value['expiry_date'] : "----:--:--";

                        $x++;
                        echo "<tr>";
                            echo "<td>".$x."</td>";
                            echo "<td>".$value['vaccine_name']."</td>";
                            echo "<td>".$value['supplier_name']."</td>";
                            echo "<td>".$value['facility_name']."</td>";
                            echo "<td>".$value['quantity']."</td>";
                            echo "<td>".$exp."</td>";
                            ?>
                            <td class="row m-0" style="justify-content: space-evenly;">
                                <button onclick="sys_edit('view.php', 'view_result_view', '<?php echo $value['vaccine_receive_id'];?>', 'required_div', '#tbl_vaccines_receive')" type="button" class="col-5 btn btn-block btn-outline-info" data-toggle="modal" data-target="#view_vaccine_inv">View</button>
                            
                                <button onclick="sys_edit('edit.php', 'view_result_update', '<?php echo $value['vaccine_receive_id'];?>', 'required_div', '#tbl_vaccines_receive')" type="button" class="col-5 btn btn-outline-info" data-toggle="modal" data-target="#update">Edit</button>

                                <div class="icheck-danger col-1 d-inline">
                                    <input type="checkbox" class="delete-checkbox-vaccine-receive" value="<?php echo $value['vaccine_receive_id'];?>" onclick="selection(this.value, 'select_to_delete_input', 'none')" id="checkboxPrimary<?php echo $x;?>">
                                    <label for="checkboxPrimary<?php echo $x;?>"></label>
                                </div>
                            </td> <?php
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' style='text-align: center;'>No Data Available</td></tr>";
                }
                ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><button onclick="set_system_cardinal_operation('You want to Delete all the selected?', 'delete', 'select_to_delete', 'delete_vaccine_trans_rec.php', 'vaccine_receive_table', 'vaccine_receive', '#tbl_vaccines_receive', 'required_div', 'confirmation_delete_success', 'none')" type="button" id="btn-delete-selected-vaccines-receive" class="col-sm-12 btn btn-block btn-outline-danger" disabled>Delete Selected</button></th>
                    </tr>
                </tfoot>
            </table> <?php

        } else if ($table_name == "vaccine_issuance") { ?>

            <table id="tbl_vaccines_issuance" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Vaccine</th>
                        <th>Issued To</th>
                        <th>Issued Type</th>
                        <th>Quantity</th>
                        <th>Date Issued</th>
                        <th>Edit / Delete</th>
                    </tr>
                </thead>

                <tbody> 
                    <?php
                        $SelectTable = $this->SelectCustomize(" SELECT
                                i.id AS vaccine_issuance_id,
                                i.issued_to,
                                i.vaccinee_id,
                                i.issued_date,
                                v.name AS vaccine_name,
                                CONCAT(vr.firstname, ' ', vr.lastname) AS fullname,
                                f.facility_name,
                                i.quantity,
                                i.remarks,
                                i.issued_type
                                FROM vaccine_issuance i
                                LEFT JOIN vaccines v ON v.id = i.vaccine_id
                                LEFT JOIN vaccine_registration vr ON vr.id = i.vaccinee_id
                                LEFT JOIN system_facilities f ON f.id = i.issued_to
                                WHERE i.is_archive = 0");
                        if($SelectTable != "none"){
                            $x = 0;
                            foreach($SelectTable as $value){
                                $x++;
                                $issued_to_name = "N/A";

                                if ($value["issued_to"] != 0) {
                                    $issued_to_name = $value["facility_name"];
                                }

                                if ($value["vaccinee_id"] != 0) {
                                    $issued_to_name = $value["fullname"];
                                }

                                echo "<tr>";
                                    echo "<td>".$x."</td>";
                                    echo "<td>".$value['vaccine_name']."</td>";
                                    echo "<td>".$issued_to_name."</td>";
                                    echo "<td>".$value['issued_type']."</td>";
                                    echo "<td>".$value['quantity']."</td>";
                                    echo "<td>".$value['issued_date']."</td>";
                                    ?>
                                    <td class="row m-0" style="justify-content: space-evenly;">
                                        <button onclick="sys_edit('view.php', 'view_result_view', '<?php echo $value['vaccine_issuance_id'];?>', 'required_div', '#tbl_vaccines_issuance')" type="button" class="col-5 btn btn-block btn-outline-info" data-toggle="modal" data-target="#view_vaccine_inv">View</button>
                                    
                                        <button onclick="sys_edit('edit.php', 'view_result_update', '<?php echo $value['vaccine_issuance_id'];?>', 'required_div', '#tbl_vaccines_issuance')" type="button" class="col-5 btn btn-outline-info" data-toggle="modal" data-target="#update">Edit</button>

                                        <div class="icheck-danger col-1 d-inline">
                                            <input type="checkbox" class="delete-checkbox-vaccine-issuance" value="<?php echo $value['vaccine_issuance_id'];?>" onclick="selection(this.value, 'select_to_delete_input', 'none')" id="checkboxPrimary<?php echo $x;?>">
                                            <label for="checkboxPrimary<?php echo $x;?>"></label>
                                        </div>
                                    </td> <?php
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='7' style='text-align: center;'>No Data Available</td></tr>";
                        }
                    ?>
                </tbody>

                <tfoot>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th><button onclick="set_system_cardinal_operation('You want to Delete all the selected?', 'delete', 'select_to_delete', 'delete_vaccine_trans_iss.php', 'vaccine_issuance_table', 'vaccine_issuance', '#tbl_vaccines_issuance', 'required_div', 'confirmation_delete_success', 'none')" type="button" id="btn-delete-selected-vaccines-issuance" class="col-sm-12 btn btn-block btn-outline-danger" disabled>Delete Selected</button></th>
                    </tr>
                </tfoot>
            </table>

            <?php
        } else if ($table_name == "vaccine_stocks") { ?>

            <table id="tbl_vaccines_stocks" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Vaccine</th>
                        <th>In</th>
                        <th>Out</th>
                        <th>Balance</th>
                        <th>Expiry</th>
                    </tr>
                </thead>

                <tbody> 
                    <?php
                        $stocks = $this->SelectCustomize("SELECT
                                v.id AS vaccine_id,
                                v.name AS vaccine_name,
                                IFNULL(SUM(DISTINCT vr.total_in), 0) AS total_in,
                                IFNULL(SUM(DISTINCT vi.total_out), 0) AS total_out,
                                (IFNULL(SUM(DISTINCT vr.total_in), 0) - IFNULL(SUM(DISTINCT vi.total_out), 0)) AS balance,
                                MIN(vr.expiry_date) AS expiry_date
                            FROM vaccines v
                            LEFT JOIN (
                                SELECT vaccine_id, SUM(quantity) AS total_in, expiry_date
                                FROM vaccine_receive
                                WHERE is_archive = 0
                                GROUP BY vaccine_id, expiry_date
                            ) vr ON vr.vaccine_id = v.id
                            LEFT JOIN (
                                SELECT vaccine_id, SUM(quantity) AS total_out
                                FROM vaccine_issuance
                                WHERE is_archive = 0
                                GROUP BY vaccine_id
                            ) vi ON vi.vaccine_id = v.id
                            WHERE v.is_archive = 0
                            GROUP BY v.id
                            ORDER BY v.name ASC
                        ");

                        if($stocks != "none"){
                             $i = 1;
                            foreach ($stocks as $row) {
                                echo "<tr>";
                                    echo "<td>{$i}</td>";
                                    echo "<td>{$row['vaccine_name']}</td>";
                                    echo "<td>{$row['total_in']}</td>";
                                    echo "<td>{$row['total_out']}</td>";
                                    echo "<td>{$row['balance']}</td>";
                                    echo "<td>".($row['expiry_date'] ?? 'N/A')."</td>";
                                echo "</tr>";
                                $i++;
                            }
                        } else {
                            echo "<tr><td colspan='7' style='text-align: center;'>No Data Available</td></tr>";
                        }
                    ?>
                </tbody>
            </table>

        <?php
        }        
    }
}
?>







