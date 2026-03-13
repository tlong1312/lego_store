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
                    <div class="shop__sidebar__search">
                        <form action="#">
                            <input type="text" placeholder="Tìm kiếm...">
                            <button type="submit"><span class="icon_search"></span></button>
                        </form>
                    </div>
                    <div class="shop__sidebar__accordion">
                        <div class="accordion" id="accordionExample">
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseOne">Danh Mục</a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__categories">
                                            <ul class="nice-scroll">
                                                <li><a href="#">LEGO Technic (15)</a></li>
                                                <li><a href="#">LEGO City (22)</a></li>
                                                <li><a href="#">LEGO Star Wars (18)</a></li>
                                                <li><a href="#">LEGO Ninjago (12)</a></li>
                                                <li><a href="#">LEGO Harry Potter (10)</a></li>
                                                <li><a href="#">LEGO Friends (14)</a></li>
                                                <li><a href="#">LEGO Creator (16)</a></li>
                                                <li><a href="#">LEGO Architecture (8)</a></li>
                                                <li><a href="#">LEGO Marvel (11)</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-heading">
                                    <a data-toggle="collapse" data-target="#collapseThree">Lọc Theo Giá</a>
                                </div>
                                <div id="collapseThree" class="collapse show" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="shop__sidebar__price">
                                            <ul>
                                                <li><a href="#">Dưới 1.000.000đ</a></li>
                                                <li><a href="#">1.000.000đ - 3.000.000đ</a></li>
                                                <li><a href="#">3.000.000đ - 5.000.000đ</a></li>
                                                <li><a href="#">5.000.000đ - 8.000.000đ</a></li>
                                                <li><a href="#">8.000.000đ - 10.000.000đ</a></li>
                                                <li><a href="#">Trên 10.000.000đ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                <select>
                                    <option value="">Thấp đến Cao</option>
                                    <option value="">1tr - 3tr</option>
                                    <option value="">3tr - 5tr</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__pagination">
                            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                                <a class="<?= ($i == $current_page) ? 'active' : '' ?>"
                                    href="index.php?controller=product&action=index&page=<?= $i ?>">
                                    <?= $i ?>
                                </a>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->