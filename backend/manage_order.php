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
  <title>Batik Alam | Manage Order</title>
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
            <h1 class="m-0">Daftar Pesanan</h1>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Telepon</th>
                        <th>Produk</th>
                        <th>Ukuran</th>
                        <th>Jumlah</th>
                        <th>Pembayaran</th>
                        <th>Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql_select = "SELECT * FROM orders ORDER BY order_date DESC";
                      $result = $koneksi->query($sql_select);
                      $no = 1;

                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          $status_class = $row['status'] == 'Lunas' ? 'bg-success' : 'bg-warning';
                          $status_text = $row['status'] ?? 'Menunggu';
                          
                          echo "<tr>
                                  <td>" . $no++ . "</td>
                                  <td>" . date('d/m/Y H:i', strtotime($row['order_date'])) . "</td>
                                  <td>" . htmlspecialchars($row['order_name']) . "</td>
                                  <td>" . htmlspecialchars($row['order_email']) . "</td>
                                  <td>" . htmlspecialchars($row['order_phone']) . "</td>
                                  <td>" . htmlspecialchars($row['order_product']) . "</td>
                                  <td>" . htmlspecialchars($row['order_size']) . "</td>
                                  <td>" . htmlspecialchars($row['order_quantity']) . "</td>
                                  <td>" . htmlspecialchars($row['order_payment']) . "</td>
                                  <td>
                                    <select class='form-control status-select' data-order-id='" . $row['id'] . "'>
                                      <option value='Menunggu' " . ($status_text == 'Menunggu' ? 'selected' : '') . ">Menunggu</option>
                                      <option value='Lunas' " . ($status_text == 'Lunas' ? 'selected' : '') . ">Lunas</option>
                                    </select>
                                  </td>
                                </tr>";
                        }
                      } else {
                        echo "<tr><td colspan='10' class='text-center'>Belum ada pesanan</td></tr>";
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
<script>
$(document).ready(function() {
    $('.status-select').change(function() {
        var orderId = $(this).data('order-id');
        var status = $(this).val();
        
        $.ajax({
            url: 'update_status.php',
            method: 'POST',
            data: {
                order_id: orderId,
                status: status
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert('Status berhasil diperbarui');
                    location.reload();
                } else {
                    alert(response.error || 'Terjadi kesalahan saat memperbarui status');
                }
            },
            error: function(xhr, status, error) {
                alert('Terjadi kesalahan: ' + error);
            }
        });
    });
});
</script>
</body>
</html>