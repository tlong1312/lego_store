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
}
?>