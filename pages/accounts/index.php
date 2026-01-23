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
              <h2 class="card-title col-lg-10" style="padding-top:10px; "><b>List Of Accounts</b></h2>
              <button type="button" class="btn btn-block btn-outline-secondary col-lg-2" data-toggle="modal" onclick="CODE_GEN('code_gen')" data-target="#create_user">Add New Account</button>
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
                    <h5 class="modal-title">Add New Account</h5>
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
                                    <div class="col-lg-12 text-center profile_shell" style="padding-top:50px">
                                        <img width="200px" id="code_gen_img" src="" alt="">
                                    </div>
                                </div>
                                <a class="col-sm-12 text-center" id="code_gen_img_dl" href="" download="My_CHO_Login_QRCODE">
                                    <button type="button" class="btn btn-success col-sm-8">Download QR Code</button>
                                </a>
                                <!-- <img src="/path/to/image" /></a> -->
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

                                <div class="form-group col-lg-6" hidden>
                                    <label>Access: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="fas fa-lock-open"></i>
                                        </span>
                                        </div>
                                        <select name="access" class="form-control"  alt="required"><?php
                                            $SelectGroups = $systemcore->SelectTable("system_page_access WHERE page_access = '15'");
                                            foreach($SelectGroups as $value){  
                                                echo "<option value='".$value['page_access']."'>".$value['name']."</option>";
                                        }?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group col-lg-6" hidden>
                                    <label>QR Code: </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                        <i class="fas fa-lock-open"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="code_gen"  name="code_gen"  alt="required">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                </form> 
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" onclick="set_system_cardinal_operation('You want to Create this new Account?', 'create', 'create_form', 'create_user.php', 'user_table', 'show_user', '#example1', 'required_div', 'confirmation_create_success', 'create_user')" class="btn btn-primary">Submit</button>                           
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <?php 
        include '../inc/confirmation_alerts.php';
        include '../inc/footer.php';
    ?>
    <script>
        // setting up the tables
        show_table("user_table", "show_user", "#example1");
        function CODE_GEN(code_gen){
            var letters=["A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z","a","b","c","d","e","f","g","h","i","j","k","l","m","n","o","p","q","r","s","t","u","v","w","x","y","z"];
            var rw_code_gen = "NUct"+letters[Math.floor(Math.random() * 49)]+""+letters[Math.floor(Math.random() * 49)]+""+Math.floor(Math.random() * 99)+""+letters[Math.floor(Math.random() * 49)]+""+letters[Math.floor(Math.random() * 49)]+""+Math.floor(Math.random() * 99);
            var code_gen = "bagocho.pagenet.info/OVRM/pages/scan_code/index.php?id='"+rw_code_gen+"'";/////////////////////EDIT LINKSSSSSSSSSSSSSSSSS
            document.getElementById("code_gen").value=rw_code_gen;
            document.getElementById("code_gen_img").src = "generate.php?text="+code_gen;
            document.getElementById("code_gen_img_dl").href= "generate.php?text="+code_gen;
        }
    </script>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>


