<?php
include "koneksi.php";

session_start();
$_SESSION['username'] = "login_dulu";
$yang_login = $_SESSION["username"];
if(isset($_POST['regis_submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    if($result->num_rows > 0){
        echo "<script>alert('Akun Dengan Username tersebut sudah terdaftar');</script>";
    } else {
        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        $result = mysqli_query($conn, $sql);
        if($result){
            $sql_create = "CREATE TABLE $username (
                id int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                kartu varchar(50),
                overall int(10),
                link varchar(500)
              )";
            $sql_create;
            $hasil = mysqli_query($conn,$sql_create);
            $hasil;
            echo "<script>alert('Selamat Akun Berhasil di Daftarkan');
            
            </script>";
        } else {
           
        }
    }
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Game Koleksi Kartu</title>
</head>

<body id="halaman_register">
    <header id="header_register">
        <nav>
            <ul>
              <li><a class="animate__animated animate__fadeInUp" href="index.php">Home</a></li>
              <li><a class="animate__animated animate__fadeInUp" href="login.php" id="login_button_regis">Login</a></li>
              <li><a class="animate__animated animate__fadeInUp" href="register.php" id="register_button">Register</a></li>
            </ul>
          </nav>
        </header>

        <main>
            <form class="animate__animated animate__fadeInUp" id="register-form" action="" method="post">
                <label for="username">Username:</label>
                <input type="text" id="register_username" name="username" required>
                <label for="password">Password:</label>
                <input type="password" id="register_password" name="password" required>
                <label for="showpass">Tampilkan Password</label>
                <input type = "checkbox" id="showpass">
                <input type="submit"value="DAFTAR" id="tombol_regis" name="regis_submit">
                <p>Sudah Punya Akun ? <a href="login.php">Login</a></p>
           </form>
           <div id="kotak_masuk">
            <div><button id="kotak_batal">X</button></div>
            <div id="kotak_masuk_kalimat">
                <p id="judul">SYARAT DAN KETENTUAN</p>
                <p>Game Koleksi Kartu merupakan game yang hanya bisa dimainkan oleh pengguna yang telah mendaftar dan memiliki akun resmi.
                    Setiap pengguna bertanggung jawab atas keamanan akun mereka. 
                <br> Pengguna dilarang untuk memberikan informasi akun mereka, seperti password dan email, kepada pihak lain.                      

                <br>  Syarat dan ketentuan ini dapat berubah sewaktu-waktu tanpa pemberitahuan terlebih dahulu. Pengguna diharapkan untuk memperhatikan dan mengikuti setiap perubahan yang terjadi.
                <br>
                <br> Dengan menyetujui syarat dan ketentuan ini, pengguna dianggap telah membaca dan memahami setiap isi yang terkandung di dalamnya
                    </p>
               
                
                   
            </div>
            <div id="select_box_container" class="animate__animated animate__fadeInUp" >
                <select id="select_box">
                    <option value="ya">Setuju</option>
                    <option value="tidak">Tidak Setuju</option>
                </select>
                <input type="submit" value="Confirm" id="confirm_button" >
            </div>
        </div>
        </main>

</body>
<script>
    const checkbox = document.getElementById("showpass");
const passwordField = document.getElementById("register_password");

checkbox.addEventListener('change', function() {
  if (this.checked) {
    passwordField.type = "text";
  } else {
    passwordField.type = "password";
  }
});

</script>
</html>
