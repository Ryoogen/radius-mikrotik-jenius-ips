<?php
include_once 'database.php';


// Membuat objek Database
$database = new Database();
$conn = $database->getConnection();

if ($_POST) {
    try {
        // Menangkap data dari formulir
        $pppoeUser = $_POST['pppoeUser'];
        $pppoePassword = $_POST['pppoePassword'];
        $selectedProfile = $_POST['profile'];
        $expirationDate = $_POST['expirationDate'];

        // Menambahkan data ke tabel radcheck
        $sqlInsertData = "INSERT INTO radcheck (username, attribute, op, value) VALUES ('$pppoeUser', 'Cleartext-Password', ':=', '$pppoePassword')";
        $conn->query($sqlInsertData);

        $sqlInsertData = "INSERT INTO radcheck (username, attribute, op, value) VALUES ('$pppoeUser', 'User-Profile', ':=', '$selectedProfile')";
        $conn->query($sqlInsertData);

        $formattedExpirationDate = date('Y-m-d', strtotime($expirationDate));
        $sqlInsertData = "INSERT INTO radcheck (username, attribute, op, value) VALUES ('$pppoeUser', 'Expiration', ':=', '$formattedExpirationDate')";
        $conn->query($sqlInsertData);

        // Menampilkan pemberitahuan berhasil
        echo "Data berhasil ditambahkan ke tabel 'radcheck'. Akan mengalihkan kembali dalam 3 detik...";

	// Menutup koneksi
	$database->conn = null;

	// Menunggu 3 detik
	header("refresh:3;url=http://localhost/Radiusjenius/form.html");
	exit(); // Penting untuk memastikan tidak ada kode ekstra yang dijalankan setelah header
    } catch (PDOException $e) {
        echo "Error saat menambahkan data: " . $e->getMessage();
    }
}
?>

