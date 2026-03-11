<?php
class AdminProductController extends BaseController {
    // Danh sách sản phẩm
    public function index() {
        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/product_list.php';
        require_once 'views/layouts/admin_footer.php';
    }

    // Form thêm mới
    public function add() {
        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/product_form.php';
        require_once 'views/layouts/admin_footer.php';
    }
    
    // Xử lý lưu (Tuần sau sẽ viết logic code ở đây)
    public function store() {
        echo "Đang xử lý lưu sản phẩm...";
    }

}
?>