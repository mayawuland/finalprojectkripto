<?php

session_start();

if(empty($_SESSION['pass'])) {
  header("location: login.php?message=belum_login");
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Read</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
</head>
<body style="background-image: url('background.png'); background-position: fixed; width: 100%; height: 100%; background-size: 100%;">

<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" style="font-family: lucida handwriting;" href="#">My Diary</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarText">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="write.php">Write</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="read.php">Read</a>
        </li>
      </ul>
      <span class="navbar-text">
        <a href="login.php?message=logout">Logout</a>
      </span>
    </div>
  </div>
</nav>

<center style="padding-top: 70px; color: white;">
  <div class="row justify-content-center">
  	<?php 
      include('koneksi.php');

      $idp 	= $_GET['idp'];

      $query = mysqli_query($connect,"SELECT * FROM dtdiary WHERE id='$idp'");

      while ($data = mysqli_fetch_array($query)) {
    ?>
    <div class="col-2" style="padding-top: 30px;">
    	<div style="text-align: left;">
        <label style="color: black;">Title</label>
       <input type="text" name="title" id="title"  autocomplete="off" class="form-control bg-light" style="border-color: black; width: 215px; color: black;" value="<?= $data['judul']; ?>" readonly>
    	</div>
    	<br>
    	<div style="text-align: left;">
        <label style="color: black;">Date</label>
       <input type="text" name="date" autocomplete="off" class="form-control bg-light" style="border-color: black; width: 215px; color: black;" value="<?= $data['tanggal']; ?>" readonly>
    	</div>
    	<br>
        <div style="text-align: left;">
        <label style="color: black;">Photo</label>
        <?php
        //echo $gambar = $data['gambar'];
        $base64 = $data['gambar'];
        echo '<img src="data:image/gif;base64,'.$base64.' " width="215" height="160" border="3" />';
        ?>
        </div>
    </div>
    <div class="col-3">
      <div class="container">
			  <div class="row">
			    <div>
					  <div class="mb-3" style="text-align: left; padding-top: 27px;">
					    <label style="color: black;">Your Writing</label>
					    <textarea id="catatan" name="catatan" autocomplete="off" class="form-control btn btn-outline-pink" style="width: 500px; text-align: left; height: 345px; background-color: white; color: black; border-color: black;" readonly value="<?= $data['catatan']; ?>"><?= $data['catatan']; ?></textarea>
					  </div>
			    </div>
			  </div>
			</div>
    </div>
    <?php } ?>
  </div>
</center>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script>
	function Vigenerecipher(ciphertext, key) {
	  function decryptChar(char, keyChar) {
                if (char.match(/[a-z]/i)) {
                    // Jika karakter adalah huruf alfabet
                    var shift = keyChar.toUpperCase().charCodeAt(0) - 'A'.charCodeAt(0);
                    var base = char.toUpperCase() === char ? 'A'.charCodeAt(0) : 'a'.charCodeAt(0);
                    return String.fromCharCode((char.charCodeAt(0) - base - shift + 26) % 26 + base);
                } else {
                    // Jika karakter bukan huruf alfabet, pertahankan karakter tersebut
                    return char;
                }
            }

            // Inisialisasi variabel
            var result = '';
            var keyIndex = 0;

            // Loop melalui setiap karakter dalam ciphertext
            for (var i = 0; i < ciphertext.length; i++) {
                var char = ciphertext[i];
                var keyChar = key[keyIndex % key.length];

                // Tambahkan karakter terdekripsi ke hasil
                result += decryptChar(char, keyChar);

                // Jika karakter dalam ciphertext adalah huruf alfabet, update indeks kunci
                if (char.match(/[a-z]/i)) {
                    keyIndex++;
                }
            }

            return result;
  }

  function decryptAES(ciphertext, key, iv) {
  	const decrypted = CryptoJS.AES.decrypt(ciphertext, key, { iv: iv });
  	return decrypted.toString(CryptoJS.enc.Utf8);
	}

    const cipherteks = document.getElementById('catatan').value;
	const key = "maya";

	const initializationVector = CryptoJS.lib.WordArray.random(128 / 8);
	const encryptedText = decryptAES(cipherteks, key, initializationVector);
	const encryptedTexts = Vigenerecipher(encryptedText, key);

	document.getElementById('catatan').value = encryptedTexts;
</script>

</body>
</html>