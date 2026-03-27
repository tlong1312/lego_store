<?php
require_once 'models/UserModel.php';

class AuthController extends BaseController
{

    public function login()
    {
        $this->view('layouts/client_header');
        $this->view('client/login');
        $this->view('layouts/client_footer');
    }

    public function register()
    {
        $this->view('layouts/client_header');
        $this->view('client/register');
        $this->view('layouts/client_footer');
    }

    public function adminLogin()
    {
        $this->view('admin/login');
    }

    public function processRegister()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fullname = trim($_POST['fullname'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirm = $_POST['confirm_password'] ?? '';
            $phone = trim($_POST['phone'] ?? '');

            $province = trim($_POST['province_name'] ?? '');
            $ward = trim($_POST['ward_name'] ?? '');
            $address = trim($_POST['address'] ?? '');

            $errors = [];

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email không đúng định dạng!';
            }

            if (!preg_match('/^(0[35789][0-9]{8})$/', $phone)) {
                $errors['phone'] = 'Số điện thoại phải gồm 10 số (Bắt đầu bằng 03, 05, 07, 08, 09).';
            }

            if ($password !== $confirm) {
                $errors['confirm_password'] = 'Mật khẩu xác nhận không khớp!';
            }
            if (empty($province)) {
                $errors['province'] = 'Vui lòng chọn Tỉnh/Thành!';
            }
            if (empty($ward)) {
                $errors['ward'] = 'Vui lòng chọn Phường/Xã!';
            }
            if (empty($address)) {
                $errors['address_detail'] = 'Vui lòng nhập Số nhà, Tên đường!';
            }

            $userModel = new UserModel();

            if (!isset($errors['email']) && $userModel->emailExists($email)) {
                $errors['email'] = 'Email này đã được sử dụng!';
            }

            if (!empty($errors)) {
                $_SESSION['register_errors'] = $errors;
                $_SESSION['old_data'] = $_POST;
                $this->redirect('index.php?controller=auth&action=register');
                return;
            }

            if ($userModel->register($fullname, $email, $password, $phone, $address, $ward, $province)) {
                $_SESSION['flash_type'] = 'success';
                $_SESSION['flash_msg'] = 'Đăng ký thành công! Vui lòng đăng nhập.';
                $this->redirect('index.php?controller=auth&action=login');
            } else {
                $_SESSION['flash_type'] = 'error';
                $_SESSION['flash_msg'] = 'Đăng ký thất bại, vui lòng thử lại!';
                $this->redirect('index.php?controller=auth&action=register');
            }
        }
    }

    public function processLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email-username'] ?? '');
            $password = $_POST['password'] ?? '';

            $userModel = new UserModel();
            $user = $userModel->login($email, $password);

            if ($user) {
                $_SESSION['user'] = $user;

                $_SESSION['flash_type'] = 'success';
                $_SESSION['flash_msg'] = 'Chào mừng ' . htmlspecialchars($user['fullname']) . ' trở lại!';

                if ($user['role'] == 'admin') {
                    $this->redirect('index.php?controller=dashboard&action=index');
                } else {
                    $this->redirect('index.php?controller=home&action=index');
                }
            } else {
                $_SESSION['flash_type'] = 'error';
                $_SESSION['flash_msg'] = 'Email hoặc mật khẩu không đúng, hoặc tài khoản bị khóa!';
                $_SESSION['old_email'] = $email;

                $this->redirect('index.php?controller=auth&action=login');
            }
        }
    }
    public function logout()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }
        $_SESSION['flash_type'] = 'success';
        $_SESSION['flash_msg'] = 'Đăng xuất thành công! Hẹn gặp lại bạn.';

        $this->redirect('index.php?controller=home&action=index');
    }
}

?>