<?php
require_once 'BaseModel.php';

class UserModel extends BaseModel {
    
    // ==========================================
    // PHẦN 1: CÁC HÀM CHO NGƯỜI DÙNG (FRONTEND)
    // ==========================================

    public function emailExists($email) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function login($email, $password) {
        $passwordHash = md5($password);
        
        // Rất chuẩn: Đã chặn đăng nhập nếu is_locked = 1
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? AND password = ? AND is_locked = 0");
        $stmt->bind_param("ss", $email, $passwordHash);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc(); 
    }

    public function register($fullname, $email, $password, $phone, $address) {
        $passwordHash = md5($password);
        $role = 'customer';
        $stmt = $this->conn->prepare("INSERT INTO users (fullname, email, password, phone, address, role) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $fullname, $email, $passwordHash, $phone, $address, $role);
        return $stmt->execute(); 
    }


    // ==========================================
    // PHẦN 2: CÁC HÀM CHO ADMIN QUẢN LÝ
    // ==========================================

    // Lấy danh sách tất cả người dùng (Có tìm kiếm)
    public function getAllUsers($keyword = "") {
        if ($keyword != "") {
            $sql = "SELECT * FROM users WHERE fullname LIKE ? OR email LIKE ? ORDER BY id DESC";
            $stmt = $this->conn->prepare($sql);
            $param = "%" . $keyword . "%";
            $stmt->bind_param("ss", $param, $param);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $sql = "SELECT * FROM users ORDER BY id DESC";
            $result = $this->conn->query($sql);
        }
        return $result && $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Admin thêm người dùng (Có thể chọn quyền admin hoặc customer)
    public function addUser($fullname, $email, $password, $phone, $address, $role) {
        $sql = "INSERT INTO users (fullname, email, password, phone, address, role, is_locked) 
                VALUES (?, ?, ?, ?, ?, ?, 0)";
        $stmt = $this->conn->prepare($sql);
        
        // Dùng md5 để đồng bộ với cơ chế của hàm login/register phía trên
        $hashed_password = md5($password);
        
        $stmt->bind_param("ssssss", $fullname, $email, $hashed_password, $phone, $address, $role);
        return $stmt->execute();
    }

    public function updateRole($id, $role) {
        $sql = "UPDATE users SET role = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $role, $id);
        return $stmt->execute();
    }
    
    // Khóa / Mở khóa tài khoản
    public function updateLockStatus($id, $is_locked) {
        $sql = "UPDATE users SET is_locked = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $is_locked, $id);
        return $stmt->execute();
    }
}
?>