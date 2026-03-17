<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
    id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <div class="navbar-nav align-items-center w-100">
            <div class="nav-item d-flex align-items-center w-100">
                <form action="index.php" method="GET" class="d-flex align-items-center w-100 m-0">
                    <input type="hidden" name="controller" value="AdminProduct">
                    <input type="hidden" name="action" value="index">

                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input type="text" name="keyword" class="form-control border-0 shadow-none"
                        placeholder="Tìm kiếm sản phẩm theo tên..."
                        value="<?= isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : '' ?>"
                        aria-label="Search..." />
                </form>
            </div>
        </div>

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <img src="public/admin/assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <img src="public/admin/assets/img/avatars/1.png" alt
                                            class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="row-1">
                                    <span class="fw-semibold d-block">Admin</span>
                                    <small class="text-muted">Quản trị viên</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="login.php">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Đăng xuất</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<div class="card mt-3">
    <div class="card-header d-flex justify-content-between align-items-center pb-0">
        <h5 class="mb-0">Danh Sách Sản Phẩm</h5>

        <div class="d-flex justify-content-center align-items-center mb-4">
            <div class="form-check form-check-inline me-4">
                <input class="form-check-input filter-radio" type="radio" name="statusFilter" id="filterAll" value="all"
                    checked style="cursor: pointer;">
                <label class="form-check-label fw-bold" for="filterAll" style="cursor: pointer;">Tất cả</label>
            </div>
            <div class="form-check form-check-inline me-4">
                <input class="form-check-input filter-radio" type="radio" name="statusFilter" id="filterActive"
                    value="1" style="cursor: pointer;">
                <label class="form-check-label fw-bold text-success" for="filterActive" style="cursor: pointer;">Đang
                    bán</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input filter-radio" type="radio" name="statusFilter" id="filterInactive"
                    value="0" style="cursor: pointer;">
                <label class="form-check-label fw-bold text-secondary" for="filterInactive"
                    style="cursor: pointer;">Chưa bán</label>
            </div>
        </div>

        <a href="index.php?controller=AdminProduct&action=add" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i>Thêm Mới
        </a>
    </div>

    <div class="card-body mt-2">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Danh Mục</th>
                        <th style="width: 120px;">Mã Sản Phẩm</th>
                        <th style="width: 100px;" class="text-center">Giá Nhập</th>
                        <th style="width: 90px;" class="text-center">Tồn Kho</th>
                        <th style="width: 100px;" class="text-center">Trạng Thái</th>
                        <th style="width: 50px;" class="text-center">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($products)): ?>
                        <?php foreach ($products as $item): ?>
                            <tr class="product-row" data-status="<?= $item['status'] ?>">
                                <td><strong>#<?= $item['id'] ?></strong></td>
                                <td>
                                    <strong><?= htmlspecialchars($item['name']) ?></strong>
                                    <br>
                                    <small class="text-muted">Độ tuổi: <?= htmlspecialchars($item['age_range']) ?></small>
                                </td>
                                <td>
                                    <?php if (!empty($item['category_name'])): ?>
                                        <span class="badge bg-label-info"><?= htmlspecialchars($item['category_name']) ?></span>
                                    <?php else: ?>
                                        <span class="text-muted"><i>Không có</i></span>
                                    <?php endif; ?>
                                </td>
                                <td><code><?= htmlspecialchars($item['sku']) ?></code></td>
                                <td class="text-center">
                                    <strong><?= number_format($item['import_price'], 0, ',', '.') ?> đ</strong>
                                </td>

                                <td class="text-center">
                                    <?php
                                    $borderColor = '';
                                    if ($item['stock_quantity'] > 5)
                                        $borderColor = 'border-success text-success';
                                    elseif ($item['stock_quantity'] > 0)
                                        $borderColor = 'border-warning text-warning';
                                    else
                                        $borderColor = 'border-danger text-danger';
                                    ?>
                                    <input type="number" min="0"
                                        class="form-control form-control-sm text-center fw-bold update-stock-input <?= $borderColor ?>"
                                        value="<?= $item['stock_quantity'] ?>" data-id="<?= $item['id'] ?>"
                                        style="width: 70px; margin: 0 auto; box-shadow: none;">
                                </td>

                                <td class="text-center">
                                    <select
                                        class="form-select form-select-sm text-center fw-bold update-status-select <?= $item['status'] == 1 ? 'bg-success text-white' : 'bg-secondary text-white' ?>"
                                        data-id="<?= $item['id'] ?>"
                                        style="width: 90px; margin: 0 auto; border: none; cursor: pointer; padding: 6px 12px; font-size: 12px;">
                                        <option value="1" <?= $item['status'] == 1 ? 'selected' : '' ?> class="bg-white text-dark">
                                            ĐANG BÁN</option>
                                        <option value="0" <?= $item['status'] == 0 ? 'selected' : '' ?> class="bg-white text-dark">
                                            CHƯA BÁN</option>
                                    </select>
                                </td>

                                <td class="text-center">
                                    <div class="dropdown">
                                        <button type="button"
                                            class="btn btn-sm btn-icon btn-outline-secondary dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="index.php?controller=AdminProduct&action=show&id=<?= $item['id'] ?>">
                                                <i class="bx bx-show me-1"></i> Xem
                                            </a>
                                            <a class="dropdown-item"
                                                href="index.php?controller=AdminProduct&action=edit&id=<?= $item['id'] ?>">
                                                <i class="bx bx-edit-alt me-1"></i> Sửa
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger"
                                                href="index.php?controller=AdminProduct&action=delete&id=<?= $item['id'] ?>"
                                                onclick="if(<?= $item['status'] ?> == 1) { alert('Sản phẩm đang bán không thể xóa. Vui lòng đổi trạng thái thành CHƯA BÁN trước!'); return false; } else { return confirm('Bạn có chắc chắn muốn xóa bộ Lego này không? Hành động này không thể hoàn tác!'); }">
                                                <i class="bx bx-trash me-1"></i> Xóa
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center py-4">Chưa có sản phẩm nào khớp với tìm kiếm hoặc trong cơ sở
                                dữ liệu.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // === 1. XỬ LÝ CẬP NHẬT TỒN KHO ===
        const stockInputs = document.querySelectorAll('.update-stock-input');
        stockInputs.forEach(input => {
            input.addEventListener('change', function () {
                const productId = this.getAttribute('data-id');
                let newStock = this.value;
                const inputElement = this;

                // Chặn số âm
                if (newStock < 0) {
                    alert('Số lượng tồn kho không được nhỏ hơn 0!');
                    newStock = 0;
                    inputElement.value = 0;
                }

                // Cập nhật màu viền
                inputElement.classList.remove('border-success', 'text-success', 'border-warning', 'text-warning', 'border-danger', 'text-danger');
                if (newStock > 5) inputElement.classList.add('border-success', 'text-success');
                else if (newStock > 0) inputElement.classList.add('border-warning', 'text-warning');
                else inputElement.classList.add('border-danger', 'text-danger');

                // Gửi AJAX
                fetch('index.php?controller=AdminProduct&action=updateStock', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `id=${productId}&stock_quantity=${newStock}`
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            inputElement.style.backgroundColor = '#e8fadf';
                            setTimeout(() => { inputElement.style.backgroundColor = ''; }, 800);
                        } else alert('Lỗi: Không thể cập nhật Tồn Kho!');
                    })
                    .catch(error => alert('Đã xảy ra lỗi kết nối!'));
            });
        });

        // === 2. XỬ LÝ CẬP NHẬT TRẠNG THÁI ===
        const statusSelects = document.querySelectorAll('.update-status-select');
        statusSelects.forEach(select => {
            select.addEventListener('change', function () {
                const productId = this.getAttribute('data-id');
                const newStatus = this.value;
                const selectElement = this;

                // Đổi màu nền Select
                if (newStatus == '1') {
                    selectElement.classList.remove('bg-secondary');
                    selectElement.classList.add('bg-success');
                } else {
                    selectElement.classList.remove('bg-success');
                    selectElement.classList.add('bg-secondary');
                }

                // Cập nhật lại thuộc tính data-status cho dòng (TR) để bộ lọc Radio hoạt động đúng
                selectElement.closest('tr').setAttribute('data-status', newStatus);

                // Gửi AJAX
                fetch('index.php?controller=AdminProduct&action=updateStatus', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `id=${productId}&status=${newStatus}`
                })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) alert('Lỗi: Không thể cập nhật Trạng Thái!');
                    })
                    .catch(error => alert('Đã xảy ra lỗi kết nối!'));
            });
        });

        // === 3. XỬ LÝ LỌC TRẠNG THÁI (CHẤM TRÒN RADIO) ===
        const filterRadios = document.querySelectorAll('.filter-radio');
        const productRows = document.querySelectorAll('.product-row');

        filterRadios.forEach(radio => {
            radio.addEventListener('change', function () {
                const filterValue = this.value;

                productRows.forEach(row => {
                    if (filterValue === 'all') {
                        row.style.display = '';
                    } else {
                        if (row.getAttribute('data-status') === filterValue) {
                            row.style.display = '';
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });
            });
        });

    });
</script>