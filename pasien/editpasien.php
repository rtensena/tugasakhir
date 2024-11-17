<?php
	include '../koneksi.php';
    
	$nama			= $_POST['nama'];
	$kelamin		= $_POST['kelamin'];
	$umur			= $_POST['umur'];
	$tipe			= $_POST['tipe'];
	$kontak			= $_POST['kontak'];
	$id_kamar		= $_POST['id_kamar'];
	$id_dokter		= $_POST['id_dokter'];
	$id_pasien		= $_GET['id_pasien'];
	

	$sql	= "UPDATE pasien SET nama = '$nama', kelamin = '$kelamin', umur = '$umur',
	 tipe = '$tipe', kontak = '$kontak', id_kamar = '$id_kamar', id_dokter = '$id_dokter'
	  WHERE pasien.id_pasien = '$id_pasien';";

	$query	= mysqli_query($connect, $sql) or die(mysqli_error($connect));

	if($query) {
		header("Location:pasien.php?alert=berhasil");
	} else {
		header("location:pasien.php?alert=gagal");
	}

	
?>