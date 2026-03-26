<?php
require_once './config/Database.php';

class BaseModel
{
    protected $conn;

    public function __construct()
    {
        $db = Database::getInstance();
        $this->conn = $db->conn;
    }

    public function beginTransaction()
    {
        $this->conn->begin_transaction();
    }

    public function commit()
    {
        $this->conn->commit();
    }

    public function rollback()
    {
        $this->conn->rollback();
    }
}
?>