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

function updateJam() {
    const elJam = document.getElementById('jam');
    if (elJam) {
        elJam.textContent = new Date().toLocaleTimeString('id-ID');
    }
}
setInterval(updateJam, 1000);
updateJam();