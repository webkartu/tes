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
            <li><a class="animate__animated animate__fadeInUp" href="duelhome.php"  id="hal-duelhome">Duel</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="gacha.php" id="gacha_koleksi">Gacha</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="koleksi.php">Collection</a></li>
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
       <label class="animate__animated animate__fadeInUp sorting" >
    <input type="radio" name="sort" value="desc">
    Urutkan Kartu dari Overall Tertinggi
  </label>
  <label class="animate__animated animate__fadeInUp sorting" >
    <input type="radio" name="sort" value="asc">
    Urutkan Kartu dari Overall Terendah
  </label>
      
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
        <div class="button-container">
            <button id="tombol-pilih-baru" class="tombol-pilih-baru" value="<?php echo $row['id']?>">pilih</button></div>
      </div>
  <?php } ?>
  
</div>
        
      </main>

</body>
<script>
const tombolPilih = document.querySelectorAll('.tombol-pilih-baru');

tombolPilih.forEach(function(tombol) {
  tombol.addEventListener('click', function() {
    const img = document.querySelector(`img[idKartu="${tombol.value}"]`);
    const alt = img.getAttribute('alt');
    const overall = img.getAttribute('overall');
    const srcKartu = img.getAttribute('src');
    const idKartu = img.getAttribute('idKartu');
    console.log('Nilai Alt:', alt);
    console.log('Nilai Overall:', overall);
    console.log('Nilai Src:', srcKartu);
    console.log('Nilai Id Kartu:', idKartu);
   
    const slideShowId = document.getElementById('slideshow-container1');
    document.querySelector('.slideshow-container1').style.display = 'block';
    slideShowId.src = srcKartu;
    slideShowId.style.display = 'block';
    const confirmButton = document.getElementById('confirm-button1');
confirmButton.style.display = 'block';
const dataInput = document.querySelector('input[name="data"]');
const dataInputOverall = document.querySelector('input[name="dataOverall"]');
dataInput.value=alt;
dataInputOverall.value = overall;
console.log(dataInput.value);
console.log(dataInputOverall.value);
  });
});

const descRadio = document.querySelector('input[value="desc"]');
const ascRadio = document.querySelector('input[value="asc"]');
const containerKoleksi = document.querySelector('.container_koleksi');

descRadio.addEventListener('click', function() {
  const cards = [...containerKoleksi.children];
  cards.sort(function(a, b) {
    const overallA = a.querySelector('img').getAttribute('overall');
    const overallB = b.querySelector('img').getAttribute('overall');
    return overallB - overallA;
  });
  containerKoleksi.innerHTML = '';
  cards.forEach(function(card) {
    containerKoleksi.appendChild(card);
  });
});

ascRadio.addEventListener('click', function() {
  const cards = [...containerKoleksi.children];
  cards.sort(function(a, b) {
    const overallA = a.querySelector('img').getAttribute('overall');
    const overallB = b.querySelector('img').getAttribute('overall');
    return overallA - overallB;
  });
  containerKoleksi.innerHTML = '';
  cards.forEach(function(card) {
    containerKoleksi.appendChild(card);
  });
});


function scrollToTop() {
  var currentPosition = document.documentElement.scrollTop || document.body.scrollTop;
  if (currentPosition > 50) {
    window.requestAnimationFrame(scrollToTop);
    window.scrollTo(50, currentPosition - currentPosition / 80);
  }
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