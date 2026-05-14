<?php require_once '../app/views/layouts/admin_header.php'; ?>

<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="header-title m-0">Danh Sách Thành Viên</h4>
                    <button class="btn btn-primary btn-flat" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="ti-plus"></i> Thêm thành viên
                    </button>
                </div>
                
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover text-center">
                            <thead class="text-uppercase bg-primary">
                                <tr class="text-white">
                                    <th scope="col" class="text-start ps-4">User</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Vai trò</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($users)): foreach($users as $u): ?>
                                <tr>
                                    <td class="text-start ps-4">
                                        <div class="d-flex align-items-center">
                                            <img src="<?= !empty($u['avatar']) ? $u['avatar'] : 'https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg' ?>" class="rounded-circle me-3 border" width="45" height="45" style="object-fit:cover;">
                                            <div>
                                                <h6 class="mb-0 text-dark"><?= htmlspecialchars($u['fullname']) ?></h6>
                                                <small class="text-muted">ID: #<?= $u['id'] ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle"><?= htmlspecialchars($u['email']) ?></td>
                                    <td class="align-middle">
                                        <?php if($u['role'] === 'admin'): ?>
                                            <span class="badge bg-danger rounded-pill">Admin</span>
                                        <?php else: ?>
                                            <span class="badge bg-info text-dark rounded-pill">Khách hàng</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle">
                                        <?php if($u['status'] == 1): ?>
                                            <span class="badge bg-success rounded-pill">Hoạt động</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary rounded-pill">Bị khóa</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="align-middle">
                                        <ul class="d-flex justify-content-center mb-0 gap-3" style="list-style: none; padding: 0;">
                                            <li>
                                                <a href="javascript:void(0)" class="text-secondary btn-edit-user" title="Sửa thông tin"
                                                   data-id="<?= $u['id'] ?>" data-fullname="<?= htmlspecialchars($u['fullname']) ?>"
                                                   data-email="<?= htmlspecialchars($u['email']) ?>" data-role="<?= $u['role'] ?>"
                                                   data-phone="<?= htmlspecialchars($u['phone'] ?? '') ?>" data-gender="<?= htmlspecialchars($u['gender'] ?? '') ?>"
                                                   data-birthdate="<?= htmlspecialchars($u['birthdate'] ?? '') ?>" data-address="<?= htmlspecialchars($u['address'] ?? '') ?>"
                                                   data-avatar="<?= !empty($u['avatar']) ? $u['avatar'] : 'https://cellphones.com.vn/sforum/wp-content/uploads/2023/10/avatar-trang-4.jpg' ?>">
                                                    <i class="fa fa-edit" style="font-size: 18px;"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="<?= $u['status'] == 1 ? 'text-danger' : 'text-success' ?>" title="Khóa/Mở khóa" onclick="toggleLock(<?= $u['id'] ?>, <?= $u['status'] ?>)">
                                                    <i class="ti-<?= $u['status'] == 1 ? 'lock' : 'unlock' ?>" style="font-size: 18px;"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="text-dark" title="Reset Mật khẩu" onclick="resetPass(<?= $u['id'] ?>)">
                                                    <i class="ti-key" style="font-size: 18px;"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
                                <tr><td colspan="5" class="py-4">Không có dữ liệu!</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php if(isset($totalPages) && $totalPages > 1): ?>
                <div class="pagination_area pull-right mt-5">
                    <ul>
                        <li><a href="public_entry.php?url=users&page=<?= max(1, $page - 1) ?>"><i class="fa fa-chevron-left"></i></a></li>
                        <?php for($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="<?= ($page == $i) ? 'active' : '' ?>"><a href="public_entry.php?url=users&page=<?= $i ?>"><?= $i ?></a></li>
                        <?php endfor; ?>
                        <li><a href="public_entry.php?url=users&page=<?= min($totalPages, $page + 1) ?>"><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addUserModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">Thêm Thành Viên</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="public_entry.php?url=user-store" method="POST">
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="col-form-label">Họ Tên</label>
                        <input type="text" name="fullname" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label">Mật khẩu</label>
                        <input type="text" name="password" class="form-control" value="123456" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label">Vai trò</label>
                        <select name="role" class="form-control" style="height: 45px;">
                            <option value="client">Khách hàng</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Tạo Tài Khoản</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editUserModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white">Chỉnh sửa thành viên</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form action="public_entry.php?url=user-update" method="POST" enctype="multipart/form-data">
                <div class="modal-body p-4">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="row">
                        <div class="col-md-6 form-group mb-3">
                            <label class="col-form-label">Họ và Tên</label>
                            <input type="text" name="fullname" id="edit_fullname" class="form-control" required>
                        </div>
                        <div class="col-md-6 form-group mb-3">
                            <label class="col-form-label">Email</label>
                            <input type="email" name="email" id="edit_email" class="form-control" required>
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="col-form-label">Số điện thoại</label>
                            <input type="text" name="phone" id="edit_phone" class="form-control">
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="col-form-label">Giới tính</label>
                            <select name="gender" id="edit_gender" class="form-control" style="height: 45px;">
                                <option value="">Chưa chọn</option>
                                <option value="male">Nam</option>
                                <option value="female">Nữ</option>
                                <option value="other">Khác</option>
                            </select>
                        </div>
                        <div class="col-md-4 form-group mb-3">
                            <label class="col-form-label">Ngày sinh</label>
                            <input type="date" name="birthdate" id="edit_birthdate" class="form-control">
                        </div>
                        <div class="col-12 form-group mb-3">
                            <label class="col-form-label">Phân quyền</label>
                            <select name="role" id="edit_role" class="form-control" style="height: 45px;">
                                <option value="client">Client (Khách hàng)</option>
                                <option value="admin">Admin (Quản trị viên)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-info text-white">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // JS bật Modal sửa lên bằng Bootstrap 5 JS
    document.querySelectorAll('.btn-edit-user').forEach(button => {
        button.addEventListener('click', function() {
            document.getElementById('edit_id').value = this.dataset.id;
            document.getElementById('edit_fullname').value = this.dataset.fullname;
            document.getElementById('edit_email').value = this.dataset.email;
            document.getElementById('edit_role').value = this.dataset.role;
            document.getElementById('edit_phone').value = this.dataset.phone;
            document.getElementById('edit_gender').value = this.dataset.gender;
            document.getElementById('edit_birthdate').value = this.dataset.birthdate;
            
            // Gọi modal
            new bootstrap.Modal(document.getElementById('editUserModal')).show();
        });
    });

    // 3. XÁC NHẬN KHÓA/MỞ KHÓA TÀI KHOẢN
    function toggleLock(id, currentStatus) {
        let isLocking = (currentStatus == 1);
        Swal.fire({
            title: isLocking ? 'Khóa tài khoản này?' : 'Mở khóa tài khoản?',
            text: isLocking ? "Người dùng này sẽ không thể đăng nhập!" : "Khôi phục quyền truy cập cho người này.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: isLocking ? '#e74c3c' : '#2ecc71',
            cancelButtonColor: '#6c757d',
            confirmButtonText: isLocking ? 'Khóa ngay' : 'Mở khóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `public_entry.php?url=user-lock&id=${id}`;
            }
        });
    }

    // 4. XÁC NHẬN RESET MẬT KHẨU
    function resetPass(id) {
        Swal.fire({
            title: 'Cấp lại mật khẩu',
            text: "Bạn muốn tự đặt mật khẩu mới hay để hệ thống tạo ngẫu nhiên?",
            icon: 'question',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-keyboard"></i> Tự nhập',
            denyButtonText: '<i class="fas fa-dice"></i> Ngẫu nhiên',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({ 
                    title: 'Nhập mật khẩu mới', 
                    input: 'text',
                    showCancelButton: true,
                    confirmButtonText: 'Lưu',
                    inputValidator: (value) => {
                        if (!value || value.length < 6) return 'Mật khẩu phải từ 6 ký tự!';
                    }
                }).then((r) => {
                    if (r.isConfirmed && r.value) { submitAjaxReset(id, 'manual', r.value); }
                });
            } else if (result.isDenied) {
                submitAjaxReset(id, 'random', '');
            }
        });
    }

    function submitAjaxReset(id, type, password) {
        let fd = new FormData(); 
        fd.append('id', id); fd.append('type', type); fd.append('password', password);
        fetch('public_entry.php?url=user-reset', { method: 'POST', body: fd })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                if(data.type === 'random') {
                    Swal.fire({
                        title: 'Đã tạo thành công!',
                        html: `Mật khẩu mới là: <b style="color: #e74c3c; font-size: 20px;">${data.password}</b>`,
                        icon: 'success'
                    });
                } else {
                    Swal.fire({ title: 'Đổi mật khẩu thành công!', icon: 'success', showConfirmButton: false, timer: 2000 });
                }
            }
        });
    }
</script>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>