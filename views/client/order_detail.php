<style>
    .progress-container {
        display: flex;
        justify-content: space-between;
        position: relative;
        margin-bottom: 30px;
        width: 100%;
    }

    .progress-container::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        height: 4px;
        width: 100%;
        background-color: #e0e0e0;
        z-index: 1;
    }

    .progress-bar-custom {
        position: absolute;
        top: 50%;
        left: 0;
        transform: translateY(-50%);
        height: 4px;
        background-color: #e53637;
        z-index: 2;
        transition: 0.4s ease;
    }

    .progress-step {
        position: relative;
        z-index: 3;
        text-align: center;
    }

    .progress-circle {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: #fff;
        border: 3px solid #e0e0e0;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: 0.4s ease;
        margin: 0 auto 10px;
    }

    .progress-circle.active {
        border-color: #e53637;
        background-color: #e53637;
        color: white;
    }

    .progress-step p {
        font-size: 12px;
        color: #999;
        font-weight: 600;
    }

    .progress-step .active-text {
        color: #111;
    }

    .cancelled-step {
        border-color: #dc3545;
        background-color: #dc3545;
        color: white;
    }
</style>

<?php
$current_status = $order['status'];
$is_cancelled = ($current_status == 3);

$steps = [
    ['status' => -1, 'label' => 'Đã đặt'],
    ['status' => 0, 'label' => 'Chờ xử lý'],
    ['status' => 1, 'label' => 'Đang giao'],
    ['status' => 2, 'label' => 'Hoàn thành']
];

$current_step_index = -1;
if ($current_status == 0)
    $current_step_index = 1;
if ($current_status == 1)
    $current_step_index = 2;
if ($current_status == 2)
    $current_step_index = 3;

$progress_width = 0;
if ($current_step_index > 0) {
    $progress_width = ($current_step_index / (count($steps) - 1)) * 100;
}
if ($current_step_index == 1) {
    $progress_width = 33;
}

?>

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Chi Tiết Đơn Hàng #<?= $order['id'] ?></h4>
                    <div class="breadcrumb__links">
                        <a href="index.php">Trang chủ</a>
                        <a href="index.php?controller=cart&action=history">Lịch sử đơn hàng</a>
                        <span>Chi tiết</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="shopping-cart spad">
    <div class="container">
        <!-- Thanh tiến trình đơn hàng -->
        <div class="row justify-content-center mb-5">
            <div class="col-lg-10 col-md-12">
                <div class="progress-container">
                    <?php if (!$is_cancelled): ?>
                        <div class="progress-bar-custom" style="width: <?= $progress_width ?>%;"></div>
                        <?php foreach ($steps as $index => $step): ?>
                            <div class="progress-step">
                                <?php
                                $is_active = ($index <= $current_step_index);
                                ?>
                                <div class="progress-circle <?= $is_active ? 'active' : '' ?>">
                                    <i class="fa <?= $is_active ? 'fa-check' : '' ?>"></i>
                                </div>
                                <p class="<?= $is_active ? 'active-text' : '' ?>"><?= $step['label'] ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="progress-step">
                            <div class="progress-circle cancelled-step">
                                <i class="fa fa-times"></i>
                            </div>
                            <p class="active-text">Đã Hủy</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>


        <div class="row mb-5">
            <div class="col-lg-6">
                <div class="checkout__order" style="background: #f3f2ee; padding: 20px; height: 100%;">
                    <h5 style="font-weight: bold; margin-bottom: 20px;">Thông Tin Giao Hàng</h5>
                    <p><strong>Người nhận:</strong> <?= htmlspecialchars($order['fullname']) ?></p>
                    <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($order['phone']) ?></p>
                    <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($order['shipping_address']) ?></p>
                    <p><strong>Phường/Xã:</strong> <?= htmlspecialchars($order['shipping_ward']) ?></p>
                    <p><strong>Tỉnh/Thành:</strong> <?= htmlspecialchars($order['shipping_province']) ?></p>
                    <p><strong>Ngày đặt:</strong> <?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="checkout__order" style="background: #f3f2ee; padding: 20px; height: 100%;">
                    <?php
                    $status_map = [
                        0 => ['text' => 'Chờ xử lý', 'color' => 'badge-warning text-dark'],
                        1 => ['text' => 'Đang giao', 'color' => 'badge-info text-white'],
                        2 => ['text' => 'Hoàn thành', 'color' => 'badge-success text-white'],
                        3 => ['text' => 'Đã hủy', 'color' => 'badge-danger text-white']
                    ];
                    $stt_info = $status_map[$order['status']] ?? ['text' => 'Unknown', 'color' => 'badge-dark'];
                    ?>

                    <h5 style="font-weight: bold; margin-bottom: 20px;">Thông Tin Đơn Hàng</h5>
                    <p>
                        <strong>Trạng thái:</strong>
                        <span class="badge <?= $stt_info['color'] ?> p-2"
                            style="font-size: 14px;"><?= $stt_info['text'] ?></span>
                    </p>
                    <p><strong>Thanh toán:</strong> <?= htmlspecialchars($order['payment_method']) ?></p>
                    <p><strong>Tổng tiền:</strong> <span
                            style="color: #e53637; font-weight: bold; font-size: 18px;"><?= number_format($order['total_money'], 0, ',', '.') ?>đ</span>
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h5 style="font-weight: bold; margin-bottom: 20px;">Sản Phẩm Đã Mua</h5>
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Sản Phẩm</th>
                                <th>Đơn Giá</th>
                                <th>Số Lượng</th>
                                <th>Thành Tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($order_details as $item):
                                $subtotal = $item['price'] * $item['quantity'];
                                ?>
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="public/client/img/product/<?= htmlspecialchars($item['image']) ?>"
                                                alt="" width="70">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6><?= htmlspecialchars($item['name']) ?></h6>
                                        </div>
                                    </td>
                                    <td class="cart__price"><?= number_format($item['price'], 0, ',', '.') ?>đ</td>
                                    <td class="quantity__item">
                                        <div class="quantity"><span>x<?= $item['quantity'] ?></span></div>
                                    </td>
                                    <td class="cart__price" style="color: #e53637;">
                                        <?= number_format($subtotal, 0, ',', '.') ?>đ
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-12 text-center">
                        <a href="index.php?controller=cart&action=history" class="site-btn"
                            style="background: #333; border-color: #333;">QUAY LẠI LỊCH SỬ</a>

                        <?php if ($order['status'] == 0): ?>
                            <a href="index.php?controller=cart&action=cancelOrder&id=<?= $order['id'] ?>"
                                class="site-btn cancel-order-btn" style="background: #dc3545; border-color: #dc3545;">
                                HỦY ĐƠN HÀNG
                            </a>
                        <?php else: ?>
                            <a class="site-btn disabled"
                                style="background: #dc3545; border-color: #dc3545; pointer-events: none; opacity: 0.6;">
                                HỦY ĐƠN HÀNG
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>