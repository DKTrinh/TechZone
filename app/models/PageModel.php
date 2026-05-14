<?php
class PageModel {
    private $db;
    public function __construct($db) { $this->db = $db; }

    // Lấy toàn bộ nội dung của trang About
    public function getAboutContent() {
        $stmt = $this->db->prepare("SELECT * FROM page_contents WHERE page_key LIKE 'about_%'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cập nhật nội dung theo key
    public function updateContent($key, $value) {
        $stmt = $this->db->prepare("UPDATE page_contents SET content_value = ? WHERE page_key = ?");
        return $stmt->execute([$value, $key]);
    }
}