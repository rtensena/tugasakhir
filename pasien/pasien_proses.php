<?php
	include '../koneksi.php';

	$nama			= $_POST['nama'];
	$kelamin		= $_POST['kelamin'];
	$umur			= $_POST['umur'];
	$tipe			= $_POST['tipe'];
	$kontak			= $_POST['kontak'];
	$id_kamar		= $_POST['kamar'];
	$id_dokter		= $_POST['id_dokter'];
	$tanggal		= $_POST['tanggal'];


	$sql	= "INSERT INTO pasien VALUES (NULL, '$nama', '$kelamin', '$umur', '$tipe', '$kontak', '$id_kamar', '$id_dokter', '$tanggal')";
echo $sql;
	$query	= mysqli_query($connect, $sql) or die(mysqli_error($connect));

	if($query) {
		header("Location:pasien.php");
	} else {
		header("location:pasien.php?alert=gagal");
	}

?>




