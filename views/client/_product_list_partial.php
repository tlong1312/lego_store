<?php
// File: views/client/_product_list_partial.php
?>
<div class="row" id="product-list-row">
    <?php if (empty($products)): ?>
        <div class="col-lg-12">
            <div class="text-center" style="padding: 50px 0;">
                <h4>Không tìm thấy sản phẩm nào phù hợp.</h4>
                <p>Vui lòng thử lại với bộ lọc khác.</p>
            </div>
        </div>
    <?php else: ?>
        <?php foreach ($products as $product): ?>
            <?php
            $gia_ban = $product['import_price'] * (1 + $product['profit_margin'] / 100);
            $is_out_of_stock = ($product['stock_quantity'] <= 0);

            $imgName = htmlspecialchars($product['image']);
            $adminImgPath = "public/admin/assets/images/" . $imgName;
            $clientImgPath = "public/client/img/product/" . $imgName;

            $displayImg = file_exists($adminImgPath) ? $adminImgPath : $clientImgPath;
            ?>
            <div class="col-lg-4 col-md-6 col-sm-6 product-card">
                <div class="product__item <?= $is_out_of_stock ? 'sold-out-item' : '' ?>">
                    <a href="index.php?controller=product&action=detail&id=<?= $product['id'] ?>" class="product__item__pic set-bg product__item__image-link" data-setbg="<?= $displayImg ?>">
                        <?php if ($is_out_of_stock): ?>
                            <span class="label" style="background: #e53935; color: #fff;">Hết hàng</span>
                        <?php endif; ?>
                    </a>
                    <div class="product__item__text">
                        <h6><?= htmlspecialchars($product['name']) ?></h6>

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
                                <button type="button" class="product__cart-btn is-disabled" title="Hết hàng">
                                    <i class="fa fa-shopping-cart"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="product__pagination">
            <?php
            if ($current_page > 1): ?>
                <a href="#" data-page="<?= $current_page - 1 ?>">&lt;</a>
            <?php endif;

            if ($current_page > 3): ?>
                <a href="#" data-page="1">1</a>
                <?php if ($current_page > 4): ?>
                    <span class="pagination-dots">...</span>
                <?php endif;
            endif;

            $start = max(1, $current_page - 2);
            $end = min($total_pages, $current_page + 2);

            for ($i = $start; $i <= $end; $i++): ?>
                <a class="<?= ($i == $current_page) ? 'active' : '' ?>" href="#" data-page="<?= $i ?>">
                    <?= $i ?>
                </a>
            <?php endfor;

            if ($current_page < $total_pages - 2): ?>
                <?php if ($current_page < $total_pages - 3): ?>
                    <span class="pagination-dots">...</span>
                <?php endif; ?>
                <a href="#" data-page="<?= $total_pages ?>"><?= $total_pages ?></a>
            <?php endif;

            if ($current_page < $total_pages): ?>
                <a href="#" data-page="<?= $current_page + 1 ?>">&gt;</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<div id="product-list-data" 
     data-total-products="<?= $total_products ?>"
     data-product-count="<?= count($products) ?>"
     data-current-page="<?= $current_page ?>">
</div>
