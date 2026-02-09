<?php
class CartController extends BaseController{
    public function index() {
        require_once 'views/layouts/client_header.php';
        require_once 'views/client/cart.php';
        require_once 'views/layouts/client_footer.php';
    }

    // Checkout Page
    public function checkout() {
        require_once 'views/layouts/client_header.php';
        require_once 'views/client/checkout.php';
        require_once 'views/layouts/client_footer.php';
    }
}
?>