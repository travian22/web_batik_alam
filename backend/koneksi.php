<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'batik_alam_app';

// Koneksi ke MySQL
$koneksi = new mysqli($host, $username, $password, $dbname);

// Cek apakah koneksi berhasil
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}
?>
