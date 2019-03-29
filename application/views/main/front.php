<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!doctype html>
	<head>
		<link rel="shortcut icon" href="<?php echo base_url('design/').'icon.png'; ?>" width="32px" height="32px">
		<title>Aplikasi Surat Tugas Sekolah Vokasi Universitas Diponegoro</title>
		<link rel="stylesheet" type="text/css" href="assets/css/style.css" />

		<link rel="stylesheet" href="<?php echo base_url('design/vendors/bootstrap/dist/css/bootstrap.min.css'); ?>">
    	<link rel="stylesheet" href="<?php echo base_url('design/vendors/font-awesome/css/font-awesome.min.css'); ?>">
    	<link rel="stylesheet" href="<?php echo base_url('/design/assets/css/style.css'); ?>">

    	<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    	<style type="text/css">
    		body {
    			background-color: #fff;
    		}
    	</style>
	</head>
	<body>

		<!--navbar-->
		<!-- <div class="navbar">
			<ul>
				<li><a href="index.html" class="navbaractive">Beranda</a></li>
				<li><a href="create.php">Isi Formulir</a></li>
				<ul style="float:right; list-style-type:none;">
					<li><a href="login.php">Login Admin</a></li>
				</ul>
			</ul>
		</div> -->
		<div class="img">
			<center>
				<img src="<?php echo base_url('images/skema.png'); ?>" width="70%" height="70%"/>
			</center>
			<center>
				<a href="<?php echo base_url('Main/login');?>" class="btn btn-secondary" style="color:#fff"><i class="fa fa-hand-o-right"></i>&nbsp; Lanjutkan</a>&nbsp;
			</center>
		</div>

		<script src="<?php echo base_url('design/vendors/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
	</body>
</html>