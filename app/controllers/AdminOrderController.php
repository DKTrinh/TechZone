<?php
require_once '../app/models/OrderModel.php';

class AdminOrderController {
    private $db;
    private $orderModel;

    public function __construct($db) {
        $this->db = $db;
        $this->orderModel = new OrderModel($db);
    }

    public function index() {
        // Lấy từ khóa tìm kiếm (theo Tên, SĐT hoặc Mã đơn)
        $keyword = trim($_GET['search'] ?? '');
        
        $sql = "SELECT o.*, u.email FROM orders o JOIN users u ON o.user_id = u.id";
        $params = [];
        
        if ($keyword !== '') {
            $sql .= " WHERE o.id LIKE ? OR o.customer_name LIKE ? OR o.customer_phone LIKE ?";
            $params = ["%$keyword%", "%$keyword%", "%$keyword%"];
        }
        $sql .= " ORDER BY o.id DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Lấy trước chi tiết của tất cả các đơn hàng để hiển thị trong Modal
        $orderDetails = [];
        if (!empty($orders)) {
            $orderIds = array_column($orders, 'id');
            $placeholders = str_repeat('?,', count($orderIds) - 1) . '?';
            $stmtDet = $this->db->prepare("SELECT od.*, p.name, p.thumbnail FROM order_details od JOIN products p ON od.product_id = p.id WHERE od.order_id IN ($placeholders)");
            $stmtDet->execute($orderIds);
            $details = $stmtDet->fetchAll(PDO::FETCH_ASSOC);
            foreach ($details as $d) {
                $orderDetails[$d['order_id']][] = $d;
            }
        }

        require_once '../app/views/layouts/header.php';
        require_once '../app/views/admin/orders/index.php'; 
        require_once '../app/views/layouts/footer.php';
    }

    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderId = (int)$_POST['order_id'];
            $status = $_POST['status']; // 'pending', 'processing', 'completed', 'cancelled'
            
            $stmt = $this->db->prepare("UPDATE orders SET status = ? WHERE id = ?");
            $stmt->execute([$status, $orderId]);
            
            if (session_status() == PHP_SESSION_NONE) session_start();
            $_SESSION['auth_status'] = 'success';
            $_SESSION['auth_message'] = 'Đã cập nhật trạng thái đơn hàng!';
            header('Location: public_entry.php?url=admin-orders'); exit;
        }
    }
}
?>