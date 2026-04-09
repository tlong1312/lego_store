<?php
$selectedProfitProductId = isset($_GET['product_id']) ? (int) $_GET['product_id'] : 0;
$selectedProfitProductLabel = '';
if (!empty($allProducts)) {
    foreach ($allProducts as $p) {
        if ((int) $p['id'] === $selectedProfitProductId) {
            $selectedProfitProductLabel = $p['name'] . (!empty($p['sku']) ? ' (' . $p['sku'] . ')' : '');
            break;
        }
    }
}
?>

<div class="card">
    <div class="card-header border-bottom d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Tra Cứu Lợi Nhuận Theo Lô Hàng</h5>
    </div>
    <div class="card-body mt-4">
        
        <form action="index.php" method="GET" class="row g-3 align-items-end mb-4">
            <input type="hidden" name="controller" value="AdminReport">
            <input type="hidden" name="action" value="profit">

            <div class="col-md-8">
                <label class="form-label fw-bold">Chọn sản phẩm</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input
                        type="text"
                        id="profit-product-combobox"
                        class="form-control"
                        list="profit-product-list"
                        placeholder="Để trống để xem toàn bộ lô hàng, hoặc nhập tên/mã SKU..."
                        value="<?= htmlspecialchars($selectedProfitProductLabel) ?>"
                        autocomplete="off">
                </div>
                <datalist id="profit-product-list">
                    <?php if (!empty($allProducts)): ?>
                        <?php foreach ($allProducts as $p): ?>
                            <?php $label = $p['name'] . (!empty($p['sku']) ? ' (' . $p['sku'] . ')' : ''); ?>
                            <option value="<?= htmlspecialchars($label) ?>" data-id="<?= (int) $p['id'] ?>"></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </datalist>
                <input type="hidden" name="product_id" id="profit-product-id" value="<?= $selectedProfitProductId > 0 ? $selectedProfitProductId : '' ?>">
            </div>

            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bx bx-search-alt me-1"></i> Tra cứu
                </button>
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const comboInput = document.getElementById('profit-product-combobox');
    const hiddenProductIdInput = document.getElementById('profit-product-id');
    const profitForm = comboInput ? comboInput.closest('form') : null;
    const optionElements = document.querySelectorAll('#profit-product-list option');

    if (!comboInput || !hiddenProductIdInput || !profitForm) {
        return;
    }

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
        if (!normalize(comboInput.value)) {
            hiddenProductIdInput.value = '';
            return true;
        }

        const matched = resolveProductId(comboInput.value);
        if (matched) {
            hiddenProductIdInput.value = matched.id;
            comboInput.value = matched.label;
            return true;
        }

        hiddenProductIdInput.value = '';
        return false;
    }

    comboInput.addEventListener('input', function () {
        const normalizedValue = normalize(comboInput.value);
        if (!normalizedValue) {
            hiddenProductIdInput.value = '';
            return;
        }

        const matched = options.find(function (item) {
            return item.normalized === normalizedValue;
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

    profitForm.addEventListener('submit', function (e) {
        const isValidSelection = syncHiddenProductId();

        if (!isValidSelection) {
            e.preventDefault();
            alert('Vui lòng chọn sản phẩm hợp lệ từ danh sách gợi ý hoặc để trống để xem toàn bộ lô hàng.');
            comboInput.focus();
        }
    });

    if (comboInput.value && !hiddenProductIdInput.value) {
        syncHiddenProductId();
    }
});
</script>