<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Quản trị hệ thống - TechZone</title>
    <base href="<?= BASE_URL ?>"> 
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="assets_admin/images/icon/logo.png">
    
    <link rel="stylesheet" href="assets_admin/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets_admin/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets_admin/css/themify-icons.css">
    <link rel="stylesheet" href="assets_admin/css/metismenujs.min.css">
    <link rel="stylesheet" href="assets_admin/css/typography.css">
    <link rel="stylesheet" href="assets_admin/css/default-css.css">
    <link rel="stylesheet" href="assets_admin/css/styles.css">
    <link rel="stylesheet" href="assets_admin/css/responsive.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="page-container">
        
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="public_entry.php?url=home"><h2 class="text-white fw-bold"><i class="fa-solid fa-microchip text-primary"></i> TECHZONE</h2></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <li class="<?= isset($_GET['url']) && strpos($_GET['url'], 'dashboard') !== false ? 'active' : '' ?>">
                                <a href="public_entry.php?url=admin-dashboard"><i class="ti-dashboard"></i> <span>Tổng quan</span></a>
                            </li>
                            
                            <li class="<?= isset($_GET['url']) && strpos($_GET['url'], 'user') !== false ? 'active' : '' ?>">
                                <a href="public_entry.php?url=users"><i class="ti-user"></i> <span>Quản lý Thành viên</span></a>
                            </li>
                            
                            <li class="<?= isset($_GET['url']) && strpos($_GET['url'], 'product') !== false ? 'active' : '' ?>">
                                <a href="public_entry.php?url=admin-products"><i class="ti-package"></i> <span>Quản lý Sản phẩm</span></a>
                            </li>
                            
                            <li class="<?= isset($_GET['url']) && strpos($_GET['url'], 'order') !== false ? 'active' : '' ?>">
                                <a href="public_entry.php?url=admin-orders"><i class="ti-receipt"></i> <span>Quản lý Đơn hàng</span></a>
                            </li>
                            
                            <li class="<?= isset($_GET['url']) && strpos($_GET['url'], 'admin/about') !== false ? 'active' : '' ?>">
                                <a href="public_entry.php?url=admin/about-edit"><i class="ti-info-alt"></i> <span>Quản lý Giới thiệu</span></a>
                            </li>
                            
                            <li class="<?= isset($_GET['url']) && strpos($_GET['url'], 'contact') !== false ? 'active' : '' ?>">
    <a href="public_entry.php?url=admin/contacts"><i class="ti-email"></i> <span>Quản lý Liên hệ</span></a>
</li>

                            <li class="<?= isset($_GET['url']) && strpos($_GET['url'], 'admin/faq') !== false ? 'active' : '' ?>">
                                <a href="public_entry.php?url=admin/faq"><i class="ti-help-alt"></i> <span>Quản lý Hỏi đáp</span></a>
                            </li>
                            
                            <!-- 2 MỤC TIN TỨC VÀ BÌNH LUẬN ĐÃ ĐƯỢC CHUẨN HÓA LOGIC -->
                            <li class="<?= isset($_GET['url']) && strpos($_GET['url'], 'news') !== false ? 'active' : '' ?>">
                                <a href="public_entry.php?url=admin/news"><i class="ti-write"></i> <span>Quản lý Tin tức</span></a>
                            </li>
                            <li class="<?= isset($_GET['url']) && strpos($_GET['url'], 'comment') !== false ? 'active' : '' ?>">
                                <a href="public_entry.php?url=admin/comments"><i class="ti-comments"></i> <span>Quản lý Bình luận</span></a>
                            </li>
                            
                            <li class="mt-5"><a href="public_entry.php?url=home"><i class="ti-share-alt text-danger"></i> <span>Về trang Web khách</span></a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

        <div class="main-content">
            <div class="header-area">
                <div class="row align-items-center">
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn float-start">
                            <span></span><span></span><span></span>
                        </div>
                        <div class="search-box float-start">
                            <form action="public_entry.php" method="GET">
                                <input type="hidden" name="url" value="<?= htmlspecialchars($_GET['url'] ?? 'admin-products') ?>">
                                <input type="text" name="q" placeholder="Tìm kiếm nhanh..." value="<?= htmlspecialchars($_GET['q'] ?? '') ?>">
                                <i class="ti-search"></i>
                            </form>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area float-end">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title float-start">Admin Dashboard</h4>
                        </div>
                    </div>
                    <div class="col-sm-6 clearfix">
                        <div class="user-profile float-end">
                            <img class="avatar user-thumb" src="<?= $_SESSION['user_avatar'] ?? 'https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg' ?>" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-bs-toggle="dropdown"><?= $_SESSION['user_name'] ?? 'Admin' ?> <i class="fa-solid fa-angle-down"></i></h4>
                            <div class="dropdown-menu user-dropdown">
                                <a class="dropdown-item" href="public_entry.php?url=profile">Hồ sơ cá nhân</a>
                                <a class="dropdown-item user-dropdown-logout text-danger" href="javascript:void(0)" onclick="confirmLogout()">Đăng xuất</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main-content-inner mt-4">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
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