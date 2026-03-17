<div class="row mt-4">
    <div class="col-xl-10 mx-auto">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom pb-3">
                <h5 class="mb-0 text-primary fw-bold">
                    <i class="bx bx-info-circle me-1"></i> Chi Tiết Sản Phẩm: #<?= $product['id'] ?>
                </h5>
                <div>
                    <a href="index.php?controller=AdminProduct&action=edit&id=<?= $product['id'] ?>" class="btn btn-sm btn-warning me-2">
                        <i class="bx bx-edit-alt me-1"></i> Sửa
                    </a>
                    <a href="index.php?controller=AdminProduct&action=index" class="btn btn-sm btn-outline-secondary">
                        <i class="bx bx-arrow-back me-1"></i> Quay lại
                    </a>
                </div>
            </div>
            
            <div class="card-body mt-4">
                <div class="row">
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        <div class="p-3 border rounded bg-light d-inline-block">
                            <?php if (!empty($product['image'])): ?>
                                <img src="public/admin/assets/images/<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="img-fluid rounded" style="max-height: 350px; object-fit: contain;">
                            <?php else: ?>
                                <div class="text-muted p-5"><i class="bx bx-image fs-1"></i><br>Chưa có hình ảnh</div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <h4 class="fw-bold text-dark mb-3"><?= htmlspecialchars($product['name']) ?></h4>
                        
                        <div class="table-responsive">
                            <table class="table table-borderless table-sm">
                                <tbody>
                                    <tr>
                                        <th style="width: 150px;" class="text-muted">Trạng Thái:</th>
                                        <td>
                                            <?php if ($product['status'] == 1): ?>
                                                <span class="badge bg-success">ĐANG BÁN</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary">CHƯA BÁN</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Mã Sản Phẩm (SKU):</th>
                                        <td><code><?= htmlspecialchars($product['sku']) ?></code></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Danh Mục:</th>
                                        <td><span class="badge bg-label-info"><?= htmlspecialchars($product['theme_name']) ?></span></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Tồn Kho:</th>
                                        <td>
                                            <span class="fw-bold <?= $product['stock_quantity'] > 0 ? 'text-success' : 'text-danger' ?>">
                                                <?= $product['stock_quantity'] ?> cái
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Độ Tuổi:</th>
                                        <td><?= htmlspecialchars($product['age_range']) ?> tuổi</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Số Mảnh Ghép:</th>
                                        <td><?= number_format($product['piece_count'], 0, ',', '.') ?> mảnh</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><hr class="my-2"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Giá Nhập:</th>
                                        <td class="text-danger fw-bold"><?= number_format($product['import_price'], 0, ',', '.') ?> đ</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Tỉ Lệ Lợi Nhuận:</th>
                                        <td><?= $product['profit_margin'] ?> %</td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Giá Bán Đề Xuất:</th>
                                        <td class="text-primary fw-bold fs-5"><?= number_format($selling_price, 0, ',', '.') ?> đ</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><hr class="my-2"></td>
                                    </tr>
                                    <tr>
                                        <th class="text-muted">Ngày Tạo:</th>
                                        <td><small><?= date('d/m/Y H:i:s', strtotime($product['created_at'])) ?></small></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <h6 class="fw-bold border-bottom pb-2">Mô Tả Sản Phẩm</h6>
                        <div class="p-3 bg-light rounded" style="min-height: 100px;">
                            <?php if (!empty(trim($product['description']))): ?>
                                <?= nl2br(htmlspecialchars($product['description'])) ?>
                            <?php else: ?>
                                <em class="text-muted">Chưa có thông tin mô tả cho sản phẩm này.</em>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>