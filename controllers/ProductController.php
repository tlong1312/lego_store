<?php
class ProductController extends BaseController{
    public function index() {
        $productModel = new ProductModel();
        
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        $sku_keyword = isset($_GET['sku_keyword']) ? trim($_GET['sku_keyword']) : '';
        $category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
        $price_range = isset($_GET['price_range']) ? $_GET['price_range'] : '';
        $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
        $price_from = isset($_GET['price_from']) ? preg_replace('/[^0-9]/', '', $_GET['price_from']) : '';
        $price_to = isset($_GET['price_to']) ? preg_replace('/[^0-9]/', '', $_GET['price_to']) : '';
        
        $min_price = 0;
        $max_price = 0;
        
        switch($price_range) {
            case 'under_1m': $min_price = 0; $max_price = 1000000; break;
            case '1m_3m': $min_price = 1000000; $max_price = 3000000; break;
            case '3m_5m': $min_price = 3000000; $max_price = 5000000; break;
            case '5m_8m': $min_price = 5000000; $max_price = 8000000; break;
            case '8m_10m': $min_price = 8000000; $max_price = 10000000; break;
            case 'over_10m': $min_price = 10000000; $max_price = 999999999; break;
        }

        if ($price_from !== '') {
            $min_price = (float) $price_from;
        }
        if ($price_to !== '') {
            $max_price = (float) $price_to;
        }
        if ($max_price > 0 && $min_price > $max_price) {
            $temp = $min_price;
            $min_price = $max_price;
            $max_price = $temp;
        }
        
        $limit = 12; 
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
        if ($page < 1) $page = 1;
        $offset = ($page - 1) * $limit; 
        
        $total_products = $productModel->getTotalFilteredProducts($keyword, $category_id, $min_price, $max_price, $sku_keyword);
        $total_pages = ceil($total_products / $limit); 
        
        $data['products'] = $productModel->getFilteredProducts($limit, $offset, $keyword, $category_id, $min_price, $max_price, $sort, $sku_keyword);
        $data['themes'] = $productModel->getAllThemes();
        
        $data['keyword'] = $keyword;
        $data['sku_keyword'] = $sku_keyword;
        $data['price_from'] = $price_from;
        $data['price_to'] = $price_to;
        $data['category_id'] = $category_id;
        $data['price_range'] = $price_range;
        $data['sort'] = $sort;
        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;
        $data['total_products'] = $total_products;

        $this->view('layouts/client_header');
        $this->view('client/product_list', $data);
        $this->view('layouts/client_footer');
    }

    public function filter() {
        $productModel = new ProductModel();
        
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        $sku_keyword = isset($_GET['sku_keyword']) ? trim($_GET['sku_keyword']) : '';
        $category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
        $price_range = isset($_GET['price_range']) ? $_GET['price_range'] : '';
        $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
        $price_from = isset($_GET['price_from']) ? preg_replace('/[^0-9]/', '', $_GET['price_from']) : '';
        $price_to = isset($_GET['price_to']) ? preg_replace('/[^0-9]/', '', $_GET['price_to']) : '';
        
        $min_price = 0;
        $max_price = 0;
        
        switch($price_range) {
            case 'under_1m': $min_price = 0; $max_price = 1000000; break;
            case '1m_3m': $min_price = 1000000; $max_price = 3000000; break;
            case '3m_5m': $min_price = 3000000; $max_price = 5000000; break;
            case '5m_8m': $min_price = 5000000; $max_price = 8000000; break;
            case '8m_10m': $min_price = 8000000; $max_price = 10000000; break;
            case 'over_10m': $min_price = 10000000; $max_price = 999999999; break;
        }

        if ($price_from !== '') {
            $min_price = (float) $price_from;
        }
        if ($price_to !== '') {
            $max_price = (float) $price_to;
        }
        if ($max_price > 0 && $min_price > $max_price) {
            $temp = $min_price;
            $min_price = $max_price;
            $max_price = $temp;
        }
        
        $limit = 12; 
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
        if ($page < 1) $page = 1;
        $offset = ($page - 1) * $limit; 
        
        $total_products = $productModel->getTotalFilteredProducts($keyword, $category_id, $min_price, $max_price, $sku_keyword);
        $total_pages = ceil($total_products / $limit); 
        
        $data['products'] = $productModel->getFilteredProducts($limit, $offset, $keyword, $category_id, $min_price, $max_price, $sort, $sku_keyword);
        
        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;
        $data['total_products'] = $total_products;

        // Trả về partial view
        $this->view('client/_product_list_partial', $data);
    }

    public function detail() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if ($id <= 0) {
            $this->redirect('index.php?controller=product&action=index');
        }

        $productModel = new ProductModel();
        $product = $productModel->getProductById($id);

        if (!$product) {
            $_SESSION['flash_type'] = 'info';
            $_SESSION['flash_msg'] = 'Sản phẩm không tồn tại!';
            $this->redirect('index.php?controller=product&action=index');
        }

        $data['product'] = $product;
        $data['gia_ban'] = $product['import_price'] * (1 + $product['profit_margin'] / 100);

        $data['reviews'] = $productModel->getProductReviews($id);
        $data['review_stats'] = $productModel->getReviewStats($id);
        $total_rating = 0;
        $review_count = count($data['reviews']);
        
        if ($review_count > 0) {
            foreach ($data['reviews'] as $rev) {
                $total_rating += $rev['rating'];
            }
            $data['avg_rating'] = round($total_rating / $review_count);
        } else {
            $data['avg_rating'] = 5;
        }
        $data['review_count'] = $review_count;

        $this->view('layouts/client_header');
        $this->view('client/detail', $data);
        $this->view('layouts/client_footer');
    }

    public function submitReview() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user'])) {
            $product_id = (int)$_POST['product_id'];
            $user_id = $_SESSION['user']['id'];
            $rating = (int)$_POST['rating'];
            $comment = trim($_POST['comment']);

            require_once 'models/ProductModel.php';
            $productModel = new ProductModel();

            if (!$productModel->checkUserBoughtProduct($user_id, $product_id)) {
                $_SESSION['flash_type'] = 'info';
                $_SESSION['flash_msg'] = 'Bạn chưa mua sản phẩm này, hoặc đơn hàng của bạn đang trong quá trình xử lý/giao hàng. Vui lòng thử lại sau khi đã nhận hàng nhé!';
                $this->redirect("index.php?controller=product&action=detail&id=$product_id");
                
            }

            if ($productModel->checkUserReviewed($user_id, $product_id)) {
                $_SESSION['flash_type'] = 'info';
                $_SESSION['flash_msg'] = 'Bạn đã đánh giá sản phẩm này rồi. Cảm ơn bạn!';
                $this->redirect("index.php?controller=product&action=detail&id=$product_id");
            }

            if ($product_id > 0 && !empty($comment)) {
                $productModel->addReview($product_id, $user_id, $rating, $comment);
                $_SESSION['flash_type'] = 'success';
                $_SESSION['flash_msg'] = 'Gửi đánh giá thành công! Cảm ơn bạn.';
                $this->redirect("index.php?controller=product&action=detail&id=$product_id");
            }
        } else {
            $this->redirect('index.php?controller=auth&action=login');
        }
    }
}
?>