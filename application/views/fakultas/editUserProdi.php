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
    <title>Edit User Program Studi</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="<?php echo base_url('design/').'icon.png'; ?>" width="32px" height="32px">

    <link rel="stylesheet" href="<?php echo base_url('design/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('design/vendors/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('design/vendors/themify-icons/css/themify-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('design/vendors/flag-icon-css/css/flag-icon.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('design/vendors/selectFX/css/cs-skin-elastic.css'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('/design/assets/css/style.css'); ?>">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
</head>
<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
      <nav class="navbar navbar-expand-sm navbar-default">
        <div class="navbar-header">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fa fa-bars"></i>
          </button>
          <a class="navbar-brand" href="./"><img src="<?php echo base_url('/design/images/logo.png'); ?>" alt="Logo"></a>
          <a class="navbar-brand hidden" href="./"><img src="<?php echo base_url('/design/images/logo2.png'); ?>" alt="Logo"></a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li>
              <a href="<?php echo base_url('Fakultas/dashboard'); ?>"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
            </li>
            <h3 class="menu-title">Kelola Data</h3><!-- /.menu-title -->
            <li class="menu-item-has-children dropdown">
              <li>
              	<a href="<?php echo base_url('Fakultas/prodiList'); ?>"> <i class="menu-icon ti-blackboard"></i>Data Program Studi</a>
          		</li>
          		<li>
              	<a href="<?php echo base_url('Fakultas/suratList'); ?>"> <i class="menu-icon ti-file"></i>Data Surat Tugas</a>
          		</li>
              <li class="active">
                <a href="<?php echo base_url('Fakultas/userProdiList'); ?>"> <i class="menu-icon ti-user"></i>Data User Program Studi</a>
              </li>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
      <!-- Header-->
      <header id="header" class="header">
        <div class="header-menu">
          <div class="col-sm-7">
            <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
          </div>

          <div class="col-sm-5">
            <div class="user-area dropdown float-right">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img class="user-avatar rounded-circle" src="<?php echo base_url('design/images/admin.jpg'); ?>" alt="User Avatar">
              </a>

              <div class="user-menu dropdown-menu">
                <a class="nav-link" href="#"><i class="fa fa-user"></i> My Profile</a>
                <a class="nav-link" href="#"><i class="fa fa-cog"></i> Settings</a>
                <a class="nav-link" href="#"><i class="fa fa-power-off"></i> Logout</a>
              </div>
            </div>
          </div>
        </div>
      </header><!-- /header -->
      <!-- Header-->

      <div class="content mt-3">
        <!-- alert template -->
        <!-- <div class="col-sm-12">
          <div class="alert  alert-success alert-dismissible fade show" role="alert">
            <span class="badge badge-pill badge-success">Success</span> You successfully read this important alert message.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
        </div>  -->

        <div class="animated fadeIn">
          <div class="row">
            <div class="col-md-12">
              <h3>Edit User Program Studi</h3><br />
              <div class="card">
                <div class="card-body">
                  <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <div class="row form-group">
                <div class="col col-md-3"><label for="select" class=" form-control-label">Program Studi</label></div>
                <div class="col-12 col-md-9">
                  <select name="select" id="select" disabled="" class="form-control">
                    <optgroup label="Departemen 1">
                      <option>Program Studi 1</option>
                      <option selected="">Program Studi 2</option>
                    </optgroup>
                    <optgroup label="Departemen 2">
                      <option>Program Studi 3</option>
                    </optgroup>
                  </select>
                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Username</label></div>
                <div class="col-12 col-md-9"><input type="text" id="text-input" name="text-input" class="form-control"></div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Password</label></div>
                <div class="col-12 col-md-9"><input type="password" id="text-input" name="text-input" class="form-control"></div>
              </div>
                    <input type="submit" value="Submit" class="btn btn-primary btn-md">
                </div>
              </div>
            </div>
          </div>
      </div><!-- .animated -->
      </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="tambah">Tambah Program Studi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="#" method="post" enctype="multipart/form-data" class="form-horizontal">
              <div class="row form-group">
                <div class="col col-md-3"><label for="select" class=" form-control-label">Pilih Departemen</label></div>
                <div class="col-12 col-md-9">
                  <select name="select" id="select" class="form-control">
                    <optgroup label="Departemen 1">
                      <option>Program Studi 1</option>
                      <option>Program Studi 2</option>
                    </optgroup>
                    <optgroup label="Departemen 2">
                      <option>Program Studi 3</option>
                    </optgroup>
                  </select>
                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Username</label></div>
                <div class="col-12 col-md-9"><input type="text" id="text-input" name="text-input" class="form-control"></div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Password</label></div>
                <div class="col-12 col-md-9"><input type="password" id="text-input" name="text-input" class="form-control"></div>
              </div>
          </div>
            <input type="submit" value="Submit" class="btn btn-primary">
            </form>
          </div>
        </div>
      </div>
    </div> <!-- end modal tambah -->

    <script src="<?php echo base_url('design/vendors/jquery/dist/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('design/vendors/popper.js/dist/umd/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('design/vendors/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('design/assets/js/main.js'); ?>"></script>

</body>

</html>
