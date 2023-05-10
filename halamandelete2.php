<?php
require "koneksi.php";

if ($_SESSION["username"]=="login_dulu"){
  header("Location: login.php");
}
session_start();

$yang_login = $_GET['user_name'];
$sql = "SELECT id, kartu, overall FROM $yang_login";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $cards = array();
  while($row = $result->fetch_assoc()) {
    $cards[] = $row;
  }
  $_SESSION["cards"] = $cards;
} else {
}
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
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
</head>
<body id="halaman_koleksi">
    <header id="header_duel">
        <nav>
          <ul>
            <li><a class="animate__animated animate__fadeInUp" href="adminhome.php" >Kembali</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="adminhome.php" id="gacha_koleksi">Main Menu</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="deletehome.php" id="hal-history">Delete</a></li>
          </ul>
        </nav>
      </header>
      <main>
        
        <h2 class="animate__animated animate__fadeInUp" id="judul_koleksi">PILIH KARTU UNTUK DI HAPUS</h2>
        
    
      
         
          <div class="list-kartu animate__animated animate__fadeInUp slideshow-container1" style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/mewtwoimg.jpg"id="slideshow-container1" alt="MewTwo"style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/dragweb.jpg"id="slideshow-container1" alt="Dragonite"style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/pikachucard.jpg"id="slideshow-container1" alt="Pikachu"style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/cropchar.gif"id="slideshow-container1" alt="Charizard"style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/zapdos.png"id="slideshow-container1" alt="Zapdos" style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/articuno.webp"id="slideshow-container1" alt="Articuno"style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/moltres.jpg"id="slideshow-container1" alt="Moltres"style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/bulba.png"id="slideshow-container1" alt="Bulbasaur"style="display:none;">   
        <img class="animate__animated animate__fadeInUp" src="card/gyarados.webp"id="slideshow-container1" alt="Gyarados" style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/gengar.webp"id="slideshow-container1" alt="Gengar Max"style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/charzmax.png"id="slideshow-container1" alt="Charizard Max"style="display:none;">
        <img class="animate__animated animate__fadeInUp" src="card/mew1.jpg"id="slideshow-container1" alt="Mew Max"style="display:none;">
         
        
        </div>
         
        </div>
        <div>
        <form action="proseshapus.php" method="get">
            <button id="confirm-button1" type="submit" style="display:none;">Konfirmasi</button>
            <input type="hidden" name="data">
            <input type="hidden" name="dataId">
            <input type="hidden" name="user_name" value=<?php echo $yang_login?>>
            </form>
            <div>

        <div class="container_koleksi animate__animated animate__fadeInUp">
      
        
      </main>

</body>
<script>
const container = document.querySelector('.container_koleksi');
const allCards = <?php echo json_encode($_SESSION["cards"]); ?> || [];
const numOfCards = allCards.length;

const radioBox = document.getElementsByName('sort');
const slideshowDiv = document.querySelector('.animate__animated.animate__fadeInUp');
const allCardList = <?php echo json_encode($_SESSION["Data_Kartu"]); ?> || [];
buatKartuBaru() ;
function sortCards() {
  const selectedSort = document.querySelector('input[name="sort"]:checked').value;
  allCards.sort((a, b) => {
    if (selectedSort === 'desc') {
      return b.overall - a.overall || b.id - a.id;
    } else {
      return a.overall - b.overall || a.id - b.id;
    }
  });
  for (let i = 0; i < allCards.length; i++) {
    const card = allCards[i];
    console.log(card);
    const altValue = card.kartu;
    const imgElement = document.querySelector(`img[alt="${altValue}"]`);
    if (imgElement) {
      const srcValue = imgElement.getAttribute('src');
      const imgId = `img${card.id}`;
      const targetImgElement = document.getElementById(imgId);
    
      if (targetImgElement) {
        targetImgElement.setAttribute('src', srcValue);
        const targetImageContainer = targetImgElement.parentNode;
        targetImageContainer.style.order = i;
      }
    }
  }
}

