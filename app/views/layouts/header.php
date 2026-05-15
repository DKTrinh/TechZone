<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }

$isLoggedIn = isset($_SESSION['user_id']);
$defaultAvatar = 'assets/uploads/products/31.png';

// Giá trị mặc định
$userName = 'Tài khoản';
$userRole = '';
$userAvatar = $defaultAvatar;
$cartCount = 0; 

if ($isLoggedIn) {
    // 1. Kết nối Database và Model
    require_once __DIR__ . '/../../models/UserModel.php';
    require_once __DIR__ . '/../../core/Database.php'; 
    
    if (!isset($db)) { require_once __DIR__ . '/../../config/db_config.php'; $db = Database::getConnection(); }
    
    $headerUserModel = new UserModel($db);
    $freshUser = $headerUserModel->getUserById($_SESSION['user_id']);
    
    if ($freshUser) {
        $userName = $freshUser['fullname'];
        $userRole = $freshUser['role'];
        $userAvatar = !empty($freshUser['avatar']) ? $freshUser['avatar'] : $defaultAvatar;
        
        $_SESSION['user_name'] = $userName;
        $_SESSION['user_role'] = $userRole;
        $_SESSION['user_avatar'] = $userAvatar;
    }

    // 2. Logic giỏ hàng cá nhân hóa (Chỉ khi đăng nhập mới đếm)
    $currentUserId = $_SESSION['user_id'];
    $userCart = $_SESSION['user_cart'][$currentUserId] ?? [];
    $cartCount = count($userCart);
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechZone - Siêu thị công nghệ & điện máy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        /* Sửa thanh trượt (Scrollbar) cho toàn trang */
        ::-webkit-scrollbar { width: 8px; height: 8px; }
        ::-webkit-scrollbar-track { background: #f8f9fa; }
        ::-webkit-scrollbar-thumb { background: #c1c2c5; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #a8a9ab; }

        /* CSS làm đẹp Filter */
        .custom-filter-card {
            border-radius: 16px;
            transition: all 0.3s ease;
            background: #fff;
            border: 1px solid #edf2f7;
        }
        .custom-filter-card:hover {
            box-shadow: 0 10px 25px rgba(0,0,0,0.08) !important;
        }
        .custom-filter-select {
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            padding: 10px 15px;
            font-size: 0.95rem;
            color: #4a5568;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .custom-filter-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
        }
        .custom-btn-filter {
            border-radius: 10px;
            background: linear-gradient(90deg, #38bdf8 0%, #3b82f6 100%);
            border: none;
            padding: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        /* CSS Ẩn/Hiện mật khẩu */
        .password-toggle-icon {
            cursor: pointer;
            color: #9ca3af;
            transition: color 0.2s;
        }
        .password-toggle-icon:hover {
            color: #3b82f6;
        }
    </style>
</head>
<body>

<?php if (isset($_SESSION['success_message'])): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Thành công!',
            text: '<?= addslashes($_SESSION['success_message']) ?>',
            showConfirmButton: false,
            timer: 2000
        });
    });
</script>
<?php unset($_SESSION['success_message']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'error',
            title: 'Thất bại!',
            text: '<?= addslashes($_SESSION['error_message']) ?>',
            showConfirmButton: false,
            timer: 2000
        });
    });
</script>
<?php unset($_SESSION['error_message']); ?>
<?php endif; ?>

<div class="header-top">
    <div class="container d-flex justify-content-between">
        <div class="hotline"><i class="fas fa-phone-alt me-2"></i> Hotline: 1900 6888 (7:30 - 22:00)</div>
        <div class="policy">
            <i class="fas fa-shield-alt me-2"></i> Bảo hành chính hãng 12 tháng
            <span class="ms-4"><i class="fas fa-truck me-2"></i> Giao miễn phí toàn quốc</span>
        </div>
    </div>
</div>

