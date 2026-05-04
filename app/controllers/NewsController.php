<?php
class NewsController {
    private $db;
    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        $pageTitle = "Tin tức - CleanTech";
        require_once '../app/views/layouts/header.php';
        // Gọi file view tin tức
        require_once '../app/views/pages/news.php'; 
        require_once '../app/views/layouts/footer.php';
    }
}