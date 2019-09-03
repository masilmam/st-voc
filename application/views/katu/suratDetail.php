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

    <!-- jQuery datepicker -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
      $( function() {
        $( "#datepicker,#datepicker1,#datepicker2" ).datepicker({
          dateFormat: 'yy-mm-dd',
          minDate: new Date()
        });
      } );
    </script>
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
            <li><a href="<?php echo base_url('Katu/dashboard'); ?>"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a></li>
            <li class="active"><a href="<?php echo base_url('Katu/suratList'); ?>"> <i class="menu-icon ti-file"></i>Data Surat Tugas</a></li>
            <li><a href="#"> <i class="menu-icon ti-settings"></i>Pengaturan</a></li>
            <li><a href="<?php echo base_url('Main/logout'); ?>"> <i class="menu-icon ti-close"></i>Log Out</a></li>
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
        <?php 
          if(isset($msg)) {
        ?>
        <div class="alert  alert-info alert-dismissible fade show" role="alert">
          <?php echo $msg; ?>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <?php } ?>

        <div class="animated fadeIn">
          <div class="row">
            <div class="col-md-12">
              <h3>Detail Surat Tugas</h3><br />
              <div class="card">
                <div class="card-header">
                  <strong class="card-title">Informasi Surat Tugas</strong>
                </div>
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
                    <h5>Tanggal Mulai Menjalankan Tugas</h5>
                    <p><?php echo tanggal($suratDetail->tgl_berangkat); ?></p>
                    <h5>Tanggal Selesai Menjalankan Tugas</h5>
                    <p><?php echo tanggal($suratDetail->tgl_kembali); ?></p>
                  </div>
                  <div class="col-md-12">
                    <a href="<?php echo base_url('Katu/dokumen/').$suratDetail->dokumen; ?>" class="btn btn-warning" style="color:#fff"><i class="fa fa-paperclip"></i>&nbsp; Lihat Berkas</a>&nbsp;
                    <?php
                      if ($suratDetail->no_surat == 0) {
                    ?>
                    <a data-target="#no_surat" data-toggle="modal" href="#no_surat" class="btn btn-success" style="color:#fff"><i class="fa fa-gavel"></i>&nbsp; Buat Nomor Surat</a>&nbsp;
                    <?php } 
                      if ($suratDetail->status == 4 || $suratDetail->status == 5) {
                    ?>
                    <a data-target="#disposisi" data-toggle="modal" href="#disposisi" class="btn btn-primary" style="color:#fff"><i class="fa fa-share"></i>&nbsp; Disposisi</a>&nbsp;
                    <a data-target="#edit" data-toggle="modal" href="#edit" class="btn btn-info" style="color:#fff"><i class="fa fa-edit"></i>&nbsp; Edit</a>&nbsp;
                    <a href="#" class="btn btn-danger" style="color:#fff"><i class="fa fa-close"></i>&nbsp; Tolak</a>&nbsp;
                    <?php }
                      if ($suratDetail->no_surat != 0) {
                    ?>
                    <a href="<?php echo base_url('Katu/cetak/').$suratDetail->id_surat; ?>" class="btn btn-secondary" style="color:#fff"><i class="fa fa-print"></i>&nbsp; Cetak Surat</a>&nbsp;
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <strong class="card-title">Informasi Disposisi</strong>
                </div>
                <div class="card-body">
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Disposisi</th>
                        <th scope="col">Isi Disposisi</th>
                        <th scope="col">Sifat</th>
                        <th scope="col">Batas Waktu</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $i = 1;
                        foreach($disposisi as $d) {
                      ?>
                      <tr>
                        <th scope="row"><?php echo $i++; ?></th>
                        <td><?php echo $d->disposisi; ?></td>
                        <td><?php echo $d->isi; ?></td>
                        <td><?php echo $d->sifat; ?></td>
                        <td><?php echo tanggal($d->batas_waktu); ?></td>
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

    <div class="modal fade" id="disposisi" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="disposisi">Disposisi Surat</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url('Katu/doAddDisposisi'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <input type="hidden" name="id_surat" value="<?php echo $suratDetail->id_surat; ?>">
              <div class="row form-group">
                <div class="col col-md-3"><label for="disposisi" class=" form-control-label">Tujuan Disposisi</label></div>
                <div class="col-12 col-md-9">
                  <select name="disposisi" id="disposisi" class="form-control" required>
                    <option disabled selected value> -- Pilih Tujuan Diposisi -- </option>
                    <option value="Dari Kepala Tata Usaha ke Kepala Bagian Keuangan">Kepala Bagian Keuangan</option>
                  </select>
                  <small><?php echo form_error('disposisi'); ?></small>
                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="isi" class=" form-control-label">Isi Disposisi</label></div>
                <div class="col-12 col-md-9"><input type="text" id="isi" name="isi" class="form-control" value="<?php echo set_value('isi'); ?>" required><small><?php echo form_error('isi'); ?></small></div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="sifat" class=" form-control-label">Sifat</label></div>
                <div class="col-12 col-md-9">
                  <select name="sifat" id="sifat" class="form-control" required>
                    <option disabled selected value> -- Pilih Sifat -- </option>
                    <option value="Biasa">Biasa</option>
                    <option value="Segera">Segera</option>
                    <option value="Perlu Perhatian Khusus">Perlu Perhatian Khusus</option>
                    <option value="Perhatian Batas Waktu">Perhatian Batas Waktu</option>
                  </select>
                  <small><?php echo form_error('sifat'); ?></small>
                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="batas_waktu" class=" form-control-label">Batas Waktu</label></div>
                <div class="col-12 col-md-9"><input type="text" id="datepicker" name="batas_waktu" autocomplete="off" class="form-control" required><small><?php echo form_error('batas_waktu'); ?></small></div>
              </div>
          </div>
          <div class="modal-footer">
            <input type="submit" value="Submit" class="btn btn-primary">
            </form>
          </div>
        </div>
      </div>
    </div> <!-- end modal disposisi -->

    <div class="modal fade" id="no_surat" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="no_surat">Pilih Kode Surat</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url('Katu/approve'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <input type="hidden" name="id_surat" value="<?php echo $suratDetail->id_surat; ?>">
              <div class="row form-group">
                <div class="col col-md-3"><label for="kode_surat" class=" form-control-label">Kode Surat</label></div>
                <div class="col-12 col-md-9">
                  <select name="kode_surat" id="kode_surat" class="form-control" required>
                    <option disabled selected value> -- Pilih Kode Surat -- </option>
                    <option value="UN7.P2/KU/">UN7.P2/KU/</option>
                    <option value="UN7.P2/TU/">UN7.P2/TU/</option>
                    <option value="UN7.P2/KP/">UN7.P2/KP/</option>
                    <option value="UN7.P2/HK/">UN7.P2/HK/</option>
                    <option value="UN7.P2/OT/">UN7.P2/OT/</option>
                  </select>
                  <small><?php echo form_error('kode_surat'); ?></small>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <input type="submit" value="Submit" class="btn btn-primary">
            </form>
          </div>
        </div>
      </div>
    </div> <!-- end modal nomor surat -->

    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="edit">Edit Data Surat</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url('Katu/doEditSurat'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <input type="hidden" name="id_surat" value="<?php echo $suratDetail->id_surat; ?>">
              <div class="row form-group">
                <div class="col col-md-3"><label for="nama_kegiatan" class=" form-control-label">Nama Kegiatan</label></div>
                <div class="col-12 col-md-9"><input type="text" id="nama_kegiatan" name="nama_kegiatan" class="form-control" value="<?php echo $suratDetail->nama_kegiatan; ?>" required oninvalid="this.setCustomValidity('Nama Kegiatan harus diisi')" oninput="this.setCustomValidity('')"><small class="form-text text-muted">Contoh: Seminar Nasional; Workhsop; Kerjasama; Penulisan Artikel Ilmiah; Pengabdian Masyarakat; Penelitian; dll</small><small><?php echo form_error('nama_kegiatan'); ?></small></div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="judul_kegiatan" class=" form-control-label">Judul Kegiatan</label></div>
                <div class="col-12 col-md-9"><input type="text" id="judul_kegiatan" name="judul_kegiatan" class="form-control" value="<?php echo $suratDetail->judul_kegiatan; ?>" required oninvalid="this.setCustomValidity('Judul Kegiatan harus diisi')" oninput="this.setCustomValidity('')"><small class="form-text text-muted">Contoh: Tema atau topik seminar/workshop/kerjasama; Judul Artikel seminar</small><small><?php echo form_error('judul_kegiatan'); ?></small></div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="tempat_kegiatan" class=" form-control-label">Institusi / Tempat</label></div>
                <div class="col-12 col-md-9"><input type="text" id="tempat_kegiatan" name="tempat_kegiatan" class="form-control" value="<?php echo $suratDetail->tempat_kegiatan; ?>" required oninvalid="this.setCustomValidity('Institusi / Tempat harus diisi')" oninput="this.setCustomValidity('')"><small><?php echo form_error('tempat_kegiatan'); ?></small></div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="tgl_berangkat" class=" form-control-label">Tanggal Mulai Menjalankan Tugas</label></div>
                <div class="col-12 col-md-9"><input type="text" id="datepicker1" name="tgl_berangkat" autocomplete="off" class="form-control" value="<?php echo $suratDetail->tgl_berangkat; ?>" required><small><?php echo form_error('tgl_berangkat'); ?></small></div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="tgl_kembali" class=" form-control-label">Tanggal Selesai Menjalankan Tugas</label></div>
                <div class="col-12 col-md-9"><input type="text" id="datepicker2" name="tgl_kembali" autocomplete="off" class="form-control" value="<?php echo $suratDetail->tgl_kembali; ?>" required><small><?php echo form_error('tgl_kembali'); ?></small></div>
              </div>
          </div>
          <div class="modal-footer">
            <input type="submit" value="Submit" class="btn btn-primary">
            </form>
          </div>
        </div>
      </div>
    </div> <!-- end modal edit surat -->

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
