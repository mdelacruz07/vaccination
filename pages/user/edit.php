    <?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $id = $_GET['primary_id'];

    $SelectTable = $systemcore->SelectCustomize("SELECT system_user.*, system_page_access.name as access_name FROM system_user LEFT JOIN system_page_access ON system_user.access = system_page_access.page_access WHERE system_user.id = '$id'");
    foreach($SelectTable as $value){
        $id = $value['id'];
        $first_name = $value['first_name'];
        $middle_name = $value['middle_name'];
        $last_name = $value['last_name'];
        $suffix = $value['suffix'];
        $birthday = $value['birthday'];
        $gender = $value['gender'];
        $address = $value['address'];
        $contact = $value['contact'];
        $username = $value['username'];
        $password = $value['password'];
        $access_id = $value['access'];
        $access_name = $value['access_name'];
        $profile_picture = $value['profile_picture'];
        $date_added = $value['date_added'];

        $age = date_create($birthday)->diff(date_create('today'))->y;
       
    }

    ?>
<div class="modal-header">
    <h5 class="modal-title">Edit User</h5>
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

<div id="update_result">

</div>

<form id ="update_form" enctype="multipart/form-data">
    <input type="text" class="form-control float-right" value="<?php echo $id;?>" id="primary_key" name="primary_key" hidden >
    <div class="modal-body" >
        <div class="row">
            <div class="row col-sm-4">
                <div class="form-group col-lg-12">
                    <div class="col-lg-12 text-center profile_shell">
                        <img id="profile_edit" src="../../dist/img/<?php echo $profile_picture;?>" alt="Profile Picture" style="height:100%; width: 100%;">
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label for="exampleInputFile">User Picture</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="profile" id="exampleInputFile" onchange="apear_upload_image(this, 'profile_edit');">
                            <input hidden type="text" class="custom-file-input" name="old_profile" value="<?php echo $profile_picture;?>">
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
                        <input type="text" class="form-control float-right" id="first_name" value="<?php echo $first_name;?>" name="first_name" alt="required"> 
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
                        <input type="text" class="form-control float-right" id="last_name" value="<?php echo $last_name;?>" name="last_name" alt="required">
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
                        <input type="text" class="form-control float-right" id="middle_name" value="<?php echo $middle_name;?>" name="middle_name" alt="required">
                    </div>
                </div>

                <div class="form-group col-lg-2">
                    <label>Suffix:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="far fa-address-card"></i>
                        </span>
                        </div>
                        <input type="text" class="form-control float-right" id="suffix" value="<?php echo $suffix;?>" name="suffix">
                    </div>
                </div>

                <div class="form-group col-lg-2">
                    <label>Age:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="far fa-hourglass"></i>
                        </span>
                        </div>
                        <input type="text" class="form-control float-right" id="age" value="<?php echo $age;?>" name="age" alt="required">
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
                        <input type="date" class="form-control float-right" id="birthday" value="<?php echo $birthday;?>" name="birthday" alt="required">
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
                        <select name="gender" class="form-control" id="gender" alt="required">
                            <option hidden value="<?php echo $gender;?>" ><?php echo $gender;?></option>
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
                        <input type="text" class="form-control float-right" id="address" value="<?php echo $address;?>" name="address" >
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
                        <input type="text" class="form-control float-right" id="contact" value="<?php echo $contact;?>" name="contact">
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
                        <input type="text" class="form-control float-right" id="username" value="<?php echo $username;?>" name="username"  alt="required">
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
                        <input type="password" class="form-control float-right" id="password" value="<?php echo $password;?>" name="password" alt="required">
                        <input type="text" hidden class="form-control float-right" id="old_password" value="<?php echo $password;?>" name="old_password">
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
                        <select name="access" class="form-control" id="access" alt="required">
                            <option hidden value="multi,<?php echo $access_id;?>,<?php echo $access_name;?>" ><?php echo $access_name;?></option><?php
                            $SelectGroups = $systemcore->SelectTable("system_page_access WHERE page_access != '1'");
                            foreach($SelectGroups as $value){  
                                echo "<option value='multi,".$value['page_access'].",".$value['name']."'>".$value['name']."</option>";
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
    <button type="submit" onclick="set_system_cardinal_operation('You want to Update this User?', 'update', 'update_form', 'update_user.php', 'update_result', 'none', 'none', 'required_div', 'confirmation_update_success', 'none')" class="btn btn-primary">Update</button>                           
</div>