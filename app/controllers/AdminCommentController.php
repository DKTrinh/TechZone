<?php
require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/CommentModel.php';

class AdminCommentController extends BaseController {
    private $commentModel;
    public function __construct($db) {
        parent::__construct($db);
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') { header('Location: public_entry.php?url=login'); exit(); }
        $this->commentModel = new CommentModel($this->db);
    }

    public function index() {
        $keyword = $_GET['search'] ?? '';
        $comments = !empty($keyword) ? $this->commentModel->search($keyword) : $this->commentModel->getAllAdmin();
        include '../app/views/admin/comments/index.php'; // Ép gọi thẳng View để tích hợp Srtdash
    }

    public function delete() {
        if (isset($_GET['id'])) $this->commentModel->delete($_GET['id']);
        header('Location: public_entry.php?url=admin/comments'); exit();
    }
}