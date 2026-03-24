<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Lịch Sử Mua Hàng</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php?controller=home&action=index">Trang chủ</a>
                        <span>Lịch Sử Mua Hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shopping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Mã Đơn</th>
                                <th>Ngày Đặt</th>
                                <th>Người Nhận</th>
                                <th>Tổng Tiền</th>
                                <th>Thanh Toán</th>
                                <th>Trạng Thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($orders)):
                                foreach ($orders as $order): ?>
                                    <tr>
                                        <td class="cart__price">#<?= $order['id'] ?></td>
                                        <td><?= $order['created_at'] ?? 'Vừa xong' ?></td>
                                        <td>
                                            <strong><?= htmlspecialchars($order['fullname']) ?></strong><br>
                                            <small><?= htmlspecialchars($order['phone']) ?></small>
                                        </td>
                                        <<td class="cart__price" style="color: #e53637;">
                                            <?= number_format($order['total_money'], 0, ',', '.') ?>đ</td>
                                            <td><?= htmlspecialchars($order['payment_method']) ?></td>
                                            <td><span class="badge badge-dark p-2">
                                                    <?php
                                                    if ($order['status'] == 0) {
                                                        echo 'Chờ xử lý';
                                                    } elseif ($order['status'] == 1) {
                                                        echo 'Đang giao';
                                                    } elseif ($order['status'] == 2) {
                                                        echo 'Hoàn thành';
                                                    } elseif ($order['status'] == 3) {
                                                        echo 'Đã hủy';
                                                    } else {
                                                        echo 'Không rõ';
                                                    }
                                                    ?>
                                            </td>
                                        </tr>
                                <?php endforeach; else: ?>
                                    <tr><td colspan="6" class="text-center py-4">Bạn chưa có đơn hàng nào!</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>