<?php
require_once 'BaseModel.php';

class UserModel extends BaseModel {
    public function emailExists($email) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function login($email, $password) {
        $passwordHash = md5($password);
        
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
}
?>