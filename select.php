<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Radcheck</title>
    <!-- Tambahkan link Bootstrap di sini jika belum ada -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        table {
            width: 100%;
        }

        th, td {
            text-align: center;
        }

        .action-buttons a {
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <h2 class="mb-4">Data Radcheck</h2>

    <?php
    include_once 'database.php';

    // Membuat objek Database
    $database = new Database();
    $conn = $database->getConnection();

    // Mengambil data dari tabel radcheck
    $sqlGetData = "SELECT * FROM radcheck";
    $stmt = $conn->prepare($sqlGetData);
    $stmt->execute();
    ?>

    <table class="table table-bordered">
        <thead class="thead-light">
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Attribute</th>
                <th>Operator</th>
                <th>Value</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>

            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['attribute']}</td>
                        <td>{$row['op']}</td>
                        <td>{$row['value']}</td>
                        <td class='action-buttons'>
                            <a href='javascript:void(0);' class='btn btn-danger' onclick='konfirmasiHapus(" . $row['id'] . ", \"" . $row['username'] . "\");'>Hapus</a>
                            <a href='edit.php?id=" . $row['id'] . "' class='btn btn-primary'>Edit</a>
                        </td>
                    </tr>";
            }
            ?>

        </tbody>
    </table>

    <script>
        function konfirmasiHapus(id, username) {
            var konfirmasi = confirm("Apakah Anda yakin ingin menghapus user '" + username + "'?");
            if (konfirmasi) {
                window.location.href = 'hapus.php?id=' + id;
            }
        }
    </script>

    <!-- Tambahkan script Bootstrap jika belum ada -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
