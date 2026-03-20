<?php
class AdminOrderController extends BaseController
{
    public function index()
    {
        $orderModel = new OrderModel();

        // Nhận các giá trị lọc từ URL (nếu có)
        $statusFilter = isset($_GET['status']) ? $_GET['status'] : '';
        $keywordFilter = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        $dateFilter = isset($_GET['date']) ? $_GET['date'] : '';

        // Truyền xuống Model để lấy đúng dữ liệu
        $orders = $orderModel->getAllOrders($statusFilter, $keywordFilter, $dateFilter);

        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/order_list.php';
        require_once 'views/layouts/admin_footer.php';
    }

    // Xem chi tiết đơn hàng
    public function detail() {
        if (!isset($_GET['id']) || empty($_GET['id'])) {
            header("Location: index.php?controller=AdminOrder&action=index");
            exit();
        }

        $id = (int)$_GET['id'];
        $orderModel = new OrderModel();
        
        $order = $orderModel->getOrderById($id);

        // Nếu người dùng nhập bừa ID không tồn tại thì trả về trang danh sách
        if (!$order) {
            header("Location: index.php?controller=AdminOrder&action=index");
            exit();
        }

        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/order_detail.php';
        require_once 'views/layouts/admin_footer.php';
    }
}
?>