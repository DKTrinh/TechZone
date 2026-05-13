<div class="container py-5">
    <div class="card shadow-sm border-0" style="border-radius: 20px;">
        <div class="card-body p-5">
            <h4 class="fw-bold text-success mb-4">QUẢN LÝ NỘI DUNG TRANG GIỚI THIỆU</h4>
            <form action="public_entry.php?url=admin/about-update" method="POST">
                <?php foreach($contents as $item): ?>
                <div class="mb-4">
                    <label class="fw-bold text-muted small text-uppercase"><?= $item['section_name'] ?></label>
                    <textarea name="content[<?= $item['page_key'] ?>]" class="form-control mt-2" rows="4"><?= htmlspecialchars($item['content_value']) ?></textarea>
                </div>
                <?php endforeach; ?>
                <button type="submit" class="btn btn-success px-5 py-2 fw-bold rounded-pill">LƯU THAY ĐỔI</button>
            </form>
        </div>
    </div>
</div>