<?php
// Mulai session
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login.php");
    exit();
}

// Ambil data dari session
$username = $_SESSION['username'];

include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Batik Alam | Tambah Produk</title>
  <link rel="shortcut icon" type="image/x-icon" href="./dist/img/favicon.ico">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <?php include 'navbar.php'; ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include 'sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Produk Baru</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="manage_products.php">Produk</a></li>
              <li class="breadcrumb-item active">Tambah Produk</li>
            </ol>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Tambah Produk</h3>
              </div>
              <!-- form start -->
              <form method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama">Nama Produk</label>
                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama produk" required>
                  </div>
                  <div class="form-group">
                    <label for="harga">Harga</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                      </div>
                      <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan harga" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gambar">Gambar Produk</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar" name="gambar" required>
                        <label class="custom-file-label" for="gambar">Pilih file</label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                  <a href="manage_products.php" class="btn btn-default float-right">Batal</a>
                </div>
              </form>
            </div>

            <?php
            if (isset($_POST['submit'])) {
                $nama = $_POST['nama'];
                $harga = $_POST['harga'];
                $gambar = $_FILES['gambar']['name'];
                $upload_dir = 'uploads/';
                
                // Pastikan direktori upload ada
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                // Generate nama file unik
                $gambar_unik = date('YmdHis') . '_' . $gambar;
                
                if (move_uploaded_file($_FILES['gambar']['tmp_name'], $upload_dir . $gambar_unik)) {
                    $sql = "INSERT INTO produk (nama, harga, gambar) VALUES (?, ?, ?)";
                    $stmt = $koneksi->prepare($sql);
                    $stmt->bind_param("sis", $nama, $harga, $gambar_unik);
                    
                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success mt-3'>Produk berhasil ditambahkan!</div>";
                        echo "<script>setTimeout(function(){ window.location='manage_products.php'; }, 1500);</script>";
                    } else {
                        echo "<div class='alert alert-danger mt-3'>Gagal menambahkan produk!</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger mt-3'>Gagal mengupload gambar!</div>";
                }
            }
            ?>
          </div>
        </div>
      </div>
    </section>
  </div>

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="#">Batik Alam</a>.</strong> All rights reserved.
  </footer>
</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script>
$(function () {
  bsCustomFileInput.init();
});
</script>
</body>
</html>
