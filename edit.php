<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Radcheck</title>
    <!-- Tambahkan link Bootstrap di sini jika belum ada -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        form {
            max-width: 500px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <?php
    include_once 'database.php';

    // Membuat objek Database
    $database = new Database();
    $conn = $database->getConnection();

    if ($_POST) {
        try {
            // Update data berdasarkan ID
            $id = $_POST['id'];
            $username = $_POST['username'];
            $attribute = $_POST['attribute'];
            $op = $_POST['op'];
            $value = $_POST['value'];

            $stmt = $conn->prepare('UPDATE radcheck SET username = ?, attribute = ?, op = ?, value = ? WHERE id = ?');
            $stmt->bindParam(1, $username);
            $stmt->bindParam(2, $attribute);
            $stmt->bindParam(3, $op);
            $stmt->bindParam(4, $value);
            $stmt->bindParam(5, $id);
            $stmt->execute();

            echo '<div class="alert alert-success" role="alert">
                    Data berhasil diupdate! Akan mengalihkan kembali dalam 3 detik...
                </div>';

            // Menambahkan skrip JavaScript untuk mengalihkan kembali setelah beberapa detik
            echo '<script>
                    setTimeout(function(){
                        window.location.href = "edit.php?id=' . $id . '";
                    }, 3000);
                </script>';
        } catch (PDOException $e) {
            echo '<div class="alert alert-danger" role="alert">
                    Error: ' . $e->getMessage() . '
                </div>';
        }
    } else {
        // Menampilkan formulir edit
        $id = isset($_GET['id']) ? $_GET['id'] : die('ID tidak ditemukan.');

        $stmt = $conn->prepare('SELECT * FROM radcheck WHERE id = ?');
        $stmt->bindParam(1, $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            die('ID tidak ditemukan.');
        }

        // Tampilkan formulir edit
    ?>

            <div class="container mx-auto text-center">
              <h2 class="mb-4">Edit Data Radcheck</h2>
            </div>

            <!-- ... (sisa konten) ... -->
            </div>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" class="form-control" value="<?php echo $row['username']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="attribute">Attribute:</label>
                    <input type="text" id="attribute" name="attribute" class="form-control" value="<?php echo $row['attribute']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="op">Operator:</label>
                    <input type="text" id="op" name="op" class="form-control" value="<?php echo $row['op']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="value">Value:</label>
                    <input type="text" id="value" name="value" class="form-control" value="<?php echo $row['value']; ?>" required>
                </div>
                <input type="submit" value="Update Data" class="btn btn-primary">
            </form>
        </div>
    <?php
    }
    ?>

    <!-- Tambahkan script Bootstrap jika belum ada -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
