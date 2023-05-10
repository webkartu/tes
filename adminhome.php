<?php
require "koneksi.php";
session_start();

if ($_SESSION["username"]=="login_dulu"){
    header("Location: login.php");
  }

  if ($_SESSION["username"]!="admin"){
    header("Location: login.php");
  }


$sql = "SELECT * FROM tabel_kartu";
$result = mysqli_query($conn,$sql);
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
            <li><a class="animate__animated animate__fadeInUp" href="index.php" id="log_out">Keluar</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="adminhome.php" id="hal-arena">Main Menu</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="deletehome.php" >Delete</a></li>
          </ul>
        </nav>
    </header>
    <main>
    <h2 class="animate__animated animate__fadeInUp" id="judul_koleksi">LIST KARTU</h2>
    <div>
        <button class="button-tambah" id="button-tambah">Tambah Data   </button>
        <button class="button-galeri" id="button-galeri">Lihat Galeri</button>
     
       </div>
        <div class="user-container"> 
        <table class="animate__animated animate__fadeInUp" border="1" cellpadding="10" cellspacing="0">
        

        <tr>
        <td>ID</td>
        <td>Kartu</td>
        <td>Overall</td>
        <td>Option</td>

        
        </tr>
        
        <?php 
    
        while($row1 = mysqli_fetch_assoc($result)) { ?>
        <tr>
        
        <td><?php echo $row1['id']?></td>
        <td><?php echo $row1['nama_kartu']?></td>
        <td><?php echo $row1['overall']?></td>
       
        <td class="tombolhapus"> 
            <a href="halamanupdate.php?id=<?php echo $row1["id"]?>&kartu=<?php echo $row1["nama_kartu"]?>">Update</a>
        </td>
           
        </tr>
    <?php ?>
      <?php } ?>
    </table>
        </div>
      
        
    </main>
    <script>


document.getElementById("button-tambah").addEventListener("click", function(event){
			event.preventDefault();
		
				window.location.href = "halamancreate.php";
			}
);
document.getElementById("button-galeri").addEventListener("click", function(event){
			event.preventDefault();
		
				window.location.href = "galerikartu.php";
			}
);

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
    