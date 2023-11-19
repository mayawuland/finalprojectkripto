<?php

include 'koneksi.php';

$idp 	= $_GET['idp'];

$sql 	= "DELETE FROM dtdiary WHERE id='$idp'";
$query	= mysqli_query($connect, $sql);

if($query) {
	echo "
				<script>
					alert('Terhapus');
					location.replace('read.php');
				</script>
			";
} else {
	echo "Hapus Data Gagal.";
}

?>