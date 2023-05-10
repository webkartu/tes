<?php
require "koneksi.php";
session_start();
if ($_SESSION["username"]=="login_dulu"){
  header("Location: login.php");
}
if ($_SESSION["username"]!="admin"){
  header("Location: login.php");
}
$yang_login = $_GET["user_name"];
$picked = $_GET['data'];
$idKartu = $_GET['dataId'];
$_SESSION["kartu_user"] = $picked;
$sql = "SELECT * FROM $yang_login WHERE id = $idKartu AND kartu = '$picked'";
$result = $conn->query($sql);
if ($result->num_rows == 0) {
    
    header("Location: deletehome.php");
    exit();
  }
  if($idKartu){
    $query = "DELETE FROM $yang_login WHERE id='$idKartu'";
    mysqli_query($conn,$query);

    echo "<script>
    alert('berhasil hapus');
    document.location.href = 'halamandelete.php?user_name=$yang_login';
    </script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <script>


console.log("halo");
  </script>
</body>
</html>

