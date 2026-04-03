<div class="row mt-4">
    <div class="col-xl-10 mx-auto">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">
                Phiếu Nhập Kho: #PN<?= $receipt['id'] ?>
                <?php if ($is_completed): ?>
                    <span class="badge bg-success ms-2 fs-6 align-middle">ĐÃ HOÀN THÀNH (KHÓA)</span>
                <?php else: ?>
                    <span class="badge bg-warning text-dark ms-2 fs-6 align-middle">ĐANG XỬ LÝ (NHÁP)</span>
                <?php endif; ?>
            </h4>
            <a href="index.php?controller=AdminReceipt&action=index" class="btn btn-outline-secondary">
                <i class="bx bx-arrow-back me-1"></i> Trở về
            </a>
        </div>

        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'empty_items'): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bx bx-error-circle me-1 fs-4 align-middle"></i>
                <strong>Không thể chốt phiếu!</strong> Bạn phải thêm ít nhất 1 sản phẩm vào bảng bên dưới thì mới được phép lưu.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (!$is_completed): ?>
            <div class="card mb-4 border-primary">
                <div class="card-header bg-label-primary">
                    <h6 class="mb-0 text-primary fw-bold"><i class="bx bx-search me-1"></i> Tìm và thêm sản phẩm vào phiếu</h6>
                </div>
                <div class="card-body pt-3">
                    <form id="addDetailForm" class="row align-items-end">
                        <input type="hidden" id="receipt_id" value="<?= $receipt['id'] ?>">

                        <div class="col-md-5 mb-3">
                            <label class="form-label fw-bold">Chọn sản phẩm (Gõ Tên hoặc Mã SKU để tìm)</label>
                            <input list="productList" id="product_id" class="form-control" placeholder="Tìm kiếm bộ Lego..." required>
                            <datalist id="productList">
                                <?php foreach ($products as $p): ?>
                                    <option value="<?= $p['id'] ?>">SKU: <?= $p['sku'] ?> - <?= htmlspecialchars($p['name']) ?></option>
                                <?php endforeach; ?>
                            </datalist>
                        </div>

                        <div class="col-md-2 mb-3">
                            <label class="form-label fw-bold">Số lượng</label>
                            <input type="number" id="quantity" class="form-control text-center" value="1" min="1" oninput="if(this.value < 1) this.value = 1;" required>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label class="form-label fw-bold">Giá Nhập (VNĐ)</label>
                            <input type="number" min="0" id="import_price" class="form-control text-end" placeholder="VD: 500000" oninput="if(this.value < 0) this.value = 0;" required>
                        </div>

                        <div class="col-md-2 mb-3 d-grid">
                            <button type="button" id="btnAddItem" class="btn btn-primary">
                                <i class="bx bx-plus me-1"></i> Thêm
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Sản phẩm</th>
                                <th class="text-center" style="width: 120px;">Số lượng</th>
                                <th class="text-end" style="width: 150px;">Đơn giá nhập</th>
                                <th class="text-end" style="width: 150px;">Thành tiền</th>
                                <?php if (!$is_completed): ?>
                                    <th class="text-center" style="width: 80px;">Xóa</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($details)): ?>
                                <?php foreach ($details as $item): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php if (!empty($item['name'])): ?>
                                                    <img src="public/admin/assets/images/<?= htmlspecialchars($item['image']) ?>" class="rounded me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                                    <div>
                                                        <strong><?= htmlspecialchars($item['name']) ?></strong><br>
                                                        <small class="text-muted">SKU: <?= htmlspecialchars($item['sku']) ?></small>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="avatar me-3" style="width: 40px; height: 40px;">
                                                        <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-trash"></i></span>
                                                    </div>
                                                    <div>
                                                        <strong class="text-danger fst-italic">Sản phẩm đã bị xóa khỏi hệ thống</strong><br>
                                                        <small class="text-muted">Mã SP cũ: #<?= $item['product_id'] ?></small>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </td>
                                        <td class="text-center align-middle fw-bold"><?= $item['quantity'] ?></td>
                                        <td class="text-end align-middle">
                                            <?= number_format($item['import_price'], 0, ',', '.') ?> đ
                                        </td>
                                        <td class="text-end align-middle fw-bold text-primary">
                                            <?= number_format($item['quantity'] * $item['import_price'], 0, ',', '.') ?> đ
                                        </td>
                                        <?php if (!$is_completed): ?>
                                            <td class="text-center align-middle">
                                                <a href="index.php?controller=AdminReceipt&action=removeDetail&detail_id=<?= $item['id'] ?>&receipt_id=<?= $receipt['id'] ?>" class="text-danger" title="Xóa" onclick="return confirm('Xóa sản phẩm này khỏi phiếu nhập?');">
                                                    <i class="bx bx-trash fs-5"></i>
                                                </a>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4">Phiếu nhập đang trống. Hãy thêm sản phẩm ở trên!</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                        <tfoot>
                            <tr class="bg-light">
                                <td colspan="<?= $is_completed ? '3' : '3' ?>" class="text-end fw-bold fs-5">TỔNG CỘNG:</td>
                                <td colspan="<?= $is_completed ? '1' : '2' ?>" class="text-end fw-bold fs-4 text-danger">
                                    <?= number_format($receipt['total_amount'], 0, ',', '.') ?> VNĐ
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <?php if (!$is_completed): ?>
                    <div class="d-flex justify-content-end mt-4">
                        <?php if (empty($details)): ?>
                            <a href="javascript:void(0)" class="btn btn-secondary btn-lg shadow-sm" onclick="alert('LỖI: Phiếu nhập đang trống! Bạn phải thêm ít nhất 1 sản phẩm mới có thể chốt phiếu.');">
                                <i class="bx bx-check-double me-1"></i> HOÀN THÀNH (CHỐT PHIẾU)
                            </a>
                        <?php else: ?>
                            <form action="index.php?controller=AdminReceipt&action=complete" method="POST" class="text-start" style="width: 350px;">
                                <input type="hidden" name="id" value="<?= $receipt['id'] ?>">

                                <div class="mb-3">
                                    <label for="import_date" class="form-label fw-bold">Ngày nhập kho <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" id="import_date" name="import_date" required>
                                        <button class="btn btn-outline-primary" type="button" id="btn-today">
                                            <i class='bx bx-calendar-star'></i> Hôm nay
                                        </button>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success btn-lg shadow-sm w-100" onclick="return confirm('CẢNH BÁO: Bạn có chắc chắn muốn HOÀN THÀNH phiếu nhập này không? Sau khi hoàn thành, số lượng sẽ được cộng vào kho và KHÔNG THỂ sửa phiếu này nữa!');">
                                    <i class="bx bx-check-double me-1"></i> HOÀN THÀNH (CHỐT PHIẾU)
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

            </div>
        </div>

    </div>
