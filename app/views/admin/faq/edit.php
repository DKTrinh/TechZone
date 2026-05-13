<div class="container py-5">
    <div class="card shadow-lg border-0" style="border-radius: 25px;">
        <div class="card-body p-5">
            <h5 class="fw-bold mb-4" style="color: #1e3a3a;">BIÊN TẬP & DUYỆT CÂU TRẢ LỜI</h5>
            <form action="public_entry.php?url=admin/faq/update" method="POST">
                <input type="hidden" name="f_id" value="<?= $faq['f_id'] ?>">
                <div class="mb-3">
                    <label class="small fw-bold">Chủ đề</label>
                    <input type="text" name="title" class="form-control" value="<?= htmlspecialchars($faq['title']) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="small fw-bold">Nội dung câu hỏi</label>
                    <textarea name="question" class="form-control" rows="3"><?= htmlspecialchars($faq['question']) ?></textarea>
                </div>
                <div class="mb-4">
                    <label class="small fw-bold">Câu trả lời (Matrix Style)</label>
                    <textarea name="answer" class="form-control" rows="6" required><?= htmlspecialchars($faq['answer']) ?></textarea>
                </div>
                <div class="mb-4">
                    <label class="small fw-bold">Hành động duyệt</label>
                    <select name="status" class="form-select">
                        <option value="pending" <?= $faq['status'] == 'pending' ? 'selected' : '' ?>>Để ở trạng thái Chờ</option>
                        <option value="answered" <?= $faq['status'] == 'answered' ? 'selected' : '' ?>>Duyệt & Cho phép hiển thị</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success px-5 rounded-pill fw-bold">LƯU THAY ĐỔI</button>
            </form>
        </div>
    </div>
</div>