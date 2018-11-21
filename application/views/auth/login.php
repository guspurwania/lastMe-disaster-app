<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>QBus | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url("assets/adminlte/") ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url("assets/adminlte/") ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url("assets/adminlte/") ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url("assets/adminlte/") ?>dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url("assets/adminlte/") ?>plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  
  <!--<script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async></script>-->

</head>
<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
    <b>QBus</b> <br />Admin Login
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <?php 
      if (!empty($message))
      {
      ?>
        <div class="alert alert-info">
          <?php echo $message;?>
        </div>
      <?php
      }
      ?>
      <form method="POST" action="<?php echo base_url('auth/login') ?>" id="login">
        <div class="form-group has-feedback">
          <?php echo form_input($identity);?>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <?php echo form_input($password);?>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <a href="<?php echo base_url('auth/forgot_password') ?>"><?php echo lang('login_forgot_password');?></a>
                <!-- <?php //echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
                Remember Me  -->
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
        <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->

      <!-- <a href="<?php echo base_url('auth/forgot_password') ?>"><?php echo lang('login_forgot_password');?></a><br> -->
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->
  
  <!-- jQuery 3 -->
  <script src="<?php echo base_url("assets/adminlte/") ?>bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url("assets/adminlte/") ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url("assets/adminlte/") ?>plugins/iCheck/icheck.min.js"></script>

  <script type="text/javascript">
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });

  </script>
</body>
</html>