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
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <i class="fa <?= $i <= $avg_rating ? 'fa-star' : 'fa-star-o' ?>" <?= $i <= $avg_rating ? 'style="color: #f7941d;"' : '' ?>></i>
                                <?php endfor; ?>
                                <span style="margin-left: 5px;">(<?= $review_count ?> Đánh giá) | Còn
                                    <?= (int) $product['stock_quantity'] ?> bộ</span>
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
                                        max="<?= (int) $product['stock_quantity'] ?>" class="qty-input"
                                        onfocus="this.select()" onchange="
                                        const max = parseInt(this.max, 10) || 1;
                                        const min = parseInt(this.min, 10) || 1;
                                        let val = parseInt(this.value || min, 10);
                                        if (val > max) val = max;
                                        if (val < min) val = min;
                                        this.value = val;
                                    " onblur="
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
                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab">Đánh giá (<?= $review_count ?>)</a>
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
                        <div class="row">
                            <div class="col-lg-6">
                                <h5 class="mb-4">Đánh giá từ khách hàng (<?= $review_count ?>)</h5>

                                <div class="review-list-container"
                                    style="max-height: 500px; overflow-y: auto; padding-right: 15px;">

                                    <?php if (!empty($reviews)):
                                        foreach ($reviews as $rev): ?>
                                            <div class="review-item mb-4"
                                                style="border-bottom: 1px solid #f2f2f2; padding-bottom: 15px;">
                                                <h6 style="font-weight: bold; margin-bottom: 5px;">
                                                    <?= htmlspecialchars($rev['fullname']) ?>
                                                    <span
                                                        style="font-size: 12px; color: #888; font-weight: normal; margin-left: 10px;">
                                                        <?= date('d/m/Y', strtotime($rev['created_at'])) ?>
                                                    </span>
                                                </h6>
                                                <div class="rating" style="margin-bottom: 10px;">
                                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                                        <i class="fa <?= $i <= $rev['rating'] ? 'fa-star' : 'fa-star-o' ?>"
                                                            style="color: #f7941d; font-size: 14px;"></i>
                                                    <?php endfor; ?>
                                                </div>
                                                <p style="color: #444; margin-bottom: 0; line-height: 1.6;">
                                                    <?= nl2br(htmlspecialchars($rev['comment'])) ?>
                                                </p>
                                            </div>
                                        <?php endforeach; else: ?>
                                        <p>Chưa có đánh giá nào cho sản phẩm này. Hãy là người đầu tiên trải nghiệm và chia
                                            sẻ!</p>
                                    <?php endif; ?>

                                </div>
                            </div>

                            <div class="col-lg-6" style="padding-left: 30px;">
    <h5 class="mb-4" style="margin-bottom: 30px;">Thêm đánh giá của bạn</h5>
    <?php if (isset($_SESSION['user'])): ?>
        <form action="index.php?controller=product&action=submitReview" method="POST"
            style="background: #f9f9f9; padding: 40px 30px; border-radius: 8px; border: 1px solid #eee;">
            <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

            <div class="form-group" style="margin-bottom: 25px;">
                <label style="font-weight: bold; display: block; margin-bottom: 10px; font-size: 15px;">
                    Chất lượng sản phẩm:
                </label>
                <select name="rating" class="form-control"
                    style="padding: 12px; border: 1px solid #ddd; width: 100%; font-size: 14px; text-align: center; height: auto; display: block;">
                    <option value="5">⭐⭐⭐⭐⭐ (Tuyệt vời)</option>
                    <option value="4">⭐⭐⭐⭐ (Tốt)</option>
                    <option value="3">⭐⭐⭐ (Bình thường)</option>
                    <option value="2">⭐⭐ (Tệ)</option>
                    <option value="1">⭐ (Rất tệ)</option>
                </select>
            </div>

            <div class="form-group" style="margin-bottom: 30px;">
                <label style="font-weight: bold; display: block; margin-bottom: 10px; font-size: 15px;">
                    Cảm nhận của bạn:
                </label>
                <textarea name="comment" class="form-control" rows="5" required
                    placeholder="Bộ LEGO này lắp ráp có mượt không? Màu sắc thế nào?"
                    style="padding: 15px; border: 1px solid #ddd; font-family: Arial, sans-serif; width: 100%; resize: vertical; display: block;"></textarea>
            </div>

            <button type="submit" class="site-btn w-100 border-0"
                style="padding: 14px; font-size: 16px; font-weight: bold;">GỬI ĐÁNH GIÁ</button>
        </form>
    <?php else: ?>
        <div class="alert alert-warning"
            style="background: #fff3cd; color: #856404; border-color: #ffeeba; padding: 15px; border-radius: 5px;">
            Vui lòng <a href="index.php?controller=auth&action=login"
                style="font-weight: bold; color: #e53637; text-decoration: underline;">đăng nhập
                tài khoản</a> để gửi đánh giá!
        </div>
    <?php endif; ?>
</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Details Section End -->