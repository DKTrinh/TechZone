<div class="container py-5" style="min-height: 80vh;">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">
            <div class="card shadow border-0" style="border-radius: 15px;">
                <div class="card-header bg-info text-dark fw-bold text-center py-3" style="border-radius: 15px 15px 0 0;">
                    <h5 class="mb-0"><i class="fas fa-user-edit me-2"></i> Cập nhật thông tin Thành viên #<?= $user['id'] ?></h5>
                </div>
                <div class="card-body p-4 p-md-5">
                    <form action="public_entry.php?url=user-update" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">
                        
                        <div class="text-center mb-4">
                            <label style="cursor: pointer;" class="position-relative d-inline-block">
                                <img id="previewAvatar" src="<?= !empty($user['avatar']) ? htmlspecialchars($user['avatar']) . '?v=' . time() : 'https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg' ?>" 
                                     class="rounded-circle border border-4 border-info shadow-sm" 
                                     style="width: 130px; height: 130px; object-fit: cover;">
                                <div class="mt-2 text-primary fw-bold small"><i class="fas fa-camera"></i> Bấm để đổi ảnh</div>
                                <input type="file" name="avatar" id="avatarInput" hidden accept="image/*" onchange="previewFile()">
                            </label>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted small">Họ và Tên</label>
                                <input type="text" name="fullname" class="form-control bg-light" value="<?= htmlspecialchars($user['fullname']) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted small">Email (Tài khoản)</label>
                                <input type="email" name="email" class="form-control bg-light" value="<?= htmlspecialchars($user['email']) ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted small">Số điện thoại</label>
                                <input type="text" name="phone" class="form-control bg-light" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted small">Ngày sinh</label>
                                <input type="date" name="birthdate" class="form-control bg-light" value="<?= htmlspecialchars($user['birthdate'] ?? '') ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted small">Giới tính</label>
                                <select name="gender" class="form-select bg-light">
                                    <option value="">Chưa chọn</option>
                                    <option value="male" <?= ($user['gender']??'') == 'male' ? 'selected' : '' ?>>Nam</option>
                                    <option value="female" <?= ($user['gender']??'') == 'female' ? 'selected' : '' ?>>Nữ</option>
                                    <option value="other" <?= ($user['gender']??'') == 'other' ? 'selected' : '' ?>>Khác</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold text-muted small">Phân quyền</label>
                                <select name="role" class="form-select border-primary">
                                    <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Admin (Quản trị viên)</option>
                                    <option value="client" <?= $user['role'] == 'client' ? 'selected' : '' ?>>Client (Khách hàng)</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label fw-semibold text-muted small">Địa chỉ giao hàng</label>
                                    <a href="javascript:void(0)" class="small fw-bold text-success text-decoration-none" onclick="openAddressModal()">Sổ địa chỉ <i class="fas fa-book"></i></a>
                                </div>
                                <textarea name="address" id="main_address" class="form-control bg-light" rows="2"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2 mt-5">
                            <button type="submit" class="btn btn-info fw-bold py-3 shadow-sm text-dark fs-5">
                                <i class="fas fa-save me-2"></i> LƯU TOÀN BỘ THAY ĐỔI
                            </button>
                            <a href="public_entry.php?url=users" class="btn btn-outline-secondary py-2 fw-bold mt-2">Hủy bỏ / Quay lại</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addressModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <div class="modal-header bg-success text-white border-0" style="border-radius: 20px 20px 0 0;">
                <h5 class="modal-title fw-bold">Quản lý Sổ địa chỉ</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div id="addressList" class="mb-3"></div>
                <div class="input-group mt-3">
                    <input type="text" id="newAddressInput" class="form-control" placeholder="Nhập địa chỉ mới...">
                    <button class="btn btn-success fw-bold" onclick="addNewAddress()">Thêm</button>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary fw-bold" onclick="saveAddressSelection()" data-bs-dismiss="modal">Xác nhận chọn</button>
            </div>
        </div>
    </div>
</div>

<script>
    function previewFile() {
        const preview = document.getElementById('previewAvatar');
        const file = document.getElementById('avatarInput').files[0];
        const reader = new FileReader();
        reader.onloadend = function() { preview.src = reader.result; }
        if (file) { reader.readAsDataURL(file); }
    }

    // Logic Sổ địa chỉ (y hệt trang User)
    function openAddressModal() {
        const addrs = document.getElementById('main_address').value.split('\n').filter(a => a.trim());
        let html = addrs.map((a, i) => `<div class="form-check mb-2 p-3 bg-light border rounded"><input class="form-check-input ms-1" type="radio" name="addrRadio" id="adr${i}" value="${a}" ${i===0?'checked':''}><label class="form-check-label ms-2 fw-bold" for="adr${i}">${a}</label></div>`).join('') || '<p class="text-muted">Chưa có địa chỉ nào.</p>';
        document.getElementById('addressList').innerHTML = html;
        new bootstrap.Modal(document.getElementById('addressModal')).show();
    }
    function addNewAddress() {
        const val = document.getElementById('newAddressInput').value.trim();
        if(val) { 
            document.getElementById('addressList').innerHTML += `<div class="form-check mb-2 p-3 bg-light border rounded"><input class="form-check-input ms-1" type="radio" name="addrRadio" value="${val}" checked><label class="form-check-label ms-2 fw-bold">${val}</label></div>`; 
            document.getElementById('newAddressInput').value = ''; 
        }
    }
    function saveAddressSelection() {
        const selected = document.querySelector('input[name="addrRadio"]:checked');
        if(selected) {
            const all = Array.from(document.querySelectorAll('input[name="addrRadio"]')).map(el => el.value);
            const reordered = [selected.value, ...all.filter(a => a !== selected.value)];
            document.getElementById('main_address').value = reordered.join('\n');
        }
    }
</script>