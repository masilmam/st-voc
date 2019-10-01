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
        <div class="animated fadeIn">
          <div class="row">
            <div class="col-md-12">
              <h3><?=$judul; ?></h3><br />
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
                        <td><a href="<?php echo base_url('Dekan/suratDetail/').$s->id_surat; ?>" class="btn btn-secondary btn-sm btn-block" style="color: #ffffff;"><i class="fa fa-external-link"></i>&nbsp; Detail<a/></td>
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