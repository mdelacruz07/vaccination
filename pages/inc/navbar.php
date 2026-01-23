<?php 
 if($_SESSION["profile_picture"] == "none"){
  $_SESSION["profile_picture"] = "default_avatar.png";
 };

  include '../registrants/vims_settings.php'; 
  $VIMS_settings = new VIMS_settings();

  $Global_category_array = $VIMS_settings->Global_category_array();
  $Global_vaccine_name = $VIMS_settings->Global_vaccine_name();
  $Global_regions = $VIMS_settings->Global_regions();
  $Global_jun12_province = $VIMS_settings->Global_jun12_province();
  $Global_jun12_city = $VIMS_settings->Global_jun12_city();
  $Global_new_category_array = $VIMS_settings->Global_new_category_array();

?>
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-info navbar-light system_nav_bar">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link system_nav_text" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item">
        
        <button class="user-panel mt-1 pb-1 mb-1 d-flex" style="background-color:transparent; border:none;" data-toggle="modal" data-target="#update_my_account">
          <div class="image">
            <img src="../../dist/img/<?php echo $_SESSION["profile_picture"];?>" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
              <span class="text-white system_nav_text"><b><?php echo $_SESSION["user_full_name"];?></b> : <?php echo $_SESSION["user_facility"];?></span>
          </div>
        </button>

      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
      <a class="nav-link system_nav_text">
        <?php echo date("F d Y"); ?> | <span id="clock">as</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link system_nav_text" href="../login/log_out.php?log_out='yes'">
          <span>Log-out</span>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary system_side_bar elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link" data-widget="pushmenu">
      <img
           style="opacity: .8">
           <span class="brand-text font-weight-heavy system_nav_text"><?php echo $_SESSION["nav_bar_title"];?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
	  <!-- Show only side bar on admin -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <?php 
            $counter = 0;
            $user_page_access = explode(",", $_SESSION["user_access_pages"]);
            $user_nav_page_access = explode(",", $_SESSION["user_access_nav_group"]);
           
            foreach($user_nav_page_access as $nav_id){
              $SelectNav = $systemcore->SelectTable("system_nav_group WHERE id = '$nav_id'");
              foreach($SelectNav as $nav){
                $nav_group_id = $nav["id"];?>

                
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <p>
                      <?php echo $nav["nav_group_name"]; ?>
                      <i class="right fas fa-angle-left"></i>
                    </p>
                  </a> 
                  <ul class="nav nav-treeview"><?php
                    foreach($user_page_access as $pages) { 
                      $SelectTable = $systemcore->SelectTable("system_pages WHERE pages_id = '$pages' AND nav_group_id = '$nav_group_id'");
                      if($SelectTable != "none"){
                        foreach($SelectTable as $value){ 
                          if($value["page_type"] == "nav"){?>
                            <li class="nav-item">
                              <a href="#" onclick="checkURL('<?php echo $value['page_link'].'?page_name='.$value['page_name']; ?>')" class="nav-link system_side_bar_text"> <!-- link here for Manage Cases -->
                              <!-- href="<?php// echo $value['page_link']."?page_name=".$value["page_name"]; ?> " -->
                              <?php echo $value['page_icon']; ?>
                                <p><?php echo $value['page_name']; ?></p>
                              </a>
                            </li> <?php
                          }else{?>
                            <li class="nav-item">
                              <a href="#" data-toggle="modal" data-target="#<?php echo $value['page_link']; ?>" class="nav-link system_side_bar_text"> <!-- link here for Manage Cases -->
                              <?php echo $value['page_icon']; ?>
                                <p><?php echo $value['page_name']; ?></p>
                              </a>
                            </li> <?php
                          }
                        }
                      }
                    } ?>
                  </ul>
                </li> <?php
              } 
            }
            
            ?>
          </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
  <!-- /.sidebar -->
</aside>




