<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Batik Alam | Manage Product</title>
  <link rel="shortcut icon" type="image/x-icon" href="./dist/img/favicon.ico">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <?php include 'navbar.php'; ?>
  <?php include 'sidebar.php'; ?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Product</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="add_product.php" class="btn btn-primary">Add New Product</a>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "SELECT * FROM produk";
                      $result = $koneksi->query($sql);
                      $no = 1;
                      while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $no . "</td>
                                <td>" . $row['nama'] . "</td>
                                <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                                <td><img src='uploads/" . $row['gambar'] . "' class='img-thumbnail' width='100' alt='Product Image'></td>
                                <td>
                                  <a href='edit_product.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'><i class='fas fa-edit'></i> Edit</a>
                                  <a href='delete_product.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Apakah Anda yakin ingin menghapus produk ini?\")'>\n                                    <i class='fas fa-trash'></i> Delete</a>
                                </td>
                              </tr>";
                        $no++;
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="#">Batik Alam</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.js"></script>
</body>
</html>
