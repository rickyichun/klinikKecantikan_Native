<?php
$servername = "localhost";
$database = "klinik";
$username = "root";
$password = "";

// untuk tulisan bercetak tebal silakan sesuaikan dengan detail database Anda
// membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $database);
date_default_timezone_set('Asia/Jakarta');
$datetime = date("Y-m-d H:i:s");

// mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>