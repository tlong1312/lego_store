<?php
class AdminOrderController extends BaseController {
    // Danh sách đơn hàng (Tạm thời dùng chung view detail để test)
    public function index() {
        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/order_detail.php'; // Sau này sẽ là order_list.php
        require_once 'views/layouts/admin_footer.php';
    }
}
?>