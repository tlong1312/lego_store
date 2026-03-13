<?php
require_once 'BaseModel.php';

class ProductModel extends BaseModel {
    
    
    public function getLatestProducts($limit = 8) {
        $sql = "SELECT * FROM products WHERE status = 1 ORDER BY id DESC LIMIT ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotalProducts() {
        $sql = "SELECT COUNT(*) as total FROM products WHERE status = 1";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }
    
    public function getProductsPaginated($limit, $offset) {
        $sql = "SELECT * FROM products WHERE status = 1 ORDER BY id DESC LIMIT ? OFFSET ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductById($id){
        $sql = "SELECT p.*, t.name AS theme_name
                FROM products p
                JOIN themes t ON p.theme_id = t.id
                WHERE p.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
}
?>