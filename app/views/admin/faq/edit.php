<?php
require_once '../app/views/layouts/admin_header.php';
?>


<div class="row">
    <div class="col-12 mt-5">
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
                <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">
                    <h4 class="header-title m-0"><i class="ti-check-box text-success me-2"></i> DUYỆT CÂU TRẢ LỜI</h4>
                    <a href="public_entry.php?url=admin/faq" class="btn btn-outline-secondary btn-sm btn-flat shadow-sm" style="border-radius: 5px;">
                        <i class="ti-arrow-left me-1"></i> Quay lại
                    </a>
                </div>
               
                <form id="faqEditForm" action="public_entry.php?url=admin/faq/update" method="POST">
                    <input type="hidden" name="f_id" value="<?= $faq['f_id'] ?>">
                   
                    <div class="form-group mb-3">
                        <label class="col-form-label fw-bold text-uppercase text-muted small">Chủ đề</label>
                        <input type="text" name="title" class="form-control bg-light track-change" value="<?= htmlspecialchars($faq['title']) ?>" required style="border-radius: 8px;">
                    </div>
                   
                    <div class="form-group mb-3">
                        <label class="col-form-label fw-bold text-uppercase text-muted small">Nội dung câu hỏi của khách</label>
                        <textarea name="question" class="form-control bg-light track-change" rows="3" style="border-radius: 8px;"><?= htmlspecialchars($faq['question']) ?></textarea>
                    </div>
                   
                    <div class="form-group mb-4">
                        <label class="col-form-label fw-bold text-uppercase text-success small">Câu trả lời chính thức từ TechZone</label>
                        <textarea name="answer" class="form-control track-change" style="border: 2px solid #28a745; border-radius: 8px;" rows="6" placeholder="Nhập câu trả lời tại đây..." required><?= htmlspecialchars($faq['answer'] ?? '') ?></textarea>
                    </div>
                   
                    <div class="form-group mb-4">
                        <label class="col-form-label fw-bold text-uppercase text-muted small">Trạng thái hiển thị</label>
                        <select name="status" class="form-control bg-light track-change" style="height: 45px; border-radius: 8px;">
                            <option value="pending" <?= $faq['status'] == 'pending' ? 'selected' : '' ?>>Đang chờ duyệt (Ẩn khỏi FAQ)</option>
                            <option value="answered" <?= $faq['status'] == 'answered' ? 'selected' : '' ?>>Đã trả lời (Hiển thị lên FAQ)</option>
                        </select>
                    </div>
                   
                    <div class="text-right mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-success px-5 py-3 fw-bold btn-flat shadow-sm text-uppercase" style="border-radius: 50px;">
                            <i class="ti-save me-2"></i> Lưu và công bố
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    let isChanged = false; // Cờ kiểm tra thay đổi
    const faqForm = document.getElementById('faqEditForm');


    // 1. Theo dõi mọi thay đổi trên các ô nhập liệu
    document.querySelectorAll('.track-change').forEach(element => {
        element.addEventListener('input', () => { isChanged = true; });
        element.addEventListener('change', () => { isChanged = true; });
    });


    // 2. XỬ LÝ KHI NHẤN NÚT LƯU (Popup xác nhận lưu)
    faqForm.addEventListener('submit', function(e) {
        e.preventDefault(); // Chặn gửi form ngay lập tức
       
        Swal.fire({
            title: 'Xác nhận cập nhật FAQ?',
            text: "Câu trả lời này sẽ được hiển thị công khai trên trang chủ.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Đồng ý, công bố!',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                isChanged = false; // Tắt cờ cảnh báo để cho phép submit
                this.submit();
            }
        });
    });


    // 3. XỬ LÝ KHI THOÁT TRANG (Popup cảnh báo dữ liệu chưa lưu)
    // Áp dụng cho các link trên Sidebar và Header của srtdash
    document.querySelectorAll('.sidebar-menu a, .user-profile a, .btn-outline-secondary').forEach(link => {
        link.addEventListener('click', function(e) {
            // Chỉ hiện popup nếu có thay đổi và không phải link javascript/logout
            if (isChanged && !this.href.includes('javascript:') && !this.classList.contains('user-dropdown-logout')) {
                e.preventDefault();
                const targetUrl = this.href;


                Swal.fire({
                    title: 'Dữ liệu chưa được lưu!',
                    text: "Những thay đổi của bạn sẽ bị mất nếu bạn thoát ra lúc này. Bạn có muốn lưu lại không?",
                    icon: 'warning',
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: 'Lưu và thoát',
                    denyButtonText: 'Thoát không lưu',
                    cancelButtonText: 'Ở lại sửa tiếp',
                    confirmButtonColor: '#28a745',
                    denyButtonColor: '#e74c3c'
                }).then((result) => {
                    if (result.isConfirmed) {
                        isChanged = false;
                        faqForm.submit(); // Submit form về Controller
                    } else if (result.isDenied) {
                        isChanged = false;
                        window.location.href = targetUrl; // Thoát ra link mục tiêu
                    }
                });
            }
        });
    });


    // 4. Cảnh báo trình duyệt (F5, đóng tab)
    window.addEventListener('beforeunload', (e) => {
        if (isChanged) {
            e.preventDefault();
            e.returnValue = ''; // Hiển thị dialog mặc định của trình duyệt
        }
    });
</script>


<?php
require_once '../app/views/layouts/admin_footer.php';
?>

