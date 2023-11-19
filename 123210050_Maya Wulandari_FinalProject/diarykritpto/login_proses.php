<?php
	session_start();

	include 'koneksi.php';

	$nama 	= $_POST['nama'];
	$pass 	= $_POST['password'];

	$sql		= "SELECT * FROM user WHERE nama = '$nama' AND password='$pass'";
	$query		= mysqli_query($connect, $sql);

	$cek 		= mysqli_num_rows($query);


	if($cek>0) {
		$_SESSION['pass'] 	= $pass;
		$_SESSION['status']	= "login";
		header("location: home.php");
	} else {
		header("location: login.php?message=failed");
	}
?>