container.style.display = 'flex';
container.style.flexDirection = 'row';
for (let i = 0; i < numOfCards; i++) {
  const imageContainer = document.createElement('div');
  imageContainer.classList.add('image_container_koleksi');
  imageContainer.style.marginRight = '10px';
  imageContainer.style.order = i;
  
  const imageElement = document.createElement('img');
  imageElement.setAttribute('id', `img${i+1}`);
  imageElement.setAttribute('src', '');
  
  imageContainer.appendChild(imageElement);
  container.appendChild(imageContainer);
}
let selectedCard;

for (let i = 0; i < allCards.length; i++) {
  const card = allCards[i];
  const altValue = card.kartu;
  const imgElement = document.querySelector(`img[alt="${altValue}"]`);
  
  if (imgElement) {
    const srcValue = imgElement.getAttribute('src');
    const imgId = `img${card.id}`;
    const targetImgElement = document.getElementById(imgId);
    
    if (targetImgElement) {
      targetImgElement.setAttribute('src', srcValue);
      targetImgElement.setAttribute('alt', altValue);

      const containerElement = targetImgElement.parentNode;
      const buttonElement = document.createElement('button');
      buttonElement.textContent = "pilih" ;
      buttonElement.id="tombol-pilih";
      buttonElement.addEventListener('click', function() {
        document.getElementById("slideshow-container1").style.display = "block";
        document.getElementById("confirm-button1").style.display = "block";
        selectedCard = card;
        console.log('Selected card ID:', selectedCard.id);
        console.log('tes',card.overall);
        const kartuaktif = selectedCard.kartu;
        const slideshowContainer = document.getElementById('slideshow-container1');
        const slideshowImages = slideshowContainer.getElementsByTagName('img');
        
        for (let i = 0; i < slideshowImages.length; i++) {
          const image = slideshowImages[i];
          if (image.alt === kartuaktif) {
            image.style.display = "block";
            const dataInput = document.querySelector('input[name="data"]');
            dataInput.value = kartuaktif;
            console.log(kartuaktif);
            const dataInputId = document.querySelector('input[name="dataId"]');
            dataInputId.value = selectedCard.id;
            console.log(selectedCard.overall);
            scrollToTop();
          } else {
            image.style.display = "none";
          }
        }
      });
      
      containerElement.appendChild(buttonElement);
    }
  }
}
const confirmButton = document.getElementById('confirm-button1');

confirmButton.addEventListener('click', function() {
 
});

radioBox.forEach(radio => {
  radio.addEventListener('change', sortCards);


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
 
});

document.addEventListener('selectstart', function(e) {
  e.preventDefault();
});
const imageContainers = document.querySelectorAll('.image_container_koleksi');
for (let i = 0; i < imageContainers.length; i++) {
  const img = imageContainers[i].querySelector('img');
  if (img.getAttribute('src') === '') {
    imageContainers[i].classList.remove('image_container_koleksi');
    const imgContainerImgs = imageContainers[i].querySelectorAll('img');
    for (let j = 0; j < imgContainerImgs.length; j++) {
      imageContainers[i].removeChild(imgContainerImgs[j]);
      imageContainers[i].style.display = "none";
    }
  }
}
function buatKartuBaru() {
  allCardList.forEach(function(card) {
    if (card.link) {
      const containerListKartu = document.querySelector('.list-kartu');
      const newImg= document.createElement('img');
      
      newImg.setAttribute('id', 'slideshow-container1');
      newImg.setAttribute('src', card.link);
      newImg.setAttribute('alt', card.nama_kartu);
      newImg.style.display = 'none';
      newImg.classList.add('animate__animated', 'animate__fadeInUp');
       
      containerListKartu.appendChild(newImg);
    }
  });
}



</script>
</html>