<?php
class DashboardController extends BaseController{
    public function index(){
        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/dashboard.php';
        require_once 'views/layouts/admin_footer.php';
    }
}
?>