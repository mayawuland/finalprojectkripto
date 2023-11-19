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
	<title>Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
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
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="write.php">Write</a>
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

<center style="padding-top: 50px;">
  <div>
    <h1 style="font-family: lucida handwriting;">Welcome,
    <?php
      include('koneksi.php');

      $pass  = $_SESSION['pass'];

      $query = mysqli_query($connect,"SELECT * FROM user WHERE password='$pass'");

      while ($data = mysqli_fetch_array($query)) {
        echo $data['nama'];
      }
    ?>
    !</h1>
  </div>
</center>
<center style="padding-top: 50px; text-align: center; color: white;">
  <br>
  <div class="row justify-content-around">
    <div class="col-5">
    <form action="write.php" method="POST">
      <div style="border: ridge; padding: 20px; border-color: black;">
      <h6 style="color: black;">How's your feeling today?</h6><br>
      <a><button style="background-color: black; color: white; border-radius: 10px;">write a diary</button></a>
      </div>
    </form>
    </div>
    <div class="col-5">
    <form action="read.php" method="POST">
      <div style="border: ridge; padding: 20px; border-color: black;">
      <h6 style="color: black;">Want to go back in time for a moment?</h6><br>
      <a><button style="background-color: black; color: white; border-radius: 10px;">read your diary</button></a>
      </div>
    </form>
    </div>
  </div>
</center>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>