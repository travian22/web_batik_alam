document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('order-form');
    form.addEventListener('submit', function(e) {
        e.preventDefault(); // Mencegah submit default

        const formData = new FormData(form);

        fetch('/batik_alam/backend/manage_order.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Tampilkan pesan sukses/gagal
            alert('Pesanan berhasil dikirim!');
            form.reset(); // Kosongkan form
            // Jika ingin refresh data pesanan, panggil fungsi di sini
        })
        .catch(error => {
            alert('Terjadi kesalahan. Silakan coba lagi.');
        });
    });
});