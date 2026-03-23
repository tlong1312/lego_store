<!-- Hero Section Begin -->
<section class="hero">
    <div class="hero__slider owl-carousel">
        <div class="hero__items set-bg" data-setbg="public/client/img/hero/hero-1.png">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Bộ Sưu Tập Mới</h6>
                            <h2>Thế Giới LEGO 2026</h2>
                            <p>Khám phá bộ sưu tập LEGO chính hãng với hàng ngàn mô hình sáng tạo.
                                Phát triển tư duy và kỹ năng lắp ráp cho mọi lứa tuổi.</p>
                            <a href="index.php?controller=product&action=index" class="primary-btn">Mua Ngay <span
                                    class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hero__items set-bg" data-setbg="public/client/img/hero/hero-2.png">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-7 col-md-8">
                        <div class="hero__text">
                            <h6>Bộ Sưu Tập Mới</h6>
                            <h2>Thế Giới LEGO 2026</h2>
                            <p>Khám phá bộ sưu tập LEGO chính hãng với hàng ngàn mô hình sáng tạo.
                                Phát triển tư duy và kỹ năng lắp ráp cho mọi lứa tuổi.</p>
                            <a href="index.php?controller=product&action=index" class="primary-btn">Mua Ngay <span
                                    class="arrow_right"></span></a>
                            <div class="hero__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Banner Section Begin -->
<section class="banner spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 offset-lg-4">
                <div class="banner__item">
                    <div class="banner__item__pic">
                        <img src="public/client/img/banner/banner-1.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>LEGO Technic 2026</h2>
                        <a href="index.php?controller=product&action=index&category_id=1">Xem Ngay</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="banner__item banner__item--middle">
                    <div class="banner__item__pic">
                        <img src="public/client/img/banner/banner-2.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>LEGO City</h2>
                        <a href="index.php?controller=product&action=index&category_id=4">Xem Ngay</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="banner__item banner__item--last">
                    <div class="banner__item__pic">
                        <img src="public/client/img/banner/banner-3.jpg" alt="">
                    </div>
                    <div class="banner__item__text">
                        <h2>LEGO JURASSIC</h2>
                        <a href="index.php?controller=product&action=index">Xem Ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Banner Section End -->

<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li data-filter=".new-arrivals">Hàng Mới Về</li>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            <?php foreach ($latest_products as $product): ?>
                <?php
                $gia_ban = $product['import_price'] * (1 + $product['profit_margin'] / 100);
                ?>
                <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                    <div class="product__item">
                        <div class="product__item__pic set-bg"
                            data-setbg="public/client/img/product/<?= htmlspecialchars($product['image']) ?>">
                            <ul class="product__hover">
                                <li><a href="#"><img src="public/client/img/icon/heart.png" alt=""></a></li>
                                <li><a href="#"><img src="public/client/img/icon/search.png" alt=""> </a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><?= htmlspecialchars($product['name']) ?></h6>
                            <a href="index.php?controller=product&action=detail&id=<?= $product['id'] ?>" class="add-cart">+
                                Thêm Vào Giỏ</a>
                            <h5><?= number_format($gia_ban, 0, ',', '.') ?>đ</h5>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- Product Section End -->