<!-- Footer Section Begin -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="footer__about">
                    <div class="footer__logo">
                        <a href="index.php?controller=home&action=index"><img src="public/client/img/logo.png" alt=""></a>
                    </div>
                    <p>Thế giới LEGO chính hãng - Nơi khơi nguồn sáng tạo và niềm vui lắp ráp cho mọi lứa tuổi.</p>
                    <a href="index.php?controller=cart&action=checkout"><img src="public/client/img/payment.png" alt=""></a>
                </div>
            </div>

            <div class="col-lg-2 offset-lg-1 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Sản Phẩm Hot</h6>
                    <ul>
                        <li><a href="index.php?controller=product&action=index&category_id=1">LEGO Technic</a></li>
                        <li><a href="index.php?controller=product&action=index&category_id=2">LEGO Star Wars</a></li>
                        <li><a href="index.php?controller=product&action=index&category_id=4">LEGO City</a></li>
                        <li><a href="index.php?controller=product&action=index&category_id=3">LEGO Harry Potter</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="footer__widget">
                    <h6>Hỗ Trợ</h6>
                    <ul>
            <li><a href="index.php?controller=contact&action=index">Liên Hệ</a></li>
            <li><a href="javascript:void(0);" style="cursor: default; color: #b2b2b2;">Chính Sách Giao Hàng</a></li>
            <li><a href="javascript:void(0);" style="cursor: default; color: #b2b2b2;">Đổi Trả & Bảo Hành</a></li>
        </ul>
                </div>
            </div>

            <div class="col-lg-3 offset-lg-1 col-md-6 col-sm-6">
                <div class="footer__widget">
                    <h6>Bản Tin</h6>
                    <div class="footer__newslatter">
                        <p>Nhận thông tin về các bộ LEGO mới nhất và ưu đãi đặc biệt!</p>
                        <form action="javascript:void(0);">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    #scrollTopBtn {
        display: none; 
        position: fixed;
        bottom: 20px;
        right: 30px;
        z-index: 99;
        border: none;
        outline: none;
        background-color: #e53637; 
        color: white;
        cursor: pointer;
        width: 50px;
        height: 50px;
        border-radius: 4px;
        font-size: 24px;
        line-height: 50px; 
        text-align: center; 
        transition: all 0.3s ease;
    }

    #scrollTopBtn:hover {
        background-color: #111; 
    }
</style>
<a id="scrollTopBtn" title="Lên trên cùng"><i class="fa fa-angle-up"></i></a>
<script>
    var scrollTopButton = document.getElementById("scrollTopBtn");

    window.onscroll = function() {
        if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
            scrollTopButton.style.display = "block";
        } else {
            scrollTopButton.style.display = "none";
        }
    };

    scrollTopButton.addEventListener('click', function(e) {
        e.preventDefault();
        window.scrollTo({top: 0, behavior: 'smooth'});
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.cancel-order-btn').forEach(function(button) {
        button.addEventListener('click', function (event) {
            event.preventDefault(); 
            
            const cancelUrl = this.href;
            const orderId = new URL(cancelUrl).searchParams.get("id");

            Swal.fire({
                title: 'Bạn chắc chắn muốn hủy?',
                text: "Đơn hàng #" + orderId + " sẽ bị hủy và không thể hoàn tác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Đồng ý hủy',
                cancelButtonText: 'Không'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = cancelUrl;
                }
            });
        });
    });
});
</script>
    <?php if (isset($_SESSION['flash_msg'])): ?>
        <script>
            Swal.fire({
                icon: '<?= $_SESSION['flash_type'] ?>', 
                title: 'Thông báo',
                text: '<?= $_SESSION['flash_msg'] ?>',
                timer: 3000, 
                showConfirmButton: false, 
                toast: true, 
                position: 'top-end' 
            });
        </script>
        <?php 
        unset($_SESSION['flash_msg']); 
        unset($_SESSION['flash_type']); 
        ?>
    <?php endif; ?>
</body>

</html>