<div class="bg-light py-3 border-bottom">
    <div class="container"><a href="public_entry.php?url=cart" class="text-decoration-none text-muted"><i class="fas fa-chevron-left"></i> Quay lại giỏ hàng</a></div>
</div>

<div class="container py-5">
    <form action="public_entry.php?url=checkout-process" method="POST" id="checkoutForm" novalidate>
        <div class="row g-5">
            <!-- Form điền thông tin -->
            <div class="col-lg-7">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="fw-bold m-0"><i class="fas fa-map-marker-alt text-danger me-2"></i> Thông tin giao hàng</h3>
                    <button type="button" class="btn btn-outline-success btn-sm fw-bold" onclick="openAddressBook()">
                        <i class="fas fa-address-book"></i> Chọn từ Sổ địa chỉ
                    </button>
                </div>

                <div class="card border-0 shadow-sm rounded-4 p-4">
                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label fw-bold text-muted small">Họ và Tên người nhận <span class="text-danger">*</span></label>
                            <input type="text" id="chk_name" name="fullname" class="form-control form-control-lg bg-light" value="<?= htmlspecialchars($user['fullname'] ?? '') ?>" required placeholder="Ví dụ: Minh Anh">
                            <div class="invalid-feedback fw-semibold" id="err_name"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small">Email (Để nhận hóa đơn) <span class="text-danger">*</span></label>
                            <input type="email" id="chk_email" name="email" class="form-control form-control-lg bg-light" value="<?= htmlspecialchars($user['email'] ?? '') ?>" required>
                            <div class="invalid-feedback fw-semibold" id="err_email"></div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small">Số điện thoại liên hệ <span class="text-danger">*</span></label>
                            <input type="text" id="chk_phone" name="phone" class="form-control form-control-lg bg-light" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" required>
                            <div class="invalid-feedback fw-semibold" id="err_phone"></div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold text-muted small">Địa chỉ nhận hàng chi tiết <span class="text-danger">*</span></label>
                            <textarea id="chk_addr" name="address" class="form-control form-control-lg bg-light" rows="3" required placeholder="Ví dụ: 123 Lê Lợi, Phường Bến Thành, Quận 1..."><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                            <div class="invalid-feedback fw-semibold" id="err_addr"></div>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold text-muted small">Ghi chú (Tùy chọn)</label>
                            <textarea name="note" class="form-control form-control-lg bg-light" rows="2" placeholder="Ví dụ: Giao hàng vào giờ hành chính, gọi trước khi giao..."></textarea>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-check mt-2 bg-light p-3 rounded border">
                                <input class="form-check-input ms-1" type="checkbox" id="saveNewAddr">
                                <label class="form-check-label text-primary fw-bold ms-2" for="saveNewAddr">
                                    Lưu thông tin giao hàng này vào Sổ địa chỉ để dùng lần sau
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tóm tắt Đơn hàng -->
            <div class="col-lg-5">
                <h3 class="fw-bold mb-4"><i class="fas fa-receipt text-primary me-2"></i> Đơn hàng của bạn</h3>
                <div class="card border-0 shadow-sm rounded-4 p-4 position-sticky" style="top: 100px;">
                    <div class="order-items-wrapper mb-3" style="max-height: 300px; overflow-y: auto;">
                        <?php 
                        $subtotal = 0;
                        foreach($checkoutItems as $item): 
                            $subtotal += $item['price'] * $item['qty'];
                        ?>
                        <div class="d-flex align-items-center justify-content-between mb-3 pe-2">
                            <div class="d-flex align-items-center">
                                <div class="position-relative">
                                    <img src="<?= htmlspecialchars($item['thumbnail']) ?>" width="60" class="rounded border p-1 me-3 bg-white">
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-light"><?= $item['qty'] ?></span>
                                </div>
                                <div>
                                    <div class="fw-bold small text-truncate text-dark" style="max-width: 180px;"><?= htmlspecialchars($item['name']) ?></div>
                                </div>
                            </div>
                            <div class="fw-bold text-dark"><?= number_format($item['price'] * $item['qty'], 0, ',', '.') ?>đ</div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <hr class="text-muted border-dashed">
                    
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted fw-semibold">Tạm tính</span>
                        <span class="fw-bold"><?= number_format($subtotal, 0, ',', '.') ?>đ</span>
                    </div>
                    
                    <?php 
                    $discount = $_SESSION['discount'] ?? 0;
                    $final = $subtotal - $discount;
                    if($discount > 0): 
                    ?>
                    <div class="d-flex justify-content-between mb-2 text-success">
                        <span class="fw-semibold"><i class="fas fa-tag"></i> Giảm giá khuyến mãi</span>
                        <span class="fw-bold">-<?= number_format($discount, 0, ',', '.') ?>đ</span>
                    </div>
                    <?php endif; ?>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted fw-semibold">Phí vận chuyển</span>
                        <span class="fw-bold text-success">Miễn phí</span>
                    </div>
                    
                    <div class="bg-light p-3 rounded-3 mb-4 mt-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="fs-5 fw-bold text-dark">Tổng thanh toán</span>
                            <span class="fs-3 fw-bold text-danger"><?= number_format($final, 0, ',', '.') ?>đ</span>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-danger w-100 py-3 fw-bold fs-5 shadow-sm rounded-3">XÁC NHẬN ĐẶT HÀNG</button>
                    <p class="text-center text-muted small mt-3 mb-0"><i class="fas fa-shield-alt"></i> Thông tin của bạn được bảo mật tuyệt đối</p>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- POP-UP SỔ ĐỊA CHỈ -->
