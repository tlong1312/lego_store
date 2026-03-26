<?php
require_once 'models/OrderModel.php';

class AdminOrderController extends BaseController
{
    // Hàm hiển thị danh sách đơn hàng
    public function index()
    {
        $orderModel = new OrderModel();
        // Giả sử bạn có hàm getAllOrders trong Model
        $orders = $orderModel->getAllOrders();

        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/order_list.php';
        require_once 'views/layouts/admin_footer.php';
    }

    // Hàm hiển thị chi tiết đơn hàng
    public function detail()
    {
        if (isset($_GET['id'])) {
            $id = (int) $_GET['id'];
            $orderModel = new OrderModel();

            // Lấy thông tin đơn hàng và sản phẩm
            $order = $orderModel->getOrderById($id);
            $orderItems = $orderModel->getOrderItems($id);

            if ($order) {
                require_once 'views/layouts/admin_header.php';
                require_once 'views/admin/order_detail.php'; // Gọi View ở đây
                require_once 'views/layouts/admin_footer.php';
            } else {
                echo "Không tìm thấy đơn hàng!";
            }
        }
    }

    // Cập nhật trạng thái đơn hàng
    public function updateStatus()
    {
        if (isset($_GET['id']) && isset($_GET['status'])) {
            $id = (int) $_GET['id'];
            $status = (int) $_GET['status']; // 3 là Hủy

            $orderModel = new OrderModel();

            // Lấy thông tin đơn hàng hiện tại để kiểm tra
            $currentOrder = $orderModel->getOrderById($id);

            // NẾU TRẠNG THÁI MỚI LÀ "HỦY" VÀ ĐƠN NÀY CHƯA HỦY TRƯỚC ĐÓ -> TIẾN HÀNH HOÀN KHO
            if ($status === 3 && $currentOrder['status'] != 3) {
                $orderModel->restoreOrderStock($id);
            }

            // Gọi Model để cập nhật trạng thái xuống DB
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