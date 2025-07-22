<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $u = $_POST['username'];
    $p = $_POST['password'];

    $cek = mysqli_query($conn, "SELECT * FROM tbl_user WHERE username='$u'");
    $data = mysqli_fetch_assoc($cek);

    if ($data && password_verify($p, $data['password'])) {
        $_SESSION['user'] = $data;
        header("Location: index.php");
        exit;
    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Login Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body {
            background: linear-gradient(to right, #a5d6a7, #81c784);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .card {
            max-width: 420px;
            width: 100%;
            border-radius: 20px;
            padding: 40px 35px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
            background-color: #fff;
            text-align: center;
        }
        .logo {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 30px auto;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.18);
            display: block;
        }
        h3.mb-3.text-success {
            color: #1b5e20 !important;
            font-weight: 700;
            font-size: 1.8rem;
            margin-bottom: 15px;
        }
        h3.mb-3.text-success i {
            vertical-align: middle;
            margin-right: 8px;
        }
        p.text-muted {
            color: #4a4a4a;
            font-size: 0.95rem;
            margin-bottom: 30px;
            font-weight: 500;
        }
        .input-group-text {
            background-color: #c8e6c9;
            border: none;
            color: #1b5e20;
            font-size: 1.1rem;
            padding: 0.6rem 0.75rem;
        }
        .form-control {
            border-radius: 10px;
            border: 1.5px solid #c8e6c9;
            font-size: 1rem;
            padding: 10px 14px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-control:focus {
            box-shadow: 0 0 8px rgba(27, 94, 32, 0.3);
            border-color: #1b5e20;
            outline: none;
        }
        .input-group .input-group-text:last-child {
            cursor: pointer;
            user-select: none;
            background-color: #c8e6c9;
            border-radius: 0 10px 10px 0;
        }
        .btn-login {
            background-color: #1b5e20;
            border: none;
            font-weight: 700;
            font-size: 1.1rem;
            padding: 12px 0;
            color: #fff;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(27, 94, 32, 0.4);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        .btn-login:hover {
            background-color: #145a18;
            box-shadow: 0 8px 18px rgba(20, 90, 24, 0.6);
            color: #fff;
        }
        .btn-login i {
            margin-right: 8px;
            vertical-align: middle;
        }
        .link-success {
            color: #1b5e20;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .link-success:hover {
            color: #145a18;
            text-decoration: underline;
        }
        .alert-danger {
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 20px;
        }
        .mb-3.text-start label {
            font-weight: 600;
            font-size: 1rem;
            color: #2e2e2e;
        }
    </style>
</head>
<body>

<div class="card shadow">
    <img src="uploads/logo.jpg" alt="Logo" class="logo" />

    <h3 class="mb-3 text-success">
        <i class="bi bi-box-arrow-in-right"></i> Login Akun
    </h3>
    <p class="text-muted">Silakan masuk untuk melanjutkan</p>

    <?php if (isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form method="POST" autocomplete="off">
        <div class="mb-3 text-start">
            <label class="form-label" for="username">Username</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username" required autofocus />
            </div>
        </div>
        <div class="mb-4 text-start">
            <label class="form-label" for="password">Password</label>
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required />
                <span class="input-group-text" onclick="togglePassword()" title="Tampilkan/Sembunyikan Password"><i id="eyeIcon" class="bi bi-eye"></i></span>
            </div>
        </div>
        <button type="submit" class="btn btn-login w-100 mb-3">
            <i class="bi bi-door-open"></i> Masuk
        </button>
    </form>

    <p class="mb-0">
        Belum punya akun? <a href="register.php" class="link-success">Daftar sekarang</a>
    </p>
</div>

<script>
    function togglePassword() {
        const input = document.getElementById("password");
        const icon = document.getElementById("eyeIcon");
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("bi-eye");
            icon.classList.add("bi-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("bi-eye-slash");
            icon.classList.add("bi-eye");
        }
    }
</script>

</body>
</html>
