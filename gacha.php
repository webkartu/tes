<?php
session_start();
require "koneksi.php";
if ($_SESSION["username"]=="login_dulu"){
  header("Location: login.php");
}
$_SESSION["gachaIsTrue"]="true";
$yang_login = $_SESSION["username"];
$sql_update_link = "UPDATE $yang_login
JOIN tabel_kartu ON  $yang_login.kartu = tabel_kartu.nama_kartu
SET  $yang_login.link = tabel_kartu.link
";
$hasil_link = mysqli_query($conn, $sql_update_link);
$query = "SELECT token FROM users WHERE username = '$yang_login'";
$result = mysqli_query($conn,$query);
$row1 = mysqli_fetch_assoc($result);
$reset_ready="SELECT * FROM list_yang_main WHERE username = '$yang_login'";
$result_reset= $conn->query($reset_ready);
if ($result_reset->num_rows > 0) {
    $reset_update = "UPDATE list_yang_main SET ready ='no' where username = '$yang_login'";
    $conn->query($reset_update);
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




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
</head>
<body id="halaman_game">
    <header id="header_game">
        <nav>
            <ul>
              <li><a class="animate__animated animate__fadeInUp" href="duelhome.php">Duel</a></li>
              <li><a class="animate__animated animate__fadeInUp" href="gacha.php "id="gacha_button">Gacha</a></li>
              <li><a class="animate__animated animate__fadeInUp" href="koleksi.php">Collection</a></li>
            </ul>
          </nav>
            
    </header>
    
    <div id="welcome" class="animate__animated animate__fadeInUp"></div>
    <div >
        <button class="keluar-button" id="log_out">Keluar</button></div>
        <div>
        <div >
        <button class="userkomen" id="tombol-komen">Komentar</button></div>
        <div>
      <span id="selamat">Token Anda</span><br>
      
      
      <span id="token"> <?php echo  $row1['token']?></span>
      
      <span id="nama"></span>
    </div>
    
    <div class="animate__animated animate__fadeInUp slideshow-container">
        <img class="animate__animated animate__fadeInUp" src="card/mewtwoimg.jpg">
        <img class="animate__animated animate__fadeInUp" src="card/dragweb.jpg">
        <img class="animate__animated animate__fadeInUp" src="card/pikachucard.jpg" >
        <img class="animate__animated animate__fadeInUp" src="card/cropchar.gif" >
        <img class="animate__animated animate__fadeInUp" src="card/zapdos.png" >
        <img class="animate__animated animate__fadeInUp" src="card/articuno.webp" >
        <img class="animate__animated animate__fadeInUp" src="card/moltres.jpg" >
        <img class="animate__animated animate__fadeInUp" src="card/bulba.png" >   
        <img class="animate__animated animate__fadeInUp" src="card/gyarados.webp" >
        <img class="animate__animated animate__fadeInUp" src="card/gengar.webp">
        <img class="animate__animated animate__fadeInUp" src="card/charzmax.png" >
        <img class="animate__animated animate__fadeInUp" src="card/mew1.jpg" >
        </div>
        
        <div class="gacha-container">
            <button class="animate__animated animate__fadeInUp gacha-button">Gacha</button>
          </div>
          <div class="animate__animated animate__fadeInUp notification" style="display: none;">
</div>
<div class="list-kartu">
        <img class="animate__animated animate__fadeInUp" src="card/mewtwoimg.jpg" alt="MewTwo"style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/dragweb.jpg" alt="Dragonite"style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/pikachucard.jpg" alt="Pikachu"style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/cropchar.gif" alt="Charizard"style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/zapdos.png" alt="Zapdos" style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/articuno.webp" alt="Articuno"style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/moltres.jpg" alt="Moltres"style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/bulba.png" alt="Bulbasaur"style="display:none;">   
        <img class="animate__animated animate__fadeInUp" src="card/gyarados.webp" alt="Gyarados" style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/gengar.webp" alt="Gengar Max"style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/charzmax.png" alt="Charizard Max"style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/mew1.jpg" alt="Mew Max"style="display:none;">
</div>
  <div class="gallery">
    <div class="judul-gallery">Gallery</div>
    <div class="container-img-gallery"></div>
    
  </div>

          <script>

    var slideIndex = 0;
      let isGachaClicked = false;
      let timeout;

const container_main = document.querySelector('.gallery');
const container = document.querySelector('.container-img-gallery');
let history_dict;
const allCards = <?php echo json_encode($_SESSION["Data_Kartu"]); ?> || [];
buatKartuBaru();

  
const numOfCards = allCards.length;
        for (let i = 0; i < allCards.length; i++) {
              const card = allCards[i];
              if(card.link!="null"){
    
              const containerListKartu = document.querySelector('.slideshow-container ');
              const newImg = document.createElement('img');
              
              newImg.setAttribute('src', card.link);
              
              
              containerListKartu.appendChild(newImg);
          }
        }
          function showSlides() {
  if (!isGachaClicked) {
    var i;
    var slides = document.getElementsByClassName("slideshow-container")[0].getElementsByTagName("img");
    var filteredSlides = [];

    for (i = 0; i < slides.length; i++) {
      if (slides[i].getAttribute("src") !== "null") {
        filteredSlides.push(slides[i]);
      }
    }

    for (i = 0; i < filteredSlides.length; i++) {
      filteredSlides[i].className = "";
    }

    slideIndex++;
    if (slideIndex > filteredSlides.length) {
      slideIndex = 1;
    }

    filteredSlides[slideIndex - 1].className = "active";
    timeout = setTimeout(showSlides, 2000);
  }
}
      showSlides();

      const slideshowContainer = document.querySelector('.slideshow-container');
      const gachaButton = document.querySelector('.gacha-button');

      function handleGachaButton() {
         
          window.location.href = "gacha2.php";
        } 
        gachaButton.addEventListener('click', handleGachaButton);
        document.getElementById("log_out").addEventListener("click", function(event){
			event.preventDefault();
			var result = confirm("Apakah Anda yakin ingin meninggalkan permainan?");
			if (result) {
				window.location.href = "index.php";
			}
		});
    


//

container.style.display = 'flex';
container.style.flexDirection = 'row';
for (let i = 0; i < allCards.length; i++) {
    const card = allCards[i];
    const srcValue = card.link;
  const imageContainer = document.createElement('div');
  imageContainer.classList.add('image_container_koleksi1');
  imageContainer.style.marginRight = '10px';
  imageContainer.style.order = i;
  
  const imageElement = document.createElement('img');
  imageElement.setAttribute('id', `img${i+1}`);
  imageElement.setAttribute('src', srcValue);
  
  imageContainer.appendChild(imageElement);
  container.appendChild(imageContainer);
  
}




function buatKartuBaru() {
  allCards.forEach(function(card) {
    if (card.link) {
      const containerListKartu = document.querySelector('.list-kartu');
      const newImg= document.createElement('img');

      newImg.setAttribute('src', card.link);
      newImg.setAttribute('alt', card.nama_kartu);
      newImg.style.display = 'none';
        console.log(card.link + " ini")
      containerListKartu.appendChild(newImg);
    }
  });
}
const imageContainers = document.querySelectorAll('.image_container_koleksi1');
for (let i = 0; i < imageContainers.length; i++) {
  const img = imageContainers[i].querySelector('img');
  if (img.getAttribute('src') === '') {
    imageContainers[i].classList.remove('image_container_koleksi1');
    const imgContainerImgs = imageContainers[i].querySelectorAll('img');
    for (let j = 0; j < imgContainerImgs.length; j++) {
      imageContainers[i].removeChild(imgContainerImgs[j]);
      imageContainers[i].style.display = "none";
    }
  }
}

document.addEventListener('copy', function(event) {
  event.preventDefault();
 
});
document.addEventListener('selectstart', function(e) {
  e.preventDefault();
});

document.getElementById("tombol-komen").addEventListener("click", function(event){
			event.preventDefault();
		
				window.location.href = "user_komen.php";
			
		});

 
    
        </script>
</body>
</html>