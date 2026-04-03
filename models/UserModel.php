<?php
require_once 'BaseModel.php';

class UserModel extends BaseModel
{

    private $userColumnsCache = null;

    private function getUserColumns()
    {
        if ($this->userColumnsCache !== null) {
            return $this->userColumnsCache;
        }

        $columns = [];
        $result = $this->conn->query("SHOW COLUMNS FROM users");

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $columns[] = $row['Field'];
            }
        }

        $this->userColumnsCache = $columns;
        return $columns;
    }

    public function supportsUserRegionFields()
    {
        $columns = $this->getUserColumns();
        return in_array('province', $columns) && in_array('ward', $columns);
    }


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
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? AND password = ? AND is_locked = 0");
        $stmt->bind_param("ss", $email, $passwordHash);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function getUserById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function updateCustomerProfile($id, $fullname, $phone, $address, $province = '', $ward = '')
    {
        $columns = $this->getUserColumns();

        $setParts = [
            'fullname = ?',
            'phone = ?',
            'address = ?'
        ];

        $types = 'sss';
        $params = [$fullname, $phone, $address];

        if (in_array('province', $columns)) {
            $setParts[] = 'province = ?';
            $types .= 's';
            $params[] = $province;
        }

        if (in_array('ward', $columns)) {
            $setParts[] = 'ward = ?';
            $types .= 's';
            $params[] = $ward;
        }

        $sql = 'UPDATE users SET ' . implode(', ', $setParts) . ' WHERE id = ?';
        $types .= 'i';
        $params[] = $id;

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        return $stmt->execute();
    }

    public function verifyCurrentPassword($id, $password)
    {
        $hash = md5($password);
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE id = ? AND password = ? LIMIT 1");
        $stmt->bind_param("is", $id, $hash);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function updateUserPassword($id, $newPassword)
    {
        $hash = md5($newPassword);
        $stmt = $this->conn->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $hash, $id);
        return $stmt->execute();
    }

    public function register($fullname, $email, $password, $phone, $address, $ward, $province)
    {
        $hashedPassword = md5($password); 
        $role = 'customer';

        $sql = "INSERT INTO users (fullname, email, password, phone, address, ward, province, role) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssssssss", $fullname, $email, $hashedPassword, $phone, $address, $ward, $province, $role);
        
        return $stmt->execute();
    }



    public function checkEmailExists($email, $ignore_id = null)
    {
        $sql = "SELECT id FROM users WHERE email = ?";

        if ($ignore_id !== null) {
            $sql .= " AND id != ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("si", $email, $ignore_id);
        } else {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $email);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

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