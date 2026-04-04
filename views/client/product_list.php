<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Cửa Hàng</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php?controller=home&action=index">Trang chủ</a>
                        <span>Cửa hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="shop-filter-toggle-wrap">
            <button type="button" id="toggle-advanced-filter-btn" class="shop-btn shop-btn--outline shop-btn--toggle">Tìm kiếm nâng cao</button>
        </div>

        <div class="shop-horizontal-filter is-hidden" id="advanced-filter-panel">
            <form id="searchForm" onsubmit="return false;" class="shop-horizontal-filter__form">
                <div class="shop-horizontal-filter__fields">
                    <div class="shop-horizontal-filter__field shop-horizontal-filter__field--grow">
                        <label for="filter-keyword">Tìm theo tên</label>
                        <input id="filter-keyword" type="text" name="keyword" placeholder="Tìm kiếm sản phẩm..." value="<?= htmlspecialchars($keyword) ?>">
                    </div>
                    <div class="shop-horizontal-filter__field">
                        <label for="horizontal-category-select">Loại sản phẩm</label>
                        <select name="horizontal_category_id" id="horizontal-category-select">
                            <option value="0" <?= $category_id == 0 ? 'selected' : '' ?>>Tất cả chủ đề</option>
                            <?php foreach ($themes as $theme): ?>
                                <option value="<?= $theme['id'] ?>" <?= $category_id == $theme['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($theme['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="shop-horizontal-filter__field">
                        <label for="horizontal-price-select">Khoảng giá</label>
                        <select name="horizontal_price_range" id="horizontal-price-select">
                            <option value="" <?= $price_range == '' ? 'selected' : '' ?>>Tất cả</option>
                            <option value="under_1m" <?= $price_range == 'under_1m' ? 'selected' : '' ?>>Dưới 1.000.000đ</option>
                            <option value="1m_3m" <?= $price_range == '1m_3m' ? 'selected' : '' ?>>1 - 3 triệu</option>
                            <option value="3m_5m" <?= $price_range == '3m_5m' ? 'selected' : '' ?>>3 - 5 triệu</option>
                            <option value="5m_8m" <?= $price_range == '5m_8m' ? 'selected' : '' ?>>5 - 8 triệu</option>
                            <option value="8m_10m" <?= $price_range == '8m_10m' ? 'selected' : '' ?>>8 - 10 triệu</option>
                            <option value="over_10m" <?= $price_range == 'over_10m' ? 'selected' : '' ?>>Trên 10 triệu</option>
                        </select>
                    </div>
                    <div class="shop-horizontal-filter__field shop-horizontal-filter__field--sort">
                        <label for="sort-select">Sắp xếp</label>
                        <select name="sort" id="sort-select">
                            <option value="">Mới nhất</option>
                            <option value="asc" <?= $sort == 'asc' ? 'selected' : '' ?>>Giá: Thấp đến Cao</option>
                            <option value="desc" <?= $sort == 'desc' ? 'selected' : '' ?>>Giá: Cao đến Thấp</option>
                        </select>
                    </div>
                </div>

                <div class="shop-horizontal-filter__actions">
                    <button type="submit" class="shop-btn shop-btn--primary">Lọc</button>
                    <button type="button" id="filter-reset-btn" class="shop-btn shop-btn--outline">Reset</button>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <!-- Filter Form -->
                    <div class="shop__sidebar__accordion">
                        <form id="filterForm">
                            <div class="accordion" id="accordionExample">
                                <!-- Danh Mục -->
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Chủ Đề LEGO</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    <li>
                                                        <label class="filter-option">
                                                            <input type="radio" name="category_id" value="0" <?= $category_id == 0 ? 'checked' : '' ?>>
                                                            <span class="filter-option__dot"></span>
                                                            <span class="filter-option__text">Tất cả chủ đề</span>
                                                        </label>
                                                    </li>
                                                    <?php foreach ($themes as $theme): ?>
                                                        <li>
                                                            <label class="filter-option">
                                                                <input type="radio" name="category_id" value="<?= $theme['id'] ?>" <?= $category_id == $theme['id'] ? 'checked' : '' ?>>
                                                                <span class="filter-option__dot"></span>
                                                                <span class="filter-option__text"><?= htmlspecialchars($theme['name']) ?></span>
                                                            </label>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Lọc Theo Giá -->
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseThree">Lọc Theo Giá</a>
                                    </div>
                                    <div id="collapseThree" class="collapse show">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <ul>
                                                    <li><label class="filter-option"><input type="radio" name="price_range" value="" <?= $price_range == '' ? 'checked' : '' ?>><span class="filter-option__dot"></span><span class="filter-option__text">Tất cả</span></label></li>
                                                    <li><label class="filter-option"><input type="radio" name="price_range" value="under_1m" <?= $price_range == 'under_1m' ? 'checked' : '' ?>><span class="filter-option__dot"></span><span class="filter-option__text">Dưới 1.000.000đ</span></label></li>
                                                    <li><label class="filter-option"><input type="radio" name="price_range" value="1m_3m" <?= $price_range == '1m_3m' ? 'checked' : '' ?>><span class="filter-option__dot"></span><span class="filter-option__text">1 - 3 triệu</span></label></li>
                                                    <li><label class="filter-option"><input type="radio" name="price_range" value="3m_5m" <?= $price_range == '3m_5m' ? 'checked' : '' ?>><span class="filter-option__dot"></span><span class="filter-option__text">3 - 5 triệu</span></label></li>
                                                    <li><label class="filter-option"><input type="radio" name="price_range" value="5m_8m" <?= $price_range == '5m_8m' ? 'checked' : '' ?>><span class="filter-option__dot"></span><span class="filter-option__text">5 - 8 triệu</span></label></li>
                                                    <li><label class="filter-option"><input type="radio" name="price_range" value="8m_10m" <?= $price_range == '8m_10m' ? 'checked' : '' ?>><span class="filter-option__dot"></span><span class="filter-option__text">8 - 10 triệu</span></label></li>
                                                    <li><label class="filter-option"><input type="radio" name="price_range" value="over_10m" <?= $price_range == 'over_10m' ? 'checked' : '' ?>><span class="filter-option__dot"></span><span class="filter-option__text">Trên 10 triệu</span></label></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="shop__product__option">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="shop__product__option__left">
                                <p id="product-count-info">Hiển thị <?= count($products) ?> của <?= $total_products ?> sản phẩm</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Container để load sản phẩm bằng AJAX -->
                <div id="product-list-container">
                    <?php include '_product_list_partial.php'; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->

<!-- Thêm CSS để cải thiện giao diện -->
<style>
    :root {
        --lego-red: #d52b1e;
        --lego-red-dark: #ab2015;
        --lego-yellow: #ffcf00;
        --lego-blue: #0055a4;
        --lego-black: #231f20;
        --lego-grey: #f2f2f2;
        --lego-border: #e7eaee;
    }

    .shop-filter-toggle-wrap {
        display: flex;
        justify-content: flex-end;
        margin-bottom: 12px;
    }

    .shop-btn--toggle {
        min-width: 190px;
    }

    .shop-horizontal-filter {
        background: #fff;
        border: 1px solid var(--lego-border);
        border-radius: 14px;
        padding: 16px;
        margin-bottom: 28px;
        box-shadow: 0 8px 24px rgba(17, 24, 39, 0.05);
    }

    .shop-horizontal-filter.is-hidden {
        display: none;
    }

    .shop-horizontal-filter__form {
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto;
        align-items: end;
        gap: 14px;
    }

    .shop-horizontal-filter__fields {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 10px;
        align-items: end;
    }

    .shop-horizontal-filter__field {
        min-width: 0;
    }

    .shop-horizontal-filter__field--sort {
        min-width: 0;
    }

    .shop-horizontal-filter__field label {
        display: block;
        margin-bottom: 6px;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #667085;
        font-weight: 700;
    }

    .shop-horizontal-filter__field input,
    .shop-horizontal-filter__field select,
    .shop__product__option__right select {
        width: 100%;
        border: 1px solid #d8dde5;
        border-radius: 10px;
        height: 44px;
        padding: 0 12px;
        font-size: 14px;
        color: #1f2937;
        background: #fff;
    }

    .shop-horizontal-filter__field--sort .nice-select {
        width: 100%;
        height: 44px;
        line-height: 42px;
        border: 1px solid #d8dde5;
        border-radius: 10px;
        padding-left: 12px;
        float: none;
    }

    .shop-horizontal-filter__field--sort .nice-select .current {
        display: block;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .shop-horizontal-filter__field--sort .nice-select:after {
        right: 14px;
    }

    .shop-horizontal-filter__actions {
        display: flex;
        gap: 8px;
    }

    .shop-btn {
        border-radius: 999px;
        min-width: 105px;
        height: 44px;
        font-weight: 800;
        border: 1px solid transparent;
        transition: all 0.2s ease;
    }

    .shop-btn--primary {
        background: var(--lego-red);
        color: #fff;
    }

    .shop-btn--primary:hover {
        background: var(--lego-red-dark);
    }

    .shop-btn--outline {
        background: #fff;
        border-color: var(--lego-red);
        color: var(--lego-red);
    }

    .shop-btn--outline:hover {
        background: #fff3f1;
    }

    .shop__sidebar {
        border: 1px solid var(--lego-border);
        border-radius: 14px;
        padding: 18px 14px;
        background: #fff;
    }

    .shop__sidebar__accordion .card {
        border: 0;
        margin-bottom: 14px;
    }

    .shop__sidebar__accordion .card-heading a {
        color: var(--lego-black);
        font-weight: 800;
        font-size: 16px;
    }

    .filter-option {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        margin: 0;
        padding: 7px 4px;
        line-height: 1.4;
    }

    .filter-option input[type="radio"] {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .filter-option__dot {
        width: 18px;
        height: 18px;
        border-radius: 50%;
        border: 2px solid #c6cbd4;
        background: #fff;
        position: relative;
        transition: all 0.2s ease;
        flex-shrink: 0;
    }

    .filter-option:hover .filter-option__dot {
        border-color: var(--lego-red);
    }

    .filter-option input[type="radio"]:checked + .filter-option__dot {
        border-color: var(--lego-red);
    }

    .filter-option input[type="radio"]:checked + .filter-option__dot::after {
        content: "";
        position: absolute;
        top: 50%;
        left: 50%;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: var(--lego-red);
        transform: translate(-50%, -50%);
    }

    .filter-option__text {
        color: #344054;
    }

    .shop__product__option {
        border-bottom: 1px solid var(--lego-border);
        padding-bottom: 12px;
        margin-bottom: 22px;
    }

    .shop__product__option__left p {
        margin-bottom: 0;
        color: #475467;
        font-weight: 600;
    }

    .shop__product__option__right {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        gap: 8px;
    }

    .shop__product__option__right p {
        margin: 0;
        color: #475467;
        font-weight: 700;
    }

    .product__item {
        border: 1px solid var(--lego-border);
        border-radius: 14px;
        overflow: hidden;
        transition: all 0.25s ease;
        margin-bottom: 30px;
        background: #fff;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.05);
    }

    .product__item:hover {
        box-shadow: 0 14px 28px rgba(15, 23, 42, 0.12);
        transform: translateY(-5px);
        border: 2px solid var(--lego-red);
    }

    .product__item__pic {
        border-bottom: 1px solid #edf1f5;
    }

    .product__item__pic .label {
        font-size: 12px;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 999px;
        background: var(--lego-red) !important;
    }

    .product__item__text {
        padding: 16px;
    }

    .product__item__text h6 {
        font-weight: 700;
        margin-bottom: 14px;
        min-height: 44px;
        color: var(--lego-black);
    }

    .shop .product__item__text h6 .product__item__title-link {
        color: var(--lego-black);
        position: static;
        opacity: 1;
        visibility: visible;
        display: inline;
        font-weight: 700;
        transition: color 0.2s ease;
    }

    .shop .product__item__text h6 .product__item__title-link:hover {
        color: var(--lego-red);
    }

    .shop .product__item:hover .product__item__text h6 {
        opacity: 1;
    }

    .shop .product__item:hover .product__item__text h6 .product__item__title-link {
        top: auto;
        opacity: 1;
        visibility: visible;
    }

    .product__item__image-link {
        display: block;
        cursor: pointer;
    }

    .product__item__meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .product__cart-form {
        margin: 0;
        display: flex;
        width: 40px;
        height: 40px;
        flex: 0 0 40px;
    }

    .product__cart-btn {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        border: 1px solid var(--lego-red);
        background: #fff;
        color: var(--lego-red);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }

    .product__cart-btn:hover {
        background: var(--lego-red);
        color: #fff;
    }

    .product__cart-btn.is-disabled {
        border-color: #d0d5dd;
        color: #d0d5dd;
        cursor: not-allowed;
        pointer-events: none;
    }

    .product__item__text h5 {
        color: var(--lego-red);
        font-weight: 800;
        margin-bottom: 0;
    }

    .product__pagination a {
        border: 1px solid #d8dde5;
        color: #344054;
        font-weight: 700;
        border-radius: 9px;
    }

    .product__pagination a:hover {
        background: #fff1ef;
        border-color: var(--lego-red);
        color: var(--lego-red);
    }

    .product__pagination a.active {
        background: var(--lego-red);
        border-color: var(--lego-red);
        color: #fff;
    }

    #product-list-container {
        position: relative;
        min-height: 500px;
    }

    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.82);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 10;
        flex-direction: column;
        gap: 15px;
        border-radius: 12px;
    }

    .loading-overlay .loader {
        border: 5px solid var(--lego-grey);
        border-top: 5px solid var(--lego-blue);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @media (max-width: 991px) {
        .shop-horizontal-filter__form {
            grid-template-columns: 1fr;
        }

        .shop-horizontal-filter__fields {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

        .shop-horizontal-filter__actions {
            width: 100%;
        }

        .shop-btn {
            flex: 1;
        }

        .shop__sidebar {
            margin-bottom: 24px;
        }
    }

    @media (max-width: 767px) {
        .shop-horizontal-filter {
            padding: 12px;
            margin-bottom: 16px;
        }

        .shop-horizontal-filter__form,
        .shop-horizontal-filter__fields {
            gap: 8px;
        }

        .shop-horizontal-filter__fields {
            grid-template-columns: 1fr;
        }

        .shop-horizontal-filter__field label {
            font-size: 11px;
            margin-bottom: 4px;
        }

        .shop-horizontal-filter__field input,
        .shop-horizontal-filter__field select,
        .shop-horizontal-filter__field--sort .nice-select {
            height: 40px;
            font-size: 13px;
        }

        .shop-horizontal-filter__field--sort .nice-select {
            line-height: 38px;
        }

        .shop-btn {
            height: 40px;
            min-width: 90px;
            font-size: 14px;
        }

        .shop__sidebar {
            padding: 12px 10px;
            border-radius: 12px;
            margin-bottom: 16px;
        }

        .shop__sidebar__accordion .card {
            margin-bottom: 10px;
        }

        .shop__sidebar__accordion .card-body {
            padding: 10px 6px 4px;
        }

        .shop__sidebar__accordion .card-heading a {
            font-size: 14px;
        }

        .filter-option {
            gap: 8px;
            padding: 5px 2px;
        }

        .filter-option__dot {
            width: 16px;
            height: 16px;
            border-width: 1.5px;
        }

        .filter-option input[type="radio"]:checked + .filter-option__dot::after {
            width: 6px;
            height: 6px;
        }
    }

    @media (max-width: 575px) {
        .shop-filter-toggle-wrap {
            justify-content: stretch;
        }

        .shop-btn--toggle {
            width: 100%;
            min-width: 0;
        }

        .shop-btn {
            height: 38px;
            font-size: 13px;
        }

        .shop-horizontal-filter__actions {
            gap: 6px;
        }

        .shop__product__option {
            margin-bottom: 14px;
            padding-bottom: 8px;
        }
    }
</style>


