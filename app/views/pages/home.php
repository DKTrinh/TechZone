<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4 bg-danger text-white p-3 rounded-4 shadow" style="background: linear-gradient(90deg, #ef4444 0%, #f97316 100%);">
        <h3 class="m-0 fw-bold"><i class="fas fa-bolt text-warning me-2"></i> FLASH SALE MỖI NGÀY</h3>
        <div class="d-flex align-items-center gap-2">
            <span class="fs-5">Kết thúc sau:</span>
            <div class="bg-dark text-white px-3 py-1 rounded-3 fw-bold fs-5" id="countdown">02:59:59</div>
        </div>
    </div>
    
    <div class="row g-4">
        <!-- Chèn vòng lặp lấy 4 sản phẩm ở đây -->
        <?php foreach(array_slice($products, 0, 4) as $p): ?>
        <div class="col-md-3">
            <div class="card h-100 border-0 shadow-sm product-card">
                <div class="badge bg-danger position-absolute top-0 start-0 m-3 z-2">-<?= round((($p['old_price'] - $p['price']) / $p['old_price']) * 100) ?>%</div>
                <img src="<?= htmlspecialchars(explode(',', $p['thumbnail'])[0]) ?>" class="card-img-top p-4" alt="<?= $p['name'] ?>" style="height:250px; object-fit:contain;">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold text-truncate"><?= htmlspecialchars($p['name']) ?></h5>
                    <div class="d-flex justify-content-center align-items-center gap-2 mb-3">
                        <span class="text-danger fw-bold fs-5"><?= number_format($p['price'], 0, ',', '.') ?>đ</span>
                        <span class="text-muted text-decoration-line-through small"><?= number_format($p['old_price'], 0, ',', '.') ?>đ</span>
                    </div>
                    <button class="btn btn-danger w-100 fw-bold shadow-sm rounded-pill">MUA NGAY</button>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    // JS Đếm ngược Flash Sale
    let time = 3 * 3600; // 3 tiếng
    setInterval(() => {
        time--;
        let h = Math.floor(time / 3600).toString().padStart(2, '0');
        let m = Math.floor((time % 3600) / 60).toString().padStart(2, '0');
        let s = (time % 60).toString().padStart(2, '0');
        document.getElementById('countdown').innerText = `${h}:${m}:${s}`;
    }, 1000);
</script>