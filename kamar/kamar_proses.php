<?php
	include '../koneksi.php';

	$kamar		= $_POST['kamar'];
	$fasilitas		= $_POST['fasilitas'];


	$sql	= "INSERT INTO kamar VALUES(NULL, '$kamar', '$fasilitas')";

	$query	= mysqli_query($connect, $sql) or die(mysqli_error($connect));

	if($query) {
		header("Location:kamar.php");
	} else {
		echo "Input Data Gagal.";
	}
	
?>