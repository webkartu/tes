<?php
require "koneksi.php";
session_start();

if ($_SESSION["username"]=="login_dulu"){
  header("Location: login.php");
}
if ($_SESSION["username"]!="admin"){
  header("Location: login.php");
}

// $sql = "INSERT INTO tabel_kartu ";

// $result = mysqli_query($conn,$sql);
if(isset($_GET['confirm-buat'])) {
    $namaKartu = $_GET['nama-kartu'];
    $ovrkartu = $_GET['ovr-kartu'];
    $linkKartu = $_GET['link-kartu'];
    
    $query = "INSERT INTO tabel_kartu VALUES ('','$namaKartu',$ovrkartu,'$linkKartu');";
    $result = mysqli_query($conn,$query);
    if($result){
      echo "<script>alert('Kartu Berhasil DiBuat');window.location.href = 'halamancreate.php';</script>";
     
    }
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">

</head>
<body id="halaman_koleksi">
  
    <header id="header_arena">
        <nav>
          <ul>
            <li><a class="animate__animated animate__fadeInUp" href="adminhome.php">Kembali</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="adminhome.php" id="hal-arena">Create</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="deletehome.php" >Delete</a></li>
          </ul>
        </nav>
    </header>
    <main>
    <h2 class="animate__animated animate__fadeInUp" id="judul_koleksi">BUAT KARTU</h2>
    <form class="animate__animated animate__fadeInUp" action="" method="get">
      <label for="nama-kartu">Nama Kartu :</label>
      <input type="text" id="namakartuu" name="nama-kartu" style="color: black;"required>
      <label for="ovr-kartu">Overall Kartu :</label>
      <input type="text" id="overallkartuu" name="ovr-kartu"style="color: black;" required>
      <label for="link-kartu">Link Gambar Kartu :</label>
      <input type="text" id="linkkartu" name="link-kartu"style="color: black;" required>
		 
      </div>
     
    <br>
      <input type="submit" value="Confirm" id="tombol_login"name ="confirm-buat">
    </form>
        
    </main>
    <script>

document.getElementById("log_out").addEventListener("click", function(event){
			event.preventDefault();
			var result = confirm("Apakah Anda yakin ingin meninggalkan permainan?");
			if (result) {
				window.location.href = "index.php";
			}
		});

    </script>
</body>
</html>
    