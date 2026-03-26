<?php
require_once 'BaseModel.php';

class ProductModel extends BaseModel
{

    // Hàm thêm sản phẩm mới (ĐÃ CẬP NHẬT: Thêm $low_stock_threshold)
    public function addProduct($theme_id, $sku, $name, $description, $piece_count, $age_range, $image, $stock_quantity, $import_price, $profit_margin, $status, $low_stock_threshold)
    {
        // Thêm low_stock_threshold vào câu lệnh INSERT
        $sql = "INSERT INTO products (theme_id, sku, name, description, piece_count, age_range, image, stock_quantity, import_price, profit_margin, status, low_stock_threshold) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        
        // Cập nhật bind_param: Thêm 1 chữ 'i' vào cuối chuỗi định dạng (thành isssissddiii)
        $stmt->bind_param("isssissddiii", $theme_id, $sku, $name, $description, $piece_count, $age_range, $image, $stock_quantity, $import_price, $profit_margin, $status, $low_stock_threshold);
        
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getLatestProducts($limit = 8)
    {
        $sql = "SELECT * FROM products WHERE status = 1 ORDER BY id DESC LIMIT ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotalProducts()
    {
       $sql = "SELECT COUNT(id) AS total FROM products"; 
        
        $result = $this->conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['total'];
        }
        return 0;
    }

    public function getProductsPaginated($limit, $offset)
    {
        $sql = "SELECT * FROM products WHERE status = 1 ORDER BY id DESC LIMIT ? OFFSET ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $limit, $offset);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductById($id)
    {
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

    // Hàm lấy tất cả sản phẩm 
    public function getAllProducts()
    {
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
    public function updateStock($id, $stock_quantity)
    {
        $sql = "UPDATE products SET stock_quantity = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $stock_quantity, $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Hàm cập nhật trạng thái ẩn/hiện sản phẩm
    public function updateStatus($id, $status)
    {
        $sql = "UPDATE products SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $status, $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Hàm cập nhật toàn bộ thông tin sản phẩm (ĐÃ CẬP NHẬT: Thêm $low_stock_threshold)
    public function updateProduct($id, $theme_id, $sku, $name, $description, $piece_count, $age_range, $image, $stock_quantity, $import_price, $profit_margin, $status, $low_stock_threshold)
    {
        // Thêm low_stock_threshold vào câu lệnh UPDATE
        $sql = "UPDATE products SET 
                theme_id = ?, sku = ?, name = ?, description = ?, 
                piece_count = ?, age_range = ?, image = ?, 
                profit_margin = ?, status = ?, low_stock_threshold = ? 
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        // Cập nhật bind_param: Thêm chữ 'i' trước id cuối cùng (thành isssissdiii)
        $stmt->bind_param(
            "isssissdiii",
            $theme_id,
            $sku,
            $name,
            $description,
            $piece_count,
            $age_range,
            $image,
            $profit_margin,
            $status,
            $low_stock_threshold,
            $id
        );

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Hàm xóa sản phẩm theo ID
    public function deleteProduct($id)
    {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Hàm tìm kiếm sản phẩm (Có JOIN lấy tên danh mục)
    public function searchProductsByName($keyword)
    {
        $sql = "SELECT p.*, t.name AS category_name 
                FROM products p 
                LEFT JOIN themes t ON p.theme_id = t.id 
                WHERE p.name LIKE ? OR p.sku LIKE ?
                ORDER BY p.id DESC";
        $stmt = $this->conn->prepare($sql);

        $searchParam = "%" . $keyword . "%";
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

    public function updateStockAndPriceAfterImport($product_id, $new_import_qty, $new_import_price)
    {

        // 1. Lấy thông tin Tồn kho cũ và Giá nhập cũ từ DB
        $sql_get = "SELECT stock_quantity, import_price FROM products WHERE id = ?";
        $stmt_get = $this->conn->prepare($sql_get);
        $stmt_get->bind_param("i", $product_id);
        $stmt_get->execute();
        $product = $stmt_get->get_result()->fetch_assoc();

        if ($product) {
            $current_stock = (int) $product['stock_quantity'];
            $current_import_price = (float) $product['import_price'];

            // 2. TÍNH TOÁN BÌNH QUÂN
            $total_stock = $current_stock + $new_import_qty;

            if ($total_stock > 0) {
                // Công thức: (Tồn cũ * Giá cũ + Nhập mới * Giá mới) / Tổng số lượng
                $new_avg_import_price = (($current_stock * $current_import_price) + ($new_import_qty * $new_import_price)) / $total_stock;
            } else {
                $new_avg_import_price = $new_import_price;
            }

            // 3. Cập nhật lại Tồn kho và Giá nhập bình quân vào Database
            $sql_update = "UPDATE products SET stock_quantity = ?, import_price = ? WHERE id = ?";
            $stmt_update = $this->conn->prepare($sql_update);
            $stmt_update->bind_param("idi", $total_stock, $new_avg_import_price, $product_id);

            return $stmt_update->execute();
        }
        return false;
    }

    public function getAllThemes() {
        $sql = "SELECT * FROM themes";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTotalFilteredProducts($keyword = '', $category_id = 0, $min_price = 0, $max_price = 0) {
        $sql = "SELECT COUNT(*) as total FROM products WHERE status = 1";
        $types = "";
        $params = [];
        
        if (!empty($keyword)) {
            $sql .= " AND name LIKE ?";
            $types .= "s";
            $params[] = "%$keyword%";
        }
        if ($category_id > 0) {
            $sql .= " AND theme_id = ?";
            $types .= "i";
            $params[] = $category_id;
        }
        if ($min_price > 0) {
            $sql .= " AND (import_price * (1 + profit_margin/100)) >= ?";
            $types .= "d";
            $params[] = $min_price;
        }
        if ($max_price > 0) {
            $sql .= " AND (import_price * (1 + profit_margin/100)) <= ?";
            $types .= "d";
            $params[] = $max_price;
        }
        
        $stmt = $this->conn->prepare($sql);
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params); 
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc()['total'];
    }

    public function getFilteredProducts($limit, $offset, $keyword = '', $category_id = 0, $min_price = 0, $max_price = 0, $sort = '') {
        $sql = "SELECT p.*, t.name as theme_name FROM products p JOIN themes t ON p.theme_id = t.id WHERE p.status = 1";
        $types = "";
        $params = [];
        
        if (!empty($keyword)) {
            $sql .= " AND p.name LIKE ?";
            $types .= "s";
            $params[] = "%$keyword%";
        }
        if ($category_id > 0) {
            $sql .= " AND p.theme_id = ?";
            $types .= "i";
            $params[] = $category_id;
        }
        if ($min_price > 0) {
            $sql .= " AND (p.import_price * (1 + p.profit_margin/100)) >= ?";
            $types .= "d";
            $params[] = $min_price;
        }
        if ($max_price > 0) {
            $sql .= " AND (p.import_price * (1 + p.profit_margin/100)) <= ?";
            $types .= "d";
            $params[] = $max_price;
        }
        
        if ($sort == 'asc') {
            $sql .= " ORDER BY (p.import_price * (1 + p.profit_margin/100)) ASC";
        } elseif ($sort == 'desc') {
            $sql .= " ORDER BY (p.import_price * (1 + p.profit_margin/100)) DESC";
        } else {
            $sql .= " ORDER BY p.id DESC";
        }
        
        $sql .= " LIMIT ? OFFSET ?";
        $types .= "ii";
        $params[] = $limit;
        $params[] = $offset;

        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param($types, ...$params);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getProductReviews($product_id) {
        $sql = "SELECT r.*, u.fullname FROM reviews r JOIN users u ON r.user_id = u.id WHERE r.product_id = ? ORDER BY r.created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $product_id);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function checkUserBoughtProduct($user_id, $product_id) {
        $sql = "SELECT od.id FROM order_details od 
                JOIN orders o ON o.id = od.order_id 
                WHERE o.user_id = ? 
                AND od.product_id = ? 
                AND o.status != 0 
                AND o.status != 1
                AND o.status != 3
                LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function checkUserReviewed($user_id, $product_id) {
        $sql = "SELECT id FROM reviews WHERE user_id = ? AND product_id = ? LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ii", $user_id, $product_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public function addReview($product_id, $user_id, $rating, $comment) {
        $sql = "INSERT INTO reviews (product_id, user_id, rating, comment) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiis", $product_id, $user_id, $rating, $comment);
        return $stmt->execute();
    }
}
?>