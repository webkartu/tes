<?php
require "koneksi.php";
session_start();
if ($_SESSION["username"]=="login_dulu"){
  header("Location: login.php");
}
$_SESSION["gachaIsTrue"]="false";     
$yang_login = $_SESSION["username"];
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Document</title>
</head>
<body id="halaman_koleksi">
    <header id="header_koleksi">
        <nav>
          <ul>
            <li><a class="animate__animated animate__fadeInUp" href="duelhome.php">Duel</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="gacha.php" id="gacha_koleksi">Gacha</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="koleksi.php" id="koleksi">Collection</a></li>
          </ul>
        </nav>
      </header>
      <main>
      <div ><button class="keluar-button" id="log_out">Keluar</button></div>
        <h2 class="animate__animated animate__fadeInUp" id="judul_koleksi">KOLEKSI KARTU ANDA</h2>
        
        <div>
            <label class="animate__animated animate__fadeInUp sorting" >
              <input type="radio" name="sort" value="desc" >
              Urutkan dari yang terbaru
            </label>
            <label class="animate__animated animate__fadeInUp sorting" >
              <input type="radio" name="sort" value="asc">
              Urutkan dari yang terlama
            </label>
          </div>
          
        <div class="list-kartu animate__animated animate__fadeInUp">
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
        <div class="container_koleksi animate__animated animate__fadeInUp">
        </div>
          
      </main>

</body>
<script>
const container = document.querySelector('.container_koleksi');
const allCards = <?php echo json_encode($_SESSION["cards"]); ?> || [];
const numOfCards = allCards.length;
const radioBox = document.getElementsByName('sort');
const allCardList = <?php echo json_encode($_SESSION["Data_Kartu"]); ?> || [];
buatKartuBaru() ;
function sortCards() {
  const selectedSort = document.querySelector('input[name="sort"]:checked').value;
  allCards.sort((a, b) => {
    if (selectedSort === 'desc') {
      return b.id - a.id;
    } else {
      return a.id - b.id;
    }
  });
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
for (let i = 0; i < allCards.length; i++) {
  const card = allCards[i];
  const altValue = card.kartu;
  const imgElement = document.querySelector(`img[alt="${altValue}"]`);
  if (imgElement) {
    console.log(imgElement);
    const srcValue = imgElement.getAttribute('src');
    const imgId = `img${card.id}`;

    console.log(card.id);
    const targetImgElement = document.getElementById(imgId);
    if (targetImgElement) {
      targetImgElement.setAttribute('src', srcValue);
    }
  }
}


function buatKartuBaru() {
  allCardList.forEach(function(card) {
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
radioBox.forEach(radio => {
  radio.addEventListener('change', sortCards);



document.addEventListener('copy', function(event) {
  event.preventDefault();
  
});

document.addEventListener('selectstart', function(e) {
  e.preventDefault();
});
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




document.getElementById("log_out").addEventListener("click", function(event){
			event.preventDefault();
			var result = confirm("Apakah Anda yakin ingin meninggalkan permainan?");
			if (result) {
				window.location.href = "index.php";
			}
		});
</script>
</html>