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

  function romawi($number) {
      $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
      $returnValue = '';
      while ($number > 0) {
          foreach ($map as $roman => $int) {
              if($number >= $int) {
                  $number -= $int;
                  $returnValue .= $roman;
                  break;
              }
          }
      }
      return $returnValue;
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
    <title>Detail Surat Tugas</title>
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
            <li class="active"><a href="<?php echo base_url('Prodi/suratList'); ?>"> <i class="menu-icon ti-file"></i>Data Surat Tugas </a></li>
            <li><a href="<?php echo base_url('Prodi/dosenList'); ?>"> <i class="menu-icon fa fa-users"></i>Data Dosen </a></li>
            <li><a href="#"> <i class="menu-icon ti-settings"></i>Pengaturan </a></li>
            <li><a href="<?php echo base_url('Main/logout'); ?>"> <i class="menu-icon ti-close"></i>Log Out </a></li>
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
              <h3>Detail Surat Tugas</h3><br />
              <div class="card">
                <div class="card-body">
                  <div class="col-md-6">
                    <h5>Peserta 1</h5>
                    <p><?php echo $suratDetail->peserta1.' ('.$suratDetail->nip1.')'; ?></p>
                    <?php 
                      if(!empty($suratDetail->peserta2)) {
                    ?>
                    <h5>Peserta 2</h5>
                    <p><?php echo $suratDetail->peserta2.' ('.$suratDetail->nip2.')'; ?></p>
                    <?php 
                      }
                      if(!empty($suratDetail->peserta3)) {
                    ?>
                    <h5>Peserta 3</h5>
                    <p><?php echo $suratDetail->peserta3.' ('.$suratDetail->nip3.')'; ?></p>
                    <?php 
                      }
                      if(!empty($suratDetail->peserta4)) {
                    ?>
                    <h5>Peserta 4</h5>
                    <p><?php echo $suratDetail->peserta4.' ('.$suratDetail->nip4.')'; ?></p>
                    <?php 
                      }
                    ?>
                    <h5>Departemen</h5>
                    <p><?php echo $suratDetail->nama_departemen; ?></p>
                    <h5>Program Studi</h5>
                    <p><?php echo $suratDetail->nama_prodi; ?></p>
                    <?php
                    if ($suratDetail->status == 1) {
                      $badge = 'badge badge-warning';
                      $teks = 'Pending';
                    } elseif ($suratDetail->status == 2) {
                      $badge = 'badge badge-primary';
                      $teks = 'Proses: Disetujui Dekan, Disposisi ke WD I';
                    } elseif ($suratDetail->status == 3) {
                      $badge = 'badge badge-primary';
                      $teks = 'Proses: Disetujui Dekan, Disposisi ke WD II';
                    } elseif ($suratDetail->status == 4) {
                      $badge = 'badge badge-primary';
                      $teks = 'Proses: Disetujui WD I, Disposisi ke Kepala TU';
                    } elseif ($suratDetail->status == 5) {
                      $badge = 'badge badge-primary';
                      $teks = 'Proses: Disetujui WD II, Disposisi ke Kepala TU';
                    } elseif ($suratDetail->status == 6) {
                      $badge = 'badge badge-success';
                      $teks = 'Selesai';
                    } elseif ($suratDetail->status == 7) {
                      $badge = 'badge badge-success';
                      $teks = 'Selesai';
                    } elseif ($suratDetail->status == 8) {
                      $badge = 'badge badge-danger';
                      $teks = 'Ditolak';
                    }
                    ?>
                    <h5>Status</h5>
                    <p><span class="<?php echo $badge; ?>"><?php echo $teks; ?></p>
                    <h5>Nomor Surat</h5>
                    <p>
                      <?php 
                        if ($suratDetail->no_surat == 0) {
                          echo '-';
                        } else {
                          $noSurat = str_pad($suratDetail->no_surat, 3, '0', STR_PAD_LEFT);
                          $bulanSurat = romawi(date("m",strtotime($suratDetail->tgl_surat)));
                          $tahunSurat = substr($suratDetail->tgl_surat, 0, 4);
                          echo $noSurat.'/'.$suratDetail->kode_surat.$bulanSurat.'/'.$tahunSurat;
                        }
                      ?>
                    </p>
                  </div>
                  <div class="col-md-6">
                    <h5>Nama Kegiatan</h5>
                    <p><?php echo $suratDetail->nama_kegiatan; ?></p>
                    <h5>Judul Kegiatan</h5>
                    <p><?php echo $suratDetail->judul_kegiatan; ?></p>
                    <h5>Instansi/Tempat Kegiatan</h5>
                    <p><?php echo $suratDetail->tempat_kegiatan; ?></p>
                    <h5>Tanggal Permohonan</h5>
                    <p><?php echo tanggal($suratDetail->tgl_permohonan); ?></p>
                    <h5>Tanggal Berangkat</h5>
                    <p><?php echo tanggal($suratDetail->tgl_berangkat); ?></p>
                    <h5>Tanggal Kembali</h5>
                    <p><?php echo tanggal($suratDetail->tgl_kembali); ?></p>
                  </div>
                  <div class="col-md-12">
                    <a href="<?php echo base_url('Prodi/dokumen/').$suratDetail->dokumen; ?>" class="btn btn-warning" style="color:#fff"><i class="fa fa-paperclip"></i>&nbsp; Lihat Berkas</a>
                  </div>
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
