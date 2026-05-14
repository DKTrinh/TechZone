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
                // Xử lý mã đơn hàng (Nếu DB cũ chưa có order_code thì dùng ID)
                $displayCode = !empty($order['order_code']) ? $order['order_code'] : 'TZ-'.str_pad($order['id'], 5, '0', STR_PAD_LEFT);
                $originalAmt = $order['original_amount'] > 0 ? $order['original_amount'] : $order['total_price'];
                $discountAmt = $order['discount_amount'] ?? 0;
            ?>
            <div class="col-12 mb-4">
                <div class="order-card card border-0 shadow-sm rounded-4">
                    <div class="card-header bg-white border-bottom d-flex justify-content-between align-items-center p-3">
                        <div class="d-flex align-items-center gap-3">
                            <!-- Nút Copy Mã Đơn -->
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
                        <!-- Nơi hiển thị danh sách sản phẩm (Tạm ẩn chờ Logic Backend) -->
                        <div class="d-flex justify-content-end mt-3 border-top pt-3 text-end">
                            <div>
                                <p class="mb-1 text-muted">Tổng tiền hàng: <?= number_format($originalAmt, 0, ',', '.') ?>đ</p>
                                <?php if($discountAmt > 0): ?>
                                    <p class="mb-1 text-success">Voucher áp dụng: -<?= number_format($discountAmt, 0, ',', '.') ?>đ</p>
                                <?php endif; ?>
                                <h4 class="text-danger fw-bold m-0">Thành tiền: <?= number_format($order['total_price'], 0, ',', '.') ?>đ</h4>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer bg-light border-0 p-3 d-flex justify-content-end gap-2 rounded-bottom-4">
                        <!-- Nút Hủy (Chỉ hiện khi chờ xác nhận) -->
                        <?php if($order['status'] === 'pending'): ?>
                            <button class="btn btn-outline-danger fw-bold" onclick="cancelOrder(<?= $order['id'] ?>)">Hủy Đơn Hàng</button>
                        <?php endif; ?>

                        <!-- Nút Đổi trả (Chỉ hiện khi đã giao xong) -->
                        <?php if($order['status'] === 'completed'): ?>
                            <button class="btn btn-outline-warning text-dark fw-bold" data-bs-toggle="modal" data-bs-target="#returnModal<?= $order['id'] ?>">Yêu Cầu Đổi Trả</button>
                        <?php endif; ?>
                        
                        <button class="btn btn-primary fw-bold">Mua Lại</button>
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
            toast: true, 
            position: 'top-end', 
            icon: 'success', 
            title: 'Đã copy mã: #' + code, 
            showConfirmButton: false, 
            timer: 1500 
        });
    }

    function cancelOrder(orderId) {
        Swal.fire({
            title: 'Hủy đơn hàng?',
            text: "Bạn có chắc chắn muốn hủy đơn hàng này không?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Đồng ý hủy',
            cancelButtonText: 'Không'
        }).then((result) => {
            if (result.isConfirmed) {
                // Sẽ nối API hủy đơn vào đây sau
                Swal.fire('Đã hủy!', 'Đơn hàng của bạn đã được hủy thành công.', 'success');
            }
        })
    }
</script>

<?php require_once '../app/views/layouts/footer.php'; ?>