<?php
require_once 'BaseModel.php';

class ReceiptModel extends BaseModel
{

    // 1. Lấy danh sách tất cả phiếu nhập
    public function getAllReceipts()
    {
        $sql = "SELECT r.*, u.fullname AS creator_name 
                FROM receipts r 
                LEFT JOIN users u ON r.user_id = u.id 
                ORDER BY r.id DESC";
        $result = $this->conn->query($sql);
        return $result && $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // 2. Tạo một phiếu nhập nháp mới (Cần truyền ID của Admin đang đăng nhập)
    public function createDraftReceipt($user_id)
    {
        $sql = "INSERT INTO receipts (user_id, status, total_amount) VALUES (?, 0, 0)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }
        return false;
    }

    // 3. Lấy thông tin 1 phiếu nhập
    public function getReceiptById($id)
    {
        $sql = "SELECT r.*, u.fullname AS creator_name 
                FROM receipts r 
                LEFT JOIN users u ON r.user_id = u.id 
                WHERE r.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    // 4. Lấy danh sách chi tiết các sản phẩm trong 1 phiếu nhập (ĐÃ SỬA THÀNH LEFT JOIN)
    public function getReceiptDetails($receipt_id)
    {
        // Dùng LEFT JOIN: Lấy toàn bộ chi tiết, nếu product bị xóa thì name, sku, image sẽ là NULL
        $sql = "SELECT d.*, p.name, p.sku, p.image 
                FROM receipt_details d 
                LEFT JOIN products p ON d.product_id = p.id 
                WHERE d.receipt_id = ? ORDER BY d.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $receipt_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result && $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // 5. Thêm 1 sản phẩm vào phiếu nhập
    public function addDetail($receipt_id, $product_id, $quantity, $import_price)
    {
        $sql = "INSERT INTO receipt_details (receipt_id, product_id, quantity, import_price) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiii", $receipt_id, $product_id, $quantity, $import_price);
        $stmt->execute();

        // Cập nhật lại tổng tiền
        $this->updateTotalAmount($receipt_id);
        return true;
    }

    // 6. Xóa 1 sản phẩm khỏi phiếu nhập
    public function removeDetail($detail_id, $receipt_id)
    {
        $sql = "DELETE FROM receipt_details WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $detail_id);
        $stmt->execute();

        $this->updateTotalAmount($receipt_id);
        return true;
    }

    // Cập nhật tổng tiền phiếu nhập
    private function updateTotalAmount($receipt_id)
    {
        $sql = "UPDATE receipts SET total_amount = IFNULL((SELECT SUM(quantity * import_price) FROM receipt_details WHERE receipt_id = ?), 0) WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $receipt_id, $receipt_id);
        $stmt->execute();
    }

    // 7. HÀM CHỐT PHIẾU
    public function completeReceipt($receipt_id)
    {
        $details = $this->getReceiptDetails($receipt_id);

        // Cấm chốt nếu phiếu rỗng
        if (empty($details))
            return false;

        // Đổi trạng thái phiếu thành 1 
        $sqlStatus = "UPDATE receipts SET status = 1 WHERE id = ?";
        $stmtStatus = $this->conn->prepare($sqlStatus);
        $stmtStatus->bind_param("i", $receipt_id);
        return $stmtStatus->execute();
    }

    public function deleteReceipt($id)
    {
        $sql = "DELETE FROM receipts WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>