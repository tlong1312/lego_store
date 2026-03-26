<?php
require_once 'BaseModel.php';

class OrderModel extends BaseModel {

    public function createOrder($user_id, $fullname, $phone, $address, $total_money, $payment_method) {
        $sql = "INSERT INTO orders (user_id, fullname, phone, shipping_address, total_money, payment_method, status) 
                VALUES (?, ?, ?, ?, ?, ?, 0)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isssds", $user_id, $fullname, $phone, $address, $total_money, $payment_method);
        
        if ($stmt->execute()) {
            return $this->conn->insert_id;
        }
        return false;
    }

    public function createOrderDetail($order_id, $product_id, $quantity, $price) {
        $sql = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiid", $order_id, $product_id, $quantity, $price);
        return $stmt->execute();
    }

    public function reduceProductStock($product_id, $quantity) {
        $sql = "UPDATE products SET stock_quantity = stock_quantity - ? WHERE id = ? AND stock_quantity >= ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $quantity, $product_id, $quantity);
        return $stmt->execute();
    }

    public function getOrderHistory($user_id) {
        $sql = "SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
    

    // 1. Lấy danh sách đơn hàng (lọc theo trạng thái)
       public function getAllOrders($status = '', $keyword = '', $date = '') {
        $sql = "SELECT * FROM orders WHERE 1=1";
        $params = [];
        $types = "";

        // 1. Lọc theo trạng thái
        if ($status !== '') {
            $sql .= " AND status = ?";
            $params[] = (int)$status;
            $types .= "i";
        }

        // 2. Lọc theo từ khóa (Mã đơn hàng, Tên khách hàng, Số điện thoại)
        if ($keyword !== '') {
            $clean_keyword = str_ireplace('#DH', '', trim($keyword));
            $id_search = is_numeric($clean_keyword) ? (int)$clean_keyword : 0;
            
            $search_like = "%" . trim($keyword) . "%";
            
            $sql .= " AND (id = ? OR fullname LIKE ? OR phone LIKE ?)";
            $params[] = $id_search;
            $params[] = $search_like;
            $params[] = $search_like;
            $types .= "iss";
        }

        // 3. Lọc theo Ngày đặt hàng
        if ($date !== '') {
            $sql .= " AND DATE(created_at) = ?";
            $params[] = $date;
            $types .= "s"; 
        }
        
        $sql .= " ORDER BY id DESC";

        $stmt = $this->conn->prepare($sql);
        
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        
        $stmt->execute();
        $result = $stmt->get_result();
        
        $orders = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $orders[] = $row;
            }
        }
        return $orders;
    }

    // 2. Lấy thông tin chi tiết của 1 đơn hàng 
    public function getOrderById($id) {
        $sql = "SELECT * FROM orders WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // 3. Đếm tổng số đơn hàng (Dùng cho Dashboard)
    public function getTotalOrders() {
        $sql = "SELECT COUNT(id) as total FROM orders";
        $result = $this->conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['total'];
        }
        return 0;
    }

    // Tính doanh thu
    public function getTotalRevenue() {
        $sql = "SELECT SUM(total_money) AS total_revenue FROM orders WHERE status = 2";
        $result = $this->conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['total_revenue'] ? $row['total_revenue'] : 0;
        }
        return 0;
    }

    // Lấy danh sách sản phẩm thuộc về 1 đơn hàng cụ thể
    public function getOrderItems($order_id) {
        $sql = "SELECT od.*, p.name, p.image 
                FROM order_details od 
                LEFT JOIN products p ON od.product_id = p.id 
                WHERE od.order_id = ?";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    // Hàm cập nhật trạng thái đơn hàng
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

    // Hàm hoàn trả số lượng tồn kho khi hủy đơn hàng
    public function restoreOrderStock($order_id) {
        // 1. Lấy danh sách sản phẩm và số lượng từ chi tiết đơn hàng
        $sql = "SELECT product_id, quantity FROM order_details WHERE order_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $order_id);
        $stmt->execute();
        $items = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

        // 2. Vòng lặp: Lấy từng món cộng trả lại vào bảng products
        if (!empty($items)) {
            foreach ($items as $item) {
                $product_id = $item['product_id'];
                $quantity = $item['quantity'];

                // Dùng phép toán + trực tiếp trong SQL
                $sqlUpdate = "UPDATE products SET stock_quantity = stock_quantity + ? WHERE id = ?";
                $stmtUpdate = $this->conn->prepare($sqlUpdate);
                $stmtUpdate->bind_param("ii", $quantity, $product_id);
                $stmtUpdate->execute();
            }
        }
        return true;
    }
}
?>