<?php require_once '../app/views/layouts/admin_header.php'; ?>

<div class="row">
    <div class="col-12 mt-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="header-title m-0"><i class="ti-check-box text-success me-2"></i> DUYỆT CÂU TRẢ LỜI</h4>
                    <a href="public_entry.php?url=admin/faq" class="btn btn-outline-secondary btn-sm btn-flat">← Quay lại</a>
                </div>
                
                <form action="public_entry.php?url=admin/faq/update" method="POST">
                    <input type="hidden" name="f_id" value="<?= $faq['f_id'] ?>">
                    
                    <div class="form-group mb-3">
                        <label class="col-form-label fw-bold text-uppercase text-muted">Chủ đề</label>
                        <input type="text" name="title" class="form-control bg-light" value="<?= htmlspecialchars($faq['title']) ?>" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="col-form-label fw-bold text-uppercase text-muted">Nội dung câu hỏi của khách</label>
                        <textarea name="question" class="form-control bg-light" rows="3"><?= htmlspecialchars($faq['question']) ?></textarea>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label class="col-form-label fw-bold text-uppercase text-success">Câu trả lời chính thức từ TechZone</label>
                        <textarea name="answer" class="form-control" style="border: 2px solid #28a745;" rows="6" placeholder="Nhập câu trả lời tại đây..." required><?= htmlspecialchars($faq['answer'] ?? '') ?></textarea>
                    </div>
                    
                    <div class="form-group mb-4">
                        <label class="col-form-label fw-bold text-uppercase text-muted">Trạng thái hiển thị</label>
                        <select name="status" class="form-control bg-light" style="height: 45px;">
                            <option value="pending" <?= $faq['status'] == 'pending' ? 'selected' : '' ?>>Đang chờ duyệt (Ẩn khỏi FAQ)</option>
                            <option value="answered" <?= $faq['status'] == 'answered' ? 'selected' : '' ?>>Đã trả lời (Hiển thị lên FAQ)</option>
                        </select>
                    </div>
                    
                    <div class="text-right mt-4">
                        <button type="submit" class="btn btn-success px-5 py-2 fw-bold btn-flat shadow-sm">
                            <i class="ti-save me-2"></i> LƯU VÀ CÔNG BỐ
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>