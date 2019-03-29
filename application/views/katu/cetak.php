<!--TAMPILAN AKHIR SURAT TUGAS & PERINTAH CETAK-->
<!--JANGAN DIRUBAH-->
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

	$noSurat = str_pad($suratDetail->no_surat, 3, '0', STR_PAD_LEFT);
	$bulanSurat = romawi(date("m",strtotime($suratDetail->tgl_surat)));
	$tahunSurat = substr($suratDetail->tgl_surat, 0, 4);

	//bypass Program studi
	if ($suratDetail->nama_prodi == 'Sekolah Vokasi') {
		$prodi_head = 'Fakultas';
	} else {
		$prodi_head = 'Program Studi';
	}
?>

<!doctype html>
	<head>
		<link rel="shortcut icon" href="<?php echo base_url('design/').'icon.png'; ?>" width="32px" height="32px">
		<title>Surat Tugas Sekolah Vokasi Universitas Diponegoro</title>
		<style>
			table[class="preview"], th, td {
			  border: 1px solid black;
			}

			table {
			  border-collapse: collapse;
			  width: 100%;
			}

			table[class="kegiatan"], table[class="kegiatan"] th, table[class="kegiatan"] td {
				border-collapse: collapse;
				border: none;
				border-outline: none;
			}

			tr > td {
				padding: 2px;
			}			}
		</style>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script type="text/javascript">
			$(document).ready(function () {
			    window.print();
			});
		</script>
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('design_surat/').'style.css'; ?>" />
	</head>
	<body>
		<div id="wrapper">
			<img class="logo" src="<?php echo base_url('images/').'logo.png'; ?>" width="90px" height="110px" />
			<div class="kopsurat"><br />KEMENTERIAN RISET, TEKNOLOGI, DAN PENDIDIKAN TINGGI<br />UNIVERSITAS DIPONEGORO</div>
			<div class="fakultas"><b>SEKOLAH VOKASI</b></div>
			<div class="alamatkop">Jl. Prof. H. Soedarto, S.H Tembalang Semarang, Kode Pos 50275 Telp. (+6224) 7460053, 7460055<br />Email : vokasi@undip.ac.id</div>
			<br />
			<hr style="border: 1px solid black;" width="100%" />
			<div class="surattugas">
				<br /><br /><b>SURAT TUGAS
				<pre>No : <?php echo $noSurat.'/'.$suratDetail->kode_surat.$bulanSurat.'/'.$tahunSurat; ?></pre></b>
			</div
			<div class="content">
				<br />Dekan Sekolah Vokasi Universitas Diponegoro dengan ini menugaskan kepada
				<br /><br />
				<table class="preview" border="1" style="border-style: solid;" width="100%">
					<thead>
						<tr>
							<th align="center">Nama</th>
							<th align="center">NIP</th>
							<th align="center"><?php echo $prodi_head; ?></th>
							<th align="center">Pangkat</th>
							<th align="center">Jabatan</th>
						</tr>	
					</thead>
					<tbody>
						<tr>
							<td><?php echo $suratDetail->peserta1; ?></td>
							<td><?php echo $suratDetail->nip1; ?></td>
							<td><?php echo $suratDetail->nama_prodi; ?></td>
							<td><?php echo $suratDetail->pangkat1; ?></td>
							<td><?php echo $suratDetail->jabatan1; ?></td>
						</tr>
						<?php 
							if(!empty($suratDetail->peserta2)) { 
						?>
						<tr>
							<td><?php echo $suratDetail->peserta2; ?></td>
							<td><?php echo $suratDetail->nip2; ?></td>
							<td><?php echo $suratDetail->nama_prodi; ?></td>
							<td><?php echo $suratDetail->pangkat2; ?></td>
							<td><?php echo $suratDetail->jabatan2; ?></td>
						</tr>
						<?php } ?>
						<?php 
							if(!empty($suratDetail->peserta3)) { 
						?>
						<tr>
							<td><?php echo $suratDetail->peserta3; ?></td>
							<td><?php echo $suratDetail->nip3; ?></td>
							<td><?php echo $suratDetail->nama_prodi; ?></td>
							<td><?php echo $suratDetail->pangkat3; ?></td>
							<td><?php echo $suratDetail->jabatan3; ?></td>
						</tr>
						<?php } ?>
						<?php 
							if(!empty($suratDetail->peserta4)) { 
						?>
						<tr>
							<td><?php echo $suratDetail->peserta4; ?></td>
							<td><?php echo $suratDetail->nip4; ?></td>
							<td><?php echo $suratDetail->nama_prodi; ?></td>
							<td><?php echo $suratDetail->pangkat4; ?></td>
							<td><?php echo $suratDetail->jabatan4; ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<br />Untuk melaksanakan kegiatan sebagai berikut
				<br /></br />
				<table class="kegiatan" border="1" width="100%">
					<tbody>
						<tr>
							<td width="25%">Nama Kegiatan</td>
							<td width="5%" align="center">:</td>
							<td width="75%"><?php echo $suratDetail->nama_kegiatan; ?></td>
						</tr>
						<tr>
							<td>Judul</td>
							<td align="center">:</td>
							<td><?php echo $suratDetail->judul_kegiatan; ?></td>
						</tr>
						<tr>
							<td>Institusi / Tempat</td>
							<td align="center">:</td>
							<td><?php echo $suratDetail->tempat_kegiatan; ?></td>
						</tr>
						<tr>
							<td>Tanggal</td>
							<td align="center">:</td>
							<td><?php echo tanggal($suratDetail->tgl_berangkat).' - '.tanggal($suratDetail->tgl_kembali); ?></td>
						</tr>
					</tbody>
				</table>
				<br />Demikian Surat Tugas ini dibuat untuk dapat dilaksanakan dengan sebaik-baiknya dan yang bersangkutan wajib memberikan laporan kepada Dekan setelah selesai melaksanakan tugas.
				<div class="ttd">
					<br /><br />Semarang, <?php echo tanggal($suratDetail->tgl_surat); ?><br />
					Dekan Sekolah Vokasi
					<br /><br /><br /><br /><br /><br />
					<b>Prof. Dr. Ir. Budiyono, MSi<br />
					NIP. 19660220 199102 1001</b>
				</div>
		</div>
	</body>
</html>