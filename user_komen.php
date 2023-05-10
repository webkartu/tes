<?php
session_start();
require "koneksi.php";
if (!isset($_SESSION["username"])){
  header("Location: login.php");
  exit();
}
$tanggal = date("d-m-Y");
$yang_login = $_SESSION["username"];
if(isset($_POST['submit-komen'])) {
  $isiKomen = $_POST["input_text"];
  $query = "INSERT INTO pesan VALUES (NULL,'$yang_login','$isiKomen','$tanggal');";
  $result = mysqli_query($conn,$query);
  if($result) {
    echo "<script>alert('Komentar berhasil dikirim.')</script>";
  } else {
    echo "<script>alert('Gagal mengirim komentar.')</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<style type="text/css">
		.komentar {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 500px;
     
		}
   
	</style>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Komentar</title>
</head>
<body id="halaman_login">
	<header id="header_login">
		<nav>
			<ul>
				<li><a class="animate__animated animate__fadeInUp" href="gacha.php">Kembali</a></li>
				<li><a class="animate__animated animate__fadeInUp" href="user_komen.php" id="login_button">Komentar</a></li>
				<li><a class="animate__animated animate__fadeInUp" href="gacha.php">Kembali</a></li>
			</ul>
		</nav>
	</header>
	<div class="komentar">
		<form method="post">
			<textarea name="input_text" style="width: 400px; height: 200px;"></textarea>
			<br><br>
			<input type="submit" name="submit-komen" value="Kirim">
		</form>
	</div>
</body>
</html>
