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
                    <a href="<?php echo base_url('Keuangan/dokumen/').$suratDetail->dokumen; ?>"class="btn btn-warning" style="color:#fff"><i class="fa fa-paperclip"></i>&nbsp; Lihat Berkas</a>&nbsp;
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