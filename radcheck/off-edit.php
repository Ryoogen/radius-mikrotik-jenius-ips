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
        <title>Edit Data</title>
    </head>
    <body>
        <h2>Edit Data Radcheck</h2>
        <form action='update.php' method='post'>
            <input type='hidden' name='id' value='{$radcheck->id}'>
            <label for='username'>Username:</label>
            <input type='text' id='username' name='username' value='{$radcheck->username}' required>
            <br>
            <label for='attribute'>Attribute:</label>
            <input type='text' id='attribute' name='attribute' value='{$radcheck->attribute}' required>
            <br>
            <label for='op'>Operator:</label>
            <input type='text' id='op' name='op' value='{$radcheck->op}' required>
            <br>
            <label for='value'>Value:</label>
            <input type='text' id='value' name='value' value='{$radcheck->value}' required>
            <br>
            <input type='submit' value='Update'>
        </form>
    </body>
    </html>";
} else {
    echo 'Data tidak ditemukan.';
}
?>
