<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="LEGO Store Template">
    <meta name="keywords" content="LEGO, Technic, City, Ninjago, Toy, Store">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LEGO Store | Thế Giới Lắp Ráp</title>
    <link rel="icon" type="image/png" href="public/client/img/icon/icon-lego.png">
    <link rel="shortcut icon" type="image/png" href="public/client/img/icon/icon-lego.png">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <?php
    $styleVersion = @filemtime(__DIR__ . '/../../public/client/css/style.css') ?: time();
    $headerKeyword = isset($_GET['keyword']) ? trim((string) $_GET['keyword']) : '';
    $headerThemes = [];

    try {
        $headerProductModel = new ProductModel();
        $headerThemes = $headerProductModel->getAllThemes();
    } catch (Throwable $e) {
        $headerThemes = [];
    }

    $headerCartCount = 0;
    if (!empty($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $cartItem) {
            $headerCartCount += (int) ($cartItem['quantity'] ?? 1);
        }
    }
    $headerCartBadge = $headerCartCount > 99 ? '99+' : (string) $headerCartCount;
    ?>

    <!-- Css Styles -->
    <link rel="stylesheet" href="public/client/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="public/client/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="public/client/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="public/client/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="public/client/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="public/client/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="public/client/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="public/client/css/style.css?v=<?= $styleVersion ?>" type="text/css">
</head>

