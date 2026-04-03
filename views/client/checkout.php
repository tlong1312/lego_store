<style>
    .nice-select {
        width: 100% !important;
        height: 50px !important;
        line-height: 50px !important;
        margin-bottom: 20px; /* Thêm khoảng cách dưới */
    }
    .nice-select .list {
        width: 100% !important;
    }
    .error-msg {
        color: #e53637;
        font-size: 13px;
        margin-top: -15px;
        margin-bottom: 15px;
        font-style: italic;
    }
    /* Thêm style cho input bị vô hiệu hóa để trông đẹp hơn */
    input[type="text"]:read-only {
    background-color: #e9ecef;
    cursor: not-allowed;
}

    /* Make new address form text clearly readable (black) */
    #new_address_section input,
    #new_address_section select,
    #new_address_section textarea {
        color: #111111 !important;
    }

    #new_address_section input::placeholder,
    #new_address_section textarea::placeholder {
        color: #6b7280 !important;
    }

    #new_address_section .nice-select,
    #new_address_section .nice-select .current {
        color: #111111 !important;
    }
</style>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Thanh Toán</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php?controller=home&action=index">Trang chủ</a>
                        <span>Thanh toán</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <form action="index.php?controller=cart&action=processCheckout" method="POST" id="checkout-form" novalidate>
                <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <h6 class="checkout__title">Thông tin giao hàng</h6>

                        <!-- Lựa chọn địa chỉ -->
                        <div class="checkout__input mb-4" style="background: #f5f5f5; padding: 15px; border-radius: 5px;">
                            <label class="mr-3" style="cursor: pointer;">
                                <input type="radio" name="address_option" value="account" onclick="toggleAddressSection(true)" checked>
                                <span style="font-weight: bold; color: #111;">Dùng thông tin tài khoản</span>
                            </label>
                            <label style="cursor: pointer;">
                                <input type="radio" name="address_option" value="new" onclick="toggleAddressSection(false)">
                                <span style="font-weight: bold; color: #111;">Giao đến địa chỉ mới</span>
                            </label>
                        </div>

                        <!-- Phần địa chỉ tài khoản -->
                        <div id="account_address_section">
                            <div class="checkout__input">
                                <p>Họ và tên người nhận<span>*</span></p>
                                <input type="text" id="acc_fullname" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" required readonly>
                            </div>
                             <div class="checkout__input">
                                <p>Số điện thoại<span>*</span></p>
                                <input type="text" id="acc_phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required readonly>
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ (Số nhà, tên đường)<span>*</span></p>
                                <input type="text" id="acc_address" name="address" value="<?= htmlspecialchars($user['address']) ?>" required readonly>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="checkout__input">
                                        <p>Tỉnh/Thành</p>
                                        <input type="text" value="<?= htmlspecialchars($user['province']) ?>" disabled>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout__input">
                                        <p>Phường/Xã</p>
                                        <input type="text" value="<?= htmlspecialchars($user['ward']) ?>" disabled>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="acc_province_name" name="province_name" value="<?= htmlspecialchars($user['province']) ?>">
                            <input type="hidden" id="acc_ward_name" name="ward_name" value="<?= htmlspecialchars($user['ward']) ?>">
                        </div>

                        <!-- Phần địa chỉ mới (ẩn ban đầu) -->
                        <div id="new_address_section" style="display: none;">
                             <div class="checkout__input">
                                <p>Họ và tên người nhận<span>*</span></p>
                                <input type="text" id="new_fullname" name="fullname_new" >
                            </div>
                             <div class="checkout__input">
                                <p>Số điện thoại<span>*</span></p>
                                <input type="text" id="new_phone" name="phone_new" >
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="checkout__input">
                                        <p>Tỉnh/Thành <span>*</span></p>
                                        <select id="province" name="province_new">
                                            <option value="">Chọn Tỉnh/Thành</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="checkout__input">
                                        <p>Phường/Xã <span>*</span></p>
                                        <select id="ward" name="ward_new">
                                            <option value="">Chọn Phường/Xã</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Địa chỉ (Số nhà, tên đường)<span>*</span></p>
                                <input type="text" id="new_address" name="address_new">
                            </div>
                             <input type="hidden" id="new_province_name" name="province_name_new">
                             <input type="hidden" id="new_ward_name" name="ward_name_new">
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4 class="order__title">Đơn hàng của bạn</h4>
                            <div class="checkout__order__products">Sản phẩm <span>Thành tiền</span></div>
                            <ul class="checkout__total__products">
                                <?php
                                $total = 0;
                                foreach ($cart as $item) :
                                    $sub = $item['price'] * $item['quantity'];
                                    $total += $sub;
                                ?>
                                    <li><?= htmlspecialchars($item['name']) ?> (x<?= $item['quantity'] ?>) <span><?= number_format($sub, 0, ',', '.') ?>đ</span></li>
                                <?php endforeach; ?>
                            </ul>
                            <ul class="checkout__total__all">
                                <li>Tổng thanh toán <span><?= number_format($total, 0, ',', '.') ?>đ</span></li>
                            </ul>

                            <div class="checkout__input__checkbox">
                                <label for="payment">
                                    Tiền mặt khi nhận hàng (COD)
                                    <input type="radio" id="payment" name="payment_method" value="COD" onclick="hideBankInfo()" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="paypal">
                                    Chuyển khoản ngân hàng
                                    <input type="radio" id="paypal" name="payment_method" value="Chuyển khoản" onclick="showBankInfo()">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div id="bank_info_box" style="display: none; background: #e9ecef; padding: 15px; margin-bottom: 20px; border-left: 4px solid #111;">
                                <p class="mb-1"><strong>Ngân hàng:</strong> Vietcombank</p>
                                <p class="mb-1"><strong>STK:</strong> 0123456789</p>
                                <p class="mb-0"><strong>Chủ TK:</strong> LEGO STORE</p>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="vnpay">
                                    Thanh toán Online (VNPAY)
                                    <input type="radio" id="vnpay" name="payment_method" value="VNPAY Online" onclick="hideBankInfo()">
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                            <button type="submit" class="site-btn">XÁC NHẬN ĐẶT HÀNG</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!-- Checkout Section End -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function toggleAddressSection(isAccount) {
        $('.error-msg').remove();
        $('input, .nice-select').css('border', '');

        const accountInputs = $('#acc_fullname, #acc_phone, #acc_address');

        if (isAccount) {
            $('#account_address_section').show();
            $('#new_address_section').hide();
            // Vô hiệu hóa việc sửa, nhưng vẫn gửi dữ liệu đi
            accountInputs.prop('readonly', true);
        } else {
            $('#account_address_section').hide();
            $('#new_address_section').show();
            // Cho phép sửa lại nếu người dùng quay lại
            accountInputs.prop('readonly', false);
        }
    }

    function showBankInfo() { document.getElementById('bank_info_box').style.display = 'block'; }
    function hideBankInfo() { document.getElementById('bank_info_box').style.display = 'none'; }

    $(document).ready(function() {
        // --- Logic cho địa chỉ mới ---
        $('#province, #ward').niceSelect();

        $.ajax({
            url: "https://provinces.open-api.vn/api/v2/p/",
            method: "GET",
            success: function(data) {
                let options = '<option value="">Chọn Tỉnh/Thành</option>';
                data.forEach(item => {
                    options += `<option value="${item.code}">${item.name}</option>`;
                });
                $("#province").html(options).niceSelect('update');
            }
        });

        $("#province").change(function() {
            let province_code = $(this).val();
            let province_name = $("#province option:selected").text();
            $('#new_province_name').val(province_name);

            if (province_code) {
                 $.ajax({
                    url: `https://provinces.open-api.vn/api/v2/p/${province_code}?depth=2`,
                    method: "GET",
                    success: function(data) {
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

        $("#ward").change(function() {
            let ward_name = $("#ward option:selected").text();
            $('#new_ward_name').val(ward_name);
        });

        // --- Logic VALIDATE ---
        function validateInput($input, condition, errorMessage) {
            $input.on('input', function() {
                $(this).css('border', '');
                $(this).closest('.checkout__input').find('.error-msg').remove();
            });
            if (condition) {
                if (!$input.closest('.checkout__input').find('.error-msg').length) {
                    $input.css('border', '1px solid #e53637');
                    $input.after(`<div class="error-msg">${errorMessage}</div>`);
                }
                return false;
            }
            return true;
        }

        function validateSelect($select, errorMessage) {
            $select.on('change', function() {
                $(this).next('.nice-select').css('border', '');
                $(this).closest('.checkout__input').find('.error-msg').remove();
            });
            if (!$select.val()) {
                if (!$select.closest('.checkout__input').find('.error-msg').length) {
                    $select.next('.nice-select').css('border', '1px solid #e53637');
                    $select.closest('.checkout__input').append(`<div class="error-msg">${errorMessage}</div>`);
                }
                return false;
            }
            return true;
        }

        $('#checkout-form').on('submit', function(e) {
            let formIsValid = true;
            const isAccountAddress = $('input[name="address_option"]:checked').val() === 'account';
            const phoneRegex = /^(0[35789][0-9]{8})$/;

            $('.error-msg').remove();
            $('input, .nice-select').css('border', '');

            if (isAccountAddress) {
                // Validate cho địa chỉ tài khoản
                formIsValid &= validateInput($('#acc_fullname'), !$('#acc_fullname').val().trim(), 'Vui lòng nhập họ tên!');
                formIsValid &= validateInput($('#acc_phone'), !phoneRegex.test($('#acc_phone').val()), 'Số điện thoại phải gồm 10 số (Bắt đầu bằng 03, 05, 07, 08, 09)!');
                formIsValid &= validateInput($('#acc_address'), !$('#acc_address').val().trim(), 'Vui lòng nhập địa chỉ!');
                
                // Gán lại tên cho đúng để submit
                $('#acc_fullname').attr('name', 'fullname');
                $('#acc_phone').attr('name', 'phone');
                $('#acc_address').attr('name', 'address');
                $('#acc_province_name').attr('name', 'province_name');
                $('#acc_ward_name').attr('name', 'ward_name');
                $('#new_address_section').find('input, select').removeAttr('name');


            } else {
                // Validate cho địa chỉ mới
                formIsValid &= validateInput($('#new_fullname'), !$('#new_fullname').val().trim(), 'Vui lòng nhập họ tên!');
                formIsValid &= validateInput($('#new_phone'), !phoneRegex.test($('#new_phone').val()), 'Số điện thoại phải gồm 10 số (Bắt đầu bằng 03, 05, 07, 08, 09)!');
                formIsValid &= validateInput($('#new_address'), !$('#new_address').val().trim(), 'Vui lòng nhập địa chỉ!');
                formIsValid &= validateSelect($('#province'), 'Vui lòng chọn Tỉnh/Thành!');
                formIsValid &= validateSelect($('#ward'), 'Vui lòng chọn Phường/Xã!');

                // Gán lại tên cho đúng để submit
                $('#new_fullname').attr('name', 'fullname');
                $('#new_phone').attr('name', 'phone');
                $('#new_address').attr('name', 'address');
                // Lấy tên từ select, không phải code
                $('#new_province_name').attr('name', 'province_name');
                $('#new_ward_name').attr('name', 'ward_name');
                $('#account_address_section').find('input').removeAttr('name');
            }

            if (!formIsValid) {
                e.preventDefault(); // Ngăn form submit nếu có lỗi
                return false;
            }
        });
    });
</script>