<div class="main-header">
    <div class="container header-content">
        <a href="public_entry.php?url=home" class="logo">
            <h1>TechZone <i class="fas fa-microchip"></i></h1>
            <span>Công nghệ đỉnh cao - Giá sốc mỗi ngày</span>
        </a>
        
        <form class="search-bar" action="public_entry.php" method="GET">
            <input type="hidden" name="url" value="products">
            <input type="text" name="q" placeholder="Bạn tìm gì? Laptop, điện thoại, phụ kiện..." id="searchInput" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
            <button type="submit" id="searchBtn"><i class="fas fa-search"></i></button>
        </form>

        <div class="menu-dropdown-hover action-item">
            <i class="fas fa-bars"></i>
            <div class="dropdown-content text-start">
                <a href="public_entry.php?url=home"><i class="fas fa-home me-2"></i> Trang chủ</a>
                <a href="public_entry.php?url=about"><i class="fas fa-info-circle me-2"></i> Giới thiệu</a>
                <a href="public_entry.php?url=products"><i class="fas fa-box-open me-2"></i> Sản phẩm</a>
                <a href="public_entry.php?url=news"><i class="fas fa-newspaper me-2"></i> Tin tức</a>
                <a href="public_entry.php?url=faqs"><i class="fas fa-question-circle me-2"></i> FAQs</a>
                <a href="public_entry.php?url=contact"><i class="fas fa-envelope me-2"></i> Liên hệ</a>
            </div>
        </div>

        <div class="header-actions">
            <?php if (!$isLoggedIn): ?>
                <a href="#" class="action-item" data-bs-toggle="modal" data-bs-target="#loginModal">
                    <i class="far fa-user-circle"></i>
                    <span>Tài khoản</span>
                </a>
            <?php else: ?>
                <div class="dropdown action-item">
                    <div data-bs-toggle="dropdown" style="text-align: center; cursor: pointer;">
                        <img src="<?= htmlspecialchars($userAvatar) ?>" class="rounded-circle shadow-sm" width="28" height="28" style="object-fit:cover"><br>
                        <span style="font-size: 13px; font-weight: 500;"><?= htmlspecialchars($userName) ?></span>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3">
                        <?php if($userRole === 'admin'): ?>
                            <li><a class="dropdown-item" href="public_entry.php?url=admin-dashboard"><i class="fas fa-cogs me-2"></i> Quản trị hệ thống</a></li>
                        <?php endif; ?>
                        <li><a class="dropdown-item" href="public_entry.php?url=profile"><i class="fas fa-user-circle me-2"></i> Hồ sơ cá nhân</a></li>
                        <li><a class="dropdown-item" href="public_entry.php?url=my-orders"><i class="fas fa-clipboard-list me-2"></i> Lịch sử đơn hàng</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger fw-bold" href="javascript:void(0)" onclick="confirmLogout()"><i class="fas fa-sign-out-alt me-2"></i> Đăng xuất</a></li>
                    </ul>
                </div>
            <?php endif; ?>

            <a href="public_entry.php?url=cart" class="action-item cart-badge">
                <i class="fas fa-shopping-bag"></i>
                <span>Giỏ hàng</span>
                <span class="badge" id="cartCount"><?= $cartCount ?></span>
            </a>
        </div>
    </div>
</div>

<div class="nav-category">
    <div class="container">
        <ul class="nav-list">
            <li><a href="public_entry.php?url=products&category=1">Điện thoại</a></li>
            <li><a href="public_entry.php?url=products&category=2">Laptop</a></li>
            <li><a href="public_entry.php?url=products&category=3">Đồng hồ thông minh</a></li>
            <li><a href="public_entry.php?url=products&category=4">Phụ kiện</a></li>
            <li><a href="public_entry.php?url=products&category=5">Máy tính bảng</a></li>
            <li><a href="public_entry.php?url=products&category=6">Tai nghe</a></li>
            <li><a href="public_entry.php?url=products&category=7">Máy ảnh</a></li>
            <li><a href="public_entry.php?url=products&category=8">Smart Home</a></li>
        </ul>
    </div>
</div>

