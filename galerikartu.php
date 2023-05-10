<?php
session_start();
require "koneksi.php";
if ($_SESSION["username"]=="login_dulu"){
  header("Location: login.php");
}
if ($_SESSION["username"]!="admin"){
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
<header id="header_arena">
        <nav>
          <ul>
            <li><a class="animate__animated animate__fadeInUp" href="adminhome.php" id="log_out">Kembali</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="galerikartu.php" id="hal-arena">Gallery</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="deletehome.php" >Delete</a></li>
          </ul>
        </nav>
    </header>
    

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
  <div class="admin-gallery">
    <div class="judul-gallery-admin">Gallery</div>
    <div class="container-img-gallery-admin"></div>
    
  </div>
</body>
<script>
    const container_main = document.querySelector('.admin-gallery');
const container = document.querySelector('.container-img-gallery-admin');
let history_dict;
const allCards = <?php echo json_encode($_SESSION["Data_Kartu"]); ?> || [];
buatKartuBaru();


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

</script>
</html>