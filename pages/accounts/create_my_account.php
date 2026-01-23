<!DOCTYPE html>
<html>
  <?php 
    session_start();
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    include '../inc/header.php'; 
?>
  <body class="hold-transition login-page login-background">
    <div class="login-box" style="background-color: rgba(255, 255, 255, 0.5); border-radius: 25px; padding:20px; width:600px; margin-top:100px !important;">
      <div class="text-center" hidden>
        <img class="profile-user-img img-fluid img-circle" src="../../dist/img/<?php echo $_SESSION["system_logo"];?>" alt="User profile picture">
        <br><br>
      </div>
      <div class="login-logo" hidden>
        <a href="index.php"><?php echo $_SESSION["system_title"];?></a>
      </div>
      <!-- <b><center><?php echo date("F d Y"); ?></center></b><br> -->
      <!-- /.login-logo -->
      <div class="card" >
        <div class="card-body login-card-body">
          <!-- <p class="login-box-msg">Sign in to start your session</p> -->
            <div id="result"></div>
          <form id ="create_form" enctype="multipart/form-data">
                        <!-- This Alert is needed -->
                <div class="alert alert-danger custom_required alert-dismissible fade show" id="required_div" role="alert">
                    <strong>ERROR!</strong> Please Fill in the required Inputs below!
                    <button type="button" class="close" onclick="turn_off_required('required_div')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> 
                    <div class="modal-body" >
                        <div class="row">
                            <div class="row col-sm-4" hidden>
                                <div class="form-group col-lg-12">
                                    <div class="col-lg-12 text-center profile_shell" style="padding-top:50px">
                                        <img width="200px" id="code_gen_img" src="" alt="">
                                    </div>
                                </div>
                                <a class="col-sm-12 text-center" id="code_gen_img_dl" href="" download="My_CHO_Login_QRCODE">
                                    <button type="button" class="btn btn-success col-sm-8">Download QR Code</button>
                                </a>
                                <!-- <img src="/path/to/image" /></a> -->
                            </div>
                            
                            <div class="row col-sm-12">
                                <div class="form-group col-lg-12">
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

                                <div class="form-group col-lg-12">
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

                                <div class="form-group col-lg-12">
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

                                <div class="form-group col-lg-4" hidden>
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

                                <div class="form-group col-lg-12">
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

                                <div class="form-group col-lg-12">
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

                                <div class="form-group col-lg-12">
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

                                <div class="form-group col-lg-12">
                                    <label>Contact Number:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="fas fa-mobile-alt"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="contact">
                                    </div>
                                </div>

                                <div class="form-group col-lg-12">
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

                                <div class="form-group col-lg-12">
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

                                <div class="form-group col-lg-12" hidden>
                                    <label>Access: </label>
                                    <input type="text" class="form-control float-right" value="15" name="access" alt="required">
                                </div>

                                <div class="form-group col-lg-6" hidden>
                                    <label>QR Code: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="fas fa-lock-open"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="code_gen" value="asdasdasd"  name="code_gen"  alt="required">
                                    </div>
                                </div>
                                <button type="button" onclick="set_system_cardinal_operation('You want to Create this new Account?', 'create', 'create_form', 'create_user.php', 'result', 'none', '#example1', 'required_div', 'confirmation_create_success', 'create_user')" class="btn btn-primary">Submit</button>                           
                                        
                            </div>
                        </div>

                    </div>
                    
                </form> 

        </div>
        <!-- /.login-card-body -->
      </div><?php  
       include '../inc/confirmation_alerts.php';
      include '../inc/copyfooter_general.php'; 
      include '../inc/footer.php';
      // ?>
    </div>
  <!-- /.login-box -->
  </body>
</html>
