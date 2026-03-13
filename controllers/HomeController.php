<?php
class HomeController extends BaseController {
    public function index() {
        $productModel = new ProductModel();
        $data['latest_products'] = $productModel->getLatestProducts(8);
        $this->view('layouts/client_header');
        $this->view('client/home', $data); 
        $this->view('layouts/client_footer');
    }
}
?>