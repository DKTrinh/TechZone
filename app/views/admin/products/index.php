<?php require_once '../app/views/layouts/admin_header.php'; ?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="header-title m-0">Danh sách Sản phẩm</h4>
                    <button class="btn btn-primary btn-flat" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <i class="ti-plus"></i> Thêm sản phẩm
                    </button>
                </div>
                
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center table-hover">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th scope="col">Hình ảnh</th>
                                    <th scope="col">Tên sản phẩm</th>
                                    <th scope="col">Danh mục</th>
                                    <th scope="col">Giá bán</th>
                                    <th scope="col">Kho / Bán</th>
                                    <th scope="col">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!empty($products)): foreach($products as $p): 
                                    $thumbnails = explode(',', $p['thumbnail']);
                                    $firstImage = trim($thumbnails[0]);
                                ?>
                                <tr>
                                    <td><img src="<?= htmlspecialchars($firstImage) ?>" width="50" style="border-radius: 5px;"></td>
                                    <td class="text-start fw-bold"><?= htmlspecialchars($p['name']) ?></td>
                                    <td><span class="badge badge-pill badge-info"><?= htmlspecialchars($p['category_name'] ?? 'Khác') ?></span></td>
                                    <td class="text-danger fw-bold"><?= number_format($p['price'], 0, ',', '.') ?>đ</td>
                                    <td><?= $p['stock_count'] ?> / <?= $p['sold_count'] ?></td>
                                    <td>
                                        <button class="btn btn-warning btn-sm btn-edit-product"
                                                data-id="<?= $p['id'] ?>" data-name="<?= htmlspecialchars($p['name']) ?>"
                                                data-price="<?= $p['price'] ?>" data-oldprice="<?= $p['old_price'] ?>"
                                                data-cat="<?= $p['category_id'] ?>" data-brand="<?= htmlspecialchars($p['brand']) ?>"
                                                data-stock="<?= $p['stock_count'] ?>" data-desc="<?= htmlspecialchars($p['description']) ?>">
                                            <i class="ti-pencil"></i>
                                        </button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteProduct(<?= $p['id'] ?>)">
                                            <i class="ti-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; else: ?>
                                <tr><td colspan="6">Không có dữ liệu!</td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <?php if(isset($totalPages) && $totalPages > 1): ?>
                <div class="pagination_area pull-right mt-5">
                    <ul>
                        <li><a href="public_entry.php?url=admin-products&page=<?= max(1, $page - 1) ?>"><i class="fa fa-chevron-left"></i></a></li>
                        <?php for($i = 1; $i <= $totalPages; $i++): ?>
                            <li class="<?= ($page == $i) ? 'active' : '' ?>"><a href="public_entry.php?url=admin-products&page=<?= $i ?>"><?= $i ?></a></li>
                        <?php endfor; ?>
                        <li><a href="public_entry.php?url=admin-products&page=<?= min($totalPages, $page + 1) ?>"><i class="fa fa-chevron-right"></i></a></li>
                    </ul>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addProductModal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Thêm Sản Phẩm Mới</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="public_entry.php?url=admin-product-store" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-row row">
                        <div class="col-md-8 mb-3">
                            <label>Tên sản phẩm <b class="text-danger">*</b></label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Danh mục</label>
                            <select name="category_id" class="form-control" style="height: 45px;">
                                <?php foreach($categories as $c): ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Thương hiệu <b class="text-danger">*</b></label>
                            <input type="text" name="brand" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Giá bán (VNĐ) <b class="text-danger">*</b></label>
                            <input type="number" name="price" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Giá cũ (VNĐ)</label>
                            <input type="number" name="old_price" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Số lượng kho <b class="text-danger">*</b></label>
                            <input type="number" name="stock_count" class="form-control" value="100" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tải ảnh lên (Thumbnail) <b class="text-danger">*</b></label>
                            <input type="file" name="thumbnail" class="form-control" accept="image/*" required>
                        </div>
                        <div class="col-12">
                            <label>Mô tả chi tiết</label>
                            <textarea name="description" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Lưu sản phẩm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editProductModal">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Sửa thông tin sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"><span>&times;</span></button>
            </div>
            <form action="public_entry.php?url=admin-product-update" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="id" id="e_id">
                    <div class="form-row row">
                        <div class="col-md-8 mb-3">
                            <label>Tên sản phẩm</label>
                            <input type="text" name="name" id="e_name" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Danh mục</label>
                            <select name="category_id" id="e_cat" class="form-control" style="height: 45px;">
                                <?php foreach($categories as $c): ?>
                                    <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Thương hiệu</label>
                            <input type="text" name="brand" id="e_brand" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Giá bán (VNĐ)</label>
                            <input type="number" name="price" id="e_price" class="form-control" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>Giá cũ</label>
                            <input type="number" name="old_price" id="e_old_price" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Số lượng kho</label>
                            <input type="number" name="stock_count" id="e_stock" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Đổi ảnh mới (Để trống nếu giữ ảnh cũ)</label>
                            <input type="file" name="thumbnail" class="form-control" accept="image/*">
                        </div>
                        <div class="col-12">
                            <label>Mô tả chi tiết</label>
                            <textarea name="description" id="e_desc" class="form-control" rows="4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning text-dark fw-bold">Cập nhật ngay</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.btn-edit-product').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('e_id').value = this.dataset.id;
            document.getElementById('e_name').value = this.dataset.name;
            document.getElementById('e_price').value = this.dataset.price;
            document.getElementById('e_old_price').value = this.dataset.oldprice;
            document.getElementById('e_cat').value = this.dataset.cat;
            document.getElementById('e_brand').value = this.dataset.brand;
            document.getElementById('e_stock').value = this.dataset.stock;
            document.getElementById('e_desc').value = this.dataset.desc;
            
            new bootstrap.Modal(document.getElementById('editProductModal')).show();
        });
    });

    function deleteProduct(id) {
        Swal.fire({
            title: 'Chắc chắn xóa?', text: "Hành động này không thể hoàn tác!", icon: 'warning',
            showCancelButton: true, confirmButtonText: 'Xóa', cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) { window.location.href = `public_entry.php?url=admin-product-delete&id=${id}`; }
        });
    }
</script>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>