</div>

<?php if (!$is_completed): ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // 1. XỬ LÝ NÚT THÊM SẢN PHẨM QUA AJAX
            const btnAddItem = document.getElementById('btnAddItem');
            if (btnAddItem) {
                btnAddItem.addEventListener('click', function () {
                    const receiptId = document.getElementById('receipt_id').value;
                    const productId = document.getElementById('product_id').value;
                    const quantity = document.getElementById('quantity').value;
                    const importPrice = document.getElementById('import_price').value;

                    if (!productId || !quantity || !importPrice) {
                        alert('Vui lòng nhập đủ thông tin sản phẩm, số lượng và giá nhập!');
                        return;
                    }

                    fetch('index.php?controller=AdminReceipt&action=addDetail', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: `receipt_id=${receiptId}&product_id=${productId}&quantity=${quantity}&import_price=${importPrice}`
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Có lỗi xảy ra khi thêm sản phẩm!');
                        }
                    })
                    .catch(error => alert('Đã xảy ra lỗi kết nối!'));
                });
            }

            // 2. XỬ LÝ NÚT "HÔM NAY" CHO Ô CHỌN NGÀY
            const btnToday = document.getElementById('btn-today');
            const inputDate = document.getElementById('import_date');

            if (btnToday && inputDate) {
                btnToday.addEventListener('click', function () {
                    const today = new Date();
                    const yyyy = today.getFullYear();
                    const mm = String(today.getMonth() + 1).padStart(2, '0');
                    const dd = String(today.getDate()).padStart(2, '0');
                    
                    inputDate.value = `${yyyy}-${mm}-${dd}`;
                });
            }

        });
    </script>
<?php endif; ?>