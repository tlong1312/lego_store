<?php
require_once 'BaseModel.php';

class ProductModel extends BaseModel {
    
    // Hàm thêm sản phẩm mới
    public function addProduct($theme_id, $sku, $name, $description, $piece_count, $age_range, $image, $stock_quantity, $import_price, $profit_margin, $status) {
        $sql = "INSERT INTO products (theme_id, sku, name, description, piece_count, age_range, image, stock_quantity, import_price, profit_margin, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isssissddii", $theme_id, $sku, $name, $description, $piece_count, $age_range, $image, $stock_quantity, $import_price, $profit_margin, $status);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    
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

    // ==========================================
    // ĐÃ SỬA: Hàm lấy tất cả sản phẩm (Có JOIN lấy tên danh mục)
    // ==========================================
    public function getAllProducts() {
        $sql = "SELECT p.*, t.name AS category_name 
                FROM products p 
                LEFT JOIN themes t ON p.theme_id = t.id 
                ORDER BY p.id DESC";
        $result = $this->conn->query($sql);
        
        $products = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        return $products;
    }

    // Hàm cập nhật số lượng tồn kho nhanh
    public function updateStock($id, $stock_quantity) {
        $sql = "UPDATE products SET stock_quantity = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $stock_quantity, $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Hàm cập nhật trạng thái ẩn/hiện sản phẩm
    public function updateStatus($id, $status) {
        $sql = "UPDATE products SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $status, $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Hàm cập nhật toàn bộ thông tin sản phẩm
    public function updateProduct($id, $theme_id, $sku, $name, $description, $piece_count, $age_range, $image, $stock_quantity, $import_price, $profit_margin, $status) {
        $sql = "UPDATE products SET 
                theme_id = ?, sku = ?, name = ?, description = ?, 
                piece_count = ?, age_range = ?, image = ?, 
                stock_quantity = ?, import_price = ?, profit_margin = ?, status = ? 
                WHERE id = ?";
                
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("isssissddiii", $theme_id, $sku, $name, $description, $piece_count, $age_range, $image, $stock_quantity, $import_price, $profit_margin, $status, $id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Hàm xóa sản phẩm theo ID
    public function deleteProduct($id) {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // ==========================================
    // ĐÃ SỬA: Hàm tìm kiếm sản phẩm (Có JOIN lấy tên danh mục)
    // ==========================================
    public function searchProductsByName($keyword) {
        $sql = "SELECT p.*, t.name AS category_name 
                FROM products p 
                LEFT JOIN themes t ON p.theme_id = t.id 
                WHERE p.name LIKE ? OR p.sku LIKE ?
                ORDER BY p.id DESC";
        $stmt = $this->conn->prepare($sql);
        
        $searchParam = "%" . $keyword . "%";
        // Cập nhật tìm kiếm cả SKU cho "mạnh" hơn
        $stmt->bind_param("ss", $searchParam, $searchParam); 
        $stmt->execute();
        $result = $stmt->get_result();
        
        $products = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $products[] = $row;
            }
        }
        return $products;
    }

}
?>