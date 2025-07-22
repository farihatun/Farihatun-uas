<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

// Search
$search = $_GET['search'] ?? '';
if ($search) {
    $stmt = $conn->prepare("SELECT * FROM tbl_mahasiswa WHERE nama LIKE ? OR npm LIKE ? OR prodi LIKE ?");
    $like = "%$search%";
    $stmt->bind_param("sss", $like, $like, $like);
    $stmt->execute();
    $query = $stmt->get_result();
} else {
    $query = $conn->query("SELECT * FROM tbl_mahasiswa");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
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
        .table-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-top: 40px;
        }
        .btn-hijau {
            background-color: #2e7d32;
            color: white;
        }
        .btn-hijau:hover {
            background-color: #1b5e20;
        }
        .btn-green {
            background-color: #43a047;
            color: white;
        }
        .btn-green:hover {
            background-color: #2e7d32;
        }
        img.foto-mahasiswa {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 50%;
        }
        .nav-active {
            background-color: white !important;
            color: #2e7d32 !important;
            font-weight: bold;
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
        <a href="data_mahasiswa.php" class="btn btn-light me-2"><i class="bi bi-table"></i> Data Mahasiswa</a>
        <a href="tambah_mahasiswa.php" class="btn btn-green me-2"><i class="bi bi-plus-circle-fill"></i> Tambah Data</a>
        <a href="logout.php" class="btn btn-danger"><i class="bi bi-box-arrow-right"></i> Logout</a>
    </div>
  </div>
</nav>


<!-- Tabel Data -->
<div class="container">
    <div class="table-container">
        <div class="d-flex justify-content-between mb-3">
            <h3 class="text-success">Daftar Mahasiswa</h3>
            <form method="get" class="d-flex" role="search">
                <input class="form-control me-2" type="search" name="search" placeholder="Cari nama, NPM, Prodi..." value="<?= htmlspecialchars($search) ?>">
                <button class="btn btn-success" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>

        <table class="table table-striped table-bordered align-middle text-center">
            <thead class="table-success">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>NPM</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>No HP</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($query->num_rows > 0): ?>
                    <?php $no = 1; while ($row = $query->fetch_assoc()): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td>
                            <?php if (!empty($row['foto'])) : ?>
                                <img src="uploads/<?= htmlspecialchars($row['foto']) ?>" class="foto-mahasiswa">
                            <?php else : ?>
                                <span class="text-muted">-</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($row['npm']) ?></td>
                        <td><?= htmlspecialchars($row['nama']) ?></td>
                        <td><?= htmlspecialchars($row['prodi']) ?></td>
                        <td><?= htmlspecialchars($row['nohp']) ?></td>
                        <td>
                            <a href="edit_mahasiswa.php?id=<?= $row['idMhs'] ?>" class="btn btn-sm btn-hijau me-1">
                                <i class="bi bi-pencil-square"></i> Edit
                            </a>
                            <a href="hapus_mahasiswa.php?id=<?= $row['idMhs'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                <i class="bi bi-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">Data tidak ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
