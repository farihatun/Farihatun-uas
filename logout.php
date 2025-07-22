<?php
session_start();

if (isset($_POST['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Logout | Konfirmasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #e8f5e9;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
        }

        .logout-box {
            background: #ffffff;
            padding: 40px 40px;
            border-radius: 20px;
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeInUp 0.8s ease-out;
            max-width: 420px;
            width: 100%;
        }

        .logout-box i.bi-box-arrow-right {
            font-size: 70px;
            color: #2e7d32;
            margin-bottom: 20px;
        }

        .logout-box h1 {
            color: #2e7d32;
            font-size: 22px;
            margin-bottom: 10px;
        }

        .logout-box p {
            font-size: 15px;
            color: #555;
            margin-bottom: 30px;
        }

        .button-group {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .btn-logout {
            background-color: #2e7d32;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: background 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .btn-logout:hover {
            background-color: #1b5e20;
        }

        .btn-cancel {
            background-color: #f1f1f1;
            color: #2e7d32;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: background 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .btn-cancel:hover {
            background-color: #e0e0e0;
            color: #1b5e20;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="logout-box">
    <i class="bi bi-box-arrow-right"></i>
    <h1>Yakin ingin keluar?</h1>
    <p>Anda akan keluar dari sistem dan kembali ke halaman login.</p>
    <div class="button-group">
        <form method="POST">
            <button type="submit" name="logout" class="btn btn-logout">
                <i class="bi bi-check-circle-fill"></i> Ya, Logout
            </button>
        </form>
        <a href="index.php" class="btn-cancel">
            <i class="bi bi-x-circle-fill"></i> Batal
        </a>
    </div>
</div>

</body>
</html>
