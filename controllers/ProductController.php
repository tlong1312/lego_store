<?php
class ProductController extends BaseController{
    public function index() {
        $productModel = new ProductModel();
        
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
        $category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : 0;
        $price_range = isset($_GET['price_range']) ? $_GET['price_range'] : '';
        $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
        
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
        
        $limit = 12; 
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
        if ($page < 1) $page = 1;
        $offset = ($page - 1) * $limit; 
        
        $total_products = $productModel->getTotalFilteredProducts($keyword, $category_id, $min_price, $max_price);
        $total_pages = ceil($total_products / $limit); 
        
        $data['products'] = $productModel->getFilteredProducts($limit, $offset, $keyword, $category_id, $min_price, $max_price, $sort);
        $data['themes'] = $productModel->getAllThemes();
        
        $data['keyword'] = $keyword;
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

    public function detail() {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if ($id <= 0) {
            $this->redirect('index.php?controller=product&action=index');
        }

        $productModel = new ProductModel();
        $product = $productModel->getProductById($id);

        if (!$product) {
            echo "<script>alert('Sản phẩm không tồn tại!'); window.location.href='index.php?controller=product&action=index';</script>";
            return;
        }

        $data['product'] = $product;
        $data['gia_ban'] = $product['import_price'] * (1 + $product['profit_margin'] / 100);

        $data['reviews'] = $productModel->getProductReviews($id);
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
                echo "<script>alert('Bạn phải mua và trải nghiệm sản phẩm này mới được đánh giá nhé!'); window.location.href='index.php?controller=product&action=detail&id=$product_id';</script>";
                exit();
            }

            if ($productModel->checkUserReviewed($user_id, $product_id)) {
                echo "<script>alert('Bạn đã đánh giá sản phẩm này rồi. Cảm ơn bạn!'); window.location.href='index.php?controller=product&action=detail&id=$product_id';</script>";
                exit();
            }

            if ($product_id > 0 && !empty($comment)) {
                $productModel->addReview($product_id, $user_id, $rating, $comment);
                echo "<script>alert('Gửi đánh giá thành công! Cảm ơn bạn.'); window.location.href='index.php?controller=product&action=detail&id=$product_id';</script>";
            }
        } else {
            $this->redirect('index.php?controller=auth&action=login');
        }
    }
}
?>