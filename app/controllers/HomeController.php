<?php
class HomeController {
    private $db;
    private $productModel;

    public function __construct($db) {
        $this->db = $db;
        require_once '../app/models/ProductModel.php';
        $this->productModel = new ProductModel($this->db);
    }

    public function index() {
        $limit = 24; // Số lượng đủ để chia cho Flash Sale(4), Nổi bật(8), Công nghệ mới(8)
        $offset = 0;
        
        $products = $this->productModel->getProductsPaginated($limit, $offset, '', '', '', 0, 999999999, 'newest');

        require_once '../app/views/home/index.php';
       
        require_once '../app/views/home/index.php'; 
        
        require_once '../app/views/layouts/footer.php';
    }
}
?>
