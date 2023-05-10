// Menentukan konfigurasi koneksi database
var config = {
  host: "localhost",
  user: "username",
  password: "password",
  database: "database_name"
};

// Membuat koneksi database
var mysql = require('mysql');
var connection = mysql.createConnection(config);

// Membuat array untuk menampung hasil query
var results = [];

// Mengambil nilai dari setiap tabel
for (var i = 1; i <= 10; i++) {
  var tableName = `tabel${i}`; // Membuat nama tabel dinamis
  connection.query(`SELECT * FROM ${tableName}`, function(error, rows, fields) {
    if (error) {
      throw error;
    }
    // Menambahkan hasil query ke dalam array results
    results.push(rows);
    // Menutup koneksi database jika query terakhir telah selesai
    if (results.length === 10) {
      connection.end();
      // Lakukan sesuatu dengan nilai-nilai yang telah diambil
      console.log(results);
    }
  });
}

$sql = "SELECT username, picked_card, skor, 'selesai' as status
FROM history92
WHERE selesai = 'selesai'
AND NOT EXISTS (
  SELECT 1
  FROM history93
  WHERE username = history92.username
  AND picked_card = history92.picked_card
  AND selesai = 'selesai'
)
UNION
SELECT username, picked_card, skor, 'selesai' as status
FROM history93
WHERE selesai = 'selesai'
AND NOT EXISTS (
  SELECT 1
  FROM history92
  WHERE username = history93.username
  AND picked_card = history93.picked_card
  AND selesai = 'selesai'
)";

// Menjalankan query
$result = $conn->query($sql);

// Memeriksa hasil query
if ($result->num_rows > 0) {
    // Menampilkan hasil
    while($row = $result->fetch_assoc()) {
        echo "Username: " . $row["username"]. " - Picked Card: " . $row["picked_card"]. " - Skor: " . $row["skor"]. " - Status: " . $row["status"]. "<br>";
    }
} else {
    echo "Tidak ada data yang ditemukan";
}

SELECT username, picked_card, skor, 'selesai' as status
FROM history1
WHERE selesai = 'belum'
AND NOT EXISTS (
  SELECT 1
  FROM history3
  WHERE username = history1.username
  AND picked_card = history1.picked_card
  AND selesai = 'selesai'
)
UNION
SELECT username, picked_card, skor, 'selesai' as status
FROM history3
WHERE selesai = 'selesai'
AND NOT EXISTS (
  SELECT 1
  FROM history1
  WHERE username = history3.username
  AND picked_card = history3.picked_card
  AND selesai = 'belum'
);



document.location.href = 'halamandelete.php?data=$picked&dataId=$idKartu&user_name=$yang_login' ;


<?php 
    
    while($row1 = mysqli_fetch_assoc($result2)) { ?>
  
    const newImg = document.createElement('img');

// Memberi class dan style pada elemen img
  newImg.classList.add('animate__animated', 'animate__fadeInUp');
  newImg.setAttribute('src', 'tes');
newImg.setAttribute('alt', '<?php echo $row1["nama_kartu"]?>');
newImg.style.display = 'none';

const container111 = document.querySelector('.list-kartu');
container111.appendChild(newImg);

   
<?php ?>
  <?php } ?>


  <?php
require "koneksi.php";
session_start();
if ($_SESSION["username"]=="login_dulu"){
  header("Location: login.php");
}
$_SESSION["gachaIsTrue"]="false";     
$yang_login = $_SESSION["username"];
$sql = "SELECT * FROM $yang_login";
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

$sql_listKartu = "SELECT * FROM tabel_kartu";
$result1 = $conn->query($sql_listKartu);
if ($result1) {
  $data_kartu = array();
  while($row = $result1->fetch_assoc()) {
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
       <div> <h2 class="animate__animated animate__fadeInUp" id="judul_koleksi">KOLEKSI KARTU ANDA</h2></div>
        
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
        <div class="container_koleksi animate__animated animate__fadeInUp">
        </div>
          
      </main>

</body>
<script>
const container = document.querySelector('.container_koleksi');
const allCards = <?php echo json_encode($_SESSION["cards"]); ?> || [];
const numOfCards = allCards.length;
const radioBox = document.getElementsByName('sort');

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

  const card = allCards[i];
  const imageElement = document.createElement('img');
  imageElement.setAttribute('id', `img${i+1}`);
  imageElement.setAttribute('src', '');
  
  imageContainer.appendChild(imageElement);
  container.appendChild(imageContainer);
}


function tampilKartu(){
  for (let i = 0; i < allCards.length; i++) {
  
  const card = allCards[i];
 
  if(card.link){
    
    const containerListKartu = document.querySelector('.list-kartu');
    const newImg = document.createElement('img');
    newImg.classList.add('animate__animated', 'animate__fadeInUp');
    newImg.setAttribute('src', card.link);
    newImg.setAttribute('alt', card.kartu);
    newImg.style.display = 'none';
    
    containerListKartu.appendChild(newImg);
 
    }
  const altValue = card.kartu;
  
  const imgElement = document.querySelector(`img[alt="${altValue}"]`);
  
  if (imgElement) {
    const srcName = imgElement.getAttribute('alt');
    console.log(srcName);
    const srcValue = imgElement.getAttribute('src');
    console.log(srcValue);
    const srcId = imgElement.getAttribute('id');
    console.log(srcValue);
    const imgId = `img${card.id}`;
    console.log(imgId);
    
    
    const targetImgElement = document.getElementById(imgId);
    
    if (targetImgElement) {
      targetImgElement.setAttribute('src', srcValue);
     
    }
  }
}}
tampilKartu();

radioBox.forEach(radio => {
  radio.addEventListener('change', sortCards);

});

document.addEventListener('copy', function(event) {
  event.preventDefault();
  
});

document.addEventListener('selectstart', function(e) {
  e.preventDefault();
});
document.getElementById("log_out").addEventListener("click", function(event){
			event.preventDefault();
			var result = confirm("Apakah Anda yakin ingin meninggalkan permainan?");
			if (result) {
				window.location.href = "index.php";
			}
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

</script>
</html>