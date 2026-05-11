<?php
require_once '../app/models/ProductModel.php';
require_once '../app/models/NewsModel.php';
require_once '../app/models/SettingModel.php';

class HomeController {
    private $db;

    // Phải có hàm construct nhận $db
    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        // Khởi tạo Model phải truyền $this->db vào
        $productModel = new ProductModel($this->db);
        $newsModel = new NewsModel($this->db);
        // $settingModel = new SettingModel($this->db); // Mở comment nếu bạn đã tạo bảng settings

        // Lấy dữ liệu
        $featuredProducts = $productModel->getFeaturedProducts(8);
        $saleProducts = $productModel->getSaleProducts(8);
        $categories = $productModel->getCategories();
        
        // Gọi hàm getLatestNews
        $latestNews = $newsModel->getLatestNews(3);
        
        // $settings = $settingModel->getAll(); // Mở comment nếu có bảng settings

        // Load view (sử dụng layout)
        require_once '../app/views/home/index.php';
    }
}
?>