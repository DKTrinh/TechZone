<style>
    .sidebar-link { transition: all 0.3s ease; border-radius: 8px; font-weight: 500;}
    .sidebar-link:hover { background-color: rgba(255,255,255,0.15); transform: translateX(8px); color: #1abc9c !important; }
    .sidebar-link.active { background-color: #1abc9c !important; color: white !important; font-weight: 700; box-shadow: 0 4px 10px rgba(0,0,0,0.2);}
</style>

<div class="d-flex" style="min-height: 100vh; background-color: #f4f6fa; margin-top: -24px;"> <div class="bg-dark text-white p-3 shadow-lg" style="width: 270px;">
        <h5 class="fw-bold mb-4 mt-4 text-center text-info" style="letter-spacing: 1px;"><i class="fas fa-microchip me-2"></i> TECHZONE</h5>
        <div class="nav flex-column gap-2 mt-4">
            <a href="#" class="nav-link text-white sidebar-link"><i class="fas fa-chart-pie me-2"></i> Tổng quan</a>
            <a href="public_entry.php?url=users" class="nav-link text-white sidebar-link"><i class="fas fa-users me-2"></i> Quản lý Thành viên</a>
            <a href="public_entry.php?url=admin-products" class="nav-link text-white sidebar-link"><i class="fas fa-box-open me-2"></i> Quản lý Sản phẩm</a>
            <a href="public_entry.php?url=admin-orders" class="nav-link text-white sidebar-link active"><i class="fas fa-clipboard-check me-2"></i> Quản lý Đơn hàng</a>
            <a href="#" class="nav-link text-white sidebar-link"><i class="fas fa-newspaper me-2"></i> Quản lý Tin tức</a>
            <a href="#" class="nav-link text-white sidebar-link"><i class="fas fa-comments me-2"></i> Quản lý Bình luận</a>
        </div>
    </div>

    <div class="flex-grow-1 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded-4 shadow-sm border-start border-5 border-info">
            <h3 class="fw-bold text-dark m-0"><i class="fas fa-clipboard-check me-2 text-info"></i> Quản lý Đơn Hàng</h3>
            
            <form action="public_entry.php" method="GET" class="d-flex w-25">
                <input type="hidden" name="url" value="admin-orders">
                <input type="text" name="search" class="form-control me-2" placeholder="Tìm tên, SĐT, mã đơn..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
                <button type="submit" class="btn btn-info text-white fw-bold"><i class="fas fa-search"></i></button>
            </form>
        </div>
        
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-body p-0 table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th class="ps-4 py-3">Mã đơn</th>
                            <th>Ngày đặt</th>
                            <th>Thông tin khách hàng</th>
                            <th>Tổng thanh toán</th>
                            <th>Trạng thái</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <?php if(!empty($orders)): foreach($orders as $o): ?>
                        <tr>
                            <td class="ps-4 fw-bold text-primary">#TZ-<?= str_pad($o['id'], 5, '0', STR_PAD_LEFT) ?></td>
                            <td class="text-muted small"><?= date('d/m/Y H:i', strtotime($o['created_at'])) ?></td>
                            <td>
                                <div class="fw-bold text-dark"><?= htmlspecialchars($o['customer_name']) ?></div>
                                <div class="small text-muted"><i class="fas fa-phone-alt me-1"></i><?= htmlspecialchars($o['customer_phone']) ?></div>
                            </td>
                            <td class="fw-bold text-danger"><?= number_format($o['total_price'], 0, ',', '.') ?>đ</td>
                            
                            <td>
                                <form action="public_entry.php?url=admin-order-update" method="POST" class="d-flex align-items-center">
                                    <input type="hidden" name="order_id" value="<?= $o['id'] ?>">
                                    <select name="status" class="form-select form-select-sm me-2 fw-bold 
                                        <?= $o['status']=='pending' ? 'text-warning' : ($o['status']=='processing' ? 'text-info' : ($o['status']=='completed' ? 'text-success' : 'text-danger')) ?>" 
                                        onchange="this.form.submit()" style="width: 140px; cursor: pointer;">
                                        <option value="pending" <?= $o['status'] == 'pending' ? 'selected' : '' ?>>Chờ xử lý</option>
                                        <option value="processing" <?= $o['status'] == 'processing' ? 'selected' : '' ?>>Đang giao hàng</option>
                                        <option value="completed" <?= $o['status'] == 'completed' ? 'selected' : '' ?>>Hoàn thành</option>
                                        <option value="cancelled" <?= $o['status'] == 'cancelled' ? 'selected' : '' ?>>Đã hủy</option>
                                    </select>
                                </form>
                            </td>
                            
                            <td class="text-center py-3">
                                <button class="btn btn-sm btn-outline-info fw-bold" data-bs-toggle="modal" data-bs-target="#orderDetailModal<?= $o['id'] ?>">
                                    <i class="fas fa-eye"></i> Xem chi tiết
                                </button>
                            </td>
                        </tr>

                        <div class="modal fade" id="orderDetailModal<?= $o['id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content rounded-4 border-0 shadow">
                                    <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title fw-bold">Chi tiết Đơn hàng #TZ-<?= str_pad($o['id'], 5, '0', STR_PAD_LEFT) ?></h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row mb-4">
                                            <div class="col-sm-6">
                                                <h6 class="fw-bold text-secondary">Thông tin người nhận:</h6>
                                                <div><strong>Họ tên:</strong> <?= htmlspecialchars($o['customer_name']) ?></div>
                                                <div><strong>SĐT:</strong> <?= htmlspecialchars($o['customer_phone']) ?></div>
                                                <div><strong>Email:</strong> <?= htmlspecialchars($o['email']) ?></div>
                                                <div><strong>Địa chỉ:</strong> <?= htmlspecialchars($o['customer_address']) ?></div>
                                            </div>
                                        </div>
                                        <h6 class="fw-bold text-secondary mb-3">Sản phẩm đã mua:</h6>
                                        <ul class="list-group">
                                            <?php 
                                            $items = $orderDetails[$o['id']] ?? [];
                                            foreach($items as $item): 
                                            ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <?php $thumb = explode(',', $item['thumbnail'])[0]; ?>
                                                    <img src="<?= htmlspecialchars(trim($thumb)) ?>" width="50" class="rounded border me-3">
                                                    <div>
                                                        <div class="fw-bold"><?= htmlspecialchars($item['name']) ?></div>
                                                        <small class="text-muted"><?= number_format($item['price'], 0, ',', '.') ?>đ x <?= $item['quantity'] ?></small>
                                                    </div>
                                                </div>
                                                <span class="fw-bold text-danger"><?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?>đ</span>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php endforeach; else: ?>
                        <tr><td colspan="6" class="text-center py-5 text-muted"><img src="https://cdn-icons-png.flaticon.com/512/2748/2748614.png" width="80" class="opacity-25 mb-3"><br>Không tìm thấy đơn hàng nào.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if (isset($_SESSION['auth_status'])): ?>
        Swal.fire({ toast: true, position: 'top-end', showConfirmButton: false, timer: 2000, icon: '<?= $_SESSION['auth_status'] ?>', title: '<?= $_SESSION['auth_message'] ?>' });
        <?php unset($_SESSION['auth_status'], $_SESSION['auth_message']); ?>
    <?php endif; ?>
</script>