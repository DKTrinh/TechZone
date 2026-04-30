<?php
require_once __DIR__ . '/../config/db_config.php';

class ProductModel {
    private $db;
    public function __construct() { $this->db = Database::connect(); }

    public function getCoreTechnologies() {
        $stmt = $this->db->query("SELECT * FROM products LIMIT 6");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}