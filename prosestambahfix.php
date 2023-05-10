<?php
require "koneksi.php";
session_start();
if ($_SESSION["username"]=="login_dulu"){
    header("Location: login.php");
  }
  if ($_SESSION["username"]!="owner"){
    header("Location: login.php");
  }
$yang_login = $_GET["user_name"];
$kartu = $_GET["data"];
$overall = $_GET["dataOvr"];



$sqlInsert="INSERT INTO $yang_login (kartu,overall) VALUES ('$kartu',$overall)";
$result = mysqli_query($conn,$sqlInsert);
if($result){
    $sql_update_link = "UPDATE $yang_login
    JOIN tabel_kartu ON  $yang_login.kartu = tabel_kartu.nama_kartu
    SET  $yang_login.link = tabel_kartu.link
    ";
    $hasil_link = mysqli_query($conn, $sql_update_link);
    echo "<script>alert('Tambah Data Berhasil');</script>";
    header("Location: ownertambah.php?user_name=".$yang_login);

    exit(); 
} else {
    echo "<script>alert('Tambah Data Gagal');</script>";
}

?>