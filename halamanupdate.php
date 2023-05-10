<?php
require "koneksi.php";
session_start();
if ($_SESSION["username"]=="login_dulu"){
    header("Location: login.php");
  }
  if ($_SESSION["username"]!="admin"){
    header("Location: login.php");
  }
$id_kartu = $_GET["id"];


for($i = 1; $i <= 12; $i++) {
 
    if($id_kartu==$i){
        echo "<script>alert('Anda Tidak Dapat Menghapus Data Bawaan ( 1 - 12 )'); window.location.href = 'adminhome.php';</script>";
        exit;
    }

}
$query = "SELECT * FROM tabel_kartu WHERE id = '$id_kartu'";
$result = mysqli_query($conn,$query);

function ubah($data){
    global $conn;
    $kartuPicked = $_GET['kartu'];
    $id = $_POST["id"];
    $nama = $_POST["nama_kartu"];
    $overall = $_POST["overall"];
    $link = $_POST["link"];
    $query_update= "UPDATE tabel_kartu SET nama_kartu = '$nama',overall = $overall,link = '$link' WHERE id = $id"; 
    
    mysqli_query($conn,$query_update);
    $query_update_history1= "UPDATE tes_history SET kartu_user = '$nama'  WHERE kartu_user =  '$kartuPicked'"; 
    $query_update_history2= "UPDATE tes_history SET kartu_lawan = '$nama'  WHERE kartu_lawan =  '$kartuPicked'"; 
    
    mysqli_query($conn,$query_update_history1);
    mysqli_query($conn,$query_update_history2);

    $namaUsers = "SELECT username FROM users";
$result_userName = mysqli_query($conn, $namaUsers);
$userNames = array();
if (mysqli_num_rows($result_userName) > 0) {
    while ($row = mysqli_fetch_assoc($result_userName)) {
        $userNames[] = $row["username"];
    }
}

foreach ($userNames as $username) {
    $queryUpdateOvr = "UPDATE $username 
    INNER JOIN tabel_kartu ON $username.kartu = tabel_kartu.nama_kartu 
    SET $username.overall = tabel_kartu.overall
    WHERE $username.kartu = '$kartuPicked'";

    mysqli_query($conn, $queryUpdateOvr);

    $queryUpdateKartu = "UPDATE $username SET kartu ='$nama' where kartu = '$kartuPicked'";
    

    mysqli_query($conn, $queryUpdateKartu);
    
    $sql_update_link = "UPDATE $username
    JOIN tabel_kartu ON  $username.kartu = tabel_kartu.nama_kartu
    SET  $username.link = tabel_kartu.link
    ";
    $hasil_link = mysqli_query($conn, $sql_update_link);
   
}

return mysqli_affected_rows($conn);


}
if (isset($_POST["update"])){

    if (ubah($_POST) > 0) {
        echo "<script>alert('Update Data Berhasil');</script>";
        header("Location: adminhome.php");
    } else {
        echo "<script>alert('Update Data Gagal');</script>";
        header("Location: adminhome.php");
    }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body id="halaman_admin">

<header id="header_arena">
        <nav>
          <ul>
            <li><a class="animate__animated animate__fadeInUp" href="index.php" id="log_out">Keluar</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="adminhome.php" id="hal-arena">Update</a></li>
            <li><a class= "animate__animated animate__fadeInUp"href="deletehome.php" >Delete</a></li>
          </ul>
        </nav>
    </header>
    <main>
<div class="updt">UPDATE DATA</div>
    <form class="animate__animated animate__fadeInUp" action="" method="post">
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <input type="hidden" name="id" value="<?= $row['id']?>"> 
        <label for="nama_kartu">Nama Kartu :</label>
        <input type="text" name="nama_kartu" value="<?= $row['nama_kartu']?>"style="color: black;"required>
        <label for="overall">Overall:</label>
         <input type="text" name="overall" value="<?= $row['overall']?>"style="color: black;" required>
         <label for="link">Link Gambar:</label>
        <input type="text" name="link" value="<?= $row['link']?>">
        <br>
        <input value="Confirm" type="submit" name="update">
            <?php endwhile?>

    </form>
    </main>
</body>
</html>

		 