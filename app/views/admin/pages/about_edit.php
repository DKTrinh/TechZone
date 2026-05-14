<?php require_once '../app/views/layouts/admin_header.php'; ?>

<div class="row">
    <div class="col-12 mt-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-3 mb-4">
                    <h4 class="header-title m-0"><i class="ti-info-alt text-warning me-2"></i> QUẢN LÝ NỘI DUNG GIỚI THIỆU</h4>
                </div>
                
                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['success_message']; unset($_SESSION['success_message']); ?></div>
                <?php endif; ?>

                <form action="public_entry.php?url=admin/about-update" method="POST">
                    <?php if(!empty($contents)): ?>
                        <?php foreach($contents as $item): ?>
                        <div class="form-group mb-4">
                            <label class="col-form-label fw-bold text-uppercase text-muted">
                                <i class="ti-bookmark text-warning me-1"></i> <?= $item['section_name'] ?>
                            </label>
                            <textarea name="content[<?= $item['page_key'] ?>]" class="form-control bg-light" rows="4" style="border-radius: 8px;"><?= htmlspecialchars($item['content_value']) ?></textarea>
                        </div>
                        <?php endforeach; ?>
                        <div class="text-right mt-4">
                            <button type="submit" class="btn btn-warning px-5 fw-bold btn-flat text-dark"><i class="ti-save"></i> LƯU THAY ĐỔI</button>
                        </div>
                    <?php else: ?>
                        <p class="text-center py-5 text-muted">Không tìm thấy dữ liệu nội dung.</p>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>