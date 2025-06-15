<?php
include 'koneksi.php';

$id = $_GET['id'];

// Menghapus produk berdasarkan ID
$sql = "DELETE FROM produk WHERE id = '$id'";
if ($koneksi->query($sql)) {
    echo "Product deleted successfully!";
    header("Location: manage_products.php");
} else {
    echo "Error deleting product: " . $koneksi->error;
}
?>
