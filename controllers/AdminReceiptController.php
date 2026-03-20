<?php
require_once 'models/ReceiptModel.php';
require_once 'models/ProductModel.php';

class AdminReceiptController extends BaseController
{

    // 1. Hiển thị danh sách phiếu nhập
    public function index()
    {
        $receiptModel = new ReceiptModel();
        $receipts = $receiptModel->getAllReceipts();

        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/receipt_list.php';
        require_once 'views/layouts/admin_footer.php';
    }

    // 2. Tạo nhanh 1 phiếu nháp
    public function create()
    {
        $receiptModel = new ReceiptModel();

        // Lấy ID Admin đang đăng nhập
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;

        $newReceiptId = $receiptModel->createDraftReceipt($user_id);

        if ($newReceiptId) {
            header("Location: index.php?controller=AdminReceipt&action=edit&id=" . $newReceiptId);
            exit();
        }
    }

    // 3. Giao diện Sửa phiếu
    public function edit()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $receiptModel = new ReceiptModel();

            $receipt = $receiptModel->getReceiptById($id);
            $is_completed = ($receipt['status'] == 1);
            $details = $receiptModel->getReceiptDetails($id);

            // LẤY DANH SÁCH SẢN PHẨM
            $productModel = new ProductModel();
            $products = $productModel->getAllProducts();

            require_once 'views/layouts/admin_header.php';
            require_once 'views/admin/receipt_form.php';
            require_once 'views/layouts/admin_footer.php';
        }
    }

    // 4. Thêm 1 sản phẩm vào phiếu (AJAX)
    public function addDetail()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $receipt_id = $_POST['receipt_id'];
            $product_id = $_POST['product_id'];
            $quantity = $_POST['quantity'];
            $import_price = $_POST['import_price'];

            $receiptModel = new ReceiptModel();
            $receiptModel->addDetail($receipt_id, $product_id, $quantity, $import_price);

            header('Content-Type: application/json');
            echo json_encode(['success' => true]);
            exit();
        }
    }

    // 5. Xóa 1 dòng trong phiếu
    public function removeDetail()
    {
        if (isset($_GET['detail_id']) && isset($_GET['receipt_id'])) {
            $receiptModel = new ReceiptModel();
            $receiptModel->removeDetail($_GET['detail_id'], $_GET['receipt_id']);

            header("Location: index.php?controller=AdminReceipt&action=edit&id=" . $_GET['receipt_id']);
            exit();
        }
    }

    // 6. Action chốt phiếu (Hoàn thành)
    public function complete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $receiptModel = new ReceiptModel();
            $productModel = new ProductModel(); // Kéo ProductModel vào để làm việc

            // Bước 1: Gọi hàm hoàn thành phiếu (Chuyển status từ 0 sang 1)
            if ($receiptModel->completeReceipt($id)) {

                // Bước 2: Lấy toàn bộ danh sách sản phẩm vừa được nhập trong phiếu này ra
                $details = $receiptModel->getReceiptDetails($id);

                if ($details && count($details) > 0) {
                    foreach ($details as $item) {
                        $p_id = $item['product_id'];
                        $qty_nhap = $item['quantity'];
                        $gia_nhap = $item['import_price'];

                        // Đẩy dữ liệu vào hàm tính Bình Quân Gia Quyền bên ProductModel
                        $productModel->updateStockAndPriceAfterImport($p_id, $qty_nhap, $gia_nhap);
                    }
                }

                // Sau khi tính toán và cộng kho xong xuôi, đẩy về trang danh sách
                header("Location: index.php?controller=AdminReceipt&action=index&msg=completed");
                exit();
            } else {
                echo "<script>alert('Lỗi: Phiếu rỗng hoặc không thể chốt!'); window.history.back();</script>";
            }
        }
    }

    // 7. Action xóa phiếu nhập
    public function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $receiptModel = new ReceiptModel();

            // Lấy thông tin phiếu để kiểm tra trạng thái
            $receipt = $receiptModel->getReceiptById($id);

            if ($receipt) {
                // Không cho phép xóa phiếu đã hoàn thành (status = 1)
                if ($receipt['status'] == 1) {
                    echo "<script>alert('LỖI: Không thể xóa phiếu nhập đã HOÀN THÀNH vì số lượng đã được cộng vào kho. Nếu có sai sót, vui lòng lập phiếu xuất kho để bù trừ!'); window.history.back();</script>";
                    exit();
                }

                // Nếu là phiếu nháp (status = 0) -> Tiến hành xóa
                $isSuccess = $receiptModel->deleteReceipt($id);

                if ($isSuccess) {
                    header("Location: index.php?controller=AdminReceipt&action=index&msg=deleted");
                    exit();
                } else {
                    echo "<script>alert('Lỗi: Không thể xóa phiếu nhập này!'); window.history.back();</script>";
                }
            } else {
                echo "<script>alert('Phiếu nhập không tồn tại!'); window.history.back();</script>";
            }
        }
    }
}
?>