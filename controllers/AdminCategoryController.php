<?php
require_once 'models/CategoryModel.php';

class AdminCategoryController extends BaseController {

    public function index() {
        $categoryModel = new CategoryModel();
        
        $keyword = "";
        if (isset($_GET['keyword']) && !empty(trim($_GET['keyword']))) {
            $keyword = trim($_GET['keyword']);
        }
        
        // Đổi biến thành $categories
        $categories = $categoryModel->getAllCategories($keyword);
        
        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/category_list.php'; // Đổi tên view
        require_once 'views/layouts/admin_footer.php';
    }

    // --- 4 ACTION BỔ SUNG CHO TÍNH NĂNG THÊM & SỬA ---

    // 1. Hiển thị form Thêm mới
    public function add() {
        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/category_form.php'; // Gọi chung 1 file form
        require_once 'views/layouts/admin_footer.php';
    }

    // 2. Xử lý lưu danh mục mới vào DB
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = trim($_POST['name']);
            if (!empty($name)) {
                $categoryModel = new CategoryModel();
                if ($categoryModel->addCategory($name)) {
                    header("Location: index.php?controller=AdminCategory&action=index&msg=success");
                    exit();
                }
            }
            echo "<script>alert('Lỗi: Tên danh mục không được để trống!'); window.history.back();</script>";
        }
    }

    // 3. Hiển thị form Chỉnh sửa (có dữ liệu cũ)
    public function edit() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $categoryModel = new CategoryModel();
            $category = $categoryModel->getCategoryById($id); // Lấy dữ liệu cũ
            
            if ($category) {
                require_once 'views/layouts/admin_header.php';
                require_once 'views/admin/category_form.php'; // Vẫn gọi chung file form đó
                require_once 'views/layouts/admin_footer.php';
            } else {
                echo "Không tìm thấy danh mục!";
            }
        }
    }

    // 4. Xử lý lưu cập nhật vào DB
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = trim($_POST['name']);
            
            if (!empty($name)) {
                $categoryModel = new CategoryModel();
                if ($categoryModel->updateCategory($id, $name)) {
                    header("Location: index.php?controller=AdminCategory&action=index&msg=updated");
                    exit();
                }
            }
            echo "<script>alert('Lỗi: Không thể cập nhật!'); window.history.back();</script>";
        }
    }

    public function delete() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $categoryModel = new CategoryModel();
            
            $isSuccess = $categoryModel->deleteCategory($id);
            if ($isSuccess) {
                // Đổi đường dẫn chuyển hướng về AdminCategory
                header("Location: index.php?controller=AdminCategory&action=index&msg=deleted");
                exit();
            } else {
                echo "<script>alert('Lỗi: Không thể xóa! Danh mục này có thể đang chứa sản phẩm.'); window.history.back();</script>";
            }
        }
    }
}
?>