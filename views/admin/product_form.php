<div class="row">
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Thêm Sản Phẩm Mới</h5>
            </div>
            <div class="card-body">
                <form action="index.php?controller=product&action=store" method="POST" enctype="multipart/form-data">
                    
                    <!-- Tên SP -->
                    <div class="mb-3">
                        <label class="form-label" for="name">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Ví dụ: LEGO Technic..." required />
                    </div>

                    <!-- Mã SKU -->
                    <div class="mb-3">
                        <label class="form-label" for="sku">Mã SKU</label>
                        <input type="text" class="form-control" id="sku" name="sku" placeholder="LEGO-1234" />
                    </div>

                    <!-- Danh mục -->
                    <div class="mb-3">
                        <label class="form-label" for="category">Danh mục</label>
                        <select id="category" class="form-select" name="category_id">
                            <option value="1">Technic</option>
                            <option value="2">City</option>
                            <option value="3">Star Wars</option>
                        </select>
                    </div>

                    <!-- % Lợi nhuận -->
                    <div class="mb-3">
                        <label class="form-label" for="profit">Tỉ lệ lợi nhuận (%)</label>
                        <input type="number" class="form-control" id="profit" name="profit_margin" value="20" />
                        <div class="form-text">Giá bán sẽ tự động tính dựa trên giá nhập và tỉ lệ này.</div>
                    </div>

                    <!-- Hình ảnh -->
                    <div class="mb-3">
                        <label class="form-label" for="image">Hình ảnh</label>
                        <input class="form-control" type="file" id="image" name="image" />
                    </div>

                    <!-- Mô tả -->
                    <div class="mb-3">
                        <label class="form-label" for="desc">Mô tả chi tiết</label>
                        <textarea id="desc" class="form-control" name="description" rows="3"></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu Sản Phẩm</button>
                    <a href="index.php?controller=product&action=index" class="btn btn-secondary">Hủy</a>
                </form>
            </div>
        </div>
    </div>
</div>

