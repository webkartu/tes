<?php
// Daftar nama
$nama = array("Andi", "Budi", "Cindy", "Dodi", "Eka");

// Hitung jumlah elemen dalam array
$jumlah = count($nama);

// Pilih elemen acak dari array
$acak = rand(0, $jumlah-1);
$pilihan = $nama[$acak];

// Tampilkan nama yang dipilih
echo "Nama yang dipilih secara acak adalah: " . $pilihan;
?>
