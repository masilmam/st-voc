<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <meta name="description" content="Sufee Admin - HTML5 Admin Template">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="apple-touch-icon" href="apple-icon.png">
  <link rel="shortcut icon" href="<?php echo base_url('design/').'icon.png'; ?>" width="32px" height="32px">

  <link rel="stylesheet" href="<?php echo base_url('design/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('design/vendors/font-awesome/css/font-awesome.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('design/vendors/themify-icons/css/themify-icons.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('design/vendors/flag-icon-css/css/flag-icon.min.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('design/vendors/selectFX/css/cs-skin-elastic.css'); ?>">

  <link rel="stylesheet" href="<?php echo base_url('design/assets/css/style.css'); ?>">

  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>
<body class="bg-dark">
  <div class="sufee-login d-flex align-content-center flex-wrap">
    <div class="container">
      <div class="login-content">
        <div class="login-logo">
          <?php 
            if(isset($msg)) {
          ?>
          <div class="alert  alert-warning alert-dismissible fade show" role="alert">
            <?php echo $msg; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <?php } ?>
        </div>
        <div class="login-form">
          <form action="<?php echo base_url('Main/doLogin'); ?>" method="POST">
            <div class="form-group">
              <label>Username</label>
              <input type="text" name="username" class="form-control" placeholder="Username">
            </div>
              <div class="form-group">
              <label>Password</label>
              <input type="password" name="password" class="form-control" placeholder="Password">
            </div>
              <input type="submit" value="Sign In" class="btn btn-success btn-flat m-b-30 m-t-30">
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="<?php echo base_url('design/vendors/jquery/dist/jquery.min.js'); ?>"></script>
  <script src="<?php echo base_url('design/vendors/popper.js/dist/umd/popper.min.js'); ?>"></script>
  <script src="<?php echo base_url('design/vendors/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('design/assets/js/main.js'); ?>"></script>

</body>
</html>
