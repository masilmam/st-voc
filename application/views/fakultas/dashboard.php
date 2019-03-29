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
    <title>Master Fakultas</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="<?php echo base_url('design/').'icon.png'; ?>" width="32px" height="32px">

    <link rel="stylesheet" href="<?php echo base_url('design/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('design/vendors/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('design/vendors/themify-icons/css/themify-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('design/vendors/flag-icon-css/css/flag-icon.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('design/vendors/selectFX/css/cs-skin-elastic.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('design/vendors/jqvmap/dist/jqvmap.min.css'); ?>">

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
            <li class="active"><a href="<?php echo base_url('Fakultas/dashboard'); ?>"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a></li>
            <h3 class="menu-title">Kelola Data</h3><!-- /.menu-title -->
            <li class="menu-item-has-children dropdown">
              <li><a href="<?php echo base_url('Fakultas/prodiList'); ?>"> <i class="menu-icon ti-blackboard"></i>Data Program Studi</a></li>
          		<li><a href="<?php echo base_url('Fakultas/suratList'); ?>"> <i class="menu-icon ti-file"></i>Data Surat Tugas</a></li>
          		<li><a href="<?php echo base_url('Fakultas/userProdiList'); ?>"> <i class="menu-icon ti-user"></i>Data User Program Studi</a></li>
          		<li><a href="#"> <i class="menu-icon ti-settings"></i>Pengaturan</a></li>
            	<li><a href="<?php echo base_url('Main/logout'); ?>"> <i class="menu-icon ti-close"></i>Log Out</a></li>
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
              Selamat datang, <?php echo $userDetail->username; ?>&nbsp;&nbsp;&nbsp;
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
        <div class="jumbotron">
          <h1 class="pb-2 display-4">Selamat datang</h1>
        </div>

          <div class="col-xl-4 col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="stat-widget-one">
                  <div class="stat-icon dib"><i class="ti-files text-success border-success"></i></div>
                  <div class="stat-content dib">
                      <div class="stat-text"><b><u>Permohonan</u></b></div>
                      <div class="stat-digit"><a href="#" style="color:#000000;"><?php echo $suratRequest; ?></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="col-xl-4 col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="stat-widget-one">
                  <div class="stat-icon dib"><i class="ti-check-box text-primary border-primary"></i></div>
                  <div class="stat-content dib">
                    <div class="stat-text"><b><u>Surat Diterima</u></b></div>
                    <div class="stat-digit"><a href="#" style="color:#000000;"><?php echo $suratAccept; ?></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-4 col-lg-12">
            <div class="card">
              <div class="card-body">
                <div class="stat-widget-one">
                  <div class="stat-icon dib"><i class="ti-close text-danger border-danger"></i></div>
                  <div class="stat-content dib">
                    <div class="stat-text"><b><u>Surat Ditolak</u></b></div>
                    <div class="stat-digit"><a href="#" style="color:#000000;"><?php echo $suratDeclined; ?></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="<?php echo base_url('design/vendors/jquery/dist/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('design/vendors/popper.js/dist/umd/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('design/vendors/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('design/assets/js/main.js'); ?>"></script>


    <script src="<?php echo base_url('design/vendors/chart.js/dist/Chart.bundle.min.js'); ?>"></script>
    <script src="<?php echo base_url('design/assets/js/dashboard.js'); ?>"></script>
    <script src="<?php echo base_url('design/assets/js/widgets.js'); ?>"></script>
    <script src="<?php echo base_url('design/vendors/jqvmap/dist/jquery.vmap.min.js'); ?>"></script>
    <script src="<?php echo base_url('design/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js'); ?>"></script>
    <script src="<?php echo base_url('design/vendors/jqvmap/dist/maps/jquery.vmap.world.js'); ?>"></script>
    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>

</body>

</html>
