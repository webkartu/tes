<?php
require "koneksi.php";
session_start();
if ($_SESSION["username"]=="login_dulu"){
  header("Location: login.php");
}
if ($_SESSION["bermain"]=="selesai"){
  header("Location: duelhome.php");
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

$picked_lawan= $_GET['kartu-lawan'];
$_SESSION["cardLawan"]=$picked_lawan;

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
$lawan_picked = $_GET['nama-lawan'];
$_SESSION["namaLawan"]=$lawan_picked;

$nama1 = $yang_login;
$pickedkard1 = $picked;
$nama2 = $lawan_picked;
$pickedkard2 = $picked_lawan;
$sql = "INSERT INTO tes_history (user,nama_lawan,kartu_user,kartu_lawan,skor) VALUES
        ('$nama1','$nama2','$pickedkard1','$pickedkard2',0)";
if (mysqli_query($conn, $sql)) {
  


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
            <li><a class="animate__animated animate__fadeInUp" href="duelhome.php" >Kembali</a></li>
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
      
       <div class="animate__animated animate__fadeInUp hit">
         <div id="hit-player1"><h2></h2></div>
         <div id="hit-player2"><h2></h2></div> 
        </div>
        <div class="animate__animated animate__fadeInUp petunjuk" id="petunjuk">
          <h2>Tekan Kartu Lawan !!!</h2>
          </div>
      </main>
</body>
<script>
const allCardList = <?php echo json_encode($_SESSION["Data_Kartu"]); ?> || [];
buatKartuBaru() ;
buatKartuBaru2();
let startTime = Date.now();
let endTime;
let isGameOver = false;

function updateTime() {
  if (player2Health <= 0 ) {
    clearInterval(timer);
    endTime = Date.now();
    const timeElapsedInSeconds = (endTime - startTime) / 1000; 
    console.log("Waktu yang diambil: " + timeElapsedInSeconds + " detik"); 
    alert("Anda Mengalahkan Lawan anda dalam waktu : "+timeElapsedInSeconds + " detik");
    isGameOver = true;

    const form = document.createElement("form");
    form.method = "GET";
    form.action = "history.php";
    
    const timeInput = document.createElement("input");
    timeInput.type = "hidden";
    timeInput.name = "skor";
    timeInput.value = timeElapsedInSeconds;

    const bermainInput = document.createElement("input");
    bermainInput.type = "text";
    bermainInput.name = "situasi";
    bermainInput.value = "selesai";

    form.appendChild(timeInput);
    form.appendChild(bermainInput);
    document.body.appendChild(form);
    form.submit();
    
  }else if (player1Health <= 0){
    clearInterval(timer);
    alert("Anda Bunuh Diri!");
    isGameOver = true;
    const form = document.createElement("form");
    form.method = "GET";
    form.action = "history.php";

    const timeInput = document.createElement("input");
    timeInput.type = "hidden";
    timeInput.name = "skor";
    timeInput.value = 0;

    const bermainInput = document.createElement("input");
    bermainInput.type = "text";
    bermainInput.name = "situasi";
    bermainInput.value = "selesai";

    form.appendChild(timeInput);
    form.appendChild(bermainInput)
    document.body.appendChild(form);
    form.submit();
    
  }
}

let timer = setInterval(updateTime, 100);
sessionStorage.setItem('username', '<?php echo $_SESSION["username"]; ?>');
const yangLogin = sessionStorage.getItem('username');
const list_pemain = <?php echo json_encode($_SESSION["array_player"]); ?> || [];
const numOfPlayer = list_pemain.length;

const containerkartu1 = document.getElementById("container-player1");
const containerkartu2= document.getElementById("container-player2");


const images11 = containerkartu1.getElementsByTagName("img");
const images22 = containerkartu2.getElementsByTagName("img");


for (let i = 0; i < images11.length; i++) {
  images11[i].addEventListener("contextmenu", function (event) {
    event.preventDefault();
   
  });
  images11[i].addEventListener("dragstart", function (event) {
    event.preventDefault();
    
  });
}

for (let i = 0; i < images22.length; i++) {
  images22[i].addEventListener("contextmenu", function (event) {
    event.preventDefault();
    
  });
  images22[i].addEventListener("dragstart", function (event) {
    event.preventDefault();
   
  });
}
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

sessionStorage.setItem('cardLawan', '<?php echo $_SESSION["cardLawan"]; ?>');
var cardLawan = sessionStorage.getItem("cardLawan");
console.log(cardLawan  + "ini");
const slideshowContainerPlayer2 = document.getElementById('container-player2');
const slideshowImages2 = slideshowContainerPlayer2.getElementsByTagName('img');
for (let i = 0; i < slideshowImages2.length; i++) {
  const image = slideshowImages2[i];
  if (image.alt === cardLawan) {
    image.style.display = "block";
  } else {
    image.style.display = "none";
  }
}
sessionStorage.setItem('namaLawan', '<?php echo $_SESSION["namaLawan"]; ?>');
var namaLawan = sessionStorage.getItem("namaLawan");
const divNamaPlayer1 = document.getElementById("nama-player1"); 
divNamaPlayer1.textContent = myCard.username;
const divNamaPlayer2 = document.getElementById("nama-player2"); 
divNamaPlayer2.textContent = namaLawan;
console.log(lawan);
for (let i = 0; i < otherCards.length; i++) {
  if (otherCards[i].username === namaLawan) {
    pickedCard = otherCards[i].picked_card;
    darahLawan = otherCards[i].overall;
    lawan = otherCards[i].username;
    break;
  }
}


let maxPlayer1 = myCard.overall;
let maxPlayer2 = darahLawan;
let player1Health = maxPlayer1; 
let player2Health = maxPlayer2; 


let dmgUser = maxPlayer1 * (10/100);
let dmgLawan = maxPlayer2 * (10/100);

const dmgPlayer1 = document.getElementById('hit-player1');
const dmgPlayer2 = document.getElementById('hit-player2');


dmgPlayer1.querySelector('h2').innerHTML = dmgLawan;
dmgPlayer2.querySelector('h2').innerHTML = dmgUser;
console.log(dmgLawan);
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
    player1Health -= dmgLawan; 
    if (player1Health < 0) player1Health = 0;
    player1HealthBar.style.width = (player1Health / maxPlayer1) * 100 + "%"; 
    if (player1Health > maxPlayer1) player1Health = maxPlayer1; 
});

