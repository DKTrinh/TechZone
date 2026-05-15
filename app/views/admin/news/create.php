<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="row">
    <div class="col-12 mt-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h4 class="header-title mb-4">THÊM BÀI VIẾT MỚI</h4>
                <form action="public_entry.php?url=admin/news/store" method="POST" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label class="col-form-label fw-bold">Tiêu đề bài viết</label>
                        <input type="text" name="title" class="form-control bg-light border-0" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6 form-group">
                            <label class="col-form-label fw-bold">Danh mục</label>
                            <input type="text" name="category" class="form-control bg-light border-0" placeholder="Ví dụ: Công nghệ">
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="col-form-label fw-bold">Thẻ Badge (Nổi bật)</label>
                            <input type="text" name="badge" class="form-control bg-light border-0" placeholder="Ví dụ: Nóng">
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <label class="col-form-label fw-bold">Ảnh bài viết</label>
                        <div class="d-flex gap-2">
                            <input type="file" name="image_file" class="form-control bg-light border-0" accept="image/*">
                            <input type="text" name="image" class="form-control bg-light border-0" placeholder="... Hoặc dán URL ảnh trực tiếp vào đây">
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label class="col-form-label fw-bold">Nội dung bài viết</label>
                        <textarea name="content" class="form-control bg-light border-0 p-3" rows="12" required></textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary px-5 py-2 fw-bold btn-flat"><i class="ti-save"></i> LƯU BÀI VIẾT</button>
                        <a href="public_entry.php?url=admin/news" class="btn btn-secondary px-4 py-2 btn-flat ml-2">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>