<?php
require_once 'BaseModel.php';

class OrderModel extends BaseModel
{

    public function createOrder($user_id, $fullname, $phone, $address, $ward, $province, $total_money, $payment_method) {
        $sql = "INSERT INTO orders (user_id, fullname, phone, shipping_address, shipping_ward, shipping_province, total_money, payment_method, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isssssds", $user_id, $fullname, $phone, $address, $ward, $province, $total_money, $payment_method);
        
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }
        return false;
    }

    public function createOrderDetail($order_id, $product_id, $quantity, $price)
    {
        $sql = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiid", $order_id, $product_id, $quantity, $price);
        return $stmt->execute();
    }

    public function reduceProductStock($product_id, $quantity)
    {
        $sql = "UPDATE products SET stock_quantity = stock_quantity - ? WHERE id = ? AND stock_quantity >= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $quantity, $product_id, $quantity);
        return $stmt->execute();
    }

    public function getOrderHistory($user_id)
    {
        $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }


     
     
    public function getAllOrders($keyword = '', $date = '', $status = '', $sort = 'newest', $ward = '')
    {
        $sql = "SELECT * FROM orders WHERE 1=1";
        $types = "";
        $params = [];

        if (!empty($keyword)) {
            $sql .= " AND (id LIKE ? OR fullname LIKE ? OR phone LIKE ?)";
            $types .= "sss";
            $searchTerm = "%$keyword%";
            $params[] = $searchTerm;
            $params[] = $searchTerm;
            $params[] = $searchTerm;
        }

        if (!empty($date)) {
            $sql .= " AND DATE(created_at) = ?";
            $types .= "s";
            $params[] = $date;
        }

        if ($status !== '') {
            $sql .= " AND status = ?";
            $types .= "i";
            $params[] = (int)$status;
        }

         
        if (!empty($ward)) {
            $sql .= " AND shipping_ward = ?";
            $types .= "s";
            $params[] = $ward;
        }

        if ($sort === 'ward') {
            $sql .= " ORDER BY shipping_ward ASC, created_at DESC";
        } else {
            $sql .= " ORDER BY created_at DESC";
        }

        $stmt = $this->conn->prepare($sql);

        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result && $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

     
    public function getOrderById($id)
    {
        $sql = "SELECT * FROM orders WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

     
    public function getTotalOrders()
    {
        $sql = "SELECT COUNT(id) as total FROM orders";
        $result = $this->conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['total'];
        }
        return 0;
    }

     
    public function getTotalRevenue()
    {
        $sql = "SELECT SUM(total_money) AS total_revenue FROM orders WHERE status = 2";
        $result = $this->conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['total_revenue'] ? $row['total_revenue'] : 0;
        }
        return 0;
    }

     
    public function getOrderItems($order_id)
    {
        $sql = "SELECT od.*, p.name, p.image 
                FROM order_details od 
                LEFT JOIN products p ON od.product_id = p.id 
                WHERE od.order_id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();

        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

     
    public function updateOrderStatus($id, $status)
    {
        $sql = "UPDATE orders SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $status, $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

     
    public function restoreOrderStock($order_id)
    {
         
        $sql = "SELECT product_id, quantity FROM order_details WHERE order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

         
        if (!empty($items)) {
            foreach ($items as $item) {
                $product_id = $item['product_id'];
                $quantity = $item['quantity'];

                 
                $sqlUpdate = "UPDATE products SET stock_quantity = stock_quantity + ? WHERE id = ?";
                $stmtUpdate = $this->conn->prepare($sqlUpdate);
                $stmtUpdate->bind_param("ii", $quantity, $product_id);
                $stmtUpdate->execute();
            }
        }
        return true;
    }

    public function getOrderByIdAndUser($order_id, $user_id) {
        $sql = "SELECT * FROM orders WHERE id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $order_id, $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function getOrderDetailsById($order_id) {
        $sql = "SELECT od.*, p.name, p.image 
                FROM order_details od 
                JOIN products p ON od.product_id = p.id 
                WHERE od.order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getDistinctWards() {
        $sql = "SELECT DISTINCT shipping_ward 
                FROM orders 
                WHERE shipping_ward IS NOT NULL AND shipping_ward != '' 
                ORDER BY shipping_ward ASC";
                
        $result = $this->conn->query($sql);
        return $result && $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function deductStockFIFO($productId, $qtyNeeded) 
    {
        $totalCost = 0; 
        $qtyRemainingToFulfill = $qtyNeeded; 

        $sql = "SELECT rd.receipt_id, rd.remain_quantity, rd.import_price
                FROM receipt_details rd
                JOIN receipts r ON rd.receipt_id = r.id
                WHERE rd.product_id = ? AND r.status = 1 AND rd.remain_quantity > 0
                ORDER BY r.created_at ASC";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $productId);
        $stmt->execute();
        $batches = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        foreach ($batches as $batch) {
            if ($qtyRemainingToFulfill <= 0) break; 

            $batchId = $batch['receipt_id'];
            $qtyInThisBatch = (int)$batch['remain_quantity'];
            $importPrice = (float)$batch['import_price'];

            if ($qtyInThisBatch >= $qtyRemainingToFulfill) {
                $newRemain = $qtyInThisBatch - $qtyRemainingToFulfill;
                $totalCost += $qtyRemainingToFulfill * $importPrice; 
                
                $this->updateBatchRemain($batchId, $productId, $newRemain);
                $qtyRemainingToFulfill = 0; 
            } else {
                $totalCost += $qtyInThisBatch * $importPrice; 
                $qtyRemainingToFulfill -= $qtyInThisBatch; 
                
                $this->updateBatchRemain($batchId, $productId, 0); 
            }
        }

        $sqlUpdateProd = "UPDATE products SET stock_quantity = stock_quantity - ? WHERE id = ?";
        $stmtUpdateProd = $this->conn->prepare($sqlUpdateProd);
        $stmtUpdateProd->bind_param("ii", $qtyNeeded, $productId);
        $stmtUpdateProd->execute();

        return $totalCost; 
    }

     
    private function updateBatchRemain($receiptId, $productId, $newRemain) {
        $sql = "UPDATE receipt_details SET remain_quantity = ? WHERE receipt_id = ? AND product_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $newRemain, $receiptId, $productId);
        $stmt->execute();
    }
}
?>