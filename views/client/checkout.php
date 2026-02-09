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
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="checkout__title">Thông tin giao hàng</h6>
                            <div class="checkout__input">
                                <p>Họ và tên người nhận<span>*</span></p>
                                <input type="text" placeholder="Nguyễn Văn A">
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Số điện thoại<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="checkout__input">
                                        <p>Tỉnh / Thành phố<span>*</span></p>
                                        <input type="text" placeholder="Hồ Chí Minh">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="checkout__input">
                                        <p>Quận / Huyện<span>*</span></p>
                                        <input type="text" placeholder="Quận 1">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="checkout__input">
                                        <p>Phường / Xã<span>*</span></p>
                                        <input type="text" placeholder="Phường Bến Nghé">
                                    </div>
                                </div>
                            </div>

                            <div class="checkout__input">
                                <p>Số nhà, tên đường<span>*</span></p>
                                <input type="text" placeholder="Số 123, Đường Lê Lợi..." class="checkout__input__add">
                            </div>

                            <div class="checkout__input">
                                <p>Ghi chú đơn hàng</p>
                                <input type="text" placeholder="Ví dụ: Giao hàng giờ hành chính...">
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Đơn hàng của bạn</h4>
                                
                                <!-- Danh sách sản phẩm (Demo) -->
                                <div class="checkout__order__products">Sản phẩm <span>Thành tiền</span></div>
                                <ul class="checkout__total__products">
                                    <li>01. LEGO Technic 42115 <span>5.000.000đ</span></li>
                                    <li>02. LEGO City Police <span>1.200.000đ</span></li>
                                </ul>
                                
                                <ul class="checkout__total__all">
                                    <li>Tạm tính <span>6.200.000đ</span></li>
                                    <li>Phí ship <span>30.000đ</span></li>
                                    <li>Tổng cộng <span>6.230.000đ</span></li>
                                </ul>

                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        Thanh toán khi nhận hàng (COD)
                                        <input type="radio" id="payment" name="payment_method" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Chuyển khoản ngân hàng
                                        <input type="radio" id="paypal" name="payment_method">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="vnpay">
                                        Thanh toán Online (VNPAY)
                                        <input type="radio" id="vnpay" name="payment_method">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>

                                <button type="submit" class="site-btn">ĐẶT HÀNG</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
