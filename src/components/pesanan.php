<?php include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $orderName = $_POST['orderName'];
    $orderEmail = $_POST['orderEmail'];
    $orderPhone = $_POST['orderPhone'];
    $orderAddress = $_POST['orderAddress'];
    $orderProduct = $_POST['orderProduct'];
    $orderSize = $_POST['orderSize'];
    $orderQuantity = $_POST['orderQuantity'];
    $orderNotes = $_POST['orderNotes'];
    $orderPayment = $_POST['orderPayment'];

    $sql = "INSERT INTO orders (order_name, order_email, order_phone, order_address, order_product, order_size, order_quantity, order_notes, order_payment, order_date) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("ssssssiss", $orderName, $orderEmail, $orderPhone, $orderAddress, $orderProduct, $orderSize, $orderQuantity, $orderNotes, $orderPayment);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
    $stmt->close();
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Batik Alam - Kerajinan Batik Eco-Friendly</title>
    <link rel="shortcut icon" type="image/x-icon" href="../app/favicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../app/styles.css">
    <!-- <script src="../app/pesanan.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
    <script src="../app/kirim_email.js"></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/batik_alam/index.html">
                <img src="/batik_alam/public/image/logo_192x192.png" alt="" width="30" height="24"
                    class="d-inline-block align-text-top">
                Batik Alam
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/batik_alam/index.html">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tentang.html">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="produk.html">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="galeri.html">Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontak.html">Kontak</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link pesanan-btn" href="pesanan.php">
                            <span class="pesanan-icon"><i class="fas fa-shopping-cart"></i></span>
                            Pesanan
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="nav-link login-btn active" href="/batik_alam/src/components/login.html">
                            <span class="login-icon"><i class="fas fa-user"></i></span>
                            Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HALAMAN PESANAN -->
    <div id="pesanan-page">
        <section class="page-section">
            <div class="container">
                <h1 class="section-title">Formulir Pemesanan</h1>
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Data Pemesanan</h3>
                                <form id="order-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                    <div class="mb-3">
                                        <label for="orderName" class="form-label">Nama Lengkap</label>
                                        <input type="text" class="form-control" id="orderName" name="orderName"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="orderEmail" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="orderEmail" name="orderEmail"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="orderPhone" class="form-label">Nomor Telepon</label>
                                        <input type="tel" class="form-control" id="orderPhone" name="orderPhone"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="orderAddress" class="form-label">Alamat Pengiriman</label>
                                        <textarea class="form-control" id="orderAddress" name="orderAddress" rows="3"
                                            required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="orderProduct" class="form-label">Produk</label>
                                        <select class="form-select" id="orderProduct" name="orderProduct" required>
                                            <option value="">-- Pilih Produk --</option>
                                            <option value="Batik Parang Hijau">Batik Parang Hijau (Rp 450.000)</option>
                                            <option value="Batik Kawung Coklat">Batik Kawung Coklat (Rp 425.000)
                                            </option>
                                            <option value="Batik Megamendung">Batik Megamendung (Rp 475.000)</option>
                                            <option value="Kemeja Batik Pria Klasik">Kemeja Batik Pria Klasik (Rp
                                                350.000)</option>
                                            <option value="Dress Batik Modern">Dress Batik Modern (Rp 395.000)</option>
                                            <option value="Blazer Batik Premium">Blazer Batik Premium (Rp 675.000)
                                            </option>
                                            <option value="Masker Batik Eco-Friendly">Masker Batik Eco-Friendly (Rp
                                                45.000)</option>
                                            <option value="Tas Batik Multifungsi">Tas Batik Multifungsi (Rp 175.000)
                                            </option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="orderSize" class="form-label">Ukuran (jika produk pakaian)</label>
                                        <select class="form-select" id="orderSize" name="orderSize">
                                            <option value="">-- Pilih Ukuran --</option>
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                            <option value="XXL">XXL</option>
                                            <option value="N/A">Tidak Ada Ukuran</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="orderQuantity" class="form-label">Jumlah</label>
                                        <input type="number" class="form-control" id="orderQuantity"
                                            name="orderQuantity" min="1" value="1" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="orderNotes" class="form-label">Catatan Tambahan</label>
                                        <textarea class="form-control" id="orderNotes" name="orderNotes"
                                            rows="2"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="orderPayment" class="form-label">Metode Pembayaran</label>
                                        <select class="form-select" id="orderPayment" name="orderPayment" required>
                                            <option value="">-- Pilih Metode Pembayaran --</option>
                                            <option value="Transfer Bank">Transfer Bank</option>
                                            <option value="E-Wallet">E-Wallet</option>
                                            <option value="COD">Bayar di Tempat (COD)</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100">Proses Pesanan</button>
                                </form>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <h3>Daftar Pesanan</h3>
                        <div class="table-responsive">
                            <table class="table table-striped" id="orderTable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Nama</th>
                                        <th>Produk</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data pesanan akan ditampilkan di sini -->
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            <h4>Informasi Pemesanan</h4>
                            <ul>
                                <li>Metode pembayaran transfer bank akan mendapatkan invoice dan nomor rekening via
                                    email.</li>
                                <li>Pembayaran harus dilakukan dalam 24 jam setelah pemesanan.</li>
                                <li>Pengiriman dilakukan 1-2 hari setelah pembayaran dikonfirmasi.</li>
                                <li>Ongkos kirim akan dihitung berdasarkan alamat tujuan dan berat produk.</li>
                                <li>Perubahan atau pembatalan pesanan dapat dilakukan melalui email atau telepon sebelum
                                    status pesanan menjadi "Diproses".</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h4>Batik Alam</h4>
                    <p>Kerajinan batik eco-friendly dengan pewarna alami, melestarikan warisan budaya Indonesia dengan
                        sentuhan modern dan ramah lingkungan.</p>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <h4>Tautan Cepat</h4>
                    <ul class="list-unstyled">
                        <li><a href="/index.html" class="text-white">Beranda</a></li>
                        <li><a href="tentang.html" class="text-white">Tentang Kami</a></li>
                        <li><a href="produk.html" class="text-white">Produk</a></li>
                        <li><a href="galeri.html" class="text-white">Galeri</a></li>
                        <li><a href="kontak.html" class="text-white">Kontak</a></li>
                        <li><a href="pesanan.php" class="text-white">Pesanan</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h4>Berlangganan</h4>
                    <p>Dapatkan informasi terbaru tentang produk dan workshop kami.</p>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" id="email" placeholder="Email Anda"
                            aria-label="Email Anda" required>
                        <button class="btn btn-outline-light" type="button" onclick="kirimEmail()">Daftar</button>
                    </div>
                </div>
            </div>
            <hr class="bg-light">
            <div class="text-center">
                <p>&copy; 2025 Batik Alam. Hak Cipta Dilindungi.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('order-form').addEventListener('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    if (data.trim() === 'success') {
                        alert('Pesanan berhasil disimpan!');
                        this.reset(); // Clear form
                    } else {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                })
                .catch(error => {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                    console.error('Error:', error);
                });
        });
    </script>
</body>

</html>