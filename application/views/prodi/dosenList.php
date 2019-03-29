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
    <title>Data Dosen</title>
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
            <li><a href="<?php echo base_url('Prodi/suratList'); ?>"> <i class="menu-icon ti-file"></i>Data Surat Tugas </a></li>
            <li class="active"><a href="<?php echo base_url('Prodi/dosenList'); ?>"> <i class="menu-icon fa fa-users"></i>Data Dosen </a></li>
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
              <h3>Data Dosen&nbsp;<a data-target="#tambah" data-toggle="modal" href="#tambah" class="fa fa-plus-circle"></a></h3><br />
              <div class="card">
                <div class="card-body">
                  <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Golongan</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach ($dosenList as $d) {
                      ?>
                      <tr>
                        <td><?php echo $d->nama_dosen; ?></td>
                        <td><?php echo $d->nip; ?></td>
                        <td><?php echo $d->jabatan; ?></td>
                        <td><?php echo $d->pangkat; ?></td>
                        <td><a href="<?php echo base_url('Prodi/editDosen/').$d->id_dosen; ?>" class="btn btn-secondary btn-sm" style="color: #ffffff;"><i class="fa fa-edit"></i>&nbsp; Edit<a/>
                          <a href="<?php echo base_url('Prodi/deleteDosen/'),$d->id_dosen; ?>" class="btn btn-danger btn-sm" style="color: #ffffff;" onclick="return confirm('Apakah Anda yakin?');"><i class="fa fa-trash"></i>&nbsp; Hapus<a/></td>
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

    <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="tambah">Tambah Data Dosen</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url('Prodi/doAddDosen'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <input type="hidden" name="id_prodi" value="<?php echo $userDetail->id_prodi; ?>">
              <div class="row form-group">
                <div class="col col-md-3"><label for="nama_dosen" class=" form-control-label">Nama</label></div>
                  <div class="col-12 col-md-9"><input type="text" id="nama_dosen" name="nama_dosen" class="form-control" value="<?php echo set_value('nama_dosen'); ?>"><small class="form-text text-muted">Lengkap dengan gelar, Contoh: Prof. Agus Murod, S.T., M.T., PhD.</small><small><?php echo form_error('nama_dosen'); ?></small></div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3"><label for="nip" class=" form-control-label">NIP</label></div>
                  <div class="col-12 col-md-9"><input type="text" id="nip" name="nip" class="form-control" value="<?php echo set_value('nip'); ?>"><small><?php echo form_error('nip'); ?></small></div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3"><label for="jabatan" class=" form-control-label">Jabatan</label></div>
                  <div class="col-12 col-md-9">
                    <select name="jabatan" id="jabatan" class="form-control">
                      <option disabled selected value> -- Pilih Jabatan -- </option>
                      <option value="Asisten Ahli">Asisten Ahli</option>
                      <option value="Lektor">Lektor</option>
                      <option value="Lektor Kepala">Lektor Kepala</option>
                      <option value="Guru Besar">Guru Besar</option>
                    </select>
                    <small><?php echo form_error('jabatan'); ?></small>
                  </div>
                </div>
                <div class="row form-group">
                  <div class="col col-md-3"><label for="pangkat" class=" form-control-label">Golongan</label></div>
                  <div class="col-12 col-md-9">
                    <select name="pangkat" id="pangkat" class="form-control">
                      <option disabled selected value> -- Pilih Golongan -- </option>
                      <option value="III/a">III/a</option>
                      <option value="III/b">III/b</option>
                      <option value="III/c">III/c</option>
                      <option value="III/d">III/d</option>
                      <option value="IV/a">IV/a</option>
                      <option value="IV/b">IV/b</option>
                      <option value="IV/c">IV/c</option>
                      <option value="IV/d">IV/d</option>
                      <option value="IV/e">IV/e</option>
                    </select>
                    <small><?php echo form_error('pangkat'); ?></small>
                  </div>
                </div>
          </div>
          <div class="modal-footer">
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
