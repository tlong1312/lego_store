<?php
require_once 'BaseModel.php';

class CategoryModel extends BaseModel {
    
    // Đổi tên hàm thành Category
    public function getAllCategories($keyword = "") {
        if ($keyword != "") {
            // Câu lệnh SQL vẫn lấy từ bảng themes để không bị lỗi database
            $sql = "SELECT * FROM themes WHERE name LIKE ? ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $param = "%" . $keyword . "%";
            $stmt->bind_param("s", $param);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $sql = "SELECT * FROM themes ORDER BY id DESC";
            $result = $this->conn->query($sql);
        }
        
        $categories = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
        return $categories;
    }

    public function deleteCategory($id) {
        $sql = "DELETE FROM themes WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // --- 3 HÀM BỔ SUNG CHO TÍNH NĂNG THÊM & SỬA ---

    // 1. Lấy chi tiết 1 danh mục để đổ dữ liệu ra form Sửa
    public function getCategoryById($id) {
        $sql = "SELECT * FROM themes WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // 2. Thêm danh mục mới
    public function addCategory($name) {
        $sql = "INSERT INTO themes (name) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $name);
        return $stmt->execute();
    }

    // 3. Cập nhật tên danh mục
    public function updateCategory($id, $name) {
        $sql = "UPDATE themes SET name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $name, $id);
        return $stmt->execute();
    }
}
?>