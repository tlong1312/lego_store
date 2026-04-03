<div class="card">
    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Tra Cứu Lợi Nhuận Theo Lô Hàng</h5>
    </div>
    <div class="card-body mt-4">
        
        <form action="index.php" method="GET" class="row g-3 mb-4">
            <input type="hidden" name="controller" value="AdminReport">
            <input type="hidden" name="action" value="profit">

            <div class="col-md-5">
                <select class="form-select" name="product_id" onchange="this.form.submit()">
                    <option value="">-- Tất cả sản phẩm (Xem toàn bộ lô hàng) --</option>
                    <?php if (!empty($allProducts)): ?>
                        <?php foreach ($allProducts as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= (isset($_GET['product_id']) && $_GET['product_id'] == $p['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($p['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>
            <div class="col-md-2">
                <a href="index.php?controller=AdminReport&action=profit" class="btn btn-outline-secondary w-100">
                    Xóa bộ lọc
                </a>
            </div>
        </form>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-light text-center align-middle">
                    <tr>
                        <th>Mã Lô (PN)</th>
                        <th>Ngày Nhập</th>
                        <th class="text-start">Sản Phẩm</th>
                        <th>SL Nhập</th>
                                                
                        <th class="text-end text-danger">Giá Vốn</th>
                        <th class="text-end text-primary">Giá Bán</th>
                        <th class="text-end text-success">Lợi Nhuận / SP</th>
                        <th>Tỷ Suất (%)</th>
                    </tr>
                </thead>
                <tbody class="text-center align-middle">
                    <?php if (!empty($batches)): ?>
                        <?php foreach ($batches as $b): 
                             
                            $costPrice = (float)$b['cost_price'];
                            $sellingPrice = (float)$b['selling_price'];
                            $profit = $sellingPrice - $costPrice;
                            
                             
                            $profitPercent = 0;
                            if ($costPrice > 0) {
                                $profitPercent = round(($profit / $costPrice) * 100, 1);
                            }
                        ?>
                            <tr>
                                <td><strong>#PN<?= str_pad($b['receipt_id'], 3, '0', STR_PAD_LEFT) ?></strong></td>
                                <td><?= date('d/m/Y', strtotime($b['import_date'])) ?></td>
                                <td class="text-start text-wrap" style="max-width: 250px;"><strong><?= htmlspecialchars($b['product_name']) ?></strong></td>
                                <td><span class="badge bg-secondary"><?= $b['quantity'] ?></span></td>
                                
                                <td class="text-end text-danger fw-bold"><?= number_format($costPrice, 0, ',', '.') ?> đ</td>
                                <td class="text-end text-primary fw-bold"><?= number_format($sellingPrice, 0, ',', '.') ?> đ</td>
                                <td class="text-end text-success fw-bold"><?= number_format($profit, 0, ',', '.') ?> đ</td>
                                <td>
                                    <?php if ($profit > 0): ?>
                                        <span class="badge bg-success">+ <?= $profitPercent ?>%</span>
                                    <?php elseif ($profit < 0): ?>
                                        <span class="badge bg-danger">Lỗ rớt giá</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">Hòa vốn</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center py-4">Chưa có dữ liệu lô hàng nào!</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>