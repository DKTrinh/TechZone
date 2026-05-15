<div class="container my-5 pt-4">
    <div class="d-flex justify-content-between align-items-center mb-5 border-bottom pb-3">
        <h2 class="fw-bold text-dark m-0"><i class="fas fa-newspaper text-primary me-2"></i> Tin tức Công nghệ</h2>
        <form action="public_entry.php" method="GET" class="d-flex" style="max-width: 350px; width: 100%;">
            <input type="hidden" name="url" value="news">
            <input type="text" name="q" class="form-control rounded-start-pill bg-light border-0" placeholder="Tìm kiếm tin tức..." value="<?= htmlspecialchars($keyword ?? '') ?>">
            <button type="submit" class="btn btn-primary rounded-end-pill px-4"><i class="fas fa-search"></i></button>
        </form>
    </div>
    
    <div class="row g-4">
        <?php if(!empty($newsList)): foreach($newsList as $item): ?>
        <div class="col-md-4">
            <div class="card h-100 shadow-sm border-0 rounded-4 overflow-hidden" style="transition: 0.3s;" onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <img src="<?= htmlspecialchars($item['image']) ?>" class="card-img-top" style="height: 220px; object-fit: cover;">
                <?php if(!empty($item['badge'])): ?>
                    <span class="position-absolute top-0 start-0 m-3 badge bg-danger fs-6 shadow-sm"><?= htmlspecialchars($item['badge']) ?></span>
                <?php endif; ?>
                <div class="card-body p-4 d-flex flex-column">
                    <small class="text-primary fw-bold mb-2"><i class="fas fa-folder me-1"></i> <?= htmlspecialchars($item['category']) ?> • <?= date('d/m/Y', strtotime($item['created_at'])) ?></small>
                    <h5 class="card-title fw-bold" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;"><?= htmlspecialchars($item['title']) ?></h5>
                    <p class="card-text text-muted small flex-grow-1" style="display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;">
                        <?= strip_tags($item['content']) ?>
                    </p>
                    <a href="public_entry.php?url=news/detail&id=<?= $item['id'] ?>" class="btn btn-outline-primary rounded-pill mt-3 fw-bold w-100">Đọc bài viết <i class="fas fa-arrow-right ms-1"></i></a>
                </div>
            </div>
        </div>
        <?php endforeach; else: ?>
        <div class="col-12 text-center py-5">
            <img src="assets\uploads\products\35.png" width="100" class="opacity-50 mb-3">
            <h5 class="text-muted fw-bold">Không tìm thấy bài viết nào phù hợp.</h5>
        </div>
        <?php endif; ?>
    </div>
</div>