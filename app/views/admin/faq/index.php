<div class="container py-5">
    <h4 class="fw-bold text-success mb-4 text-uppercase">Hệ thống Quản lý FAQ TechZone</h4>
    <div class="card border-0 shadow-sm" style="border-radius: 20px; overflow: hidden;">
        <table class="table table-hover align-middle mb-0 text-center">
            <thead class="bg-dark text-white">
                <tr>
                    <th>Mã REQ</th>
                    <th>Chủ đề</th>
                    <th>Câu hỏi</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($faqs as $f): ?>
                <tr>
                    <td>#<?= $f['f_id'] ?></td>
                    <td><span class="badge bg-info text-dark"><?= htmlspecialchars($f['title']) ?></span></td>
                    <td class="text-start"><?= htmlspecialchars(substr($f['question'], 0, 60)) ?>...</td>
                    <td>
                        <span class="badge <?= $f['status'] == 'answered' ? 'bg-success' : 'bg-warning' ?>">
                            <?= $f['status'] == 'answered' ? 'Đã công bố' : 'Chờ duyệt' ?>
                        </span>
                    </td>
                    <td>
                        <a href="public_entry.php?url=admin/faq/edit&id=<?= $f['f_id'] ?>" class="btn btn-sm btn-warning">Sửa/Duyệt</a>
                        <a href="public_entry.php?url=admin/faq/delete&id=<?= $f['f_id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xác nhận xóa?')">Xóa</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>