<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Thêm Sản Phẩm Mới</h5>
            </div>
            <div class="card-body">
                <form action="index.php?controller=AdminProduct&action=store" method="POST"
                    enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="name">Tên sản phẩm</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Ví dụ: LEGO Technic..." required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="sku">Mã SKU</label>
                                <input type="text" class="form-control" id="sku" name="sku" placeholder="LEGO-1234"
                                    required />
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="theme_id">Danh mục (Category) <span
                                        class="text-danger">*</span></label>
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
                                <input type="number" class="form-control" id="piece_count" name="piece_count"
                                    placeholder="Ví dụ: 1200" required />
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold" for="age_range">Độ tuổi phù hợp <span
                                        class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="age_range" name="age_range" min="0"
                                    placeholder="VD: 7, 18..."
                                    value="<?= $isEdit ? htmlspecialchars($product['age_range']) : '' ?>" required />
                                <div id="ageError" class="text-danger mt-1 fw-bold"
                                    style="display: none; font-size: 13px;">
                                    <i class="bx bx-error-circle"></i> Độ tuổi không được là số âm!
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">

                            <div class="mb-3">
                                <label class="form-label" for="profit">Tỉ lệ lợi nhuận (%)</label>
                                <input type="number" step="0.01" class="form-control" id="profit" name="profit_margin"
                                    value="20" required />
                                <div class="form-text">Giá bán sẽ tự động tính dựa trên giá nhập và tỉ lệ này.</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="status">Trạng thái</label>
                                <select id="status" class="form-select" name="status">
                                    <option value="0">Chưa bán</option>
                                    <option value="1">Mở bán</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="image">Hình ảnh</label>
                                <input class="form-control" type="file" id="image" name="image" accept="image/*"
                                    required />
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="desc">Mô tả chi tiết</label>
                        <textarea id="desc" class="form-control" name="description" rows="4"
                            placeholder="Nhập thông tin giới thiệu bộ Lego..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu Sản Phẩm</button>
                    <a href="index.php?controller=AdminProduct&action=index" class="btn btn-secondary">Hủy</a>
                </form>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const ageInput = document.getElementById('age_range');
                        const ageError = document.getElementById('ageError');

                        if (ageInput) {
                            ageInput.addEventListener('blur', function () {
                                if (this.value !== '' && Number(this.value) < 0) {
                                    ageError.style.display = 'block';
                                    this.classList.add('is-invalid');
                                } else {
                                    ageError.style.display = 'none';
                                    this.classList.remove('is-invalid');
                                }
                            });

                            ageInput.addEventListener('input', function () {
                                if (Number(this.value) >= 0) {
                                    ageError.style.display = 'none';
                                    this.classList.remove('is-invalid');
                                }
                            });
                        }
                    });
                </script>
            </div>
        </div>
    </div>
</div>