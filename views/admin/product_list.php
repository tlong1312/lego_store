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
                <div class="d-flex align-items-center w-100 m-0">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <input type="text" id="searchInput" class="form-control border-0 shadow-none"
                        placeholder="Tìm kiếm sản phẩm theo tên hoặc mã SKU..." aria-label="Search..." />
                </div>
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
                        <th style="width: 120px;" class="text-center text-primary">Giá Bán</th>
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
                                    <small class="text-muted">Độ tuổi: <?= htmlspecialchars($item['age_range']) ?>+</small>
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
                                    <?php
                                    // Tính toán Giá Bán dựa trên Giá Nhập và % Tỉ lệ lợi nhuận
                                    $selling_price = $item['import_price'] + ($item['import_price'] * $item['profit_margin'] / 100);
                                    ?>
                                    <strong class="text-primary fs-6"><?= number_format($selling_price, 0, ',', '.') ?>
                                        đ</strong>
                                    <br>
                                    <small class="text-muted" style="font-size: 11px;" title="Giá nhập gốc">
                                        Gốc: <?= number_format($item['import_price'], 0, ',', '.') ?> đ
                                    </small>
                                </td>

                                <td class="text-center align-middle">
                                    <?php
                                    // 1. Số lượng tồn thực tế
                                    $currentStock = $item['stock_quantity'] ?? 0;

                                    $lowStockThreshold = $item['low_stock_threshold'] ?? 5;

                                    $textColor = '';
                                    $stockLabel = '';

                                    // 3. Phân loại động theo cấu hình từng mặt hàng
                                    if ($currentStock <= 0) {
                                        $textColor = 'text-danger';       // Đỏ
                                        $stockLabel = 'Hết hàng';
                                    } elseif ($currentStock <= $lowStockThreshold) {
                                        $textColor = 'text-warning';      // Vàng cam
                                        $stockLabel = 'Sắp hết';
                                    } else {
                                        $textColor = 'text-success';      // Xanh lá
                                        $stockLabel = 'Còn hàng';
                                    }
                                    ?>

                                    <span class="fw-bold fs-6 <?= $textColor ?>">
                                        <?= $currentStock ?>
                                    </span>
                                    <br>
                                    <small class="<?= $textColor ?>" style="font-size: 11px; font-weight: 500;">
                                        <?= $stockLabel ?>
                                    </small>
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
                                            <a class="dropdown-item"
                                                href="index.php?controller=AdminProduct&action=show&id=<?= $item['id'] ?>">
                                                <i class="bx bx-show me-1"></i> Xem
                                            </a>
                                            <a class="dropdown-item"
                                                href="index.php?controller=AdminProduct&action=edit&id=<?= $item['id'] ?>">
                                                <i class="bx bx-edit-alt me-1"></i> Sửa
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger btn-delete-product" href="javascript:void(0);"
                                                data-id="<?= $item['id'] ?>" data-name="<?= htmlspecialchars($item['name']) ?>">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .swal2-container {
        z-index: 99999 !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // === 1. XỬ LÝ CẬP NHẬT TRẠNG THÁI (AJAX) ===
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

                selectElement.closest('tr').setAttribute('data-status', newStatus);

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

        // === 2. TÌM KIẾM TRỰC TIẾP (LIVE SEARCH) & LỌC TRẠNG THÁI ===
        const searchInput = document.getElementById('searchInput');
        const filterRadios = document.querySelectorAll('.filter-radio');
        const productRows = document.querySelectorAll('.product-row');

        // Hàm xử lý lọc kết hợp cả 2 điều kiện
        function filterTable() {
            const keyword = searchInput ? searchInput.value.toLowerCase().trim() : '';
            const activeStatus = document.querySelector('.filter-radio:checked').value;

            productRows.forEach(row => {
                const productName = row.querySelector('td:nth-child(2) strong').innerText.toLowerCase();
                const productSku = row.querySelector('td:nth-child(4) code').innerText.toLowerCase();
                const rowStatus = row.getAttribute('data-status');

                // Kiểm tra 1: Có khớp từ khóa gõ vào không?
                const isMatchKeyword = productName.includes(keyword) || productSku.includes(keyword);

                // Kiểm tra 2: Có khớp với chấm tròn trạng thái không?
                const isMatchStatus = (activeStatus === 'all') || (rowStatus === activeStatus);

                // Nếu khớp cả 2 thì hiện, không thì ẩn
                if (isMatchKeyword && isMatchStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        if (searchInput) {
            searchInput.addEventListener('input', filterTable);
        }

        filterRadios.forEach(radio => {
            radio.addEventListener('change', filterTable);
        });

        // === 3. XÁC NHẬN XÓA BẰNG SWEETALERT2 (Sử dụng Event Delegation) ===
        document.addEventListener('click', function (e) {
            const deleteBtn = e.target.closest('.btn-delete-product');

            if (deleteBtn) {
                e.preventDefault();

                const productId = deleteBtn.getAttribute('data-id');
                const productName = deleteBtn.getAttribute('data-name');

                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: `Bạn muốn xóa sản phẩm "${productName}"? Hành động này không thể hoàn tác!`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#696cff',
                    confirmButtonText: 'Xác nhận',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `index.php?controller=AdminProduct&action=delete&id=${productId}`;
                    }
                });
            }
        });

        // === 4. HIỂN THỊ THÔNG BÁO TỪ CONTROLLER ===
        <?php if (isset($_GET['msg'])): ?>

            <?php if ($_GET['msg'] === 'hidden_due_to_stock'): ?>
                Swal.fire({
                    icon: 'info',
                    title: 'Đã ẩn sản phẩm!',
                    text: 'Sản phẩm còn tồn kho nên chỉ có thể ẩn',
                    confirmButtonText: 'Đã hiểu',
                    confirmButtonColor: '#0dcaf0' // Màu xanh cyan
                });

            <?php elseif ($_GET['msg'] === 'delete_success'): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Đã xóa hoàn toàn!',
                    text: 'Sản phẩm chưa nhập hàng nên đã được xóa vĩnh viễn khỏi hệ thống.',
                    showConfirmButton: false,
                    timer: 1800
                });

            <?php elseif ($_GET['msg'] === 'delete_error'): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi Database!',
                    text: 'Không thể xóa sản phẩm này khỏi cơ sở dữ liệu.',
                    confirmButtonColor: '#696cff'
                });

            <?php elseif ($_GET['msg'] === 'not_found'): ?>
                Swal.fire({
                    icon: 'warning',
                    title: 'Lỗi!',
                    text: 'Sản phẩm không tồn tại hoặc đã bị xóa trước đó.',
                    confirmButtonColor: '#696cff'
                });

            <?php endif; ?>

            // Xóa tham số msg trên URL
            const newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + "?controller=AdminProduct&action=index";
            window.history.replaceState({ path: newUrl }, '', newUrl);
        <?php endif; ?>

    });
</script>