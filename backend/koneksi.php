<?php
$host = 'db.be-mons1.bengt.wasmernet.com';
$username = 'f9c1404b75f080005a8d5db7216f';
$password = '0684f9c1-404c-742e-8000-c92be5cbf587';
$dbname = 'dbYj6pKZkYXHZ7TZdq2UE8Aq';

// Koneksi ke MySQL
$koneksi = new mysqli($host, $username, $password, $dbname);

// Cek apakah koneksi berhasil
if ($koneksi->connect_error) {
    die("Connection failed: " . $koneksi->connect_error);
}
?>
