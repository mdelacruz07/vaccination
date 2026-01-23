<!DOCTYPE html>
<html>
<?php
    $system_page_name = $_GET["page_name"];
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $System_Sessioning = $systemcore->System_Sessioning("session");

    $SelectTable = $systemcore->SelectTable("system_config");
    foreach($SelectTable as $value){
        $title = $value['title'];
        $head_title = $value['head_title'];
        $nav_bar_title = $value['nav_bar_title'];
        $nav_bar = $value['nav_bar'];
        $nav_bar_text_color = $value['nav_bar_text_color'];
        $side_bar = $value['side_bar'];
        $side_bar_text = $value['side_bar_text'];
        $hover_side_bar_text = $value['hover_side_bar_text'];
        $hover_side_bar_text_bg = $value['hover_side_bar_text_bg'];
        $header_color = $value['header_color'];
        $header_font_color = $value['header_font_color'];
        $modal_header_color = $value['modal_header_color'];
        $modal_header_font_color = $value['modal_header_font_color'];
        $system_main_redirect = $value['system_main_redirect'];
        $system_logo = $value['system_logo'];
        $login_background_image = $value['login_background_image'];
        $background_image = $value['background_image'];
        $system_libraries_date_creation = $value['system_libraries_date_creation'];
        $system_date_creation = $value['system_date_creation'];

        $system_add_bg_btn_color = $value['system_add_bg_btn_color'];
        $system_add_btn_border = $value['system_add_btn_border'];
        $system_add_btn_color = $value['system_add_btn_color'];
        $system_add_btn_size = $value['system_add_btn_size'];

        $system_delete_bg_btn_color = $value['system_delete_bg_btn_color'];
        $system_delete_btn_border = $value['system_delete_btn_border'];
        $system_delete_btn_color = $value['system_delete_btn_color'];
        $system_delete_btn_size = $value['system_delete_btn_size'];

        $system_edit_bg_btn_color = $value['system_edit_bg_btn_color'];
        $system_edit_btn_border = $value['system_edit_btn_border'];
        $system_edit_btn_color = $value['system_edit_btn_color'];
        $system_edit_btn_size = $value['system_edit_btn_size'];

    }
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
              <h2 class="card-title col-lg-10" style="padding-top:10px; "><b>List of Configurations</b></h2>
            </div>
            <!-- /.card-header -->
            <div class="card-body">


                <div class="row">
                    <div class="col-5 col-sm-2">
                        <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                            <a class="nav-link active" id="vert-tabs-profile-tab" data-toggle="pill" href="#designe" role="tab" aria-controls="vert-tabs-profile" aria-selected="true">System Designe</a>
                            <a onclick="show_table('page_access', 'sys_confi_page_access', '#example1');" class="nav-link" id="vert-tabs-home-tab" data-toggle="pill" href="#page_access" role="tab" aria-controls="vert-tabs-home" aria-selected="false">System Access</a>
                            <a onclick="show_table('pages', 'sys_confi_pages', '#example2');" class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#pages" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">System Pages</a>
                            <a onclick="show_table('page_nav_group', 'sys_confi_page_group', '#example3');" class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#page_nav_group" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">System Navigation Groups</a>
                        </div>
                    </div>
                    <div class="col-7 col-sm-10">
                        <div class="tab-content" id="vert-tabs-tabContent">
                            <div class="tab-pane fade show active" id="designe" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">

                                <!-- This Alert is needed -->
                                <div class="alert alert-danger custom_required alert-dismissible fade show" id="required_div3" role="alert">
                                    <strong>ERROR!</strong> Please Fill in the required Inputs below!
                                    <button type="button" class="close" onclick="turn_off_required('required_div3')" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div> 

                                <div id="designe_result"> </div>

                                <form class="row" id ="designe_update_form" enctype="multipart/form-data">
                                    <div class="card col-lg-4 card-info card-outline">
                                        <label style="padding-top:10px; ">System Color:</label><hr>
                                        <div class="card-body">
                                            
                                            <div class="form-group col-lg-12">
                                                <label>Nav Bar Color:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" value="<?php echo $nav_bar?>" name="nav_bar">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>Nav Bar Text Color:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" value="<?php echo $nav_bar_text_color?>" name="nav_bar_text_color">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>Side Bar Color:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" value="<?php echo $side_bar?>" name="side_bar">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>Side Bar Text Color:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="side_bar_text" value="<?php echo $side_bar_text?>" >
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>Side Bar Text Color(Hover):</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="hover_side_bar_text" value="<?php echo $hover_side_bar_text?>" >
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>Side Bar Background Color(Hover):</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="hover_side_bar_text_bg" value="<?php echo $hover_side_bar_text_bg?>" >
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>Header Color:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="header_color" value="<?php echo $header_color?>" >
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>Header Font Color:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="header_font_color" value="<?php echo $header_font_color?>" >
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>Modal Header Color:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="modal_header_color"  value="<?php echo $modal_header_color?>" >
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>Modal Header Font Color:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="modal_header_font_color" value="<?php echo $modal_header_font_color?>" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card col-lg-4 card-info card-outline">
                                        <label style="padding-top:10px; ">System Miscellaneous:</label><hr>
                                        <div class="card-body">
                                            <div class="form-group col-lg-12">
                                                <label>System Title:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-cogs"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="title" alt="required" value="<?php echo $title?>" >
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>System Nav Bar Title:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-cogs"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="nav_bar_title" alt="required" value="<?php echo $nav_bar_title?>" >
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>System Head Title:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-cogs"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="head_title"  alt="required" value="<?php echo $head_title?>" >
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>System Redirection:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-cogs"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="system_main_redirect" value="<?php echo $system_main_redirect?>" >
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>System Logo:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-cogs"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="system_logo" value="<?php echo $system_logo?>" >
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>System Login Background:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-cogs"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="login_background_image" value="<?php echo $login_background_image?>" >
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>System Background:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-cogs"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="background_image" value="<?php echo $background_image?>" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card col-lg-4 card-info card-outline">
                                        <label style="padding-top:10px; ">System Time Frame:</label><hr>
                                        <div class="card-body">
                                            <div class="form-group col-lg-12">
                                                <label>System Libraries Date Creation:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-clock"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="system_libraries_date_creation" value="<?php echo $system_libraries_date_creation?>"  readonly>
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>System Date Creation:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-clock"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="system_date_creation" value="<?php echo $system_date_creation?>"  readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="card col-lg-4 card-info card-outline">
                                        <label style="padding-top:10px; ">System Button Colors:</label><hr>
                                        <div class="card-body">
                                            
                                            <div class="form-group col-lg-12">
                                                <label>Add BG Button Color:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" value="<?php echo $system_add_bg_btn_color?>" name="system_add_bg_btn_color">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>Add Border Setting:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" value="<?php echo $system_add_btn_border?>" name="system_add_btn_border">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>Add Button Font Color:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" value="<?php echo $system_add_btn_color?>" name="system_add_btn_color">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>Add Button Font Size:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="system_add_btn_size" value="<?php echo $system_add_btn_size?>" >
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-12">
                                                <label>Delete BG Button Color:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" value="<?php echo $system_delete_bg_btn_color?>" name="system_delete_bg_btn_color">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>Delete Border Setting:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" value="<?php echo $system_delete_btn_border?>" name="system_delete_btn_border">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>Delete Button Font Color:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" value="<?php echo $system_delete_btn_color?>" name="system_delete_btn_color">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>Delete Button Font Size:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="system_delete_btn_size" value="<?php echo $system_delete_btn_size?>" >
                                                </div>
                                            </div>

                                            <div class="form-group col-lg-12">
                                                <label>Edit BG Button Color:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" value="<?php echo $system_edit_bg_btn_color?>" name="system_edit_bg_btn_color">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>Edit Border Setting:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" value="<?php echo $system_edit_btn_border?>" name="system_edit_btn_border">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>Edit Button Font Color:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" value="<?php echo $system_edit_btn_color?>" name="system_edit_btn_color">
                                                </div>
                                            </div>
                                            <div class="form-group col-lg-12">
                                                <label>Edit Button Font Size:</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                    <i class="fas fa-palette"></i>
                                                    </span>
                                                    </div>
                                                    <input type="text" class="form-control float-right" name="system_edit_btn_size" value="<?php echo $system_edit_btn_size?>" >
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </form>
                                <div class="justify-content-between row">
                                    <div ></div>
                                    <button type="submit" onclick="set_system_cardinal_operation('You want to Update this System Designe?', 'update', 'designe_update_form', 'update_designe.php', 'designe_result', 'none', 'none', 'required_div3', 'confirmation_update_success', 'none')" class="btn edit_buttons btn-primary col-sm-2">Update</button>                           
                                </div>
                            </div>
                            <div class="tab-pane text-left fade" id="page_access" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                                
                            </div>
                            <div class="tab-pane fade" id="page_nav_group" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                                
                            </div>
                            <div class="tab-pane fade" id="pages" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                                
                            </div>
                            <div class="tab-pane fade" id="empty_tab" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                                
                                </div>
                        </div>
                    </div>
                </div>
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

   <div class="modal fade" id="create_access_level">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Access Level</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- This Alert is needed -->
                <div class="alert alert-danger custom_required alert-dismissible fade show" id="required_div1" role="alert">
                    <strong>ERROR!</strong> Please Fill in the required Inputs below!
                    <button type="button" class="close" onclick="turn_off_required('required_div1')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> 

                <form id ="access_create_form" enctype="multipart/form-data">
                    <div class="modal-body" >
                        <div class="row">
                            <div class="row col-sm-12">
                    

                                <div class="form-group col-lg-12">
                                    <label>Name of Access Level:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="fas fa-key"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="access_level_name" alt="required">
                                    </div>
                                </div>

                                
                            </div>
                        </div>

                    </div>
                    
                </form> 
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" onclick="set_system_cardinal_operation('You want to Create this New Access Level?', 'create', 'access_create_form', 'create_access.php', 'page_access', 'sys_confi_page_access', '#example1', 'required_div1', 'confirmation_create_success', 'create_access_level')" class="btn add_buttons btn-primary">Submit</button>                           
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="create_new_page">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Page</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- This Alert is needed -->
                <div class="alert alert-danger custom_required alert-dismissible fade show" id="required_div2" role="alert">
                    <strong>ERROR!</strong> Please Fill in the required Inputs below!
                    <button type="button" class="close" onclick="turn_off_required('required_div2')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> 

                <form id ="pages_create_form" enctype="multipart/form-data">
                    <div class="modal-body" >
                        <div class="row">
                            <div class="row col-sm-12">
                    

                                <div class="form-group col-lg-12">
                                    <label>Name of Page:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="fas fa-key"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="page_name" alt="required">
                                    </div>
                                </div>

                                
                            </div>
                        </div>

                    </div>
                    
                </form> 
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" onclick="set_system_cardinal_operation('You want to Create this New Page?', 'create', 'pages_create_form', 'create_pages.php', 'pages', 'sys_confi_pages', '#example1', 'required_div2', 'confirmation_create_success', 'create_new_page')" class="btn add_buttons btn-primary">Submit</button>                           
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

    <div class="modal fade" id="create_new_nav_group">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Navigation Group</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!-- This Alert is needed -->
                <div class="alert alert-danger custom_required alert-dismissible fade show" id="required_div3" role="alert">
                    <strong>ERROR!</strong> Please Fill in the required Inputs below!
                    <button type="button" class="close" onclick="turn_off_required('required_div3')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div> 

                <form id ="nav_group_create_form" enctype="multipart/form-data">
                    <div class="modal-body" >
                        <div class="row">
                            <div class="row col-sm-12">
                    

                                <div class="form-group col-lg-12">
                                    <label>Name of Navigation Group:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                          <i class="fas fa-key"></i>
                                        </span>
                                        </div>
                                        <input type="text" class="form-control float-right" name="nav_group_name" alt="required">
                                    </div>
                                </div>

                                
                            </div>
                        </div>

                    </div>
                    
                </form> 
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" onclick="set_system_cardinal_operation('You want to Create this New Navigation Group?', 'create', 'nav_group_create_form', 'create_nav_group.php', 'page_nav_group', 'sys_confi_page_group', '#example3', 'required_div3', 'confirmation_create_success', 'create_new_nav_group')" class="btn add_buttons btn-primary">Submit</button>                           
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
        // show_table("logs_table", "show_logs", "#example1");
        
    </script>
</body>
</html>
<?php
  //  $SystemAlert = $systemcore->SystemAlert();
?>


