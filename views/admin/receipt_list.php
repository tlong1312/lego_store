<div class="card mt-4 mx-auto card-fit-screen" style="max-width: 1100px; width: 100%;">
    <div class="card-header d-flex justify-content-between align-items-center pb-0">
        <h5 class="mb-0">Lịch Sử Nhập Kho</h5>
        <a href="index.php?controller=AdminReceipt&action=create" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i>Tạo Phiếu Nhập Mới
        </a>
    </div>

    <div class="card-body pb-0 mt-3">
        <div class="row bg-light p-3 rounded mb-3 align-items-center">
            <div class="col-md-5">
                <label class="form-label fw-bold">Tìm kiếm chung</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input type="text" id="searchReceipt" class="form-control"
                        placeholder="Gõ mã phiếu (VD: 5) hoặc tên người lập...">
                </div>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Lọc theo ngày nhập</label>
                <div class="input-group input-group-merge">
                    <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                    <input type="date" id="filterDate" class="form-control">
                </div>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="button" id="btnResetFilter" class="btn btn-outline-secondary w-100">
                    <i class="bx bx-refresh me-1"></i> Xóa bộ lọc
                </button>
            </div>
        </div>
    </div>

    <div class="card-body pt-0">
        <div class="table-responsive custom-table-scroll">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th style="width: 150px;">Mã Phiếu</th>
                        <th>Người Lập</th>
                        <th class="text-end">Tổng Tiền</th>
                        <th class="text-center">Ngày Nhập</th>
                        <th class="text-center">Trạng Thái</th>
                        <th style="width: 100px;" class="text-center">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($receipts)): ?>
                        <?php foreach ($receipts as $r): ?>
                            <tr class="receipt-row">
                                <td><strong>#PN<?= $r['id'] ?></strong></td>
                                <td>
                                    <i class="bx bx-user me-1 text-muted"></i>
                                    <?= htmlspecialchars($r['creator_name'] ?? 'Admin') ?>
                                </td>
                                <td class="text-end fw-bold text-primary">
                                    <?= number_format($r['total_amount'], 0, ',', '.') ?> đ
                                </td>
                                <td class="text-center"><?= date('d/m/Y H:i', strtotime($r['created_at'])) ?></td>
                                <td class="text-center">
                                    <?php if ($r['status'] == 1): ?>
                                        <span class="badge bg-success">ĐÃ HOÀN THÀNH</span>
                                    <?php else: ?>
                                        <span class="badge bg-warning text-dark">BẢN NHÁP</span>
                                    <?php endif; ?>
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
                                                href="index.php?controller=AdminReceipt&action=edit&id=<?= $r['id'] ?>">
                                                <?php if ($r['status'] == 1): ?>
                                                    <i class="bx bx-show me-1 text-primary"></i> Xem chi tiết
                                                <?php else: ?>
                                                    <i class="bx bx-edit-alt me-1 text-warning"></i> Sửa phiếu nháp
                                                <?php endif; ?>
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item text-danger"
                                                href="index.php?controller=AdminReceipt&action=delete&id=<?= $r['id'] ?>"
                                                onclick="if(<?= $r['status'] ?> == 1) { alert('Phiếu đã hoàn thành không thể xóa để đảm bảo an toàn dữ liệu tồn kho!'); return false; } else { return confirm('Bạn có chắc chắn muốn xóa phiếu nhập nháp này không?'); }">
                                                <i class="bx bx-trash me-1"></i> Xóa phiếu
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center py-4">Chưa có phiếu nhập nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-3 mb-0">
            <span class="text-muted">
                <strong>Thống kê:</strong> Đã tạo <b><?= $totalReceipts ?></b> phiếu nhập.
                Trong đó, <b><?= $completedReceipts ?></b> phiếu đã hoàn thành.
            </span>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchReceipt = document.getElementById('searchReceipt');
        const filterDate = document.getElementById('filterDate');
        const btnResetFilter = document.getElementById('btnResetFilter');
        const receiptRows = document.querySelectorAll('.receipt-row');

        function filterTable() {
            const keyword = searchReceipt.value.toLowerCase().trim();
            const selectedDate = filterDate.value;

            let formattedDate = "";
            if (selectedDate) {
                const [year, month, day] = selectedDate.split('-');
                formattedDate = `${day}/${month}/${year}`;  
            }

            receiptRows.forEach(row => {
                const idText = row.querySelector('td:nth-child(1)').innerText.toLowerCase();
                const creatorText = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
                const dateText = row.querySelector('td:nth-child(4)').innerText;  

                const isMatchKeyword = idText.includes(keyword) || creatorText.includes(keyword);

                const isMatchDate = formattedDate === "" || dateText.includes(formattedDate);

                if (isMatchKeyword && isMatchDate) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        if (searchReceipt) searchReceipt.addEventListener('input', filterTable);
        if (filterDate) filterDate.addEventListener('change', filterTable);

        if (btnResetFilter) {
            btnResetFilter.addEventListener('click', function () {
                searchReceipt.value = '';
                filterDate.value = '';
                filterTable();
            });
        }
    });
</script>