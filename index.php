<?php
session_start();
session_destroy();
session_start();
if(isset($_SESSION['username'])) {
  $yang_login = $_SESSION['username'];
  $reset_ready="SELECT * FROM list_yang_main WHERE username = '$yang_login'";
  $result_reset= $conn->query($reset_ready);
  if ($result_reset->num_rows > 0) {
      $reset_update = "UPDATE list_yang_main SET ready ='no' where username = '$yang_login'";
      $conn->query($reset_update);
  } 
} else {
  $_SESSION['username'] = "login_dulu";
}

?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body id="halaman_home">
    <header id="header_home">
      <nav>
        <ul>
          <li><a class="animate__animated animate__fadeInUp" href="index.php" id="home_button">Home</a></li>
          <li><a class= "animate__animated animate__fadeInUp"href="login.php" id="login_button_home">Login</a></li>
          <li><a class= "animate__animated animate__fadeInUp"href="register.php">Register</a></li>
        </ul>
      </nav>
    </header>
    <main >
      <div >
        <h1 class ="animate__animated animate__fadeInUp intro">SELAMAT DATANG DI WEB POKEMON TRADING CARD</h1>
       
        <button class ="animate__animated animate__fadeInUp play-btn">Mainkan Sekarang</button>
        
        </script>
            
    </div>
      <div class="konten">
        <h2 class="animate__animated animate__fadeInUp">Fitur</h2>
        <ul>
          <li class="animate__animated animate__fadeInUp">Kumpulkan Kartu-Kartu Pokemon Keren</li>
          <li class="animate__animated animate__fadeInUp">Lakukan Gacha Untuk Mendapatkan Koleksi Kartu Pokemon Langka</li>
        </ul>
    </div>
      <div class="kartu"> 
        <li></li>
        <img class="animate__animated animate__fadeInUp" src="card/mewtwoimg.jpg">
        <img class="animate__animated animate__fadeInUp" src="card/gengar.webp">
        <img class="animate__animated animate__fadeInUp" src="card/charzmax.png" >
        <img class="animate__animated animate__fadeInUp" src="card/mew1.jpg" >
     </div>
    </main>
   
  </body>
</html>
