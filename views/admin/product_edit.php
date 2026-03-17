<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Chỉnh Sửa Sản Phẩm: <?= htmlspecialchars($product['name']) ?></h5>
            </div>
            <div class="card-body">
                <form action="index.php?controller=AdminProduct&action=update" method="POST" enctype="multipart/form-data">
                    
                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                    <input type="hidden" name="old_image" value="<?= $product['image'] ?>">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="name">Tên sản phẩm</label>
                                <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($product['name']) ?>" required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="sku">Mã SKU</label>
                                <input type="text" class="form-control" name="sku" value="<?= htmlspecialchars($product['sku']) ?>" required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="theme_id">Danh mục (Theme)</label>
                                <select id="theme_id" class="form-select" name="theme_id" required>
                                    <option value="">-- Chọn danh mục Lego --</option>

                                    <?php if (!empty($categories)): ?>
                                        <?php foreach ($categories as $cat): ?>
                                            <option value="<?= $cat['id'] ?>" <?= (isset($product['theme_id']) && $product['theme_id'] == $cat['id']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($cat['name']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <option value="" disabled>Chưa có danh mục nào (Hãy thêm danh mục trước)</option>
                                    <?php endif; ?>

                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="piece_count">Số mảnh ghép</label>
                                <input type="number" class="form-control" name="piece_count" value="<?= $product['piece_count'] ?>" required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="age_range">Độ tuổi</label>
                                <input type="text" class="form-control" name="age_range" value="<?= htmlspecialchars($product['age_range']) ?>" required />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="stock_quantity">Số lượng tồn kho</label>
                                <input type="number" min="0" class="form-control" name="stock_quantity" value="<?= $product['stock_quantity'] ?>" required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="import_price">Giá nhập (VNĐ)</label>
                                <input type="number" step="0.01" class="form-control" name="import_price" value="<?= $product['import_price'] ?>" required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="profit_margin">Tỉ lệ lợi nhuận (%)</label>
                                <input type="number" step="0.01" class="form-control" name="profit_margin" value="<?= $product['profit_margin'] ?>" required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="status">Trạng thái</label>
                                <select class="form-select" name="status">
                                    <option value="1" <?= $product['status'] == 1 ? 'selected' : '' ?>>Đang bán</option>
                                    <option value="0" <?= $product['status'] == 0 ? 'selected' : '' ?>>Chưa bán</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="image">Hình ảnh mới (Bỏ trống nếu giữ nguyên ảnh cũ)</label>
                                <input class="form-control mb-2" type="file" name="image" accept="image/*" />
                                
                                <small class="text-muted d-block">Ảnh hiện tại:</small>
                                <img src="public/admin/assets/images/<?= htmlspecialchars($product['image']) ?>" alt="Current Image" style="height: 60px; border-radius: 5px;">
                            </div>
                        </div>
                    </div>

                    <div class="mb-4 mt-2">
                        <label class="form-label" for="desc">Mô tả chi tiết</label>
                        <textarea class="form-control" name="description" rows="4"><?= htmlspecialchars($product['description']) ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-warning text-dark fw-bold">Cập Nhật Sản Phẩm</button>
                    <a href="index.php?controller=AdminProduct&action=index" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
</div>