<?php
	include 'koneksi.php';

	$nama = $_POST['nama'];
	$password = $_POST['password'];


	$sql	= "INSERT INTO user VALUES('', '$nama', '$password')";

	$query	= mysqli_query($connect, $sql) or die(mysqli_error($connect));

	if($query) {
		echo "
				<script>
					alert('Registration Successful!');
					location.replace('login.php');
				</script>
			";
	} else {
		echo "
				<script>
					alert('Resistration Failed!');
					location.replace('daftar.php');
				</script>
			";
	}
?>