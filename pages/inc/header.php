<?php 

// include 'session.php';
error_reporting(0);
?>
<head> 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $_SESSION["system_head_title"]; ?></title> 
  <!-- Tell the browser to be responsive to screen width -->
  <!-- <meta name="viewport" content="width=device-width, initial-scale=0.5"> -->
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"> -->
  
  <!-- <meta property="og:image" content="../../dist/img/resbakuna.png" /> -->
  <!-- <link rel="image_src" href="../../dist/img/resbakuna.png"> -->

  <!-- <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'> -->
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <!-- <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css"> -->
  <!-- Tempusdominus Bbootstrap 4 -->
  <!-- <link rel="stylesheet" href="../../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> -->
  <!-- iCheck -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="../../plugins/bootstrap-4.6.2/css/bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../../plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <!-- <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet"> -->

  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <link rel="stylesheet" href="../../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">

  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="../../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="../../plugins/jquery-ui/1.14/jquery-ui.min.css">

  <!-- Global site tag (gtag.js) - Google Analytics -->
		<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-163334868-1"></script> -->
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-163334868-1');
		</script>
  
  <style>
/* System UI colors for every Tabs */
  .system_nav_text{
    color: rgb(<?php echo $_SESSION["system_nav_bar_text_color"];?>) !important;
  }
  .system_nav_bar{
    background-color: rgb(<?php echo $_SESSION["system_nav_bar"];?>) !important;
  }

  .system_side_bar_text{
    color: rgb(<?php echo $_SESSION["system_side_bar_text"];?>) !important;
  }

  .system_side_bar_text:hover{
    color:  rgb(<?php echo $_SESSION["system_hover_side_bar_text"];?>) !important;
    background-color:  rgb(<?php echo $_SESSION["system_hover_side_bar_text_bg"];?>) !important;
  }

  .system_side_bar{
    background-color: rgb(<?php echo $_SESSION["system_side_bar"];?>) !important;
  }

  .login-background{
    background-image: url("<?php echo "../../dist/img/".$_SESSION["system_login_background_image"]; ?>");
    background-repeat: repeat !important;
    background-size: 100% !important;
    
  }

  .pages_body{
    background-image: url("<?php echo "../../dist/img/".$_SESSION["system_background_image"]; ?>");
    background-repeat: repeat !important;
    background-size: 100% !important;
    padding-bottom:200px;
  }

  .card-header{
    background-color: rgb(<?php echo $_SESSION["system_header_color"];?>) !important;
    color:  rgb(<?php echo $_SESSION["system_header_font_color"];?>) !important;
  }

  .modal-header{
    background-color: rgb(<?php echo $_SESSION["system_modal_header_color"];?>) !important;
    color:  rgb(<?php echo $_SESSION["system_modal_header_font_color"];?>) !important;
  }

  .profile_shell{
    border:1px solid rgb(173, 166, 166);
    height:300px !important; 
    /* width:300px !important; */
  }

  #profile{
    height:100% !important; 
    width:100% !important;
  }

  .manual_table{
    height: 40px;
    padding:1%;
    background-color: rgb(227, 232, 229);
  }
  .manual_table1{
    height: 40px;
    padding:1%;
  }

  .custom_required{
    display:none;
  }
  #overlay {
  position: fixed; /* Sit on top of the page content */
  display: none; /* Hidden by default */
  width: 100%; /* Full width (cover the whole page) */
  height: 100%; /* Full height (cover the whole page) */
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(0,0,0,0.5);
  z-index: 99999; /* Specify a stack order in case you're using a different order for other elements */
  cursor: pointer; /* Add a pointer on hover */
}

#loading {
  display: none; /* Hidden by default */
  width: 100%; /* Full width (cover the whole page) */
  height: 100%; /* Full height (cover the whole page) */
  z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
  cursor: pointer; /* Add a pointer on hover */
}

#confirmation_box {
  z-index: 999999; /* Specify a stack order in case you're using a different order for other elements */
}

.modal{
    color:rgb(74, 40, 7);
    font-size: 13px;
}

.custom_stripped_1{
  background-color:rgba(225, 243, 228, 0.801);
}

.custom_stripped_2{
  background-color:white;
}

  .btn-success,
  .btn-outline-success,
  .btn-secondary,
  .btn-outline-secondary{
    background-color: rgb(<?php echo $_SESSION["system_add_bg_btn_color"];?>) !important;
    border:<?php echo $_SESSION["system_add_btn_border"];?> !important;
    color:rgb(<?php echo $_SESSION["system_add_btn_color"];?>) !important;
    font-size:<?php echo $_SESSION["system_add_btn_size"];?> !important;
  }

  .btn-success:hover,
  .btn-outline-success:hover,
  .btn-secondary:hover,
  .btn-outline-secondary:hover{
    color: rgb(<?php echo $_SESSION["system_add_bg_btn_color"];?>) !important;
    background-color:rgb(<?php echo $_SESSION["system_add_btn_color"];?>) !important;
  }

  .btn-danger,
  .btn-outline-danger{
    background-color: rgb(<?php echo $_SESSION["system_delete_bg_btn_color"];?>) !important;
    border:<?php echo $_SESSION["system_delete_btn_border"];?> !important;
    color:rgb(<?php echo $_SESSION["system_delete_btn_color"];?>) !important;
    font-size:<?php echo $_SESSION["system_delete_btn_size"];?> !important;
  }

  .btn-danger:hover,
  .btn-outline-danger:hover{
    color: rgb(<?php echo $_SESSION["system_delete_bg_btn_color"];?>) !important;
    background-color:rgb(<?php echo $_SESSION["system_delete_btn_color"];?>) !important;
  }

  .btn-primary,
  .btn-outline-primary,
  .btn-info,
  .btn-outline-info{
    background-color: rgb(<?php echo $_SESSION["system_edit_bg_btn_color"];?>) !important;
    border:<?php echo $_SESSION["system_edit_btn_border"];?> !important;
    color:rgb(<?php echo $_SESSION["system_edit_btn_color"];?>) !important;
    font-size:<?php echo $_SESSION["system_edit_btn_size"];?> !important;
  }

  .btn-primary:hover,
  .btn-outline-primary:hover,
  .btn-info:hover,
  .btn-outline-info:hover{
    color: rgb(<?php echo $_SESSION["system_edit_bg_btn_color"];?>) !important;
    background-color:rgb(<?php echo $_SESSION["system_edit_btn_color"];?>) !important;
  }



</style>
</head>
<?php 
date_default_timezone_set('Asia/Manila');
?>
<div id="overlay"></div>


