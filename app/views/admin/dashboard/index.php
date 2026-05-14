<?php require_once '../app/views/layouts/admin_header.php'; ?>

<div class="row">
    <div class="col-12 mt-5">
        <h4 class="header-title mb-4">Tổng quan hệ thống</h4>
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="seo-fact sbg1">
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div class="seofct-icon"><i class="ti-money"></i> Doanh thu</div>
                            <h2 class="text-white"><?= number_format($revenue, 0, ',', '.') ?>đ</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="seo-fact sbg2">
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div class="seofct-icon"><i class="ti-shopping-cart"></i> Đơn hàng</div>
                            <h2 class="text-white"><?= $totalOrders ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="seo-fact sbg3">
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div class="seofct-icon"><i class="ti-package"></i> Sản phẩm</div>
                            <h2 class="text-white"><?= $totalProducts ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="seo-fact sbg4">
                        <div class="p-4 d-flex justify-content-between align-items-center">
                            <div class="seofct-icon"><i class="ti-user"></i> Khách hàng</div>
                            <h2 class="text-white"><?= $totalUsers ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/views/layouts/admin_footer.php'; ?>