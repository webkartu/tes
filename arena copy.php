<?php
require "koneksi.php";
session_start();
if ($_SESSION["username"]=="login_dulu"){
  header("Location: login.php");
}
$yang_login = $_SESSION["username"];
$picked = $_GET['data'];
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
            <li><a class="animate__animated animate__fadeInUp" href="duelhome.php">Kembali</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="arena.php" id="arena">Arena</a></li>
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
        <div class="animate__animated animate__fadeInUp" id="container-player1" style="display:block;">
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
       <div class="animate__animated animate__fadeInUp" id="container-player2" style="display:block;">
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
        <form action="duelpick.php" method="get">
            <button id="confirm-button" type="submit" style="display:block;">Konfirmasi</button>
            <input type="hidden" name="data">

            
            </form>

        <div class="container_koleksi animate__animated animate__fadeInUp">
       
          
      </main>

</body>
<script>
let startTime = Date.now();
let endTime;
let isGameOver = false;

function updateTime() {
  if (player2Health <= 0 ) {
    clearInterval(timer);
    endTime = Date.now();
    const timeElapsedInSeconds = (endTime - startTime) / 1000; // konversi ke detik
    console.log("Waktu yang diambil: " + timeElapsedInSeconds + " detik"); 
    alert("Anda Mengalahkan Lawan anda dalam waktu : "+timeElapsedInSeconds + " detik");
    isGameOver = true;
  }else if (player1Health <= 0){
    clearInterval(timer);
    alert("Anda Bunuh Diri!");
    isGameOver = true;
  }
}



let timer = setInterval(updateTime, 100);
sessionStorage.setItem('username', '<?php echo $_SESSION["username"]; ?>');
const yangLogin = sessionStorage.getItem('username');
const list_pemain = <?php echo json_encode($_SESSION["array_player"]); ?> || [];
const numOfPlayer = list_pemain.length;


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
console.log(lawan);

let maxPlayer1 = myCard.overall;
let maxPlayer2 = darahLawan;
let player1Health = maxPlayer1; 
let player2Health = maxPlayer2; 

let player1HealthBar = document.createElement("div");
player1HealthBar.className = "health-bar";
player1HealthBar.style.width = (player1Health / maxPlayer1) * 100 + "%";
let containerPlayer1 = document.getElementById("container-player1");
containerPlayer1.appendChild(player1HealthBar);
player1HealthBar.style.background = "linear-gradient(to left, #0B4B0B, #2E8B57)";

let player2HealthBar = document.createElement("div");
player2HealthBar.className = "health-bar";
player2HealthBar.style.width = (player2Health / maxPlayer2) * 100 + "%";
let containerPlayer2 = document.getElementById("container-player2");
containerPlayer2.appendChild(player2HealthBar);
player2HealthBar.style.background = "linear-gradient(to left, #0B4B0B, #2E8B57)";

containerPlayer1.addEventListener("click", function() {
    player1Health -= 20; 
    if (player1Health < 0) player1Health = 0;
    player1HealthBar.style.width = (player1Health / maxPlayer1) * 100 + "%"; 
    if (player1Health > maxPlayer1) player1Health = maxPlayer1; 
});

containerPlayer2.addEventListener("click", function() {
    player2Health -= 20; 
    if (player2Health < 0) player2Health = 0; 
    player2HealthBar.style.width = (player2Health / maxPlayer2) * 100 + "%"; 
    if (player2Health > maxPlayer2) player2Health = maxPlayer2; 
});
let containerPlayer11 = document.getElementById("container-player1");
let containerPlayer22 = document.getElementById("container-player2");

let overlayPlayer1 = document.createElement("div");
overlayPlayer1.className = "overlay";
containerPlayer11.appendChild(overlayPlayer1);

let overlayPlayer2 = document.createElement("div");
overlayPlayer2.className = "overlay";
containerPlayer22.appendChild(overlayPlayer2);
let containers = document.querySelectorAll(".boxduel > div");
for (let i = 0; i < containers.length; i++) {
  containers[i].addEventListener("click", function() {
    // menonaktifkan klik selama animasi
    this.style.pointerEvents = "none";
    this.classList.add("shake");
    this.classList.remove("animate__animated");
    this.classList.remove("animate__fadeInUp");
    
    setTimeout(() => {
      this.classList.remove("shake");
      // mengaktifkan klik setelah animasi selesai
      this.style.pointerEvents = "auto";
    }, 500);
  });
}

</script>
</html>