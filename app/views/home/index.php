<?php require_once '../app/views/layouts/header.php'; ?>

<style>
    /* banner carousel (đơn giản) */
    .banner-section { margin-bottom: 40px; }
    .banner-slider { display: flex; gap: 20px; flex-wrap: wrap; }
    .banner-main { flex: 2; background: linear-gradient(145deg, #0b2e3e, #154e5c); border-radius: 24px; padding: 35px 30px; color: white; position: relative; overflow: hidden; }
    .banner-main h2 { font-size: 32px; font-weight: 700; margin-bottom: 12px; }
    .banner-main p { font-size: 16px; margin-bottom: 24px; opacity: 0.9; }
    .btn-shop { background-color: #ffb347; border: none; padding: 10px 24px; border-radius: 40px; font-weight: 600; color: #1e2a3e; cursor: pointer; font-size: 15px; transition: 0.2s; }
    .btn-shop:hover { background-color: #ff9f1c; transform: scale(1.02); }
    .banner-sub { flex: 1; background: #eef2f9; border-radius: 24px; padding: 24px; display: flex; flex-direction: column; justify-content: center; }
    .banner-sub h4 { color: #0b2b44; font-size: 20px; }
    .banner-sub .price { font-size: 28px; font-weight: 800; color: #c4450c; margin: 8px 0; }

    /* section title */
    .section-title { display: flex; justify-content: space-between; align-items: baseline; margin: 32px 0 20px 0; flex-wrap: wrap; }
    .section-title h2 { font-size: 26px; font-weight: 700; border-left: 5px solid #1e6f5c; padding-left: 14px; }
    .view-all { color: #1e6f5c; font-weight: 500; cursor: pointer; }

    /* product grid */
    .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap: 24px; }
    .product-card { background: white; border-radius: 20px; overflow: hidden; transition: all 0.25s ease; box-shadow: 0 5px 12px rgba(0,0,0,0.03); border: 1px solid #eef2f9; cursor: pointer; position: relative; }
    .product-card:hover { transform: translateY(-6px); box-shadow: 0 20px 30px -12px rgba(0,0,0,0.12); border-color: #d0e2e9; }
    .product-img { background: #fafcff; text-align: center; padding: 28px 16px 16px; font-size: 80px; color: #0b2b44; }
    .product-info { padding: 12px 16px 20px; }
    .product-title { font-weight: 600; font-size: 16px; margin-bottom: 8px; height: 48px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; }
    .product-price { font-weight: 800; font-size: 20px; color: #c0392b; margin: 8px 0; }
    .old-price { font-size: 13px; color: #7f8c8d; text-decoration: line-through; margin-left: 8px; font-weight: 400; }
    .installment { font-size: 13px; color: #27ae60; background: #e9f7ef; display: inline-block; padding: 3px 10px; border-radius: 30px; margin-top: 8px; }
    .btn-buy { width: 100%; background-color: #1e6f5c; border: none; padding: 10px; color: white; font-weight: 600; border-radius: 40px; margin-top: 14px; transition: 0.2s; cursor: pointer; }
    .btn-buy:hover { background-color: #0e5545; }

    /* deal flash */
    .flash-sale { background: linear-gradient(120deg, #fff4e6, #ffe6d5); border-radius: 28px; padding: 28px 24px; margin: 32px 0; }
    .flash-header { display: flex; align-items: center; gap: 16px; flex-wrap: wrap; margin-bottom: 24px; }
    .flash-header h3 { font-size: 28px; font-weight: 800; color: #c0392b; }
    .timer { background: #2c3e50; padding: 6px 18px; border-radius: 60px; color: white; font-weight: 600; letter-spacing: 1px; }

    @media (max-width: 768px) {
        .banner-slider { flex-direction: column; }
        .product-grid { grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); }
    }
</style>

<div class="container">
    <div class="banner-section">
        <div class="banner-slider">
            <div class="banner-main">
                <h2>iPhone 15 Pro Max <br>Giá cực sốc</h2>
                <p>Trả góp 0% lãi suất - Đổi máy cũ lên đời ngay</p>
                <button class="btn-shop" id="bannerBtn" onclick="window.location.href='public_entry.php?url=products'">Mua ngay <i class="fas fa-arrow-right"></i></button>
            </div>
            <div class="banner-sub">
                <h4>Laptop Gaming Acer Nitro 5</h4>
                <div class="price">21.990.000đ</div>
                <p><i class="fas fa-gem"></i> RTX 3050 - RAM 16GB</p>
                <button class="btn-shop" style="background:#ffe0b5; margin-top:10px;" onclick="window.location.href='public_entry.php?url=products'">Xem chi tiết</button>
            </div>
        </div>
    </div>

    <?php 
    // Chuẩn bị dữ liệu cho 3 khu vực
    $allProducts = $products ?? [];
    $flashSaleProducts = array_slice($allProducts, 0, 4); 
    $featuredProducts = array_slice($allProducts, 4, 8);
    $newTechProducts = array_slice($allProducts, 12, 8);
    ?>

    <div class="flash-sale">
        <div class="flash-header">
            <h3><i class="fas fa-bolt"></i> FLASH SALE</h3>
            <div class="timer" id="timerBox">Kết thúc sau: 23:59:59</div>
            <span style="flex:1; text-align:right; font-weight:500;">Số lượng có hạn</span>
        </div>
        <div class="product-grid" id="flashGrid">
            <?php foreach($flashSaleProducts as $p): 
                $img = htmlspecialchars(trim(explode(',', $p['thumbnail'])[0]));
                $outOfStock = ($p['stock_count'] <= 0);
            ?>
            <div class="product-card" onclick="window.location.href='public_entry.php?url=product-detail&id=<?= $p['id'] ?>'">
                <?php if($p['old_price'] > $p['price']): ?>
                    <div style="position: absolute; top: 15px; left: 15px; background: #c0392b; color: white; padding: 4px 10px; border-radius: 8px; font-weight: bold; font-size: 13px; z-index: 2;">
                        -<?= round((($p['old_price'] - $p['price']) / $p['old_price']) * 100) ?>%
                    </div>
                <?php endif; ?>
                <div class="product-img" style="padding: 15px;">
                    <img src="<?= $img ?>" alt="<?= htmlspecialchars($p['name']) ?>" style="width: 100%; height: 180px; object-fit: contain; mix-blend-mode: multiply;">
                </div>
                <div class="product-info">
                    <div class="product-title"><?= htmlspecialchars($p['name']) ?></div>
                    <div class="product-price">
                        <?= number_format($p['price'], 0, ',', '.') ?>đ
                        <?php if($p['old_price'] > $p['price']): ?>
                            <span class="old-price"><?= number_format($p['old_price'], 0, ',', '.') ?>đ</span>
                        <?php endif; ?>
                    </div>
                    <?php if(!$outOfStock): ?>
                        <span class="installment">Trả góp 0%</span>
                        <button class="btn-buy" onclick="event.stopPropagation(); window.location.href='public_entry.php?url=product-detail&id=<?= $p['id'] ?>'">MUA NGAY</button>
                    <?php else: ?>
                        <span class="installment" style="background:#f2f2f2; color:#7f8c8d;">Tạm hết</span>
                        <button class="btn-buy" style="background:#bdc3c7; cursor:not-allowed;" disabled onclick="event.stopPropagation();">ĐÃ HẾT HÀNG</button>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="section-title">
        <h2>🔥 Sản phẩm nổi bật</h2>
        <div class="view-all" onclick="window.location.href='public_entry.php?url=products'">Xem tất cả <i class="fas fa-chevron-right"></i></div>
    </div>
    <div class="product-grid" id="featuredGrid">
        <?php foreach($featuredProducts as $p): 
            $img = htmlspecialchars(trim(explode(',', $p['thumbnail'])[0]));
            $outOfStock = ($p['stock_count'] <= 0);
        ?>
        <div class="product-card" onclick="window.location.href='public_entry.php?url=product-detail&id=<?= $p['id'] ?>'">
            <div class="product-img" style="padding: 15px;">
                <img src="<?= $img ?>" alt="<?= htmlspecialchars($p['name']) ?>" style="width: 100%; height: 180px; object-fit: contain; mix-blend-mode: multiply;">
            </div>
            <div class="product-info">
                <div class="product-title"><?= htmlspecialchars($p['name']) ?></div>
                <div class="product-price">
                    <?= number_format($p['price'], 0, ',', '.') ?>đ
                    <?php if($p['old_price'] > $p['price']): ?>
                        <span class="old-price"><?= number_format($p['old_price'], 0, ',', '.') ?>đ</span>
                    <?php endif; ?>
                </div>
                <?php if(!$outOfStock): ?>
                    <span class="installment">Mới ra mắt</span>
                    <button class="btn-buy" onclick="event.stopPropagation(); window.location.href='public_entry.php?url=product-detail&id=<?= $p['id'] ?>'">THÊM GIỎ HÀNG</button>
                <?php else: ?>
                    <span class="installment" style="background:#f2f2f2; color:#7f8c8d;">Tạm hết</span>
                    <button class="btn-buy" style="background:#bdc3c7; cursor:not-allowed;" disabled onclick="event.stopPropagation();">ĐÃ HẾT HÀNG</button>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

    <div class="section-title mt-5">
        <h2>✨ Công nghệ mới 2025</h2>
        <div class="view-all" onclick="window.location.href='public_entry.php?url=products'">Khám phá ngay</div>
    </div>
    <div class="product-grid mb-5" id="newTechGrid">
        <?php foreach($newTechProducts as $p): 
            $img = htmlspecialchars(trim(explode(',', $p['thumbnail'])[0]));
            $outOfStock = ($p['stock_count'] <= 0);
        ?>
        <div class="product-card" onclick="window.location.href='public_entry.php?url=product-detail&id=<?= $p['id'] ?>'">
            <div class="product-img" style="padding: 15px;">
                <img src="<?= $img ?>" alt="<?= htmlspecialchars($p['name']) ?>" style="width: 100%; height: 180px; object-fit: contain; mix-blend-mode: multiply;">
            </div>
            <div class="product-info">
                <div class="product-title"><?= htmlspecialchars($p['name']) ?></div>
                <div class="product-price">
                    <?= number_format($p['price'], 0, ',', '.') ?>đ
                    <?php if($p['old_price'] > $p['price']): ?>
                        <span class="old-price"><?= number_format($p['old_price'], 0, ',', '.') ?>đ</span>
                    <?php endif; ?>
                </div>
                <?php if(!$outOfStock): ?>
                    <span class="installment">Chính hãng 100%</span>
                    <button class="btn-buy" onclick="event.stopPropagation(); window.location.href='public_entry.php?url=product-detail&id=<?= $p['id'] ?>'">MUA NGAY</button>
                <?php else: ?>
                    <span class="installment" style="background:#f2f2f2; color:#7f8c8d;">Tạm hết</span>
                    <button class="btn-buy" style="background:#bdc3c7; cursor:not-allowed;" disabled onclick="event.stopPropagation();">ĐÃ HẾT HÀNG</button>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    // Logic đếm ngược đơn giản cho mục Flash Sale
    document.addEventListener("DOMContentLoaded", function() {
        let timeInSeconds = 3 * 3600; 
        const timerBox = document.getElementById('timerBox');
        
        const countdownInterval = setInterval(() => {
            timeInSeconds--;
            if (timeInSeconds <= 0) {
                clearInterval(countdownInterval);
                timerBox.innerText = "Đã kết thúc";
                return;
            }
            let h = Math.floor(timeInSeconds / 3600).toString().padStart(2, '0');
            let m = Math.floor((timeInSeconds % 3600) / 60).toString().padStart(2, '0');
            let s = (timeInSeconds % 60).toString().padStart(2, '0');
            
            timerBox.innerText = `Kết thúc sau: ${h}:${m}:${s}`;
        }, 1000);
    });
</script>

<?php require_once '../app/views/layouts/footer.php'; ?>