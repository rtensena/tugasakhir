<?php 
	include '../koneksi.php';
	$id_kamar		= $_GET['id_kamar'];

	$query = mysqli_query($connect, "DELETE FROM kamar where id_kamar=$id_kamar");

	if($query)
	{
		header("Location:kamar.php");
	}
	else{
        header("Location:kamar.php?message=gagal");
	}
?>