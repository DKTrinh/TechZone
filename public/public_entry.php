<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];
$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])); 
$baseUrl = $protocol . "://" . $host . $scriptDir . "/";

define('BASE_URL', $baseUrl);

// Nhúng các file Core & Helpers
require_once '../app/helpers/SessionHelper.php';
require_once '../app/helpers/CsrfHelper.php';
require_once '../app/config/db_config.php'; 
require_once '../app/core/Database.php'; 

SessionHelper::start();
// Chú ý: Dùng getConnection() theo đúng chuẩn class Database hiện tại
$db = Database::getConnection();
$url = $_GET['url'] ?? 'home';

switch ($url) {
    // =====================================
    // 1. AUTH & PROFILE (TÀI KHOẢN CÁ NHÂN)
    // =====================================
    case 'login':
    case 'register':
    case 'logout':
        require_once '../app/controllers/AuthController.php';
        $app = new AuthController($db);
        if ($url === 'login') ($_SERVER['REQUEST_METHOD'] === 'GET') ? $app->showLogin() : $app->login();
        elseif ($url === 'register') ($_SERVER['REQUEST_METHOD'] === 'GET') ? $app->showRegister() : $app->register();
        else { SessionHelper::destroy(); header('Location: ' . BASE_URL . 'public_entry.php?url=home'); exit; }
        break;

    case 'profile':
    case 'profile-update':
    case 'profile-password':
    case 'profile-avatar':
    case 'profile-check-pass':
        require_once '../app/controllers/ProfileController.php';
        $app = new ProfileController($db);
        if ($url === 'profile') $app->index();
        elseif ($url === 'profile-update') $app->update();
        elseif ($url === 'profile-password') $app->changePassword();
        elseif ($url === 'profile-avatar') $app->uploadAvatar();
        elseif ($url === 'profile-check-pass') $app->checkCurrentPassword();
        break;

    // =====================================
    // 2. CÁC TRANG PUBLIC CHUNG (KHÁCH VÃNG LAI)
    // =====================================
    case 'home':
        require_once '../app/controllers/HomeController.php';
        (new HomeController($db))->index();
        break;

    case 'about':
        require_once '../app/controllers/AboutController.php';
        (new AboutController($db))->index();
        break;
        
    // BỔ SUNG VÀO KHỐI PUBLIC (Dành cho trang Khách)
    case 'contact':
        require_once '../app/controllers/ContactController.php';
        (new ContactController($db))->index();
        break;
    case 'contact/save':
        require_once '../app/controllers/ContactController.php';
        (new ContactController($db))->save();
        break;

    // BỔ SUNG VÀO KHỐI ADMIN (Quản lý Liên hệ)
    case 'admin/contacts':
    case 'admin/contacts/status':
    case 'admin/contacts/delete':
        require_once '../app/controllers/AdminContactController.php';
        $contactAdmin = new AdminContactController($db);
        if ($url === 'admin/contacts') $contactAdmin->index();
        elseif ($url === 'admin/contacts/status') $contactAdmin->updateStatus();
        elseif ($url === 'admin/contacts/delete') $contactAdmin->delete();
        break;

    case 'faqs':
    case 'faq/user-request':
        require_once '../app/controllers/FaqController.php';
        if ($url === 'faqs') (new FaqController($db))->index();
        elseif ($url === 'faq/user-request') (new FaqController($db))->userRequest();
        break;

    case 'solutions':
    case 'technology':
    case 'case-studies':
    case 'team':
        require_once '../app/controllers/PageController.php';
        $app = new PageController($db);
        if ($url === 'solutions') $app->solutions();
        else $app->technology(); 
        break;

    // =====================================
    // 3. SẢN PHẨM & GIỎ HÀNG & ĐƠN HÀNG (NHÁNH 3)
    // =====================================
    case 'products':
        require_once '../app/controllers/ProductController.php';
        (new ProductController($db))->index();
        break;
        
    case 'product-detail':
        require_once '../app/controllers/ProductController.php';
        (new ProductController($db))->detail();
        break;

    case 'cart':
    case 'cart-add-ajax':
    case 'cart-remove':
    case 'update-cart':
    case 'apply-coupon':
    case 'checkout':
    case 'checkout-process':
    case 'my-orders':
    case 'buy-now':
        require_once '../app/controllers/OrderController.php';
        $orderApp = new OrderController($db);
        if ($url === 'cart') $orderApp->cartIndex();
        elseif ($url === 'cart-add-ajax') $orderApp->addToCartAjax();
        elseif ($url === 'cart-remove') $orderApp->removeFromCart();
        elseif ($url === 'update-cart') $orderApp->updateCartAjax();
        elseif ($url === 'apply-coupon') $orderApp->applyCouponAjax();
        elseif ($url === 'checkout') $orderApp->checkout();
        elseif ($url === 'buy-now') $orderApp->buyNow();
        elseif ($url === 'checkout-process') $orderApp->processCheckout();
        elseif ($url === 'my-orders') $orderApp->myOrders();
        break;

    // =====================================
    // 4. KHU VỰC QUẢN TRỊ VIÊN (ADMIN DASHBOARD)
    // =====================================
    // A. Quản lý Thành viên
    case 'users':
    case 'user-edit':
    case 'user-update':
    case 'user-lock':
    case 'user-reset':
    case 'user-store':
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            echo "<script>alert('Từ chối truy cập!'); window.location.href='" . BASE_URL . "public_entry.php?url=home';</script>"; exit;
        }
        require_once '../app/controllers/AdminUserController.php';
        $adminUserApp = new AdminUserController($db);
        if ($url === 'users') $adminUserApp->index();
        elseif ($url === 'user-edit') $adminUserApp->edit();
        elseif ($url === 'user-update') $adminUserApp->update();
        elseif ($url === 'user-lock') $adminUserApp->lock();
        elseif ($url === 'user-reset') $adminUserApp->resetPassword();
        elseif ($url === 'user-store') $adminUserApp->store();
        break;

    // B. Quản lý Sản phẩm
    case 'admin-products':
    case 'admin-product-store':
    case 'admin-product-update':
    case 'admin-product-delete':
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') { header('Location: ' . BASE_URL . 'public_entry.php?url=home'); exit; }
        require_once '../app/controllers/AdminProductController.php';
        $adminProdApp = new AdminProductController();
        if ($url === 'admin-products') $adminProdApp->index();
        elseif ($url === 'admin-product-store') $adminProdApp->store();
        elseif ($url === 'admin-product-update') $adminProdApp->update();
        elseif ($url === 'admin-product-delete') $adminProdApp->delete();
        break;

    // C. Quản lý Đơn hàng
    case 'admin-orders':
    case 'admin-order-update':
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') { header('Location: ' . BASE_URL . 'public_entry.php?url=home'); exit; }
        require_once '../app/controllers/AdminOrderController.php';
        $adminOrderApp = new AdminOrderController($db);
        if ($url === 'admin-orders') $adminOrderApp->index();
        elseif ($url === 'admin-order-update') $adminOrderApp->updateStatus();
        break;

    // D. Quản lý FAQ
    case 'admin/faq':
    case 'admin/faq/edit':
    case 'admin/faq/update':
    case 'admin/faq/delete':
    case 'admin/faq/create':
    case 'admin/faq/store':
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') { header('Location: ' . BASE_URL . 'public_entry.php?url=home'); exit; }
        require_once '../app/controllers/AdminFaqController.php';
        $faqAdmin = new AdminFaqController($db);
        if ($url === 'admin/faq') $faqAdmin->index();
        elseif ($url === 'admin/faq/create') $faqAdmin->create();
        elseif ($url === 'admin/faq/store') $faqAdmin->store();
        elseif ($url === 'admin/faq/edit') $faqAdmin->edit();
        elseif ($url === 'admin/faq/update') $faqAdmin->update();
        elseif ($url === 'admin/faq/delete') $faqAdmin->delete();
        break;

    // E. Quản lý Nội dung trang About
    case 'admin/about-edit':
    case 'admin/about-update':
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') { header('Location: ' . BASE_URL . 'public_entry.php?url=home'); exit; }
        require_once '../app/controllers/AdminPageController.php';
        $adminPageApp = new AdminPageController($db);
        if ($url === 'admin/about-edit') $adminPageApp->editAbout();
        elseif ($url === 'admin/about-update') $adminPageApp->updateAbout();
        break;

    // Dashboard Tổng quan
    case 'admin-dashboard':
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') { 
            header('Location: ' . BASE_URL . 'public_entry.php?url=home'); 
            exit; 
        }
        require_once '../app/controllers/AdminDashboardController.php';
        $adminDash = new AdminDashboardController($db);
        $adminDash->index();
        break;
        
    // BỔ SUNG VÀO KHỐI ADMIN
    case 'admin/news':
    case 'admin/news/create':
    case 'admin/news/store':
    case 'admin/news/edit':
    case 'admin/news/update':
    case 'admin/news/delete':
        require_once '../app/controllers/AdminNewsController.php';
        $newsAdmin = new AdminNewsController($db);
        if ($url === 'admin/news') $newsAdmin->index();
        elseif ($url === 'admin/news/create') $newsAdmin->create();
        elseif ($url === 'admin/news/store') $newsAdmin->store();
        elseif ($url === 'admin/news/edit') $newsAdmin->edit();
        elseif ($url === 'admin/news/update') $newsAdmin->update();
        elseif ($url === 'admin/news/delete') $newsAdmin->delete();
        break;

    case 'admin/comments':
    case 'admin/comments/delete':
        require_once '../app/controllers/AdminCommentController.php';
        $commentAdmin = new AdminCommentController($db);
        if ($url === 'admin/comments') $commentAdmin->index();
        elseif ($url === 'admin/comments/delete') $commentAdmin->delete();
        break;

    case 'news/comment':
        require_once '../app/controllers/NewsController.php';
        (new NewsController($db))->addComment();
        break;
    case 'news':
    case 'news/detail':
        require_once '../app/controllers/NewsController.php';
        $newsApp = new NewsController($db);
        if ($url === 'news') {
            $newsApp->index();
        } elseif ($url === 'news/detail') {
            $newsApp->detail();
        }
        break;
        
    // =====================================
    // 5. TRANG 404 (KHÔNG TÌM THẤY URL)
    // =====================================
    default:
        require_once '../app/views/layouts/header.php';
        echo "<div class='container my-5 text-center'>
                <h1 class='display-1 text-danger fw-bold mt-5'>404</h1>
                <h2 class='text-muted mb-5'>Trang không tồn tại hoặc đang được phát triển!</h2>
                <a href='" . BASE_URL . "public_entry.php?url=home' class='btn btn-primary fw-bold px-4 py-2'><i class='fas fa-home me-2'></i>Về trang chủ</a>
              </div>";
        require_once '../app/views/layouts/footer.php';
        break;
}