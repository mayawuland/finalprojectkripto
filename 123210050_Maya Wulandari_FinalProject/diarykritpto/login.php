<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
</head>
<body style="background-image: url('background.png'); background-position: fixed; width: 100%; height: 100%; background-size: 100%;">
<center style="padding-top: 100px;"><h1 style="font-family: lucida handwriting;">My Diary</h1></center>
<center style="padding-top: 50px; text-align: center; color: white;">
	<br>
	<div class="container">
	  <div class="row">
	    <div>
	      <form action="login_proses.php" method="POST">
	      	  <div class="mb-3">
			    <label class="form-label text-light"></label>
			    <input type="text" id="nama" name="nama" autocomplete="off" class="form-control btn btn-outline-pink" style="width: 300px; background-color: white; color: black; border-color: black;" placeholder="Username" required>
			  </div>
			  <div class="mb-3">
			    <label class="form-label text-light"></label>
			    <input type="password" id="pass" name="pass" autocomplete="off" class="form-control btn btn-outline-pink" style="width: 300px; background-color: white; color: black; border-color: black;" placeholder="Password" required>
			    <input type="hidden" id="password" name="password">
			  </div>
			  <br><button type="submit" onclick="sha()" class="form-control btn btn-outline-light" style="width: 300px; background-color: rgba(0, 0, 0, 0.5);">Login</button>
		  </form>
		  <br><label style="color: black;">Doesn't have any account yet? <a href="daftar.php">Register</a></label>
	    </div>
	    <div>
			<?php
				if(isset($_GET['message'])) {
					if($_GET['message'] == "failed") {
						echo "
							<script>
								alert('Incorrect password!');
							</script>
						";
					}else if($_GET['message'] == "logout") {
						echo "
							<script>
								alert('Are you sure want to logout?');
							</script>
						";
					}else if($_GET['message'] == "belum login") {
						echo "
							<script>
								alert('You have to login first!');
							</script>
						";
					}
				}
			?>
		</div>
	  </div>
	</div>
</center>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<script type="text/javascript">

function sha256Hash(input) {
    return CryptoJS.SHA256(input).toString();
}

function sha(){
	const plaintext = document.getElementById('pass').value;
	const hashedText = sha256Hash(plaintext);

	document.getElementById('password').value = hashedText;
}

</script>

</body>
</html>