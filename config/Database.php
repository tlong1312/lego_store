<?php
class Database {
    private static $instance = null;
    public $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "lego_store");

        if($this->conn->connect_error) {
            die("Kết nối thất bại: " . $this->conn->connect_error);
        }

        $this->conn->set_charset("utf8mb4");
    }

    public static function getInstance(){
        if(!self::$instance) {
            self::$instance = new Database();
        }
        return self::$instance;
    }
}
?>