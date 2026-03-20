<?php
require_once 'models/ProductModel.php';
require_once 'models/CategoryModel.php';

class AdminProductController extends BaseController
{

    // Danh sách sản phẩm
    public function index()
    {
        $productModel = new ProductModel();

        // Kiểm tra xem trên URL có biến keyword (từ khóa tìm kiếm) hay không
        if (isset($_GET['keyword']) && !empty(trim($_GET['keyword']))) {
            $keyword = trim($_GET['keyword']);
            // Nếu có từ khóa -> Gọi hàm tìm kiếm
            $products = $productModel->searchProductsByName($keyword);
        } else {
            // Nếu không có từ khóa -> Lấy tất cả
            $products = $productModel->getAllProducts();
        }

        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/product_list.php';
        require_once 'views/layouts/admin_footer.php';
    }

    // Form thêm mới
    public function add()
    {
        //Lấy danh sách Categories từ DB truyền sang View
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories();

        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/product_form.php';
        require_once 'views/layouts/admin_footer.php';
    }

    // Action: Cập nhật tồn kho trực tiếp bằng AJAX
    public function updateStock()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $stock_quantity = $_POST['stock_quantity'];

            $productModel = new ProductModel();
            $result = $productModel->updateStock($id, $stock_quantity);

            // Trả về kết quả dạng JSON cho JavaScript đọc
            header('Content-Type: application/json');
            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
            exit(); // Ngừng chạy tiếp vì đây là API ngầm
        }
    }

    // Action: Cập nhật trạng thái trực tiếp bằng AJAX
    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $status = $_POST['status']; // Nhận giá trị 1 hoặc 0

            $productModel = new ProductModel();
            $result = $productModel->updateStatus($id, $status);

            // Trả về JSON
            header('Content-Type: application/json');
            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
            exit();
        }
    }

    // Xử lý lưu 
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy toàn bộ dữ liệu từ form
            $name = $_POST['name'];
            $sku = $_POST['sku'];
            $theme_id = $_POST['theme_id'];
            $piece_count = $_POST['piece_count'];
            $age_range = $_POST['age_range'];
            if ($age_range < 0) {
                echo "<script>alert('Lỗi: Độ tuổi không được là số âm!'); window.history.back();</script>";
                exit();
            }
            $stock_quantity = $_POST['stock_quantity'];
            $import_price = 0;
            $profit_margin = $_POST['profit_margin'];
            $status = $_POST['status'];
            $description = $_POST['description'];

            // Xử lý upload ảnh
            $imageName = "";
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "public/admin/assets/images/";

                // Đổi tên file để tránh trùng lặp
                $imageName = time() . '_' . basename($_FILES["image"]["name"]);
                $target_file = $target_dir . $imageName;

                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            }

            // Gọi Model để lưu vào DB
            $productModel = new ProductModel();
            $isSuccess = $productModel->addProduct(
                $theme_id,
                $sku,
                $name,
                $description,
                $piece_count,
                $age_range,
                $imageName,
                $stock_quantity,
                $import_price,
                $profit_margin,
                $status
            );

            if ($isSuccess) {
                header("Location: index.php?controller=AdminProduct&action=index&msg=success");
                exit();
            } else {
                echo "Có lỗi xảy ra khi lưu dữ liệu vào Database!";
            }
        }
    }

    // 1. Hiển thị form chỉnh sửa
    public function edit()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $productModel = new ProductModel();
            $product = $productModel->getProductById($id); // Lấy dữ liệu cũ

            //Lấy danh sách Categories từ DB để đổ vào thẻ Select trong form Sửa
            $categoryModel = new CategoryModel();
            $categories = $categoryModel->getAllCategories();

            if ($product) {
                require_once 'views/layouts/admin_header.php';
                require_once 'views/admin/product_edit.php';
                require_once 'views/layouts/admin_footer.php';
            } else {
                echo "Không tìm thấy sản phẩm!";
            }
        }
    }

    // 2. Xử lý lưu cập nhật
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $sku = $_POST['sku'];
            $theme_id = $_POST['theme_id'];
            $piece_count = $_POST['piece_count'];
            $age_range = $_POST['age_range'];
            if ($age_range < 0) {
                echo "<script>alert('Lỗi: Độ tuổi không được là số âm!'); window.history.back();</script>";
                exit();
            }
            $stock_quantity = $_POST['stock_quantity'];
            $import_price = $_POST['import_price'];
            $profit_margin = $_POST['profit_margin'];
            $status = $_POST['status'];
            $description = $_POST['description'];

            $imageName = $_POST['old_image']; // Mặc định lấy tên ảnh cũ

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                // Nếu người dùng có chọn file ảnh mới -> up file và đổi tên
                $target_dir = "public/admin/assets/images/";
                $imageName = time() . '_' . basename($_FILES["image"]["name"]);
                $target_file = $target_dir . $imageName;
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            }

            // Gọi Model để Update
            $productModel = new ProductModel();
            $isSuccess = $productModel->updateProduct(
                $id,
                $theme_id,
                $sku,
                $name,
                $description,
                $piece_count,
                $age_range,
                $imageName,
                $stock_quantity,
                $import_price,
                $profit_margin,
                $status
            );

            if ($isSuccess) {
                header("Location: index.php?controller=AdminProduct&action=index&msg=updated");
                exit();
            } else {
                echo "Có lỗi xảy ra khi cập nhật!";
            }
        }
    }

    // Xóa sản phẩm
    public function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $productModel = new ProductModel();

            // 1. Lấy thông tin sản phẩm
            $product = $productModel->getProductById($id);

            if ($product) {

                // Kiểm tra xem sản phẩm có đang bán không

                if ($product['status'] == 1) {

                    echo "<script>alert('Sản phẩm đang bán không thể xóa. Vui lòng chuyển trạng thái sang CHƯA BÁN trước khi xóa!'); window.history.back();</script>";
                    exit();
                }

                if (!empty($product['image'])) {
                    $imagePath = "public/admin/assets/images/" . $product['image'];
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }

                // 3. Xóa dữ liệu trong Database
                $isSuccess = $productModel->deleteProduct($id);

                if ($isSuccess) {
                    header("Location: index.php?controller=AdminProduct&action=index&msg=deleted");
                    exit();
                } else {
                    echo "<script>alert('Lỗi: Không thể xóa sản phẩm này khỏi cơ sở dữ liệu!'); window.history.back();</script>";
                }
            } else {
                echo "<script>alert('Sản phẩm không tồn tại!'); window.history.back();</script>";
            }
        }
    }

    // Hiển thị chi tiết 1 sản phẩm
    public function show()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $productModel = new ProductModel();

            $product = $productModel->getProductById($id);

            if ($product) {
                $selling_price = $product['import_price'] + ($product['import_price'] * $product['profit_margin'] / 100);

                require_once 'views/layouts/admin_header.php';
                require_once 'views/admin/product_detail.php';
                require_once 'views/layouts/admin_footer.php';
            } else {
                echo "<script>alert('Sản phẩm không tồn tại!'); window.history.back();</script>";
            }
        }
    }
}
?>