<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content auth-modal-content overflow-hidden border-0 shadow-lg">
            <div class="row g-0">
                <div class="col-md-5 auth-left d-none d-md-flex flex-column justify-content-between" style="background: linear-gradient(180deg, #1e3c72 0%, #2a5298 100%); padding: 40px; color: white;">
                    <div style="position: relative; z-index: 2;">
                        <div class="mb-5 d-flex align-items-center fw-bold fs-5"><i class="fas fa-microchip me-2"></i> TECHZONE</div>
                        <h2 class="fw-bold display-6 mb-3" id="auth-side-title">Mừng bạn trở lại!</h2>
                        <p class="text-white-50" id="auth-side-desc">Đăng nhập để nhận ngay hàng ngàn ưu đãi mua sắm công nghệ tốt nhất.</p>
                    </div>
                </div>

                <div class="col-md-7 auth-right p-5 position-relative bg-white">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
                    
                    <div id="login-form-container" class="fade-form">
                        <h3 class="fw-bold mb-4 text-dark">Đăng nhập</h3>
                        
                        <?php if (isset($_SESSION['auth_status']) && $_SESSION['auth_status'] === 'locked'): ?>
                            <div class="alert alert-danger py-2 border-0 mb-3">
                                <p class="small mb-0 fw-bold"><i class="bi bi-exclamation-octagon-fill me-2"></i> Tài khoản bị khóa.</p>
                            </div>
                        <?php endif; ?>
                        
                        <form action="public_entry.php?url=login" method="POST" id="loginForm" onsubmit="return validateAuthForm('login')">
                            <input type="hidden" name="csrf_token" value="<?= CsrfHelper::generateToken() ?? ''; ?>">
                            <div class="mb-3">
                                <label class="small text-muted fw-bold mb-1">Email</label>
                                <input type="email" name="email" id="popup_email" class="form-control form-control-auth" placeholder="name@mail.com" required>
                            </div>
                            <div class="mb-3">
                                <label class="small text-muted fw-bold mb-1">Mật khẩu</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="popup_password" class="form-control form-control-auth border-end-0" placeholder="••••••••••••" required>
                                    <span class="input-group-text bg-white border-start-0" style="border-radius: 0 10px 10px 0;">
                                        <i class="far fa-eye password-toggle-icon" onclick="togglePasswordVisibility('popup_password', this)"></i>
                                    </span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mb-3 shadow-sm w-100 py-2 fw-bold border-0 custom-btn-filter">Vào hệ thống</button>
                            <p class="text-center small text-muted mb-4">Chưa có tài khoản? <span class="text-primary fw-bold cursor-pointer" style="cursor: pointer;" onclick="toggleAuth('signup')">Đăng ký ngay</span></p>
                        </form>
                    </div>

                    <div id="signup-form-container" class="fade-form" style="display: none;">
                        <h3 class="fw-bold mb-4 text-dark">Tạo tài khoản</h3>
                        
                        <form action="public_entry.php?url=register" method="POST" id="signupForm" onsubmit="return validateAuthForm('signup')">
                            <input type="hidden" name="csrf_token" value="<?= CsrfHelper::generateToken() ?? ''; ?>">
                            <div class="mb-2">
                                <label class="small text-muted fw-bold mb-1">Họ tên</label>
                                <input type="text" name="full_name" class="form-control form-control-auth" required>
                            </div>
                            <div class="mb-2">
                                <label class="small text-muted fw-bold mb-1">Email</label>
                                <input type="email" name="email" class="form-control form-control-auth" required>
                            </div>
                            <div class="mb-3">
                                <label class="small text-muted fw-bold mb-1">Mật khẩu</label>
                                <div class="input-group">
                                    <input type="password" name="password" id="popup_signup_password" class="form-control form-control-auth border-end-0" placeholder="••••••••••••" required>
                                    <span class="input-group-text bg-white border-start-0" style="border-radius: 0 10px 10px 0;">
                                        <i class="far fa-eye password-toggle-icon" onclick="togglePasswordVisibility('popup_signup_password', this)"></i>
                                    </span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mb-3 shadow-sm w-100 py-2 fw-bold border-0 custom-btn-filter">Đăng ký tài khoản</button>
                            <p class="text-center small text-muted mb-0">Đã có tài khoản? <span class="text-primary fw-bold cursor-pointer" style="cursor: pointer;" onclick="toggleAuth('login')">Đăng nhập ngay</span></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleAuth(type) {
        const loginContainer = document.getElementById('login-form-container');
        const signupContainer = document.getElementById('signup-form-container');
        const sideTitle = document.getElementById('auth-side-title');
        const sideDesc = document.getElementById('auth-side-desc');
        
        if (type === 'signup') {
            loginContainer.style.display = 'none';
            signupContainer.style.display = 'block';
            if(sideTitle) sideTitle.innerText = "Tham gia cùng TechZone!";
            if(sideDesc) sideDesc.innerText = "Tạo tài khoản ngay hôm nay để nhận đặc quyền thành viên và quản lý đơn hàng tốt hơn.";
        } else {
            loginContainer.style.display = 'block';
            signupContainer.style.display = 'none';
            if(sideTitle) sideTitle.innerText = "Mừng bạn trở lại!";
            if(sideDesc) sideDesc.innerText = "Đăng nhập để nhận ngay hàng ngàn ưu đãi mua sắm công nghệ tốt nhất.";
        }
    }

    // Hàm ẩn/hiện mật khẩu
    function togglePasswordVisibility(inputId, iconElement) {
        const input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
            iconElement.classList.remove('fa-eye');
            iconElement.classList.add('fa-eye-slash');
        } else {
            input.type = "password";
            iconElement.classList.remove('fa-eye-slash');
            iconElement.classList.add('fa-eye');
        }
    }

    // Hàm kiểm tra mật khẩu hợp lệ trước khi gửi form (Đăng nhập và Đăng ký)
    function validateAuthForm(formType) {
        // Lấy đúng ID của ô input mật khẩu dựa theo form đang điền
        let passInputId = formType === 'login' ? 'popup_password' : 'popup_signup_password';
        let passInput = document.getElementById(passInputId);
        
        // Kiểm tra độ dài
        if (passInput.value.length < 6) {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi xác thực',
                text: 'Mật khẩu bắt buộc phải có ít nhất 6 ký tự!',
                showConfirmButton: false,
                timer: 2000 // Tự động tắt popup sau 2 giây
            });
            passInput.focus();
            passInput.classList.add('is-invalid');
            return false; // Ngăn chặn form submit lên server
        }
        
        passInput.classList.remove('is-invalid');
        return true; // Cho phép dữ liệu được gửi đi
    }

    function confirmLogout() {
        Swal.fire({
            title: 'Xác nhận đăng xuất?',
            text: "Bạn có chắc chắn muốn thoát khỏi hệ thống?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#e74c3c',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Đăng xuất',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'public_entry.php?url=logout';
            }
        });
    }
</script>
</body>
</html>