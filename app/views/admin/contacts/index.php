<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="row">
    <div class="col-12 mt-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h4 class="header-title mb-4"><i class="ti-email text-primary me-2"></i> QUẢN LÝ LIÊN HỆ TỪ KHÁCH HÀNG</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover text-center align-middle">
                            <thead class="text-uppercase bg-primary">
                                <tr class="text-white">
                                    <th>Khách hàng</th>
                                    <th>Thông tin LL</th>
                                    <th class="text-left">Nội dung tin nhắn</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($contacts)): foreach($contacts as $c): ?>
                                <tr>
                                    <td class="fw-bold text-dark"><?= htmlspecialchars($c['fullname']) ?></td>
                                    <td>
                                        <div class="small text-muted"><i class="ti-email"></i> <?= htmlspecialchars($c['email']) ?></div>
                                        <div class="small text-muted"><i class="ti-mobile"></i> <?= htmlspecialchars($c['phone']) ?></div>
                                    </td>
                                    <td class="text-left">
                                        <div class="fw-bold text-primary mb-1"><?= htmlspecialchars($c['subject']) ?></div>
                                        <div style="max-width: 300px; white-space: normal;" class="text-secondary small"><?= htmlspecialchars($c['message']) ?></div>
                                        <div class="mt-2 text-muted" style="font-size: 0.7rem;"><i class="ti-time"></i> <?= date('H:i d/m/Y', strtotime($c['created_at'])) ?></div>
                                    </td>
                                    <td>
                                        <form action="public_entry.php?url=admin/contacts/status" method="POST">
                                            <input type="hidden" name="id" value="<?= $c['id'] ?>">
                                            <select name="status" class="form-control form-control-sm <?= $c['status'] == 'unread' ? 'bg-danger text-white' : ($c['status'] == 'read' ? 'bg-warning text-dark' : 'bg-success text-white') ?>" onchange="this.form.submit()" style="cursor:pointer;">
                                                <option value="unread" <?= $c['status'] == 'unread' ? 'selected' : '' ?>>Chưa đọc</option>
                                                <option value="read" <?= $c['status'] == 'read' ? 'selected' : '' ?>>Đã đọc</option>
                                                <option value="replied" <?= $c['status'] == 'replied' ? 'selected' : '' ?>>Đã phản hồi</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        <a href="public_entry.php?url=admin/contacts/delete&id=<?= $c['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa liên hệ này?')"><i class="ti-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
                                <tr><td colspan="5" class="py-4">Chưa có liên hệ nào!</td></tr>
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