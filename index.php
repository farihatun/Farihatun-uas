<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

$user = $_SESSION['user'];
$nama_pengguna = $user['username'] ?? 'Pengguna';
$login_time = date("l, d M Y - H:i");

// Ambil jumlah mahasiswa dari database
$result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tbl_mahasiswa");
$data = mysqli_fetch_assoc($result);
$total_mahasiswa = $data['total'] ?? 0;

$gambar_header = file_exists("uploads/fa7b187a-5108-442c-a716-79c6c770709c.png") 
    ? "fa7b187a-5108-442c-a716-79c6c770709c.png" 
    : "PI.jpg";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Mahasiswa</title>
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
        .header-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-bottom: 5px solid #2e7d32;
        }
        .info-card {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-top: -50px;
        }
        .feature-card {
            background-color: #e0f2f1;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            transition: 0.3s;
        }
        .feature-card:hover {
            transform: scale(1.03);
            background-color: #b2dfdb;
        }
        .feature-card i {
            font-size: 2rem;
            color: #2e7d32;
        }
        .stat-box {
            background-color: #66bb6a;
            color: white;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            font-size: 1.4rem;
        }
        .footer {
            background-color: #2e7d32;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 50px;
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow-sm">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">
      <img src="uploads/logo.jpg" alt="logo" width="50" class="me-2 rounded"> Sistem Informasi Mahasiswa
    </a>
    <div class="d-flex">
        <a href="index.php" class="btn btn-light me-2"><i class="bi bi-house-fill"></i> Beranda</a>
        <a href="data_mahasiswa.php" class="btn btn-success me-2"><i class="bi bi-table"></i> Data Mahasiswa</a>
        <a href="tambah_mahasiswa.php" class="btn btn-green me-2"><i class="bi bi-plus-circle-fill"></i> Tambah Data</a>
        <a href="logout.php" class="btn btn-danger"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
  </div>
</nav>

<!-- Header Image -->
<img src="uploads/<?= $gambar_header ?>" class="header-image" alt="Banner Mahasiswa">

<!-- Main Info Card -->
<div class="container">
    <div class="info-card mt-4">
        <h3 class="text-success"><i class="bi bi-person-check-fill"></i> Hai, <?= htmlspecialchars($nama_pengguna) ?>!</h3>
        <p class="text-muted"><i class="bi bi-clock"></i> Login pada: <?= $login_time ?></p>
        <p class="mb-4">Selamat datang di Sistem Informasi Mahasiswa. Berikut beberapa fitur yang bisa kamu gunakan:</p>

        <!-- Feature Grid -->
        <div class="row g-4">
            <div class="col-md-3 col-sm-6">
                <a href="tambah_mahasiswa.php" class="text-decoration-none text-dark">
                    <div class="feature-card shadow-sm">
                        <i class="bi bi-person-plus-fill"></i>
                        <p class="mt-2">Tambah Mahasiswa</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <a href="data_mahasiswa.php" class="text-decoration-none text-dark">
                    <div class="feature-card shadow-sm">
                        <i class="bi bi-table"></i>
                        <p class="mt-2">Lihat Semua Data</p>
                    </div>
                </a>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="feature-card shadow-sm">
                    <i class="bi bi-pencil-square"></i>
                    <p class="mt-2">Edit Data</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="feature-card shadow-sm">
                    <i class="bi bi-trash3-fill"></i>
                    <p class="mt-2">Hapus Data</p>
                </div>
            </div>
        </div>

        <!-- Statistik & Tips -->
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="stat-box">
                    <i class="bi bi-people-fill" style="font-size: 2.5rem;"></i>
                    <h3 class="mt-2 fw-bold"><?= $total_mahasiswa ?> Mahasiswa Terdaftar</h3>
                    <small>Data diperbarui secara real-time</small>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <div class="ms-md-4 mt-4 mt-md-0">
                    <p class="text-muted mb-2"><i class="bi bi-lightbulb-fill text-warning"></i> <strong>Tips:</strong> Gunakan pencarian cepat di halaman data untuk menemukan mahasiswa!</p>
                    <p class="text-muted"><i class="bi bi-lock-fill text-secondary"></i> Data hanya dapat diakses oleh pengguna yang login.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<div class="footer">
    <small>@ Sistem Informasi Mahasiswa <?= date("Y") ?> | Developed with ❤️</small>
</div>

</body>
</html>
