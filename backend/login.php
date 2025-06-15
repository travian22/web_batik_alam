<?php
// Koneksi ke database
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Menangkap data dari form login
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk memeriksa apakah username ada di database
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Cek apakah user ditemukan
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verifikasi password (tanpa hashing)
        if ($password === $user['password']) {
            // Jika login berhasil, simpan session dan redirect
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php"); // Ganti dengan halaman setelah login
            exit();
        } else {
            $error_message = "Incorrect password.";
        }
    } else {
        $error_message = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .login-box {
            width: 360px;
            margin: 7% auto;
            padding: 30px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .login-box .form-group {
            margin-bottom: 20px;
        }
        .login-box .form-control {
            border-radius: 5px;
            padding: 10px;
        }
        .login-box .btn {
            width: 100%;
            padding: 10px;
            font-size: 18px;
            border-radius: 5px;
        }
        .login-box .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .login-box h3 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h3>Batik Alam</h3>
    <p class="text-center">Sign in to start your session</p>

    <!-- Menampilkan pesan error jika login gagal -->
    <?php if (isset($error_message)): ?>
        <div class="alert alert-danger">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <form action="" method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required placeholder="Enter your username">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
        </div>
        <button type="submit" class="btn btn-primary">Sign In</button>
    </form>
    <div class="mt-3">
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
