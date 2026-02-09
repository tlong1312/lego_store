<?php
class ProductController extends BaseController{
    public function index() {
        require_once 'views/layouts/client_header.php';
        require_once 'views/client/product_list.php';
        require_once 'views/layouts/client_footer.php';
    }

    // ProductDetail
    public function detail() {
        require_once 'views/layouts/client_header.php';
        require_once 'views/client/detail.php';
        require_once 'views/layouts/client_footer.php';
    }
}
?>