<?php
require_once 'BaseModel.php';

class ReceiptModel extends BaseModel
{

     
    public function getAllReceipts()
    {
        $sql = "SELECT r.*, u.fullname AS creator_name 
                FROM receipts r 
                LEFT JOIN users u ON r.user_id = u.id 
                ORDER BY r.id DESC";
        $result = $this->conn->query($sql);
        return $result && $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

     
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

     
    public function getReceiptDetails($receipt_id)
    {
         
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

     
    public function addDetail($receipt_id, $product_id, $quantity, $import_price)
    {
        $sql = "INSERT INTO receipt_details (receipt_id, product_id, quantity, import_price) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiii", $receipt_id, $product_id, $quantity, $import_price);
        $stmt->execute();

         
        $this->updateTotalAmount($receipt_id);
        return true;
    }

     
    public function removeDetail($detail_id, $receipt_id)
    {
        $sql = "DELETE FROM receipt_details WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $detail_id);
        $stmt->execute();

        $this->updateTotalAmount($receipt_id);
        return true;
    }

     
    private function updateTotalAmount($receipt_id)
    {
        $sql = "UPDATE receipts SET total_amount = IFNULL((SELECT SUM(quantity * import_price) FROM receipt_details WHERE receipt_id = ?), 0) WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $receipt_id, $receipt_id);
        $stmt->execute();
    }

    public function completeReceipt($receiptId) 
    {
        $sqlDetails = "SELECT product_id, quantity FROM receipt_details WHERE receipt_id = ?";
        $stmtDetails = $this->conn->prepare($sqlDetails);
        $stmtDetails->bind_param("i", $receiptId);
        $stmtDetails->execute();
        $details = $stmtDetails->get_result()->fetch_all(MYSQLI_ASSOC);

        foreach ($details as $item) {
            $productId = $item['product_id'];
            $qtyImport = (int)$item['quantity'];

            $sqlUpdateProd = "UPDATE products SET stock_quantity = stock_quantity + ? WHERE id = ?";
            $stmtUpdateProd = $this->conn->prepare($sqlUpdateProd);
            $stmtUpdateProd->bind_param("ii", $qtyImport, $productId);
            $stmtUpdateProd->execute();

            $sqlUpdateBatch = "UPDATE receipt_details SET remain_quantity = ? WHERE receipt_id = ? AND product_id = ?";
            $stmtUpdateBatch = $this->conn->prepare($sqlUpdateBatch);
            $stmtUpdateBatch->bind_param("iii", $qtyImport, $receiptId, $productId);
            $stmtUpdateBatch->execute();
        }

         
        $sqlUpdateReceipt = "UPDATE receipts SET status = 1 WHERE id = ?";
        $stmtReceipt = $this->conn->prepare($sqlUpdateReceipt);
        $stmtReceipt->bind_param("i", $receiptId);
        
        return $stmtReceipt->execute();
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

     
    public function getTotalReceiptsCount($status = '')
    {
        $sql = "SELECT COUNT(id) as total FROM receipts WHERE 1=1";
        $params = [];
        $types = "";

         
        if ($status !== '') {
            $sql .= " AND status = ?";
            $types .= "i";
            $params[] = (int)$status;
        }

        $stmt = $this->conn->prepare($sql);
        
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        
        return $result ? (int)$result['total'] : 0;
    }
}
?>