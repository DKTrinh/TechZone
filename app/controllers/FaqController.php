<?php
require_once '../app/models/FaqModel.php';
class FaqController {
    private $db;
    public function __construct($db) { $this->db = $db; }

    public function index() {
        $model = new FaqModel($this->db);
        $faqs = $model->getForUser(); 
        $data = ['faqs' => $faqs];
        
        require_once '../app/views/layouts/header.php';
        require_once '../app/views/pages/faqs.php';
        require_once '../app/views/layouts/footer.php';
    }

    public function userRequest() {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            $question = trim($_POST['question'] ?? '');
            if (!empty($title) && !empty($question)) {
                $model = new FaqModel($this->db);
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