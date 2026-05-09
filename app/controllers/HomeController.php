<?php
require_once '../app/models/ProductModel.php';
require_once '../app/models/NewsModel.php';
require_once '../app/models/SettingModel.php';

class HomeController {
    public function index() {
        $productModel = new ProductModel();
        $newsModel = new NewsModel();
        $settingModel = new SettingModel();

        // Lấy dữ liệu
        $featuredProducts = $productModel->getFeaturedProducts(8);
        $saleProducts = $productModel->getSaleProducts(8);
        $categories = $productModel->getCategories();
        $latestNews = $newsModel->getLatestNews(3);
        $settings = $settingModel->getAll();

        // Load view (sử dụng layout)
        require_once '../app/views/home/index.php';
    }
}
?>