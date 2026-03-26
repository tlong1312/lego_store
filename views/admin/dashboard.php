<div class="row">
    <!-- Card Chào mừng -->
    <div class="col-lg-8 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Xin chào Admin! 🎉</h5>
                        <p class="mb-4">
                            Hệ thống quản lý <span class="fw-bold">LEGO Store</span> đang hoạt động rất sôi nổi.
                        </p>
                    </div>
                </div>
                <div class="col-sm-5 text-center text-sm-left">
                    <div class="card-body pb-0 px-0 px-md-4">
                        <img src="public/admin/assets/img/illustrations/man-with-laptop-light.png" height="140"
                            alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                            data-app-light-img="illustrations/man-with-laptop-light.png" />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Thống kê nhanh -->
    <div class="col-lg-4 col-md-4 order-1">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-6 mb-4">
                <a href="index.php?controller=AdminOrder&action=index" class="text-decoration-none"
                    style="color: inherit; display: block;">
                    <div class="card h-100 shadow-sm border-0 transition-hover">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar shrink-0">
                                    <i class="menu-icon tf-icons bx bx-cart-alt bx-sm"></i>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Đơn hàng</span>

                            <h3 class="card-title mb-2"><?= isset($totalOrders) ? $totalOrders : 0 ?></h3>

                            <small class="text-muted"></i> Tổng số đơn hàng</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-6 col-md-12 col-6 mb-4">
    <div class="card h-100 shadow-sm border-0 transition-hover">
        <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between">
                <div class="avatar shrink-0">
                    <i class="menu-icon tf-icons bx bx-wallet bx-sm"></i>
                </div>
            </div>
            <span class="d-block mb-1">Doanh thu</span>
            
            <h3 class="card-title text-nowrap mb-1">
                <?= isset($totalRevenue) ? number_format($totalRevenue, 0, ',', '.') : '0' ?> đ
            </h3>
            
            <small class="text-muted">Đã hoàn thành</small>
        </div>
    </div>
</div>
        </div>
    </div>
</div>

<!-- Row thống kê chi tiết -->
<div class="row">
    <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h5 class="card-title m-0 me-2">Thống kê báo cáo</h5>
            </div>
            <div class="card-body">
                <ul class="p-0 m-0">
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-package"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">Đơn hàng #DH001</h6>
                                <small class="text-muted">Nguyễn Văn A</small>
                            </div>
                            <div class="user-progress">
                                <small class="fw-semibold">13.000.000 đ</small>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-success"><i class="bx bx-package"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">Đơn hàng #DH002</h6>
                                <small class="text-muted">Trần Thị B</small>
                            </div>
                            <div class="user-progress">
                                <small class="fw-semibold">8.500.000 đ</small>
                            </div>
                        </div>
                    </li>
                    <li class="d-flex mb-4 pb-1">
                        <div class="avatar shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-info"><i class="bx bx-package"></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">Đơn hàng #DH003</h6>
                                <small class="text-muted">Lê Văn C</small>
                            </div>
                            <div class="user-progress">
                                <small class="fw-semibold">25.000.000 đ</small>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
        <div class="row">
            <div class="col-6 mb-4">
                <a href="index.php?controller=AdminProduct&action=index" class="text-decoration-none"
                    style="color: inherit; display: block;">
                    <div class="card h-100 shadow-sm border-0 transition-hover">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar shrink-0">
                                    <i class="menu-icon tf-icons bx bx-cube-alt bx-sm"></i>
                                </div>
                            </div>
                            <span class="d-block mb-1">Sản phẩm</span>

                            <h3 class="card-title text-nowrap mb-1"><?= isset($totalProducts) ? $totalProducts : 0 ?>
                            </h3>

                            <small class="text-muted">Tổng số</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 mb-4">
                <a href="index.php?controller=AdminUser&action=index" class="text-decoration-none"
                    style="color: inherit; display: block;">
                    <div class="card h-100 shadow-sm border-0 transition-hover">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar shrink-0">
                                    <i class="menu-icon tf-icons bx bx-user bx-sm"></i>
                                </div>
                            </div>
                            <span class="d-block mb-1">Khách hàng</span>

                            <h3 class="card-title text-nowrap mb-1">
                                <?= isset($totalCustomers) ? $totalCustomers : 0 ?>
                            </h3>

                            <small class="text-muted">Đã đăng ký</small>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>