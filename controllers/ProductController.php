<?php
class ProductController extends BaseController{
    public function index() {
        $productModel = new ProductModel();
        $limit = 12; 
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
        if ($page < 1) $page = 1;
        
        $offset = ($page - 1) * $limit; 
        
        $total_products = $productModel->getTotalProducts();
        $total_pages = ceil($total_products / $limit); 
        
        $data['products'] = $productModel->getProductsPaginated($limit, $offset);
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

        $this->view('layouts/client_header');
        $this->view('client/detail', $data);
        $this->view('layouts/client_footer');
    }
}
?>