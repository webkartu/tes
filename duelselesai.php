<?php

require "koneksi.php";
session_start();
if ($_SESSION["username"] == "login_dulu") {
    header("Location: login.php");
    exit; 
}

$kartu_lawan = $_SESSION["cardLawan"];
$nama_lawan = $_SESSION["namaLawan"];
$_SESSION["bermain"] = "selesai";
$done = $_SESSION["bermain"];
$yang_login = $_SESSION["username"];
$kartu_user = $_SESSION["kartu_user"];

$sqlWin = "SELECT @id:=@id+1 as id, h1.user AS user1, h2.user AS user2, h1.kartu_user AS kartu_user1, h2.kartu_user AS kartu_user2, h1.skor AS skor1, h2.skor AS skor2, h1.jam AS jam_user1, h2.jam AS jam_user2, h1.tanggal AS tanggal_user1, h2.tanggal AS tanggal_user2
FROM tes_history h1
JOIN tes_history h2 ON h1.user = h2.nama_lawan AND h1.nama_lawan = h2.user AND h1.kartu_user = h2.kartu_lawan AND h1.kartu_lawan = h2.kartu_user, (SELECT @id:=0) as t
WHERE h1.kondisi = 'selesai' AND h2.kondisi = 'selesai' AND h1.skor < h2.skor";

$resultWin = mysqli_query($conn, $sqlWin);

$foundWinner = false; 

while ($data = mysqli_fetch_assoc($resultWin)) {
    $yangWin = $data['user1'];
    $yangLose = $data['user2'];
    $kartuUser = $data['kartu_user1'];
    $kartuLawan = $data['kartu_user2'];
    
    if ($yang_login == $yangWin && $nama_lawan == $yangLose && $kartu_user == $kartuUser && $kartu_lawan == $kartuLawan) {
        $foundWinner = true;
        echo $yangWin;
        $sqlToken="UPDATE users SET token = token + 100 WHERE username =  '$yangWin'";
        $resultToken = mysqli_query($conn, $sqlToken);
        
        echo "<script>window.location.href = 'history2.php';</script>";
        break; 
    }
}

if (!$foundWinner) {
    echo "<script>window.location.href = 'history2.php';</script>";
}

?>
