<?php require_once '../app/views/layouts/header.php'; ?>

<div class="bg-light py-3 border-bottom">
    <div class="container">
        <a href="public_entry.php?url=home" class="text-decoration-none text-muted">
            <i class="fas fa-home me-1"></i> Trang chủ
        </a>
        <i class="fas fa-chevron-right text-muted mx-2" style="font-size: 10px;"></i>
        <span class="fw-bold">Lịch sử đơn hàng</span>
    </div>
</div>

<div class="container py-5" style="min-height: 60vh;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold m-0"><i class="fas fa-clipboard-list text-primary me-2"></i> Đơn hàng của bạn</h2>
    </div>

    <?php if (isset($_SESSION['success_message'])): ?>
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4" role="alert">
            <i class="fas fa-check-circle fs-5 me-2 align-middle"></i> 
            <span class="fw-bold"><?= $_SESSION['success_message'] ?></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success_message']); ?>
    <?php endif; ?>

    <?php if (empty($orders)): ?>
        <div class="text-center py-5 bg-white rounded-4 shadow-sm border">
            <img src="https://cdn-icons-png.flaticon.com/512/2748/2748614.png" width="120" class="mb-3 opacity-50">
            <h5 class="text-muted fw-bold">Bạn chưa có đơn hàng nào!</h5>
            <p class="text-secondary">Hãy lướt qua gian hàng và chọn cho mình sản phẩm ưng ý nhé.</p>
            <a href="public_entry.php?url=products" class="btn btn-primary mt-2 px-4 py-2 fw-bold rounded-pill shadow-sm">
                Bắt đầu mua sắm
            </a>
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($orders as $order): 
                $displayCode = !empty($order['order_code']) ? $order['order_code'] : 'TZ-'.str_pad($order['id'], 5, '0', STR_PAD_LEFT);
                $originalAmt = $order['original_amount'] > 0 ? $order['original_amount'] : $order['total_price'];
                $discountAmt = $order['discount_amount'] ?? 0;
            ?>
            <div class="col-12 mb-4">
                <div class="order-card card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center p-3">
                        <div class="d-flex align-items-center gap-3">
                            <span class="badge bg-dark fs-6 rounded-pill px-3 py-2" id="order-<?= $displayCode ?>">#<?= $displayCode ?></span>
                            <button class="btn btn-sm btn-outline-secondary rounded-circle" onclick="copyOrderCode('<?= $displayCode ?>')" title="Copy mã đơn">
                                <i class="far fa-copy"></i>
                            </button>
                            <span class="text-muted small"><i class="far fa-clock me-1"></i><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></span>
                        </div>
                        <div>
                            <?php if($order['status'] === 'pending'): ?> 
                                <span class="badge bg-warning text-dark px-3 py-2">Chờ xác nhận</span>
                            <?php elseif($order['status'] === 'processing'): ?> 
                                <span class="badge bg-info text-dark px-3 py-2">Đang giao hàng</span>
                            <?php elseif($order['status'] === 'completed'): ?> 
                                <span class="badge bg-success px-3 py-2">Thành công</span>
                            <?php elseif($order['status'] === 'cancelled'): ?> 
                                <span class="badge bg-danger px-3 py-2">Đã hủy</span>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <div class="card-body p-4">
                        <?php 
                        $orderDetails = $order['items'] ?? $order['details'] ?? []; 
                        
                        // Nếu controller không truyền chi tiết, query lấy ra trực tiếp
                        if (empty($orderDetails)) {
                            if (!isset($db)) { 
                                require_once __DIR__ . '/../../config/db_config.php'; 
                                require_once __DIR__ . '/../../core/Database.php'; 
                                $db = Database::getConnection(); 
                            }
                            $stmt = $db->prepare("
                                SELECT od.quantity, od.price, p.name, p.thumbnail 
                                FROM order_details od 
                                JOIN products p ON od.product_id = p.id 
                                WHERE od.order_id = ?
                            ");
                            $stmt->execute([$order['id']]);
                            $orderDetails = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        }
                        
                        // In sản phẩm ra
                        if (!empty($orderDetails)):
                            foreach ($orderDetails as $item):
                                $images = explode(',', $item['thumbnail'] ?? '');
                                // ĐÃ SỬA: Lấy trực tiếp đường dẫn giống hệt trang Products
                                $itemImage = htmlspecialchars(trim($images[0]));
                        ?>
                        <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                            <img src="<?= $itemImage ?>" alt="<?= htmlspecialchars($item['name'] ?? 'Sản phẩm') ?>" class="rounded-3 border" style="width: 80px; height: 80px; object-fit: cover; margin-right: 15px;">
                            <div class="flex-grow-1">
                                <h6 class="fw-bold mb-1 text-dark"><?= htmlspecialchars($item['name'] ?? 'Tên sản phẩm') ?></h6>
                                <div class="text-muted small">Số lượng: x<?= htmlspecialchars($item['quantity'] ?? 1) ?></div>
                            </div>
                            <div class="text-end fw-bold text-danger ms-3">
                                <?= number_format($item['price'] ?? 0, 0, ',', '.') ?>đ
                            </div>
                        </div>
                        <?php 
                            endforeach;
                        else:
                        ?>
                        <div class="text-center text-muted py-3 border-bottom mb-3">
                            <i class="fas fa-box-open me-2"></i> Chưa có dữ liệu chi tiết sản phẩm.
                        </div>
                        <?php endif; ?>
                        <div class="d-flex justify-content-end mt-3 text-end">
                            <div>
                                <p class="mb-1 text-muted">Tổng tiền hàng: <?= number_format($originalAmt, 0, ',', '.') ?>đ</p>
                                <?php if($discountAmt > 0): ?>
                                    <p class="mb-1 text-success">Voucher áp dụng: -<?= number_format($discountAmt, 0, ',', '.') ?>đ</p>
                                <?php endif; ?>
                                <h4 class="text-danger fw-bold m-0">Thành tiền: <?= number_format($order['total_price'], 0, ',', '.') ?>đ</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function copyOrderCode(code) {
        navigator.clipboard.writeText(code);
        Swal.fire({ 
            toast: true, position: 'top-end', icon: 'success', 
            title: 'Đã copy mã: #' + code, showConfirmButton: false, timer: 1500 
        });
    }
</script>

<?php require_once '../app/views/layouts/footer.php'; ?>