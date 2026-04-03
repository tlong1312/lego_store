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

<style>
    .commerce-detail__surface {
        background: #fff;
        border: 1px solid #eceff3;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 14px 34px rgba(17, 24, 39, 0.06);
    }

    .commerce-detail__top-grid {
        display: grid;
        grid-template-columns: minmax(0, 46%) minmax(0, 54%);
        gap: 34px;
    }

    .commerce-detail__media-frame {
        background: linear-gradient(160deg, #ffffff 0%, #f4f6fa 100%);
        border: 1px solid #eef1f5;
        border-radius: 16px;
        overflow: hidden;
        padding: 16px;
        min-height: 440px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .commerce-detail__media-frame img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 12px;
    }

    .commerce-detail__thumbs {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 14px;
    }

    .commerce-detail__thumb {
        width: calc(25% - 8px);
        border: 1px solid #e5e7eb;
        background: #fff;
        border-radius: 10px;
        padding: 6px;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .commerce-detail__thumb img {
        width: 100%;
        height: 70px;
        object-fit: cover;
        border-radius: 7px;
    }

    .commerce-detail__thumb.is-active,
    .commerce-detail__thumb:hover {
        border-color: #d13b1a;
        box-shadow: 0 6px 18px rgba(209, 59, 26, 0.15);
    }

    .commerce-detail__title {
        font-size: 34px;
        line-height: 1.25;
        margin-bottom: 10px;
    }

    .commerce-detail__rating-row {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 12px;
    }

    .commerce-star--active {
        color: #f7941d;
    }

    .commerce-star--muted {
        color: #cfd5dd;
    }

    .commerce-detail__rating-meta {
        color: #667085;
        font-size: 14px;
        font-weight: 600;
    }

    .commerce-detail__price {
        font-size: 36px;
        color: #b12704;
        font-weight: 800;
        letter-spacing: 0.2px;
        margin-bottom: 18px;
    }

    .commerce-detail__desc {
        color: #475467;
        line-height: 1.75;
        margin-bottom: 24px;
    }

    .commerce-detail__qty-label {
        display: block;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .commerce-detail__qty-control {
        width: 180px;
        display: flex;
        align-items: center;
        border: 1px solid #d7dbe2;
        border-radius: 999px;
        overflow: hidden;
        background: #fff;
        margin-bottom: 18px;
    }

    .commerce-detail__qty-btn {
        width: 48px;
        border: 0;
        background: #f8fafc;
        color: #1f2937;
        font-size: 22px;
        font-weight: 700;
        line-height: 1;
        cursor: pointer;
        padding: 10px 0;
        transition: background 0.2s ease;
    }

    .commerce-detail__qty-btn:hover {
        background: #edf2f7;
    }

    .commerce-detail__qty-input {
        width: calc(100% - 96px);
        border: 0;
        text-align: center;
        font-size: 17px;
        font-weight: 700;
        color: #111827;
        padding: 10px 4px;
        outline: 0;
        background: #fff;
    }

    .commerce-detail__qty-input::-webkit-outer-spin-button,
    .commerce-detail__qty-input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .commerce-detail__qty-input {
        -moz-appearance: textfield;
        appearance: textfield;
    }

    .commerce-detail__add-cart {
        width: 100%;
        border: 0;
        background: #b12704;
        color: #fff;
        font-weight: 800;
        font-size: 15px;
        border-radius: 999px;
        padding: 14px 22px;
        letter-spacing: 0.6px;
        text-transform: uppercase;
        transition: background 0.2s ease, transform 0.2s ease;
    }

    .commerce-detail__add-cart:hover {
        background: #8f1f03;
        transform: translateY(-1px);
    }

    .commerce-detail__meta-list {
        list-style-type: none;
        padding: 0;
        margin: 24px 0;
        display: grid;
        gap: 11px;
    }

    .commerce-detail__meta-list li {
        color: #3a4454;
        font-size: 15px;
        line-height: 1.5;
    }

    .commerce-detail__meta-list span {
        display: inline-block;
        min-width: 110px;
        color: #111827;
        font-weight: 700;
    }

    .commerce-detail__guarantee {
        background: #fff6ef;
        border: 1px dashed #ffd4bb;
        border-radius: 12px;
        padding: 12px 14px;
        margin-top: 8px;
    }

    .commerce-detail__guarantee h6 {
        margin: 0 0 8px;
        color: #7a2b12;
    }

    .commerce-detail__guarantee img {
        max-width: 220px;
    }

    .commerce-detail__tabs {
        margin-top: 34px;
    }

    .commerce-detail__tabs.product__details__tab .nav-tabs {
        border-bottom: 0;
        gap: 10px;
        justify-content: flex-start;
    }

    .commerce-detail__tabs.product__details__tab .nav-tabs .nav-item {
        margin-right: 0;
    }

    .commerce-detail__tabs.product__details__tab .nav-tabs .nav-item .nav-link {
        border: 0;
        border-bottom: 0;
        border-radius: 14px;
        background: #f1f5f9;
        color: #1f2937;
        font-weight: 700;
        font-size: 20px;
        line-height: 1.3;
        min-height: 44px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 9px 18px;
    }

    .commerce-detail__tabs.product__details__tab .nav-tabs .nav-item .nav-link.active {
        background: #111827;
        color: #fff;
        border-bottom: 0;
    }

    .commerce-review {
        margin-top: 22px;
        display: grid;
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        gap: 26px;
    }

    .commerce-review__summary {
        border: 1px solid #edf1f5;
        border-radius: 12px;
        background: #f8fafc;
        padding: 16px;
        margin-bottom: 20px;
    }

    .commerce-review__summary-score {
        font-size: 28px;
        font-weight: 800;
        color: #111827;
        margin-bottom: 3px;
    }

    .commerce-review__summary-note {
        color: #667085;
        font-size: 14px;
        margin-bottom: 12px;
    }

    .commerce-review__stat-row {
        display: grid;
        grid-template-columns: 54px 1fr 32px;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
    }

    .commerce-review__bar {
        height: 8px;
        border-radius: 999px;
        background: #e5e7eb;
        overflow: hidden;
    }

    .commerce-review__bar span {
        display: block;
        height: 100%;
        border-radius: 999px;
        background: linear-gradient(90deg, #f59e0b, #ef4444);
    }

    .commerce-review__list {
        max-height: 500px;
        overflow-y: auto;
        padding-right: 8px;
    }

    .commerce-review__item {
        border-bottom: 1px solid #f0f2f5;
        padding-bottom: 15px;
        margin-bottom: 16px;
    }

    .commerce-review__author {
        display: flex;
        align-items: baseline;
        justify-content: space-between;
        gap: 10px;
        margin-bottom: 6px;
    }

    .commerce-review__author h6 {
        margin: 0;
        font-weight: 800;
    }

    .commerce-review__date {
        color: #98a2b3;
        font-size: 12px;
        white-space: nowrap;
    }

    .commerce-review__comment {
        color: #475467;
        margin: 8px 0 0;
        line-height: 1.7;
    }

    .commerce-review__form-panel {
        border: 1px solid #e7ebf0;
        border-radius: 12px;
        background: #fbfdff;
        padding: 24px;
        height: 100%;
    }

    .commerce-review__form {
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .commerce-review__label {
        font-weight: 700;
        margin-bottom: 8px;
        color: #1f2937;
    }

    .commerce-review__field {
        margin-bottom: 18px;
    }

    .commerce-review__field select,
    .commerce-review__field textarea {
        width: 100%;
        border: 1px solid #d7dce4;
        border-radius: 10px;
        padding: 12px 14px;
        font-size: 14px;
        background: #fff;
    }

    .commerce-review__field textarea {
        resize: vertical;
        min-height: 130px;
    }

    .commerce-review__submit {
        margin-top: auto;
        width: 100%;
        border: 0;
        border-radius: 999px;
        background: #b12704;
        color: #fff;
        font-weight: 800;
        font-size: 15px;
        padding: 13px 20px;
        text-transform: uppercase;
    }

    .commerce-review__login-alert {
        background: #fff3cd;
        color: #856404;
        border: 1px solid #ffeeba;
        padding: 15px;
        border-radius: 8px;
        margin: 0;
    }

    .commerce-review__login-alert a {
        font-weight: 800;
        color: #e53637;
        text-decoration: underline;
    }

    @media (max-width: 991px) {
        .commerce-detail__top-grid,
        .commerce-review {
            grid-template-columns: minmax(0, 1fr);
        }

        .commerce-detail__surface {
            padding: 20px;
        }

        .commerce-detail__media-frame {
            min-height: 350px;
        }

        .commerce-detail__title {
            font-size: 30px;
        }
    }

    @media (max-width: 575px) {
        .commerce-detail__thumb {
            width: calc(50% - 5px);
        }

        .commerce-detail__title {
            font-size: 26px;
        }

        .commerce-detail__price {
            font-size: 31px;
        }
    }
</style>

<!-- Shop Details Section Begin -->
<section class="shop-details commerce-detail spad">
    <div class="container">
        <?php
            $imgName = htmlspecialchars($product['image']);
            $adminImgPath = "public/admin/assets/images/" . $imgName;
            $clientImgPath = "public/client/img/product/" . $imgName;
            $displayImg = file_exists($adminImgPath) ? $adminImgPath : $clientImgPath;
        ?>

        <div class="commerce-detail__surface">
            <div class="commerce-detail__top-grid">
                <div class="commerce-detail__gallery">
                    <div class="commerce-detail__media-frame">
                        <img src="<?= $displayImg ?>" alt="<?= htmlspecialchars($product['name']) ?>" class="img-fluid">
                    </div>

                    <div class="commerce-detail__thumbs">
                        <?php for ($thumb = 1; $thumb <= 4; $thumb++): ?>
                            <button type="button" class="commerce-detail__thumb <?= $thumb === 1 ? 'is-active' : '' ?>">
                                <img src="<?= $displayImg ?>" alt="<?= htmlspecialchars($product['name']) . ' thumbnail ' . $thumb ?>">
                            </button>
                        <?php endfor; ?>
                    </div>
                </div>

                <div class="commerce-detail__info">
                    <h2 class="commerce-detail__title"><?= htmlspecialchars($product['name']) ?></h2>

                    <div class="commerce-detail__rating-row">
                        <div>
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <i class="fa <?= $i <= $avg_rating ? 'fa-star commerce-star--active' : 'fa-star-o commerce-star--muted' ?>"></i>
                            <?php endfor; ?>
                        </div>
                        <span class="commerce-detail__rating-meta">(<?= $review_count ?> Đánh giá) | Còn <?= (int) $product['stock_quantity'] ?> bộ</span>
                    </div>

                    <div class="commerce-detail__price"><?= number_format($gia_ban, 0, ',', '.') ?>đ</div>

                    <p class="commerce-detail__desc">
                        <?= htmlspecialchars($product['description']) ?>
                    </p>

                    <form action="index.php?controller=cart&action=add" method="POST" class="commerce-detail__action">
                        <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">

                        <label class="commerce-detail__qty-label">Số lượng</label>
                        <div class="commerce-detail__qty-control">
                            <button type="button" class="commerce-detail__qty-btn" onclick="
                                const input = this.parentNode.querySelector('input[name=\'quantity\']');
                                const min = parseInt(input.min, 10) || 1;
                                const current = parseInt(input.value || min, 10);
                                input.value = current - 1;
                                input.dispatchEvent(new Event('change'));
                            ">-</button>

                            <input type="number" name="quantity" value="1" min="1"
                                max="<?= (int) $product['stock_quantity'] ?>" class="commerce-detail__qty-input"
                                onchange="
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

                            <button type="button" class="commerce-detail__qty-btn" onclick="
                                const input = this.parentNode.querySelector('input[name=\'quantity\']');
                                const min = parseInt(input.min, 10) || 1;
                                const current = parseInt(input.value || min, 10);
                                input.value = current + 1;
                                input.dispatchEvent(new Event('change'));
                            ">+</button>
                        </div>

                        <button type="submit" class="commerce-detail__add-cart">THÊM VÀO GIỎ</button>
                    </form>

                    <ul class="commerce-detail__meta-list">
                        <li><span>Tình trạng:</span> <?= (int) $product['stock_quantity'] > 0 ? 'Còn hàng' : 'Hết hàng' ?></li>
                        <li><span>Mã SP:</span> <?= htmlspecialchars($product['sku']) ?></li>
                        <li><span>Chủ đề:</span> <?= htmlspecialchars($product['theme_name']) ?></li>
                        <li><span>Độ tuổi:</span> <?= htmlspecialchars($product['age_range']) ?></li>
                        <li><span>Số chi tiết:</span> <?= (int) $product['piece_count'] ?></li>
                    </ul>

                    <div class="commerce-detail__guarantee">
                        <h6>Bảo đảm chính hãng 100%</h6>
                        <img src="public/client/img/shop-details/details-payment.png" alt="Phương thức thanh toán">
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
                        <div class="commerce-review">
                            <div>
                                <h5 class="mb-4">Đánh giá từ khách hàng (<?= $review_count ?>)</h5>

                                <div class="commerce-review__summary">
                                    <div class="commerce-review__summary-score"><?= $avg_rating ?>/5</div>
                                    <div class="commerce-review__summary-note">Mức hài lòng trung bình từ khách hàng</div>

                                    <?php for ($star = 5; $star >= 1; $star--):
                                        $count = isset($review_stats[$star]) ? (int) $review_stats[$star] : 0;
                                        $percent = $review_count > 0 ? round(($count / $review_count) * 100) : 0;
                                    ?>
                                        <div class="commerce-review__stat-row">
                                            <span><?= $star ?> sao</span>
                                            <div class="commerce-review__bar"><span style="width: <?= $percent ?>%;"></span></div>
                                            <span><?= $count ?></span>
                                        </div>
                                    <?php endfor; ?>
                                </div>

                                <div class="commerce-review__list">
                                    <?php if (!empty($reviews)):
                                        foreach ($reviews as $rev): ?>
                                            <div class="commerce-review__item">
                                                <div class="commerce-review__author">
                                                    <h6><?= htmlspecialchars($rev['fullname']) ?></h6>
                                                    <span class="commerce-review__date"><?= date('d/m/Y', strtotime($rev['created_at'])) ?></span>
                                                </div>
                                                <div>
                                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                                        <i class="fa <?= $i <= $rev['rating'] ? 'fa-star commerce-star--active' : 'fa-star-o commerce-star--muted' ?>"></i>
                                                    <?php endfor; ?>
                                                </div>
                                                <p class="commerce-review__comment"><?= nl2br(htmlspecialchars($rev['comment'])) ?></p>
                                            </div>
                                        <?php endforeach; else: ?>
                                        <p>Chưa có đánh giá nào cho sản phẩm này. Hãy là người đầu tiên trải nghiệm và chia sẻ!</p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div>
                                <h5 class="mb-4">Thêm đánh giá của bạn</h5>
                                <?php if (isset($_SESSION['user'])): ?>
                                    <form action="index.php?controller=product&action=submitReview" method="POST"
                                        class="commerce-review__form-panel commerce-review__form">
                                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                                        <div class="commerce-review__field">
                                            <label class="commerce-review__label">Chất lượng sản phẩm:</label>
                                            <select name="rating" class="form-control">
                                                <option value="5">⭐⭐⭐⭐⭐ (Tuyệt vời)</option>
                                                <option value="4">⭐⭐⭐⭐ (Tốt)</option>
                                                <option value="3">⭐⭐⭐ (Bình thường)</option>
                                                <option value="2">⭐⭐ (Tệ)</option>
                                                <option value="1">⭐ (Rất tệ)</option>
                                            </select>
                                        </div>

                                        <div class="commerce-review__field">
                                            <label class="commerce-review__label">Cảm nhận của bạn:</label>
                                            <textarea name="comment" class="form-control" rows="5" required
                                                placeholder="Bộ LEGO này lắp ráp có mượt không? Màu sắc thế nào?"></textarea>
                                        </div>

                                        <button type="submit" class="commerce-review__submit">GỬI ĐÁNH GIÁ</button>
                                    </form>
                                <?php else: ?>
                                    <div class="commerce-review__form-panel d-flex align-items-center">
                                        <p class="commerce-review__login-alert">
                                            Vui lòng <a href="index.php?controller=auth&action=login">đăng nhập tài khoản</a> để gửi đánh giá!
                                        </p>
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