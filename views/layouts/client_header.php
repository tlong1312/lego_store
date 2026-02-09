<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="LEGO Store Template">
    <meta name="keywords" content="LEGO, Technic, City, Ninjago, Toy, Store">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LEGO Store | Thế Giới Lắp Ráp</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
    rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="public/client/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="public/client/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="public/client/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="public/client/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="public/client/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="public/client/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="public/client/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="public/client/css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin (Menu Mobile) -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <a href="#">Đăng nhập</a>
                <a href="#">Hỏi đáp</a>
            </div>
            <div class="offcanvas__top__hover">
                <span>VND <i class="arrow_carrot-down"></i></span>
                <ul>
                    <li>VND</li>
                    <li>USD</li>
                </ul>
            </div>
        </div>
        <div class="offcanvas__nav__option">
            <a href="#" class="search-switch"><img src="public/client/img/icon/search.png" alt=""></a>
            <a href="#"><img src="public/client/img/icon/heart.png" alt=""></a>
            <a href="./cart.php"><img src="public/client/img/icon/cart.png" alt=""> <span>0</span></a>
            <div class="price">0đ</div>
        </div>
        <div id="mobile-menu-wrap"></div>
        <div class="offcanvas__text">
            <p>Miễn phí giao hàng cho đơn từ 1.000.000đ - Đổi trả trong 30 ngày.</p>
        </div>
    </div>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7">
                        <div class="header__top__left">
                            <p>Miễn phí giao hàng cho đơn từ 1.000.000đ - Đổi trả trong 30 ngày.</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-5">
                        <div class="header__top__right">
                            <div class="header__top__links">
                                <a href="#">Đăng nhập</a>
                                <a href="#">Hỏi đáp</a>
                            </div>
                            <div class="header__top__hover">
                                <span>VND <i class="arrow_carrot-down"></i></span>
                                <ul>
                                    <li>VND</li>
                                    <li>USD</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="header__logo">
                        <a href="index.php?controller=home&action=index"><img src="public/client/img/logo.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="index.php?controller=home&action=index">Trang Chủ</a></li>
                            <li><a href="index.php?controller=product&action=index">Sản Phẩm</a></li>
                            <li><a href="#">Tiện Ích</a>
                                <ul class="dropdown">
                                    <li><a href="index.php?controller=cart&action=index">Giỏ Hàng</a></li>
                                    <li><a href="index.php?controller=cart&action=checkout">Thanh Toán</a></li>
                                    <li><a href="./detail.php">Chi Tiết Demo</a></li>
                                </ul>
                            </li>
                            <li><a href="index.php?controller=contact&action=index">Liên Hệ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <a href="#" class="search-switch"><img src="public/client/img/icon/search.png" alt=""></a>
                        <a href="#"><img src="public/client/img/icon/heart.png" alt=""></a>
                        <a href="./cart.php"><img src="public/client/img/icon/cart.png" alt=""> <span>0</span></a>
                        <div class="price">0đ</div>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->