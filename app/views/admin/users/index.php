<style>
    .main-header { z-index: 1050 !important; }
    .sidebar-link { transition: all 0.3s ease; border-radius: 8px; font-weight: 500;}
    .sidebar-link:hover { background-color: rgba(255,255,255,0.15); transform: translateX(8px); color: #1abc9c !important; }
    .sidebar-link.active { background-color: #1e6f5c !important; color: white !important; font-weight: 700; box-shadow: 0 4px 10px rgba(0,0,0,0.2);}
    
    #drop-zone-admin { border: 2px dashed #17a2b8; border-radius: 50%; width: 120px; height: 120px; display: flex; align-items: center; justify-content: center; overflow: hidden; position: relative; margin: 0 auto; cursor: pointer; background: #f0f2f5; }
    #drop-zone-admin img { width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: 1; }
    #drop-zone-admin .overlay { position: absolute; z-index: 2; background: rgba(0,0,0,0.5); color: white; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center; opacity: 0; transition: 0.3s; }
    #drop-zone-admin:hover .overlay { opacity: 1; }
</style>

<div class="d-flex" style="min-height: 90vh; background-color: #f4f6fa;">
    
    <div class="bg-dark text-white p-3 shadow-lg" style="width: 270px;">
        <h5 class="fw-bold mb-4 mt-2 text-center text-info" style="letter-spacing: 1px;"><i class="fas fa-microchip me-2"></i> TECHZONE</h5>
        <div class="nav flex-column gap-2 mt-4">
            <a href="#" class="nav-link text-white sidebar-link"><i class="fas fa-chart-pie me-2"></i> Tổng quan</a>
            <a href="public_entry.php?url=users" class="nav-link sidebar-link active"><i class="fas fa-users me-2"></i> Quản lý Thành viên</a>
            <a href="#" class="nav-link text-white sidebar-link"><i class="fas fa-box-open me-2"></i> Quản lý Sản phẩm</a>
            <a href="#" class="nav-link text-white sidebar-link"><i class="fas fa-newspaper me-2"></i> Quản lý Tin tức</a>
            <a href="#" class="nav-link text-white sidebar-link"><i class="fas fa-comments me-2"></i> Quản lý Bình luận</a>
        </div>
    </div>

    <div class="flex-grow-1 p-4">
        <div class="d-flex justify-content-between align-items-center mb-4 bg-white p-3 rounded-4 shadow-sm border-start border-5 border-info">
            <h3 class="fw-bold text-dark m-0"><i class="fas fa-users-cog me-2 text-info"></i> Quản lý Thành viên</h3>
            <button class="btn btn-primary fw-bold px-4" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="fas fa-user-plus me-2"></i> Thêm thành viên
            </button>
        </div>
        
        <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
            <div class="card-body p-0 table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead style="background-color: #0b2b44; color: white;">
                        <tr>
                            <th class="ps-4 py-3">User</th>
                            <th>Email</th>
                            <th>SĐT</th>
                            <th>Vai trò</th>
                            <th>Trạng thái</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        <?php if(!empty($users)): ?>
                            <?php foreach($users as $u): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <img src="<?= !empty($u['avatar']) ? $u['avatar'] : 'https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg' ?>" class="rounded-circle me-3" width="40" height="40" style="object-fit:cover;">
                                        <div><div class="fw-bold text-dark"><?= htmlspecialchars($u['fullname']) ?></div><div class="small text-muted">ID: #<?= $u['id'] ?></div></div>
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($u['email']) ?></td>
                                <td><?= htmlspecialchars($u['phone'] ?? '---') ?></td>
                                <td><?= $u['role'] === 'admin' ? '<span class="badge bg-danger rounded-pill px-3 py-2">Admin</span>' : '<span class="badge bg-info text-dark rounded-pill px-3 py-2">Khách hàng</span>' ?></td>
                                <td><?= $u['status'] == 1 ? '<span class="badge bg-success rounded-pill px-3 py-2">Hoạt động</span>' : '<span class="badge bg-secondary rounded-pill px-3 py-2">Bị cấm</span>' ?></td>
                                <td class="text-center py-3">
                                    
                                    <button class="btn btn-sm btn-info fw-bold text-dark shadow-sm btn-edit-user" title="Xem/Sửa thông tin"
                                            data-id="<?= $u['id'] ?>"
                                            data-fullname="<?= htmlspecialchars($u['fullname']) ?>"
                                            data-email="<?= htmlspecialchars($u['email']) ?>"
                                            data-role="<?= $u['role'] ?>"
                                            data-phone="<?= htmlspecialchars($u['phone'] ?? '') ?>"
                                            data-gender="<?= htmlspecialchars($u['gender'] ?? '') ?>"
                                            data-birthdate="<?= htmlspecialchars($u['birthdate'] ?? '') ?>"
                                            data-address="<?= htmlspecialchars($u['address'] ?? '') ?>"
                                            data-avatar="<?= !empty($u['avatar']) ? $u['avatar'] : 'https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg' ?>">
                                        <i class="fas fa-eye"></i> Xem / Sửa
                                    </button>

                                    <button class="btn btn-sm fw-bold text-white shadow-sm <?= $u['status'] == 1 ? 'btn-danger' : 'btn-success' ?>" onclick="toggleLock(<?= $u['id'] ?>, <?= $u['status'] ?>)">
                                        <i class="fas <?= $u['status'] == 1 ? 'fa-ban' : 'fa-unlock' ?>"></i>
                                    </button>
                                    <button class="btn btn-sm btn-dark fw-bold text-white shadow-sm" onclick="resetPass(<?= $u['id'] ?>)">
                                        <i class="fas fa-key"></i>
                                    </button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            
            <?php if(isset($totalPages) && $totalPages > 1): ?>
            <div class="card-footer bg-white p-3 d-flex justify-content-end border-top">
                <nav>
                    <ul class="pagination mb-0">
                        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>"><a class="page-link" href="?url=users&page=<?= $page - 1 ?>">Trước</a></li>
                        <?php for($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="page-item <?= ($page == $i) ? 'active' : '' ?>"><a class="page-link" href="?url=users&page=<?= $i ?>"><?= $i ?></a></li>
                        <?php endfor; ?>
                        <li class="page-item <?= ($page >= $totalPages) ? 'disabled' : '' ?>"><a class="page-link" href="?url=users&page=<?= $page + 1 ?>">Sau</a></li>
                    </ul>
                </nav>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="modal fade" id="editUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow" style="border-radius: 15px;">
            <div class="modal-header bg-info text-dark border-0">
                <h5 class="modal-title fw-bold"><i class="fas fa-user-edit me-2"></i> Chỉnh sửa thành viên</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="public_entry.php?url=user-update" method="POST" enctype="multipart/form-data">
                <div class="modal-body p-4">
                    <input type="hidden" name="id" id="edit_id">
                    
                    <div class="text-center mb-4">
                        <label id="drop-zone-admin" class="shadow-sm">
                            <img src="" id="edit_avatar_preview">
                            <div class="overlay"><i class="fas fa-camera fs-3"></i></div>
                            <input type="file" name="avatar" id="edit_avatar_input" class="d-none" accept="image/*">
                        </label>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6"><label class="fw-bold small text-muted">Họ và Tên</label><input type="text" name="fullname" id="edit_fullname" class="form-control bg-light" required></div>
                        <div class="col-md-6"><label class="fw-bold small text-muted">Email</label><input type="email" name="email" id="edit_email" class="form-control bg-light" required></div>
                        <div class="col-md-4"><label class="fw-bold small text-muted">Số điện thoại</label><input type="text" name="phone" id="edit_phone" class="form-control bg-light"></div>
                        <div class="col-md-4"><label class="fw-bold small text-muted">Giới tính</label>
                            <select name="gender" id="edit_gender" class="form-select bg-light">
                                <option value="">Chưa chọn</option>
                                <option value="male">Nam</option>
                                <option value="female">Nữ</option>
                                <option value="other">Khác</option>
                            </select>
                        </div>
                        <div class="col-md-4"><label class="fw-bold small text-muted">Ngày sinh</label><input type="date" name="birthdate" id="edit_birthdate" class="form-control bg-light"></div>
                        <div class="col-12">
                            <div class="d-flex justify-content-between"><label class="fw-bold small text-muted">Địa chỉ</label><a href="javascript:void(0)" class="small fw-bold text-success text-decoration-none" onclick="openAdminAddressModal()">Sổ địa chỉ <i class="fas fa-book"></i></a></div>
                            <textarea name="address" id="edit_address" class="form-control bg-light" rows="2" placeholder="Các địa chỉ cách nhau bằng Enter"></textarea>
                        </div>
                        <div class="col-12"><label class="fw-bold small text-muted">Phân quyền</label>
                            <select name="role" id="edit_role" class="form-select border-primary bg-light">
                                <option value="client">Client (Khách hàng)</option>
                                <option value="admin">Admin (Quản trị viên)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="submit" class="btn w-100 fw-bold text-white btn-info text-dark shadow-sm">Lưu tất cả thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow" style="border-radius: 15px;">
            <div class="modal-header bg-primary text-white border-0"><h5 class="modal-title fw-bold">Thêm Thành Viên</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <form action="public_entry.php?url=user-store" method="POST">
                <div class="modal-body p-4 row g-3">
                    <div class="col-12"><label class="fw-bold small text-muted">Họ Tên</label><input type="text" name="fullname" class="form-control" required></div>
                    <div class="col-12"><label class="fw-bold small text-muted">Email</label><input type="email" name="email" class="form-control" required></div>
                    <div class="col-12"><label class="fw-bold small text-muted">Mật khẩu</label><input type="text" name="password" class="form-control" value="123456" required></div>
                    <div class="col-12"><label class="fw-bold small text-muted">Vai trò</label><select name="role" class="form-select"><option value="client">Khách hàng</option><option value="admin">Admin</option></select></div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0"><button type="submit" class="btn w-100 fw-bold btn-primary shadow-sm">Tạo Tài Khoản</button></div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="adminAddressModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 20px;">
            <div class="modal-header bg-success text-white border-0"><h5 class="modal-title fw-bold">Sổ địa chỉ của User</h5><button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button></div>
            <div class="modal-body p-4"><div id="adminAddressList"></div><div class="input-group mt-3"><input type="text" id="adminNewAddressInput" class="form-control" placeholder="Thêm địa chỉ..."><button class="btn btn-success" onclick="addAdminAddress()">Thêm</button></div></div>
            <div class="modal-footer border-0"><button type="button" class="btn btn-primary w-100" onclick="saveAdminAddressSelection()" data-bs-dismiss="modal">Xác nhận</button></div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // POPUP THÔNG BÁO
    <?php if (isset($_SESSION['auth_status'])): ?>
        Swal.fire({ toast: true, position: 'top-end', showConfirmButton: false, timer: 2000, icon: '<?= $_SESSION['auth_status'] ?>', title: '<?= $_SESSION['auth_message'] ?>' });
        <?php unset($_SESSION['auth_status'], $_SESSION['auth_message']); ?>
    <?php endif; ?>

    // BẮT SỰ KIỆN NÚT "XEM / SỬA" BẰNG JAVASCRIPT
    document.querySelectorAll('.btn-edit-user').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('edit_id').value = this.dataset.id;
            document.getElementById('edit_fullname').value = this.dataset.fullname;
            document.getElementById('edit_email').value = this.dataset.email;
            document.getElementById('edit_role').value = this.dataset.role;
            document.getElementById('edit_phone').value = this.dataset.phone;
            document.getElementById('edit_gender').value = this.dataset.gender;
            document.getElementById('edit_birthdate').value = this.dataset.birthdate;
            document.getElementById('edit_address').value = this.dataset.address;
            document.getElementById('edit_avatar_preview').src = this.dataset.avatar;
            
            // Bật Pop-up lên
            new bootstrap.Modal(document.getElementById('editUserModal')).show();
        });
    });

    // Kéo thả Ảnh Admin
    const aInput = document.getElementById('edit_avatar_input');
    aInput.addEventListener('change', function() {
        if(this.files.length) {
            const reader = new FileReader();
            reader.onload = (e) => document.getElementById('edit_avatar_preview').src = e.target.result;
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Sổ Địa chỉ Admin Modal
    function openAdminAddressModal() {
        const addrs = document.getElementById('edit_address').value.split('\n').filter(a => a.trim());
        let html = addrs.map((a, i) => `<div class="form-check mb-2 p-2 border rounded"><input class="form-check-input ms-1" type="radio" name="adminAddrRadio" id="a_adr${i}" value="${a}" ${i===0?'checked':''}><label class="form-check-label ms-2 fw-bold" for="a_adr${i}">${a}</label></div>`).join('') || '<p class="text-muted">Trống</p>';
        document.getElementById('adminAddressList').innerHTML = html;
        new bootstrap.Modal(document.getElementById('adminAddressModal')).show();
    }
    function addAdminAddress() {
        const val = document.getElementById('adminNewAddressInput').value.trim();
        if(val) { document.getElementById('adminAddressList').innerHTML += `<div class="form-check mb-2 p-2 border rounded"><input class="form-check-input ms-1" type="radio" name="adminAddrRadio" value="${val}" checked><label class="form-check-label ms-2 fw-bold">${val}</label></div>`; document.getElementById('adminNewAddressInput').value = ''; }
    }
    function saveAdminAddressSelection() {
        const selected = document.querySelector('input[name="adminAddrRadio"]:checked');
        if(selected) {
            const all = Array.from(document.querySelectorAll('input[name="adminAddrRadio"]')).map(el => el.value);
            const reordered = [selected.value, ...all.filter(a => a !== selected.value)];
            document.getElementById('edit_address').value = reordered.join('\n');
        }
    }

    function toggleLock(id, currentStatus) {
        Swal.fire({
            title: currentStatus == 1 ? 'Cấm người này?' : 'Mở khóa?', icon: 'warning', showCancelButton: true,
            confirmButtonColor: currentStatus == 1 ? '#e74c3c' : '#2ecc71', confirmButtonText: 'Xác nhận'
        }).then((res) => { if(res.isConfirmed) window.location.href = `public_entry.php?url=user-lock&id=${id}`; });
    }

    function resetPass(id) {
        Swal.fire({
            title: 'Cấp mật khẩu mới', showDenyButton: true, showCancelButton: true,
            confirmButtonText: 'Tự nhập', denyButtonText: 'Ngẫu nhiên'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({ title: 'Nhập mật khẩu', input: 'text', showCancelButton: true }).then((r) => {
                    if (r.isConfirmed && r.value) submitAjaxReset(id, 'manual', r.value);
                });
            } else if (result.isDenied) submitAjaxReset(id, 'random', '');
        });
    }

    function submitAjaxReset(id, type, password) {
        let fd = new FormData(); fd.append('id', id); fd.append('type', type); fd.append('password', password);
        fetch('public_entry.php?url=user-reset', { method: 'POST', body: fd })
        .then(res => res.json()).then(data => {
            if (data.status === 'success') {
                if(data.type === 'random') Swal.fire('Thành công', 'Pass mới: <b>' + data.password + '</b>', 'success');
                else Swal.fire({ title: 'Thành công', icon: 'success', timer: 2000 });
            }
        });
    }
</script>