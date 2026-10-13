// public/js/script.js
document.addEventListener('DOMContentLoaded', function() {
    // Otomatis menutup notifikasi flash 'success' setelah 3.5 detik
    const alertSuccess = document.querySelector('.alert-success');
    if (alertSuccess) {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alertSuccess);
            bsAlert.close();
        }, 3500);
    }
});