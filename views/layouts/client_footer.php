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

<script>
$(document).ready(function() {
    // Chỉ thực thi mã này trên trang product list
    if ($('#product-list-container').length) {
        let currentPage = Number($('#product-list-data').data('current-page')) || 1;
        const $searchForm = $('#searchForm');
        const $filterForm = $('#filterForm');
        const $sortSelect = $('#sort-select');
        const $horizontalCategory = $('#horizontal-category-select');
        const $horizontalPrice = $('#horizontal-price-select');
        const $advancedFilterPanel = $('#advanced-filter-panel');
        const $toggleAdvancedBtn = $('#toggle-advanced-filter-btn');
        let isSyncingFilters = false;

        function refreshNiceSelect($elements) {
            if (!$.fn.niceSelect) {
                return;
            }

            $elements.each(function() {
                if ($(this).next('.nice-select').length) {
                    $(this).niceSelect('update');
                }
            });
        }

        function updateAdvancedToggleLabel() {
            if (!$advancedFilterPanel.length || !$toggleAdvancedBtn.length) {
                return;
            }

            const isHidden = $advancedFilterPanel.hasClass('is-hidden');
            $toggleAdvancedBtn.text(isHidden ? 'Tìm kiếm nâng cao' : 'Ẩn tìm kiếm nâng cao');
        }

        function setSidebarRadio(name, value, fallbackValue) {
            let $target = $filterForm.find(`input[name="${name}"][value="${value}"]`);
            if (!$target.length) {
                $target = $filterForm.find(`input[name="${name}"][value="${fallbackValue}"]`);
            }
            if ($target.length) {
                $target.prop('checked', true);
            }
        }

        function syncSidebarToHorizontal() {
            if (isSyncingFilters) {
                return;
            }

            isSyncingFilters = true;

            const categoryValue = $filterForm.find('input[name="category_id"]:checked').val() || '0';
            const priceValue = $filterForm.find('input[name="price_range"]:checked').val() || '';

            $horizontalCategory.val(categoryValue);
            $horizontalPrice.val(priceValue);
            refreshNiceSelect($horizontalCategory.add($horizontalPrice));

            isSyncingFilters = false;
        }

        function syncHorizontalToSidebar() {
            if (isSyncingFilters) {
                return;
            }

            isSyncingFilters = true;

            const categoryValue = String($horizontalCategory.val() || '0');
            const priceValue = String($horizontalPrice.val() || '');

            setSidebarRadio('category_id', categoryValue, '0');
            setSidebarRadio('price_range', priceValue, '');

            isSyncingFilters = false;
        }

        function buildUrl(params) {
            const query = new URLSearchParams(params).toString();
            return `index.php?controller=product&action=index&${query}`;
        }

        function collectFilterParams(page = 1) {
            return {
                page: page,
                keyword: $searchForm.find('input[name="keyword"]').val() || '',
                category_id: $horizontalCategory.val() || 0,
                price_range: $horizontalPrice.val() || '',
                price_from: '',
                price_to: '',
                sort: $sortSelect.val() || ''
            };
        }

        function scrollToShopTop() {
            const $shopSection = $('.shop');
            if ($shopSection.length) {
                const top = Math.max(0, $shopSection.offset().top - 20);
                window.scrollTo({ top: top, behavior: 'smooth' });
            } else {
                window.scrollTo({ top: 0, behavior: 'smooth' });
            }
        }

        function fetchProducts(params, shouldScrollTop = false) {
            currentPage = params.page || 1;

            // Hiển thị hiệu ứng loading
            $('#product-list-container').append('<div class="loading-overlay"><div class="loader"></div><span>Đang tải sản phẩm...</span></div>');

            $.ajax({
                url: 'index.php?controller=product&action=filter',
                type: 'GET',
                data: params,
                success: function(response) {
                    // Cập nhật URL trình duyệt
                    const newUrl = buildUrl(params);
                    history.pushState({path: newUrl}, '', newUrl);

                    // Cập nhật nội dung
                    $('#product-list-container').html(response);
                    
                    // Cập nhật thông tin số lượng sản phẩm
                    const totalProducts = $('#product-list-data').data('total-products');
                    const productCount = $('#product-list-data').data('product-count');
                    $('#product-count-info').text(`Hiển thị ${productCount} của ${totalProducts} sản phẩm`);


                    // Khởi tạo lại các plugin JS cho sản phẩm mới
                    $('.set-bg').each(function () {
                        var bg = $(this).data('setbg');
                        $(this).css('background-image', 'url(' + bg + ')');
                    });

                    if (shouldScrollTop) {
                        scrollToShopTop();
                    }
                },
                error: function() {
                    alert('Đã có lỗi xảy ra. Vui lòng thử lại.');
                    $('#product-list-container .loading-overlay').remove();
                }
            });
        }

        function applyFilters(page = 1, shouldScrollTop = false) {
            fetchProducts(collectFilterParams(page), shouldScrollTop);
        }

        syncSidebarToHorizontal();
        updateAdvancedToggleLabel();

        if ($toggleAdvancedBtn.length && $advancedFilterPanel.length) {
            $toggleAdvancedBtn.on('click', function() {
                $advancedFilterPanel.toggleClass('is-hidden');
                updateAdvancedToggleLabel();
                refreshNiceSelect($sortSelect.add($horizontalCategory).add($horizontalPrice));
            });
        }

        $filterForm.find('input[name="category_id"], input[name="price_range"]').on('change', function() {
            syncSidebarToHorizontal();
            applyFilters(1);
        });

        $horizontalCategory.on('change', function() {
            syncHorizontalToSidebar();
        });

        $horizontalPrice.on('change', function() {
            syncHorizontalToSidebar();
        });

        // Chỉ thực thi lọc khi bấm nút Lọc ở thanh ngang
        $searchForm.on('submit', function(e) {
            e.preventDefault();
            syncHorizontalToSidebar();
            applyFilters(1);
        });

        // Reset đồng thời từ khóa/sắp xếp và bộ lọc sidebar
        $('#filter-reset-btn').on('click', function() {
            const searchFormEl = $searchForm.get(0);
            if (searchFormEl) {
                searchFormEl.reset();
            }

            $searchForm.find('input[name="keyword"]').val('');
            $sortSelect.val('');
            $horizontalCategory.val('0');
            $horizontalPrice.val('');

            syncHorizontalToSidebar();
            refreshNiceSelect($sortSelect.add($horizontalCategory).add($horizontalPrice));

            applyFilters(1);
        });

        // Bắt sự kiện click vào phân trang
        $(document).on('click', '.product__pagination a', function(e) {
            e.preventDefault();
            const page = $(this).data('page');
            if (page) {
                applyFilters(page, true);
            }
        });
    }
});
</script>

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