<div class="modal fade" id="addressBookModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <div class="modal-header bg-success text-white">
                <h5 class="fw-bold m-0">Sổ địa chỉ của bạn</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body bg-light" id="addressListContainer">
            </div>
        </div>
    </div>
</div>

<!-- POP-UP BÁO LỖI (Ở GIỮA MÀN HÌNH) -->
<div id="errorToast" class="position-fixed top-50 start-50 translate-middle bg-white border border-danger border-2 rounded-4 shadow-lg p-4 text-center" style="display: none; z-index: 9999; min-width: 300px;">
    <i class="fas fa-exclamation-triangle text-danger fs-1 mb-2"></i>
    <h5 class="fw-bold text-dark mt-2">Giao dịch chưa hoàn tất!</h5>
    <p class="text-muted mb-0">Vui lòng kiểm tra lại các thông tin bị đánh dấu đỏ.</p>
</div>

<script>
    const userKey = 'addressBook_User<?= $user['id'] ?? 'guest' ?>';
    
    // --- CÁC HÀM XỬ LÝ SỔ ĐỊA CHỈ ---
    function getAddressBook() {
        let data = localStorage.getItem(userKey);
        return data ? JSON.parse(data) : [];
    }

    function saveToAddressBook(name, phone, address) {
        let book = getAddressBook();
        let exists = book.some(b => b.name === name && b.phone === phone && b.address === address);
        if(!exists) {
            book.push({name, phone, address});
            localStorage.setItem(userKey, JSON.stringify(book));
        }
    }

    function openAddressBook() {
        let book = getAddressBook();
        let html = '';
        if(book.length === 0) {
            html = '<p class="text-center text-muted py-3">Sổ địa chỉ trống.</p>';
        } else {
            book.forEach((item, index) => {
                html += `
                <div class="card border-0 shadow-sm mb-3" style="cursor: pointer;" onclick="selectAddress(${index})">
                    <div class="card-body">
                        <div class="fw-bold fs-6 text-dark">${item.name} <span class="text-secondary fw-normal">| ${item.phone}</span></div>
                        <div class="text-muted small mt-1">${item.address}</div>
                        <button class="btn btn-sm btn-outline-danger mt-2" onclick="deleteAddress(event, ${index})">Xóa</button>
                    </div>
                </div>`;
            });
        }
        document.getElementById('addressListContainer').innerHTML = html;
        new bootstrap.Modal(document.getElementById('addressBookModal')).show();
    }

    function selectAddress(index) {
        let book = getAddressBook();
        let item = book[index];
        document.getElementById('chk_name').value = item.name;
        document.getElementById('chk_phone').value = item.phone;
        document.getElementById('chk_addr').value = item.address;
        
        let modalEl = document.getElementById('addressBookModal');
        let modalInstance = bootstrap.Modal.getInstance(modalEl);
        if(modalInstance) modalInstance.hide();
        
        validateName();
        validatePhone();
        validateAddr();
    }

    function deleteAddress(e, index) {
        e.stopPropagation();
        let book = getAddressBook();
        book.splice(index, 1);
        localStorage.setItem(userKey, JSON.stringify(book));
        openAddressBook();
    }

    // --- CÁC HÀM VALIDATION REAL-TIME ---
    function showError(inputId, errorId, message) {
        document.getElementById(inputId).classList.add('is-invalid');
        document.getElementById(errorId).innerText = message;
    }

    function clearSingleError(inputId) {
        document.getElementById(inputId).classList.remove('is-invalid');
    }

    function validateName() {
        const input = document.getElementById('chk_name');
        if (input.value.trim() === '' || input.value.trim().indexOf(' ') === -1) {
            showError('chk_name', 'err_name', 'Vui lòng nhập đầy đủ Họ và Tên (Ít nhất 2 từ).');
            return false;
        }
        clearSingleError('chk_name');
        return true;
    }

    function validateEmail() {
        const input = document.getElementById('chk_email');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(input.value.trim())) {
            showError('chk_email', 'err_email', 'Định dạng email không hợp lệ.');
            return false;
        }
        clearSingleError('chk_email');
        return true;
    }

    function validatePhone() {
        const input = document.getElementById('chk_phone');
        const phoneRegex = /^[0-9]{10,}$/;
        if (!phoneRegex.test(input.value.trim())) {
            showError('chk_phone', 'err_phone', 'Vui lòng nhập số điện thoại hợp lệ (ít nhất 10 số).');
            return false;
        }
        clearSingleError('chk_phone');
        return true;
    }

    function validateAddr() {
        const input = document.getElementById('chk_addr');
        if (input.value.trim().length < 5) {
            showError('chk_addr', 'err_addr', 'Vui lòng nhập địa chỉ nhận hàng chi tiết.');
            return false;
        }
        clearSingleError('chk_addr');
        return true;
    }

    // GẮN SỰ KIỆN LẮNG NGHE CHO TỪNG Ô NHẬP LIỆU
    const inputs = [
        { id: 'chk_name', validator: validateName },
        { id: 'chk_email', validator: validateEmail },
        { id: 'chk_phone', validator: validatePhone },
        { id: 'chk_addr', validator: validateAddr }
    ];

    inputs.forEach(item => {
        const el = document.getElementById(item.id);
        el.addEventListener('blur', item.validator);
        el.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                item.validator();
            }
        });
    });

    // --- XỬ LÝ KHI ẤN ĐẶT HÀNG ---
    document.getElementById('checkoutForm').addEventListener('submit', function(e) {
        // Chạy lại tất cả các hàm validate
        const isNameValid = validateName();
        const isEmailValid = validateEmail();
        const isPhoneValid = validatePhone();
        const isAddrValid = validateAddr();

        const isValid = isNameValid && isEmailValid && isPhoneValid && isAddrValid;

        // Nếu có lỗi, CHẶN GIAO DỊCH và HIỆN POPUP
        if (!isValid) {
            e.preventDefault();
            
            // Tìm ô lỗi đầu tiên và focus vào nó
            if (!isNameValid) document.getElementById('chk_name').focus();
            else if (!isEmailValid) document.getElementById('chk_email').focus();
            else if (!isPhoneValid) document.getElementById('chk_phone').focus();
            else if (!isAddrValid) document.getElementById('chk_addr').focus();

            // Hiển thị Popup ở giữa màn hình
            const toast = document.getElementById('errorToast');
            toast.style.display = 'block';

            // Tự động tắt sau 2 giây
            setTimeout(() => {
                toast.style.display = 'none';
            }, 2000);

            return false;
        }

        // Nếu hợp lệ toàn bộ -> Lưu địa chỉ nếu checkbox được tick
        if(document.getElementById('saveNewAddr').checked) {
            saveToAddressBook(
                document.getElementById('chk_name').value.trim(),
                document.getElementById('chk_phone').value.trim(),
                document.getElementById('chk_addr').value.trim()
            );
        }
    });
</script>
