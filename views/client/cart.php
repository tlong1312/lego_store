<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Giỏ Hàng</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php?controller=home&action=index">Trang chủ</a>
                        <a href="index.php?controller=product&action=index">Sản phẩm</a>
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
                <form action="index.php?controller=cart&action=update" method="POST">
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
                                <?php
                                $total_price = 0;
                                if (!empty($cart)):
                                    foreach ($cart as $item):
                                        $subtotal = $item['price'] * $item['quantity'];
                                        $total_price += $subtotal;
                                        ?>
                                        <tr>
                                            <td class="product__cart__item">
                                                <div class="product__cart__item__pic">
                                                    <img src="public/client/img/product/<?= htmlspecialchars($item['image']) ?>"
                                                        alt="" width="90">
                                                </div>
                                                <div class="product__cart__item__text">
                                                    <h6>
                                                        <?= htmlspecialchars($item['name']) ?>
                                                    </h6>
                                                    <h5>
                                                        <?= number_format($item['price'], 0, ',', '.') ?>đ
                                                    </h5>
                                                </div>
                                            </td>
                                            <td class="quantity__item">
                                                <div class="quantity">
                                                    <div class="pro-qty-2">                                                
                                                        <input type="text" name="quantity[<?= $item['id'] ?>]" value="<?= $item['quantity'] ?>" 
                                                                min="1" 
                                                                max="<?= $item['stock_quantity'] ?>" 
                                                                style="background: transparent; border: none; text-align: center; width: 50px;">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="cart__price">
                                                <?= number_format($subtotal, 0, ',', '.') ?>đ
                                            </td>
                                            <td class="cart__close">
                                                <a href="index.php?controller=cart&action=remove&id=<?= $item['id'] ?>">
                                                    <i class="fa fa-close" style="color: #111; cursor: pointer;"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                    endforeach;
                                else:
                                    ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-4">Giỏ hàng của bạn đang trống! Hãy quay lại
                                            cửa hàng để chọn sản phẩm.</td>
                                    </tr>
                                <?php endif; ?>
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
                                <button type="submit" class="site-btn" style="border:none; padding: 14px 30px;"><i class="fa fa-spinner"></i> Cập Nhật Giỏ Hàng</button>
                            </div>
                        </div>
                    </div>
                </form>
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
                        <li>Tạm tính <span><?= number_format($total_price ?? 0, 0, ',', '.') ?>đ</span></li>
                        <li>Tổng cộng <span><?= number_format($total_price ?? 0, 0, ',', '.') ?>đ</span></li>
                    </ul>

                    <?php if (!empty($cart)): ?>
                        <a href="index.php?controller=cart&action=checkout" class="primary-btn">Tiến Hành Thanh Toán</a>
                    <?php else: ?>
                        <a href="index.php?controller=product&action=index" class="primary-btn">Đi Mua Sắm</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->