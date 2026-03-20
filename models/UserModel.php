<?php
require_once 'BaseModel.php';

class UserModel extends BaseModel
{


    public function emailExists($email)
    {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function login($email, $password)
    {
        $passwordHash = md5($password);

        // Rất chuẩn: Đã chặn đăng nhập nếu is_locked = 1
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? AND password = ? AND is_locked = 0");
        $stmt->bind_param("ss", $email, $passwordHash);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function register($fullname, $email, $password, $phone, $address)
    {
        $passwordHash = md5($password);
        $role = 'customer';
        $stmt = $this->conn->prepare("INSERT INTO users (fullname, email, password, phone, address, role) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $fullname, $email, $passwordHash, $phone, $address, $role);
        return $stmt->execute();
    }



    // KIỂM TRA TRÙNG EMAIL 
    public function checkEmailExists($email, $ignore_id = null)
    {
        $sql = "SELECT id FROM users WHERE email = ?";

        if ($ignore_id !== null) {
            $sql .= " AND id != ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("si", $email, $ignore_id);
        } else {
            // Trường hợp Thêm Mới
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $email);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    // Lấy danh sách tất cả người dùng
    public function getAllUsers($keyword = "", $role = "")
    {
        $sql = "SELECT * FROM users WHERE 1=1";
        $params = [];
        $types = "";

        if ($keyword != "") {
            $sql .= " AND (fullname LIKE ? OR email LIKE ?)";
            $param_kw = "%" . $keyword . "%";
            $params[] = $param_kw;
            $params[] = $param_kw;
            $types .= "ss";
        }

        if ($role !== "") {
            $sql .= " AND role = ?";
            $params[] = $role;
            $types .= "s";
        }

        $sql .= " ORDER BY id DESC";

        $stmt = $this->conn->prepare($sql);

        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        return $result && $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    // Admin thêm người dùng (Có thể chọn quyền admin hoặc customer)
    public function addUser($fullname, $email, $password, $phone, $address, $role)
    {
        $sql = "INSERT INTO users (fullname, email, password, phone, address, role, is_locked) 
                VALUES (?, ?, ?, ?, ?, ?, 0)";
        $stmt = $this->conn->prepare($sql);

        $hashed_password = md5($password);

        $stmt->bind_param("ssssss", $fullname, $email, $hashed_password, $phone, $address, $role);
        return $stmt->execute();
    }

    public function updateRole($id, $role)
    {
        $sql = "UPDATE users SET role = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $role, $id);
        return $stmt->execute();
    }

    // Khóa / Mở khóa tài khoản
    public function updateLockStatus($id, $is_locked)
    {
        $sql = "UPDATE users SET is_locked = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $is_locked, $id);
        return $stmt->execute();
    }

    public function getTotalCustomers()
    {
        $sql = "SELECT COUNT(id) AS total FROM users WHERE role = 'customer'";
        $result = $this->conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['total'];
        }
        return 0;
    }
}
?>