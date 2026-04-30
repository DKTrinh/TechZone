<?php
class PageController {
    public function show($pageName) {
        // Đường dẫn tới file view tương ứng
        $viewFile = "../app/views/pages/{$pageName}.php";

        // Kiểm tra xem file có tồn tại không
        if (file_exists($viewFile)) {
            require_once '../app/views/layouts/header.php';
            require_once $viewFile; // Nhúng nội dung file (solutions.php, contact.php...)
            require_once '../app/views/layouts/footer.php';
        } else {
            // Xử lý lỗi 404 nếu người dùng nhập sai link
            require_once '../app/views/layouts/header.php';
            echo "<div class='container text-center py-5' style='min-height: 60vh;'>
                    <h1 class='display-1 text-danger fw-bold mt-5'>404</h1>
                    <h2>Trang không tồn tại hoặc đang phát triển!</h2>
                  </div>";
            require_once '../app/views/layouts/footer.php';
        }
    }
}