<?php
$errors = $_SESSION['register_errors'] ?? [];
$old = $_SESSION['old_data'] ?? [];

unset($_SESSION['register_errors']);
unset($_SESSION['old_data']);
?>

<style>
    .nice-select .list {
        max-height: 250px !important;
        overflow-y: auto !important;
        width: 100% !important;
    }

    .nice-select {
        width: 100% !important;
        height: 50px !important;
        margin-bottom: 24px !important;

        display: flex !important;
        align-items: center !important;
    }

    .nice-select .current {
        line-height: normal !important;
    }
</style>

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Đăng Ký</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php?controller=home&action=index">Trang chủ</a>
                        <span>Đăng ký</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="checkout spad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-10">

                <div
                    style="background: #fff; border: 1px solid #e8e8e8; box-shadow: 0 8px 40px rgba(0,0,0,0.08); padding: 50px 45px 40px;">

                    <div class="text-center mb-4">
                        <div
                            style="width: 64px; height: 64px; background: #111; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 16px;">
                            <i class="fa fa-user-plus" style="color:#fff; font-size:24px;"></i>
                        </div>
                        <h5 style="font-weight:800; letter-spacing:2px; text-transform:uppercase; margin:0;">Tạo Tài
                            Khoản</h5>
                        <p style="color:#aaa; font-size:13px; margin-top:6px;">Tham gia LEGO Store ngay hôm nay</p>
                    </div>

                    <form action="index.php?controller=auth&action=processRegister" method="POST" novalidate>

                        <div class="checkout__input">
                            <p>Họ và tên <span>*</span></p>
                            <input type="text" name="fullname" placeholder="Nguyễn Văn A"
                                style="color: #111; <?= isset($errors['fullname']) ? 'border: 1px solid #e53637;' : '' ?>"
                                value="<?= htmlspecialchars($old['fullname'] ?? '') ?>" required>
                            <?php if (isset($errors['fullname'])): ?>
                                <div
                                    style="color: #e53637; font-size: 13px; margin-top: -15px; margin-bottom: 15px; font-style: italic;">
                                    <?= $errors['fullname'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="checkout__input">
                            <p>Email <span>*</span></p>
                            <input type="email" name="email" placeholder="example@email.com"
                                style="color: #111; <?= isset($errors['email']) ? 'border: 1px solid #e53637;' : '' ?>"
                                value="<?= htmlspecialchars($old['email'] ?? '') ?>" required>
                            <?php if (isset($errors['email'])): ?>
                                <div
                                    style="color: #e53637; font-size: 13px; margin-top: -15px; margin-bottom: 15px; font-style: italic;">
                                    <?= $errors['email'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkout__input">
                                    <p>Mật khẩu <span>*</span></p>
                                    <input type="password" name="password" placeholder="••••••••"
                                        style="color: #111; <?= isset($errors['password']) ? 'border: 1px solid #e53637;' : '' ?>"
                                        minlength="6" required>
                                    <?php if (isset($errors['password'])): ?>
                                        <div
                                            style="color: #e53637; font-size: 13px; margin-top: -15px; margin-bottom: 15px; font-style: italic;">
                                            <?= $errors['password'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout__input">
                                    <p>Xác nhận mật khẩu <span>*</span></p>
                                    <input type="password" name="confirm_password" placeholder="••••••••"
                                        style="color: #111; <?= isset($errors['confirm_password']) ? 'border: 1px solid #e53637;' : '' ?>"
                                        minlength="6" required>
                                    <?php if (isset($errors['confirm_password'])): ?>
                                        <div
                                            style="color: #e53637; font-size: 13px; margin-top: -15px; margin-bottom: 15px; font-style: italic;">
                                            <?= $errors['confirm_password'] ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="checkout__input">
                            <p>Số điện thoại <span>*</span></p>
                            <input type="tel" name="phone" placeholder="0912 345 678"
                                style="color: #111; <?= isset($errors['phone']) ? 'border: 1px solid #e53637;' : '' ?>"
                                value="<?= htmlspecialchars($old['phone'] ?? '') ?>" required>
                            <?php if (isset($errors['phone'])): ?>
                                <div
                                    style="color: #e53637; font-size: 13px; margin-top: -15px; margin-bottom: 15px; font-style: italic;">
                                    <?= $errors['phone'] ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="checkout__input">
                                    <p>Tỉnh/Thành <span>*</span></p>
                                    <select id="province" class="form-control" name="province" required>
                                        <option value="">Chọn Tỉnh/Thành</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout__input">
                                    <p>Phường/Xã <span>*</span></p>
                                    <select id="ward" name="ward" class="form-control" required>
                                        <option value="">Chọn Phường/Xã</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="checkout__input">
                            <p>Số nhà, Tên đường <span>*</span></p>
                            <input type="text" name="address" placeholder="Ví dụ: 123 Đường ABC" style="color: #111;"
                                value="<?= htmlspecialchars($old['address'] ?? '') ?>" required>
                        </div>

                        <input type="hidden" id="province_name" name="province_name">
                        <input type="hidden" id="ward_name" name="ward_name">
                        <button type="submit" class="site-btn w-100"
                            style="padding:15px; font-size:13px; letter-spacing:3px; cursor:pointer;">
                            TẠO TÀI KHOẢN
                        </button>
                    </form>

                    <hr style="margin: 28px 0; border-color:#f0f0f0;">

                    <p class="text-center" style="font-size:13px; color:#777; margin:0;">
                        Đã có tài khoản?
                        <a href="index.php?controller=auth&action=login"
                            style="color:#111; font-weight:700; text-decoration:underline;">
                            Đăng nhập ngay
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {

        function validateInput($input, condition, errorMessage) {
            $input.on('input', function () {
                $(this).css('border', '1px solid #e1e1e1');
                $(this).closest('.checkout__input').find('.error-msg').remove();
            });

            if (condition) {
                if (!$input.closest('.checkout__input').find('.error-msg').length) {
                    $input.css('border', '1px solid #e53637');
                    $input.after(`<div class="error-msg" style="color: #e53637; font-size: 13px; margin-top: -15px; margin-bottom: 15px; font-style: italic;">${errorMessage}</div>`);
                }
                return false;
            }
            return true;
        }

        function validateSelect($select, errorMessage) {
            $select.on('change', function () {
                $(this).next('.nice-select').css('border', '1px solid #e1e1e1');
                $(this).closest('.checkout__input').find('.error-msg').remove();
            });

            if (!$select.val()) {
                if (!$select.closest('.checkout__input').find('.error-msg').length) {
                    $select.next('.nice-select').css('border', '1px solid #e53637');
                    $select.closest('.checkout__input').append(`<div class="error-msg" style="color: #e53637; font-size: 13px; margin-top: -15px; margin-bottom: 15px; font-style: italic;">${errorMessage}</div>`);
                }
                return false;
            }
            return true;
        }

        $.ajax({
            url: "https://provinces.open-api.vn/api/v2/p/",
            method: "GET",
            success: function (data) {
                let options = '<option value="">Chọn Tỉnh/Thành</option>';
                data.forEach(item => {
                    options += `<option value="${item.code}">${item.name}</option>`;
                });
                $("#province").html(options).niceSelect('update');
            }
        });

        $("#province").change(function () {
            let province_code = $(this).val();
            $("#province_name").val($("#province option:selected").text());

            if (province_code) {
                $.ajax({
                    url: `https://provinces.open-api.vn/api/v2/p/${province_code}?depth=2`,
                    method: "GET",
                    success: function (data) {
                        let options = '<option value="">Chọn Phường/Xã</option>';
                        data.wards.forEach(item => {
                            options += `<option value="${item.code}">${item.name}</option>`;
                        });
                        $("#ward").html(options).niceSelect('update');
                    }
                });
            } else {
                $("#ward").html('<option value="">Chọn Phường/Xã</option>').niceSelect('update');
            }
        });

        $("#ward").change(function () {
            $("#ward_name").val($("#ward option:selected").text());
        });

        $('form').on('submit', function(e) {
            let formIsValid = true;

            $('.error-msg').remove();
            $('input, .nice-select').css('border', '1px solid #e1e1e1');

            formIsValid &= validateInput($('input[name="fullname"]'), !$('input[name="fullname"]').val().trim(), 'Vui lòng nhập họ và tên!');
            formIsValid &= validateInput($('input[name="email"]'), !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test($('input[name="email"]').val()), 'Email không đúng định dạng!');

            let password = $('input[name="password"]').val();
            formIsValid &= validateInput($('input[name="password"]'), password.length < 6, 'Mật khẩu phải có ít nhất 6 ký tự!');
            formIsValid &= validateInput($('input[name="confirm_password"]'), $('input[name="confirm_password"]').val() !== password, 'Mật khẩu xác nhận không khớp!');

            formIsValid &= validateInput($('input[name="phone"]'), !/^(0[35789][0-9]{8})$/.test($('input[name="phone"]').val()), 'Số điện thoại phải gồm 10 số (Bắt đầu bằng 03, 05, 07, 08, 09)!');
            formIsValid &= validateInput($('input[name="address"]'), !$('input[name="address"]').val().trim(), 'Vui lòng nhập số nhà, tên đường!');

            formIsValid &= validateSelect($("#province"), 'Vui lòng chọn Tỉnh/Thành!');
            formIsValid &= validateSelect($("#ward"), 'Vui lòng chọn Phường/Xã!');

            if (!formIsValid) {
                e.preventDefault();
                return false;
            }
        });
    });
</script>