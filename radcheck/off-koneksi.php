<?php
// Ganti informasi koneksi berikut sesuai dengan server MySQL Anda
$host = '103.234.31.22';
$username = 'root';
$password = 'Rudy123!!';
$database = 'radiusdb';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
