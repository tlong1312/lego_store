<?php 
    $old_email = $_SESSION['old_email'] ?? '';
    unset($_SESSION['old_email']); 
?>

<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Đăng Nhập</h4>
                    <div class="breadcrumb__links">
                        <a href="index.php?controller=home&action=index">Trang chủ</a>
                        <span>Đăng nhập</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="checkout spad">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7 col-sm-10">

                <div style="
                    background: #fff;
                    border: 1px solid #e8e8e8;
                    box-shadow: 0 8px 40px rgba(0,0,0,0.08);
                    padding: 50px 45px 40px;
                ">
                    <div class="text-center mb-4">
                        <div style="
                            width: 64px; height: 64px;
                            background: #111;
                            border-radius: 50%;
                            display: inline-flex;
                            align-items: center;
                            justify-content: center;
                            margin-bottom: 16px;
                        ">
                            <i class="fa fa-user" style="color:#fff; font-size:26px;"></i>
                        </div>
                        <h5 style="font-weight:800; letter-spacing:2px; text-transform:uppercase; margin:0;">Đăng Nhập</h5>
                        <p style="color:#aaa; font-size:13px; margin-top:6px;">Chào mừng bạn trở lại LEGO Store</p>
                    </div>

                    <form action="index.php?controller=auth&action=processLogin" method="POST">
                        <div class="checkout__input">
                            <p>Email <span>*</span></p>
                            <input type="email" name="email-username"
                                   placeholder="example@email.com"
                                   style="color: #111;"
                                   value="<?= htmlspecialchars($old_email) ?>"
                                   required>
                        </div>

                        <div class="checkout__input">
                            <p>Mật khẩu <span>*</span></p>
                            <input type="password" name="password"
                                   placeholder="••••••••"
                                   style="color: #111;"
                                   required>
                        </div>

                        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px; font-size:13px;">
                            <label style="display:flex; align-items:center; gap:6px; cursor:pointer; color:#555;">
                                <input type="checkbox" name="remember" style="width:14px;height:14px;">
                                Ghi nhớ đăng nhập
                            </label>
                        </div>

                        <button type="submit" class="site-btn w-100"
                                style="padding:15px; font-size:13px; letter-spacing:3px; cursor:pointer;">
                            ĐĂNG NHẬP
                        </button>
                    </form>

                    <hr style="margin: 28px 0; border-color:#f0f0f0;">

                    <p class="text-center" style="font-size:13px; color:#777; margin:0;">
                        Chưa có tài khoản?
                        <a href="index.php?controller=auth&action=register"
                           style="color:#111; font-weight:700; text-decoration:underline;">
                            Đăng ký ngay
                        </a>
                    </p>
                </div>
                </div>
        </div>
    </div>
</section>