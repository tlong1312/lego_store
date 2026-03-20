<?php
require_once 'models/ProductModel.php';
class DashboardController extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();
        $totalProducts = $productModel->getTotalProducts();
        require_once 'models/UserModel.php';
        $userModel = new UserModel();
        $totalCustomers = $userModel->getTotalCustomers();
        require_once 'models/OrderModel.php';
        $orderModel = new OrderModel();
        $totalOrders = $orderModel->getTotalOrders();
        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/dashboard.php';
        require_once 'views/layouts/admin_footer.php';
    }
}
?>