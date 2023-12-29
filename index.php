<?php
include_once 'database.php';

$database = new Database();
$conn = $database->getConnection();

// Memproses penghapusan data
if (isset($_GET['delete_id'])) {
    $idToDelete = $_GET['delete_id'];

    $sqlDelete = "DELETE FROM radcheck WHERE id = :id";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bindParam(':id', $idToDelete, PDO::PARAM_INT);

    if ($stmtDelete->execute()) {
        echo "Data berhasil dihapus!";
        header("refresh:3;url=http://localhost/Radiusjenius/index.php");
        exit();
    } else {
        echo "Error saat menghapus data: " . $stmtDelete->errorInfo()[2];
    }
}

// Menampilkan data dalam bentuk tabel HTML
$sqlGetData = "SELECT * FROM radcheck";
$result = $conn->query($sqlGetData);

echo "<table border='1'>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Attribute</th>
            <th>Operator</th>
            <th>Value</th>
            <th>Aksi</th>
        </tr>";

if ($result->rowCount() > 0) {
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['attribute']}</td>
                <td>{$row['op']}</td>
                <td>{$row['value']}</td>
                <td>
                    <a href='edit.php?id={$row['id']}'>Edit</a>
                    <a href='index.php?delete_id={$row['id']}'>Hapus</a>
                </td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data dalam tabel radcheck.";
}

// Menutup koneksi
$conn = null;
