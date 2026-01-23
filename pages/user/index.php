<!DOCTYPE html>
<html>
<?php
    $system_page_name = $_GET["page_name"];
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $System_Sessioning = $systemcore->System_Sessioning("session");

    include '../inc/header.php';
    // include '../inc/navbar.php';
?>
<body class="pages_body">
  <!-- Content Wrapper. Contains page content -->
  <!-- <div class="content-wrapper"> -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $system_page_name; ?></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">

          <div class="card">
            <div class="card-header">
              <h2 class="card-title col-lg-10" style="padding-top:10px; "><b>List Of System Users</b></h2>
              <button type="button" class="btn btn-block btn-outline-secondary col-lg-2" data-toggle="modal" data-target="#create_user">Add New User</button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="user_table">
                    <!-- table will be showed here after the script executed!! -->
                </div>
                <form id="select_to_delete" hidden>
                    <h1>Deleted ID's</h1>
                    <input type="text" name="selected_id" id="select_to_delete_input" value="none">
                </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  <!-- </div> -->
  <!-- /.content-wrapper -->

    <div class="modal fade" id="update">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" id="veiw_result">
                
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="create_user">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- This Alert is needed -->
                <div class="alert alert-danger custom_required alert-dismissible fade show" id="required_div" role="alert">
                    <strong>ERROR!</strong> Please Fill in the required Inputs below!
                    <button type="button" class="close" onclick="turn_off_required('required_div')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> 

                <form id ="create_form" enctype="multipart/form-data">
                    <div class="modal-body" >
                        <div class="row">
                            <div class="row col-sm-4">
                                <div class="form-group col-lg-12">
                                    <div class="col-lg-12 text-center profile_shell">
                                        <img id="profile" src="../../dist/img/default_avatar.png" alt="Profile Picture" >
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
                                    <label for="exampleInputFile">User Picture</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="profile" id="exampleInputFile" onchange="apear_upload_image(this, 'profile');">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row col-sm-8">
                                <div class="form-group col-lg-4">
                                    <label>First Name:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="far fa-address-card"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="first_name" alt="required"> 
                                    </div>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label>Last Name:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="far fa-address-card"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="last_name" alt="required">
                                    </div>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label>Middle Name:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="far fa-address-card"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="middle_name" alt="required">
                                    </div>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label>Suffix:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="far fa-address-card"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="suffix">
                                    </div>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label>Birthday:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="fas fa-birthday-cake"></i>
                                        </span>
                                        </div>
                                        <input type="date" class="form-control float-right" name="birthday" alt="required">
                                    </div>
                                </div>

                                <div class="form-group col-lg-4">
                                    <label>Gender:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="fas fa-venus-mars"></i>
                                        </span>
                                        </div>
                                        <select name="gender" class="form-control"  alt="required">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Address:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="fas fa-home"></i> 
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="address" >
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Contuct Number:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="fas fa-mobile-alt"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="contact">
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Username:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="fas fa-user-lock"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="username"  alt="required">
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Password:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="fas fa-key"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="password" alt="required">
                                    </div>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label>Access: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="fas fa-lock-open"></i>
                                        </span>
                                        </div>
                                        <select name="access" class="form-control"  alt="required"><?php
                                            $SelectGroups = $systemcore->SelectTable("system_page_access WHERE page_access != '1'");
                                            foreach($SelectGroups as $value){  
                                                echo "<option value='".$value['page_access']."'>".$value['name']."</option>";
                                        }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form> 
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" onclick="set_system_cardinal_operation('You want to Create this new User?', 'create', 'create_form', 'create_user.php', 'user_table', 'show_user', '#example1', 'required_div', 'confirmation_create_success', 'create_user')" class="btn btn-primary">Submit</button>                           
                </div>
            </div>
        </div>
    </div>

    <?php 
        include '../inc/confirmation_alerts.php';
        include '../inc/footer.php';
    ?>
    <script>
        // setting up the tables
        show_table("user_table", "show_user", "#example1");
        
    </script>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>


