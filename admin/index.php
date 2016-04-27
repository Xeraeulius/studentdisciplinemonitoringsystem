<?php  
require '../app/controller/init.php';
revert_page_protection();
revert_page_protection_admin();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login | APC Violation</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="../app/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="../app/assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../app/assets/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="../app/assets/plugins/iCheck/flat/blue.css">
    <link rel="stylesheet" href="../app/assets/plugins/morris/morris.css">
    <link rel="stylesheet" href="../app/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <link rel="stylesheet" href="../app/assets/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="../app/assets/plugins/daterangepicker/daterangepicker-bs3.css">
    <link rel="stylesheet" href="../app/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <img src="../app/assets/logo/apclogo.png" style="width: 100px; height: 100px;" draggable="false">
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <form action="index.php" method="POST">
          <div class="form-group has-feedback">
            <input type="text" name="username" class="form-control" placeholder="Username" required autocomplete="off" autofocus="on">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="off">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <?php  
            if (isset($_POST['btn_submit'])) {
              $username = $_POST['username'];
              $password = $_POST['password'];

              $login = login_admin($username, $password);

              if ($login === FALSE) {
                // Success Failed -> Result: Working
          ?>
                <div class="form-group">
                  <center class="alert alert-danger">
                    <span class="glyphicon glyphicon-warning-sign"></span>
                    Incorrect Username or Password <p></p>
                  <center>
                </div> 
          <?php
              } else {
                // Success Login -> Result: Working
                $logged_in = session_admin_login($username);
                $_SESSION['admin_id'] = $logged_in;
                header('Location: ../admin.php');
                exit();
              }
            }
          ?>
          <div class="row">
            <div class="col-xs-4">
              <button type="submit" name="btn_submit" class="btn btn-primary btn-block btn-flat">Log In</button>
            </div><!-- /.col -->
          </div>
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
  </body>
</html>