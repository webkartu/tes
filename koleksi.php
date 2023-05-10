<?php
require "koneksi.php";
session_start();
if ($_SESSION["username"]=="login_dulu"){
    header("Location: login.php");
  }
$yang_login = $_SESSION["username"];
$sql = "SELECT * FROM $yang_login";
$result = mysqli_query($conn,$sql);
$reset_ready="SELECT * FROM list_yang_main WHERE username = '$yang_login'";
$result_reset= $conn->query($reset_ready);
if ($result_reset->num_rows > 0) {
    $reset_update = "UPDATE list_yang_main SET ready ='no' where username = '$yang_login'";
    $conn->query($reset_update);
} 
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
            <li><a class="animate__animated animate__fadeInUp" href="duelhome.php" >Duel</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="gacha.php" id="gacha_koleksi">Gacha</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="koleksi.php" id="hal-duelhome">Collection</a></li>
          </ul>
        </nav>
      </header>
      <main>
        <div ><button class="keluar-button"  id ="log_out">Keluar</button></div>
        <h2 class="animate__animated animate__fadeInUp" id="judul_koleksi">PILIH KARTU</h2>
        <div>
            
        </div>
        <div>

        <button id="show-history">
          Lihat History
        </button>
       </div>
       <div>
  <label class="animate__animated animate__fadeInUp sorting" >
    <input type="radio" name="sort" value="desc" onchange="sortCards(this.value)">
    Urutkan dari yang terbaru
  </label>
  <label class="animate__animated animate__fadeInUp sorting" >
    <input type="radio" name="sort" value="asc" onchange="sortCards(this.value)">
    Urutkan dari yang terlama
  </label>
</div>

      
          <div>
         
        <div class="animate__animated animate__fadeInUp slideshow-container1" style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/mewtwoimg.jpg"id="slideshow-container1" alt="MewTwo"style="display:none;">
        </div> 
        <form action="arena.php" method="get">
            <button id="confirm-button1" type="submit" style="display:none;">Konfirmasi</button>
            <input type="hidden" name="data">
            <input type="hidden" name="dataOverall">
            </form>

        <div class="container_koleksi animate__animated animate__fadeInUp">
  <?php 
    while($row = mysqli_fetch_assoc($result)) { ?>
      <div class="image_container_koleksi">
        <img class="animate__animated animate__fadeInUp" src="<?php echo $row['link']?>" alt="<?php echo $row['kartu']?>"overall="<?php echo $row['overall']?>" idKartu="<?php echo $row['id']?>">
       
      </div>
  <?php } ?>
  
</div>
        
      </main>

</body>
<script>


function scrollToTop() {
  var currentPosition = document.documentElement.scrollTop || document.body.scrollTop;
  if (currentPosition > 50) {
    window.requestAnimationFrame(scrollToTop);
    window.scrollTo(50, currentPosition - currentPosition / 80);
  }
}
function sortCards(sortType) {
  const container = document.querySelector(".container_koleksi");
  const cards = container.children;
  const cardsArr = Array.from(cards);

  if (sortType === "desc") {
    cardsArr.sort((a, b) => {
      const aId = parseInt(a.querySelector("img").getAttribute("idKartu"));
      const bId = parseInt(b.querySelector("img").getAttribute("idKartu"));
      return bId - aId;
    });
  } else if (sortType === "asc") {
    cardsArr.sort((a, b) => {
      const aId = parseInt(a.querySelector("img").getAttribute("idKartu"));
      const bId = parseInt(b.querySelector("img").getAttribute("idKartu"));
      return aId - bId;
    });
  }

  container.innerHTML = "";
  cardsArr.forEach(card => container.appendChild(card));
}




document.addEventListener('copy', function(event) {
  event.preventDefault();
  alert('Copying is not allowed on this website');
});

document.addEventListener('selectstart', function(e) {
  e.preventDefault();
});

const tombol = document.getElementById("show-history");


tombol.addEventListener("click", function() {
  window.location.href = "history2.php";
});


document.getElementById("log_out").addEventListener("click", function(event){
			event.preventDefault();
			var result = confirm("Apakah Anda yakin ingin meninggalkan permainan?");
			if (result) {
				window.location.href = "index.php";
			}
		});
</script>
</html>