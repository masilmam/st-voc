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
              <h3><?= $judul; ?></h3><br />
              <div class="card">
                <div class="card-body">
                  <form action="<?php echo base_url('Prodi/doEditDosen'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
                    <input type="hidden" name="id_dosen" value="<?php echo $dosen->id_dosen; ?>">
                    <div class="row form-group">
                      <div class="col col-md-3"><label for="nama_dosen" class=" form-control-label">Nama Dosen</label></div>
                      <div class="col-12 col-md-9"><input type="text" id="nama_dosen" name="nama_dosen" class="form-control" value="<?php echo $dosen->nama_dosen; ?>" required oninvalid="this.setCustomValidity('Nama Dosen harus diisi')" oninput="this.setCustomValidity('')"><small class="form-text text-muted">Lengkap dengan gelar, Contoh: Prof. Agus Murod, S.T., M.T., PhD.</small><small><?php echo form_error('nama_dosen'); ?></small></div>
                    </div>
                    <div class="row form-group">
                      <div class="col col-md-3"><label for="nip" class=" form-control-label">NIP</label></div>
                      <div class="col-12 col-md-9"><input type="text" id="nip" name="nip" value="<?php echo $dosen->nip; ?>" class="form-control" required oninvalid="this.setCustomValidity('NIP harus diisi')" oninput="this.setCustomValidity('')"><small><?php echo form_error('nip'); ?></small></div>
                    </div>
                    <div class="row form-group">
                      <div class="col col-md-3"><label for="select" class=" form-control-label">Jabatan</label></div>
                      <div class="col-12 col-md-9">
                        <select name="jabatan" id="jabatan" class="form-control">
                          <option disabled selected value> -- Pilih Jabatan -- </option>
                          <option value="Asisten Ahli" <?php if ($dosen->jabatan == 'Asisten Ahli') {echo 'selected';}?>>Asisten Ahli</option>
                          <option value="Lektor" <?php if ($dosen->jabatan == 'Lektor') {echo 'selected';} ?>>Lektor</option>
                          <option value="Lektor Kepala" <?php if ($dosen->jabatan == 'Lektor Kepala') {echo 'selected';} ?>>Lektor Kepala</option>
                          <option value="Guru Besar" <?php if ($dosen->jabatan == 'Guru Besar') {echo 'selected';} ?>>Guru Besar</option>
                        </select>
                        <small><?php echo form_error('jabatan'); ?></small>
                      </div>
                    </div>
                    <div class="row form-group">
                      <div class="col col-md-3"><label for="pangkat" class="form-control-label">Golongan</label></div>
                      <div class="col-12 col-md-9">
                        <select name="pangkat" id="pangkat" class="form-control">
                          <option disabled selected value> -- Pilih Golongan -- </option>
                          <option value="III/a" <?php if ($dosen->pangkat == 'III/a') {echo 'selected';}?>>III/a</option>
                          <option value="III/b" <?php if ($dosen->pangkat == 'III/b') {echo 'selected';}?>>III/b</option>
                          <option value="III/c" <?php if ($dosen->pangkat == 'III/c') {echo 'selected';}?>>III/c</option>
                          <option value="III/d" <?php if ($dosen->pangkat == 'III/d') {echo 'selected';}?>>III/d</option>
                          <option value="IV/a" <?php if ($dosen->pangkat == 'IV/a') {echo 'selected';}?>>IV/a</option>
                          <option value="IV/b" <?php if ($dosen->pangkat == 'IV/b') {echo 'selected';}?>>IV/b</option>
                          <option value="IV/c" <?php if ($dosen->pangkat == 'IV/c') {echo 'selected';}?>>IV/c</option>
                          <option value="IV/d" <?php if ($dosen->pangkat == 'IV/d') {echo 'selected';}?>>IV/d</option>
                          <option value="IV/e" <?php if ($dosen->pangkat == 'IV/e') {echo 'selected';}?>>IV/e</option>
                        </select>
                        <small><?php echo form_error('pangkat'); ?></small>
                      </div>
                    </div>
                    <input type="submit" value="Submit" class="btn btn-primary btn-md">
                  </form>
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
                    <option value="0">Departemen 1</option>
                    <option value="1">Departemen 2</option>
                    <option value="2">Departemen 3</option>
                    <option value="3">Departemen 4</option>
                  </select>
                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="text-input" class=" form-control-label">Nama Program Studi</label></div>
                <div class="col-12 col-md-9"><input type="text" id="text-input" name="text-input" class="form-control"></div>
              </div>
          </div>
          <div class="modal-footer">
            <input type="submit" value="Submit" class="btn btn-primary">
            </form>
          </div>
        </div>
      </div>
    </div> <!-- end modal tambah -->