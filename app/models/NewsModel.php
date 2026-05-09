<?php
class NewsModel {
    private $conn;
    
    public function __construct() {
        // Kết nối database trực tiếp trong model
        $host = 'localhost';
        $dbname = 'cleantech';
        $username = 'root';
        $password = '';
        
        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Kết nối database thất bại: " . $e->getMessage());
        }
    }
    
    // Lấy tin tức mới nhất cho trang chủ
    public function getLatestNews($limit = 3) {
        $query = "SELECT * FROM news ORDER BY created_at DESC LIMIT :limit";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>