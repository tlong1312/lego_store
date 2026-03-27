<div class="card">
    <div class="card-header border-bottom">
        <h5 class="card-title mb-0">Tra cứu Lịch sử Tồn kho & Báo cáo Nhập Xuất</h5>
    </div>
    <div class="card-body mt-4">
        
        <form action="index.php" method="GET" class="row g-3 align-items-end mb-4">
            <input type="hidden" name="controller" value="AdminReport">
            <input type="hidden" name="action" value="inventory">

            <div class="col-md-4">
                <label class="form-label fw-bold">Chọn sản phẩm</label>
                <select class="form-select" name="product_id" required>
                    <option value="">-- Chọn sản phẩm --</option>
                    <?php if (!empty($allProducts)): ?>
                        <?php foreach ($allProducts as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= (isset($_GET['product_id']) && $_GET['product_id'] == $p['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($p['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </select>
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold">Từ ngày</label>
                <input type="date" class="form-control" name="start_date" required max="<?= date('Y-m-d') ?>"
                    value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-01') ?>">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold">Đến hết ngày</label>
                <input type="date" class="form-control" name="end_date" required max="<?= date('Y-m-d') ?>"
                    value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d') ?>">
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bx bx-search-alt me-1"></i> Tra cứu
                </button>
            </div>
        </form>

        <?php if (isset($_GET['product_id']) && isset($stockAtDate)): ?>
            
            <div class="alert alert-<?= $stockAtDate > 0 ? 'success' : 'warning' ?> d-flex align-items-center mt-3" role="alert">
                <i class="bx bx-<?= $stockAtDate > 0 ? 'check-circle' : 'info-circle' ?> fs-1 me-3"></i>
                <div>
                    <h5 class="alert-heading mb-1">Mốc Tồn Kho:</h5>
                    <span class="fs-6">
                        Số lượng trong kho tính đến 23:59 ngày <strong><?= date('d/m/Y', strtotime($endDate)) ?></strong>
                        là: <strong class="fs-4 text-<?= $stockAtDate > 0 ? 'success' : 'danger' ?>"><?= $stockAtDate ?></strong> sản phẩm.
                    </span>
                </div>
            </div>

            <?php if(isset($importExportData)): ?>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card bg-label-primary border border-primary shadow-none h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="avatar avatar-md me-3">
                                <span class="avatar-initial rounded bg-primary"><i class="bx bx-log-in fs-4 text-white"></i></span>
                            </div>
                            <div>
                                <h6 class="mb-0 text-primary">Tổng Hàng Nhập</h6>
                                <small class="text-muted">Từ <?= date('d/m/Y', strtotime($startDate)) ?> đến <?= date('d/m/Y', strtotime($endDate)) ?></small>
                                <h3 class="mb-0 text-primary mt-1"><?= $importExportData['total_in'] ?> <small class="fs-6 fw-normal">sản phẩm</small></h3>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card bg-label-success border border-success shadow-none h-100">
                        <div class="card-body d-flex align-items-center">
                            <div class="avatar avatar-md me-3">
                                <span class="avatar-initial rounded bg-success"><i class="bx bx-cart-alt fs-4 text-white"></i></span>
                            </div>
                            <div>
                                <h6 class="mb-0 text-success">Tổng Hàng Đã Bán</h6>
                                <small class="text-muted">Từ <?= date('d/m/Y', strtotime($startDate)) ?> đến <?= date('d/m/Y', strtotime($endDate)) ?></small>
                                <h3 class="mb-0 text-success mt-1"><?= $importExportData['total_out'] ?> <small class="fs-6 fw-normal">sản phẩm</small></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</div>