<div class="modal fade" id="update_my_account">
  <div class="modal-dialog modal-md">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">My Account </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>

          <!-- This Alert is needed -->
          <div class="alert alert-danger custom_required alert-dismissible fade show" id="my_account_required_div" role="alert">
              <strong>ERROR!</strong> Please Fill in the required Inputs below!
              <button type="button" class="close" onclick="turn_off_required('my_account_required_div')" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div> 

          <div id="my_account_update_result">
        
          </div> 

          <form id ="update_my_account_form" enctype="multipart/form-data">
          <input type="text" class="form-control float-right" value="<?php echo $_SESSION["user_id"];?>" id="primary_key" name="primary_key" hidden >
              <div class="modal-body" >
                  <div class="row">
                      <div class="row col-sm-12">
                          <div class="form-group col-lg-12">
                              <label>Username:</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                  <span class="input-group-text">
                                  <i class="fas fa-user-lock"></i>
                                  </span>
                                  </div>
                                  <input readonly type="text" class="form-control float-right" name="username" value="<?php echo $_SESSION["user_username"]?>" alt="required">
                              </div>
                          </div>

                          <div class="form-group col-lg-12">
                              <label>Password:</label>
                              <div class="input-group">
                                  <div class="input-group-prepend">
                                  <span class="input-group-text">
                                  <i class="fas fa-key"></i>
                                  </span>
                                  </div>
                                  <input readonly type="password" class="form-control float-right" name="password" value="<?php echo $_SESSION["user_password"]?>" alt="required">
                                  <input type="text" hidden class="form-control float-right" id="old_password" value="<?php echo $_SESSION["user_password"]?>" name="old_password">
                              </div>
                          </div>
                      </div>
                  </div>

              </div>
              
          </form> 
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" disabled onclick="set_system_cardinal_operation('You want to Update your Account?', 'update', 'update_my_account_form', '../user/update_my_account.php', 'my_account_update_result', 'none', 'none', 'my_account_required_div', 'confirmation_update_success', 'none')" class="btn btn-primary">Update</button>                           
          </div>
      </div>
      <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="print_registered">
  <div class="modal-dialog modal-md">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Print Registered Contact Info</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
          
          </div>
          <form method="POST" enctype="multipart/form-data" action="../reports/print_registered_contact.php" target="_blank">
              <div class="modal-body row" style="padding:5px ;">
                <div class="form-group col-lg-12">
                  <label>Date:</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                      <span class="input-group-text">
                      <i class="fas fa-user-lock"></i>
                      </span>
                      </div>
                      <input type="date" class="form-control float-right" name="date" alt="required">
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="exampleInputEmail1">Category</label>
                  <select name="employmentcategory" class="form-control regis_form" alt="required" required>
                    <option value="Empty" hidden></option>
                    <option value="Health_Care_Worker">Health Care Worker</option>
                    <option value="Senior Citizen">Senior Citizen</option>
                    <option value="Indigent">Indigent</option>
                    <option value="Uniformed Personnel">Uniformed Personnel</option>
                    <option value="Essential Worker">Essential Worker</option>
                    <option value="Comorbidities">Comorbidities</option>
                    <option value="Teachers Social Workers">Teachers Social Workers</option>
                    <option value="Other Govertment Wokers">Other Govertment Wokers</option>
                    <option value="Other High Risk">Other High Risk</option>
                    <option value="OFW">OFW</option>
                    <option value="Remaining_Workforce">Remaining_Workforce</option>
                    <option value="Other">Other</option>
                  </select>
                </div>

                <div class="form-group col-sm-12">
                <label for="exampleInputEmail1">Vaccination Facility</label>
                <select name="facility_id" class="form-control" alt="required">  
                    <option value="Empty" hidden></option><?php
                    $SelectGroups = $systemcore->SelectTable("system_facilities");
                    foreach($SelectGroups as $value){  
                        echo "<option value='".$value['id']."'>".$value['facility_name']."</option>";

                  }?>
                </select>
              </div>
              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Print</button>                           
              </div>
          </form> 
      </div>
  </div>
</div>

<div class="modal fade" id="print_monthly_vaccinated">
  <div class="modal-dialog modal-md">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Print Monthly Vaccinated</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
          
          </div>
          <form method="POST" enctype="multipart/form-data" action="../reports/print_vaccinated_2dose.php" target="_blank">
              <div class="modal-body row" style="padding:5px ;">
                

                <div class="form-group col-sm-12">
                  <label for="exampleInputEmail1">Vaccine Name</label>
                  <select name="vaccine_name" class="form-control regis_form" required>
                    <option value="Empty" hidden></option><?php
                    foreach($Global_vaccine_name as $vaccine){ ?>
                      <option value="<?php echo $vaccine; ?>"><?php echo $vaccine; ?></option><?php
                    }?>
                  </select>
                </div>

                <div class="form-group col-lg-12">
                  <label>Month Number:</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                      <span class="input-group-text">
                      <i class="fas fa-user-lock"></i>
                      </span>
                      </div>
                      <input type="text" class="form-control float-right" name="report_month_vaccination" alt="required">
                  </div>
                </div>

                <div class="form-group col-lg-12">
                  <label>Month Name:</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                      <span class="input-group-text">
                      <i class="fas fa-user-lock"></i>
                      </span>
                      </div>
                      <input type="text" class="form-control float-right" name="month_name_report" alt="required">
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="exampleInputEmail1">1st Dose</label>
                  <select name="dose_1_report" class="form-control regis_form" required>
                    <option value="Empty" hidden></option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                  </select>
                </div>

                <div class="form-group col-sm-12">
                  <label for="exampleInputEmail1">2nd Dose</label>
                  <select name="dose_2_report" class="form-control regis_form" required>
                    <option value="Empty" hidden></option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                  </select>
                </div>

                <div class="form-group col-12">
                  <label>List of Category(Remove Next Line)</label>
                  <textarea class="form-control" rows="3" name="category"><?php
                    foreach($Global_new_category_array as $category_new){
                      echo $category_new.",\n";
                    }
                  ?></textarea>
                </div>
                


              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Print</button>                           
              </div>
          </form> 
      </div>
  </div>
