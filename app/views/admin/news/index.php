<?php require_once '../app/views/layouts/admin_header.php'; ?>
<div class="row">
    <div class="col-12 mt-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="header-title m-0"><i class="ti-write text-primary me-2"></i> Quản lý Bài viết</h4>
                    <a href="public_entry.php?url=admin/news/create" class="btn btn-primary btn-flat fw-bold"><i class="ti-plus"></i> Thêm bài viết</a>
                </div>
                <form action="public_entry.php" method="GET" class="mb-4">
                    <input type="hidden" name="url" value="admin/news">
                    <div class="input-group" style="max-width: 400px;">
                        <input type="text" name="search" class="form-control" placeholder="Tìm theo tiêu đề..." value="<?= htmlspecialchars($keyword ?? '') ?>">
                        <div class="input-group-append"><button type="submit" class="btn btn-primary"><i class="ti-search"></i></button></div>
                    </div>
                </form>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table table-hover text-center align-middle">
                            <thead class="text-uppercase bg-primary">
                                <tr class="text-white">
                                    <th>Ảnh</th>
                                    <th class="text-left">Tiêu đề</th>
                                    <th>Danh mục</th>
                                    <th>Ngày đăng</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($news)): foreach($news as $item): ?>
                                <tr>
                                    <td><img src="<?= htmlspecialchars($item['image']) ?>" width="70" class="rounded shadow-sm"></td>
                                    <td class="text-left fw-bold">
                                        <div style="max-width: 250px; white-space: normal;"><?= htmlspecialchars($item['title']) ?></div>
                                    </td>
                                    <td><span class="badge badge-info px-3 py-2"><?= htmlspecialchars($item['category']) ?></span></td>
                                    <td><?= date('d/m/Y', strtotime($item['created_at'])) ?></td>
                                    <td>
                                        <a href="public_entry.php?url=admin/news/edit&id=<?= $item['id'] ?>" class="btn btn-sm btn-warning"><i class="ti-pencil"></i></a>
                                        <a href="public_entry.php?url=admin/news/delete&id=<?= $item['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa bài viết?')"><i class="ti-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
                                <tr><td colspan="5" class="py-4">Chưa có bài viết nào!</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require_once '../app/views/layouts/admin_footer.php'; ?>