<?php
include 'koneksi.php';

// Mengambil data dari tabel radcheck
$sqlGetData = "SELECT * FROM radcheck";
$result = $conn->query($sqlGetData);

// Menampilkan data dalam bentuk tabel HTML
echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Attribute</th>
            <th>Operator</th>
            <th>Value</th>
            <th>Aksi</th> <!-- Tambahkan kolom untuk tombol aksi -->
        </tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['username'] . "</td>
                <td>" . $row['attribute'] . "</td>
                <td>" . $row['op'] . "</td>
                <td>" . $row['value'] . "</td>
                <td>
                    <a href='edit.php?id=" . $row['id'] . "'>Edit</a> |
                    <a href='delete.php?id=" . $row['id'] . "'>Hapus</a>
                </td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data dalam tabel radcheck.";
}

// Menutup koneksi
$conn->close();
?>
