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
        $rawData = $orderModel->getRevenueLast7Days();

        $chartDates = [];
        $chartRevenues = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = date('Y-m-d', strtotime("-$i days"));
            $chartDates[] = date('d/m', strtotime("-$i days")); 
            $revenue = 0;
            foreach ($rawData as $row) {
                if ($row['order_date'] == $date) {
                    $revenue = (int) $row['daily_revenue'];
                    break;
                }
            }
            $chartRevenues[] = $revenue;
        }

        $totalOrders = $orderModel->getTotalOrders();
        $totalRevenue = $orderModel->getTotalRevenue();
        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/dashboard.php';
        require_once 'views/layouts/admin_footer.php';
    }
}
?>