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
	<title>Write</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://momentjs.com/downloads/moment.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script>
	$( function() {
	  $( "#datepicker" ).datepicker({                  
	      minDate: moment().add('d', 0).toDate(),
	      dateFormat: 'dd-mm-yy'
	  });
	} );
	</script>
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
          <a class="nav-link active" href="#">Write</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="read.php">Read</a>
        </li>
      </ul>
      <span class="navbar-text">
        <a href="login.php?message=logout">Logout</a>
      </span>
    </div>
  </div>
</nav>

<center style="padding-top: 80px; color: white;">
<form action="write_proses.php" method="POST">
  <div class="row justify-content-center">
    <div class="col-2" style="padding-top: 30px;">
    	<div>
       <input type="text" name="title" id="title" autocomplete="off" class="form-control bg-light" style="border-color: black; width: 215px; color: black;" placeholder="Input Title" required>
    	</div>
    	<br>
    	<div>
       <input type="text" name="date" id="datepicker" autocomplete="off" class="form-control bg-light" style="border-color: black; width: 215px; color: black;" placeholder="Input Date" required>
    	</div>
    	<br>
    	<div>
    	<label style="color: black;">Input image (max 2mb)</label>
       <input class="form-control" type="file" accept=".jpg, .jpeg, .png" name="gambar" id="gambar"class="form-control bg-light" style="border-color: black; width: 215px; color: black;" placeholder="" required>
    	</div>
    </div>
    <div class="col-3">
      <div class="container">
			  <div class="row">
			    <div>
					  <div class="mb-3">
					    <label class="form-label text-light"></label>
					    <textarea id="catatan" name="catatan" autocomplete="off" class="form-control btn btn-outline-pink" style="width: 400px; text-align: left; height: 300px; background-color: white; color: black; border-color: black;" placeholder="Write here" required></textarea>
					    <input type="hidden" id="diary" name="diary">
					  </div>
					  <br><button type="submit" onclick="superencrypt()" class="form-control btn btn-outline-light" style="border-color: white; width: 400px; background-color: rgba(0, 0, 0, 0.5);">Save</button>
			    </div>
			  </div>
			</div>
    </div>
  </div>
</form>	
</center>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script>
	function Vigenerecipher(plainText, key) {
  // Fungsi untuk mengenkripsi karakter
	  function encryptChar(char, keyChar) {
	    if (char.match(/[a-z]/i)) {
	      // Jika karakter adalah huruf alfabet
	      var shift = keyChar.toUpperCase().charCodeAt(0) - 'A'.charCodeAt(0);
	      var base = char.toUpperCase() === char ? 'A'.charCodeAt(0) : 'a'.charCodeAt(0);
	      return String.fromCharCode((char.charCodeAt(0) - base + shift) % 26 + base);
	    } else {
	      // Jika karakter bukan huruf alfabet, pertahankan karakter tersebut
	      return char;
	    }
	  }

    // Inisialisasi variabel
    var result = '';
    var keyIndex = 0;

    // Loop melalui setiap karakter dalam plainteks
    for (var i = 0; i < plainText.length; i++) {
      var char = plainText[i];
      var keyChar = key[keyIndex % key.length];

      // Tambahkan karakter terenkripsi ke hasil
      result += encryptChar(char, keyChar);

      // Jika karakter dalam plainteks adalah huruf alfabet, update indeks kunci
      if (char.match(/[a-z]/i)) {
      keyIndex++;
      }
    }

    return result;
  }

  function encryptAES(text, key, iv) {
  	const encrypted = CryptoJS.AES.encrypt(text, key, { iv: iv });
  	return encrypted.toString();
	}


	function superencrypt() {
	  const plaintext = document.getElementById('catatan').value;
	  const key = "maya";
	  const encryptedText = Vigenerecipher(plaintext, key);

	  const initializationVector = CryptoJS.lib.WordArray.random(128 / 8);
	  const encryptedTexts = encryptAES(encryptedText, key, initializationVector);

	  document.getElementById('diary').value = encryptedTexts;

		}
</script>

</body>
</html>