</div>

<div class="modal fade" id="print_monthly_vaccinated_by_date">
  <div class="modal-dialog modal-md">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Print Monthly Vaccinated by Date</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
          
          </div>
          <form method="POST" enctype="multipart/form-data" action="../reports/print_vaccinated_2dose_by_date.php" target="_blank">
              <div class="modal-body row" style="padding:5px ;">
                

                <div class="form-group col-sm-12">
                  <label for="exampleInputEmail1">Vaccine Name</label>
                  <select name="vaccine_name" class="form-control regis_form" required>
                    <option value="Empty" hidden></option><?php
                    foreach($Global_vaccine_name as $vaccine){ ?>
                      <option value="<?php echo $vaccine; ?>"><?php echo $vaccine; ?></option><?php
                    }?>
                  </select>
                </div>

                <div class="form-group col-lg-12">
                  <label>Month Number:</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                      <span class="input-group-text">
                      <i class="fas fa-user-lock"></i>
                      </span>
                      </div>
                      <input type="date" class="form-control float-right" name="report_month_vaccination" alt="required">
                  </div>
                </div>

                <div class="form-group col-lg-12">
                  <label>Month Name:</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                      <span class="input-group-text">
                      <i class="fas fa-user-lock"></i>
                      </span>
                      </div>
                      <input type="date" class="form-control float-right" name="month_name_report" alt="required">
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label for="exampleInputEmail1">1st Dose</label>
                  <select name="dose_1_report" class="form-control regis_form" required>
                    <option value="Empty" hidden></option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                  </select>
                </div>

                <div class="form-group col-sm-12">
                  <label for="exampleInputEmail1">2nd Dose</label>
                  <select name="dose_2_report" class="form-control regis_form" required>
                    <option value="Empty" hidden></option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                  </select>
                </div>

                <div class="form-group col-12">
                  <label>List of Category(Remove Next Line)</label>
                  <textarea class="form-control" rows="3" name="category"><?php
                    foreach($Global_new_category_array as $category_new){
                      echo $category_new.",\n";
                    }
                  ?></textarea>
                </div>
                


              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Print</button>                           
              </div>
          </form> 
      </div>
  </div>
</div>


<div class="modal fade" id="print_monthly_no_2nd">
  <div class="modal-dialog modal-md">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Print Monthly Vaccinated with No Second Dose</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
          
          </div>
          <form method="POST" enctype="multipart/form-data" action="../reports/print_no_2nddose.php" target="_blank">
              <div class="modal-body row" style="padding:5px ;">
                

                <div class="form-group col-sm-12">
                  <label for="exampleInputEmail1">Vaccine Name</label>
                  <select name="vaccine_name" class="form-control regis_form" required>
                    <option value="Empty" hidden></option>><?php
                    foreach($Global_vaccine_name as $vaccine){ ?>
                      <option value="<?php echo $vaccine; ?>"><?php echo $vaccine; ?></option><?php
                    }?>
                  </select>
                </div>

                <div class="form-group col-lg-12">
                  <label>Month of 1st Dose(Number):</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                      <span class="input-group-text">
                      <i class="fas fa-user-lock"></i>
                      </span>
                      </div>
                      <input type="text" class="form-control float-right" name="report_month_vaccination" alt="required">
                  </div>
                </div>

                <div class="form-group col-sm-12">
                  <label>Month of 1st Dose(Name):</label>
                  <input type="text" class="form-control float-right" name="month_name_report" alt="required">
                </div>

                <div class="form-group col-sm-12">
                  <label>Month of 2nd Dose(Name):</label>
                  <input type="text" class="form-control float-right" name="month_name_report_2" alt="required">
                </div>
                
                <div class="form-group col-12">
                  <label>List of Category(Remove Next Line)</label>
                  <textarea class="form-control" rows="3" name="category"><?php
                    foreach($Global_category_array as $category){
                      echo $category.", \n";
                    }
                  ?></textarea>
                </div>

              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Print</button>                           
              </div>
          </form> 
      </div>
  </div>
</div>


<div class="modal fade" id="print_profiled_not_vaccine">
  <div class="modal-dialog modal-md">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title">Print Monthly Not Vaccinated Profile</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span> </button>
          
          </div>
          <form method="POST" enctype="multipart/form-data" action="../reports/print_registered_contact.php" target="_blank">
              <div class="modal-body row p-3" >
                <div class="form-group col-12">
                  <label>List of Category(Remove Next Line)</label>
                  <textarea class="form-control" rows="3" name="category"><?php
                    foreach($Global_category_array as $category){
                      echo $category.", \n";
                    }
                  ?></textarea>
                </div>

              </div>
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Print</button>                           
              </div>
          </form> 
      </div>
  </div>
</div>