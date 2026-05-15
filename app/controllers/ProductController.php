<?php
require_once '../app/models/ProductModel.php';

class ProductController {
    private $db;
    private $productModel;
    
    public function __construct($db) { 
        $this->db = $db;
        $this->productModel = new ProductModel(); 
    }

    public function index() {
        $keyword = trim($_GET['q'] ?? ($_GET['keyword'] ?? '')); 
        $categoryId = $_GET['category'] ?? ''; 
        $brand = $_GET['brand'] ?? '';
        $maxPrice = isset($_GET['max_price']) ? (int)$_GET['max_price'] : 999999999;
        $sort = $_GET['sort'] ?? 'newest';
        
        $limit = 12; 
        $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $offset = ($page - 1) * $limit;
        

$totalProducts = $this->productModel->getTotalProducts($keyword, $categoryId, $brand);
        $totalPages = ceil($totalProducts / $limit);
        
        $products = $this->productModel->getProductsPaginated($limit, $offset, $keyword, $categoryId, $brand, 0, $maxPrice, $sort);
        $categories = $this->productModel->getAllCategories(); 
        $brands = $this->productModel->getAllBrands();

        $banners = [
            ['image' => 'https://images.unsplash.com/photo-1550745165-9bc0b252726f?w=1200', 'title' => 'Công Nghệ Dẫn Đầu', 'link' => '?url=products&brand=Apple'],
            ['image' => 'https://images.unsplash.com/photo-1531297172867-4f4013628f18?w=1200', 'title' => 'Đại Tiệc Laptop', 'link' => '?url=products&category=2']
        ];

        require_once '../app/views/layouts/header.php';
        require_once '../app/views/pages/products.php';
        require_once '../app/views/layouts/footer.php';
    }

    public function detail() {
        $id = $_GET['id'] ?? 0;
        $product = $this->productModel->getProductById($id);
        if (!$product) { header('Location: public_entry.php?url=products'); exit; }
        
        $related = $this->productModel->getRelatedProducts($product['category_id'], $id, 4);
        
        require_once '../app/views/layouts/header.php';
        require_once '../app/views/pages/product_detail.php';
        require_once '../app/views/layouts/footer.php';
    }
}
?>
