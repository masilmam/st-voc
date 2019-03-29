<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function tanggal($tgl) {
  $bulan = array(
    1 => 'Januari',
    2 => 'Februari',
    3 => 'Maret',
    4 => 'April',
    5 => 'Mei',
    6 => 'Juni',
    7 => 'Juli',
    8 => 'Agustus',
    9 => 'September',
    10 => 'Oktober',
    11 => 'November',
    12 => 'Desember',
  );
  $pecah = explode('-', $tgl);

  return $pecah[2].' '.$bulan[(int)$pecah[1]].' '.$pecah[0];
}
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
    <title>Data Surat Tugas</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="<?php echo base_url('design/').'icon.png'; ?>" width="32px" height="32px">

    <link rel="stylesheet" href="<?php echo base_url('design/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('design/vendors/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('design/vendors/themify-icons/css/themify-icons.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('design/vendors/flag-icon-css/css/flag-icon.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('design/vendors/selectFX/css/cs-skin-elastic.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('design/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('design/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css'); ?>">

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
            <li><a href="<?php echo base_url('Fakultas/dashboard'); ?>"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a></li>
            <h3 class="menu-title">Kelola Data</h3><!-- /.menu-title -->
            <li class="menu-item-has-children dropdown">
              <li><a href="<?php echo base_url('Fakultas/prodiList'); ?>"> <i class="menu-icon ti-blackboard"></i>Data Program Studi</a></li>
              <li class="active"><a href="<?php echo base_url('Fakultas/suratList'); ?>"> <i class="menu-icon ti-file"></i>Data Surat Tugas</a></li>
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

        <div class="animated fadeIn">
          <div class="row">
            <div class="col-md-12">
              <h3>Data Surat Tugas</h3><br />
              <div class="card">
                <div class="card-body">
                  <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Nama</th>
                        <th>Program Studi</th>
                        <th>Tanggal Permohonan</th>
                        <th>Tanggal Kegiatan</th>
                        <th>Nama Kegiatan</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach ($suratList as $s) {
                          if ($s->status == 1) {
                            $badge = 'badge badge-warning';
                            $teks = 'Pending';
                          } elseif ($s->status == 2) {
                            $badge = 'badge badge-primary';
                            $teks = 'Proses: Disetujui Dekan, Disposisi ke WD I';
                          } elseif ($s->status == 3) {
                            $badge = 'badge badge-primary';
                            $teks = 'Proses: Disetujui Dekan, Disposisi ke WD II';
                          } elseif ($s->status == 4) {
                            $badge = 'badge badge-primary';
                            $teks = 'Proses: Disetujui WD I, Disposisi ke Kepala TU';
                          } elseif ($s->status == 5) {
                            $badge = 'badge badge-primary';
                            $teks = 'Proses: Disetujui WD II, Disposisi ke Kepala TU';
                          } elseif ($s->status == 6) {
                            $badge = 'badge badge-success';
                            $teks = 'Selesai';
                          } elseif ($s->status == 7) {
                            $badge = 'badge badge-success';
                            $teks = 'Selesai';
                          } elseif ($s->status == 8) {
                            $badge = 'badge badge-danger';
                            $teks = 'Ditolak';
                          }
                      ?>
                      <tr>
                        <td><?php echo $s->peserta1; ?></td>
                        <td><?php echo $s->nama_prodi; ?></td>
                        <td><?php echo tanggal($s->tgl_permohonan); ?></td>
                        <td><?php echo tanggal($s->tgl_berangkat).' - '.tanggal($s->tgl_kembali); ?></td>
                        <td><?php echo $s->nama_kegiatan; ?></td>
                        <td><span class="<?php echo $badge; ?>"><?php echo $teks; ?></span></td>
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
      </div><!-- .animated -->
      </div> <!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <script src="<?php echo base_url('design/vendors/jquery/dist/jquery.min.js'); ?>"></script>
    <script src="<?php echo base_url('design/vendors/popper.js/dist/umd/popper.min.js'); ?>"></script>
    <script src="<?php echo base_url('design/vendors/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('design/assets/js/main.js'); ?>"></script>

    <script src="<?php echo base_url('design/vendors/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
    <script src="<?php echo base_url('design/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js'); ?>"></script>
    <script src="<?php echo base_url('design/vendors/datatables.net-buttons/js/dataTables.buttons.min.js'); ?>"></script>
    <script src="<?php echo base_url('design/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js'); ?>"></script>
    <script src="<?php echo base_url('design/vendors/jszip/dist/jszip.min.js'); ?>"></script>
    <script src="<?php echo base_url('design/vendors/pdfmake/build/pdfmake.min.js'); ?>"></script>
    <script src="<?php echo base_url('design/vendors/pdfmake/build/vfs_fonts.js'); ?>"></script>
    <script src="<?php echo base_url('design/vendors/datatables.net-buttons/js/buttons.html5.min.js'); ?>"></script>
    <script src="<?php echo base_url('design/vendors/datatables.net-buttons/js/buttons.print.min.js'); ?>"></script>
    <script src="<?php echo base_url('design/vendors/datatables.net-buttons/js/buttons.colVis.min.js'); ?>"></script>
    <script src="<?php echo base_url('design/assets/js/init-scripts/data-table/datatables-init.js'); ?>"></script>

</body>

</html>
