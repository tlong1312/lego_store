<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Chi Tiết Sản Phẩm</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php?controller=home&action=index">Trang chủ</a>
                        <a href="index.php?controller=product&action=index">Cửa hàng</a>
                        <span>Chi tiết sản phẩm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Details Section Begin -->
<section class="shop-details commerce-detail spad">
    <div class="container">
        <div class="commerce-detail__card">
            <div class="row align-items-stretch">
                <div class="col-lg-6">
                    <div class="commerce-detail__media">
                        <img src="public/client/img/product/<?= htmlspecialchars($product['image']) ?>"
                            alt="<?= htmlspecialchars($product['name']) ?>">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="commerce-detail__info">
                        <div class="commerce-detail__head">
                            <h2><?= htmlspecialchars($product['name']) ?></h2>
                            <div class="commerce-detail__rating">
                                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i
                                    class="fa fa-star"></i><i class="fa fa-star"></i>
                                <span>Còn <?= (int) $product['stock_quantity'] ?> bộ</span>
                            </div>
                            <div class="commerce-detail__price"><?= number_format($gia_ban, 0, ',', '.') ?>đ</div>
                        </div>

                        <p class="commerce-detail__desc">
                            <?= htmlspecialchars($product['description']) ?>
                        </p>

                        <form action="index.php?controller=cart&action=add" method="POST"
                            class="commerce-detail__action">
                            <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">

                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="number" name="quantity" value="1" min="1"
                                        max="<?= (int) $product['stock_quantity'] ?>" class="qty-input" oninput="
                                            const max = parseInt(this.max, 10) || 1;
                                            const min = parseInt(this.min, 10) || 1;
                                            let val = parseInt(this.value || min, 10);
                                            if (val > max) val = max;
                                            if (val < min) val = min;
                                            this.value = val;
                                        ">
                                </div>
                            </div>

                            <button type="submit" class="primary-btn border-0">THÊM VÀO GIỎ</button>
                        </form>

                        <div class="commerce-detail__meta">
                            <div><span>Mã SP:</span> <?= htmlspecialchars($product['sku']) ?></div>
                            <div><span>Danh mục:</span> <?= htmlspecialchars($product['theme_name']) ?></div>
                            <div><span>Độ tuổi:</span> <?= htmlspecialchars($product['age_range']) ?></div>
                            <div><span>Số chi tiết:</span> <?= (int) $product['piece_count'] ?></div>
                        </div>

                        <div class="commerce-detail__guarantee">
                            <h6>Bảo đảm chính hãng 100%</h6>
                            <img src="public/client/img/shop-details/details-payment.png" alt="Phương thức thanh toán">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="product__details__tab commerce-detail__tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Mô tả</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Đánh giá (5)</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                    <div class="product__details__tab__content">
                        <div class="product__details__tab__content__item">
                            <h5>Thông tin sản phẩm</h5>
                            <p><?= htmlspecialchars($product['description']) ?></p>
                        </div>
                        <div class="product__details__tab__content__item">
                            <h5>Gợi ý mua hàng</h5>
                            <p>Sản phẩm LEGO chính hãng phù hợp sưu tầm và trưng bày. Nên lắp ráp ở nơi thoáng, đủ sáng
                                và bảo quản hộp để giữ giá trị lâu dài.</p>
                        </div>
                    </div>
                </div>

                <div class="tab-pane" id="tabs-6" role="tabpanel">
                    <div class="product__details__tab__content">
                        <div class="product__details__tab__content__item">
                            <h5>Đánh giá khách hàng</h5>
                            <p>Phần đánh giá sẽ được cập nhật sau khi tích hợp module review thực tế.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Details Section End -->