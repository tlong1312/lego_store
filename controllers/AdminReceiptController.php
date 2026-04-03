<?php
require_once 'models/ReceiptModel.php';
require_once 'models/ProductModel.php';

class AdminReceiptController extends BaseController
{


    public function index()
    {
        $receiptModel = new ReceiptModel();
        $receipts = $receiptModel->getAllReceipts();
        $totalReceipts = $receiptModel->getTotalReceiptsCount();
        $completedReceipts = $receiptModel->getTotalReceiptsCount(1);

        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/receipt_list.php';
        require_once 'views/layouts/admin_footer.php';
    }


    public function create()
    {
        $receiptModel = new ReceiptModel();


        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1;

        $newReceiptId = $receiptModel->createDraftReceipt($user_id);

        if ($newReceiptId) {
            header("Location: index.php?controller=AdminReceipt&action=edit&id=" . $newReceiptId);
            exit();
        }
    }


    public function edit()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $receiptModel = new ReceiptModel();

            $receipt = $receiptModel->getReceiptById($id);
            $is_completed = ($receipt['status'] == 1);
            $details = $receiptModel->getReceiptDetails($id);


            $productModel = new ProductModel();
            $products = $productModel->getAllProducts();

            require_once 'views/layouts/admin_header.php';
            require_once 'views/admin/receipt_form.php';
            require_once 'views/layouts/admin_footer.php';
        }
    }


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


    public function removeDetail()
    {
        if (isset($_GET['detail_id']) && isset($_GET['receipt_id'])) {
            $receiptModel = new ReceiptModel();
            $receiptModel->removeDetail($_GET['detail_id'], $_GET['receipt_id']);

            header("Location: index.php?controller=AdminReceipt&action=edit&id=" . $_GET['receipt_id']);
            exit();
        }
    }


    public function complete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['import_date'])) {
            $receiptId = (int) $_POST['id'];
            $importDate = $_POST['import_date']; 

            $receiptModel = new ReceiptModel();

            $details = $receiptModel->getReceiptDetails($receiptId);

            if (empty($details)) {
                header("Location: index.php?controller=AdminReceipt&action=edit&id=" . $receiptId . "&msg=empty_items");
                exit();
            }

            if ($receiptModel->completeReceipt($receiptId, $importDate)) {
                header("Location: index.php?controller=AdminReceipt&action=index&msg=completed");
            } else {
                header("Location: index.php?controller=AdminReceipt&action=edit&id=" . $receiptId . "&msg=error");
            }
            exit();
        }
        
        header("Location: index.php?controller=AdminReceipt&action=index");
        exit();
    }


    public function delete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $receiptModel = new ReceiptModel();


            $receipt = $receiptModel->getReceiptById($id);

            if ($receipt) {

                if ($receipt['status'] == 1) {
                    echo "<script>alert('LỖI: Không thể xóa phiếu nhập đã HOÀN THÀNH vì số lượng đã được cộng vào kho. Nếu có sai sót, vui lòng lập phiếu xuất kho để bù trừ!'); window.history.back();</script>";
                    exit();
                }


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