<?php
require_once 'models/UserModel.php';

class AdminUserController extends BaseController {

    public function index() {
        $userModel = new UserModel();
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : "";
        $users = $userModel->getAllUsers($keyword);
        
        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/user_list.php';
        require_once 'views/layouts/admin_footer.php';
    }

    public function add() {
        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/user_form.php';
        require_once 'views/layouts/admin_footer.php';
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fullname = trim($_POST['fullname']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $address = trim($_POST['address']);
            $role = $_POST['role'];
            $password = trim($_POST['password']);
            
            if (empty($password)) {
                $password = "123456"; 
            }

            if (!empty($fullname) && !empty($email)) {
                $userModel = new UserModel();
                if ($userModel->addUser($fullname, $email, $password, $phone, $address, $role)) {
                    header("Location: index.php?controller=AdminUser&action=index&msg=success");
                    exit();
                } else {
                    echo "<script>alert('Lỗi: Thêm thất bại!'); window.history.back();</script>";
                    exit();
                }
            }
            echo "<script>alert('Lỗi: Vui lòng nhập đủ tên và email!'); window.history.back();</script>";
        }
    }

    public function updateStatus() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $is_locked = $_POST['is_locked']; // Đã đổi tên biến cho chuẩn
            
            $userModel = new UserModel();
            $result = $userModel->updateLockStatus($id, $is_locked);
            
            header('Content-Type: application/json');
            echo json_encode(['success' => $result]);
            exit();
        }
    }

    public function updateRole() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $role = $_POST['role']; 
            
            $userModel = new UserModel();
            $result = $userModel->updateRole($id, $role);
            
            header('Content-Type: application/json');
            echo json_encode(['success' => $result]);
            exit();
        }
    }
}
?>