<?php
// Bắt buộc phải require Model vào để sử dụng
require_once '../app/models/ProductModel.php';

class HomeController {
    private $db;
    private $productModel; // Khai báo biến chứa Model

    public function __construct($db) {
        $this->db = $db;
        // Khởi tạo đối tượng ProductModel ngay khi HomeController được gọi
        $this->productModel = new ProductModel(); 
    }

    public function index() {
        // Lấy danh sách sản phẩm nổi bật và khuyến mãi (tối đa 8 sản phẩm cho trang chủ)
        $featuredProducts = $this->productModel->getFeaturedProducts(8);
        $saleProducts = $this->productModel->getSaleProducts(8);
        
        // Lấy danh mục để hiển thị (Dòng 23 không còn bị lỗi nữa)
        $categories = $this->productModel->getAllCategories();

        // Gọi View hiển thị trang chủ
        require_once '../app/views/layouts/header.php';
        
        // Giả sử file giao diện trang chủ của bạn nằm ở views/home/index.php
        require_once '../app/views/home/index.php'; 
        
        require_once '../app/views/layouts/footer.php';
    }
}
?>