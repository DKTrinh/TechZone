<div id="productBanner" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-inner">
        <?php foreach($banners as $index => $banner): ?>
        <div class="carousel-item <?= $index == 0 ? 'active' : '' ?>" data-bs-interval="4000">
            <a href="<?= $banner['link'] ?>">
                <img src="<?= $banner['image'] ?>" class="d-block w-100" style="height: 350px; object-fit: cover; filter: brightness(0.8);">
                <div class="carousel-caption d-none d-md-block">
                    <h2 class="fw-bold text-white display-5 shadow-sm"><?= $banner['title'] ?></h2>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#productBanner" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#productBanner" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </button>
</div>

<div class="container py-4">
    <div class="row g-4">
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm rounded-4 p-4 sticky-top" style="top: 100px;">
                <h5 class="fw-bold mb-4"><i class="fas fa-filter text-primary me-2"></i> Lọc Sản Phẩm</h5>
                <form action="public_entry.php" method="GET">
                    <input type="hidden" name="url" value="products">
                    
                    <div class="mb-3">
                        <label class="fw-bold small text-muted mb-2">Từ khóa</label>
                        <input type="text" name="q" class="form-control" value="<?= htmlspecialchars($_GET['q'] ?? '') ?>" placeholder="Tìm tên SP...">
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold small text-muted mb-2">Danh mục</label>
                        <select name="category" class="form-select bg-light">
                            <option value="">Tất cả</option>
                            <?php foreach($categories as $c): ?>
                                <option value="<?= $c['id'] ?>" <?= isset($_GET['category']) && $_GET['category']==$c['id'] ? 'selected':'' ?>><?= $c['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold small text-muted mb-2">Thương hiệu</label>
                        <select name="brand" class="form-select bg-light">
                            <option value="">Tất cả</option>
                            <?php foreach($brands as $b): ?>
                                <option value="<?= $b['brand'] ?>" <?= isset($_GET['brand']) && $_GET['brand']==$b['brand'] ? 'selected':'' ?>><?= $b['brand'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="fw-bold small text-muted mb-2">Sắp xếp</label>
                        <select name="sort" class="form-select bg-light">
                            <option value="newest">Mới nhất</option>
                            <option value="price_asc">Giá tăng dần</option>
                            <option value="price_desc">Giá giảm dần</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 fw-bold shadow-sm">Lọc Kết Quả</button>
                </form>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="row g-4">
                <?php if(!empty($products)): foreach($products as $p): 
                    $discountPct = ($p['old_price'] > $p['price']) ? round((($p['old_price'] - $p['price']) / $p['old_price']) * 100) : 0;
                    $images = explode(',', $p['thumbnail']);
                ?>
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 rounded-4 border-0 shadow-sm product-card">
                        <?php if($discountPct > 0): ?>
                            <span class="position-absolute top-0 start-0 badge bg-danger m-3 px-2 py-1 z-1">-<?= $discountPct ?>%</span>
                        <?php endif; ?>
                        
                        <a href="?url=product-detail&id=<?= $p['id'] ?>" class="text-center p-3">
                            <img src="<?= htmlspecialchars(trim($images[0])) ?>" class="img-fluid" style="height: 200px; object-fit: contain; transition: 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        </a>
                        <div class="card-body pt-0 d-flex flex-column">
                            <small class="text-primary fw-bold"><?= $p['brand'] ?></small>
                            <a href="?url=product-detail&id=<?= $p['id'] ?>" class="text-dark text-decoration-none fw-bold text-truncate mb-2" style="font-size: 1.1rem;"><?= htmlspecialchars($p['name']) ?></a>
                            
                            <div class="mt-auto">
                                <h5 class="text-danger fw-bold mb-0"><?= number_format($p['price'], 0, ',', '.') ?>đ</h5>
                                <?php if($discountPct > 0): ?>
                                    <small class="text-muted text-decoration-line-through"><?= number_format($p['old_price'], 0, ',', '.') ?>đ</small>
                                <?php endif; ?>
                            </div>
                            <div class="d-flex gap-2 mt-3">
                                <button onclick="addCartAjax(<?= $p['id'] ?>)" class="btn btn-outline-danger w-50 fw-bold"><i class="fas fa-cart-plus"></i></button>
                                <button onclick="buyNow(<?= $p['id'] ?>)" class="btn btn-danger w-50 fw-bold">Mua</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; else: ?>
                    <div class="text-center py-5"><h4>Không tìm thấy sản phẩm!</h4></div>
                <?php endif; ?>
            </div>

            <?php if(isset($totalPages) && $totalPages > 1): ?>
            <ul class="pagination justify-content-center mt-5">
                <?php for($i = 1; $i <= $totalPages; $i++): ?>
                    <li class="page-item <?= ($page == $i) ? 'active' : '' ?>"><a class="page-link" href="?url=products&page=<?= $i ?>&category=<?= $_GET['category'] ?? '' ?>"><?= $i ?></a></li>
                <?php endfor; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    const isLoggedIn = <?= isset($_SESSION['user_id']) ? 'true' : 'false' ?>;

    function handleAuthAction(actionFunc) {
        if (!isLoggedIn) {
            Swal.fire({ 
                title: 'Yêu cầu đăng nhập', 
                text: 'Bạn cần đăng nhập để thêm giỏ hàng hoặc mua ngay!', 
                icon: 'warning', 
                showCancelButton: true,
                confirmButtonText: 'Đăng nhập',
                cancelButtonText: 'Đóng'
            }).then((result) => {
                if (result.isConfirmed) { window.location.href = '?url=login'; }
            });
            return false;
        }
        actionFunc();
    }

    function addCartAjax(id) {
        handleAuthAction(() => {
            let fd = new FormData();
            fd.append('product_id', id); fd.append('quantity', 1);
            fetch('?url=cart-add-ajax', { method: 'POST', body: fd })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: data.message, showConfirmButton: false, timer: 1500 });
                    document.getElementById('cartCount').innerText = data.cart_count;
                }
            });
        });
    }

    function buyNow(id) {
        handleAuthAction(() => {
            let form = document.createElement('form');
            form.method = 'POST'; form.action = '?url=buy-now';
            form.innerHTML = `<input type="hidden" name="product_id" value="${id}"><input type="hidden" name="quantity" value="1">`;
            document.body.appendChild(form); form.submit();
        });
    }
</script>