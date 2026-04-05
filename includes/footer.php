</main>

        <footer class="app-footer">
            &copy; <?= date('Y') ?> InvenTrack Pro &mdash; Kelompok 4
        </footer>

    </div><!-- end main-wrapper -->

</div><!-- end app-wrapper -->

<!-- Modal Logout -->
<div class="modal fade" id="modalLogout" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" style="background:#fff7ed;border-bottom:1px solid #fed7aa;">
                <h5 class="modal-title" style="color:#c2410c;">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center py-4">
                <i class="bi bi-question-circle text-warning" style="font-size:2.5rem"></i>
                <p class="mt-3 mb-0" style="font-size:0.88rem;color:#475569;">
                    Yakin ingin keluar dari sistem?
                </p>
            </div>
            <div class="modal-footer justify-content-center gap-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Batal
                </button>
                <a href="<?= BASE_URL ?>/process/auth/logout.php" class="btn btn-danger">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASE_URL ?>/assets/js/script.js"></script>
</body>
</html>