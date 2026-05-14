<?php
require_once '../app/models/PageModel.php';

class AdminPageController {
    private $db;
    public function __construct($db) { $this->db = $db; }

    public function editAbout() {
        $model = new PageModel($this->db);
        $contents = $model->getAboutContent();
        include '../app/views/admin/pages/about_edit.php';
    }

    public function updateAbout() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = new PageModel($this->db);
            if (isset($_POST['content'])) {
                foreach ($_POST['content'] as $key => $value) {
                    $model->updateContent($key, trim($value));
                }
                $_SESSION['success_message'] = "Cập nhật nội dung TechZone thành công!";
            }
            header("Location: public_entry.php?url=admin/about-edit");
            exit();
        } else {
            header("Location: public_entry.php?url=admin/about-edit");
            exit();
        }
    }
}