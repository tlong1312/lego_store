<?php
require_once 'models/UserModel.php';

class AdminUserController extends BaseController
{

    public function index()
    {
        $userModel = new UserModel();

        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : "";

        $role = isset($_GET['role']) ? $_GET['role'] : "";

        $users = $userModel->getAllUsers($keyword, $role);

        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/user_list.php';
        require_once 'views/layouts/admin_footer.php';
    }

    public function add()
    {
        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/user_form.php';
        require_once 'views/layouts/admin_footer.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             
            $fullname = trim($_POST['fullname']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $address = trim($_POST['address']);
            $role = $_POST['role'];
            $password = trim($_POST['password']);

             
            if (empty($fullname) || empty($email)) {
                header("Location: index.php?controller=AdminUser&action=add&msg=empty_fields");
                exit();
            }

             
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: index.php?controller=AdminUser&action=add&msg=invalid_email");
                exit();
            }

             
            if (!empty($phone) && !preg_match("/^0[35789][0-9]{8}$/", $phone)) {
                header("Location: index.php?controller=AdminUser&action=add&msg=invalid_phone");
                exit();
            }

             
            if (empty($password)) {
                $password = "123456";
            }

             
            $userModel = new UserModel();
            if ($userModel->checkEmailExists($email)) {
                header("Location: index.php?controller=AdminUser&action=add&msg=duplicate_email");
                exit();
            }

             
            if ($userModel->addUser($fullname, $email, $password, $phone, $address, $role)) {
                header("Location: index.php?controller=AdminUser&action=index&msg=success");
                exit();
            } else {
                header("Location: index.php?controller=AdminUser&action=add&msg=error");
                exit();
            }
        }
    }

    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $is_locked = $_POST['is_locked'];

            $userModel = new UserModel();
            $result = $userModel->updateLockStatus($id, $is_locked);

            header('Content-Type: application/json');
            echo json_encode(['success' => $result]);
            exit();
        }
    }

    public function updateRole()
    {
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


     

    public function checkEmail()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = isset($_POST['email']) ? trim($_POST['email']) : '';

             
            $id = isset($_POST['id']) ? $_POST['id'] : null;

            if (!empty($email)) {
                $userModel = new UserModel();
                if ($userModel->checkEmailExists($email, $id)) {
                     
                    echo json_encode(['status' => 'exists']);
                } else {
                     
                    echo json_encode(['status' => 'available']);
                }
            }
            exit();
        }
    }
}
?>