<?php
class CartController extends BaseController{

    private function checkLogin() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'customer') {
            $_SESSION['flash_type'] = 'warning';
            $_SESSION['flash_msg'] = 'Vui lòng đăng nhập tài khoản Khách hàng để sử dụng giỏ hàng!';
            $this->redirect('index.php?controller=auth&action=login');
            exit();
        }
    }


    public function index() {
        $this->checkLogin();
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $data['cart'] = $_SESSION['cart'];

        $this->view('layouts/client_header');
        $this->view('client/cart', $data);
        $this->view('layouts/client_footer');
    }

    public function add(){
        $this->checkLogin();
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;
            
            if($product_id > 0 && $quantity > 0) {
                $productModel = new ProductModel();
                $product = $productModel->getProductById($product_id);

                if($product) {
                    $gia_ban = $product['import_price'] * (1 + $product['profit_margin'] / 100);

                    if(!isset($_SESSION['cart'])) {
                        $_SESSION['cart'] = [];
                    }

                    if(isset($_SESSION['cart'][$product_id])) {
                        $_SESSION['cart'][$product_id]['quantity'] += $quantity;

                        if($_SESSION['cart'][$product_id]['quantity'] > $product['stock_quantity']) {
                            $_SESSION['cart'][$product_id]['quantity'] = $product['stock_quantity'];
                        }
                    }else {
                        $_SESSION['cart'][$product_id] = [
                            'id' => $product['id'],
                            'name' => $product['name'],
                            'price' => $gia_ban,
                            'image' => $product['image'],
                            'quantity' => $quantity,
                            'stock_quantity' => $product['stock_quantity']
                        ];
                    }

                    $this->redirect('index.php?controller=cart&action=index');
                }
            }
        }

    }

    public function update() {
        $this->checkLogin();

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quantity'])) {
            
            foreach ($_POST['quantity'] as $id => $qty) {
                $id = (int)$id;
                $qty = (int)$qty;

                if (isset($_SESSION['cart'][$id])) {
                    if ($qty <= 0) {
                        unset($_SESSION['cart'][$id]);
                    } else {
                        $stock = $_SESSION['cart'][$id]['stock_quantity'];
                        if ($qty > $stock) {
                            $qty = $stock; 
                        }
                        $_SESSION['cart'][$id]['quantity'] = $qty;
                    }
                }
            }
        }
        
        $this->redirect('index.php?controller=cart&action=index');
    }

    public function remove() {
        $this->checkLogin();
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        
        if(isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }

        $this->redirect('index.php?controller=cart&action=index');
    }

    public function checkout() {
        $this->checkLogin();
        if (empty($_SESSION['cart'])) {
            $this->redirect('index.php?controller=cart&action=index');
        }
        $data['cart'] = $_SESSION['cart'];
        $data['user'] = $_SESSION['user'];

        $this->view('layouts/client_header');
        $this->view('client/checkout', $data);
        $this->view('layouts/client_footer');
    }

    public function processCheckout() {
        $this->checkLogin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_SESSION['cart'])) {
            require_once 'models/OrderModel.php';
            $orderModel = new OrderModel();

            $fullname = $_POST['fullname'];
            $phone = $_POST['phone'];
            $address = $_POST['address']; 
            $ward = $_POST['ward_name']; 
            $province = $_POST['province_name']; 
            $payment_method = $_POST['payment_method'];
            $user_id = $_SESSION['user']['id'];

            $total_amount = 0;
            foreach ($_SESSION['cart'] as $item) {
                $total_amount += $item['price'] * $item['quantity'];
            }

            $order_id = $orderModel->createOrder($user_id, $fullname, $phone, $address, $ward, $province, $total_amount, $payment_method);

            if ($order_id) {
                foreach ($_SESSION['cart'] as $item) {
                    $orderModel->createOrderDetail($order_id, $item['id'], $item['quantity'], $item['price']);
                    $orderModel->reduceProductStock($item['id'], $item['quantity']);
                }
                unset($_SESSION['cart']); 
                $_SESSION['flash_type'] = 'success';
                $_SESSION['flash_msg'] = 'Đặt hàng thành công! Mã đơn của bạn là #' . $order_id;
                $this->redirect('index.php?controller=cart&action=history');
            }
        }
    }

    public function history() {
        $this->checkLogin();
        require_once 'models/OrderModel.php';
        $orderModel = new OrderModel();
        
        $data['orders'] = $orderModel->getOrderHistory($_SESSION['user']['id']);

        $this->view('layouts/client_header');
        $this->view('client/history', $data);
        $this->view('layouts/client_footer');
    }

    public function orderDetail() {
        $this->checkLogin();
        
        if (isset($_GET['id'])) {
            $order_id = (int)$_GET['id'];
            $user_id = $_SESSION['user']['id'];

            require_once 'models/OrderModel.php';
            $orderModel = new OrderModel();

            $order = $orderModel->getOrderByIdAndUser($order_id, $user_id);
            
            if (!$order) {
                $this->redirect('index.php?controller=cart&action=history');
            }
            
            $data['order'] = $order;
            $data['order_details'] = $orderModel->getOrderDetailsById($order_id);

            $this->view('layouts/client_header');
            $this->view('client/order_detail', $data);
            $this->view('layouts/client_footer');
        } else {
            $this->redirect('index.php?controller=cart&action=history');
        }
    }

    public function cancelOrder() {
        $this->checkLogin();
        
        if (isset($_GET['id'])) {
            $order_id = (int)$_GET['id'];
            $user_id = $_SESSION['user']['id'];

            require_once 'models/OrderModel.php';
            $orderModel = new OrderModel();
            $order = $orderModel->getOrderByIdAndUser($order_id, $user_id);
            
            if ($order && $order['status'] == 0) {
                $orderModel->beginTransaction();

                try {
                    $orderModel->restoreOrderStock($order_id);
                    $orderModel->updateOrderStatus($order_id, 3);
                    $orderModel->commit();

                    $_SESSION['flash_type'] = 'success';
                    $_SESSION['flash_msg'] = 'Đã hủy thành công đơn hàng #' . $order_id;

                } catch (Exception $e) {
                    $orderModel->rollback();
                    $_SESSION['flash_type'] = 'error';
                    $_SESSION['flash_msg'] = 'Hủy đơn hàng thất bại, đã có lỗi xảy ra: ' . $e->getMessage();
                }

            } else {
                $_SESSION['flash_type'] = 'error';
                $_SESSION['flash_msg'] = 'Không thể hủy đơn hàng này hoặc đơn hàng không tồn tại.';
            }

            $this->redirect('index.php?controller=cart&action=history');

        } else {
            $this->redirect('index.php?controller=cart&action=history');
        }
    }
}
?>