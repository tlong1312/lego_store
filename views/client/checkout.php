   <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Thanh Toán</h4>
                        <div class="breadcrumb__links">
                            <a href="./home.php">Trang chủ</a>
                            <a href="./product_list.php">Sản phẩm</a>
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
                <form action="index.php?controller=cart&action=processCheckout" method="POST">
    <div class="row">
        <div class="col-lg-8 col-md-6">
            <h6 class="checkout__title">Thông tin giao hàng</h6>
            
            <div class="checkout__input mb-4" style="background: #f5f5f5; padding: 15px; border-radius: 5px;">
                <label class="mr-3" style="cursor: pointer;">
                    <input type="radio" name="address_option" value="account" onclick="useAccountAddress()" checked> 
                    <span style="font-weight: bold; color: #111;">Dùng thông tin tài khoản</span>
                </label>
                <label style="cursor: pointer;">
                    <input type="radio" name="address_option" value="new" onclick="clearAddress()"> 
                    <span style="font-weight: bold; color: #111;">Nhập địa chỉ mới</span>
                </label>
            </div>

            <div class="checkout__input">
                <p>Họ và tên người nhận<span>*</span></p>
                <input type="text" id="fullname" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" style="color: #000 !important;" required>
            </div>
            <div class="checkout__input">
                <p>Số điện thoại<span>*</span></p>
                <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" style="color: #000 !important;" required>
            </div>
            <div class="checkout__input">
                <p>Địa chỉ giao hàng chi tiết<span>*</span></p>
                <input type="text" id="address" name="address" value="<?= htmlspecialchars($user['address']) ?>" style="color: #000 !important;" required>
            </div>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="checkout__order">
                <h4 class="order__title">Đơn hàng của bạn</h4>
                <div class="checkout__order__products">Sản phẩm <span>Thành tiền</span></div>
                <ul class="checkout__total__products">
                    <?php 
                    $total = 0;
                    foreach($cart as $item): 
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

<script>
    // Điền lại thông tin tài khoản
    function useAccountAddress() {
        document.getElementById('fullname').value = '<?= htmlspecialchars($user['fullname']) ?>';
        document.getElementById('phone').value = '<?= htmlspecialchars($user['phone']) ?>';
        document.getElementById('address').value = '<?= htmlspecialchars($user['address']) ?>';
    }
    // Xóa trắng để nhập mới
    function clearAddress() {
        document.getElementById('fullname').value = '';
        document.getElementById('phone').value = '';
        document.getElementById('address').value = '';
        document.getElementById('fullname').focus();
    }
    // Ẩn/hiện box ngân hàng
    function showBankInfo() { document.getElementById('bank_info_box').style.display = 'block'; }
    function hideBankInfo() { document.getElementById('bank_info_box').style.display = 'none'; }
</script>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
