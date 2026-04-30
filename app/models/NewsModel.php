<?php
require_once __DIR__ . '/../config/db_config.php';

class NewsModel {
    private $db;
    public function __construct() { $this->db = Database::connect(); }

    public function getSuccessStories() {
        $stmt = $this->db->query("SELECT * FROM news LIMIT 3");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}