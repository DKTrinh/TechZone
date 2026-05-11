<?php
require_once "../app/models/UserModel.php";

class AdminUserController {
    private $userModel;
    public function __construct($db) { $this->userModel = new UserModel($db); }

    public function index() {
        $limit = 10; $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $offset = ($page - 1) * $limit;
        $users = $this->userModel->getUsers($limit, $offset);
        $total = $this->userModel->countUsers();
        $totalPages = ceil($total / $limit);
        
        require_once '../app/views/layouts/header.php';
        include "../app/views/admin/users/index.php";
        require_once '../app/views/layouts/footer.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->userModel->getUserByEmail($_POST['email'])) {
                $_SESSION['auth_status'] = 'error'; $_SESSION['auth_message'] = 'Email này đã tồn tại!';
            } else {
                $this->userModel->createUser($_POST['fullname'], $_POST['email'], $_POST['password'], $_POST['role']);
                $_SESSION['auth_status'] = 'success'; $_SESSION['auth_message'] = 'Đã thêm thành viên mới!';
            }
            header("Location: public_entry.php?url=users"); exit();
        }
    }

    public function update() {
        if (session_status() == PHP_SESSION_NONE) session_start();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';
            $gender = !empty($_POST['gender']) ? $_POST['gender'] : null;
            $birthdate = !empty($_POST['birthdate']) ? $_POST['birthdate'] : null;

            // XỬ LÝ UPLOAD ẢNH CHO ADMIN
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $targetDir = __DIR__ . "/../../public/assets/uploads/"; 
                if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);
                
                $fileName = time() . '_' . basename($_FILES['avatar']['name']);
                $targetPath = $targetDir . $fileName;
                
                // ĐÃ FIX LỖI NHÁY ĐƠN VÀ KÉP Ở ĐÂY
                if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetPath)) {
                    $dbPath = "assets/uploads/" . $fileName;
                    $this->userModel->updateAvatar($id, $dbPath);
                    if ($id == $_SESSION['user_id']) { $_SESSION['user_avatar'] = $dbPath; }
                }
            }

            // LƯU MỌI THÔNG TIN
            $this->userModel->updateUser($id, $fullname, $email, $role, $phone, $address, $gender, $birthdate);
            
            if ($id == $_SESSION['user_id']) { $_SESSION['user_name'] = $fullname; }

            $_SESSION['auth_status'] = 'success';
            $_SESSION['auth_message'] = 'Đã cập nhật dữ liệu thành công!';
            header("Location: public_entry.php?url=users");
            exit();
        }
    }

    public function lock() {
        if ($id = $_GET['id'] ?? null) {
            $this->userModel->lockUser($id);
            $_SESSION['auth_status'] = 'success'; $_SESSION['auth_message'] = 'Đổi trạng thái thành công.';
        }
        header("Location: public_entry.php?url=users"); exit();
    }

    public function resetPassword() {
        $id = $_POST['id'] ?? null; $type = $_POST['type'] ?? 'random'; $pass = $_POST['password'] ?? '';
        if (!$id) die(json_encode(['status' => 'error']));
        if ($type === 'random') { $pass = (string)rand(100000, 999999); }
        $this->userModel->resetPassword($id, $pass);
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'password' => $pass, 'type' => $type]); exit();
    }
}
?>