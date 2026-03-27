<?php
require_once 'models/ProductModel.php';
require_once 'models/CategoryModel.php';

class AdminProductController extends BaseController
{

     
    public function index()
    {
        $productModel = new ProductModel();

         
        if (isset($_GET['keyword']) && !empty(trim($_GET['keyword']))) {
            $keyword = trim($_GET['keyword']);
             
            $products = $productModel->searchProductsByName($keyword);
        } else {
             
            $products = $productModel->getAllProducts();
        }

        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/product_list.php';
        require_once 'views/layouts/admin_footer.php';
    }

     
    public function add()
    {
         
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories();

        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/product_form.php';
        require_once 'views/layouts/admin_footer.php';
    }

     
    public function updateStock()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $stock_quantity = $_POST['stock_quantity'];

            $productModel = new ProductModel();
            $result = $productModel->updateStock($id, $stock_quantity);

             
            header('Content-Type: application/json');
            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
            exit();  
        }
    }

     
    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $status = $_POST['status'];  

            $productModel = new ProductModel();
            $result = $productModel->updateStatus($id, $status);

             
            header('Content-Type: application/json');
            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
            exit();
        }
    }

     
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             
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

             
            $low_stock_threshold = isset($_POST['low_stock_threshold']) && $_POST['low_stock_threshold'] !== '' ? (int)$_POST['low_stock_threshold'] : 5;

             
            $imageName = "";
            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $target_dir = "public/admin/assets/images/";

                 
                $imageName = time() . '_' . basename($_FILES["image"]["name"]);
                $target_file = $target_dir . $imageName;

                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            }

             
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
                $status,
                $low_stock_threshold  
            );

            if ($isSuccess) {
                header("Location: index.php?controller=AdminProduct&action=index&msg=success");
                exit();
            } else {
                echo "Có lỗi xảy ra khi lưu dữ liệu vào Database!";
            }
        }
    }

     
    public function edit()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $productModel = new ProductModel();
            $product = $productModel->getProductById($id);  

             
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
            
             
            $low_stock_threshold = isset($_POST['low_stock_threshold']) && $_POST['low_stock_threshold'] !== '' ? (int)$_POST['low_stock_threshold'] : 5;

            $imageName = $_POST['old_image'];  

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                 
                $target_dir = "public/admin/assets/images/";
                $imageName = time() . '_' . basename($_FILES["image"]["name"]);
                $target_file = $target_dir . $imageName;
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            }

             
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
                $status,
                $low_stock_threshold  
            );

            if ($isSuccess) {
                header("Location: index.php?controller=AdminProduct&action=index&msg=updated");
                exit();
            } else {
                echo "Có lỗi xảy ra khi cập nhật!";
            }
        }
    }

     
    public function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $productModel = new ProductModel();

            $product = $productModel->getProductById($id);

            if ($product) {
                $currentStock = isset($product['stock_quantity']) ? (int) $product['stock_quantity'] : 0;

                 
                if ($currentStock > 0) {
                    $productModel->updateStatus($id, 0);

                    header("Location: index.php?controller=AdminProduct&action=index&msg=hidden_due_to_stock");
                    exit();

                } else {
                     

                     
                    if (!empty($product['image'])) {
                        $imagePath = "public/admin/assets/images/" . $product['image'];  
                        if (file_exists($imagePath)) {
                            unlink($imagePath);
                        }
                    }

                    $isSuccess = $productModel->deleteProduct($id);

                    if ($isSuccess) {
                        header("Location: index.php?controller=AdminProduct&action=index&msg=delete_success");
                        exit();
                    } else {
                        header("Location: index.php?controller=AdminProduct&action=index&msg=delete_error");
                        exit();
                    }
                }
            } else {
                header("Location: index.php?controller=AdminProduct&action=index&msg=not_found");
                exit();
            }
        } else {
            header("Location: index.php?controller=AdminProduct&action=index");
            exit();
        }
    }

     
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

     
    public function checkStock() 
    {
        $stockAtDate = null;
        $searchedDate = '';
        $product = null;

        if (isset($_GET['id']) && isset($_GET['date'])) {
            $productId = (int)$_GET['id'];
            $searchedDate = $_GET['date'];

            require_once 'models/ProductModel.php';
            $productModel = new ProductModel();
            
            $product = $productModel->getProductById($productId);
            
            $stockAtDate = $productModel->getHistoricalStock($productId, $searchedDate);
        }

        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/product_stock_history.php';
        require_once 'views/layouts/admin_footer.php';
    }
}
?>