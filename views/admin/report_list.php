<div class="card">
    <div class="card-header border-bottom">
        <h5 class="card-title mb-0">Thống kê lịch sử Nhập - Xuất</h5>
    </div>
    <div class="card-body mt-4">

        <form action="index.php" method="GET" class="row g-3 align-items-end mb-4">
            <input type="hidden" name="controller" value="AdminReport">
            <input type="hidden" name="action" value="importExport">

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

        <?php if (isset($_GET['product_id'])): ?>

            <?php if (isset($importExportData)): ?>
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card bg-label-primary border border-primary shadow-none h-100" 
                             style="cursor: pointer; transition: 0.3s;"
                             data-bs-toggle="modal" data-bs-target="#importDetailsModal"
                             onmouseover="this.style.transform='scale(1.02)'" 
                             onmouseout="this.style.transform='scale(1)'"
                             title="Click để xem chi tiết các phiếu nhập">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-md me-3">
                                    <span class="avatar-initial rounded bg-primary"><i
                                            class="bx bx-log-in fs-4 text-white"></i></span>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-primary">Tổng Hàng Nhập</h6>
                                    <small class="text-muted">Từ <?= date('d/m/Y', strtotime($startDate)) ?> đến
                                        <?= date('d/m/Y', strtotime($endDate)) ?></small>
                                    <h3 class="mb-0 text-primary mt-1"><?= $importExportData['total_in'] ?> <small
                                            class="fs-6 fw-normal">sản phẩm</small></h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card bg-label-success border border-success shadow-none h-100"
                             style="cursor: pointer; transition: 0.3s;"
                             data-bs-toggle="modal" data-bs-target="#exportDetailsModal"
                             onmouseover="this.style.transform='scale(1.02)'" 
                             onmouseout="this.style.transform='scale(1)'"
                             title="Click để xem chi tiết các đơn hàng">
                            <div class="card-body d-flex align-items-center">
                                <div class="avatar avatar-md me-3">
                                    <span class="avatar-initial rounded bg-success"><i
                                            class="bx bx-cart-alt fs-4 text-white"></i></span>
                                </div>
                                <div>
                                    <h6 class="mb-0 text-success">Tổng Hàng Đã Bán</h6>
                                    <small class="text-muted">Từ <?= date('d/m/Y', strtotime($startDate)) ?> đến
                                        <?= date('d/m/Y', strtotime($endDate)) ?></small>
                                    <h3 class="mb-0 text-success mt-1"><?= $importExportData['total_out'] ?> <small
                                            class="fs-6 fw-normal">sản phẩm</small></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

        <?php endif; ?>
    </div>
</div>

<div class="modal fade" id="importDetailsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-bottom pb-3">
        <h5 class="modal-title fw-bold text-primary">
            <i class="bx bx-log-in me-2"></i>Chi tiết các lần Nhập Hàng
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">STT</th>
                        <th>Mã Phiếu Nhập</th>
                        <th>Thời Gian Nhập</th>
                        <th class="text-center">Số Lượng</th>
                        <th class="text-end">Giá Nhập (VNĐ)</th>
                        <th class="text-end">Thành Tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($importDetails)): ?>
                        <?php $stt = 1; foreach($importDetails as $detail): ?>
                            <tr>
                                <td class="text-center"><?= $stt++ ?></td>
                                <td><strong class="text-primary">#PN<?= str_pad($detail['receipt_id'], 3, '0', STR_PAD_LEFT) ?></strong></td>
                                <td><?= date('d/m/Y H:i', strtotime($detail['created_at'])) ?></td>
                                <td class="text-center fw-bold"><?= $detail['quantity'] ?></td>
                                <td class="text-end"><?= number_format($detail['import_price'], 0, ',', '.') ?>đ</td>
                                <td class="text-end fw-bold text-success">
                                    <?= number_format($detail['quantity'] * $detail['import_price'], 0, ',', '.') ?>đ
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Không có dữ liệu nhập hàng nào trong khoảng thời gian này.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer border-top mt-2">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="exportDetailsModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header border-bottom pb-3">
        <h5 class="modal-title fw-bold text-success">
            <i class="bx bx-cart-alt me-2"></i>Chi tiết các đơn hàng đã bán
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">STT</th>
                        <th>Mã Đơn Hàng</th>
                        <th>Thời Gian Đặt</th>
                        <th class="text-center">Số Lượng</th>
                        <th class="text-end">Đơn Giá Bán</th>
                        <th class="text-center">Trạng Thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($exportDetails)): ?>
                        <?php $stt = 1; foreach($exportDetails as $detail): ?>
                            <tr>
                                <td class="text-center"><?= $stt++ ?></td>
                                <td><strong class="text-success">#DH<?= str_pad($detail['order_id'], 3, '0', STR_PAD_LEFT) ?></strong></td>
                                <td><?= date('d/m/Y H:i', strtotime($detail['created_at'])) ?></td>
                                <td class="text-center fw-bold"><?= $detail['quantity'] ?></td>
                                <td class="text-end"><?= number_format($detail['price'], 0, ',', '.') ?>đ</td>
                                <td class="text-center">
                                    <?php 
                                        if ($detail['status'] == 0) {
                                            echo '<span class="badge bg-label-warning">Chờ xử lý</span>';
                                        } elseif ($detail['status'] == 1) {
                                            echo '<span class="badge bg-label-info">Đang giao</span>';
                                        } elseif ($detail['status'] == 2) {
                                            echo '<span class="badge bg-label-success">Hoàn thành</span>';
                                        } else {
                                            echo '<span class="badge bg-label-secondary">Khác</span>';
                                        }
                                    ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                Không có dữ liệu bán hàng nào trong khoảng thời gian này.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
      </div>
      <div class="modal-footer border-top mt-2">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Đóng</button>
      </div>
    </div>
  </div>
</div>