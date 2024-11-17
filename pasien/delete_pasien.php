<?php 
	include '../koneksi.php';
	$id_pasien		= $_GET['id_pasien'];

	$query = mysqli_query($connect, "DELETE FROM pasien where id_pasien=$id_pasien ");

	if($query)
	{
		header("Location:pasien.php");
	}
	else{
		header("Location:pasien.php?message=gagal");
	}
?>