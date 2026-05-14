<?php require_once '../app/views/layouts/admin_header.php'; ?>

<div class="row">
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="header-title m-0">Quản lý Đơn Hàng</h4>
                </div>
                
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead class="text-uppercase bg-info">
                                <tr class="text-white">
                                    <th scope="col" class="text-start ps-4">Mã Đơn</th>
                                    <th scope="col">Ngày đặt</th>
                                    <th scope="col">Khách hàng</th>
                                    <th scope="col">Tổng tiền</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($orders)): foreach($orders as $o): ?>
                                <tr>
                                    <td class="text-start ps-4 fw-bold text-primary">#TZ-<?= str_pad($o['id'], 5, '0', STR_PAD_LEFT) ?></td>
                                    <td class="align-middle"><?= date('d/m/Y H:i', strtotime($o['created_at'])) ?></td>
                                    <td class="align-middle text-start">
                                        <div class="fw-bold"><?= htmlspecialchars($o['customer_name']) ?></div>
                                        <small class="text-muted"><i class="ti-mobile"></i> <?= htmlspecialchars($o['customer_phone']) ?></small>
                                    </td>
                                    <td class="align-middle fw-bold text-danger"><?= number_format($o['total_price'], 0, ',', '.') ?>đ</td>
                                    
                                    <td class="align-middle">
                                        <form action="public_entry.php?url=admin-order-update" method="POST">
                                            <input type="hidden" name="order_id" value="<?= $o['id'] ?>">
                                            <select name="status" class="form-select form-select-sm fw-bold" onchange="this.form.submit()" style="width: 150px; cursor: pointer;">
                                                <option value="pending" <?= $o['status'] == 'pending' ? 'selected' : '' ?>>Chờ xử lý</option>
                                                <option value="processing" <?= $o['status'] == 'processing' ? 'selected' : '' ?>>Đang giao hàng</option>
                                                <option value="completed" <?= $o['status'] == 'completed' ? 'selected' : '' ?>>Hoàn thành</option>
                                                <option value="cancelled" <?= $o['status'] == 'cancelled' ? 'selected' : '' ?>>Đã hủy</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="align-middle">
                                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#orderDetailModal<?= $o['id'] ?>">
                                            <i class="ti-eye"></i> Xem chi tiết
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="orderDetailModal<?= $o['id'] ?>" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header bg-info">
                                                <h5 class="modal-title text-white">Chi tiết đơn hàng #TZ-<?= str_pad($o['id'], 5, '0', STR_PAD_LEFT) ?></h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body p-4 text-start">
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <h6 class="fw-bold mb-2 border-bottom pb-2 text-secondary">Thông tin nhận hàng</h6>
                                                        <p class="mb-1"><strong>Người nhận:</strong> <?= htmlspecialchars($o['customer_name']) ?></p>
                                                        <p class="mb-1"><strong>SĐT:</strong> <?= htmlspecialchars($o['customer_phone']) ?></p>
                                                        <p class="mb-1"><strong>Email:</strong> <?= htmlspecialchars($o['email']) ?></p>
                                                        <p class="mb-1"><strong>Địa chỉ:</strong> <?= htmlspecialchars($o['customer_address']) ?></p>
                                                    </div>
                                                    <div class="col-md-6 text-md-end">
                                                        <h6 class="fw-bold mb-2 border-bottom pb-2 text-secondary">Thời gian đặt</h6>
                                                        <p><?= date('d/m/Y - H:i:s', strtotime($o['created_at'])) ?></p>
                                                    </div>
                                                </div>
                                                
                                                <h6 class="fw-bold mt-4 mb-3 border-bottom pb-2 text-secondary">Danh sách sản phẩm</h6>
                                                <ul class="list-group shadow-sm">
                                                    <?php 
                                                    $items = $orderDetails[$o['id']] ?? [];
                                                    foreach($items as $item): 
                                                        $thumbs = explode(',', $item['thumbnail']);
                                                        $img = trim($thumbs[0]);
                                                    ?>
                                                    <li class="list-group-item d-flex justify-content-between align-items-center border-0">
                                                        <div class="d-flex align-items-center">
                                                            <img src="<?= htmlspecialchars($img) ?>" width="60" class="me-3 rounded border p-1 bg-light">
                                                            <div>
                                                                <div class="fw-bold text-dark"><?= htmlspecialchars($item['name']) ?></div>
                                                                <small class="text-muted"><?= number_format($item['price'], 0, ',', '.') ?>đ x <?= $item['quantity'] ?></small>
                                                            </div>
                                                        </div>
                                                        <span class="fw-bold text-danger"><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>đ</span>
                                                    </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                                
                                                <div class="mt-4 p-3 bg-light rounded-3 d-flex justify-content-between align-items-center">
                                                    <span class="h5 mb-0 fw-bold">Tổng thanh toán:</span>
                                                    <span class="h4 mb-0 fw-bold text-danger"><?= number_format($o['total_price'], 0, ',', '.') ?>đ</span>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; else: ?>
                                <tr><td colspan="6" class="py-5 text-muted">Chưa có đơn hàng nào!</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>