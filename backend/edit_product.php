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

// Ambil ID produk yang akan diedit
$id = $_GET['id'];
$sql = "SELECT * FROM produk WHERE id = ?";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Batik Alam | Edit Produk</title>
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
            <h1>Edit Produk</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="manage_products.php">Produk</a></li>
              <li class="breadcrumb-item active">Edit Produk</li>
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
                <h3 class="card-title">Form Edit Produk</h3>
              </div>
              <!-- form start -->
              <form method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama">Nama Produk</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo htmlspecialchars($product['nama']); ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="harga">Harga</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text">Rp</span>
                      </div>
                      <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $product['harga']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="gambar">Gambar Produk</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="gambar" name="gambar">
                        <label class="custom-file-label" for="gambar">Pilih file</label>
                      </div>
                    </div>
                    <div class="mt-2">
                      <img src="uploads/<?php echo htmlspecialchars($product['gambar']); ?>" alt="Product Image" class="img-thumbnail" style="max-width: 200px">
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
                $update_success = false;

                if ($gambar) {
                    $upload_dir = 'uploads/';
                    // Generate nama file unik
                    $gambar_unik = date('YmdHis') . '_' . $gambar;
                    
                    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $upload_dir . $gambar_unik)) {
                        $sql_update = "UPDATE produk SET nama = ?, harga = ?, gambar = ? WHERE id = ?";
                        $stmt_update = $koneksi->prepare($sql_update);
                        $stmt_update->bind_param("sisi", $nama, $harga, $gambar_unik, $id);
                        $update_success = $stmt_update->execute();
                    } else {
                        echo "<div class='alert alert-danger mt-3'>Gagal mengupload gambar!</div>";
                    }
                } else {
                    $sql_update = "UPDATE produk SET nama = ?, harga = ? WHERE id = ?";
                    $stmt_update = $koneksi->prepare($sql_update);
                    $stmt_update->bind_param("sii", $nama, $harga, $id);
                    $update_success = $stmt_update->execute();
                }

                if ($update_success) {
                    echo "<div class='alert alert-success mt-3'>Produk berhasil diperbarui!</div>";
                    echo "<script>setTimeout(function(){ window.location='manage_products.php'; }, 1500);</script>";
                } else {
                    echo "<div class='alert alert-danger mt-3'>Gagal memperbarui produk!</div>";
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
