<?php
include_once 'database.php';

// Membuat objek Database
$database = new Database();
$conn = $database->getConnection();

// Memeriksa apakah parameter ID diterima
$id = isset($_GET['id']) ? $_GET['id'] : die('ID tidak ditemukan.');

// Menghapus data dari tabel radcheck
$stmt = $conn->prepare('DELETE FROM radcheck WHERE id = ?');
$stmt->bindParam(1, $id);

if ($stmt->execute()) {
    echo 'Data berhasil dihapus! Akan mengalihkan kembali dalam 3 detik...';
    header("refresh:3;url=http://localhost/Radiusjenius/select.php");
} else {
    echo 'Error saat menghapus data: ' . $stmt->error;
}

// Menutup koneksi
$conn = null;
?>
