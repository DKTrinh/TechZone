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

    <?php 
    // Nếu có thông báo đặt hàng thành công từ OrderController truyền sang
    if (isset($_SESSION['success_message'])): 
    ?>
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
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-secondary">
                        <tr>
                            <th class="ps-4 py-3">Mã đơn hàng</th>
                            <th>Ngày đặt</th>
                            <th>Người nhận</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white border-top-0">
                        <?php foreach ($orders as $order): 
                            // Xử lý hiển thị trạng thái bằng Tiếng Việt và màu sắc
                            $statusLabel = 'Đang xử lý';
                            $statusClass = 'bg-warning text-dark';
                            
                            switch($order['status']) {
                                case 'processing':
                                    $statusLabel = 'Đang giao hàng';
                                    $statusClass = 'bg-info text-dark';
                                    break;
                                case 'completed':
                                    $statusLabel = 'Đã giao thành công';
                                    $statusClass = 'bg-success';
                                    break;
                                case 'cancelled':
                                    $statusLabel = 'Đã hủy';
                                    $statusClass = 'bg-danger';
                                    break;
                            }
                        ?>
                        <tr>
                            <td class="ps-4 fw-bold text-dark">
                                #TZ-<?= str_pad($order['id'], 5, '0', STR_PAD_LEFT) ?>
                            </td>
                            <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                            <td>
                                <div class="fw-bold" style="font-size: 0.9rem;"><?= htmlspecialchars($order['customer_name']) ?></div>
                                <small class="text-muted"><?= htmlspecialchars($order['customer_phone']) ?></small>
                            </td>
                            <td class="fw-bold text-danger">
                                <?= number_format($order['total_price'], 0, ',', '.') ?>đ
                            </td>
                            <td>
                                <span class="badge <?= $statusClass ?> px-3 py-2 rounded-pill shadow-sm" style="font-size: 0.8rem;">
                                    <?= $statusLabel ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>