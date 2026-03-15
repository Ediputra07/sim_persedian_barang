// Disable tombol submit setelah diklik
document.querySelectorAll('form').forEach(function(form) {
    form.addEventListener('submit', function() {
        const btn = this.querySelector('button[type="submit"]');
        if (btn) {
            btn.disabled = true;
            btn.innerHTML = '<span class="spinner-border spinner-border-sm me-1"></span> Menyimpan...';
        }
    });
});