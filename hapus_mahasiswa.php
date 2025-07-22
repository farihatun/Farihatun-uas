<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Gunakan prepared statement agar lebih aman
    $stmt = $conn->prepare("DELETE FROM tbl_mahasiswa WHERE idMhs = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: index.php");
exit;
?>
