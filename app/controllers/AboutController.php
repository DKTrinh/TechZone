<?php
// app/controllers/AboutController.php
require_once '../app/models/PageModel.php';

class AboutController {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        $model = new PageModel($this->db);
        $rawContents = $model->getAboutContent(); // Lấy mảng phẳng từ DB

        // Chuyển đổi mảng phẳng thành mảng có Key để View dễ gọi
        // Ví dụ: từ ['page_key' => 'about_history', ...] thành $contents['about_history']
        $contents = [];
        foreach ($rawContents as $row) {
            $contents[$row['page_key']] = [
                'section_name' => $row['section_name'],
                'content_value' => $row['content_value']
            ];
        }

        // Truyền biến $contents vào View
        require_once '../app/views/layouts/header.php';
        require_once '../app/views/pages/about.php';
        require_once '../app/views/layouts/footer.php';
    }
}