<?php
	include '../koneksi.php';
    
	$nama			= $_POST['nama'];
	$spesialis		= $_POST['spesialis'];
	$gender			= $_POST['gender'];
	$usia			= $_POST['usia'];
	$alamat			= $_POST['alamat'];
	$id_dokter		= $_GET['id_dokter'];

	$sql	= "UPDATE dokter SET namadok = '$nama', spesialis = '$spesialis', gender = '$gender', usia = '$usia', alamat = '$alamat' WHERE id_dokter = '$id_dokter';";

	$query	= mysqli_query($connect, $sql) or die(mysqli_error($connect));

	if($query) {
		header("Location:dokter.php?alert=berhasil");
	} else {
		header("location:dokter.php?alert=gagak_ukuran");
	}

	
?>