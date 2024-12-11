<?php
// Memulai sesi jika belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Menampilkan seluruh data yang ada di dalam session
echo '<pre>';
print_r($_SESSION); // Menampilkan data sesi dengan format yang lebih mudah dibaca
echo '</pre>';

// Atau menggunakan var_dump() untuk menampilkan lebih detail
// var_dump($_SESSION);
?>
