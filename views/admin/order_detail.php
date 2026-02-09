<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center pb-0">
        <h5 class="mb-0">Danh Sách Đơn Hàng</h5>
    </div>
    
    <div class="card-body">
        <!-- Filter/Search bar -->
        <div class="row mb-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text"><i class="bx bx-search"></i></span>
                    <input type="text" class="form-control" placeholder="Tìm kiếm đơn hàng...">
                </div>
            </div>
            <div class="col-md-3">
                <select class="form-select">
                    <option selected>Tất cả trạng thái</option>
                    <option>Chờ xử lý</option>
                    <option>Đã xác nhận</option>
                    <option>Đang giao</option>
                    <option>Hoàn thành</option>
                    <option>Đã hủy</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th style="width: 100px;">Mã ĐH</th>
                        <th>Khách Hàng</th>
                        <th style="width: 130px;">Ngày Đặt</th>
                        <th style="width: 150px;" class="text-end">Tổng Tiền</th>
                        <th style="width: 130px;" class="text-center">Trạng Thái</th>
                        <th style="width: 80px;" class="text-center">Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>#DH001</strong></td>
                        <td>
                            <strong>Nguyễn Văn A</strong><br>
                            <small class="text-muted">0909 123 456</small>
                        </td>
                        <td>20/10/2025</td>
                        <td class="text-end"><strong>13.000.000 đ</strong></td>
                        <td class="text-center">
                            <span class="badge bg-warning">Chờ xử lý</span>
                        </td>
                        <td class="text-center">
                            <a href="order_detail.php" class="btn btn-sm btn-icon btn-outline-primary">
                                <i class="bx bx-show"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>#DH002</strong></td>
                        <td>
                            <strong>Trần Thị B</strong><br>
                            <small class="text-muted">0912 345 678</small>
                        </td>
                        <td>21/10/2025</td>
                        <td class="text-end"><strong>8.500.000 đ</strong></td>
                        <td class="text-center">
                            <span class="badge bg-info">Đã xác nhận</span>
                        </td>
                        <td class="text-center">
                            <a href="order_detail.php" class="btn btn-sm btn-icon btn-outline-primary">
                                <i class="bx bx-show"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>#DH003</strong></td>
                        <td>
                            <strong>Lê Văn C</strong><br>
                            <small class="text-muted">0923 456 789</small>
                        </td>
                        <td>22/10/2025</td>
                        <td class="text-end"><strong>25.000.000 đ</strong></td>
                        <td class="text-center">
                            <span class="badge bg-primary">Đang giao</span>
                        </td>
                        <td class="text-center">
                            <a href="order_detail.php" class="btn btn-sm btn-icon btn-outline-primary">
                                <i class="bx bx-show"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>#DH004</strong></td>
                        <td>
                            <strong>Phạm Thị D</strong><br>
                            <small class="text-muted">0934 567 890</small>
                        </td>
                        <td>23/10/2025</td>
                        <td class="text-end"><strong>5.500.000 đ</strong></td>
                        <td class="text-center">
                            <span class="badge bg-success">Hoàn thành</span>
                        </td>
                        <td class="text-center">
                            <a href="order_detail.php" class="btn btn-sm btn-icon btn-outline-primary">
                                <i class="bx bx-show"></i>
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>#DH005</strong></td>
                        <td>
                            <strong>Hoàng Văn E</strong><br>
                            <small class="text-muted">0945 678 901</small>
                        </td>
                        <td>24/10/2025</td>
                        <td class="text-end"><strong>3.200.000 đ</strong></td>
                        <td class="text-center">
                            <span class="badge bg-secondary">Đã hủy</span>
                        </td>
                        <td class="text-center">
                            <a href="order_detail.php" class="btn btn-sm btn-icon btn-outline-primary">
                                <i class="bx bx-show"></i>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-between align-items-center mt-3">
            <div>
                <span class="text-muted">Hiển thị 1-5 trong tổng số 5 đơn hàng</span>
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
                        <a class="page-link" href="javascript:void(0);">
                            <i class="tf-icon bx bx-chevrons-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>