<style>
    .profile-card { border: none; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); background: #fff; }
    .form-control-profile { border-radius: 10px; border: 1px solid #e2e8f0; padding: 12px 15px; background-color: #f8fafc; transition: 0.3s;}
    .form-control-profile:focus { background-color: #fff; border-color: #1e6f5c; box-shadow: 0 0 0 4px rgba(30, 111, 92, 0.1); }
    
    /* THIẾT KẾ NÚT LƯU KHI BỊ KHÓA (DISABLED) VÀ KHI MỞ KHÓA */
    .btn-save-profile { transition: all 0.3s ease; border: none; }
    .btn-save-profile:disabled { background-color: #bdc3c7 !important; color: #fff; cursor: not-allowed; opacity: 0.8; }
    .btn-save-profile:not(:disabled) { background-color: #1e6f5c !important; color: white !important; box-shadow: 0 4px 15px rgba(30, 111, 92, 0.4); transform: translateY(-2px); }

    .btn-save-password { transition: all 0.3s ease; border: none; }
    .btn-save-password:disabled { background-color: #bdc3c7 !important; color: #fff; cursor: not-allowed; opacity: 0.8; }
    .btn-save-password:not(:disabled) { background-color: #e74c3c !important; color: white !important; box-shadow: 0 4px 15px rgba(231, 76, 60, 0.4); transform: translateY(-2px); }

    /* Khu vực Dropzone Kéo thả ảnh */
    #drop-zone { border: 2px dashed #1e6f5c; border-radius: 50%; width: 140px; height: 140px; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative; margin: 0 auto; cursor: pointer; background: #f0f2f5; }
    #drop-zone img { width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: 1; }
    #drop-zone .overlay { position: absolute; z-index: 2; background: rgba(0,0,0,0.5); color: white; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; opacity: 0; transition: 0.3s; }
    #drop-zone:hover .overlay { opacity: 1; }

    /* Mắt xem mật khẩu */
    .input-group-pass { position: relative; }
    .input-group-pass .toggle-password { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #7f8c8d; z-index: 10; border: none; background: transparent;}
    .is-valid-pass { border-color: #2ecc71 !important; background-color: #eafaf1 !important; }
    .is-invalid-pass { border-color: #e74c3c !important; background-color: #fdedec !important; }
</style>

<div style="height: 150px; background: linear-gradient(135deg, #0b2b44 0%, #1e6f5c 100%); margin-bottom: -50px;"></div>

<div class="container mb-5 position-relative" style="z-index: 10;">
    <div class="row g-4">
        
        <div class="col-lg-5">
            <div class="profile-card p-4">
                <form action="public_entry.php?url=profile-update" method="POST" enctype="multipart/form-data" id="profileForm">
                    <div class="text-center mb-4">
                        <label id="drop-zone" class="mb-3 d-inline-block shadow-sm">
                            <img src="<?= !empty($user['avatar']) ? htmlspecialchars($user['avatar']) . '?v=' . time() : 'https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg' ?>" id="avatar-preview">
                            <div class="overlay"><i class="fas fa-camera fs-3"></i></div>
                            <input type="file" name="avatar" id="avatar-input" class="d-none" accept="image/*">
                        </label>
                        <h4 class="fw-bold mt-1 mb-1 text-dark"><?= htmlspecialchars($user['fullname']) ?></h4>
                    </div>
                    
                    <h5 class="fw-bold mb-3"><i class="fas fa-user-edit text-success me-2"></i> Thông tin cá nhân</h5>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="fw-bold small text-muted">Họ và Tên</label>
                            <input type="text" name="fullname" class="form-control form-control-profile" value="<?= htmlspecialchars($user['fullname']) ?>" required>
                        </div>
                        <div class="col-12">
                            <label class="fw-bold small text-muted">Email (Tài khoản)</label>
                            <input type="email" name="email" class="form-control form-control-profile" value="<?= htmlspecialchars($user['email']) ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small text-muted">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control form-control-profile" value="<?= htmlspecialchars($user['phone'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="fw-bold small text-muted">Ngày sinh</label>
                            <input type="date" name="birthdate" class="form-control form-control-profile" value="<?= htmlspecialchars($user['birthdate'] ?? '') ?>">
                        </div>
                        <div class="col-12">
                            <label class="fw-bold small text-muted">Giới tính</label>
                            <select name="gender" class="form-select form-control-profile">
                                <option value="">Chưa chọn</option>
                                <option value="male" <?= ($user['gender']??'') == 'male' ? 'selected' : '' ?>>Nam</option>
                                <option value="female" <?= ($user['gender']??'') == 'female' ? 'selected' : '' ?>>Nữ</option>
                                <option value="other" <?= ($user['gender']??'') == 'other' ? 'selected' : '' ?>>Khác</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between">
                                <label class="fw-bold small text-muted">Địa chỉ giao hàng</label>
                                <a href="javascript:void(0)" class="small fw-bold text-success text-decoration-none" onclick="openAddressModal()">Sổ địa chỉ <i class="fas fa-book"></i></a>
                            </div>
                            <textarea name="address" id="main_address" class="form-control form-control-profile" rows="2"><?= htmlspecialchars($user['address'] ?? '') ?></textarea>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" id="btn-save-profile" class="btn w-100 fw-bold py-3 shadow btn-save-profile" disabled>
                                <i class="fas fa-save me-2"></i> LƯU THAY ĐỔI
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="profile-card p-4 p-md-5 h-100">
                <h4 class="fw-bold mb-4 text-dark"><i class="fas fa-shield-alt text-warning me-2"></i> Đổi mật khẩu</h4>
                <form action="public_entry.php?url=profile-password" method="POST" id="passwordForm">
                    <div class="row g-4">
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-muted small">Mật khẩu hiện tại</label>
                            <div class="input-group-pass">
                                <input type="password" name="current_password" id="curr_pass" class="form-control form-control-profile" required>
                                <button type="button" class="toggle-password" onclick="togglePass('curr_pass', this)"><i class="fas fa-eye"></i></button>
                            </div>
                            <small id="curr_pass_msg"></small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small">Mật khẩu mới</label>
                            <div class="input-group-pass">
                                <input type="password" name="new_password" id="new_pass" class="form-control form-control-profile" required>
                                <button type="button" class="toggle-password" onclick="togglePass('new_pass', this)"><i class="fas fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted small">Xác nhận mật khẩu</label>
                            <div class="input-group-pass">
                                <input type="password" name="confirm_password" id="conf_pass" class="form-control form-control-profile" required>
                                <button type="button" class="toggle-password" onclick="togglePass('conf_pass', this)"><i class="fas fa-eye"></i></button>
                            </div>
                            <small id="match_msg"></small>
                        </div>
                        <div class="col-12 mt-5 text-end">
                            <button type="submit" id="btn_submit_pass" class="btn fw-bold px-5 py-3 shadow btn-save-password" disabled>
                                <i class="fas fa-key me-2"></i> CẬP NHẬT MẬT KHẨU
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addressModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <div class="modal-header bg-success text-white border-0" style="border-radius: 20px 20px 0 0;">
                <h5 class="modal-title fw-bold">Sổ địa chỉ của bạn</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div id="addressList" class="mb-3"></div>
                <div class="input-group mt-3">
                    <input type="text" id="newAddressInput" class="form-control form-control-profile" placeholder="Nhập địa chỉ mới...">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // 1. POPUP THÔNG BÁO (Toast)
    <?php if (isset($_SESSION['auth_status'])): ?>
        Swal.fire({
            toast: true, position: 'top-end', showConfirmButton: false, timer: 2000,
            icon: '<?= $_SESSION['auth_status'] ?>', title: '<?= $_SESSION['auth_message'] ?>'
        });
        <?php unset($_SESSION['auth_status'], $_SESSION['auth_message']); ?>
    <?php endif; ?>

    // 2. MỞ KHÓA NÚT LƯU KHI CÓ THAY ĐỔI
    const pForm = document.getElementById('profileForm');
    const pSaveBtn = document.getElementById('btn-save-profile');
    
    // Thu thập dữ liệu ban đầu
    const initialData = new FormData(pForm);

    function checkFormChanges() {
        let changed = false;
        const currentData = new FormData(pForm);
        for(let [key, val] of initialData.entries()) {
            // Loại trừ file upload lúc so sánh text
            if(key !== 'avatar' && currentData.get(key) !== val) { changed = true; break; }
        }
        // Nếu chọn ảnh mới
        if(document.getElementById('avatar-input').files.length > 0) changed = true;
        
        pSaveBtn.disabled = !changed;
    }
    pForm.addEventListener('input', checkFormChanges);
    pForm.addEventListener('change', checkFormChanges);

    // 3. KÉO THẢ ẢNH
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('avatar-input');
    const preview = document.getElementById('avatar-preview');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(e => dropZone.addEventListener(e, ev => ev.preventDefault(), false));
    dropZone.addEventListener('drop', (e) => {
        if (e.dataTransfer.files.length) { fileInput.files = e.dataTransfer.files; updatePreview(e.dataTransfer.files[0]); checkFormChanges(); }
    });
    fileInput.addEventListener('change', function() { if(this.files.length) { updatePreview(this.files[0]); checkFormChanges(); } });
    function updatePreview(file) { const reader = new FileReader(); reader.onload = (e) => preview.src = e.target.result; reader.readAsDataURL(file); }

    // 4. KIỂM TRA MẬT KHẨU
    function togglePass(id, btn) {
        const inp = document.getElementById(id); const icon = btn.querySelector('i');
        if(inp.type === 'password') { inp.type = 'text'; icon.className = 'fas fa-eye-slash'; } 
        else { inp.type = 'password'; icon.className = 'fas fa-eye'; }
    }

    const cPass = document.getElementById('curr_pass'), nPass = document.getElementById('new_pass'), cfPass = document.getElementById('conf_pass');
    const bSub = document.getElementById('btn_submit_pass'), mCurr = document.getElementById('curr_pass_msg'), mMatch = document.getElementById('match_msg');
    let isValidCurr = false;

    cPass.addEventListener('input', function() {
        if(this.value.length === 0) { this.className = 'form-control form-control-profile'; mCurr.innerHTML = ''; isValidCurr = false; checkPassBtn(); return; }
        
        let fd = new FormData(); fd.append('current_password', this.value);
        fetch('public_entry.php?url=profile-check-pass', { method: 'POST', body: fd })
        .then(res => res.json()).then(data => {
            if(data.valid) { 
                this.className = 'form-control form-control-profile is-valid-pass'; 
                mCurr.innerHTML = '<span class="text-success small fw-bold">Mật khẩu chính xác</span>'; 
                isValidCurr = true; 
            } else { 
                this.className = 'form-control form-control-profile is-invalid-pass'; 
                mCurr.innerHTML = '<span class="text-danger small fw-bold">Sai mật khẩu hiện tại</span>'; 
                isValidCurr = false;
            }
            checkPassBtn();
        });
    });

    function checkMatch() {
        if(cfPass.value.length === 0 && nPass.value.length === 0) { cfPass.className = 'form-control form-control-profile'; mMatch.innerHTML = ''; checkPassBtn(); return; }
        if(nPass.value === cfPass.value && nPass.value.length > 0) {
            cfPass.className = 'form-control form-control-profile is-valid-pass'; 
            mMatch.innerHTML = '<span class="text-success small fw-bold">Mật khẩu khớp</span>';
        } else {
            cfPass.className = 'form-control form-control-profile is-invalid-pass'; 
            mMatch.innerHTML = '<span class="text-danger small fw-bold">Mật khẩu không khớp</span>';
        }
        checkPassBtn();
    }
    nPass.addEventListener('input', checkMatch); cfPass.addEventListener('input', checkMatch);

    function checkPassBtn() { bSub.disabled = !(isValidCurr && nPass.value === cfPass.value && nPass.value.length > 0); }

    // 5. SỔ ĐỊA CHỈ
    function openAddressModal() {
        const raw = document.getElementById('main_address').value;
        const addrs = raw.split('\n').filter(a => a.trim() !== '');
        let html = '';
        if(addrs.length === 0) html = '<p class="text-muted">Chưa có địa chỉ nào.</p>';
        addrs.forEach((a, i) => {
            html += `<div class="form-check mb-2 bg-light p-3 rounded border"><input class="form-check-input ms-1" type="radio" name="addrRadio" id="adr${i}" value="${a}" ${i===0?'checked':''}><label class="form-check-label ms-2 fw-bold" for="adr${i}">${a}</label></div>`;
        });
        document.getElementById('addressList').innerHTML = html;
        new bootstrap.Modal(document.getElementById('addressModal')).show();
    }
    function addNewAddress() {
        const val = document.getElementById('newAddressInput').value.trim();
        if(val) {
            const list = document.getElementById('addressList');
            const i = document.querySelectorAll('input[name="addrRadio"]').length;
            list.innerHTML += `<div class="form-check mb-2 bg-light p-3 rounded border"><input class="form-check-input ms-1" type="radio" name="addrRadio" id="adr${i}" value="${val}" checked><label class="form-check-label ms-2 fw-bold" for="adr${i}">${val}</label></div>`;
            document.getElementById('newAddressInput').value = '';
        }
    }
    function saveAddressSelection() {
        const selected = document.querySelector('input[name="addrRadio"]:checked');
        if(selected) {
            const allAddrs = Array.from(document.querySelectorAll('input[name="addrRadio"]')).map(el => el.value);
            const reordered = [selected.value, ...allAddrs.filter(a => a !== selected.value)];
            document.getElementById('main_address').value = reordered.join('\n');
            checkFormChanges(); 
        }
    }
</script>