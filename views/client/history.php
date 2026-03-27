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
<style>
    /* Áp dụng cho màn hình có chiều rộng tối đa 768px (điện thoại, máy tính bảng nhỏ) */
    @media screen and (max-width: 768px) {
        .shopping__cart__table table {
            border: 0;
        }

        .shopping__cart__table thead {
            display: none;
        }

        .shopping__cart__table tr {
            display: block;
            margin-bottom: 1.5rem;
            border: 1px solid #ebebeb;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .shopping__cart__table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 15px !important;
            text-align: right;
            border-bottom: 1px solid #f0f0f0;
            font-size: 14px;
        }

        .shopping__cart__table td:last-child {
            border-bottom: 0;
        }
        .shopping__cart__table td::before {
            content: attr(data-label);
            float: left;
            font-weight: bold;
            text-align: left;
            margin-right: 15px;
            color: #111;
        }

        .shopping__cart__table td.actions-cell {
            justify-content: center;
        }

        .shopping__cart__table td.actions-cell::before {
            display: none;
        }
        .shopping__cart__table td .btn {
            margin-bottom: 0 !important;
        }

        .shopping__cart__table td .btn:not(:last-child) {
            margin-right: 5px;
        }
    }
</style>

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
                                <th>Trạng Thái</th>
                                <th>Thao Tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($orders)):
                                foreach ($orders as $order):
                                    $status_map = [
                                        0 => ['text' => 'Chờ xử lý', 'color' => 'badge-warning text-dark'],
                                        1 => ['text' => 'Đang giao', 'color' => 'badge-info text-white'],
                                        2 => ['text' => 'Hoàn thành', 'color' => 'badge-success text-white'],
                                        3 => ['text' => 'Đã hủy', 'color' => 'badge-danger text-white']
                                    ];
                                    $stt_info = $status_map[$order['status']] ?? ['text' => 'Không rõ', 'color' => 'badge-secondary'];
                                    ?>
                                    <tr>
                                        <td data-label="Mã Đơn" class="cart__price">#<?= $order['id'] ?></td>
                                        <td data-label="Ngày Đặt"><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                                        <td data-label="Người Nhận">
                                            <div> 
                                                <strong><?= htmlspecialchars($order['fullname']) ?></strong><br>
                                                <small><?= htmlspecialchars($order['phone']) ?></small>
                                            </div>
                                        </td>
                                        <td data-label="Tổng Tiền">
                                            <span class="cart__price" style="color: #e53637;">
                                                <?= number_format($order['total_money'], 0, ',', '.') ?>đ
                                            </span>
                                        </td>
                                        <td data-label="Trạng Thái">
                                            <span class="badge <?= $stt_info['color'] ?> p-2" style="font-size: 12px;">
                                                <?= $stt_info['text'] ?>
                                            </span>
                                        </td>
                                        <td data-label="Thao Tác" class="actions-cell">
                                            <a href="index.php?controller=cart&action=orderDetail&id=<?= $order['id'] ?>"
                                                class="btn btn-sm btn-outline-dark">
                                                <i class="fa fa-eye"></i> Xem
                                            </a>
                                            <?php if ($order['status'] == 0): ?>
                                                <a href="index.php?controller=cart&action=cancelOrder&id=<?= $order['id'] ?>"
                                                    class="btn btn-sm btn-outline-danger cancel-order-btn">
                                                    <i class="fa fa-times"></i> Hủy
                                                </a>
                                            <?php else: ?>
                                                <a class="btn btn-sm btn-outline-danger disabled"
                                                    style="pointer-events: none; opacity: 0.6;">
                                                    <i class="fa fa-times"></i> Hủy
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4">Bạn chưa có đơn hàng nào!</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>