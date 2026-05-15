<?php
require_once __DIR__ . '/../config/db_config.php';

class BaseModel {
    protected $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function fetchAll($sql, $params = []) {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Lỗi truy vấn (fetchAll): " . $e->getMessage());
        }
    }

    public function fetchOne($sql, $params = []) {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Lỗi truy vấn (fetchOne): " . $e->getMessage());
        }
    }

    public function execute($sql, $params = []) {
        try {
            $stmt = $this->db->prepare($sql);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            die("Lỗi thực thi (execute): " . $e->getMessage());
        }
    }
}
?>
