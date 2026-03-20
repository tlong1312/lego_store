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
            $address = trim($_POST['address'] ?? '');

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<script>alert('Email không hợp lệ!'); window.history.back();</script>";
                return;
            }

            if (!preg_match('/^(0[35789][0-9]{8})$/', $phone)) {
                echo "<script>alert('Số điện thoại không hợp lệ! Vui lòng nhập 10 số bắt đầu bằng 03x, 05x, 07x, 08x hoặc 09x.'); window.history.back();</script>";
                return;
            }

            if ($password !== $confirm) {
                echo "<script>alert('Mật khẩu xác nhận không khớp!'); window.history.back();</script>";
                return;
            }

            $userModel = new UserModel();

            if ($userModel->emailExists($email)) {
                echo "<script>alert('Email này đã được sử dụng!'); window.history.back();</script>";
                return;
            }

            if ($userModel->register($fullname, $email, $password, $phone, $address)) {
                echo "<script>alert('Đăng ký thành công! Vui lòng đăng nhập.'); window.location.href='index.php?controller=auth&action=login';</script>";
            } else {
                echo "<script>alert('Đăng ký thất bại, vui lòng thử lại!'); window.history.back();</script>";
            }
        }
    }

    public function processLogin()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email-username'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = new UserModel();
            $user = $userModel->login($email, $password);

            if ($user) {

                $_SESSION['user'] = $user;

                if ($user['role'] == 'admin') {
                    $this->redirect('index.php?controller=dashboard&action=index');
                } else {
                    $this->redirect('index.php?controller=home&action=index');
                }
            } else {
                echo "<script>alert('Email hoặc mật khẩu không đúng, hoặc tài khoản bị khóa!'); window.history.back();</script>";
            }
        }
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('index.php?controller=home&action=index');
    }
}

?>