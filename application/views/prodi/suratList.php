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
      <div class="content mt-3">
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
                        <th>Program Studi</th>
                        <th>Tanggal Permohonan</th>
                        <th>Tanggal Kegiatan</th>
                        <th>Nama Kegiatan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach($suratList as $s) {
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
                        <td><a href="<?php echo base_url('Prodi/suratDetail/').$s->id_surat; ?>" class="btn btn-secondary btn-sm btn-block" style="color: #ffffff;"><i class="fa fa-external-link"></i>&nbsp; Detail<a/>&nbsp;</td>
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
            <h5 class="modal-title" id="tambah">Tambah Permohonan Surat</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?php echo base_url('Prodi/doAddSurat'); ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              <input type="hidden" value="<?php echo $userDetail->id_prodi; ?>" name="id_prodi">
              <div class="row form-group">
                <div class="col col-md-3"><label for="peserta1" class=" form-control-label">Peserta 1</label></div>
                <div class="col-12 col-md-9">
                  <select name="peserta1" id="peserta1" class="form-control" required oninvalid="this.setCustomValidity('Peserta 1 harus diisi')" oninput="this.setCustomValidity('')">
                    <option disabled selected value> -- Pilih Peserta 1 -- </option>
                    <?php
                      foreach ($dosenList as $d) {
                    ?>
                    <option value="<?php echo $d->id_dosen; ?>"><?php echo $d->nama_dosen; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                  <small><?php echo form_error('peserta1'); ?></small>
                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="peserta2" class=" form-control-label">Peserta 2</label></div>
                <div class="col-12 col-md-9">
                  <select name="peserta2" id="peserta2" class="form-control">
                    <option disabled selected value> -- Pilih Peserta 2 -- </option>
                    <?php
                      foreach ($dosenList as $d) {
                    ?>
                    <option value="<?php echo $d->id_dosen; ?>"><?php echo $d->nama_dosen; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="peserta3" class=" form-control-label">Peserta 3</label></div>
                <div class="col-12 col-md-9">
                  <select name="peserta3" id="peserta3" class="form-control">
                    <option disabled selected value> -- Pilih Peserta 3 -- </option>
                    <?php
                      foreach ($dosenList as $d) {
                    ?>
                    <option value="<?php echo $d->id_dosen; ?>"><?php echo $d->nama_dosen; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="peserta4" class=" form-control-label">Peserta 4</label></div>
                <div class="col-12 col-md-9">
                  <select name="peserta4" id="peserta4" class="form-control">
                    <option disabled selected value> -- Pilih Peserta 4 -- </option>
                    <?php
                      foreach ($dosenList as $d) {
                    ?>
                    <option value="<?php echo $d->id_dosen; ?>"><?php echo $d->nama_dosen; ?></option>
                    <?php
                      }
                    ?>
                  </select>
                </div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="nama_kegiatan" class=" form-control-label">Nama Kegiatan</label></div>
                <div class="col-12 col-md-9"><input type="text" id="nama_kegiatan" name="nama_kegiatan" class="form-control" value="<?php echo set_value('nama_kegiatan'); ?>" required oninvalid="this.setCustomValidity('Nama Kegiatan harus diisi')" oninput="this.setCustomValidity('')"><small class="form-text text-muted">Contoh: Seminar Nasional; Workhsop; Kerjasama; Penulisan Artikel Ilmiah; Pengabdian Masyarakat; Penelitian; dll</small><small><?php echo form_error('nama_kegiatan'); ?></small></div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="judul_kegiatan" class=" form-control-label">Judul Kegiatan</label></div>
                <div class="col-12 col-md-9"><input type="text" id="judul_kegiatan" name="judul_kegiatan" class="form-control" value="<?php echo set_value('judul_kegiatan'); ?>" required oninvalid="this.setCustomValidity('Judul Kegiatan harus diisi')" oninput="this.setCustomValidity('')"><small class="form-text text-muted">Contoh: Tema atau topik seminar/workshop/kerjasama; Judul Artikel seminar</small><small><?php echo form_error('judul_kegiatan'); ?></small></div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="tempat_kegiatan" class=" form-control-label">Institusi / Tempat</label></div>
                <div class="col-12 col-md-9"><input type="text" id="tempat_kegiatan" name="tempat_kegiatan" class="form-control" value="<?php echo set_value('tempat_kegiatan'); ?>" required oninvalid="this.setCustomValidity('Institusi / Tempat harus diisi')" oninput="this.setCustomValidity('')"><small><?php echo form_error('tempat_kegiatan'); ?></small></div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="tgl_berangkat" class=" form-control-label">Tanggal Mulai Menjalankan Tugas</label></div>
                <div class="col-12 col-md-9"><input type="text" id="datepicker1" name="tgl_berangkat" autocomplete="off" class="form-control" value="<?php echo set_value('tgl_berangkat'); ?>" required><small><?php echo form_error('tgl_berangkat'); ?></small></div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="tgl_kembali" class=" form-control-label">Tanggal Selesai Menjalankan Tugas</label></div>
                <div class="col-12 col-md-9"><input type="text" id="datepicker2" name="tgl_kembali" autocomplete="off" class="form-control" value="<?php echo set_value('tgl_kembali'); ?>" required><small><?php echo form_error('tgl_kembali'); ?></small></div>
              </div>
              <div class="row form-group">
                <div class="col col-md-3"><label for="dokumen" class=" form-control-label">Upload Undangan / Dokumen Pendukung</label></div>
                <div class="col-12 col-md-9"><input type="file" id="dokumen" name="dokumen" class="form-control-file" required oninvalid="this.setCustomValidity('Dokumen Pendukung harus diisi')" oninput="this.setCustomValidity('')"><small class="form-text text-muted">*.pdf</small></div>
              </div>
          </div>
          <div class="modal-footer">
            <input type="submit" value="Submit" class="btn btn-primary">
            </form>
          </div>
        </div>
      </div>
    </div> <!-- end modal tambah -->