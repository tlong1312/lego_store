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
        <div class="row">
            <div class="col-lg-3">
                <div class="shop__sidebar">
                    <!-- Form Tìm Kiếm -->
                    <div class="shop__sidebar__search">
                        <form action="index.php" method="GET">
                            <input type="hidden" name="controller" value="product">
                            <input type="hidden" name="action" value="index">
                            <input type="hidden" name="category_id" value="<?= $category_id ?>">
                            <input type="hidden" name="price_range" value="<?= htmlspecialchars($price_range) ?>">
                            <input type="hidden" name="sort" value="<?= htmlspecialchars($sort) ?>">
                            <input type="text" name="keyword" placeholder="Tìm kiếm..."
                                value="<?= htmlspecialchars($keyword) ?>">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>

                    <!-- Filter Form -->
                    <div class="shop__sidebar__accordion">
                        <form method="GET" action="index.php" id="filterForm">
                            <input type="hidden" name="controller" value="product">
                            <input type="hidden" name="action" value="index">
                            <input type="hidden" name="keyword" value="<?= htmlspecialchars($keyword) ?>">
                            <div class="accordion" id="accordionExample">
                                <!-- Danh Mục -->
                                <div class="card">
                                    <div class="card-heading">
                                        <a data-toggle="collapse" data-target="#collapseOne">Danh Mục</a>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__categories">
                                                <ul class="nice-scroll">
                                                    <li>
                                                        <label>
                                                            <input type="radio" name="category_id" value="0"
                                                                <?= $category_id == 0 ? 'checked' : '' ?>
                                                                onchange="document.getElementById('filterForm').submit();">
                                                            Tất cả danh mục
                                                        </label>
                                                    </li>
                                                    <?php foreach ($themes as $theme): ?>
                                                        <li>
                                                            <label>
                                                                <input type="radio" name="category_id"
                                                                    value="<?= $theme['id'] ?>"
                                                                    <?= $category_id == $theme['id'] ? 'checked' : '' ?>
                                                                    onchange="document.getElementById('filterForm').submit();">
                                                                <?= htmlspecialchars($theme['name']) ?>
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
                                    <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="shop__sidebar__price">
                                                <ul>
                                                    <li>
                                                        <label>
                                                            <input type="radio" name="price_range" value=""
                                                                <?= $price_range == '' ? 'checked' : '' ?>
                                                                onchange="document.getElementById('filterForm').submit();">
                                                            Tất cả giá
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="radio" name="price_range" value="under_1m"
                                                                <?= $price_range == 'under_1m' ? 'checked' : '' ?>
                                                                onchange="document.getElementById('filterForm').submit();">
                                                            Dưới 1.000.000đ
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="radio" name="price_range" value="1m_3m"
                                                                <?= $price_range == '1m_3m' ? 'checked' : '' ?>
                                                                onchange="document.getElementById('filterForm').submit();">
                                                            1.000.000đ - 3.000.000đ
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="radio" name="price_range" value="3m_5m"
                                                                <?= $price_range == '3m_5m' ? 'checked' : '' ?>
                                                                onchange="document.getElementById('filterForm').submit();">
                                                            3.000.000đ - 5.000.000đ
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="radio" name="price_range" value="5m_8m"
                                                                <?= $price_range == '5m_8m' ? 'checked' : '' ?>
                                                                onchange="document.getElementById('filterForm').submit();">
                                                            5.000.000đ - 8.000.000đ
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="radio" name="price_range" value="8m_10m"
                                                                <?= $price_range == '8m_10m' ? 'checked' : '' ?>
                                                                onchange="document.getElementById('filterForm').submit();">
                                                            8.000.000đ - 10.000.000đ
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input type="radio" name="price_range" value="over_10m"
                                                                <?= $price_range == 'over_10m' ? 'checked' : '' ?>
                                                                onchange="document.getElementById('filterForm').submit();">
                                                            Trên 10.000.000đ
                                                        </label>
                                                    </li>
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
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__left">
                                <p>Hiển thị <?= count($products) ?> sản phẩm trên trang <?= $current_page ?> (Tổng:
                                    <?= $total_products ?> sản phẩm)
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="shop__product__option__right">
                                <p>Sắp xếp theo giá:</p>
                                <form method="GET" action="index.php" style="display:inline;">
                                    <input type="hidden" name="controller" value="product">
                                    <input type="hidden" name="action" value="index">
                                    <input type="hidden" name="keyword" value="<?= htmlspecialchars($keyword) ?>">
                                    <input type="hidden" name="category_id" value="<?= $category_id ?>">
                                    <input type="hidden" name="price_range"
                                        value="<?= htmlspecialchars($price_range) ?>">
                                    <select name="sort" onchange="this.form.submit();">
                                        <option value="">Mới Nhất</option>
                                        <option value="asc" <?= $sort == 'asc' ? 'selected' : '' ?>>Thấp đến Cao</option>
                                        <option value="desc" <?= $sort == 'desc' ? 'selected' : '' ?>>Cao đến Thấp</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Danh sách sản phẩm -->
                <div class="row">
                    <?php foreach ($products as $product): ?>
                        <?php $gia_ban = $product['import_price'] * (1 + $product['profit_margin'] / 100); ?>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg"
                                    data-setbg="public/client/img/product/<?= htmlspecialchars($product['image']) ?>">
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="public/client/img/icon/heart.png" alt=""></a></li>
                                        <li><a href="#"><img src="public/client/img/icon/search.png" alt=""></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6>
                                        <?= htmlspecialchars($product['name']) ?>
                                    </h6>
                                    <a href="index.php?controller=product&action=detail&id=<?= $product['id'] ?>"
                                        class="add-cart">+ Thêm Vào Giỏ</a>
                                    <h5>
                                        <?= number_format($gia_ban, 0, ',', '.') ?>đ
                                    </h5>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Phân trang -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__pagination">
                            <?php
                            // Previous
                            if ($current_page > 1): ?>
                                <a
                                    href="index.php?controller=product&action=index&page=<?= $current_page - 1 ?>&keyword=<?= urlencode($keyword) ?>&category_id=<?= $category_id ?>&price_range=<?= htmlspecialchars($price_range) ?>&sort=<?= htmlspecialchars($sort) ?>">&lt;</a>
                            <?php endif;

                            // First page
                            if ($current_page > 3): ?>
                                <a
                                    href="index.php?controller=product&action=index&page=1&keyword=<?= urlencode($keyword) ?>&category_id=<?= $category_id ?>&price_range=<?= htmlspecialchars($price_range) ?>&sort=<?= htmlspecialchars($sort) ?>">1</a>
                                <?php if ($current_page > 4): ?>
                                    <span class="pagination-dots">...</span>
                                <?php endif;
                            endif;

                            // Pages
                            $start = max(1, $current_page - 2);
                            $end = min($total_pages, $current_page + 2);

                            for ($i = $start; $i <= $end; $i++): ?>
                                <a class="<?= ($i == $current_page) ? 'active' : '' ?>"
                                    href="index.php?controller=product&action=index&page=<?= $i ?>&keyword=<?= urlencode($keyword) ?>&category_id=<?= $category_id ?>&price_range=<?= htmlspecialchars($price_range) ?>&sort=<?= htmlspecialchars($sort) ?>">
                                    <?= $i ?>
                                </a>
                            <?php endfor;

                            // Last page
                            if ($current_page < $total_pages - 2): ?>
                                <?php if ($current_page < $total_pages - 3): ?>
                                    <span class="pagination-dots">...</span>
                                <?php endif; ?>
                                <a
                                    href="index.php?controller=product&action=index&page=<?= $total_pages ?>&keyword=<?= urlencode($keyword) ?>&category_id=<?= $category_id ?>&price_range=<?= htmlspecialchars($price_range) ?>&sort=<?= htmlspecialchars($sort) ?>"><?= $total_pages ?></a>
                            <?php endif;

                            // Next
                            if ($current_page < $total_pages): ?>
                                <a
                                    href="index.php?controller=product&action=index&page=<?= $current_page + 1 ?>&keyword=<?= urlencode($keyword) ?>&category_id=<?= $category_id ?>&price_range=<?= htmlspecialchars($price_range) ?>&sort=<?= htmlspecialchars($sort) ?>">&gt;</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->