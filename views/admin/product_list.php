<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center pb-0">
        <h5 class="mb-0">Danh Sách Sản Phẩm</h5>
        <a href="product_form.php" class="btn btn-primary">
            <i class="bx bx-plus me-1"></i>Thêm Mới
        </a>
    </div>
    
    <div class="card-body">
        <!-- Filter/Search bar -->
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input type="text" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option selected>Tất cả danh mục</option>
                    <option>Technic</option>
                    <option>City</option>
                    <option>Star Wars</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option selected>Tất cả trạng thái</option>
                    <option>Đang bán</option>
                    <option>Hết hàng</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th style="width: 80px;">Hình Ảnh</th>
                        <th>Tên Sản Phẩm</th>
                        <th style="width: 120px;">SKU</th>
                        <th style="width: 130px;" class="text-end">Giá Vốn</th>
                        <th style="width: 90px;" class="text-center">Tồn Kho</th>
                        <th style="width: 110px;" class="text-center">Trạng Thái</th>
                        <th style="width: 80px;" class="text-center">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sản phẩm 1 -->
                    <tr>
                        <td><strong>#1</strong></td>
                        <td>
                            <img src="https://via.placeholder.com/60" 
                                 alt="Product" 
                                 class="rounded" 
                                 style="width: 60px; height: 60px; object-fit: cover;">
                        </td>
                        <td>
                            <strong>LEGO Technic 42115</strong>
                            <br>
                            <small class="text-muted">Lamborghini Sián FKP 37</small>
                        </td>
                        <td><code>LEGO-42115</code></td>
                        <td class="text-end">
                            <strong>5.000.000 đ</strong>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-label-success">10</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-success">Đang bán</span>
                        </td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" 
                                        class="btn btn-sm btn-icon btn-outline-secondary dropdown-toggle hide-arrow" 
                                        data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="javascript:void(0);">
                                        <i class="bx bx-show me-1"></i> Xem
                                    </a>
                                    <a class="dropdown-item" href="product_form.php">
                                        <i class="bx bx-edit-alt me-1"></i> Sửa
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="javascript:void(0);">
                                        <i class="bx bx-trash me-1"></i> Xóa
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Sản phẩm 2 -->
                    <tr>
                        <td><strong>#2</strong></td>
                        <td>
                            <img src="https://via.placeholder.com/60" 
                                 alt="Product" 
                                 class="rounded" 
                                 style="width: 60px; height: 60px; object-fit: cover;">
                        </td>
                        <td>
                            <strong>LEGO City 60141</strong>
                            <br>
                            <small class="text-muted">Police Station Set</small>
                        </td>
                        <td><code>LEGO-60141</code></td>
                        <td class="text-end">
                            <strong>2.500.000 đ</strong>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-label-warning">5</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-warning">Sắp hết</span>
                        </td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" 
                                        class="btn btn-sm btn-icon btn-outline-secondary dropdown-toggle hide-arrow" 
                                        data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="javascript:void(0);">
                                        <i class="bx bx-show me-1"></i> Xem
                                    </a>
                                    <a class="dropdown-item" href="product_form.php">
                                        <i class="bx bx-edit-alt me-1"></i> Sửa
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="javascript:void(0);">
                                        <i class="bx bx-trash me-1"></i> Xóa
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Sản phẩm 3 -->
                    <tr>
                        <td><strong>#3</strong></td>
                        <td>
                            <img src="https://via.placeholder.com/60" 
                                 alt="Product" 
                                 class="rounded" 
                                 style="width: 60px; height: 60px; object-fit: cover;">
                        </td>
                        <td>
                            <strong>LEGO Star Wars 75192</strong>
                            <br>
                            <small class="text-muted">Millennium Falcon</small>
                        </td>
                        <td><code>LEGO-75192</code></td>
                        <td class="text-end">
                            <strong>25.000.000 đ</strong>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-label-danger">0</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-secondary">Hết hàng</span>
                        </td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" 
                                        class="btn btn-sm btn-icon btn-outline-secondary dropdown-toggle hide-arrow" 
                                        data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="javascript:void(0);">
                                        <i class="bx bx-show me-1"></i> Xem
                                    </a>
                                    <a class="dropdown-item" href="product_form.php">
                                        <i class="bx bx-edit-alt me-1"></i> Sửa
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="javascript:void(0);">
                                        <i class="bx bx-trash me-1"></i> Xóa
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Sản phẩm 4 -->
                    <tr>
                        <td><strong>#4</strong></td>
                        <td>
                            <img src="https://via.placeholder.com/60" 
                                 alt="Product" 
                                 class="rounded" 
                                 style="width: 60px; height: 60px; object-fit: cover;">
                        </td>
                        <td>
                            <strong>LEGO Creator 10276</strong>
                            <br>
                            <small class="text-muted">Colosseum</small>
                        </td>
                        <td><code>LEGO-10276</code></td>
                        <td class="text-end">
                            <strong>15.000.000 đ</strong>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-label-success">8</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-success">Đang bán</span>
                        </td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" 
                                        class="btn btn-sm btn-icon btn-outline-secondary dropdown-toggle hide-arrow" 
                                        data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="javascript:void(0);">
                                        <i class="bx bx-show me-1"></i> Xem
                                    </a>
                                    <a class="dropdown-item" href="product_form.php">
                                        <i class="bx bx-edit-alt me-1"></i> Sửa
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="javascript:void(0);">
                                        <i class="bx bx-trash me-1"></i> Xóa
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Sản phẩm 5 -->
                    <tr>
                        <td><strong>#5</strong></td>
                        <td>
                            <img src="https://via.placeholder.com/60" 
                                 alt="Product" 
                                 class="rounded" 
                                 style="width: 60px; height: 60px; object-fit: cover;">
                        </td>
                        <td>
                            <strong>LEGO Harry Potter 71043</strong>
                            <br>
                            <small class="text-muted">Hogwarts Castle</small>
                        </td>
                        <td><code>LEGO-71043</code></td>
                        <td class="text-end">
                            <strong>12.000.000 đ</strong>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-label-success">15</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-success">Đang bán</span>
                        </td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" 
                                        class="btn btn-sm btn-icon btn-outline-secondary dropdown-toggle hide-arrow" 
                                        data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="javascript:void(0);">
                                        <i class="bx bx-show me-1"></i> Xem
                                    </a>
                                    <a class="dropdown-item" href="product_form.php">
                                        <i class="bx bx-edit-alt me-1"></i> Sửa
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="javascript:void(0);">
                                        <i class="bx bx-trash me-1"></i> Xóa
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Sản phẩm 6 -->
                    <tr>
                        <td><strong>#6</strong></td>
                        <td>
                            <img src="https://via.placeholder.com/60" 
                                 alt="Product" 
                                 class="rounded" 
                                 style="width: 60px; height: 60px; object-fit: cover;">
                        </td>
                        <td>
                            <strong>LEGO Friends 41685</strong>
                            <br>
                            <small class="text-muted">Magical Funfair Rollercoaster</small>
                        </td>
                        <td><code>LEGO-41685</code></td>
                        <td class="text-end">
                            <strong>3.200.000 đ</strong>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-label-warning">3</span>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-warning">Sắp hết</span>
                        </td>
                        <td class="text-center">
                            <div class="dropdown">
                                <button type="button" 
                                        class="btn btn-sm btn-icon btn-outline-secondary dropdown-toggle hide-arrow" 
                                        data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="javascript:void(0);">
                                        <i class="bx bx-show me-1"></i> Xem
                                    </a>
                                    <a class="dropdown-item" href="product_form.php">
                                        <i class="bx bx-edit-alt me-1"></i> Sửa
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="javascript:void(0);">
                                        <i class="bx bx-trash me-1"></i> Xóa
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                <span class="text-muted">Hiển thị 1-6 trong tổng số 6 sản phẩm</span>
            </div>
            <nav>
                <ul class="pagination pagination-sm m-0">
                    <li class="page-item disabled">
                        <a class="page-link" href="javascript:void(0);">
                            <i class="tf-icon bx bx-chevrons-left"></i>
                        </a>
                    </li>
                    <li class="page-item active">
                        <a class="page-link" href="javascript:void(0);">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="javascript:void(0);">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="javascript:void(0);">3</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="javascript:void(0);">
                            <i class="tf-icon bx bx-chevrons-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>