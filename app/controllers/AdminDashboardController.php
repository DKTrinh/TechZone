<?php
class AdminDashboardController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function index() {
        // Lấy thống kê cơ bản
        $totalUsers = $this->db->query("SELECT COUNT(*) FROM users WHERE role='client'")->fetchColumn();
        $totalProducts = $this->db->query("SELECT COUNT(*) FROM products")->fetchColumn();
        $totalOrders = $this->db->query("SELECT COUNT(*) FROM orders")->fetchColumn();
        $revenue = $this->db->query("SELECT SUM(total_price) FROM orders WHERE status='completed'")->fetchColumn() ?: 0;

        // CHỈ GỌI DUY NHẤT FILE VIEW NÀY (Tuyệt đối không gọi header.php cũ)
        require_once '../app/views/admin/dashboard/index.php';
    }
}
?>