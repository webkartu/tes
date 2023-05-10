<?php
require "koneksi.php";
session_start();

if ($_SESSION["username"]=="login_dulu"){
  header("Location: login.php");
}
if ($_SESSION["username"]!="admin"){
  header("Location: login.php");
}

$sql = "SELECT * FROM users";
$_SESSION['view'] = "see";
$result = mysqli_query($conn,$sql);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
</head>
<body id="halaman_koleksi">
    <header id="header_duel">
        <nav>
          <ul>
            <li><a class="animate__animated animate__fadeInUp" href="index.php" id="log_out">Keluar</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="adminhome.php">Main Menu</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="deletehome.php" id="hal-history">Delete</a></li>
          </ul>
        </nav>
      </header>
      <main>
        
        <h2 class="animate__animated animate__fadeInUp" id="judul_koleksi">PILIH USER</h2>
        <div class="user-container"> 
        <table class="animate__animated animate__fadeInUp" border="1" cellpadding="10" cellspacing="0">
        

        <tr>
        <td>ID</td>
        <td>Username</td>
        <td>Password</td>
        <td>Token</td>
        <td>Playing</td>
        <td>Ready</td>
        <th>OPTION</th>
        </tr>
        
        <?php 
    
        while($row1 = mysqli_fetch_assoc($result)) { ?>
        <tr>
        
        <td><?php echo $row1['id']?></td>
        <td><?php echo $row1['username']?></td>
        <td><?php echo $row1['password']?></td>
        <td><?php echo $row1['token']?></td>
        <td><?php echo $row1['playing']?></td>
        <td><?php echo $row1['ready']?></td>
        <td class="tombolhapus"> 
            <a href="halamandelete.php?user_name=<?php echo $row1["username"]?>">Delete</a>
        </td>
           
        </tr>
    <?php ?>
      <?php } ?>
    </table>
        </div>

        
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