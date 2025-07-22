<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $npm = $_POST['npm'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO tbl_user (namaLengkap, email, npm, username, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nama, $email, $npm, $username, $password);
    $stmt->execute();

    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title>Registrasi Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
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
            max-width: 480px;
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 15px 30px rgba(46, 125, 50, 0.2);
            padding: 35px 30px;
            background-color: #fff;
        }
        .logo {
            width: 90px;
            height: 90px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0 5px 15px rgba(46, 125, 50, 0.3);
            margin: 0 auto 20px auto;
            display: block;
        }
        h4 {
            color: #2e7d32;
            font-weight: 700;
            margin-bottom: 5px;
            text-align: center;
        }
        p.text-muted {
            text-align: center;
            color: #4a4a4a;
            font-size: 0.95rem;
            margin-bottom: 30px;
            font-weight: 500;
        }
        .input-group {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 0 1.5px #c8e6c9;
            transition: box-shadow 0.3s ease;
            margin-bottom: 20px;
        }
        .input-group:focus-within {
            box-shadow: 0 0 8px rgba(46, 125, 50, 0.5);
        }
        .input-group-text {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: none;
            font-size: 1.15rem;
            padding: 0.6rem 0.9rem;
        }
        .form-control {
            border: none;
            font-size: 1rem;
            padding: 12px 15px;
            border-radius: 0;
            box-shadow: none;
            outline: none;
        }
        .form-control::placeholder {
            color: #a3a3a3;
        }
        .btn-success {
            background-color: #2e7d32;
            border: none;
            font-weight: 700;
            font-size: 1.1rem;
            padding: 12px 0;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(46, 125, 50, 0.4);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            width: 100%;
        }
        .btn-success:hover {
            background-color: #1b5e20;
            box-shadow: 0 8px 20px rgba(27, 94, 32, 0.7);
        }
        .btn-success i {
            margin-right: 10px;
            vertical-align: middle;
        }
        .text-center a.text-success {
            font-weight: 700;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        .text-center a.text-success:hover {
            color: #145a18;
            text-decoration: underline;
        }
        .input-group-text.password-toggle {
            cursor: pointer;
            user-select: none;
        }
    </style>
</head>
<body>

<div class="card shadow">
    <img src="uploads/logo.jpg" alt="Logo" class="logo" />

    <h4>Form Registrasi</h4>
    <p class="text-muted">Silakan isi data lengkap di bawah ini</p>

    <form method="POST" autocomplete="off">
        <div class="input-group">
            <span class="input-group-text"><i class="fa fa-user"></i></span>
            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required autofocus />
        </div>

        <div class="input-group">
            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
            <input type="email" name="email" class="form-control" placeholder="Email" required />
        </div>

        <div class="input-group">
            <span class="input-group-text"><i class="fa fa-id-card"></i></span>
            <input type="text" name="npm" class="form-control" placeholder="NPM" required />
        </div>

        <div class="input-group">
            <span class="input-group-text"><i class="fa fa-user-circle"></i></span>
            <input type="text" name="username" class="form-control" placeholder="Username" required />
        </div>

        <div class="input-group">
            <span class="input-group-text"><i class="fa fa-lock"></i></span>
            <input type="password" name="password" id="password" class="form-control" placeholder="Password" required />
            <span class="input-group-text password-toggle" id="togglePassword" title="Tampilkan/Sembunyikan Password">
                <i class="fa-solid fa-eye"></i>
            </span>
        </div>

        <button type="submit" class="btn btn-success">
            <i class="fa fa-paper-plane"></i> Daftar Sekarang
        </button>
    </form>

    <p class="text-center mt-3">
        Sudah punya akun? <a href="login.php" class="text-success">Login di sini</a>
    </p>
</div>

<!-- Toggle Password Script -->
<script>
    const togglePassword = document.getElementById("togglePassword");
    const password = document.getElementById("password");

    togglePassword.addEventListener("click", function () {
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);
        this.firstElementChild.classList.toggle("fa-eye");
        this.firstElementChild.classList.toggle("fa-eye-slash");
    });
</script>

</body>
</html>
