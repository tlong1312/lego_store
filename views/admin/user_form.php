<div class="row mt-4">
    <div class="col-xl-8 col-lg-10 mx-auto">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Thêm Người Dùng Mới</h5>
                <a href="index.php?controller=AdminUser&action=index" class="btn btn-sm btn-outline-secondary"><i
                        class="bx bx-arrow-back me-1"></i> Quay lại</a>
            </div>

            <div class="card-body">

                <form id="userForm" action="index.php?controller=AdminUser&action=store" method="POST">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" for="fullname">Họ và tên (Fullname) <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="fullname" name="fullname"
                                placeholder="VD: Nguyễn Văn A" required autofocus />
                            <div id="fullnameError" class="text-danger mt-1 fw-bold"
                                style="display: none; font-size: 13px;">
                                <i class="bx bx-error-circle"></i> Vui lòng nhập Họ và tên.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" for="email">Email <span
                                    class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="VD: ten@gmail.com" required />
                            <div id="emailError" class="text-danger mt-1 fw-bold"
                                style="display: none; font-size: 13px;">
                                <i class="bx bx-error-circle"></i> Email không đúng định dạng (VD: ten@gmail.com).
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" for="phone">Số Điện Thoại <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="VD: 0912345678"
                                required />
                            <div id="phoneError" class="text-danger mt-1 fw-bold"
                                style="display: none; font-size: 13px;">
                                <i class="bx bx-error-circle"></i> Số điện thoại không hợp lệ (Phải có 10 số và bắt đầu
                                bằng 03, 05, 07, 08, 09).
                            </div>
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
                        <div class="form-text text-primary">Nếu để trống, hệ thống sẽ tự động khởi tạo mật khẩu mặc định
                            là <strong>123456</strong>.</div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="bx bx-save me-1"></i> Tạo Tài Khoản
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        function showError(inputElement, errorElement, isError) {
            if (isError) {
                errorElement.style.display = 'block';
                inputElement.classList.add('is-invalid');
            } else {
                errorElement.style.display = 'none';
                inputElement.classList.remove('is-invalid');
            }
        }

         
        const fullnameInput = document.getElementById('fullname');
        const fullnameError = document.getElementById('fullnameError');
        if (fullnameInput) {
            fullnameInput.addEventListener('blur', function () {
                showError(this, fullnameError, this.value.trim() === '');
            });
            fullnameInput.addEventListener('input', function () {
                showError(this, fullnameError, false);
            });
        }

         
        const phoneInput = document.getElementById('phone');
        const phoneError = document.getElementById('phoneError');
        const phoneRegex = /^0[35789][0-9]{8}$/;
        if (phoneInput) {
            phoneInput.addEventListener('blur', function () {
                const val = this.value.trim();
                showError(this, phoneError, val !== '' && !phoneRegex.test(val));
            });
            phoneInput.addEventListener('input', function () {
                showError(this, phoneError, false);
            });
        }

         
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('emailError');
        const emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (emailInput) {
            emailInput.addEventListener('blur', function () {
                const val = this.value.trim();
                const isError = val !== '' && !emailRegex.test(val);
                if (isError) {
                    emailError.innerHTML = '<i class="bx bx-error-circle"></i> Email không đúng định dạng (VD: ten@gmail.com).';
                }
                showError(this, emailError, isError);

                if (!isError && val !== '') {
                    const userIdInput = document.querySelector('input[name="id"]');
                    let requestBody = `email=${encodeURIComponent(val)}`;
                    if (userIdInput) requestBody += `&id=${userIdInput.value}`;

                    fetch('index.php?controller=AdminUser&action=checkEmail', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                        body: requestBody
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.status === 'exists') {
                                emailError.innerHTML = '<i class="bx bx-error-circle"></i> Email này đã được đăng ký. Vui lòng sử dụng email khác.';
                                showError(emailInput, emailError, true);
                            }
                        });
                }
            });
            emailInput.addEventListener('input', function () {
                showError(this, emailError, false);
                emailError.innerHTML = '<i class="bx bx-error-circle"></i> Email không đúng định dạng (VD: ten@gmail.com).';
            });
        }


         
        const userForm = document.getElementById('userForm');
        if (userForm) {
            userForm.addEventListener('submit', function (e) {
                e.preventDefault();
                if (fullnameInput) fullnameInput.dispatchEvent(new Event('blur'));
                if (phoneInput) phoneInput.dispatchEvent(new Event('blur'));

                const emailVal = emailInput.value.trim();
                const isEmailFormatError = emailVal === '' || !emailRegex.test(emailVal);

                if (isEmailFormatError) {
                    emailInput.dispatchEvent(new Event('blur'));
                    return;
                }

                const invalidInputs = document.querySelectorAll('.is-invalid');
                if (invalidInputs.length > 0) {
                    return;
                }

                const userIdInput = document.querySelector('input[name="id"]');
                let requestBody = `email=${encodeURIComponent(emailVal)}`;
                if (userIdInput) requestBody += `&id=${userIdInput.value}`;

                fetch('index.php?controller=AdminUser&action=checkEmail', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: requestBody
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'exists') {
                            emailError.innerHTML = '<i class="bx bx-error-circle"></i> Email này đã được đăng ký. Vui lòng sử dụng email khác.';
                            showError(emailInput, emailError, true);
                        } else {
                            userForm.submit();
                        }
                    });
            });
        }
    });
</script>