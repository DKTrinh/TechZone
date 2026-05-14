<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="row">
    <div class="col-12 mt-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h4 class="header-title mb-4"><i class="ti-comments text-success me-2"></i> QUẢN LÝ BÌNH LUẬN</h4>
                <form action="public_entry.php" method="GET" class="mb-4">
                    <input type="hidden" name="url" value="admin/comments">
                    <div class="input-group" style="max-width: 400px;">
                        <input type="text" name="search" class="form-control" placeholder="Tìm theo nội dung..." value="<?= htmlspecialchars($keyword ?? '') ?>">
                        <div class="input-group-append"><button type="submit" class="btn btn-primary"><i class="ti-search"></i></button></div>
                    </div>
                </form>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover text-center align-middle">
                            <thead class="text-uppercase bg-info">
                                <tr class="text-white">
                                    <th>Khách hàng</th>
                                    <th class="text-left">Bài viết áp dụng</th>
                                    <th class="text-left">Nội dung bình luận</th>
                                    <th>Thời gian</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($comments)): foreach($comments as $cmt): ?>
                                <tr>
                                    <td class="fw-bold text-dark"><?= htmlspecialchars($cmt['user_name']) ?></td>
                                    <td class="text-left"><small class="d-inline-block text-truncate fw-bold text-primary" style="max-width: 150px;"><?= htmlspecialchars($cmt['news_title']) ?></small></td>
                                    <td class="text-left"><div style="max-width: 300px; white-space: normal;" class="text-secondary"><?= htmlspecialchars($cmt['content']) ?></div></td>
                                    <td><small><?= date('H:i d/m/Y', strtotime($cmt['created_at'])) ?></small></td>
                                    <td><a href="public_entry.php?url=admin/comments/delete&id=<?= $cmt['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa bình luận này?')"><i class="ti-trash"></i></a></td>
                                </tr>
                                <?php endforeach; else: ?>
                                <tr><td colspan="5" class="py-4">Chưa có bình luận nào.</td></tr>
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