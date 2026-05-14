<?php
class ProductModel {
    private $db;

    public function __construct() {
        // Khởi tạo kết nối CSDL dùng chung từ Database Core
        $this->db = Database::getConnection(); 
    }

    // =========================================================
    // 1. DÀNH CHO TRANG CHỦ
    // =========================================================
    public function getFeaturedProducts($limit = 8) {
        $stmt = $this->db->prepare("SELECT p.*, c.name as category_name 
                                    FROM products p 
                                    LEFT JOIN categories c ON p.category_id = c.id 
                                    ORDER BY p.sold_count DESC, p.id DESC 
                                    LIMIT :limit");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSaleProducts($limit = 8) {
        $stmt = $this->db->prepare("SELECT p.*, c.name as category_name 
                                    FROM products p 
                                    LEFT JOIN categories c ON p.category_id = c.id 
                                    WHERE p.old_price > p.price 
                                    ORDER BY (p.old_price - p.price) DESC, p.id DESC 
                                    LIMIT :limit");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // =========================================================
    // 2. DÀNH CHO TRANG SẢN PHẨM & TÌM KIẾM
    // =========================================================
    public function getAllCategories() {
        $stmt = $this->db->query("SELECT * FROM categories ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllBrands() {
        $stmt = $this->db->query("SELECT DISTINCT brand FROM products WHERE brand IS NOT NULL AND brand != '' ORDER BY brand ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // HÀM BỊ THIẾU GÂY RA LỖI (Đã bổ sung bộ lọc brand)
    public function getTotalProducts($keyword = '', $categoryId = '', $brand = '') {
        $sql = "SELECT COUNT(*) FROM products WHERE name LIKE :keyword";
        if (!empty($categoryId)) {
            $sql .= " AND category_id = :cat_id";
        }
        if (!empty($brand)) {
            $sql .= " AND brand = :brand";
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
        
        if (!empty($categoryId)) {
            $stmt->bindValue(':cat_id', $categoryId, PDO::PARAM_INT);
        }
        if (!empty($brand)) {
            $stmt->bindValue(':brand', $brand, PDO::PARAM_STR);
        }
        
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getProductsPaginated($limit, $offset, $keyword = '', $categoryId = '', $brand = '', $minPrice = 0, $maxPrice = 999999999, $sort = 'newest') {
        $sql = "SELECT p.*, c.name as category_name FROM products p 
                LEFT JOIN categories c ON p.category_id = c.id 
                WHERE p.name LIKE :keyword AND p.price BETWEEN :min_price AND :max_price";
        
        if (!empty($categoryId)) $sql .= " AND p.category_id = :cat_id";
        if (!empty($brand)) $sql .= " AND p.brand = :brand";
        
        // MẸO: (p.stock_count = 0) sẽ trả về 1 nếu hết hàng, 0 nếu còn hàng. 
        // ASC sẽ ưu tiên số 0 (còn hàng) nổi lên trước, số 1 (hết hàng) chìm xuống sau.
        $orderBy = " ORDER BY (p.stock_count = 0) ASC, ";
        
        switch ($sort) {
            case 'price_asc': $sql .= $orderBy . "p.price ASC"; break;
            case 'price_desc': $sql .= $orderBy . "p.price DESC"; break;
            case 'popular': $sql .= $orderBy . "p.sold_count DESC"; break;
            case 'newest': 
            default: 
                $sql .= $orderBy . "p.id DESC"; break;
        }
        $sql .= " LIMIT :limit OFFSET :offset";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
        $stmt->bindValue(':min_price', $minPrice, PDO::PARAM_INT);
        $stmt->bindValue(':max_price', $maxPrice, PDO::PARAM_INT);
        
        if (!empty($categoryId)) $stmt->bindValue(':cat_id', $categoryId, PDO::PARAM_INT);
        if (!empty($brand)) $stmt->bindValue(':brand', $brand, PDO::PARAM_STR);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // =========================================================
    // 3. CHI TIẾT SẢN PHẨM
    // =========================================================
    public function getProductById($id) {
        $stmt = $this->db->prepare("SELECT p.*, c.name as category_name 
                                    FROM products p 
                                    LEFT JOIN categories c ON p.category_id = c.id 
                                    WHERE p.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getRelatedProducts($catId, $excludeId, $limit = 4) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE category_id = :catId AND id != :exId LIMIT :limit");
        $stmt->bindValue(':catId', $catId, PDO::PARAM_INT);
        $stmt->bindValue(':exId', $excludeId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // =========================================================
    // 4. DÀNH CHO ADMIN QUẢN LÝ
    // =========================================================
    public function insertProduct($categoryId, $brand, $name, $price, $oldPrice, $thumbnail, $desc, $stock) {
        $stmt = $this->db->prepare("INSERT INTO products (category_id, brand, name, price, old_price, thumbnail, description, stock_count) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$categoryId, $brand, $name, $price, $oldPrice, $thumbnail, $desc, $stock]);
    }

    public function updateProduct($id, $categoryId, $brand, $name, $price, $oldPrice, $thumbnail, $desc, $stock) {
        if (!empty($thumbnail)) {
            $stmt = $this->db->prepare("UPDATE products SET category_id=?, brand=?, name=?, price=?, old_price=?, thumbnail=?, description=?, stock_count=? WHERE id=?");
            return $stmt->execute([$categoryId, $brand, $name, $price, $oldPrice, $thumbnail, $desc, $stock, $id]);
        } else {
            // Không cập nhật lại hình ảnh nếu Admin không up ảnh mới
            $stmt = $this->db->prepare("UPDATE products SET category_id=?, brand=?, name=?, price=?, old_price=?, description=?, stock_count=? WHERE id=?");
            return $stmt->execute([$categoryId, $brand, $name, $price, $oldPrice, $desc, $stock, $id]);
        }
    }

    public function deleteProduct($id) {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id=?");
        return $stmt->execute([$id]);
    }
}
?>