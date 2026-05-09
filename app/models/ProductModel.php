<?php
class ProductModel {
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
    
    // Lấy sản phẩm nổi bật cho trang chủ
    public function getFeaturedProducts($limit = 8) {
        $query = "SELECT * FROM products LIMIT :limit";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Lấy sản phẩm khuyến mãi cho trang chủ
    public function getSaleProducts($limit = 8) {
        $query = "SELECT * FROM products ORDER BY RAND() LIMIT :limit";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Lấy danh mục sản phẩm
    public function getCategories() {
        $query = "SELECT * FROM categories";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>