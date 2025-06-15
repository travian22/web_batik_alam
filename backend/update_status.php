<?php
require_once 'koneksi.php';

// Pastikan header content-type adalah JSON
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (!isset($_POST['order_id']) || !isset($_POST['status'])) {
            throw new Exception('ID pesanan dan status harus diisi');
        }

        $order_id = $_POST['order_id'];
        $status = $_POST['status'];

        $stmt = $koneksi->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $order_id);

        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            throw new Exception('Gagal memperbarui status');
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['success' => false, 'error' => $e->getMessage()]);
    }
} else {
    http_response_code(405);
    echo json_encode(['success' => false, 'error' => 'Metode tidak diizinkan']);
}