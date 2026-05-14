</div> </div> <footer>
            <div class="footer-area">
                <p>© Copyright 2026. TechZone System - Ho Chi Minh City University of Technology.</p>
            </div>
        </footer>
    </div> 

    <script src="assets_admin/js/bootstrap.bundle.min.js"></script>
    <script src="assets_admin/js/metismenujs.min.js"></script>
    <script src="assets_admin/js/scripts.js"></script>
    
    <script>
        <?php if (isset($_SESSION['auth_status'])): ?>
            Swal.fire({ 
                toast: true, position: 'top-end', showConfirmButton: false, timer: 2500, 
                icon: '<?= $_SESSION['auth_status'] ?>', title: '<?= $_SESSION['auth_message'] ?>' 
            });
            <?php unset($_SESSION['auth_status'], $_SESSION['auth_message']); ?>
        <?php endif; ?>
    </script>
</body>
</html>