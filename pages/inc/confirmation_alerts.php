
<div class="modal fade" id="confirmation_box">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
            <!-- <h4 class="modal-title">Small Modal</h4> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"  onclick="turn_off_overlay()">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <center>
                <div class="confirmation_box_icon">
                    <i class="fas fa-exclamation fa-5x"></i>
                </div>
            </center>
            <br>
            <center><h6 id="confirmation_des">Are You sure you want to do this?</h6></center>
            
            <div hidden>
                <input type="text" id="confirmation_operation" > <p>operation => the operation to do</p>
                <input type="text" id="confirmation_form_id" > <p>form_id => the form id where the inputs located</p>
                <input type="text" id="confirmation_form_file_name" > <p>file_name => form file name where the data will be passed</p>

                <input type="text" id="confirmation_table_div_id" > <p>get_div_id => div Id where the Table will Appear</p>
                <input type="text" id="confirmation_table_file_name" > <p>file_name => table file name</p>
                <input type="text" id="confirmation_table_id" > <p>table_id => table Id for Bootstrap data table</p>

                <input type="text" id="confirmation_modal_open" > <p>modal_open => the modal that will open when press OK!</p>
                <input type="text" id="confirmation_modal_close" > <p>modal_close => the modal that will close when press OK!</p>
            </div>

        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal" onclick="turn_off_overlay()">Cancel</button>
            <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="confirmation()">Ok</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="confirmation_create_success">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
            <!-- <h4 class="modal-title">Small Modal</h4> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="turn_off_overlay()">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <center>
                <div class="confirmation_box_icon">
                    <i class="fas fa-check-circle fa-10x"></i>
                </div>
            </center>
            <br>
            <center><h6 id="confirmation_des">The Data has been Succesfully <b>Added!</b></h6></center>
            
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-primary col-sm-12" data-dismiss="modal" onclick="turn_off_overlay()">OK</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="confirmation_update_success">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
            <!-- <h4 class="modal-title">Small Modal</h4> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="turn_off_overlay()">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <center>
                <div class="confirmation_box_icon">
                    <i class="fas fa-check-square fa-10x"></i>
                </div>
            </center>
            <br>
            <center><h6 id="confirmation_des">The Data has been Succesfully <b>Updated!</b></h6></center>
            
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-primary col-sm-12" data-dismiss="modal" onclick="turn_off_overlay()">OK</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="confirmation_delete_success">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
            <!-- <h4 class="modal-title">Small Modal</h4> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="turn_off_overlay()">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <center>
                <div class="confirmation_box_icon">
                    <i class="fas fa-trash-alt fa-10x"></i>
                </div>
            </center>
            <br>
            <center><h6 id="confirmation_des">The Data has been Succesfully <b>Deleted!</b></h6></center>
            
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-primary col-sm-12" data-dismiss="modal" onclick="turn_off_overlay()">OK</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="confirmation_remove_success">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
            <!-- <h4 class="modal-title">Small Modal</h4> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="turn_off_overlay()">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <center>
                <div class="confirmation_box_icon">
                    <i class="fas fa-trash-alt fa-10x"></i>
                </div>
            </center>
            <br>
            <center><h6 id="confirmation_des">The Data has been Succesfully <b>Remove!</b></h6></center>
            
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-primary col-sm-12" data-dismiss="modal" onclick="turn_off_overlay()">OK</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="confirmation_import_success">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
            <!-- <h4 class="modal-title">Small Modal</h4> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="turn_off_overlay()">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <center>
                <div class="confirmation_box_icon">
                    <i class="fas fa-file-upload fa-10x"></i>
                </div>
            </center>
            <br>
            <center><h6 id="confirmation_des">The Schedule has been Succesfully <b>Imported!</b></h6></center>
            
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-primary col-sm-12" data-dismiss="modal" onclick="turn_off_overlay()">OK</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="confirmation_enroll_success">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
        <div class="modal-header">
            <!-- <h4 class="modal-title">Small Modal</h4> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="turn_off_overlay()">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <center>
                <div class="confirmation_box_icon">
                    <i class="fas fa-file-upload fa-10x"></i>
                </div>
            </center>
            <br>
            <center><h6 id="confirmation_des">The Student has been Succesfully <b>Enrolled!</b></h6></center>
            
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-primary col-sm-12" data-dismiss="modal" onclick="turn_off_overlay()">OK</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->