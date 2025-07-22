<?php
include 'koneksi.php';

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM tbl_mahasiswa WHERE idMhs = $id");
$data = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $nohp = $_POST['nohp'];

    $stmt = $conn->prepare("UPDATE tbl_mahasiswa SET npm=?, nama=?, prodi=?, nohp=? WHERE idMhs=?");
    $stmt->bind_param("ssssi", $npm, $nama, $prodi, $nohp, $id);
    $stmt->execute();

    header("Location: data_mahasiswa.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #eafff0;
        }
        .navbar {
            background-color: #006400;
        }
        .navbar-brand, .nav-link, .navbar-text {
            color: white !important;
        }
        .container {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 0 15px rgba(0, 128, 0, 0.2);
            margin-top: 40px;
        }
        h3 {
            color: #006400;
        }
        .btn-primary {
            background-color: #006400;
            border-color: #006400;
        }
        .btn-secondary {
            background-color: #90ee90;
            border-color: #90ee90;
            color: black;
        }
        .btn-secondary:hover {
            background-color: #7bd67b;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg mb-4">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><i class="bi bi-mortarboard-fill"></i> Sistem Mahasiswa</a>
    <div class="d-flex">
        
    </div>
  </div>
</nav>

<div class="container">
    <h3 class="mb-4"><i class="bi bi-pencil-square"></i> Edit Data Mahasiswa</h3>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">NPM</label>
            <input type="text" name="npm" value="<?= $data['npm'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" value="<?= $data['nama'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Prodi</label>
            <input type="text" name="prodi" value="<?= $data['prodi'] ?>" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">No HP</label>
            <input type="text" name="nohp" value="<?= $data['nohp'] ?>" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary"><i class="bi bi-save2"></i> Simpan Perubahan</button>
        <a href="data_mahasiswa.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Kembali</a>
    </form>
</div>

</body>
</html>
