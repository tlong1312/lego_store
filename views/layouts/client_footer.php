<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="./home.php"><img src="public/client/img/logo.png" alt=""></a>
                    </div>
                    <p>Thế giới LEGO chính hãng - Nơi khơi nguồn sáng tạo và niềm vui lắp ráp cho mọi lứa tuổi.</p>
                    <a href="#"><img src="public/client/img/payment.png" alt=""></a>
                </div>
            </div>

            <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Sản Phẩm Hot</h6>
                    <ul>
                        <li><a href="#">LEGO Technic</a></li>
                        <li><a href="#">LEGO Star Wars</a></li>
                        <li><a href="#">LEGO City</a></li>
                        <li><a href="#">LEGO Ninjago</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Hỗ Trợ</h6>
                    <ul>
                        <li><a href="./contact.php">Liên Hệ</a></li>
                        <li><a href="#">Thanh Toán</a></li>
                        <li><a href="#">Chính Sách Giao Hàng</a></li>
                        <li><a href="#">Đổi Trả & Bảo Hành</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6>Bản Tin</h6>
                    <div class="footer__newslatter">
                        <p>Nhận thông tin về các bộ LEGO mới nhất và ưu đãi đặc biệt!</p>
                        <form action="#">
                            <input type="text" placeholder="Email của bạn...">
                            <button type="submit"><span class="icon_mail_alt"></span></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="footer__copyright__text">
                    <p>Bản quyền ©
                        <script>
                            document.write(new Date().getFullYear());
                        </script>
                        thuộc về LEGO Store | Dự án môn học PHP
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Section End -->

<!-- Search Begin -->
<div class="search-model">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="search-close-switch">+</div>
        <form class="search-model-form" action="index.php" method="GET">
            <input type="hidden" name="controller" value="product">
            <input type="hidden" name="action" value="index">
            <input type="text" name="keyword" id="search-input" placeholder="Tìm kiếm bộ lắp ráp...">
            <button type="submit" style="background: none; border: none; cursor: pointer;">
                <span class="icon_search"></span>
            </button>
        </form>
    </div>
</div>
<!-- Search End -->

<!-- Js Plugins -->
<script src="public/client/js/jquery-3.3.1.min.js"></script>
<script src="public/client/js/bootstrap.min.js"></script>
<script src="public/client/js/jquery.nice-select.min.js"></script>
<script src="public/client/js/jquery.nicescroll.min.js"></script>
<script src="public/client/js/jquery.magnific-popup.min.js"></script>
<script src="public/client/js/jquery.countdown.min.js"></script>
<script src="public/client/js/jquery.slicknav.js"></script>
<script src="public/client/js/mixitup.min.js"></script>
<script src="public/client/js/owl.carousel.min.js"></script>
<script src="public/client/js/main.js"></script>
</body>

</html>