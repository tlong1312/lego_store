<?php
class ContactController extends BaseController{
    public function index() {
        require_once 'views/layouts/client_header.php';
        require_once 'views/client/contact.php';
        require_once 'views/layouts/client_footer.php';
    }
}
?>