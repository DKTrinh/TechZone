<?php
require_once __DIR__ . '/../models/UserModel.php';

class ProfileController {
    private $userModel;
    public function __construct($db) { $this->userModel = new UserModel($db); }

    private function requireAuth() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if (empty($_SESSION['user_id'])) { header('Location: public_entry.php?url=login'); exit; }
    }

    public function index() {
        $this->requireAuth();
        $user = $this->userModel->getUserById($_SESSION['user_id']);
        if (!$user) { session_destroy(); header('Location: public_entry.php?url=login'); exit; }
        
        require_once '../app/views/layouts/header.php';
        require_once '../app/views/profile/index.php';
        require_once '../app/views/layouts/footer.php';
    }

    public function update() {
        $this->requireAuth();
        $userId = $_SESSION['user_id'];
        
        // FIX LỖI CRASH DATABASE: Ép chuỗi rỗng thành NULL
        $gender = !empty($_POST['gender']) ? $_POST['gender'] : null;
        $birthdate = !empty($_POST['birthdate']) ? $_POST['birthdate'] : null;

        $data = [
            'fullname'  => trim($_POST['fullname'] ?? ''),
            'email'     => trim($_POST['email'] ?? ''),
            'phone'     => trim($_POST['phone'] ?? ''),
            'address'   => trim($_POST['address'] ?? ''),
            'gender'    => $gender,
            'birthdate' => $birthdate
        ];

        // 1. LƯU ẢNH
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "assets/uploads/"; // Lưu thẳng vào public/assets/uploads
            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
            
            $fileName = time() . '_' . basename($_FILES["avatar"]["name"]);
            $targetPath = $targetDir . $fileName;
            
            if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetPath)) {
                $this->userModel->updateAvatar($userId, $targetPath);
                $_SESSION['user_avatar'] = $targetPath; // Đổi ảnh header lập tức
            }
        }

        // 2. LƯU THÔNG TIN
        if ($this->userModel->updateProfile($userId, $data)) {
            $_SESSION['user_name'] = $data['fullname'];
            $_SESSION['auth_status'] = 'success';
            $_SESSION['auth_message'] = 'Đã lưu thay đổi thành công!';
        } else {
            $_SESSION['auth_status'] = 'error';
            $_SESSION['auth_message'] = 'Lưu thất bại! Email có thể đã bị trùng.';
        }
        
        header('Location: public_entry.php?url=profile'); exit;
    }

    public function changePassword() {
        $this->requireAuth();
        $userId = $_SESSION['user_id'];
        $current = $_POST['current_password'] ?? '';
        $new = $_POST['new_password'] ?? '';
        
        $hash = $this->userModel->getPasswordHash($userId);
        
        // Hỗ trợ trường hợp pass cũ chưa mã hóa (nếu bạn tạo tay trong phpmyadmin)
        if (password_verify($current, $hash) || $current === $hash) {
            $this->userModel->updatePassword($userId, password_hash($new, PASSWORD_BCRYPT));
            $_SESSION['auth_status'] = 'success';
            $_SESSION['auth_message'] = 'Cập nhật mật khẩu thành công!';
        } else {
            $_SESSION['auth_status'] = 'error';
            $_SESSION['auth_message'] = 'Mật khẩu hiện tại không đúng!';
        }
        header('Location: public_entry.php?url=profile'); exit;
    }

    public function checkCurrentPassword() {
        $this->requireAuth();
        $currentInput = $_POST['current_password'] ?? '';
        $hash = $this->userModel->getPasswordHash($_SESSION['user_id']);
        
        $isValid = password_verify($currentInput, $hash) || $currentInput === $hash;
        
        header('Content-Type: application/json');
        echo json_encode(['valid' => $isValid]);
        exit;
    }
}
?>