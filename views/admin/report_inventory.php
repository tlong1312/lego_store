<?php
$selectedInventoryId = isset($_GET['product_id']) ? (int) $_GET['product_id'] : 0;
$selectedInventoryLabel = '';
if (!empty($products)) {
    foreach ($products as $p) {
        if ((int) $p['id'] === $selectedInventoryId) {
            $selectedInventoryLabel = $p['name'] . (!empty($p['sku']) ? ' (' . $p['sku'] . ')' : '');
            break;
        }
    }
}
?>

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
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input
                        type="text"
                        id="inventory-product-combobox"
                        class="form-control"
                        list="inventory-product-list"
                        placeholder="Nhập hoặc chọn tên/mã SKU sản phẩm..."
                        value="<?= htmlspecialchars($selectedInventoryLabel) ?>"
                        autocomplete="off"
                        required>
                </div>
                <datalist id="inventory-product-list">
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $p): ?>
                            <?php $label = $p['name'] . (!empty($p['sku']) ? ' (' . $p['sku'] . ')' : ''); ?>
                            <option value="<?= htmlspecialchars($label) ?>" data-id="<?= (int) $p['id'] ?>"></option>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </datalist>
                <input type="hidden" name="product_id" id="inventory-product-id" value="<?= $selectedInventoryId > 0 ? $selectedInventoryId : '' ?>">
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const comboInput = document.getElementById('inventory-product-combobox');
    const hiddenProductIdInput = document.getElementById('inventory-product-id');
    const inventoryForm = comboInput ? comboInput.closest('form') : null;
    const optionElements = document.querySelectorAll('#inventory-product-list option');

    if (!comboInput || !hiddenProductIdInput || !inventoryForm || !optionElements.length) {
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

    inventoryForm.addEventListener('submit', function (e) {
        syncHiddenProductId();

        if (!hiddenProductIdInput.value) {
            e.preventDefault();
            alert('Vui lòng chọn sản phẩm hợp lệ từ danh sách gợi ý.');
            comboInput.focus();
        }
    });

    // Đồng bộ khi trang được load với giá trị query sẵn có.
    if (comboInput.value && !hiddenProductIdInput.value) {
        syncHiddenProductId();
    }
});
</script>