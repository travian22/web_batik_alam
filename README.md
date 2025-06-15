# Batik Alam Website

Website Batik Alam adalah platform e-commerce yang menyediakan layanan penjualan batik dan pelatihan pembuatan batik. Website ini memiliki dua bagian utama: frontend untuk pengunjung dan backend untuk admin.

## Fitur

### Frontend
- Halaman beranda dengan tampilan produk unggulan
- Katalog produk batik dengan filter kategori
- Halaman detail produk
- Form pemesanan produk
- Galeri foto kegiatan
- Halaman tentang kami
- Form kontak

### Backend (Admin Panel)
- Autentikasi admin (login/logout)
- Dashboard dengan ringkasan statistik
- Manajemen produk (tambah, edit, hapus)
- Manajemen pesanan
- Upload dan preview gambar produk
- Update status pesanan

## Teknologi yang Digunakan

### Frontend
- HTML5
- CSS3
- JavaScript
- Bootstrap 4
- jQuery

### Backend
- PHP
- MySQL
- AdminLTE 3
- Bootstrap 4
- jQuery
- Font Awesome

## Persyaratan Sistem

- PHP >= 7.4
- MySQL >= 5.7
- Web Server (Apache/Nginx)
- Browser modern (Chrome, Firefox, Safari, Edge)

## Instalasi

1. Clone repositori ini:
```bash
git clone https://github.com/username/batik-alam.git
```

2. Import database:
- Buat database baru di MySQL
- Import file `backend/schema.sql`

3. Konfigurasi database:
- Buka file `backend/koneksi.php`
- Sesuaikan pengaturan database:
```php
$host = "localhost";
$username = "root";
$password = "";
$database = "batik_alam";
```

4. Atur permission folder upload:
```bash
chmod 755 backend/uploads
```

5. Akses website:
- Frontend: `http://localhost/batik-alam`
- Backend: `http://localhost/batik-alam/backend`

## Struktur Folder

```
batik-alam/
├── backend/           # Admin panel
│   ├── dist/         # AdminLTE assets
│   ├── plugins/      # JavaScript plugins
│   └── uploads/      # Folder upload gambar
├── public/           # Asset publik
│   └── image/        # Gambar website
└── src/              # Source code frontend
    ├── app/          # JavaScript dan CSS
    └── components/   # Komponen website
```

## Panduan Kontribusi

1. Fork repositori
2. Buat branch fitur (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -m 'Menambah fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

## Lisensi

Hak Cipta © 2023 Batik Alam. Seluruh hak cipta dilindungi.
