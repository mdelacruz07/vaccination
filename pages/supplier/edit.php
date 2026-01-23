<?php
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $id = $_GET['primary_id'];

    $SelectTable = $systemcore->SelectCustomize("SELECT * FROM vaccine_supplier WHERE id = '$id'");
    foreach($SelectTable as $value){
        $name = $value["name"];
        $contact_person = $value["contact_person"];
        $phone = $value["phone"];
        $email = $value["email"];
        $address = $value["address"];
    }
?>
<div class="modal-header">
    <h5 class="modal-title">Edit Supplier</h5>
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

<form id="update_form" enctype="multipart/form-data">
    <input type="text" class="form-control float-right" value="<?php echo $id;?>" id="primary_key" name="primary_key" hidden >
    <div class="modal-body" >
        <div class="row">
            
            <div class="row col-sm-12">
                <div class="form-group col-lg-12">
                    <label>Name:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-address-card"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right" name="name" id="name" value="<?php echo $name;?>" alt="required">
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label>Contact Person:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-address-card"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control float-right" name="contact_person" id="contact_person" value="<?php echo $contact_person;?>"  alt="required">
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label>Phone:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-address-card"></i>
                            </span>
                        </div>
                        <input type="tel" class="form-control float-right supplier_phone" name="phone" value="<?php echo $phone;?>" maxlength="11" alt="required">
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label>Email:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-address-card"></i>
                            </span>
                        </div>
                        <input type="email" class="form-control float-right" name="email" id="email" value="<?php echo $email;?>" alt="required">
                    </div>
                </div>

                <div class="form-group col-lg-12">
                    <label>Address:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="far fa-address-card"></i>
                            </span>
                        </div>
                        <textarea class="form-control float-right" name="address" id="address" rows="3"><?php echo $address;?></textarea>
                    </div>
                </div>
            </div>
        </div>

    </div>
    
</form> 
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    <button type="submit" onclick="set_system_cardinal_operation('You want to Update this Supplier?', 'update', 'update_form', 'update_supplier.php', 'update_result', 'vaccine_supplier', '#tbl_suppliers', 'required_div', 'confirmation_update_success', 'none')" class="btn btn-primary">Update</button>                           
</div>
