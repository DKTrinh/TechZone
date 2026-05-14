<?php
class HomeController {
    private $db;
    private $productModel;

    public function __construct($db) {
        $this->db = $db;
        // Gọi Model Sản phẩm để dùng
        require_once '../app/models/ProductModel.php';
        $this->productModel = new ProductModel($this->db);
    }

    public function index() {
        // Lấy danh sách sản phẩm từ Database (Lấy khoảng 20-30 sản phẩm mới nhất)
        // Hàm getProductsPaginated này em đã có sẵn trong ProductModel rồi
        $limit = 24; // Số lượng đủ để chia cho Flash Sale(4), Nổi bật(8), Công nghệ mới(8)
        $offset = 0;
        
        $products = $this->productModel->getProductsPaginated($limit, $offset, '', '', '', 0, 999999999, 'newest');

        // Render ra giao diện (Lúc này biến $products đã có dữ liệu và được truyền sang View)
        require_once '../app/views/home/index.php';
       
        // Giả sử file giao diện trang chủ của bạn nằm ở views/home/index.php
        require_once '../app/views/home/index.php'; 
        
        require_once '../app/views/layouts/footer.php';
    }
}
?>