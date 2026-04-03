<div class="container-xxl grow container-p-y">
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
                            <span class="avatar-initial rounded bg-label-secondary"><i
                                    class="bx bx-map bx-sm"></i></span>
                        </div>
                        <div class="d-flex flex-column">
                            <h6 class="mb-0">Nhà riêng / Nơi làm việc</h6>

                            <small class="text-muted mt-1 text-wrap" style="line-height: 1.6;">
                                <i class="bx bx-home-alt me-1"></i> <strong>Đường/Số nhà:</strong>
                                <?= htmlspecialchars($order['shipping_address']) ?><br>

                                <i class="bx bx-map-pin me-1"></i> <strong>Phường/Xã:</strong>
                                <?= !empty($order['shipping_ward']) ? htmlspecialchars($order['shipping_ward']) : '<span class="fst-italic text-warning">Chưa có Phường/Xã</span>' ?><br>

                                <?php if (!empty($order['shipping_province'])): ?>
                                    <i class="bx bx-buildings me-1"></i> <strong>Tỉnh/Thành phố:</strong>
                                    <strong><?= htmlspecialchars($order['shipping_province']) ?></strong>
                                <?php endif; ?>
                            </small>

                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header border-bottom">
                    <h5 class="card-title m-0">Sản phẩm trong đơn hàng</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Sản phẩm</th>
                                <th class="text-center">Số lượng</th>
                                <th class="text-end">Đơn giá</th>
                                <th class="text-end">Thành tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($orderItems) && count($orderItems) > 0): ?>
                                <?php foreach ($orderItems as $item): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php if (!empty($item['name'])): ?>
                                                    <?php if (!empty($item['image'])): ?>
                                                        <img src="public/admin/assets/images/<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['name']) ?>"
                                                            class="rounded me-3" width="50" height="50"
                                                            style="object-fit: cover; border: 1px solid #eee;">
                                                    <?php else: ?>
                                                     <div class="avatar me-3" style="width: 50px; height: 50px;">
                                                        <span class="avatar-initial rounded bg-label-secondary"><i class="bx bx-image"></i></span>
                                                    </div>
                                                <?php endif; ?>
                                                    <div>
                                                        <h6 class="mb-0 text-wrap" style="max-width: 250px;">
                                                            <?= htmlspecialchars($item['name']) ?>
                                                        </h6>
                                                        <small class="text-muted">Mã SP: #<?= $item['product_id'] ?></small>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="avatar me-3" style="width: 50px; height: 50px;">
                                                        <span class="avatar-initial rounded bg-label-danger"><i
                                                                class="bx bx-trash"></i></span>
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0 text-danger fst-italic">Sản phẩm đã bị xóa</h6>
                                                        <small class="text-muted">Mã SP cũ: #<?= $item['product_id'] ?></small>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle">
                                            <span class="badge bg-label-secondary"><?= $item['quantity'] ?></span>
                                        </td>
                                        <td class="text-end align-middle"><?= number_format($item['price'], 0, ',', '.') ?> đ
                                        </td>
                                        <td class="text-end fw-semibold align-middle text-primary">
                                            <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?> đ
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-muted">Không tìm thấy thông tin sản phẩm.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
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
                            case 0:
                                echo '<span class="badge bg-warning">Chờ xử lý</span>';
                                break;
                            case 1:
                                echo '<span class="badge bg-primary">Đang giao</span>';
                                break;
                            case 2:
                                echo '<span class="badge bg-success">Hoàn thành</span>';
                                break;
                            case 3:
                                echo '<span class="badge bg-secondary">Đã hủy</span>';
                                break;
                            default:
                                echo '<span class="badge bg-dark">Không rõ</span>';
                        }
                        ?>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="fw-semibold text-muted">Phương thức TT:</span>
                        <span class="fw-bold text-dark"><?= htmlspecialchars($order['payment_method']) ?></span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between align-items-center mt-3 pb-3">
                        <span class="fw-bold fs-5 text-dark">Tổng tiền:</span>
                        <span class="fw-bold fs-5 text-danger"><?= number_format($order['total_money'], 0, ',', '.') ?>
                            đ</span>
                    </div>

                    <div class="d-flex gap-2 mt-2 pt-2 border-top">
                        <?php if ($order['status'] == 0): ?>
                            <a href="index.php?controller=AdminOrder&action=updateStatus&id=<?= $order['id'] ?>&status=1"
                                class="btn btn-primary grow">Giao hàng</a>
                            <a href="index.php?controller=AdminOrder&action=updateStatus&id=<?= $order['id'] ?>&status=3"
                                class="btn btn-outline-danger confirm-cancel-btn"
                                data-message="Bạn có chắc chắn muốn hủy đơn hàng này?">Hủy</a>

                        <?php elseif ($order['status'] == 1): ?>
                            <a href="index.php?controller=AdminOrder&action=updateStatus&id=<?= $order['id'] ?>&status=2"
                                class="btn btn-success grow">Hoàn thành</a>
                            <a href="index.php?controller=AdminOrder&action=updateStatus&id=<?= $order['id'] ?>&status=3"
                                class="btn btn-outline-danger confirm-cancel-btn"
                                data-message="Bạn có chắc chắn muốn hủy đơn hàng đang giao này?">Hủy</a>

                        <?php elseif ($order['status'] == 2): ?>
                            <button class="btn btn-secondary grow" disabled>Đã hoàn tất</button>
                            <a href="index.php?controller=AdminOrder&action=updateStatus&id=<?= $order['id'] ?>&status=3"
                                class="btn btn-outline-danger confirm-cancel-btn"
                                data-message="Đơn hàng đã hoàn thành. Bạn có chắc chắn muốn chuyển sang trạng thái Hủy?">Hủy</a>

                        <?php elseif ($order['status'] == 3): ?>
                            <button class="btn btn-dark w-100" disabled>Đơn hàng đã bị hủy</button>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
     
    .swal2-container {
        z-index: 99999 !important;
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {

         
        <?php if (isset($_GET['msg'])): ?>
            <?php if ($_GET['msg'] === 'status_updated'): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Thành công!',
                    text: 'Đã cập nhật trạng thái đơn hàng.',
                    showConfirmButton: false,
                    timer: 1500
                });
            <?php elseif ($_GET['msg'] === 'update_error'): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Không thể cập nhật trạng thái vào cơ sở dữ liệu.',
                    confirmButtonColor: '#696cff'
                });
            <?php endif; ?>

             
            const urlParams = new URLSearchParams(window.location.search);
            urlParams.delete('msg');
            const newUrl = window.location.pathname + '?' + urlParams.toString();
            window.history.replaceState(null, '', newUrl);
        <?php endif; ?>


         
        const confirmButtons = document.querySelectorAll('.confirm-cancel-btn');

        confirmButtons.forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();  

                const targetUrl = this.getAttribute('href');
                const confirmMessage = this.getAttribute('data-message');

                Swal.fire({
                    title: 'Xác nhận hủy?',
                    text: confirmMessage,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#696cff',
                    confirmButtonText: 'Xác nhận',
                    cancelButtonText: 'Trở lại'
                }).then((result) => {
                    if (result.isConfirmed) {
                         
                        window.location.href = targetUrl;
                    }
                });
            });
        });

    });
</script>