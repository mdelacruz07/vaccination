<!DOCTYPE html>
<html>
  <?php 
    session_start();
    session_destroy(); 
    include '../../controller/systemcore.php'; 
    $systemcore = new systemcore();
    $System_Sessioning = $systemcore->System_Sessioning("unsession");
    include '../inc/header.php'; 
 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $System_Sessioning = $systemcore->System_Sessioning("unsession");
      $login_username = $_POST['login_username'];
      $login_password = $_POST['login_password'];

      $SelectTable = $systemcore->SelectTable("system_user WHERE username = '".$login_username."'");
      if($SelectTable == "none"){ ?>
            <div class="alert alert-danger custom_required alert-dismissible fade show" role="alert">
              <strong>WARNING!</strong> Account Doesn't Exist or You Have Entered the Wrong Username!
            </div> <?php
      }
      else {
          foreach($SelectTable as $value){
            $name = $value['first_name'];
          if($value['password'] !=  md5($login_password)){
            ?>
              <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>WARNING!</strong> <?php echo $name; ?> You Have Entered the Wrong Password! 
              </div> 
              
            
            <?php
          }
          else{
            $_SESSION["user_id"] = $value['id'];
            $_SESSION["user_account_id"] = $value['account_id'];
            $_SESSION["user_first_name"] = $value['first_name'];
            $_SESSION["user_middle_name"] = $value['middle_name'];
            $_SESSION["user_last_name"] = $value['last_name'];
            $_SESSION["user_full_name"] = $value['first_name']." ".$value['middle_name']." ".$value['last_name'];
            $_SESSION["user_age"] = $value['age'];
            $_SESSION["user_birthday"] = $value['birthday'];
            $_SESSION["user_gender"] = $value['gender'];
            $_SESSION["user_username"] = $value['username'];
            $_SESSION["user_password"] = $value['password'];
            $_SESSION["user_date_added"] = $value['date_added'];
            $_SESSION["user_access_level"] = $value['access'];
            $_SESSION["profile_picture"] = $value['profile_picture'];
            $_SESSION["user_facility"] = $value['facility_id'];
          
            //Selecting the pages that the user can access
            $SelectAccess = $systemcore->SelectTable("system_page_access WHERE page_access = '".$value['access']."'");
            foreach($SelectAccess as $access){
              $_SESSION["user_access_pages"] = $access['page_id'];
              $_SESSION["user_access_nav_group"] = $access['nav_group_id'];
              
            }
    
            // $operation = "Log-in";
            // $description = "Performed $operation";
            // $SystemLogs = $systemcore->SystemLogs($operation, $description);
            // if($value['first_name'] == "Mary Mae" && $value['middle_name'] == "Anover" && $value['last_name'] == "Flandez"){
            //   echo "<script> location.replace('../sorry/index.php'); </script>";
            // }else{
              echo "<script> location.replace('../main/index.php'); </script>";
            // }
          }
        }
      }
    }else{
      $login_username = "";
      $login_password = "";
    }
  ?>
  <body class="hold-transition login-page login-background">
    <div class="login-box" style="background-color: rgba(49, 250, 14, 0.5); border-radius: 25px; padding:20px;">
      <div class="text-center">
        <img class=
        <br><br>
      </div>
      <div class="login-logo">
        <a href="index.php"><?php echo $_SESSION["system_title"];?></a>
      </div>
      <b><center><?php echo date("F d Y"); ?></center></b><br>
      <!-- /.login-logo -->
      <div class="card" >
        <div class="card-body login-card-body">
          <p class="login-box-msg">Sign in to start your session</p>

          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="input-group mb-3">
              <input type="username" class="form-control" name="login_username" value="<?php echo $login_username; ?>" placeholder="Username">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="login_password" value="<?php echo $login_password; ?>" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8">
              </div>
              <!-- /.col -->
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Log In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

        </div>
        <!-- /.login-card-body -->
      </div><?php  include '../inc/copyfooter_general.php'; 
      // ?>
    </div>
  <!-- /.login-box -->
  </body>
</html>
