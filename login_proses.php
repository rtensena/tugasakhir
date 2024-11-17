<?php 
	session_start();
	include 'koneksi.php';

	$username = $_POST['username'];
	$password = $_POST['password'];

	$sql = "SELECT * from user where username='$username' and password='$password'";
	$data = mysqli_query($connect,$sql);

	$cek = mysqli_num_rows($data); //check data

	if($cek>0){
		$_SESSION['username'] = $username;
		$_SESSION['status'] = "login";
		header("Location:index.php");
	} else{
		header("Location:login.php?message=failed");
	}

 ?>