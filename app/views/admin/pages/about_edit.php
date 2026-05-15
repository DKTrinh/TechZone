<?php
require_once '../app/views/layouts/admin_header.php';
?>

<style>
    #drop-zone-admin {
        border: 2px dashed #ffc107;
        border-radius: 50%;
        width: 140px;
        height: 140px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        position: relative;
        margin: 0 auto;
        cursor: pointer;
        background: #f8f9fa;
        transition: 0.3s;
    }
    #drop-zone-admin img { width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: 1; }
    #drop-zone-admin .overlay {
        position: absolute;
        z-index: 2;
        background: rgba(0,0,0,0.5);
        color: white;
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: 0.3s;
    }
    #drop-zone-admin:hover .overlay { opacity: 1; }
    #drop-zone-admin.dragover { border-color: #28a745; background: #e9f7ef; }
    .track-change:focus { border-color: #ffc107 !important; box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25) !important; }
</style>

<div class="row">
    <div class="col-12 mt-5">
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                    <h4 class="header-title m-0"><i class="ti-info-alt text-warning me-2"></i> QUẢN LÝ NỘI DUNG GIỚI THIỆU</h4>
                </div>
               
                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        <?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <form id="aboutForm" action="public_entry.php?url=admin/about-update" method="POST" enctype="multipart/form-data">
                   
                    <?php if(!empty($contents)): ?>
                        <?php foreach($contents as $item): ?>
                        <div class="form-group mb-4">
                            <label class="col-form-label fw-bold text-uppercase text-muted small">
                                <i class="ti-bookmark text-warning me-1"></i> <?= $item['section_name'] ?>
                            </label>
                            <textarea name="content[<?= $item['page_key'] ?>]" class="form-control bg-light track-change" rows="4" style="border-radius: 10px;"><?= htmlspecialchars($item['content_value']) ?></textarea>
                        </div>
                        <?php endforeach; ?>

                        <div class="text-right mt-5">
                            <button type="submit" class="btn btn-warning px-5 py-3 fw-bold btn-flat text-dark shadow-sm" style="border-radius: 50px;">
                                <i class="ti-save"></i> LƯU THAY ĐỔI
                            </button>
                        </div>
                    <?php else: ?>
                        <p class="text-center py-5 text-muted">Không tìm thấy dữ liệu nội dung.</p>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    let isChanged = false; // Cờ kiểm tra xem nội dung đã bị thay đổi chưa
    const aboutForm = document.getElementById('aboutForm');


    // --- A. THEO DÕI THAY ĐỔI ---
    document.querySelectorAll('.track-change, #avatarInput').forEach(element => {
        element.addEventListener('input', () => isChanged = true);
        element.addEventListener('change', () => isChanged = true);
    });


    // --- B. POP-UP XÁC NHẬN KHI NHẤN NÚT LƯU ---
    aboutForm.addEventListener('submit', function(e) {
        e.preventDefault(); // Chặn gửi form ngay lập tức
       
        Swal.fire({
            title: 'Xác nhận lưu?',
            text: "Bạn có chắc chắn muốn cập nhật nội dung này không?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#ffc107',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Có, lưu ngay!',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                isChanged = false; // Đánh dấu đã lưu để không hiện cảnh báo khi thoát
                this.submit();
            }
        });
    });

    // --- C. POP-UP CẢNH BÁO KHI THOÁT RA MÀ CHƯA LƯU ---
    // Áp dụng cho các link trên Sidebar và Header (trừ link logout hoặc javascript)
    document.querySelectorAll('.sidebar-menu a, .user-profile a').forEach(link => {
        link.addEventListener('click', function(e) {
            if (isChanged && !this.href.includes('javascript:') && !this.classList.contains('user-dropdown-logout')) {
                e.preventDefault();
                const targetUrl = this.href;

                Swal.fire({
                    title: 'Thay đổi chưa được lưu!',
                    text: "Dữ liệu bạn vừa nhập sẽ bị mất nếu bạn thoát ra. Bạn vẫn muốn tiếp tục?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ffc107',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Thoát ra',
                    cancelButtonText: 'Ở lại sửa tiếp'
                }).then((result) => {
                    if (result.isConfirmed) {
                        isChanged = false;
                        window.location.href = targetUrl;
                    }
                });
            }
        });
    });


    // --- D. CẢNH BÁO TRÌNH DUYỆT (F5 HOẶC ĐÓNG TAB) ---
    window.addEventListener('beforeunload', (e) => {
        if (isChanged) {
            e.preventDefault();
            e.returnValue = ''; // Hiển thị thông báo xác nhận mặc định của trình duyệt
        }
    });

    // --- E. KÉO THẢ ẢNH  ---
    const dropZone = document.getElementById('drop-zone-admin');
    const avatarInput = document.getElementById('avatarInput');
    const previewImg = document.getElementById('previewAvatar');

    ['dragover', 'drop'].forEach(name => dropZone.addEventListener(name, e => { e.preventDefault(); e.stopPropagation(); }));
    dropZone.addEventListener('dragover', () => dropZone.classList.add('dragover'));
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));
   
    dropZone.addEventListener('drop', (e) => {
        dropZone.classList.remove('dragover');
        let files = e.dataTransfer.files;
        if (files.length) {
            avatarInput.files = files;
            isChanged = true; // Bật cờ thay đổi khi thả ảnh
            const reader = new FileReader();
            reader.onload = (ev) => previewImg.src = ev.target.result;
            reader.readAsDataURL(files[0]);
        }
    });
</script>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