containerPlayer2.addEventListener("click", function() {
    player2Health -= dmgUser; 
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
    
    this.style.pointerEvents = "none";
    this.classList.add("shake");
    this.classList.remove("animate__animated");
    this.classList.remove("animate__fadeInUp");
    
    setTimeout(() => {
      this.classList.remove("shake");
      
      this.style.pointerEvents = "auto";
    }, 500);
  });
}
const text = document.querySelector('.petunjuk h2');

function shake() {
  text.classList.add('getar');
  setTimeout(() => {
    text.classList.remove('getar');
  }, 1000); 
}

  shake();
const hitPlayer1 = document.getElementById("hit-player1");
const hitPlayer2 = document.getElementById("hit-player2");
const container1 = document.getElementById("container-player1");
const container2 = document.getElementById("container-player2");

function hit1(){
container1.addEventListener("click", function() {
  hitPlayer1.style.display = "block";
  hitPlayer1.addEventListener("animationend", function() {
    hitPlayer1.style.display = "none";
    text.style.display = "none";
  });
});
}
function hit2(){
container2.addEventListener("click", function() {
  hitPlayer2.style.display = "block";
  hitPlayer2.addEventListener("animationend", function() {
    hitPlayer2.style.display = "none";
    text.style.display = "none";
  });
});
}
hit1();
hit2();

document.addEventListener('contextmenu', event => event.preventDefault());


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