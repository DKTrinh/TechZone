<?php
require_once __DIR__ . '/../core/BaseController.php';
require_once __DIR__ . '/../models/NewsModel.php';

class AdminNewsController extends BaseController {
    private $newsModel;
    public function __construct($db) {
        parent::__construct($db);
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') { header('Location: public_entry.php?url=login'); exit; }
        $this->newsModel = new NewsModel($this->db);
    }
    public function index() {
        $keyword = $_GET['search'] ?? '';
        $news = !empty($keyword) ? $this->newsModel->search($keyword) : $this->newsModel->getAllNews();
        include '../app/views/admin/news/index.php'; 
    }
    public function create() { include '../app/views/admin/news/create.php'; }
    
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $imagePath = $this->handleUpload() ?: $_POST['image'];
            $this->newsModel->create(['title' => $_POST['title'], 'content' => $_POST['content'], 'category' => $_POST['category'], 'badge' => $_POST['badge'], 'image' => $imagePath]);
            header('Location: public_entry.php?url=admin/news'); exit;
        }
    }
    public function edit() {
        $news = $this->newsModel->getById($_GET['id']);
        include '../app/views/admin/news/edit.php';
    }
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $oldItem = $this->newsModel->getById($id);
            $imagePath = $this->handleUpload() ?: (empty($_POST['image']) ? $oldItem['image'] : $_POST['image']);
            
            $this->newsModel->update($id, ['title' => $_POST['title'], 'content' => $_POST['content'], 'category' => $_POST['category'], 'badge' => $_POST['badge'], 'image' => $imagePath]);
            header('Location: public_entry.php?url=admin/news'); exit;
        }
    }
    public function delete() {
        if (isset($_GET['id'])) $this->newsModel->delete($_GET['id']);
        header('Location: public_entry.php?url=admin/news'); exit;
    }
    private function handleUpload() {
        if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
            $fileName = time() . '_' . basename($_FILES['image_file']['name']);
            move_uploaded_file($_FILES['image_file']['tmp_name'], __DIR__ . '/../../public/assets/uploads/' . $fileName);
            return 'assets/uploads/' . $fileName;
        }
        return null;
    }
}
