<?php
	include '../koneksi.php';

	$nama			= $_POST['nama'];
	$spesialis		= $_POST['spesialis'];
	$gender			= $_POST['gender'];
	$usia			= $_POST['usia'];
	$alamat			= $_POST['alamat'];

	$rand = rand();
	$ekstensi =  array('png','jpg','jpeg','gif');
	$filename = $_FILES['foto']['name'];
	$ukuran = $_FILES['foto']['size'];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);

	if(!in_array($ext,$ekstensi) ) {
		header("location:dokter.php?alert=gagal_ekstensi");
	}else{
		if($ukuran < 10440700){		
			$xx = $rand.'_'.$filename;
			move_uploaded_file($_FILES['foto']['tmp_name'], 'foto/'.$rand.'_'.$filename);
			mysqli_query($connect, "INSERT INTO dokter VALUES(NULL,'$nama', '$spesialis', '$gender', '$usia', '$alamat','$xx')");
			header("location:dokter.php?alert=berhasil");
		}else{
			header("location:dokter.php?alert=gagak_ukuran");
		}
	}



?>




