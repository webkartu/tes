
<?php
include "koneksi.php";
session_start();
if ($_SESSION["username"]=="login_dulu"){
  header("Location: login.php");
}
if ($_SESSION["username"]!="owner"){
  header("Location: login.php");
}
$sql = "SELECT * FROM tabel_kartu";
$result = $conn->query($sql);
if ($result) {
  $data_kartu = array();
  while($row = $result->fetch_assoc()) {
    $data_kartu[] = $row;
  }
  $_SESSION["Data_Kartu"] = $data_kartu;
} else {
}
$sql_komentar ="SELECT * FROM pesan";
$result_komentar = mysqli_query($conn,$sql_komentar);

?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lora&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
 
  </head>
  <body id="halaman_login">
    <header id="header_login">
        <nav>
            <ul>
              <li><a class="animate__animated animate__fadeInUp" href="index.php" id="log_out">Keluar</a></li>
              <li><a class="animate__animated animate__fadeInUp" href="ownerhome.php" id="login_button">Lihat Komentar</a></li>
              <li><a class="animate__animated animate__fadeInUp" href="ownerpilih.php">Tambah Data</a></li>
            </ul>
          </nav>
            
    </header>
    <main>
    <div class="comments">
    <?php 
    while($row = mysqli_fetch_assoc($result_komentar)) { ?>
		<div class="comment">
			<div class="comment-header">
				<h3 class="comment-author"><?php echo $row['username']?></h3>
				<span class="comment-date"><?php echo $row['tanggal']?></span>
			</div>
			<p class="comment-body" ><?php echo $row['komentar']?></p>           
      <a class="tombol-hapus-komen" href="hapuskomen.php?id=<?php echo $row["id"]?>">Hapus Komentar</a>
		
		</div>
    
	</div>




     
  <?php } ?>
   

   

    </main>
    
    
   
  </body>
  <script>
    document.getElementById("log_out").addEventListener("click", function(event){
			event.preventDefault();
			var result = confirm("Apakah Anda yakin ingin meninggalkan permainan?");
			if (result) {
				window.location.href = "index.php";
			}
		});
  </script>
</html>

  
