<!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Giỏ Hàng</h4>
                        <div class="breadcrumb__links">
                            <a href="./home.php">Trang chủ</a>
                            <a href="./product_list.php">Sản phẩm</a>
                            <span>Giỏ hàng</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Sản Phẩm</th>
                                    <th>Số Lượng</th>
                                    <th>Thành Tiền</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Dòng sản phẩm mẫu 1 -->
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <!-- Ảnh demo LEGO -->
                                            <img src="public/client/img/shopping-cart/cart-1.jpg" alt="" width="90">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>LEGO Technic 42115 Lamborghini Sián</h6>
                                            <h5>8.000.000đ</h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">8.000.000đ</td>
                                    <td class="cart__close"><i class="fa fa-close"></i></td>
                                </tr>
                                
                                <!-- Dòng sản phẩm mẫu 2 -->
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="public/client/img/shopping-cart/cart-2.jpg" alt="" width="90">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h6>LEGO City 60141 Cảnh Sát</h6>
                                            <h5>2.500.000đ</h5>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <input type="text" value="2">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">5.000.000đ</td>
                                    <td class="cart__close"><i class="fa fa-close"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="./product_list.php">Tiếp Tục Mua Sắm</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Cập Nhật Giỏ Hàng</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Mã Giảm Giá</h6>
                        <form action="#">
                            <input type="text" placeholder="Nhập mã ưu đãi...">
                            <button type="submit">Áp Dụng</button>
                        </form>
                    </div>
                    <div class="cart__total">
                        <h6>Tổng Giỏ Hàng</h6>
                        <ul>
                            <li>Tạm tính <span>13.000.000đ</span></li>
                            <li>Tổng cộng <span>13.000.000đ</span></li>
                        </ul>
                        <a href="./checkout.php" class="primary-btn">Tiến Hành Thanh Toán</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->