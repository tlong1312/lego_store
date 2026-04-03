<div class="card">
    <div class="card-header border-bottom">
        <h5 class="card-title mb-0">Thống kê Tồn kho theo ngày</h5>
    </div>
    <div class="card-body mt-4">

        <form action="index.php" method="GET" class="row g-3 align-items-end mb-4">
            <input type="hidden" name="controller" value="AdminReport">
            <input type="hidden" name="action" value="inventory">

            <div class="col-md-5">
                <label class="form-label fw-bold">Chọn sản phẩm</label>
                <select class="form-select" name="product_id" required>
                    <option value="">-- Chọn sản phẩm --</option>
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= (isset($_GET['product_id']) && $_GET['product_id'] == $p['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($p['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">Trong ngày</label>
                <input type="date" class="form-control" name="target_date" required 
                    value="<?= isset($_GET['target_date']) ? $_GET['target_date'] : date('Y-m-d') ?>">
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bx bx-search-alt me-1"></i> Tra cứu
                </button>
            </div>
        </form>

        <?php if (isset($_GET['product_id'])): ?>
            <?php if (isset($stockResult) && $stockResult !== null): ?>
                
                <?php 
                    $colorClass = $stockResult > 0 ? 'success' : 'warning'; 
                    $iconClass = $stockResult > 0 ? 'bx-check-circle' : 'bx-info-circle';
                    
                    $today = date('Y-m-d');
                    if ($selectedDate > $today) {
                        $dateDisplay = "23h59p ngày " . date('d/m/Y');
                    } else {
                        $dateDisplay = "23h59p ngày " . date('d/m/Y', strtotime($selectedDate));
                    }
                ?>
                
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card bg-label-<?= $colorClass ?> border border-<?= $colorClass ?> shadow-none h-100">
                            <div class="card-body d-flex align-items-center p-4">
                                <div class="avatar avatar-md me-4">
                                    <span class="avatar-initial rounded bg-<?= $colorClass ?>">
                                        <i class="bx <?= $iconClass ?> fs-3 text-white"></i>
                                    </span>
                                </div>
                                <div>
                                    <h5 class="mb-1 text-<?= $colorClass ?> fw-bold">Mốc Tồn Kho:</h5>
                                    <p class="mb-0 text-muted fs-6">
                                        Số lượng trong kho tính đến <strong><?= $dateDisplay ?></strong> của sản phẩm <strong><?= htmlspecialchars($selectedProductName) ?></strong> là:
                                    </p>
                                    <h2 class="mb-0 text-<?= $colorClass ?> mt-2 fw-bold">
                                        <?= $stockResult ?> <small class="fs-6 fw-normal">sản phẩm</small>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

    </div>
</div>