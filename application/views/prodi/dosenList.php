<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
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
              <h3><?= $judul; ?>&nbsp;<a data-target="#tambah" data-toggle="modal" href="#tambah" class="fa fa-plus-circle"></a></h3><br />
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