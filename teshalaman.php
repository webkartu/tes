<?php

require "koneksi.php";
session_start();
$sql = "SELECT @id:=@id+1 as id, h1.user AS user1, h2.user AS user2, h1.kartu_user AS kartu_user1, h2.kartu_user AS kartu_user2, h1.skor AS skor1, h2.skor AS skor2, h1.jam AS jam_user1, h2.jam AS jam_user2, h1.tanggal AS tanggal_user1,h2.tanggal AS tanggal_user2
FROM tes_history h1
JOIN tes_history h2 ON h1.user = h2.nama_lawan AND h1.nama_lawan = h2.user AND h1.kartu_user = h2.kartu_lawan AND h1.kartu_lawan = h2.kartu_user, (SELECT @id:=0) as t
WHERE h1.kondisi = 'selesai' AND h2.kondisi = 'selesai'
";

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
  echo "Tidak ada data yang ditemukan";
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
<header id="header_koleksi">
        <nav>
          <ul>
            <li><a class="animate__animated animate__fadeInUp" href="duelhome.php">Kembali</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="arena.php" id="arena">Arena</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="history.php" >History</a></li>
          </ul>
        </nav>
      </header>
      <div class="title-history">History Permainan</div>
      <div class= "container-history">
        <div class= "box-history">
        <div class="nama-player1">Josia</div>
        <div class="nama-player2">Yantok</div>
          <div class="box-dalam"></div>
          <div class="box-dalam2"></div>
          <div Class="show_vs_history">VS</div>
          <div class="skor_history1">1</div>
          <div class="skor_history2">2</div>
          <div class="show-detik">DETIK</div>
          <div class="show-detik2">DETIK</div>
          <div class="show-tanggal">Tanggal : 12-1-2</div>
          <div class="show-tanggal2">Tanggal : 2-5-0</div>
        </div>
       
        
      </div>
      <div class="card-list">

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

let history_dict;
const historyResult =<?php echo json_encode($_SESSION["history"]); ?> || [];
for (let i = 0; i < historyResult.length; i++) {
  history_dict = historyResult[i];
  
  }
  
let new_history_dict = {};

const new_history_result = [];

for (let i = 0; i < historyResult.length; i++) {
  history_dict = historyResult[i];

  if (history_dict.id % 2 === 1) {
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
}



console.log(new_history_result);

const container = document.querySelector('.container-history');



for (let i = 0; i < new_history_result.length; i++) {
  const history_dict = new_history_result[i];
  
  
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
  const imgDalam = document.createElement("img");
   
boxDalam.appendChild(imgDalam);
  
  const boxDalam2 = document.createElement("div");
  boxDalam2.classList.add("box-dalam2");
  const imgDalam2 = document.createElement("img");

boxDalam2.appendChild(imgDalam2)
  
  const showVsHistory = document.createElement("div");
  showVsHistory.classList.add("show_vs_history");
  showVsHistory.innerText = "VS";
  
  const skorHistory1 = document.createElement("div");
  skorHistory1.classList.add("skor_history1");
  skorHistory1.innerText = history_dict.skor1;
  
  const skorHistory2 = document.createElement("div");
  skorHistory2.classList.add("skor_history2");
  skorHistory2.innerText = history_dict.skor2;
  
  const showDetik = document.createElement("div");
  showDetik.classList.add("show-detik");
  showDetik.innerText = history_dict.jam_user1;
  
  const showDetik2 = document.createElement("div");
  showDetik2.classList.add("show-detik2");
  showDetik2.innerText = history_dict.jam_user2;
  
  const showTanggal = document.createElement("div");
  showTanggal.classList.add("show-tanggal");
  showTanggal.innerText = "Tanggal : " + history_dict.tanggal_user1;
  
  
  const showTanggal2 = document.createElement("div");
  showTanggal2.classList.add("show-tanggal2");
  showTanggal2.innerText = `Tanggal : ${history_dict.tanggal_user2}`;
  
  box.append(namaPlayer1, namaPlayer2, boxDalam, boxDalam2, showVsHistory, skorHistory1, skorHistory2, showDetik, showDetik2, showTanggal, showTanggal2);
  container.appendChild(box);
  document.body.appendChild(container);
}


















  </script>
</body>

</html>