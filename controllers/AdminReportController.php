<?php
require_once 'models/ProductModel.php';

class AdminReportController extends BaseController
{
    public function importExport()
    {
        $productModel = new ProductModel();
        $allProducts = $productModel->getAllProducts();

        $stockAtDate = null;
        $importExportData = null;
        $startDate = '';
        $endDate = '';

        if (isset($_GET['product_id']) && isset($_GET['start_date']) && isset($_GET['end_date'])) {
            $productId = (int) $_GET['product_id'];
            $startDate = $_GET['start_date'];
            $endDate = $_GET['end_date'];

            $stockAtDate = $productModel->getHistoricalStock($productId, $endDate);

            $importExportData = $productModel->getImportExportReport($productId, $startDate, $endDate);
            $importDetails = $productModel->getImportDetailsList($productId, $startDate, $endDate);
            $exportDetails = $productModel->getExportDetailsList($productId, $startDate, $endDate);
        }

        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/report_list.php';
        require_once 'views/layouts/admin_footer.php';
    }


    public function profit()
    {
        require_once 'models/ProductModel.php';
        $productModel = new ProductModel();

        $allProducts = $productModel->getAllProducts();

        $productId = isset($_GET['product_id']) ? $_GET['product_id'] : '';

        $batches = $productModel->getProfitByBatch($productId);

        require_once 'views/layouts/admin_header.php';
        require_once 'views/admin/report_profit.php';
        require_once 'views/layouts/admin_footer.php';
    }

    public function inventory()
    {
        $productModel = new ProductModel();

        $products = $productModel->getAllProducts();

        $selectedProductId = null;
        $selectedDate = null;
        $stockResult = null;
        $selectedProductName = "";

        if (isset($_GET['product_id']) && isset($_GET['target_date'])) {
            $selectedProductId = (int) $_GET['product_id'];
            $selectedDate = $_GET['target_date'];

            $stockResult = $productModel->getHistoricalStock($selectedProductId, $selectedDate);
            foreach ($products as $p) {
                if ($p['id'] == $selectedProductId) {
                    $selectedProductName = $p['name'];
                    break;
                }
            }
        }
        require_once 'views/layouts/admin_header.php';

        require_once 'views/admin/report_inventory.php';
        require_once 'views/layouts/admin_footer.php';

    }
}
?>