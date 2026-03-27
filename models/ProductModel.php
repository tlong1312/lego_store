<?php
require_once 'BaseModel.php';

class ProductModel extends BaseModel
{

     
    public function addProduct($theme_id, $sku, $name, $description, $piece_count, $age_range, $image, $stock_quantity, $import_price, $profit_margin, $status, $low_stock_threshold)
    {
         
        $sql = "INSERT INTO products (theme_id, sku, name, description, piece_count, age_range, image, stock_quantity, import_price, profit_margin, status, low_stock_threshold) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        
         
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

     
    public function updateProduct($id, $theme_id, $sku, $name, $description, $piece_count, $age_range, $image, $stock_quantity, $import_price, $profit_margin, $status, $low_stock_threshold)
    {
         
        $sql = "UPDATE products SET 
                theme_id = ?, sku = ?, name = ?, description = ?, 
                piece_count = ?, age_range = ?, image = ?, 
                profit_margin = ?, status = ?, low_stock_threshold = ? 
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

         
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

         
        $sql_get = "SELECT stock_quantity, import_price FROM products WHERE id = ?";
        $stmt_get = $this->conn->prepare($sql_get);
        $stmt_get->bind_param("i", $product_id);
        $stmt_get->execute();
        $product = $stmt_get->get_result()->fetch_assoc();

        if ($product) {
            $current_stock = (int) $product['stock_quantity'];
            $current_import_price = (float) $product['import_price'];

             
            $total_stock = $current_stock + $new_import_qty;

            if ($total_stock > 0) {
                 
                $new_avg_import_price = (($current_stock * $current_import_price) + ($new_import_qty * $new_import_price)) / $total_stock;
            } else {
                $new_avg_import_price = $new_import_price;
            }

             
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

     
    public function getHistoricalStock($productId, $targetDate) 
    {
        $endOfDay = $targetDate . ' 23:59:59';

         
        $sqlImport = "SELECT SUM(rd.quantity) as total_in 
                      FROM receipt_details rd 
                      JOIN receipts r ON rd.receipt_id = r.id 
                      WHERE rd.product_id = ? AND r.status = 1 AND r.created_at <= ?";
                      
        $stmtIn = $this->conn->prepare($sqlImport);
        $stmtIn->bind_param("is", $productId, $endOfDay);
        $stmtIn->execute();
        $resultIn = $stmtIn->get_result()->fetch_assoc();
        
        $totalIn = $resultIn['total_in'] ? (int)$resultIn['total_in'] : 0;

         
        $sqlExport = "SELECT SUM(od.quantity) as total_out 
                      FROM order_details od 
                      JOIN orders o ON od.order_id = o.id 
                      WHERE od.product_id = ? AND o.status != 3 AND o.created_at <= ?";
                      
        $stmtOut = $this->conn->prepare($sqlExport);
        $stmtOut->bind_param("is", $productId, $endOfDay);
        $stmtOut->execute();
        $resultOut = $stmtOut->get_result()->fetch_assoc();
        
        $totalOut = $resultOut['total_out'] ? (int)$resultOut['total_out'] : 0;

         
        $historicalStock = $totalIn - $totalOut;
        
        return $historicalStock > 0 ? $historicalStock : 0;
    }

     
    public function getImportExportReport($productId, $startDate, $endDate) 
    {
        $startOfDay = $startDate . ' 00:00:00';
        $endOfDay = $endDate . ' 23:59:59';

        $sqlImport = "SELECT SUM(rd.quantity) as total_in 
                      FROM receipt_details rd 
                      JOIN receipts r ON rd.receipt_id = r.id 
                      WHERE rd.product_id = ? AND r.status = 1 
                      AND r.created_at >= ? AND r.created_at <= ?";
        $stmtIn = $this->conn->prepare($sqlImport);
        $stmtIn->bind_param("iss", $productId, $startOfDay, $endOfDay);
        $stmtIn->execute();
        $resultIn = $stmtIn->get_result()->fetch_assoc();
        $totalIn = $resultIn['total_in'] ? (int)$resultIn['total_in'] : 0;

        $sqlExport = "SELECT SUM(od.quantity) as total_out 
                      FROM order_details od 
                      JOIN orders o ON od.order_id = o.id 
                      WHERE od.product_id = ? AND o.status != 3 
                      AND o.created_at >= ? AND o.created_at <= ?";
        $stmtOut = $this->conn->prepare($sqlExport);
        $stmtOut->bind_param("iss", $productId, $startOfDay, $endOfDay);
        $stmtOut->execute();
        $resultOut = $stmtOut->get_result()->fetch_assoc();
        $totalOut = $resultOut['total_out'] ? (int)$resultOut['total_out'] : 0;

        return [
            'total_in' => $totalIn,
            'total_out' => $totalOut
        ];
    }

    public function getProfitByBatch($productId = '') 
    {
        $sql = "SELECT 
                    r.id as receipt_id, 
                    r.created_at as import_date, 
                    p.name as product_name, 
                    rd.quantity, 
                    rd.remain_quantity,
                    rd.import_price as cost_price, 
                    p.profit_margin,
                    (rd.import_price + (rd.import_price * p.profit_margin / 100)) as selling_price 
                FROM receipt_details rd
                JOIN receipts r ON rd.receipt_id = r.id
                JOIN products p ON rd.product_id = p.id
                WHERE r.status = 1"; 

        $params = [];
        $types = "";

        if (!empty($productId)) {
            $sql .= " AND p.id = ?";
            $types .= "i";
            $params[] = (int)$productId;
        }

        $sql .= " ORDER BY r.created_at DESC";

        $stmt = $this->conn->prepare($sql);
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result && $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }
}
?>