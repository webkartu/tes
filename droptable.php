<?php

require "koneksi.php";
$sql = "SHOW TABLES LIKE 'history%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Menjalankan query untuk menghapus setiap tabel
  while($row = $result->fetch_row()) {
    $tableName = $row[0];
    $sql = "DROP TABLE IF EXISTS $tableName";
    if ($conn->query($sql) === TRUE) {
      echo "Tabel $tableName berhasil dihapus <br>";
    } else {
      echo "Error menghapus tabel $tableName: " . $conn->error . "<br>";
    }
  }
} else {
  echo "Tidak ada tabel yang ditemukan";
}


?>
