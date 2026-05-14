<div class="bg-light py-3 border-bottom">
    <div class="container">
        <a href="public_entry.php?url=products" class="text-decoration-none text-muted">
            <i class="fas fa-chevron-left me-1"></i> Tiếp tục mua sắm
        </a>
    </div>
</div>

<div class="container py-5" style="min-height: 70vh;">
    <h2 class="fw-bold mb-4"><i class="fas fa-shopping-cart text-danger me-2"></i> Giỏ hàng của bạn</h2>
    
    <?php if(empty($cart)): ?>
        <div class="text-center py-5 bg-white rounded-4 shadow-sm border">
            <img src="https://cdn-icons-png.flaticon.com/512/11329/11329060.png" width="150" class="mb-3 opacity-50">
            <h4 class="text-muted fw-bold">Giỏ hàng trống</h4>
            <p class="text-secondary">Bạn ơi, mua sắm đi chờ chi!</p>
            <a href="public_entry.php?url=products" class="btn btn-danger mt-3 px-5 py-3 fw-bold rounded-pill shadow-sm">
                Đến Cửa Hàng Ngay
            </a>
        </div>
    <?php else: ?>
        <form action="public_entry.php?url=checkout" method="POST" id="cartForm">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm rounded-4">
                        <div class="card-header bg-white border-bottom py-3 d-flex align-items-center">
                            <div class="form-check m-0">
                                <input class="form-check-input" type="checkbox" id="selectAll" onclick="toggleAll(this)" checked>
                                <label class="form-check-label fw-bold text-dark cursor-pointer" for="selectAll">
                                    Chọn tất cả (<span id="countSelected"><?= count($cart) ?></span> sản phẩm)
                                </label>
                            </div>
                        </div>
                        <div class="card-body p-4">
                            <?php 
                            $subtotal = 0;
                            foreach($cart as $id => $item): 
                                $itemTotal = $item['price'] * $item['qty'];
                                $subtotal += $itemTotal;
                            ?>
                            <div class="row align-items-center mb-4 pb-4 border-bottom item-row">
                                <div class="col-1 col-md-1 text-center">
                                    <input class="form-check-input item-check" type="checkbox" name="selected_items[]" 
                                           value="<?= $id ?>" data-price="<?= $item['price'] ?>" data-qty="<?= $item['qty'] ?>" 
                                           onchange="calcTotal()" checked>
                                </div>
                                <div class="col-3 col-md-2 text-center">
                                    <img src="<?= htmlspecialchars($item['thumbnail']) ?>" class="img-fluid rounded border p-1" alt="<?= htmlspecialchars($item['name']) ?>">
                                </div>
                                <div class="col-8 col-md-4">
                                    <h6 class="fw-bold mb-1 text-dark" style="line-height: 1.4;"><?= htmlspecialchars($item['name']) ?></h6>
                                    <div class="text-danger fw-bold"><?= number_format($item['price'], 0, ',', '.') ?>đ</div>
                                </div>
                                <div class="col-5 col-md-3 mt-3 mt-md-0 offset-1 offset-md-0">
                                    <div class="input-group input-group-sm mx-auto" style="max-width: 120px;">
                                        <button type="button" class="btn btn-outline-secondary fw-bold" onclick="updateQty(<?= $id ?>, -1)">-</button>
                                        <input type="text" class="form-control text-center fw-bold bg-white" value="<?= $item['qty'] ?>" readonly id="qty-<?= $id ?>">
                                        <button type="button" class="btn btn-outline-secondary fw-bold" onclick="updateQty(<?= $id ?>, 1)">+</button>
                                    </div>
                                </div>
                                <div class="col-4 col-md-2 mt-3 mt-md-0 text-end d-flex flex-column justify-content-between h-100">
                                    <div class="fw-bold text-dark fs-6 mb-2"><?= number_format($itemTotal, 0, ',', '.') ?>đ</div>
                                    <a href="public_entry.php?url=cart-remove&id=<?= $id ?>" class="text-danger fs-5" title="Xóa khỏi giỏ hàng">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-4 position-sticky" style="top: 100px;">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4 border-bottom pb-3">Tóm tắt đơn hàng</h5>
                            
                            <div class="input-group mb-3">
                                <input type="text" id="couponCode" class="form-control bg-light" placeholder="Nhập mã ưu đãi (nếu có)">
                                <button type="button" class="btn btn-dark fw-bold px-3" onclick="applyCoupon()">Áp dụng</button>
                            </div>
                            <small id="couponMsg" class="d-block mb-3 fw-bold"></small>

                            <div class="d-flex justify-content-between mb-3">
                                <span class="text-muted fw-semibold">Tạm tính:</span>
                                <span class="fw-bold text-dark" id="displaySubtotal"><?= number_format($subtotal, 0, ',', '.') ?>đ</span>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-3 text-success d-none" id="discountRow">
                                <span class="fw-semibold">Mã giảm giá:</span>
                                <span class="fw-bold" id="discountAmt">-0đ</span>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-4 border-top pt-3">
                                <span class="fs-5 fw-bold">Tổng cộng:</span>
                                <span class="fs-4 fw-bold text-danger" id="finalTotal"><?= number_format($subtotal, 0, ',', '.') ?>đ</span>
                            </div>
                            
                            <button type="submit" id="btnCheckout" class="btn btn-danger w-100 py-3 fw-bold fs-5 shadow-sm rounded-3">
                                MUA HÀNG
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let currentDiscount = 0; // Lưu trữ mức giảm giá hiện tại

    // 1. Hàm tính toán lại tổng tiền khi check/uncheck sản phẩm
    function calcTotal() {
        let total = 0;
        let checkedCount = 0;
        let checkboxes = document.querySelectorAll('.item-check');
        
        checkboxes.forEach(cb => {
            if(cb.checked) {
                checkedCount++;
                let price = parseFloat(cb.getAttribute('data-price'));
                let qty = parseInt(cb.getAttribute('data-qty'));
                total += (price * qty);
            }
        });

        // Cập nhật trạng thái nút Check All
        document.getElementById('selectAll').checked = (checkedCount === checkboxes.length && checkboxes.length > 0);
        document.getElementById('countSelected').innerText = checkedCount;

        // Cập nhật hiển thị Tạm tính
        document.getElementById('displaySubtotal').innerText = total.toLocaleString('vi-VN') + 'đ';

        // Tính lại Tổng cộng (Trừ đi mã giảm giá nếu có)
        let final = total - currentDiscount;
        if(final < 0) final = 0;
        document.getElementById('finalTotal').innerText = final.toLocaleString('vi-VN') + 'đ';

        // Bật/Tắt nút Mua hàng
        document.getElementById('btnCheckout').disabled = (checkedCount === 0);
    }

    // 2. Hàm Check All / Uncheck All
    function toggleAll(source) {
        document.querySelectorAll('.item-check').forEach(cb => {
            cb.checked = source.checked;
        });
        calcTotal();
    }

    // 3. Hàm cập nhật số lượng (AJAX)
    function updateQty(id, change) {
        let input = document.getElementById('qty-' + id);
        let newQty = parseInt(input.value) + change;
        if(newQty < 1) return; 
        
        let fd = new FormData();
        fd.append('id', id);
        fd.append('qty', newQty);
        
        fetch('public_entry.php?url=update-cart', { method: 'POST', body: fd })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success') {
                window.location.reload(); // Reload lại để backend tính toán cho đồng bộ
            } else {
                Swal.fire({ toast: true, position: 'top-end', icon: 'error', title: 'Kho chỉ còn tối đa ' + data.max + ' sản phẩm!', showConfirmButton: false, timer: 2000 });
            }
        });
    }

    // 4. Hàm áp dụng mã giảm giá (AJAX)
    function applyCoupon() {
        let code = document.getElementById('couponCode').value.trim();
        if(!code) {
            Swal.fire({ toast: true, position: 'top-end', icon: 'warning', title: 'Vui lòng nhập mã giảm giá', showConfirmButton: false, timer: 1500 });
            return;
        }
        
        let fd = new FormData();
        fd.append('code', code);
        
        fetch('public_entry.php?url=apply-coupon', { method: 'POST', body: fd })
        .then(res => res.json())
        .then(data => {
            let msgBox = document.getElementById('couponMsg');
            let row = document.getElementById('discountRow');
            let amt = document.getElementById('discountAmt');
            
            if(data.success) {
                msgBox.className = "d-block mb-3 fw-bold text-success";
                msgBox.innerHTML = '<i class="fas fa-check-circle"></i> ' + data.message;
                
                currentDiscount = data.discount;
                row.classList.remove('d-none');
                amt.innerText = '-' + currentDiscount.toLocaleString('vi-VN') + 'đ';
                
                calcTotal(); // Gọi lại hàm tính tổng để trừ tiền
                Swal.fire({ toast: true, position: 'top-end', icon: 'success', title: 'Đã áp dụng mã giảm giá!', showConfirmButton: false, timer: 1500 });
            } else {
                msgBox.className = "d-block mb-3 fw-bold text-danger";
                msgBox.innerHTML = '<i class="fas fa-times-circle"></i> ' + data.message;
                
                currentDiscount = 0;
                row.classList.add('d-none');
                calcTotal();
            }
        });
    }

    // Chạy tính toán lần đầu khi load trang
    document.addEventListener("DOMContentLoaded", () => {
        calcTotal();
    });
</script>