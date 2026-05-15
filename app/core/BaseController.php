<?php

class BaseController {
    protected $db;

    public function __construct($db = null) {
        $this->db = $db;
    }

    public function render($viewPath, $data = []) {
        if (!empty($data)) {
            extract($data);
        }

        $file = __DIR__ . "/../views/" . $viewPath . ".php";
        
        if (file_exists($file)) {
            $isAdminView = strpos($viewPath, 'admin/') !== false;

            if (!$isAdminView) {
                require_once __DIR__ . '/../views/layouts/header.php';
            } 
            
            
            require_once $file;
            
            if (!$isAdminView) {
                require_once __DIR__ . '/../views/layouts/footer.php';
            } 
        } else {
            die("<div style='text-align:center; padding: 50px; font-family: sans-serif;'>
                    <h1 style='color: red;'>Lỗi Hệ Thống (404)</h1>
                    <p>Không tìm thấy tệp giao diện tại: <strong>{$viewPath}.php</strong></p>
                 </div>");
        }
    }

    public function redirect($url) {
        header("Location: " . $url);
        exit;
    }
}
