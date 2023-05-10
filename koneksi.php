<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "pa_pokemon";

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}else{
  
}