<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <!-- Offcanvas Menu Begin (Menu Mobile) -->
    <div class="offcanvas-menu-overlay"></div>
    <div class="offcanvas-menu-wrapper">
        <div class="offcanvas__option">
            <div class="offcanvas__links">
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'customer'): ?>
                    <a href="index.php?controller=auth&action=profile">Tài khoản của tôi</a>
                    <a href="index.php?controller=auth&action=profile">Chỉnh sửa thông tin</a>
                    <a href="index.php?controller=auth&action=logout">Đăng xuất</a>
                <?php else: ?>
                    <a href="index.php?controller=auth&action=login">Đăng nhập</a>
                <?php endif; ?>
            </div>

        </div>
        <div class="offcanvas__nav__option">
            <form class="offcanvas__search-form" action="index.php" method="GET">
                <input type="hidden" name="controller" value="product">
                <input type="hidden" name="action" value="index">
                <input type="text" name="keyword" value="<?= htmlspecialchars($headerKeyword) ?>" placeholder="Tìm sản phẩm..." class="offcanvas__search-input">
                <button type="submit" class="offcanvas__search-btn" aria-label="Tìm kiếm">
                    <span class="icon_search"></span>
                </button>
            </form>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'customer'): ?>
                <a href="index.php?controller=cart&action=index" class="offcanvas__cart-link"><img src="public/client/img/icon/cart.png" alt="Giỏ hàng">
                    <?php if ($headerCartCount > 0): ?>
                        <span class="cart-badge"><?= $headerCartBadge ?></span>
                    <?php endif; ?>
                </a>
            <?php endif; ?>
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
                                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'customer'): ?>
                                    <a href="index.php?controller=auth&action=profile">Chào, <?= htmlspecialchars($_SESSION['user']['fullname']) ?></a>
                                    <a href="index.php?controller=auth&action=logout">Đăng xuất</a>
                                <?php else: ?>
                                    <a href="index.php?controller=auth&action=login">Đăng nhập</a>
                                    <a href="index.php?controller=auth&action=register">Đăng ký</a>
                                <?php endif; ?>
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
                        <a href="index.php?controller=home&action=index"><img src="public/client/img/logo.png"
                                alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <nav class="header__menu mobile-menu">
                        <?php
                        $current_controller = $_GET['controller'] ?? 'home';
                        $utility_controllers = ['cart', 'auth'];
                        ?>
                        <ul>
                            <li class="<?= ($current_controller == 'home') ? 'active' : '' ?>">
                                <a href="index.php?controller=home&action=index">Trang Chủ</a>
                            </li>
                            <li class="<?= ($current_controller == 'product') ? 'active' : '' ?>">
                                <a href="index.php?controller=product&action=index">Sản Phẩm</a>
                                <ul class="dropdown"
                                    style="min-width: 220px; max-height: 320px; overflow-y: auto; background: #fff; padding: 10px 0; border: 1px solid #ddd; border-radius: 4px;">
                                    <li style="padding: 8px 15px;" onmouseover="this.style.backgroundColor='#f0f0f0'"
                                        onmouseout="this.style.backgroundColor='transparent'">
                                        <a href="index.php?controller=product&action=index"
                                            style="color: #000; display: block; padding: 5px 0; white-space: nowrap;">Tất cả thương hiệu</a>
                                    </li>
                                    <?php foreach ($headerThemes as $headerTheme): ?>
                                        <li style="padding: 8px 15px;" onmouseover="this.style.backgroundColor='#f0f0f0'"
                                            onmouseout="this.style.backgroundColor='transparent'">
                                            <a href="index.php?controller=product&action=index&category_id=<?= (int) $headerTheme['id'] ?>"
                                                style="color: #000; display: block; padding: 5px 0; white-space: nowrap;"><?= htmlspecialchars($headerTheme['name']) ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <li class="<?= (in_array($current_controller, $utility_controllers)) ? 'active' : '' ?>">
                                <a href="#">Tiện Ích</a>
                                <ul class="dropdown"
                                    style="min-width: 200px; background: #fff; padding: 10px 0; border: 1px solid #ddd; border-radius: 4px;">
                                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'customer'): ?>
                                        <li style="padding: 8px 15px;" onmouseover="this.style.backgroundColor='#f0f0f0'"
                                            onmouseout="this.style.backgroundColor='transparent'">
                                            <a href="index.php?controller=auth&action=profile"
                                                style="color: #000; display: block; padding: 5px 0; white-space: nowrap;">Chỉnh
                                                Sửa Thông Tin</a>
                                        </li>
                                        <li style="padding: 8px 15px;" onmouseover="this.style.backgroundColor='#f0f0f0'"
                                            onmouseout="this.style.backgroundColor='transparent'">
                                            <a href="index.php?controller=cart&action=index"
                                                style="color: #000; display: block; padding: 5px 0;">Giỏ Hàng</a>
                                        </li>
                                        <li style="padding: 8px 15px;" onmouseover="this.style.backgroundColor='#f0f0f0'"
                                            onmouseout="this.style.backgroundColor='transparent'">
                                            <a href="index.php?controller=cart&action=checkout"
                                                style="color: #000; display: block; padding: 5px 0;">Thanh Toán</a>
                                        </li>
                                        <li style="padding: 8px 15px;" onmouseover="this.style.backgroundColor='#f0f0f0'"
                                            onmouseout="this.style.backgroundColor='transparent'">
                                            <a href="index.php?controller=cart&action=history"
                                                style="color: #000; display: block; padding: 5px 0; white-space: nowrap;">Lịch
                                                Sử Đơn Hàng</a>
                                        </li>
                                    <?php else: ?>
                                        <li style="padding: 8px 15px;" onmouseover="this.style.backgroundColor='#f0f0f0'"
                                            onmouseout="this.style.backgroundColor='transparent'">
                                            <a href="index.php?controller=auth&action=login"
                                                style="color: #000; display: block; padding: 5px 0;">Đăng nhập</a>
                                        </li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                            <li class="<?= ($current_controller == 'contact') ? 'active' : '' ?>">
                                <a href="index.php?controller=contact&action=index">Liên Hệ</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3 col-md-3">
                    <div class="header__nav__option">
                        <form class="header__search-form" action="index.php" method="GET">
                            <input type="hidden" name="controller" value="product">
                            <input type="hidden" name="action" value="index">
                            <input type="text" name="keyword" value="<?= htmlspecialchars($headerKeyword) ?>" placeholder="Tìm bộ LEGO..." class="header__search-input">
                            <button type="submit" class="header__search-btn" aria-label="Tìm kiếm">
                                <span class="icon_search"></span>
                            </button>
                        </form>
                        <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'customer'): ?>
                            <a href="index.php?controller=cart&action=index" class="header__cart-link"><img src="public/client/img/icon/cart.png"
                                    alt="Giỏ hàng">
                                <?php if ($headerCartCount > 0): ?>
                                    <span class="cart-badge"><?= $headerCartBadge ?></span>
                                <?php endif; ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="canvas__open"><i class="fa fa-bars"></i></div>
        </div>
    </header>
    <!-- Header Section End -->