<?php
class BaseController {
    public function view($path, $data = []) {

        extract($data);

        $viewPath = "./views/" . $path . ".php";
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            echo "Lỗi: Không tìm thấy view tại " . $viewPath;
        }
    }

    public function redirect($url) {
        header("Location: " . $url);
        exit();
    }

    protected function requireAdminLogin() {
        if (!isset($_SESSION['user']) || !isset($_SESSION['user']['role']) || $_SESSION['user']['role'] !== 'admin') {
            $_SESSION['flash_type'] = 'warning';
            $_SESSION['flash_msg'] = 'Vui lòng đăng nhập tài khoản quản trị để truy cập trang này!';
            $this->redirect('index.php?controller=auth&action=adminLogin');
        }
    }
}
?>