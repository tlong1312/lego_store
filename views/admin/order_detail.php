<div class="container-xxl flex-grow-1 container-p-y">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4">
        <div class="d-flex flex-column justify-content-center">
            <h4 class="mb-1 mt-3">Chi tiết đơn hàng #DH<?= str_pad($order['id'], 3, '0', STR_PAD_LEFT) ?></h4>
            <p class="text-muted">Ngày đặt: <?= date('d/m/Y H:i:s', strtotime($order['created_at'])) ?></p>
        </div>
        <div class="d-flex align-content-center flex-wrap gap-2">
            <a href="index.php?controller=AdminOrder&action=index" class="btn btn-outline-secondary">Quay lại</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="card mb-4">
                <div class="card-header border-bottom">
                    <h5 class="card-title m-0">Thông tin khách hàng</h5>
                </div>
                <div class="card-body mt-3">
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-semibold text-muted">Họ và tên:</div>
                        <div class="col-sm-8 text-dark fw-bold"><?= htmlspecialchars($order['fullname']) ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-semibold text-muted">Số điện thoại:</div>
                        <div class="col-sm-8"><?= htmlspecialchars($order['phone']) ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-semibold text-muted">Tài khoản đặt hàng:</div>
                        <div class="col-sm-8">
                            <span class="badge bg-label-primary">User ID: <?= $order['user_id'] ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header border-bottom">
                    <h5 class="card-title m-0">Địa chỉ giao hàng</h5>
                </div>
                <div class="card-body mt-3">
                    <div class="d-flex justify-content-start align-items-center mb-4">
                        <div class="avatar me-2">
                            <span class="avatar-initial rounded bg-label-secondary"><i class="bx bx-map bx-sm"></i></span>
                        </div>
                        <div class="d-flex flex-column">
                            <h6 class="mb-0">Nhà riêng / Nơi làm việc</h6>
                            <small class="text-muted"><?= htmlspecialchars($order['shipping_address']) ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-4">
            <div class="card mb-4">
                <div class="card-header border-bottom">
                    <h5 class="card-title m-0">Tổng quan đơn hàng</h5>
                </div>
                <div class="card-body mt-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-semibold text-muted">Trạng thái:</span>
                        <?php 
                            switch ($order['status']) {
                                case 0: echo '<span class="badge bg-warning">Chờ xử lý</span>'; break;
                                case 1: echo '<span class="badge bg-primary">Đang giao</span>'; break;
                                case 2: echo '<span class="badge bg-success">Hoàn thành</span>'; break;
                                case 3: echo '<span class="badge bg-secondary">Đã hủy</span>'; break;
                                default: echo '<span class="badge bg-dark">Không rõ</span>';
                            }
                        ?>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-semibold text-muted">Phương thức TT:</span>
                        <span class="fw-bold text-dark"><?= htmlspecialchars($order['payment_method']) ?></span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mt-3 pb-1">
                        <span class="fw-bold fs-5 text-dark">Tổng tiền:</span>
                        <span class="fw-bold fs-5 text-danger"><?= number_format($order['total_money'], 0, ',', '.') ?> đ</span>
                    </div>
                </div>
            </div>
            
            </div>
    </div>
</div>