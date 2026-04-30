<?php
class AuthController {
    public function login() {
        // Chỉ gọi nguyên giao diện trang login, không cần header/footer chung
        require_once '../app/views/auth/login_page.php';
    }
}