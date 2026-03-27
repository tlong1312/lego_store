<?php
require_once 'models/OrderModel.php';

class AdminOrderController extends BaseController
{
    public function index()
    {
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        $date = isset($_GET['date']) ? trim($_GET['date']) : '';
        $status = isset($_GET['status']) ? trim($_GET['status']) : '';
        $sort = isset($_GET['sort']) ? trim($_GET['sort']) : 'newest';

        $ward = isset($_GET['ward']) ? trim($_GET['ward']) : '';

        $orderModel = new OrderModel();

        $wardsList = $orderModel->getDistinctWards();

        $orders = $orderModel->getAllOrders($keyword, $date, $status, $sort, $ward);

        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/order_list.php';
        require_once 'views/layouts/admin_footer.php';
    }

    public function detail()
    {
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
            $orderModel = new OrderModel();

            $order = $orderModel->getOrderById($id);
            $orderItems = $orderModel->getOrderItems($id);

            if ($order) {
                require_once 'views/layouts/admin_header.php';
                require_once 'views/admin/order_detail.php';
                require_once 'views/layouts/admin_footer.php';
            } else {
                echo "Không tìm thấy đơn hàng!";
            }
        }
    }

    public function updateStatus()
    {
        if (isset($_GET['id']) && isset($_GET['status'])) {
            $id = (int) $_GET['id'];
            $status = (int) $_GET['status'];

            $orderModel = new OrderModel();

            $currentOrder = $orderModel->getOrderById($id);

            if ($status === 3 && $currentOrder['status'] != 3) {
                $orderModel->restoreOrderStock($id);
            }

            $isSuccess = $orderModel->updateOrderStatus($id, $status);

            if ($isSuccess) {
                header("Location: index.php?controller=AdminOrder&action=detail&id=" . $id . "&msg=status_updated");
            } else {
                header("Location: index.php?controller=AdminOrder&action=detail&id=" . $id . "&msg=update_error");
            }
            exit();
        } else {
            header("Location: index.php?controller=AdminOrder&action=index");
            exit();
        }
    }
}
?>