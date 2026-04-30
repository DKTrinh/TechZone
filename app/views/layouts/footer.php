<footer class="footer">
    <div class="container">
        <div class="row g-4 mb-5">
            <div class="col-lg-4 pe-lg-5">
                <h4 class="text-white fw-bold mb-4"><i class="bi bi-leaf-fill text-primary me-2"></i>CleanTech</h4>
                <p class="small lh-lg">Leading provider of advanced flue gas cleaning technology for a sustainable future.</p>
            </div>
            <div class="col-6 col-lg-2">
                <h6 class="text-white fw-bold mb-4">Solutions</h6>
                <ul class="list-unstyled small lh-lg">
                    <li><a href="#">Industrial</a></li>
                    <li><a href="#">Power Plants</a></li>
                    <li><a href="#">Marine</a></li>
                    <li><a href="#">Custom Systems</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-2">
                <h6 class="text-white fw-bold mb-4">Company</h6>
                <ul class="list-unstyled small lh-lg">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">News</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h6 class="text-white fw-bold mb-4">Resources</h6>
                <ul class="list-unstyled small lh-lg" style="column-count: 2;">
                    <li><a href="#">Documentation</a></li>
                    <li><a href="#">Case Studies</a></li>
                    <li><a href="#">White Papers</a></li>
                    <li><a href="#">Support</a></li>
                </ul>
            </div>
        </div>
        
        <hr class="border-secondary opacity-25">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center pt-3 small">
            <p class="mb-0">&copy; 2024 CleanTech. All rights reserved.</p>
            <div class="mt-3 mt-md-0 d-flex gap-3">
                <a href="#">Website Builder</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<style>
    /* Biến nền xám đen mặc định của Modal thành màu tím/xanh mờ */
    .modal-backdrop.show {
        opacity: 0.9 !important;
        background: linear-gradient(135deg, #a7b8e1 0%, #c4c1e0 100%) !important;
    }
    .login-modal-content {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        border: none;
    }
    .login-left {
        background: linear-gradient(180deg, #1e3c72 0%, #2a5298 100%);
        color: white;
        padding: 50px 40px;
        position: relative;
    }
    .login-left::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0;
        background: url('https://images.unsplash.com/photo-1557682250-33bd709cbe85') center/cover;
        opacity: 0.2; mix-blend-mode: overlay;
    }
    .login-right { padding: 50px 40px; background: #ffffff; position: relative; }
    /* Nút X đóng modal */
    .btn-close-custom { position: absolute; top: 20px; right: 20px; z-index: 10; }
    
    .form-control-login { background: #f4f6fa; border: none; padding: 14px 20px; border-radius: 8px; margin-bottom: 20px; font-size: 0.95rem; width: 100%;}
    .btn-login { background: #ffffff; color: #3b82f6; border: 1px solid #e2e8f0; padding: 14px; border-radius: 8px; font-weight: bold; width: 100%; margin-bottom: 20px; transition: 0.2s;}
    .btn-login:hover { background: #f8fafc; }
    .btn-signup { background: linear-gradient(90deg, #38bdf8 0%, #3b82f6 100%); color: white; border: none; padding: 14px; border-radius: 8px; font-weight: bold; width: 100%; }
</style>

<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content login-modal-content row flex-row g-0">
            
            <div class="col-md-6 login-left d-flex flex-column justify-content-between">
                <div class="position-relative z-1">
                    <div class="mb-5 d-flex align-items-center fw-bold">
                        <span style="background: white; width: 12px; height: 12px; border-radius: 50%; display: inline-block; margin-right: 8px;"></span> YOUR LOGO
                    </div>
                    <h2 class="fw-bold display-6 mb-3" style="line-height: 1.2;">Hello,<br>welcome!</h2>
                    <p class="mb-4 text-white-50 small">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus nisi risus.</p>
                    <button type="button" class="btn btn-outline-light rounded-pill px-4 py-2" style="font-size: 0.85rem;" data-bs-dismiss="modal">Trở lại trang chủ</button>
                </div>
            </div>

            <div class="col-md-6 login-right">
                <button type="button" class="btn-close btn-close-custom" data-bs-dismiss="modal" aria-label="Close"></button>
                
                <form action="#" method="POST">
                    <div class="mb-2">
                        <label class="form-label small text-muted fw-semibold">Email address</label>
                        <input type="email" class="form-control form-control-login" placeholder="name@mail.com" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label small text-muted fw-semibold">Password</label>
                        <input type="password" class="form-control form-control-login" placeholder="••••••••••••" required>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-4 small fw-semibold">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember">
                            <label class="form-check-label text-muted" for="remember">Remember me</label>
                        </div>
                        <a href="#" class="text-decoration-none" style="color: #60a5fa;">Forgot password?</a>
                    </div>
                    
                    <button type="submit" class="btn-login">Login</button>

                    <div class="text-center mt-3 pt-3 border-top">
                        <p class="text-muted small fw-semibold mb-3">Not a member yet?</p>
                        <button type="button" class="btn-signup">Sign up</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>