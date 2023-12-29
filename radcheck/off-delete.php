<?php
// Ambil parameter ID dari URL
$id = isset($_GET['id']) ? $_GET['id'] : die('ID tidak ditemukan.');

// Sertakan file konfigurasi database
include_once 'config/database.php';

// Sertakan objek radcheck
include_once 'objects/radcheck.php';

// Inisialisasi objek Database
$database = new Database();
$db = $database->getConnection();

// Inisialisasi objek Radcheck
$radcheck = new Radcheck($db);

// Set ID properti untuk dihapus
$radcheck->id = $id;

// Baca detail satu entri radcheck berdasarkan ID
$radcheck->readOne();

// Periksa apakah data ditemukan
if ($radcheck->username != null) {
    // Mulai HTML
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Hapus Data</title>
    </head>
    <body>
        <h2>Konfirmasi Hapus Data</h2>
        <p>Apakah Anda yakin ingin menghapus data ini?</p>
        <form action='delete_confirm.php' method='post'>
            <input type='hidden' name='id' value='{$radcheck->id}'>
            <input type='submit' value='Ya'>
            <a href='index.php'>Tidak</a>
        </form>
    </body>
    </html>";
} else {
    echo 'Data tidak ditemukan.';
}
?>
