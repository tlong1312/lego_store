<?php
require_once 'models/UserModel.php';

class AuthController extends BaseController
{

    private function requireCustomerLogin()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'customer') {
            $_SESSION['flash_type'] = 'warning';
            $_SESSION['flash_msg'] = 'Vui lòng đăng nhập tài khoản khách hàng để sử dụng trang này!';
            $this->redirect('index.php?controller=auth&action=login');
        }
    }

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
        $isAdmin = false;

        if ((isset($_GET['type']) && $_GET['type'] === 'admin') || 
            (isset($_SESSION['user']) && isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin')) {
            $isAdmin = true;
        } 

        if (isset($_SESSION['user'])) unset($_SESSION['user']);
        if (isset($_SESSION['admin'])) unset($_SESSION['admin']);
        if (isset($_COOKIE['admin_token'])) setcookie('admin_token', '', time() - 3600, '/');
        if (isset($_COOKIE['user_token'])) setcookie('user_token', '', time() - 3600, '/');

        $_SESSION['flash_type'] = 'success';
        $_SESSION['flash_msg'] = 'Đăng xuất thành công! Hẹn gặp lại bạn.';

        $url = $isAdmin ? 'index.php?controller=auth&action=adminlogin' : 'index.php?controller=home&action=index';

        echo "<script>
            localStorage.removeItem('admin_logged_in');
            
            // Chuyển hướng (Dùng replace để không lưu trang Logout vào lịch sử nút Back)
            window.location.replace('{$url}');
        </script>";
        exit();
    }

    public function profile()
    {
        $this->requireCustomerLogin();

        $userModel = new UserModel();
        $user = $userModel->getUserById((int) $_SESSION['user']['id']);

        if (!$user) {
            unset($_SESSION['user']);
            $_SESSION['flash_type'] = 'error';
            $_SESSION['flash_msg'] = 'Không tìm thấy tài khoản. Vui lòng đăng nhập lại!';
            $this->redirect('index.php?controller=auth&action=login');
        }

        $_SESSION['user'] = $user;

        $data['user'] = $user;
        $data['supports_region'] = $userModel->supportsUserRegionFields();
        $data['profile_errors'] = $_SESSION['profile_errors'] ?? [];
        $data['profile_old'] = $_SESSION['profile_old'] ?? [];
        $data['password_errors'] = $_SESSION['password_errors'] ?? [];

        unset($_SESSION['profile_errors']);
        unset($_SESSION['profile_old']);
        unset($_SESSION['password_errors']);

        $this->view('layouts/client_header');
        $this->view('client/profile', $data);
        $this->view('layouts/client_footer');
    }

    public function updateProfile()
    {
        $this->requireCustomerLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('index.php?controller=auth&action=profile');
        }

        $fullname = trim($_POST['fullname'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $address = trim($_POST['address'] ?? '');
        $province = trim($_POST['province_name'] ?? ($_POST['province'] ?? ''));
        $ward = trim($_POST['ward_name'] ?? ($_POST['ward'] ?? ''));
        $wardHasOptions = (int) ($_POST['ward_has_options'] ?? 0);

        $userModel = new UserModel();
        $supportsRegion = $userModel->supportsUserRegionFields();
        $currentUser = $userModel->getUserById((int) $_SESSION['user']['id']);

        if (!$currentUser) {
            $_SESSION['flash_type'] = 'error';
            $_SESSION['flash_msg'] = 'Không tìm thấy tài khoản hiện tại. Vui lòng đăng nhập lại!';
            $this->redirect('index.php?controller=auth&action=login');
        }

        $errors = [];

        if ($fullname === '') {
            $errors['fullname'] = 'Vui lòng nhập họ tên.';
        }

        if ($phone === '') {
            $errors['phone'] = 'Vui lòng nhập số điện thoại.';
        } elseif (!preg_match('/^(0[35789][0-9]{8})$/', $phone)) {
            $errors['phone'] = 'Số điện thoại phải gồm 10 số (Bắt đầu bằng 03, 05, 07, 08, 09).';
        }

        if ($address === '') {
            $errors['address'] = 'Vui lòng nhập địa chỉ chi tiết.';
        }

        if ($supportsRegion && $province === '') {
            $errors['province'] = 'Vui lòng chọn Tỉnh/Thành.';
        }

        if ($supportsRegion && $wardHasOptions === 1 && $ward === '') {
            $errors['ward'] = 'Vui lòng chọn Phường/Xã.';
        }

        if ($supportsRegion && $ward === '') {
            $ward = trim((string) ($currentUser['ward'] ?? ''));
        }

        if (!empty($errors)) {
            $_SESSION['profile_errors'] = $errors;
            $_SESSION['profile_old'] = [
                'fullname' => $fullname,
                'phone' => $phone,
                'address' => $address,
                'province' => $province,
                'ward' => $ward
            ];
            $_SESSION['flash_type'] = 'error';
            $_SESSION['flash_msg'] = 'Thông tin chưa hợp lệ, vui lòng kiểm tra lại!';
            $this->redirect('index.php?controller=auth&action=profile');
        }

        $oldFullname = trim((string) ($currentUser['fullname'] ?? ''));
        $oldPhone = trim((string) ($currentUser['phone'] ?? ''));
        $oldAddress = trim((string) ($currentUser['address'] ?? ''));
        $oldProvince = trim((string) ($currentUser['province'] ?? ''));
        $oldWard = trim((string) ($currentUser['ward'] ?? ''));

        $noChanges = ($fullname === $oldFullname)
            && ($phone === $oldPhone)
            && ($address === $oldAddress)
            && (!$supportsRegion || (($province === $oldProvince) && ($ward === $oldWard)));

        if ($noChanges) {
            unset($_SESSION['profile_old']);
            $_SESSION['flash_type'] = 'warning';
            $_SESSION['flash_msg'] = 'Thông tin chưa thay đổi.';
            $this->redirect('index.php?controller=auth&action=profile');
        }

        $updated = $userModel->updateCustomerProfile(
            (int) $_SESSION['user']['id'],
            $fullname,
            $phone,
            $address,
            $province,
            $ward
        );

        if ($updated) {
            $freshUser = $userModel->getUserById((int) $_SESSION['user']['id']);
            $isSynced = $freshUser
                && trim((string) ($freshUser['fullname'] ?? '')) === $fullname
                && trim((string) ($freshUser['phone'] ?? '')) === $phone
                && trim((string) ($freshUser['address'] ?? '')) === $address
                && (!$supportsRegion || (
                    trim((string) ($freshUser['province'] ?? '')) === $province
                    && trim((string) ($freshUser['ward'] ?? '')) === $ward
                ));

            if ($isSynced) {
                $_SESSION['user'] = $freshUser;
                unset($_SESSION['profile_old']);
                $_SESSION['flash_type'] = 'success';
                $_SESSION['flash_msg'] = 'Cập nhật thông tin thành công!';
            } else {
                $_SESSION['profile_errors'] = ['general' => 'Dữ liệu chưa được cập nhật như mong đợi. Vui lòng thử lại!'];
                $_SESSION['profile_old'] = [
                    'fullname' => $fullname,
                    'phone' => $phone,
                    'address' => $address,
                    'province' => $province,
                    'ward' => $ward
                ];
                $_SESSION['flash_type'] = 'error';
                $_SESSION['flash_msg'] = 'Không thể đồng bộ thông tin vừa lưu. Vui lòng thử lại!';
            }
        } else {
            $_SESSION['flash_type'] = 'error';
            $_SESSION['flash_msg'] = 'Không thể cập nhật thông tin. Vui lòng thử lại!';
        }

        $this->redirect('index.php?controller=auth&action=profile');
    }

    public function changePassword()
    {
        $this->requireCustomerLogin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('index.php?controller=auth&action=profile');
        }

        $oldPassword = $_POST['old_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';

        $errors = [];

        if ($oldPassword === '') {
            $errors['old_password'] = 'Vui lòng nhập mật khẩu hiện tại.';
        }

        if (strlen($newPassword) < 6) {
            $errors['new_password'] = 'Mật khẩu mới phải có ít nhất 6 ký tự.';
        }

        if ($newPassword !== $confirmPassword) {
            $errors['confirm_password'] = 'Mật khẩu xác nhận không khớp.';
        }

        if ($oldPassword !== '' && $newPassword !== '' && $oldPassword === $newPassword) {
            $errors['new_password'] = 'Mật khẩu mới phải khác mật khẩu hiện tại.';
        }

        $userModel = new UserModel();

        if (empty($errors) && !$userModel->verifyCurrentPassword((int) $_SESSION['user']['id'], $oldPassword)) {
            $errors['old_password'] = 'Mật khẩu hiện tại không chính xác.';
        }

        if (!empty($errors)) {
            $_SESSION['password_errors'] = $errors;
            $_SESSION['flash_type'] = 'error';
            $_SESSION['flash_msg'] = 'Đổi mật khẩu thất bại. Vui lòng kiểm tra lại!';
            $this->redirect('index.php?controller=auth&action=profile');
        }

        if ($userModel->updateUserPassword((int) $_SESSION['user']['id'], $newPassword)) {
            $_SESSION['flash_type'] = 'success';
            $_SESSION['flash_msg'] = 'Đổi mật khẩu thành công!';
        } else {
            $_SESSION['flash_type'] = 'error';
            $_SESSION['flash_msg'] = 'Không thể đổi mật khẩu. Vui lòng thử lại!';
        }

        $this->redirect('index.php?controller=auth&action=profile');
    }

    
    
}

?>