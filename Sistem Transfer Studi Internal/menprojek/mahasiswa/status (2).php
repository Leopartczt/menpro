<?php
require_once 'config/koneksi.php';
session_start();

if($_SESSION['email']=="")
{
	header("location:login/accdenied.php");
}
if($_SESSION['level']!="mahasiswa")
{
	header("location:login/accdenied.php");
}

$link = mysqli_connect("localhost","root","","transfer_mhs_intern");
$email = $_SESSION['email'];

$sql2 = "SELECT * FROM user WHERE email = '".$email."'";
$result2 = $link->query($sql2);
$row = $result2->fetch_array();
$nama = $row['nama'];

$sql3 = "SELECT * FROM user WHERE email = '".$email."'";
$result3 = $link->query($sql3);
$row = $result3->fetch_array();
$id = $row['id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">

	<title>Status</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<style type="text/css">
		/* The sidebar menu */
		.sidenav {
			height: 100%; /* Full-height: remove this if you want "auto" height */
			width: 200px; /* Set the width of the sidebar */
			position: fixed; /* Fixed Sidebar (stay in place on scroll) */
			z-index: 1; /* Stay on top */
			top: 0; /* Stay at the top */
			left: 0;
			background-color: #490251; /* Purple */
			overflow-x: hidden; /* Disable horizontal scroll */
			padding-top: 1px;
		}

		/* The navigation menu links */
		.sidenav a {
			padding: 20px 1px 10px 18px;
			text-decoration: Comic Sans;
			font-size: 25px;
			color: #f1f1f1;
			display: block;
		}

		/* When you mouse over the navigation links, change their color */
		.sidenav a:hover {
			color: #818181;
		}

		/* Style page content */
		.main {
			margin-left: 200px; /* Same as the width of the sidebar */
			padding: 0px 10px;
		}

		/* On smaller screens, where height is less than 450px, change the style of the sidebar (less padding and a smaller font size) */
		@media screen and (max-height: 450px) {
			.sidenav {padding-top: 15px;}
			.sidenav a {font-size: 18px;}
		}
	</style>
</head>

<body>
	<!-- Side navigation -->
	<div class="sidenav"> <p face="OCR A Std">
		<a class="sidenav-brand"> <img src="logo.png" width="150px" height="80px"> </a>
		<a href="#" id="home" class="	glyphicon glyphicon-home"> Home</a>
		<a href="#" id="form" class="glyphicon glyphicon-edit"> Form</a>
		<a href="Status.html" id="status" class="	glyphicon glyphicon-bell"> Status</a>
		<a href="BAA.html" id="page" class="glyphicon glyphicon-envelope"> BAA</a>
		<a href="Kaprodi.html" id="page" class="glyphicon glyphicon-envelope"> Kaprodi</a>
		<a href="../login/logout.php" id="logout" class="	glyphicon glyphicon-log-out"> Logout</a>
	</p>
</div>

<!-- page-content-wrapper -->
<div class="wrapper">
	<div class="container-fluid"> 
		<div id="content" class="col-md-9 col-md-offset-2 col-xs-1">
			<div class="row"> 
				<div class="col-md-12"> 
					<div class="page-header clearfix"> 
						<h1 class="pull-left">Status</h1> 
					</div>
					<table class='table table-bordered table-striped'>
						<thead>
							<tr> 
								<th class = "col-xs-6"> Proses</th>
								<th class = "col-xs-1">&emsp;&emsp; Keterangan</th>
							</tr>
						</thead>

						<tbody>
							<tr>
								<td>
									Isi formulir permohonan
								</td>
								<td align = "center">
									<?php 
									$link = mysqli_connect("localhost","root","","transfer_mhs_intern");
									$sql = "SELECT * FROM data_mhs WHERE user_id = '".$id."'";
									$result = $link->query($sql);
									$row = $result->fetch_array();
									$isi_form = $row['isi_form'];
									if ($isi_form == 0) {
										echo "<a href='data_diri.php' title='Isi Data Diri' datatoggle='tooltip'><span class='btn btn-success'>Isi Data Diri</span></a>";
									} elseif ($isi_form == 1) {
										echo '<id="status" class="fa fa-check-square fa fa-clock-o"> Sudah Mengisi';
									} else{
										echo "<a href='edit_datadiri.php?user_id=". $id ."' title='Edit Data Diri' datatoggle='tooltip'><span class='btn btn-success'>Edit Data Diri</span></a>";
									}
									?>
								</td>
							</tr>

							<tr>
								<td>
									Cek berkas dan formulir
								</td>
								<td align = "center">
									<?php 
									$link = mysqli_connect("localhost","root","","transfer_mhs_intern");
									$sql = "SELECT * FROM data_mhs WHERE user_id = '".$id."'";
									$result = $link->query($sql);
									$row = $result->fetch_array();
									$cek_form = $row['cek_form'];
									if ($cek_form == 0) {
										echo '<id="status" class="fa fa-hourglass-half"> Menunggu</id="status">';
									} elseif ($cek_form == 1) {
										echo '<id="status" class="fa fa-clock-o"> Dalam Proses</id="status">';
									} else{
										echo '<id="status" class="fa fa-check-square fa fa-clock-o"> Success';
									}
									?>
									
								</td>
							</tr>

							<tr>
								<td>
									Keputusan BAA
								</td>
								<td align = "center">
									<?php 
									$link = mysqli_connect("localhost","root","","transfer_mhs_intern");
									$sql = "SELECT * FROM data_mhs WHERE user_id = '".$id."'";
									$result = $link->query($sql);
									$row = $result->fetch_array();
									$kep_baa = $row['kep_baa'];
									if ($kep_baa == 0) {
										echo '<id="status" class="fa fa-hourglass-half"> Menunggu</id="status">';
									} elseif ($kep_baa == 1) {
										echo '<id="status" class="fa fa-check-square fa fa-clock-o"> Diterima';
									} else{
										echo '<id="status" class="fa fa-times"> Ditolak';
									}
									?>
								</td>
							</tr>

							<tr>
								<td>
									Biaya studi
								</td>
								<td align = "center">
									<?php 
									$link = mysqli_connect("localhost","root","","transfer_mhs_intern");
									$sql = "SELECT * FROM data_mhs WHERE user_id = '".$id."'";
									$result = $link->query($sql);
									$row = $result->fetch_array();
									$biaya_studi = $row['biaya_studi'];
									if ($biaya_studi == 0) {
										echo '<id="status" class="fa fa-hourglass-half"> Menunggu</id="status">';
									} else ($biaya_studi == 1) {
										echo "<a href='biaya_studi.php?id=". $row['id'] ."' title='Cek Biaya Studi' datatoggle='tooltip'><span class='btn btn-primary'> Cek Biaya Studi</span></a>";
									}
									?>
								</td>
							</tr>

							<tr>
								<td>
									Pembayaran
								</td>
								<td align = "center">
									<?php 
									$link = mysqli_connect("localhost","root","","transfer_mhs_intern");
									$sql = "SELECT * FROM data_mhs WHERE user_id = '".$id."'";
									$result = $link->query($sql);
									$row = $Bukti Bayarresult->fetch_array();
									$bayar = $row['bayar'];
									if ($bayar == 0) {
										echo '<id="status" class="fa fa-hourglass-half"> Menunggu</id="status">';
									} else ($bayar == 1) {
										echo "<a href='upload_bukti_bayar.php?id=". $row['id'] ."' title='Upload Bukti Bayar' datatoggle='tooltip'><span class='btn btn-primary'> Upload Bukti Bayar</span></a>";
									}
									?>
								</td>
							</tr>

							<tr>
								<td>
									Pengiriman NIM Baru
								</td>
								<td align = "center">
									<?php 
									$link = mysqli_connect("localhost","root","","transfer_mhs_intern");
									$sql = "SELECT * FROM data_mhs WHERE user_id = '".$id."'";
									$result = $link->query($sql);
									$row = $result->fetch_array();
									$nim_baru = $row['nim_baru'];
									if ($nim_baru == 0) {
										echo '<id="status" class="fa fa-hourglass-half"> Menunggu</id="status">';
									} else ($nim_baru == 1) {
										echo "<a href='nim_baru.php?id=". $row['id'] ."' title='NIM Baru' datatoggle='tooltip'><span class='btn btn-primary'> NIM Baru</span></a>";
									}
									?>
								</td>
							</tr>

							<tr>
								<td>
									Selesai
								</td>
								<td align = "center">
									<?php 
									$link = mysqli_connect("localhost","root","","transfer_mhs_intern");
									$sql = "SELECT * FROM data_mhs WHERE user_id = '".$id."'";
									$result = $link->query($sql);
									$row = $result->fetch_array();
									$selesai = $row['selesai'];
									if ($selesai == 0) {
										echo '<id="status" class="fa fa-hourglass-half"> Menunggu</id="status">';
									} else ($selesai == 1) {
										echo '<id="status" class="fa fa-check-square fa fa-clock-o"> Selamat';
									}
									?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div> 
	</div>
</div>
</div>
</div>
</div>
</body>
</html>
