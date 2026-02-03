<?php
require_once './config/Database.php';

class BaseModel {
    protected $conn;

    public function __construct() {
        $db = Database::getInstance();
        $this->conn = $db->conn;
    }
}
?>