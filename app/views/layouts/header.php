<?php
if (session_status() == PHP_SESSION_NONE) { session_start(); }

$isLoggedIn = isset($_SESSION['user_id']);
$defaultAvatar = 'https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg';

// Giá trị mặc định
$userName = 'Tài khoản';
$userRole = '';
$userAvatar = $defaultAvatar;

if ($isLoggedIn) {
    // 1. Kết nối Database và Model trực tiếp trong Header để lấy thông tin MỚI NHẤT
    require_once __DIR__ . '/../../models/UserModel.php';
    if (!isset($db)) { require_once __DIR__ . '/../../config/db_config.php'; $db = Database::connect(); }
    
    $headerUserModel = new UserModel($db);
    $freshUser = $headerUserModel->getUserById($_SESSION['user_id']);
    
    if ($freshUser) {
        // 2. Gán dữ liệu mới nhất hiển thị ra Header
        $userName = $freshUser['fullname'];
        $userRole = $freshUser['role'];
        $userAvatar = !empty($freshUser['avatar']) ? $freshUser['avatar'] : $defaultAvatar;
        
        // 3. Cập nhật luôn lại vào Session để đồng bộ
        $_SESSION['user_name'] = $userName;
        $_SESSION['user_role'] = $userRole;
        $_SESSION['user_avatar'] = $userAvatar;
    }
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
</head>
<body>

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
            <input type="text" name="q" placeholder="Bạn tìm gì? Laptop, điện thoại, phụ kiện..." id="searchInput">
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
                    <div data-bs-toggle="dropdown" style="text-align: center;">
                        <img src="<?= htmlspecialchars($userAvatar) ?>" class="rounded-circle shadow-sm" width="28" height="28" style="object-fit:cover"><br>
                        <span style="font-size: 13px; font-weight: 500;"><?= htmlspecialchars($userName) ?></span>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-3">
                        <?php if($userRole === 'admin'): ?>
                            <li><a class="dropdown-item" href="public_entry.php?url=users"><i class="fas fa-cogs me-2"></i> Quản trị hệ thống</a></li>
                        <?php endif; ?>
                        <li><a class="dropdown-item" href="public_entry.php?url=profile"><i class="fas fa-user-circle me-2"></i> Hồ sơ cá nhân</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-clipboard-list me-2"></i> Lịch sử đơn hàng</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger fw-bold" href="javascript:void(0)" onclick="confirmLogout()"><i class="fas fa-sign-out-alt me-2"></i> Đăng xuất</a></li>
                    </ul>
                </div>
            <?php endif; ?>

            <a href="public_entry.php?url=cart" class="action-item cart-badge">
                <i class="fas fa-shopping-bag"></i>
                <span>Giỏ hàng</span>
                <span class="badge" id="cartCount">0</span>
            </a>
        </div>
    </div>
</div>

<div class="nav-category">
    <div class="container">
        <ul class="nav-list">
            <li><a href="#">Điện thoại</a></li>
            <li><a href="#">Laptop</a></li>
            <li><a href="#">Máy tính bảng</a></li>
            <li><a href="#">Tai nghe</a></li>
            <li><a href="#">Đồng hồ thông minh</a></li>
            <li><a href="#">Phụ kiện</a></li>
            <li><a href="#">Máy ảnh</a></li>
            <li><a href="#">Smart Home</a></li>
        </ul>
    </div>
</div>

<div class="modal fade" id="loginModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content auth-modal-content">
            <div class="row g-0">
                <div class="col-md-5 auth-left d-none d-md-flex flex-column justify-content-between">
                    <div style="position: relative; z-index: 2;">
                        <div class="mb-5 d-flex align-items-center fw-bold fs-5"><i class="fas fa-microchip me-2"></i> TECHZONE</div>
                        <h2 class="fw-bold display-6 mb-3" id="auth-side-title">Mừng bạn trở lại!</h2>
                        <p class="text-white-50" id="auth-side-desc">Đăng nhập để nhận ngay hàng ngàn ưu đãi mua sắm công nghệ tốt nhất.</p>
                    </div>
                </div>

                <div class="col-md-7 auth-right">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"></button>
                    <div id="login-form-container" class="fade-form">
                        <h3 class="fw-bold mb-4">Đăng nhập</h3>
                        <?php if (isset($_SESSION['auth_status']) && $_SESSION['auth_status'] === 'locked'): ?>
                            <div class="account-locked-notice">
                                <p class="text-danger small mb-0 fw-bold"><i class="bi bi-exclamation-octagon-fill me-2"></i>Tài khoản bị khóa.</p>
                            </div>
                        <?php endif; ?>
                        <form action="public_entry.php?url=login" method="POST">
                            <input type="hidden" name="csrf_token" value="<?= CsrfHelper::generateToken() ?? ''; ?>">
                            <div class="mb-3">
                                <label class="small text-muted fw-bold">Email</label>
                                <input type="email" name="email" class="form-control form-control-auth" required>
                            </div>
                            <div class="mb-3">
                                <label class="small text-muted fw-bold">Mật khẩu</label>
                                <input type="password" name="password" class="form-control form-control-auth" required>
                            </div>
                            <button type="submit" class="btn-auth-primary mb-4 shadow">Vào hệ thống</button>
                            <p class="text-center small text-muted">Chưa có tài khoản? <span class="switch-link" onclick="toggleAuth('signup')">Đăng ký ngay</span></p>
                        </form>
                    </div>

                    <div id="signup-form-container" class="fade-form" style="display: none;">
                        <h3 class="fw-bold mb-4">Tạo tài khoản</h3>
                        <form action="public_entry.php?url=register" method="POST">
                            <input type="hidden" name="csrf_token" value="<?= CsrfHelper::generateToken() ?? ''; ?>">
                            <div class="mb-2"><label class="small text-muted fw-bold">Họ tên</label><input type="text" name="full_name" class="form-control form-control-auth" required></div>
                            <div class="mb-2"><label class="small text-muted fw-bold">Email</label><input type="email" name="email" class="form-control form-control-auth" required></div>
                            <div class="mb-3"><label class="small text-muted fw-bold">Mật khẩu</label><input type="password" name="password" class="form-control form-control-auth" required></div>
                            <button type="submit" class="btn-auth-primary mb-4 shadow">Đăng ký tài khoản</button>
                            <p class="text-center small text-muted">Đã có tài khoản? <span class="switch-link" onclick="toggleAuth('login')">Đăng nhập ngay</span></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>