<?php
$selectedImportExportId = isset($_GET['product_id']) ? (int) $_GET['product_id'] : 0;
$selectedImportExportLabel = '';
if (!empty($allProducts)) {
    foreach ($allProducts as $p) {
        if ((int) $p['id'] === $selectedImportExportId) {
            $selectedImportExportLabel = $p['name'] . (!empty($p['sku']) ? ' (' . $p['sku'] . ')' : '');
            break;
        }
    }
}
?>

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
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input
                        type="text"
                        id="import-export-product-combobox"
                        class="form-control"
                        list="import-export-product-list"
                        placeholder="Nhập hoặc chọn tên/mã SKU sản phẩm..."
                        value="<?= htmlspecialchars($selectedImportExportLabel) ?>"
                        autocomplete="off"
                        required>
                </div>
                <datalist id="import-export-product-list">
                    <?php if (!empty($allProducts)): ?>
                        <?php foreach ($allProducts as $p): ?>
                            <?php $label = $p['name'] . (!empty($p['sku']) ? ' (' . $p['sku'] . ')' : ''); ?>
                            <option value="<?= htmlspecialchars($label) ?>" data-id="<?= (int) $p['id'] ?>"></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </datalist>
                <input type="hidden" name="product_id" id="import-export-product-id" value="<?= $selectedImportExportId > 0 ? $selectedImportExportId : '' ?>">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold">Từ ngày</label>
                <input type="date" class="form-control" name="start_date" required 
                    value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-01') ?>">
            </div>

            <div class="col-md-3">
                <label class="form-label fw-bold">Đến hết ngày</label>
                <input type="date" class="form-control" name="end_date" required 
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
                            style="cursor: pointer; transition: 0.3s;" data-bs-toggle="modal"
                            data-bs-target="#importDetailsModal" onmouseover="this.style.transform='scale(1.02)'"
                            onmouseout="this.style.transform='scale(1)'" title="Click để xem chi tiết các phiếu nhập">
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
                            style="cursor: pointer; transition: 0.3s;" data-bs-toggle="modal"
                            data-bs-target="#exportDetailsModal" onmouseover="this.style.transform='scale(1.02)'"
                            onmouseout="this.style.transform='scale(1)'" title="Click để xem chi tiết các đơn hàng">
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
                                <th class="text-center">Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($importDetails)): ?>
                                <?php $stt = 1;
                                foreach ($importDetails as $detail): ?>
                                    <tr>
                                        <td class="text-center"><?= $stt++ ?></td>
                                        <td><strong
                                                class="text-primary">#PN<?= str_pad($detail['receipt_id'], 3, '0', STR_PAD_LEFT) ?></strong>
                                        </td>
                                        <td><?= date('d/m/Y H:i', strtotime($detail['created_at'])) ?></td>
                                        <td class="text-center fw-bold"><?= $detail['quantity'] ?></td>
                                        <td class="text-end"><?= number_format($detail['import_price'], 0, ',', '.') ?>đ</td>
                                        <td class="text-end fw-bold text-success">
                                            <?= number_format($detail['quantity'] * $detail['import_price'], 0, ',', '.') ?>đ
                                        </td>
                                        <td class="text-center">
                                            <a href="index.php?controller=AdminReceipt&action=edit&id=<?= (int) $detail['receipt_id'] ?>"
                                               class="btn btn-sm btn-outline-primary"
                                               title="Xem chi tiết phiếu nhập">
                                                Xem
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
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
                                <th class="text-center">Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($exportDetails)): ?>
                                <?php $stt = 1;
                                foreach ($exportDetails as $detail): ?>
                                    <tr>
                                        <td class="text-center"><?= $stt++ ?></td>
                                        <td><strong
                                                class="text-success">#DH<?= str_pad($detail['order_id'], 3, '0', STR_PAD_LEFT) ?></strong>
                                        </td>
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
                                        <td class="text-center">
                                            <a href="index.php?controller=AdminOrder&action=detail&id=<?= (int) $detail['order_id'] ?>"
                                               class="btn btn-sm btn-outline-success"
                                               title="Xem chi tiết đơn hàng">
                                                Xem
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
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
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const comboInput = document.getElementById('import-export-product-combobox');
        const hiddenProductIdInput = document.getElementById('import-export-product-id');
        const optionElements = document.querySelectorAll('#import-export-product-list option');
        const startDateInput = document.querySelector('input[name="start_date"]');
        const endDateInput = document.querySelector('input[name="end_date"]');
        const reportForm = comboInput ? comboInput.closest('form') : (startDateInput ? startDateInput.closest('form') : null);

        if (comboInput && hiddenProductIdInput && optionElements.length) {
            const options = Array.from(optionElements).map(function (option) {
                return {
                    id: option.dataset.id,
                    label: option.value,
                    normalized: option.value.toLowerCase()
                };
            });

            function normalize(text) {
                return (text || '').trim().toLowerCase();
            }

            function resolveProductId(text) {
                const normalizedText = normalize(text);
                if (!normalizedText) {
                    return null;
                }

                const exactMatch = options.find(function (item) {
                    return item.normalized === normalizedText;
                });
                if (exactMatch) {
                    return exactMatch;
                }

                const partialMatch = options.find(function (item) {
                    return item.normalized.includes(normalizedText);
                });
                return partialMatch || null;
            }

            function syncHiddenProductId() {
                const matched = resolveProductId(comboInput.value);
                if (matched) {
                    hiddenProductIdInput.value = matched.id;
                    comboInput.value = matched.label;
                } else {
                    hiddenProductIdInput.value = '';
                }
            }

            comboInput.addEventListener('input', function () {
                const matched = options.find(function (item) {
                    return item.normalized === normalize(comboInput.value);
                });

                if (matched) {
                    hiddenProductIdInput.value = matched.id;
                } else {
                    hiddenProductIdInput.value = '';
                }
            });

            comboInput.addEventListener('change', function () {
                syncHiddenProductId();
            });

            if (reportForm) {
                reportForm.addEventListener('submit', function (e) {
                    syncHiddenProductId();

                    if (!hiddenProductIdInput.value) {
                        e.preventDefault();
                        alert('Vui lòng chọn sản phẩm hợp lệ từ danh sách gợi ý.');
                        comboInput.focus();
                    }
                });
            }

            if (comboInput.value && !hiddenProductIdInput.value) {
                syncHiddenProductId();
            }
        }

        if (startDateInput && endDateInput) {
            if (startDateInput.value) {
                endDateInput.min = startDateInput.value;
            }

            startDateInput.addEventListener('change', function () {
                endDateInput.min = this.value;

                if (endDateInput.value && endDateInput.value < this.value) {
                    endDateInput.value = this.value;
                }
            });

            if (reportForm) {
                reportForm.addEventListener('submit', function (e) {
                    if (endDateInput.value < startDateInput.value) {
                        e.preventDefault();
                        alert('Lỗi: Ngày kết thúc không được nhỏ hơn ngày bắt đầu!');
                    }
                });
            }
        }
    });
</script>