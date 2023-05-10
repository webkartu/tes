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
$picked_lawan= $_GET['kartu-lawan'];
$lawan_picked = $_GET['nama-lawan'];



$url = "arena2.php?" . http_build_query(array(
  "nama-lawan" => $lawan_picked,
  "data" => $picked,
  "dataOverall" => $picked_ovr,
  "kartu-lawan" => $picked_lawan,


));

$sql_updatePlay = "UPDATE list_yang_main SET playing = 'yes',enemy = '$lawan_picked',kartu_enemy='$picked_lawan' WHERE username = '$yang_login'";
$result_play = mysqli_query($conn,$sql_updatePlay);

$sql_search = "SELECT COUNT(*) AS jumlah
FROM list_yang_main 
WHERE username = '$lawan_picked' 
  AND ready = 'yes' 
  AND playing = 'yes' 
  AND picked_card = '$picked_lawan'
  AND enemy ='$yang_login'
  AND kartu_enemy ='$picked'


";

$result = mysqli_query($conn, $sql_search);
$row = mysqli_fetch_assoc($result);
$jumlah_pemain_siap = $row['jumlah'];

if ($jumlah_pemain_siap > 0) {
  
 
  echo "<script>window.location.href='".$url."'</script>";
  exit;
} else {
  
 
 
  echo '<meta http-equiv="refresh" content="1">';
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
<body >
  
<div class="show-loading">
  MENUNGGU LAWAN . . .</div>
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