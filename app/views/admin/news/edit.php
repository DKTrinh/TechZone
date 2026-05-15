<?php require_once '../app/views/layouts/admin_header.php'; ?>

<div class="container-fluid mt-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-edit me-2"></i> Chỉnh sửa tin tức</h4>
        </div>
        <div class="card-body">
            <form action="<?= defined('BASE_URL') ? BASE_URL : '' ?>public_entry.php?url=admin/news/update" method="POST" enctype="multipart/form-data">
                
                <input type="hidden" name="id" value="<?= htmlspecialchars($news['id'] ?? '') ?>">

                <div class="mb-3">
                    <label class="form-label fw-bold">Tiêu đề bài viết <span class="text-danger">*</span></label>
                    <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($news['title'] ?? '') ?>" required>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Danh mục <span class="text-danger">*</span></label>
                        <input type="text" name="category" class="form-control" value="<?= htmlspecialchars($news['category'] ?? '') ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label fw-bold">Nhãn (Badge)</label>
                        <input type="text" name="badge" class="form-control" value="<?= htmlspecialchars($news['badge'] ?? '') ?>" placeholder="VD: Mới nhất, HOT...">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Đường dẫn ảnh hiện tại</label>
                        <input type="text" name="image" class="form-control bg-light" value="<?= htmlspecialchars($news['image'] ?? '') ?>" readonly>
                        <?php if(!empty($news['image'])): ?>
                            <div class="mt-2">
                                <img src="<?= defined('BASE_URL') ? BASE_URL : '' ?><?= htmlspecialchars($news['image']) ?>" alt="Ảnh hiện tại" style="height: 80px; object-fit: cover; border-radius: 5px;">
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Hoặc Upload ảnh mới thay thế</label>
                        <input type="file" name="image_file" class="form-control" accept="image/*">
                        <small class="text-muted">Nếu bạn không chọn file mới, hệ thống sẽ giữ nguyên ảnh cũ.</small>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Nội dung bài viết <span class="text-danger">*</span></label>
                    <textarea name="content" class="form-control" rows="8" required><?= htmlspecialchars($news['content'] ?? '') ?></textarea>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="<?= defined('BASE_URL') ? BASE_URL : '' ?>public_entry.php?url=admin/news" class="btn btn-secondary"><i class="fas fa-times me-2"></i> Hủy bỏ</a>
                    <button type="submit" class="btn btn-success"><i class="fas fa-save me-2"></i> Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>