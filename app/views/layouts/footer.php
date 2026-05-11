<footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col">
                    <h4>TechZone</h4>
                    <p>Hệ thống siêu thị công nghệ số 1 Việt Nam. Uy tín, chất lượng, giá tốt nhất thị trường.</p>
                    <p><i class="fas fa-map-marker-alt me-2 text-info"></i> 123 Nguyễn Trãi, Q.1, TP.HCM</p>
                    <p><i class="fas fa-envelope me-2 text-info"></i> cskh@techzone.vn</p>
                </div>
                <div class="footer-col">
                    <h4>Hỗ trợ khách hàng</h4>
                    <a href="#">Chính sách đổi trả</a>
                    <a href="#">Bảo hành & sửa chữa</a>
                    <a href="#">Hướng dẫn mua trả góp</a>
                    <a href="#">Giao hàng & Thanh toán</a>
                </div>
                <div class="footer-col">
                    <h4>Về TechZone</h4>
                    <a href="public_entry.php?url=about">Giới thiệu công ty</a>
                    <a href="public_entry.php?url=contact">Liên hệ</a>
                    <a href="public_entry.php?url=faqs">Hỏi đáp - FAQs</a>
                    <a href="#">Tuyển dụng</a>
                </div>
                <div class="footer-col">
                    <h4>Kết nối với chúng tôi</h4>
                    <div class="social-icons">
                        <i class="fab fa-facebook"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-youtube"></i>
                        <i class="fab fa-tiktok"></i>
                    </div>
                </div>
            </div>
            <div class="copyright">
                &copy; 2026 TechZone - Bản quyền thuộc về Công ty cổ phần TechZone.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="assets/js/main.js"></script>

    <script>
        <?php if (isset($_SESSION['auth_status']) && $_SESSION['auth_status'] !== 'locked'): ?>
            document.addEventListener('DOMContentLoaded', function() {
                Toast.fire({ icon: '<?= $_SESSION['auth_status'] ?>', title: '<?= $_SESSION['auth_message'] ?>' });
            });
            <?php unset($_SESSION['auth_status'], $_SESSION['auth_message']); ?>
        <?php endif; ?>
    </script>
</body>
</html>