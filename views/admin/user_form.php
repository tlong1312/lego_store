<div class="row mt-4">
    <div class="col-xl-8 col-lg-10 mx-auto"> 
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Thêm Người Dùng Mới</h5>
                <a href="index.php?controller=AdminUser&action=index" class="btn btn-sm btn-outline-secondary"><i class="bx bx-arrow-back me-1"></i> Quay lại</a>
            </div>
            
            <div class="card-body">
                <form action="index.php?controller=AdminUser&action=store" method="POST">
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Họ và tên (Fullname) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="fullname" required autofocus />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" required />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Số điện thoại</label>
                            <input type="text" class="form-control" name="phone" />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Quyền (Role)</label>
                            <select class="form-select" name="role">
                                <option value="customer">Khách hàng (Customer)</option>
                                <option value="admin">Quản trị viên (Admin)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Địa chỉ</label>
                        <input type="text" class="form-control" name="address" />
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Khởi tạo Mật khẩu</label>
                        <input type="text" class="form-control" name="password" placeholder="Nhập mật khẩu..." />
                        <div class="form-text text-primary">Nếu để trống, hệ thống sẽ tự động khởi tạo mật khẩu mặc định là <strong>123456</strong>.</div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Tạo Tài Khoản</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>