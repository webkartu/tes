<?php

require "koneksi.php";
session_start();
if ($_SESSION["username"]=="login_dulu"){
  header("Location: login.php");
}
$kartu_lawan= $_SESSION["cardLawan"];
$nama_lawan =$_SESSION["namaLawan"];
$_SESSION["bermain"]="selesai";
$done = $_SESSION["bermain"];
$yang_login = $_SESSION["username"];
$kartu_user = $_SESSION["kartu_user"];

$skor = isset($_GET['skor']) ? intval($_GET['skor']) : 99999999999999;



$date = date('Y-m-d H:i:s');
$tanggal = date('Y-m-d');
$jam = date('H:i:s');

$sql_update_skor = "UPDATE tes_history SET jam ='$jam',tanggal='$tanggal', skor = $skor,kondisi = '$done'  WHERE user = '$yang_login' AND nama_lawan ='$nama_lawan' AND kartu_user = '$kartu_user' AND kartu_lawan = '$kartu_lawan' AND kondisi = 'belum' AND skor !=99999999999999";
$result = mysqli_query($conn,$sql_update_skor);

$sqlUpdateReady1 = "UPDATE list_yang_main set ready = 'no' where username = '$yang_login'";

$sqlUpdateReady3 = "UPDATE list_yang_main set playing = 'no' where username = '$yang_login'";

mysqli_query($conn,$sqlUpdateReady1);

mysqli_query($conn,$sqlUpdateReady3);

$sql = "SELECT DISTINCT h1.user AS user1, h2.user AS user2, h1.kartu_user AS kartu_user1, h2.kartu_user AS kartu_user2, h1.skor AS skor1, h2.skor AS skor2
        FROM tes_history h1
        JOIN tes_history h2 ON h1.user = h2.nama_lawan AND h1.nama_lawan = h2.user AND h1.kartu_user = h2.kartu_lawan AND h1.kartu_lawan = h2.kartu_user
        WHERE h1.kondisi = 'selesai' AND h2.kondisi = 'selesai'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $history_result= array();
  while($row = $result->fetch_assoc()) {
    $history_result[] = array(
      "user1" => $row["user1"],
      "user2" => $row["user2"],
      "kartu_user1" => $row["kartu_user1"],
      "kartu_user2" => $row["kartu_user2"],
      "skor1" => $row["skor1"],
      "skor2" => $row["skor2"]
    );
  }
  $_SESSION["history"] =  $history_result;
} else {
  echo "Tidak ada data yang ditemukan";
}

$sql_search = "SELECT COUNT(*) AS jumlah
FROM list_yang_main 
WHERE username = '$nama_lawan' 
  AND ready = 'no' 
  AND playing = 'no' 
  AND picked_card = '$kartu_lawan'
  AND enemy ='$yang_login'
  AND kartu_enemy ='$kartu_user'


";

$result = mysqli_query($conn, $sql_search);
$row = mysqli_fetch_assoc($result);
$jumlah_pemain_siap = $row['jumlah'];

if ($jumlah_pemain_siap > 0) {
  
 
  echo "<script>window.location.href = 'duelselesai.php';</script>";

  exit;
} else {
  
 
 
  echo '<meta http-equiv="refresh" content="1">';
}



// $reset_update = "UPDATE list_yang_main SET ready ='no' where username = '$yang_login'";
// $conn->query($reset_update);
// header('Location: history2.php');

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
<body >
  
<div class="show-loading">
 MENUNGGU LAWAN MENYELESAIKAN PERTANDINGAN  . . .</div>
</body halaman_game>

<style>
  .show-loading {

    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(255, 255, 255, 0.8);
    padding: 20px;
    border-radius: 10px;
    font-size: 24px;
    font-weight: bold;
    color: #333;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    z-index: 9999;
  }
</style>
</html>