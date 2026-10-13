document.addEventListener('DOMContentLoaded', function() {
    // Otomatis hilangkan flash alert 'success' setelah 3.5 detik
    const alertSuccess = document.querySelector('.alert-success');
    if (alertSuccess) {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alertSuccess);
            bsAlert.close();
        }, 3500);
    }
});