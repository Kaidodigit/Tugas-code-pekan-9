<?php
$host = "localhost"; // Server database (di Laragon selalu localhost)
$user = "root";      // Username bawaan Laragon
$pass = "";          // Password bawaan Laragon (dikosongkan saja)
$db   = "db_armada";    // GANTI dengan nama database yang kamu buat di phpMyAdmin tadi

// Membuat koneksi ke database
$conn = mysqli_connect($host, $user, $pass, $db);

// Mengecek apakah koneksi berhasil
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>