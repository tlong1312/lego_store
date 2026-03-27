<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center pb-0">
        <h5 class="mb-0">Danh Sách Đơn Hàng</h5>
    </div>

    <div class="card-body">

        <form action="index.php" method="GET" class="mb-4">
            <input type="hidden" name="controller" value="AdminOrder">
            <input type="hidden" name="action" value="index">

            <div class="row mt-2 g-2">
                <div class="col-md-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bx bx-search"></i></span>
                        <input type="text" class="form-control" name="keyword"
                            value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>"
                            placeholder="Tên, SĐT, Mã ĐH...">
                    </div>
                </div>

                <div class="col-md-2">
                    <input type="date" class="form-control" name="date"
                        value="<?= isset($_GET['date']) ? $_GET['date'] : '' ?>" title="Lọc theo ngày đặt hàng">
                </div>

                <div class="col-md-2">
                    <?php $currentStatus = isset($_GET['status']) ? $_GET['status'] : ''; ?>
                    <select class="form-select" name="status" onchange="this.form.submit()">
                        <option value="" <?= $currentStatus === '' ? 'selected' : '' ?>>Tất cả trạng thái</option>
                        <option value="0" <?= $currentStatus === '0' ? 'selected' : '' ?>>Chờ xử lý</option>
                        <option value="1" <?= $currentStatus === '1' ? 'selected' : '' ?>>Đang giao</option>
                        <option value="2" <?= $currentStatus === '2' ? 'selected' : '' ?>>Hoàn thành</option>
                        <option value="3" <?= $currentStatus === '3' ? 'selected' : '' ?>>Đã hủy</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <?php $currentWard = isset($_GET['ward']) ? $_GET['ward'] : ''; ?>
                    <select class="form-select border-info" name="ward" onchange="this.form.submit()">
                        <option value="">Tất cả khu vực</option>
                        <?php if(!empty($wardsList)): ?>
                            <?php foreach($wardsList as $w): ?>
                                <option value="<?= htmlspecialchars($w['shipping_ward']) ?>" <?= $currentWard === $w['shipping_ward'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($w['shipping_ward']) ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="col-md-2">
                    <?php $currentSort = isset($_GET['sort']) ? $_GET['sort'] : 'newest'; ?>
                    <select class="form-select border-primary" name="sort" onchange="this.form.submit()">
                        <option value="newest" <?= $currentSort === 'newest' ? 'selected' : '' ?>>Mới nhất</option>
                        <option value="ward" <?= $currentSort === 'ward' ? 'selected' : '' ?>>Sắp xếp Phường (A-Z)</option>
                    </select>
                </div>

                <div class="col-md-1 d-flex gap-2 justify-content-end">
                    <a href="index.php?controller=AdminOrder&action=index" class="btn btn-outline-secondary w-100"
                        title="Xóa bộ lọc">
                        <i class="bx bx-refresh"></i>
                    </a>
                </div>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th style="width: 100px;">Mã ĐH</th>
                        <th>Khách Hàng</th>
                        <th style="width: 130px;">Ngày Đặt</th>
                        <th style="width: 150px;" class="text-end">Tổng Tiền</th>
                        <th style="width: 130px;" class="text-center">Trạng Thái</th>
                        <th style="width: 80px;" class="text-center">Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($orders) && count($orders) > 0): ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td><strong>#DH<?= str_pad($order['id'], 3, '0', STR_PAD_LEFT) ?></strong></td>
                                <td>
                                    <strong><?= htmlspecialchars($order['fullname']) ?></strong><br>
                                    <small class="text-muted"><?= htmlspecialchars($order['phone']) ?></small><br>
                                    <small class="text-primary"><i class="bx bx-map"></i> 
                                        <?= !empty($order['shipping_ward']) ? htmlspecialchars($order['shipping_ward']) : 'Chưa cập nhật ĐC' ?>
                                    </small>
                                </td>
                                <td><?= date('d/m/Y', strtotime($order['created_at'])) ?></td>
                                <td class="text-end"><strong><?= number_format($order['total_money'], 0, ',', '.') ?> đ</strong>
                                </td>
                                <td class="text-center">
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
                                </td>
                                <td class="text-center">
                                    <a href="index.php?controller=AdminOrder&action=detail&id=<?= $order['id'] ?>"
                                        class="btn btn-sm btn-icon btn-outline-primary" title="Xem chi tiết">
                                        <i class="bx bx-show"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4">Chưa có đơn hàng nào trong hệ thống!</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                <span class="text-muted">Tổng cộng: <?= isset($orders) ? count($orders) : 0 ?> đơn hàng</span>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const searchInput = document.querySelector('input[name="keyword"]');
        const tableRows = document.querySelectorAll('tbody tr');

        searchInput.addEventListener('input', function () {
            const keyword = this.value.toLowerCase().trim();

            tableRows.forEach(row => {
                if (row.querySelector('td[colspan]')) return;

                const rowText = row.textContent.toLowerCase();

                if (rowText.includes(keyword)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    });
</script>