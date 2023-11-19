<?php
	include 'koneksi.php';

	session_start();

	$password = $_SESSION['pass'];
	$query = mysqli_query($connect,"SELECT * FROM user WHERE password='$password'");

    $data = mysqli_fetch_array($query);

    $id_user = $data['id_user'];

	$title = $_POST['title'];
	$date = $_POST['date'];
	$catatan = $_POST['diary'];
	$gambar = $_POST['gambar'];

	$filecontent = file_get_contents($gambar);
	$base64 = rtrim(base64_encode($filecontent));

	$sql	= "INSERT INTO dtdiary VALUES('', '$date', '$title', '$catatan', '$base64', '$id_user')";

	$query	= mysqli_query($connect, $sql) or die(mysqli_error($connect));

	if($query) {
		echo "
				<script>
					alert('Input Successful');
					location.replace('write.php');
				</script>
			";
	} else {
		echo "Input Data Gagal.";
	}
?>