<?php
class CartController extends BaseController{

    private function checkLogin() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'customer') {
            echo "<script>alert('Vui lòng đăng nhập tài khoản Khách hàng để sử dụng giỏ hàng!'); window.location.href='index.php?controller=auth&action=login';</script>";
            exit();
        }
    }


    public function index() {
        $this->checkLogin();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $data['cart'] = $_SESSION['cart'];

        $this->view('layouts/client_header');
        $this->view('client/cart', $data);
        $this->view('layouts/client_footer');
    }

    // Checkout Page
    public function checkout() {
        require_once 'views/layouts/client_header.php';
        require_once 'views/client/checkout.php';
        require_once 'views/layouts/client_footer.php';
    }
}
?>