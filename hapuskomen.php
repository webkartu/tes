<?php
require "koneksi.php";
session_start();
if ($_SESSION["username"]=="login_dulu"){
  header("Location: login.php");
}
if ($_SESSION["username"]!="owner"){
  header("Location: login.php");
}
$id = $_GET["id"];

if($id){
    $query = "DELETE FROM pesan WHERE id=$id";
    mysqli_query($conn,$query);

    echo "<script>
    alert('berhasil hapus');
    document.location.href = 'ownerhome.php';
    </script>";
}

?>