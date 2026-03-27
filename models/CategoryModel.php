<?php
require_once 'BaseModel.php';

class CategoryModel extends BaseModel
{

    public function getAllCategories($keyword = "")
    {
        if ($keyword != "") {
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

    public function deleteCategory($id)
    {
        $sql = "DELETE FROM themes WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }


     
    public function getCategoryById($id)
    {
        $sql = "SELECT * FROM themes WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

     
    public function addCategory($name)
    {
        $sql = "INSERT INTO themes (name) VALUES (?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $name);
        return $stmt->execute();
    }

     
    public function updateCategory($id, $name)
    {
        $sql = "UPDATE themes SET name = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("si", $name, $id);
        return $stmt->execute();
    }

    public function checkNameExists($name, $ignore_id = null)
    {
         
        $sql = "SELECT id FROM themes WHERE name = ?";

        if ($ignore_id !== null) {
            $sql .= " AND id != ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("si", $name, $ignore_id);
        } else {
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("s", $name);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }

    public function checkActiveProducts($category_id) {
        $sql = "SELECT COUNT(id) AS total FROM products WHERE theme_id = ? AND status = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $category_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
             
            return $row['total'] > 0;
        }
        return false;
    }
}
?>