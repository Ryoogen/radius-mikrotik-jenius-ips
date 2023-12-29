<!-- edit.php -->
<!-- ... Bagian-bagian form sebelumnya ... -->

<!-- Form Edit -->
<form action="update.php" method="post">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    Field 1: <input type="text" name="field1" value="<?php echo $row['field1']; ?>"><br>
    Field 2: <input type="text" name="field2" value="<?php echo $row['field2']; ?>"><br>
    <!-- Tambahkan field sesuai dengan struktur tabel Anda -->
    <input type="submit" value="Update">
</form>

<!-- ... Bagian-bagian form setelahnya ... -->
