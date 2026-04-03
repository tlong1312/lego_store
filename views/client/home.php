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

<style>
    :root {
        --lego-red: #d52b1e;
        --lego-red-dark: #ab2015;
        --lego-black: #231f20;
        --lego-border: #e7eaee;
    }

    .home-product-card {
        border: 1px solid var(--lego-border);
        border-radius: 14px;
        overflow: hidden;
        transition: all 0.25s ease;
        margin-bottom: 30px;
        background: #fff;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.05);
    }

    .home-product-card:hover {
        box-shadow: 0 14px 28px rgba(15, 23, 42, 0.12);
        transform: translateY(-5px);
        border: 2px solid var(--lego-red);
    }

    .home-product-card .product__item__pic {
        border-bottom: 1px solid #edf1f5;
    }

    .home-product-card .product__item__pic .label {
        font-size: 12px;
        font-weight: 700;
        padding: 5px 12px;
        border-radius: 999px;
        background: var(--lego-red) !important;
        color: #fff;
        letter-spacing: 0;
        text-transform: none;
    }

    .home-product-card .product__item__image-link {
        display: block;
        cursor: pointer;
    }

    .home-product-card .product__item__text {
        padding: 16px;
    }

    .home-product-card .product__item__text h6 {
        font-weight: 700;
        margin-bottom: 14px;
        min-height: 44px;
        color: var(--lego-black);
    }

    .home-product-card .product__item__text h6 .product__item__title-link {
        color: var(--lego-black);
        position: static;
        opacity: 1;
        visibility: visible;
        display: inline;
        font-weight: 700;
        transition: color 0.2s ease;
    }

    .home-product-card .product__item__text h6 .product__item__title-link:hover {
        color: var(--lego-red);
    }

    .home-product-card:hover .product__item__text h6 {
        opacity: 1;
    }

    .home-product-card:hover .product__item__text h6 .product__item__title-link {
        top: auto;
        opacity: 1;
        visibility: visible;
    }

    .home-product-card .product__item__meta {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }

    .home-product-card .product__item__text h5 {
        color: var(--lego-red);
        font-weight: 800;
        margin-bottom: 0;
    }

    .home-product-card .product__cart-form {
        margin: 0;
        display: flex;
        width: 40px;
        height: 40px;
        flex: 0 0 40px;
    }

    .home-product-card .product__cart-btn {
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

    .home-product-card .product__cart-btn:hover {
        background: var(--lego-red);
        color: #fff;
    }

    .home-product-card .product__cart-btn.is-disabled {
        border-color: #d0d5dd;
        color: #d0d5dd;
        cursor: not-allowed;
        pointer-events: none;
    }
</style>

<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="filter__controls">
                    <li class="active" data-filter=".new-arrivals">Hàng Mới Về</li>
                </ul>
            </div>
        </div>
        <div class="row product__filter">
            <?php foreach ($latest_products as $product): ?>
                <?php
                $gia_ban = $product['import_price'] * (1 + $product['profit_margin'] / 100);
                $is_out_of_stock = ($product['stock_quantity'] <= 0);

                $imgName = htmlspecialchars($product['image']);
                $adminImgPath = "public/admin/assets/images/" . $imgName;
                $clientImgPath = "public/client/img/product/" . $imgName;
                $displayImg = file_exists($adminImgPath) ? $adminImgPath : $clientImgPath;
                ?>
                <div class="col-lg-3 col-md-6 col-sm-6 mix new-arrivals">
                    <div class="product__item home-product-card <?= $is_out_of_stock ? 'sold-out-item' : '' ?>">
                        <a href="index.php?controller=product&action=detail&id=<?= (int) $product['id'] ?>" class="product__item__pic set-bg product__item__image-link" data-setbg="<?= $displayImg ?>">
                            <?php if ($is_out_of_stock): ?>
                                <span class="label">Hết hàng</span>
                            <?php endif; ?>
                        </a>

                        <div class="product__item__text">
                            <h6>
                                <a class="product__item__title-link" href="index.php?controller=product&action=detail&id=<?= (int) $product['id'] ?>">
                                    <?= htmlspecialchars($product['name']) ?>
                                </a>
                            </h6>

                            <div class="product__item__meta">
                                <h5><?= number_format($gia_ban, 0, ',', '.') ?>đ</h5>
                                <?php if (!$is_out_of_stock): ?>
                                    <form class="product__cart-form" action="index.php?controller=cart&action=add" method="POST">
                                        <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="product__cart-btn" title="Thêm vào giỏ" aria-label="Thêm vào giỏ">
                                            <i class="fa fa-shopping-cart"></i>
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <button type="button" class="product__cart-btn is-disabled" title="Hết hàng" aria-label="Hết hàng">
                                        <i class="fa fa-shopping-cart"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
</div>
</div>
</section>
<!-- Product Section End -->