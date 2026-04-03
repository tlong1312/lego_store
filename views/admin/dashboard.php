<div class="row">
    <!-- Card Chào mừng -->
    <div class="col-lg-8 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Xin chào, <?= htmlspecialchars($adminDisplayName ?? 'Admin') ?>! 🎉</h5>
                        <p class="mb-2">
                            Hệ thống quản lý <span class="fw-bold">LEGO Store</span> đang hoạt động rất sôi nổi.
                        </p>
                        <div class="small text-muted">
                            <div><i class='bx bx-user me-1'></i><?= htmlspecialchars($adminDisplayName ?? 'Admin') ?></div>
                            <?php if (!empty($adminEmail ?? '')): ?>
                                <div><i class='bx bx-envelope me-1'></i><?= htmlspecialchars($adminEmail) ?></div>
                            <?php endif; ?>
                            <div><i class='bx bx-shield-quarter me-1'></i>Quyền: <?= htmlspecialchars($adminRole ?? 'admin') ?></div>
                        </div>
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
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="card-title mb-0">
                        <h5 class="m-0 me-2 text-primary fw-bold">Doanh thu 7 ngày gần nhất</h5>
                    </div>
                </div>
                <div class="card-body mt-3">
                    <canvas id="revenueChart" style="height: 300px; width: 100%;"></canvas>
                </div>
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('revenueChart').getContext('2d');

        const labels = <?= json_encode($chartDates) ?>;
        const data = <?= json_encode($chartRevenues) ?>;

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh thu',
                    data: data,
                    borderColor: '#696cff', 
                    backgroundColor: 'rgba(105, 108, 255, 0.1)', 
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4, 
                    pointBackgroundColor: '#fff',
                    pointBorderColor: '#696cff',
                    pointBorderWidth: 2,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }, 
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return context.parsed.y.toLocaleString('vi-VN') + ' đ';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function (value) {
                                return value.toLocaleString('vi-VN') + ' đ';
                            }
                        }
                    }
                }
            }
        });
    });
</script>