<?php
require_once 'BaseModel.php';

class OrderModel extends BaseModel {

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
            // Xóa chữ #DH nếu người dùng lỡ gõ vào (VD: #DH001 -> 001 -> 1)
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
}
?>