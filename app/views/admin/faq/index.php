<?php require_once '../app/views/layouts/admin_header.php'; ?>

<div class="row">
    <div class="col-12 mt-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="header-title m-0"><i class="ti-help-alt text-primary me-2"></i> HỆ THỐNG QUẢN LÝ FAQ</h4>
                </div>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0 text-center">
                            <thead class="bg-dark text-white text-uppercase">
                                <tr>
                                    <th>Mã REQ</th>
                                    <th>Chủ đề</th>
                                    <th>Câu hỏi</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($faqs)): ?>
                                    <?php foreach($faqs as $f): ?>
                                    <tr>
                                        <td class="fw-bold text-primary">#<?= $f['f_id'] ?></td>
                                        <td><span class="badge badge-info"><?= htmlspecialchars($f['title']) ?></span></td>
                                        <td class="text-left"><?= htmlspecialchars(substr($f['question'], 0, 60)) ?>...</td>
                                        <td>
                                            <?php if($f['status'] == 'answered'): ?>
                                                <span class="badge badge-success">Đã công bố</span>
                                            <?php else: ?>
                                                <span class="badge badge-warning text-dark">Chờ duyệt</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="public_entry.php?url=admin/faq/edit&id=<?= $f['f_id'] ?>" class="btn btn-sm btn-warning"><i class="ti-pencil"></i> Duyệt</a>
                                            <a href="public_entry.php?url=admin/faq/delete&id=<?= $f['f_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xác nhận xóa?')"><i class="ti-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr><td colspan="5" class="py-5 text-muted">Chưa có dữ liệu câu hỏi.</td></tr>
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