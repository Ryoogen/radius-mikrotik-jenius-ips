<?php
include 'koneksi.php';

// Ambil nilai dari formulir
$pppoeUser = $_POST['pppoeUser'];
$pppoePassword = $_POST['pppoePassword'];
$selectedProfile = $_POST['profile'];
$expirationDate = $_POST['expirationDate'];

// Mengubah format tanggal
$formattedExpirationDate = date('d M Y', strtotime($expirationDate));

// Tambahkan data ke tabel radcheck
$sqlInsertData = "
    INSERT INTO radcheck (username, attribute, op, value)
    VALUES
        ('$pppoeUser', 'Cleartext-Password', ':=', '$pppoePassword'),
        ('$pppoeUser', 'User-Profile', ':=', '$selectedProfile'),
        ('$pppoeUser', 'Expiration', ':=', '$formattedExpirationDate')
";

if ($conn->query($sqlInsertData) === TRUE) {
    // Menampilkan pemberitahuan berhasil
    echo "Data berhasil ditambahkan ke tabel 'radcheck'. Akan mengalihkan kembali dalam 3 detik...";

    // Menutup koneksi
    $conn->close();

    // Menunggu 3 detik
    header("refresh:3;url=http://localhost/ConRadius/radcheck/form2.html");
    exit();
} else {
    echo "Error saat menambahkan data: " . $conn->error;
}

// Menutup koneksi
$conn->close();
?>
