<?php
require "koneksi.php";
session_start();
if ($_SESSION["username"]=="login_dulu"){
  header("Location: login.php");
}
$_SESSION["bermain"]="playing";
$yang_login = $_SESSION["username"];
$picked = $_GET['data'];
$_SESSION["kartu_user"] = $picked;
$picked_ovr = $_GET['dataOverall'];
$sql = "SELECT * FROM $yang_login WHERE kartu = '$picked'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    
    header("Location: duelhome.php");
    exit();
  }
$sql_play="INSERT INTO list_yang_main (username,picked_card,overall,ready) VALUES ('$yang_login','$picked',$picked_ovr,'yes')";
$result_play = mysqli_query($conn,$sql_play);

$search_lawan= "SELECT * FROM list_yang_main WHERE ready = 'yes' ";
$sql = "SELECT id, kartu, overall FROM $yang_login";
$result_search = $conn->query($search_lawan);
if ($result_search->num_rows > 0) {
  $array_lawan = array();
  while($row = $result_search->fetch_assoc()) {
    $array_lawan[] = $row;
  }
  $_SESSION["array_player"] = $array_lawan;
  
} else {
}
$sql_updatePlay = "UPDATE list_yang_main SET playing = 'no' WHERE username = '$yang_login'";
$result_play2 = mysqli_query($conn,$sql_updatePlay);


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
            <li><a class="animate__animated animate__fadeInUp" href="duelhome.php">Kembali</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="arena.php" id="hal-arena">Arena</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="history.php" >History</a></li>
          </ul>
        </nav>
      </header>
      <main>
      
        <h2 class="animate__animated animate__fadeInUp" id="judul_koleksi"></h2>
        <div class="all-player">
        <div class="animate__animated animate__fadeInUp"id="nama-player1"></div>
        <div id ="versus-text"> <h2>VS</h2></div>
        <div class="animate__animated animate__fadeInUp"id="nama-player2"></div>
        
        </div>
        <div class="boxduel">
        <div class="list-kartu animate__animated animate__fadeInUp" id="container-player1" style="display:block;">
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
      
          
       
        <div class="animate__animated animate__fadeInUp"id="nama-player2"></div>
       <div class="list-kartu2 animate__animated animate__fadeInUp" id="container-player2" style="display:block;">
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

    
        
        </div>
        <form action="loadingduel.php" method="get">
            <button id="confirm-button" type="submit" style="display:block;">Konfirmasi</button>
            <input type="hidden" name="nama-lawan">
            <input type="hidden" name="data">
            <input type="hidden" name="dataOverall">
            <input type="hidden" name="kartu-lawan">
            </form>

       <!-- <div >
        <button class="cari-lawan" id="cari-button"> CARI</button>
       </div>
           -->
      </main>

</body>
<script>

const allCardList = <?php echo json_encode($_SESSION["Data_Kartu"]); ?> || [];
buatKartuBaru() ;
buatKartuBaru2();





sessionStorage.setItem('username', '<?php echo $_SESSION["username"]; ?>');
const yangLogin = sessionStorage.getItem('username');
const list_pemain = <?php echo json_encode($_SESSION["array_player"]); ?> || [];
const numOfPlayer = list_pemain.length;

function mulaiHalaman(){
let myCard = {};
for (let i = 0; i < list_pemain.length; i++) {
  const kartuPlayer = list_pemain[i];
  if (kartuPlayer.username ===  yangLogin) {
    myCard.username = kartuPlayer.username;
    myCard.picked_card = kartuPlayer.picked_card;
    myCard.overall = kartuPlayer.overall;
    break;
  }
}
const otherCards = [];
for (let i = 0; i < list_pemain.length; i++) {
  const kartuPlayer = list_pemain[i];
  if (kartuPlayer.username !== yangLogin) {
    otherCards.push({username: kartuPlayer.username, picked_card: kartuPlayer.picked_card, overall: kartuPlayer.overall});
  }
}
const randomIndex = Math.floor(Math.random() * otherCards.length);
const randomUsername = otherCards[randomIndex].username;
let pickedCard;
let darahLawan;
let lawan;
for (let i = 0; i < otherCards.length; i++) {
  if (otherCards[i].username === randomUsername) {
    pickedCard = otherCards[i].picked_card;
    darahLawan = otherCards[i].overall;
    lawan = otherCards[i].username;
    break;
  }
}
console.log(pickedCard);

const slideshowContainerPlayer1 = document.getElementById('container-player1');
const slideshowImages1 = slideshowContainerPlayer1.getElementsByTagName('img');
for (let i = 0; i < slideshowImages1.length; i++) {
  const image = slideshowImages1[i];
  if (image.alt === myCard.picked_card) {
    image.style.display = "block";
  } else {
    image.style.display = "none";
  }
}
const slideshowContainerPlayer2 = document.getElementById('container-player2');
const slideshowImages2 = slideshowContainerPlayer2.getElementsByTagName('img');
for (let i = 0; i < slideshowImages2.length; i++) {
  const image = slideshowImages2[i];
  if (image.alt === pickedCard) {
    image.style.display = "block";
  } else {
    image.style.display = "none";
  }
}
const divNamaPlayer1 = document.getElementById("nama-player1"); 
divNamaPlayer1.textContent = myCard.username;
const divNamaPlayer2 = document.getElementById("nama-player2"); 
divNamaPlayer2.textContent = lawan;



const dataInput = document.querySelector('input[name="nama-lawan"]');
dataInput.value = lawan;
const dataInput2 = document.querySelector('input[name="data"]');
dataInput2.value = myCard.picked_card;
const dataInputOverall = document.querySelector('input[name="dataOverall"]');
dataInputOverall.value = myCard.overall;
const dataInputKartuLawan = document.querySelector('input[name="kartu-lawan"]');
dataInputKartuLawan.value = pickedCard;


}
mulaiHalaman();
document.addEventListener('copy', function(event) {
  event.preventDefault();
  
});

document.addEventListener('selectstart', function(e) {
  e.preventDefault();
});


function buatKartuBaru() {
  allCardList.forEach(function(card) {
    if (card.link) {
      const containerListKartu = document.querySelector('.list-kartu');
      const newImg= document.createElement('img');
      
     
      newImg.setAttribute('src', card.link);
      newImg.setAttribute('alt', card.nama_kartu);
      newImg.style.display = 'none';
      newImg.classList.add('animate__animated', 'animate__fadeInUp');
       
      containerListKartu.appendChild(newImg);
    }
  });
}
function buatKartuBaru2() {
  allCardList.forEach(function(card) {
    if (card.link) {
      const containerListKartu = document.querySelector('.list-kartu2');
      const newImg= document.createElement('img');
      
     
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