<?php

require "koneksi.php";
session_start();
$sql = "SELECT DISTINCT @id:=@id+1 as id, h1.user AS user1, h2.user AS user2, h1.kartu_user AS kartu_user1, h2.kartu_user AS kartu_user2, h1.skor AS skor1, h2.skor AS skor2, h1.jam AS jam_user1, h2.jam AS jam_user2, h1.tanggal AS tanggal_user1, h2.tanggal AS tanggal_user2
FROM tes_history h1
JOIN tes_history h2 ON h1.user = h2.nama_lawan AND h1.nama_lawan = h2.user AND h1.kartu_user = h2.kartu_lawan AND h1.kartu_lawan = h2.kartu_user, (SELECT @id:=0) as t
WHERE h1.kondisi = 'selesai' AND h2.kondisi = 'selesai' AND h1.skor < h2.skor";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
  $history_result= array();
  while($row = $result->fetch_assoc()) {
    $history_result[] = array(
      "id" => $row["id"],
      "user1" => $row["user1"],
      "user2" => $row["user2"],
      "kartu_user1" => $row["kartu_user1"],
      "kartu_user2" => $row["kartu_user2"],
      "skor1" => $row["skor1"],
      "skor2" => $row["skor2"],
      "jam_user1" =>$row["jam_user1"],
      "jam_user2" => $row["jam_user2"],
      "tanggal_user1" => $row["tanggal_user1"],
      "tanggal_user2" => $row["tanggal_user2"]
    );
  }
  $_SESSION["history"] =  $history_result;
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
<body id="halaman_history">
<header id="header_history">
        <nav>
          <ul>
            <li><a class="animate__animated animate__fadeInUp" href="duelhome.php">Kembali</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="arena.php" id="arena">Arena</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="history2.php" id="hal-history" >History</a></li>
          </ul>
        </nav>
      </header>
      <div class="show-tutor" id="showTutorBtn">
          ?
      
        </div>
      <div class="title-history">History Permainan</div>
      
      <div class= "container-history">
       
    
       
        
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
      
            
    

  <script>
const allCardList = <?php echo json_encode($_SESSION["Data_Kartu"]); ?> || [];
buatKartuBaru() ;
let history_dict;
const historyResult =<?php echo json_encode($_SESSION["history"]); ?> || [];
for (let i = 0; i < historyResult.length; i++) {
  history_dict = historyResult[i];

  }
  
let new_history_dict = {};

const new_history_result = [];

for (let i = 0; i < historyResult.length; i++) {
  history_dict = historyResult[i];
    new_history_dict = {
      "id": history_dict.id,
      "user1": history_dict.user1,
      "user2": history_dict.user2,
      "kartu_user1": history_dict.kartu_user1,
      "kartu_user2": history_dict.kartu_user2,
      "skor1": history_dict.skor1,
      "skor2": history_dict.skor2,
      "jam_user1": history_dict.jam_user1,
      "jam_user2": history_dict.jam_user2,
      "tanggal_user1": history_dict.tanggal_user1,
      "tanggal_user2": history_dict.tanggal_user2
    };
    new_history_result.push(new_history_dict);
  
}

const container = document.querySelector('.container-history');


for (let i = 0; i < new_history_result.length; i++) {
  const history_dict = new_history_result[i];
  console.log(history_dict);
  const box = document.createElement("div");
  box.classList.add("box-history");

  const namaPlayer1 = document.createElement("div");
  namaPlayer1.classList.add("nama-player1");
  namaPlayer1.innerText = history_dict.user1;

  const namaPlayer2 = document.createElement("div");
  namaPlayer2.classList.add("nama-player2");
  namaPlayer2.innerText = history_dict.user2;

  const boxDalam = document.createElement("div");
  boxDalam.classList.add("box-dalam");

  const boxDalam2 = document.createElement("div");
  boxDalam2.classList.add("box-dalam2");

  
  const kartuUser1 = history_dict.kartu_user1;
  const alt = document.querySelector(`img[alt="${kartuUser1}"]`);
  const gambar = document.createElement("img");
  console.log(alt );
  gambar.src = alt.src;
  console.log(gambar.src + "ini 1");
  boxDalam.appendChild(gambar);
  
  const kartuUser2 = history_dict.kartu_user2;
  const alt2 = document.querySelector(`img[alt="${kartuUser2}"]`);
  const gambar2 = document.createElement("img");
  console.log(gambar2.src + "ini 2");
  gambar2.src = alt2.src;
  boxDalam2.appendChild(gambar2);
  
  
  const showVsHistory = document.createElement("div");
  showVsHistory.classList.add("show_vs_history");
  showVsHistory.innerText = "VS";

  
  const yangMenang = document.createElement("div");
  yangMenang.classList.add("yangMenang");
  yangMenang.innerText = history_dict.user1;

  const tampilWin = document.createElement("div");
  tampilWin.classList.add("tampilWin");
  tampilWin.innerText = "WINS";
  const skorHistory1 = document.createElement("div");
  skorHistory1.classList.add("skor_history1");
  skorHistory1.innerText = history_dict.skor1;

  const skorHistory2 = document.createElement("div");
  skorHistory2.classList.add("skor_history2");
  skorHistory2.innerText = history_dict.skor2;

  const tampilDetik1 = document.createElement("div");
  tampilDetik1.classList.add("tampil-detik1");
  tampilDetik1.innerText = "DETIK";

  const tampilDetik2 = document.createElement("div");
  tampilDetik2.classList.add("tampil-detik2");
  tampilDetik2.innerText = "DETIK";

  const showDetik = document.createElement("div");
  showDetik.classList.add("show-detik");
  showDetik.innerText = "Jam : " + history_dict.jam_user1;

  const showDetik2 = document.createElement("div");
  showDetik2.classList.add("show-detik2");
  showDetik2.innerText = "Jam : " + history_dict.jam_user2;

  const showTanggal = document.createElement("div");
  showTanggal.classList.add("show-tanggal");
  showTanggal.innerText = "Tanggal : " + history_dict.tanggal_user1;

  const showTanggal2 = document.createElement("div");
  showTanggal2.classList.add("show-tanggal2");
  showTanggal2.innerText = `Tanggal : ${history_dict.tanggal_user2}`;

  box.append(namaPlayer1, namaPlayer2, boxDalam, boxDalam2, showVsHistory, skorHistory1, skorHistory2,tampilDetik1,tampilDetik2, showDetik, showDetik2, showTanggal, showTanggal2,yangMenang,tampilWin);
  container.appendChild(box);
}


const showTutorBtn = document.getElementById('showTutorBtn');
  
  showTutorBtn.addEventListener('click', () => {
    
    alert('Jika Histori Permainan Anda Tidak Ditemukan, Tunggu Anda Lawan Selesai Bermain atau Refresh Halaman Ini ');
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
  </script>
</body>
<style>
.box-history{
  
  height: 400px;
  display: flex;
    width: 800px;
    margin-bottom: 20px;
    box-sizing: border-box;
    background-color: rgb(243, 243, 243);
    padding: 10px;
    text-align: center;
    
    max-width: 60%;
    border-radius: 20px;
    padding-left: 0px;
    justify-content: space-between;
    flex-direction: row;
  position: relative;
  

}
</style>

</html>