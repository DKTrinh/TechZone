<?php
// app/controllers/FaqController.php
require_once '../app/models/FaqModel.php';

class FaqController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Hiển thị trang FAQ cho khách hàng
     */
    public function index() {
        // 1. Khởi tạo Model để làm việc với Database
        $model = new FaqModel($this->db);

        // 2. Lấy danh sách 5 câu hỏi đã được Admin duyệt (status = 'answered')
        // Hàm getAnswered() này đã được định nghĩa trong FaqModel
        $faqs = $model->getForUser(); 

        // 3. Đóng gói dữ liệu vào mảng $data
        // Đây chính là biến mà file faqs.php đang mong chờ
        $data = [
            'faqs' => $faqs
        ];

        // 4. Nạp các thành phần giao diện
        // Lưu ý: Biến $data sẽ tự động "có mặt" trong file faqs.php khi được require
        require_once '../app/views/layouts/header.php';
        require_once '../app/views/pages/faqs.php';
        require_once '../app/views/layouts/footer.php';
    }

    // Thêm hàm này vào FaqController.php
public function userRequest() {
    // Đảm bảo trả về JSON "sạch" để AJAX xử lý được
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = trim($_POST['title'] ?? '');
        $question = trim($_POST['question'] ?? '');

        if (!empty($title) && !empty($question)) {
            $model = new FaqModel($this->db);
            // answer để null, status mặc định là 'pending'
            $result = $model->insert($title, $question, null, 'pending');

            if ($result) {
                echo json_encode(['status' => 'success']);
                exit;
            }
        }
    }
    
    echo json_encode(['status' => 'error', 'message' => 'Dữ liệu không hợp lệ']);
    exit;
}
}