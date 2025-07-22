<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $npm = $_POST['npm'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $nohp = $_POST['nohp'];

    $foto = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $folder = "uploads/";
        $foto = uniqid() . "_" . $_FILES['foto']['name'];
        move_uploaded_file($_FILES['foto']['tmp_name'], $folder . $foto);
    }

    $stmt = $conn->prepare("INSERT INTO tbl_mahasiswa (npm, nama, prodi, nohp, foto) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $npm, $nama, $prodi, $nohp, $foto);
    $stmt->execute();

    header("Location: data_mahasiswa.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e8f5e9, #c8e6c9);
            font-family: 'Segoe UI', sans-serif;
        }
        .navbar {
            background-color: #2e7d32;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .form-container {
            background-color: #ffffff;
            padding: 35px;
            border-radius: 18px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
            margin-top: 50px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .btn-green {
            background-color: #2e7d32;
            color: white;
        }
        .btn-green:hover {
            background-color: #1b5e20;
        }
        label i {
            margin-right: 8px;
            color: #2e7d32;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">
      <img src="uploads/logo.jpg" alt="logo" width="40" class="me-2 rounded"> Sistem Informasi Mahasiswa
    </a>
    <div class="d-flex">
        <a href="index.php" class="btn btn-green me-2"><i class="bi bi-house-fill"></i> Beranda</a>
        <a href="data_mahasiswa.php" class="btn btn-green me-2"><i class="bi bi-table"></i> Data Mahasiswa</a>
        <a href="tambah_mahasiswa.php" class="btn btn-light me-2"><i class="bi bi-plus-circle-fill"></i> Tambah Data</a>
        <a href="logout.php" class="btn btn-danger"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
  </div>
</nav>

<!-- Form Tambah Data -->
<div class="container">
    <div class="form-container">
        <h3 class="mb-4 text-success text-center"><i class="bi bi-person-plus-fill me-2"></i>Tambah Data Mahasiswa</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label"><i class="bi bi-person-vcard-fill"></i> NPM</label>
                <input type="text" name="npm" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="bi bi-person-fill"></i> Nama</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="bi bi-journal-code"></i> Prodi</label>
                <input type="text" name="prodi" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="bi bi-telephone-fill"></i> No HP</label>
                <input type="text" name="nohp" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label"><i class="bi bi-image-fill"></i> Upload Foto</label>
                <input type="file" name="foto" class="form-control">
            </div>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-green"><i class="bi bi-save2-fill me-1"></i> Simpan</button>
                <a href="data_mahasiswa.php" class="btn btn-secondary"><i class="bi bi-arrow-left-circle me-1"></i> Kembali</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
