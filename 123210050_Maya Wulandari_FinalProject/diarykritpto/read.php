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
	<title>List</title>
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
          <a class="nav-link" aria-current="page" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="write.php">Write</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="#">Read</a>
        </li>
      </ul>
      <span class="navbar-text">
        <a href="login.php?message=logout">Logout</a>
      </span>
    </div>
  </div>
</nav>

<center style="padding-top: 100px; color: white;">
	<div>
      <h4 style="background-color: rgba(0, 0, 0, 0.5); color: white; width: 300px; padding: 10px; border-radius: 10px;"><b>Your Diary</b></h4>
      <br>
      <table class="table" style="width: 700px; background-color: rgba(0, 0, 0, 0.5); border-radius: 10px;">
        <thead>
          <tr style="color: white; text-align: center;">
            <th scope="col">Id</th>
            <th scope="col">Date</th>
            <th scope="col">Tittle</th>
          </tr>
        </thead>
        <tbody>
          <?php 
            include('koneksi.php');

            $password = $_SESSION['pass'];
            $query = mysqli_query($connect,"SELECT * FROM user WHERE password='$password'");

            $data = mysqli_fetch_array($query);

            $id_user = $data['id_user'];

            $query = mysqli_query($connect,"SELECT id AS id, tanggal AS tanggal, judul AS judul FROM dtdiary WHERE id_user='$id_user'");

            while ($data = mysqli_fetch_array($query)) {
          ?>
          <tr style="text-align: center; color: white;">
            <td scope="row"><?= $data['id'] ?></td>
            <td><?= $data['tanggal'] ?></td>
            <td><?= $data['judul'] ?></td>
            <td><a href="read_data.php?idp=<?= $data['id'] ?>"><button style="border-radius: 10px; background-color: rgba(0, 0, 0, 0.5); width: 100px; padding: 3px; border-color: white; color: white;">Read</button></a>
            <td><a href="hapus_data.php?idp=<?= $data['id'] ?>"><button style="border-radius: 10px; background-color: red; width: 100px; padding: 3px; border-color: white; color: white;">Delete</button></a></td>
          </tr>
        <?php } ?>
        </tbody>
      </table>
    </div>
</center>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</body>
</html>