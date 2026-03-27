<div class="card mt-4 mx-auto card-fit-screen" style="max-width: 1200px; width: 100%;">
    <div class="card-header d-flex justify-content-between align-items-center">
    <h5 class="mb-0">Quản Lý Người Dùng</h5>
    
    <?php $currentRole = isset($_GET['role']) ? strtoupper($_GET['role']) : ''; ?>
    <div class="d-flex gap-4 align-items-center">
        <div class="form-check form-check-inline m-0">
            <input class="form-check-input" type="radio" name="role_filter" id="roleAll" 
                   value="" <?= $currentRole === '' ? 'checked' : '' ?> 
                   onchange="window.location.href='index.php?controller=AdminUser&action=index'">
            <label class="form-check-label fw-semibold text-primary" for="roleAll">Tất cả</label>
        </div>
        <div class="form-check form-check-inline m-0">
            <input class="form-check-input" type="radio" name="role_filter" id="roleCustomer" 
                   value="CUSTOMER" <?= $currentRole === 'CUSTOMER' ? 'checked' : '' ?> 
                   onchange="window.location.href='index.php?controller=AdminUser&action=index&role=CUSTOMER'">
            <label class="form-check-label fw-semibold text-secondary" for="roleCustomer">CUSTOMER</label>
        </div>
        <div class="form-check form-check-inline m-0">
            <input class="form-check-input" type="radio" name="role_filter" id="roleAdmin" 
                   value="ADMIN" <?= $currentRole === 'ADMIN' ? 'checked' : '' ?> 
                   onchange="window.location.href='index.php?controller=AdminUser&action=index&role=ADMIN'">
            <label class="form-check-label fw-semibold text-primary" style="color: #696cff !important;" for="roleAdmin">ADMIN</label>
        </div>
    </div>

    <a href="index.php?controller=AdminUser&action=add" class="btn btn-primary">
        <i class="bx bx-plus"></i> Thêm Mới
    </a>
</div>

    <div class="card-body mt-3">
        <div class="table-responsive custom-table-scroll">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th style="width: 50px;">ID</th>
                        <th>Họ và Tên</th>
                        <th>Email / SĐT</th>
                        <th class="text-center">Quyền</th>
                        <th style="width: 140px;" class="text-center">Trạng Thái</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><strong>#<?= $user['id'] ?></strong></td>
                                <td><strong><?= htmlspecialchars($user['fullname']) ?></strong></td>
                                <td>
                                    <?= htmlspecialchars($user['email']) ?><br>
                                    <small class="text-muted"><?= htmlspecialchars($user['phone']) ?></small>
                                </td>
                                <td class="text-center">
                                    <select
                                        class="form-select form-select-sm text-center fw-bold update-role-select <?= $user['role'] == 'admin' ? 'bg-primary text-white' : 'bg-secondary text-white' ?>"
                                        data-id="<?= $user['id'] ?>"
                                        style="width: 120px; margin: 0 auto; border: none; cursor: pointer; padding: 6px 12px; font-size: 12px;">
                                        <option value="customer" <?= $user['role'] == 'customer' ? 'selected' : '' ?>
                                            class="bg-white text-dark">CUSTOMER</option>
                                        <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>
                                            class="bg-white text-dark">ADMIN</option>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select
                                        class="form-select form-select-sm text-center fw-bold update-lock-status <?= $user['is_locked'] == 0 ? 'bg-success text-white' : 'bg-danger text-white' ?>"
                                        data-id="<?= $user['id'] ?>"
                                        style="width: 120px; margin: 0 auto; border: none; cursor: pointer;">
                                        <option value="0" <?= $user['is_locked'] == 0 ? 'selected' : '' ?>
                                            class="bg-white text-dark">HOẠT ĐỘNG</option>
                                        <option value="1" <?= $user['is_locked'] == 1 ? 'selected' : '' ?>
                                            class="bg-white text-dark">BỊ KHÓA</option>
                                    </select>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-4">Chưa có người dùng nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lockSelects = document.querySelectorAll('.update-lock-status');

        lockSelects.forEach(select => {
            select.addEventListener('change', function () {
                const userId = this.getAttribute('data-id');
                const isLocked = this.value;
                const selectElement = this;

                if (isLocked == '1' && !confirm('Bạn có chắc chắn muốn KHÓA tài khoản này? Người này sẽ không thể đăng nhập.')) {
                    selectElement.value = '0';
                    return;
                }

                if (isLocked == '0') {
                    selectElement.classList.remove('bg-danger');
                    selectElement.classList.add('bg-success');
                } else {
                    selectElement.classList.remove('bg-success');
                    selectElement.classList.add('bg-danger');
                }

                fetch('index.php?controller=AdminUser&action=updateStatus', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `id=${userId}&is_locked=${isLocked}`
                })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) alert('Lỗi: Không thể cập nhật trạng thái khóa!');
                    })
                    .catch(error => alert('Đã xảy ra lỗi kết nối!'));
            });
        });
        // === XỬ LÝ AJAX ĐỔI QUYỀN (ROLE) ===
        const roleSelects = document.querySelectorAll('.update-role-select');

        roleSelects.forEach(select => {
            select.addEventListener('change', function () {
                const userId = this.getAttribute('data-id');
                const newRole = this.value;
                const selectElement = this;

                if (newRole === 'admin' && !confirm('Bạn có chắc chắn muốn cấp quyền Quản Trị Viên (Admin) cho người này?')) {
                    selectElement.value = 'customer';
                    return;
                }

                 
                if (newRole === 'admin') {
                    selectElement.classList.remove('bg-secondary');
                    selectElement.classList.add('bg-primary');
                } else {
                    selectElement.classList.remove('bg-primary');
                    selectElement.classList.add('bg-secondary');
                }

                fetch('index.php?controller=AdminUser&action=updateRole', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: `id=${userId}&role=${newRole}`
                })
                    .then(response => response.json())
                    .then(data => {
                        if (!data.success) alert('Lỗi: Không thể cập nhật quyền người dùng!');
                    })
                    .catch(error => alert('Đã xảy ra lỗi kết nối!'));
            });
        });
    });
</script>