<?php
// Koneksi ke database
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Menangkap data dari form registrasi
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Memeriksa apakah password dan konfirmasi password cocok
    if ($password !== $confirm_password) {
        $error_message = "Password dan Konfirmasi Password tidak cocok.";
    } else {
        // Memeriksa apakah username sudah ada di database
        $sql_check = "SELECT * FROM users WHERE username = ?";
        $stmt_check = $koneksi->prepare($sql_check);
        $stmt_check->bind_param("s", $username);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if ($result_check->num_rows > 0) {
            $error_message = "Username sudah digunakan.";
        } else {
            // Menyimpan data pengguna ke database tanpa hashing
            $sql_insert = "INSERT INTO users (username, password) VALUES (?, ?)";
            $stmt_insert = $koneksi->prepare($sql_insert);
            $stmt_insert->bind_param("ss", $username, $password);
            
            if ($stmt_insert->execute()) {
                // Redirect ke halaman login
                header("Location: login.php?registered=true");
                exit();
            } else {
                $error_message = "Terjadi kesalahan saat mendaftar. Silakan coba lagi.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Batik Alam</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .register-box {
            width: 360px;
            margin: 7% auto;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .register-box .form-group {
            margin-bottom: 20px;
        }
        .register-box .form-control {
            border-radius: 5px;
            padding: 10px;
        }
        .register-box .btn {
            width: 100%;
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
        }
        .register-box .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .register-box h3 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="register-box">
    <h3>Register</h3>
    <p class="text-center">Buat akun baru</p>

    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required placeholder="Masukkan username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required placeholder="Masukkan password">
        </div>
        <div class="form-group">
            <label for="confirm_password">Konfirmasi Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required placeholder="Konfirmasi password">
        </div>
        <button type="submit" class="btn btn-primary">Daftar</button>
        <p class="text-center mt-3">Sudah punya akun? <a href="login.php">Login</a></p>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
